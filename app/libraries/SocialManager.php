<?php
/**
 * SNS 관련 기능 제공 라이브러리
 * 각 SNS 별 처리되는 비즈니스 로직을 수행
 * 객체 생성 시에 키 값에 맞는 Client를 리플렉션으로 생성한다
 *
 * Copyright (C) Gabia C&S Inc. All Rights Reserved.
 *
 * @author     JaeUk Park <pjw@gabiacns.com>
 * @copyright  2021 Gabia C&S
 */

namespace App\Libraries;

use ReflectionClass;
use App\Libraries\Social\ClientRequestData;
use App\Libraries\Social\Naver\NaverClient;

class SocialManager
{
    // SNS 클라이언트 타입 값
    private $socialType;

    // SNS 관련 설정 정보
    private $socialConfig;

    // 회원 관련 설정 정보
    private $memberConfig;

    // SNS 클라이언트 객체
    private $socialClient;

    // 요청에 넘어온 파라미텅
    private $socialRequest;

    // 로그인, 회원가입 관련 세션값
    private $socialSession;

    // 요청 타입 (login : 로그인, join : 회원가입, myinfo : 마이페이지)
    private $requestType;

	public function __construct($socialType, $request = []) {
        // 클라이언트 타입값이 없으면 null 반환
		if (!$socialType) {
			throw new SocialManagerException('클라이언트 타입 값이 없습니다.');
		}

        // CI 인스턴스
        $this->ci =& get_instance();

        // 전역변수 설정
        $this->socialType = $socialType;

        // 회원 관련 모듈 로드
        $this->ci->load->model('membermodel');
        $this->ci->load->library('memberlibrary');
        $this->ci->load->helper('member');

        // 회원 DB 설정값 조회
        $this->memberConfig = config_load('member');

        // SNS DB 설정값 조회
        $this->socialConfig = config_load('snssocial');

        // 요청 파라미터 정보 설정
        $this->socialRequest = $request;

        // 요청 세션 정보 설정
        $this->socialSession = $this->getSocialSession();

        // 요청 타입 파싱
        $this->requestType = $this->parseSocialSession();

        // SNS 클라이언트 객체 생성
        $this->socialClient = $this->createSocialClient();
	}

    // SNS DB 설정값 조회
    public function getConfig($key) {
        return $this->socialConfig[$key];
    }

    // 인증 URL 리턴
    public function getAuthorizeUrl() {
        return $this->socialClient->getAuthorizeUrl();
    }

    // 인증을 수행하는 함수 인증 후에 login, join 여부에 따라 분기 처리 된다
    public function authenticate() {
        // 사용여부 확인
        if (!$this->socialClient->isUse()) {
            return $this->errorResult(getAlert('mb091'));
        }

        // 인증 결과 리턴
        $authResult = $this->socialClient->authenticate();

        // 인증 실패 시
        if (!$authResult['result']) {
            return $this->errorResult($authResult['msg']);
        }

        // 인증 후 처리 결과
        $result = [];

        // 요청타입에 따라 인증 후 작업 분기처리
        // $authResult 에서 param 변수로 회원관련 정보 세팅
        try {
            switch ($this->requestType) {
                case 'login' :
                    $result = $this->login($authResult['data']);
                    break;
                case 'join' :
                    $result = $this->join($authResult['data']);
                    break;
                case 'myinfo' :
                    $result = $this->integrate($authResult['data']);
                    break;
                default:
                    break;
            }
        } catch (SocialManagerException $e) {
            throw new SocialManagerException('SNS 연동 작업 중 오류가 발생하였습니다 :: '.$e->getMessage());
        }

        // 인증 결과에 담긴 세션 저장처리
        $this->ci->session->set_userdata($authResult['sessions']);

        return $result;
    }

    // 로그인 처리
    public function login($params) {
        // 기본 리다이렉트 주소
        $redirectUrl = '/member/login';

        // 회원 정보 조회
        $member = $this->getMemberData($params);

        // 회원 정보 없는경우 리턴
        if (!$member) {
            $messsage = '일치하는 회원정보가 없습니다.\n회원가입 페이지로 이동합니다.';
            $redirectUrl = '/member/agreement?join_type='.$this->socialClient->getPrefix().'member';
            return $this->errorResult($messsage, $redirectUrl);
        }

        // 승인이 안되어있는 경우
        if ($member['status'] == 'hold') {
            if ($member['kid_auth'] == 'N') {
                $redirectUrl = '/member/kid_check';
            }

            return $this->errorResult($member['user_name'].getAlert('mb104'), $redirectUrl);
        }

        // 휴면계정 체크
		if ($member['dormancy_seq'] && $this->memberConfig['dormancy']) {
			// 휴먼 해제 방법별 처리 후 페이지 이동
			$dormancyResult = $this->ci->memberlibrary->inactiveDormant($member['member_seq'], $this->memberConfig['dormancy']);

            return $this->errorResult($dormancyResult['msg']);
		}

        // SNS 로그인 정보 중에 이메일 또는 휴대전화가 변경되면 회원정보 업데이트
        $updateInfo = [];
        if ($params['email'] && $member['email'] != $params['email'])
            $updateInfo['email'] = $params['email'];
        if ($params['cellphone'] && $member['cellphone'] != $params['cellphone'])
            $updateInfo['cellphone'] = $params['cellphone'];

        if ($updateInfo['email'] || $updateInfo['cellphone']) {
            $this->ci->membermodel->update_member($updateInfo);
            $this->ci->membermodel->update_private_encrypt($member['member_seq']);
        }

        // 로그인 이력 처리
        $this->ci->memberlibrary->make_login_history($member['member_seq']);

        // SNS 추가 연동 정보 저장 처리
        $this->saveSocialAddition($params, $this->socialClient->getKey(), $member);

        // 회원 로그인 세션 생성
        create_member_session($member);

        // 사용자앱 설치 쿠폰 발행
        if (checkUserApp(getallheaders())) {
            $this->ci->load->model('couponmodel');
            $this->ci->couponmodel->downloadAppInstallCoupons($member['member_seq']);
        }

        // 성인인증세션 처리
        $this->ci->session->unset_userdata('auth_intro');
        $_SESSION['auth_intro']	= '';
        if($member['adult_auth'] == 'Y'){
            $this->ci->session->sess_expiration = (60 * 5);
            $this->ci->session->set_userdata(['auth_intro' => ['auth_intro_type'=>'auth', 'auth_intro_yn'=>'Y']]);
        }

        // 장바구니 목록 합치기
        $this->ci->load->model('cartmodel');
        $this->ci->cartmodel->merge_for_member($member['member_seq']);

        // 페이스북 좋아요 할인 합치기
        $this->ci->db->where('session_id',session_id());
        $this->ci->db->update('fm_goods_fblike', ['member_seq' => $member['member_seq']]);

        // 고객리마인드서비스 : 상세유입로그
        $this->ci->load->helper('reservation');
        curation_log(["action_kind" => "login_sns"]);

        // 페이스북, 트위터 기본앱 종료로 인해 기본앱 사용중인 경우 로그인 시 전용앱으로 타입값 업데이트 처리
        if ($this->isSharedApp($params['rute'], $member[$this->socialClient->getAppKey()])) {
            $this->setSocialAppType($params['rute'], $member['member_seq']);
        }

        // 로그인 완료 기본 문구 빈 값 처리
        $msg = '';

        // 출석체크 이벤트 처리
        $this->ci->load->model('joincheckmodel');
        $joinCheck = $this->ci->joincheckmodel->login_joincheck($member['member_seq']);
        if ($joinCheck['code'] == 'success' ||  $joinCheck['code'] == 'emoney_pay') {
            $msg = $joinCheck['msg'];
        }

        // 앱 자동 로그인 처리
        sendAutoLoginEvent($member);

        // 로그인 성공 결과값 리턴
        return $this->successResult($msg);
    }

    // 회원가입 처리
    public function join($params) {
        // 기본 리다이렉트 주소
        $redirectUrl = '/member/agreement?join_type='.$this->socialClient->getPrefix().'member';

        // 회원 정보 조회
        $member = $this->getMemberData($params);

        // 회원 정보가 있는 경우 블락처리
        if ($member) {
            // 기본 메세지 설정
            $message = '이미 가입된 계정입니다\n다른 계정으로 가입해 주세요.';

            // 가입 승인이 안되어있는 경우
            if ($member['status'] === 'hold') {
                // 님은 아직 가입승인되지 않았습니다.
                $message = $member['user_name'].getAlert('mb104');
            }
            return $this->errorResult($message, $redirectUrl);
        }

        // SNS 연동 아이디가 이미 있는 경우 SNS Prefix 값을 붙여 중복 해결
        if ($this->ci->membermodel->countMemberByUserId($params['userid']) > 0) {
            $params['userid'] = $this->socialClient->getPrefix() . '_' . $params['userid'];
        }

        // 닉네임은 10자까지 제한하여 잘라버림
        if ($params['nickname'] && mb_strlen($params['nickname'],'utf-8') > 10) {
            $params['nickname'] = substr($params['nickname'],0,10);
        }

        // 이름이 없는 경우 `고객`으로 하드코딩
		if (!$params['user_name']) {
			$params['user_name'] = '고객';
		}

        // 닉네임이 없는 경우 `고객`으로 하드코딩
        if (!$params['nickname']) {
            $params['nickname'] = '고객';
        }

        // 만 14세 가입 체크
        $kidAgreeCheck = $this->socialSession['kid_agree_check'];
        if(isset($kidAgreeCheck)){
            $params['kid_agree'] = $kidAgreeCheck;
            $params['kid_auth'] = $kidAgreeCheck;

            // 만 14세 미만 미인증시 가입 상태 '미승인'
            if($params['kid_auth'] == 'N'){
                $params['status'] = 'hold';
            }
        }

        // 회원가입 추가 정보 세팅
		$params['group_seq'] = '1';
		$params['password']	= md5($params['password']);
		$params['marketplace'] = !empty($_COOKIE['marketplace']) ? $_COOKIE['marketplace'] : ''; //유입매체
		$params['referer'] = $_COOKIE['shopReferer'];
		$params['referer_domain'] = $_COOKIE['refererDomain'];
		$params['user_icon'] = 1;
		$params['lastlogin_date'] = date('Y-m-d H:i:s');
		$params['platform']	= $this->getPlatform();
        $params['password_update_date'] = date("Y-m-d");

		// 본인인증 여부
        $auth = $this->socialSession['auth'];
		if ($auth && $auth['auth_yn']) {
			$params['auth_type'] = $auth['namecheck_type'];
			$params['auth_code'] = $auth['namecheck_check'];

            // 아이핀, 휴대폰 인증일 때 {"ipin", "phone"}
			if ($params['auth_type'] != "safe") {

				// 실명인증 중복 가입 체크
                $member = $this->ci->membermodel->countMemberAuthChecked($auth["namecheck_check"]);

                // 이미 인증 된 정보가 있는 경우 세션 삭제 후 리턴
				if($member["cnt"] > 0) {
					$this->session->unset_userdata('auth');
					$_SESSION['auth'] = '';
					return $this->errorResult('이미 가입된 정보입니다.<br>로그인해 주세요.', $redirectUrl);
				}

                $params['auth_vno']		= $auth['namecheck_vno'];
			} else {
				$params['auth_vno']		= $auth['namecheck_key'];
			}
		}

		// 본인인증을 통해 가입했는지 확인
		if($this->socialSession['auth_intro']['auth_intro_yn'] == 'Y'){
			$params['adult_auth']	= 'Y';
		}

		// 페이스북, 트위터 연동일 경우 각 앱 설정 변수 추가
		// 기존에 있던 기본앱 지원 종료로 값을 전용앱으로 고정
		if ($params['rute'] == 'facebook') {
			$params['sns_f_type'] = 1;
		} else if ($params['rute'] == 'twitter') {
			$params['sns_t_type'] = 1;
		}

		// 사용자앱 API KEY 생성
        $this->ci->load->model('appmembermodel');
		$params['api_key'] = $this->ci->appmembermodel->create_api_key($params['userid']);

		// 회원 정보 추가
		$memberSeq = $this->ci->membermodel->insert_member($params);
        $params['member_seq'] = $memberSeq;

        // 회원 정보 저장 실패 시
        if (!$memberSeq) {
            return $this->errorResult('가입 실패 하였습니다.', $redirectUrl);
        }

		// SNS 회원가입 정보 추가
		$this->saveSocialAddition($params, $this->socialClient->getKey());

        // 회원 가입 통계 저장
        $this->ci->load->model('statsmodel');
        $this->ci->statsmodel->insert_member_stats($memberSeq,$params['birthday'],$params['address'],$params['sex']);

        // 기업회원 인 경우 추가 저장
        if($params['mtype'] === 'business'){
            $bdata = filter_keys($params, $this->ci->db->list_fields('fm_member_business'));
            $this->db->insert('fm_member_business', $bdata);
        }

        // 회원 정보 암호화 처리
        $this->ci->membermodel->update_private_encrypt($memberSeq);

        // 가입 혜택 관련 메세지
        $resultMessages = [];

        // 가입 시 자동 승인인 경우
        if ($params['status'] == 'done') {
            $this->ci->load->model('emoneymodel');
            $this->ci->load->model('pointmodel');

            $reserve = config_load('reserve');

            // 특정기간 혜택 제공 조건 체크
            if ($this->memberConfig['start_date'] && $this->memberConfig['end_date']) {

                // 기간 안에 가입이 완료되면 기존 마일리지, 포인트를 무시하고 특정 기간 혜택 값으로 치환
                $today = date("Y-m-d");
                if($today >= $this->memberConfig['start_date'] && $today <= $this->memberConfig['end_date']){
                    $this->memberConfig['emoneyJoin'] = $this->memberConfig['emoneyJoin_limit'];
                    $this->memberConfig['pointJoin'] = $this->memberConfig['pointJoin_limit'];
                }
            }

            // 회원 가입 설정에 마일리지 지급 설정 된 경우
            if ($this->memberConfig['emoneyJoin'] > 0) {
                // 마일리지 테이블에 지급 데이터 신규 저장
                $emoney = [
                    'type' => 'join',
                    'emoney' => $this->memberConfig['emoneyJoin'],
                    'gb' => 'plus',
                    'memo' => '회원 가입 마일리지',
                    'memo_lang' => $this->ci->membermodel->make_json_for_getAlert("mp288"), // 회원 가입 마일리지
                    'limit_date' => get_emoney_limitdate('join'),
                ];
                $this->ci->membermodel->emoney_insert($emoney, $memberSeq);

                // 마일리지 '.$this->memberConfig['emoneyJoin'].'원
                $resultMessages['emoneyJoin'] = getAlert('mb230', $this->memberConfig['emoneyJoin']);
            }

            // 회원 가입 설정에 포인트 지급 설정 된 경우
            // 포인트 설정에 사용함 인 경우
            if ($this->memberConfig['pointJoin'] > 0 && $reserve['point_use'] === 'Y') {
                // 마일리지 테이블에 지급 데이터 신규 저장
                $point = [
                    'type' => 'join',
                    'point' => $this->memberConfig['pointJoin'],
                    'gb' => 'plus',
                    'memo' => '회원 가입 포인트',
                    'memo_lang' => $this->ci->membermodel->make_json_for_getAlert("mp289"), // 회원 가입 포인트
                    'limit_date' => get_point_limitdate('join'),
                ];
                $this->ci->membermodel->point_insert($point, $memberSeq);

                //포인트 '.$this->memberConfig['emoneyJoin'].'P'
                $resultMessages['pointJoin'] = getAlert('mb231', $this->memberConfig['pointJoin']);
            }
        }

        // 발급 된 쿠폰 수
        $couponCount = 0;

        // 신규회원가입 쿠폰 발급
        $this->ci->load->model('couponmodel');
        $couponCount = $this->ci->couponmodel->downloadMemberJoinCoupons($memberSeq);

        // 사용자앱 설치 쿠폰 발급
        if(checkUserApp(getallheaders())){
            $couponCount = $this->ci->couponmodel->downloadAppInstallCoupons($memberSeq);
        }

        // 쿠폰 발행 건이 있는 경우 메세지 추가
        if ($couponCount > 0) {
            // 회원가입 쿠폰이 발행 되었습니다.
            $resultMessages['coupon_msg'] = getAlert('mb219');
        }

        // 회원가입 문자, 이메일 알림 처리
        $commonSmsData = [];
        $commonSmsData['join']['phone'][] = $params['cellphone'];
        $commonSmsData['join']['params'][] = $params;
        $commonSmsData['join']['mid'][] = $params['userid'];
        commonSendSMS($commonSmsData);
        sendMail($params['email'], 'join', $params['userid'], $params);

        // 회원 가입 기본 메세지
        // 가입 되었습니다.
        $message = getAlert('mb221');

		// 쿠폰 메세지
		$message .= "\n".$resultMessages['coupon_msg'];
		// 가입 '.$resultMessages['emoneyJoin'].' '.$resultMessages['pointJoin'].' 지급되었습니다.
		if ($resultMessages['emoneyJoin']) {
            $message .= getAlert('mb222', [$resultMessages['emoneyJoin'], $resultMessages['pointJoin']]);
        }
		// 추천 '.$resultMessages['emoneyJoiner'].' '.$resultMessages['pointJoiner'].' 지급되었습니다
		if ($resultMessages['emoneyJoiner']) {
            $message .= getAlert('mb223', [$resultMessages['emoneyJoiner'], $resultMessages['pointJoiner']]);
        }
		// 초대 '.$resultMessages['emoneyInvitees'].' '.$resultMessages['pointInvitees'].' 지급되었습니다
		if ($resultMessages['emoneyInvitees']) {
            $message .= getAlert('mb224', [$resultMessages['emoneyInvitees'], $resultMessages['pointInvitees']]);
        }

        // 로그인 처리
        $loginResult = $this->login($params);

        // 로그인 처리 후 추가 메세지가 있는 경우 메세지 추가
        if ($loginResult['msg']) {
            $message .= "\n" . $loginResult['msg'];
        }

        // 결과 페이지 주소 변경
        $redirectUrl = '/member/register_ok';

        // 만 14세 가입 시 동의 미체크인 경우 결과 페이지에 파라미터 추가
        if($params['kid_auth'] == 'N'){
            $message = $params['user_name'].getAlert('mb104');
            $redirectUrl .= '?kid_auth=N';
        }

        return $this->successResult($message, $redirectUrl);
    }

    // 로그인 통합 처리
    public function integrate($params) {
        // 기본 리다이렉트 주소
        $redirectUrl = '/mypage/myinfo';

        // 회원 정보 조회
        $member = $this->getMemberData($params);

        // 이미 회원 정보가 있는 경우
        if ($member) {
            return $this->errorResult('이미 연동 된 계정입니다', $redirectUrl);
        }

        // 현재 로그인 되어있는 회원 고유번호
        $memberSeq = $this->ci->userInfo['member_seq'];

        // 세션에 로그인 된 회원 고유번호가 없는 경우
        if (!$memberSeq) {
            // 현재 세션아이디값을 가진 sns 연동 회원 정보 조회
			$memberSocialJoin = get_data('fm_membersns_join', ['session_id'=>session_id()]);
			$memberSocialJoin 	= $memberSocialJoin[0];
            $memberSeq = $memberSocialJoin['member_seq'];
        }

        // 현재 로그인 되어있는 회원 정보 조회
        $member = get_data('fm_member', ['member_seq' => $memberSeq]);
        $member = $member[0];

        // 회원 정보가 없는 경우
        if (!$member) {
            return $this->errorResult(getAlert('mb091'), $redirectUrl);
        }

        // 회원 정보에 sns_{sns 키} 컬럼에 값을 업데이트
        $snsKey = $this->socialClient->getKey();
        $updateParam = [
            'member_seq' => $member['member_seq'],
            $snsKey => $params[$snsKey]
        ];
        $this->ci->membermodel->update_member($updateParam);

        // fm_membersns 테이블에 추가 또는 갱신처리
        $this->saveSocialAddition($params, $snsKey, $member);

        // 기본 메세지 설정 후 성공 처리
        $message = "연결되었습니다.";

        return $this->successResult($message, $redirectUrl);
    }

    // 회원정보 조회
    private function getMemberData($param) {
        // 네이버의 경우에는 아이디 정책이 바뀌어 기존 회원정보 마이그레이션 작업 후 회원정보를 리턴
        if ($this->socialType === NaverClient::class) {
            return $this->migrationMemberDataForNaver($param['sns_n'], $param['sns_n_old']);
        }

        $key = $this->socialClient->getKey();
        return $this->ci->membermodel->getMemberBySns($key, $param[$key]);
    }

    // 가입 플랫폼 처리
    private function getPlatform() {
        $platform	= 'P';
		if		($this->fammerceMode || $this->storefammerceMode)	$platform	= 'F';
		elseif	($this->_is_mobile_app_agent_android)		$platform	= 'APP_ANDROID';
		elseif	($this->_is_mobile_app_agent_ios)		$platform	= 'APP_IOS';
		elseif	($this->mobileMode || $this->storemobileMode)		$platform	= 'M';

        return $platform;
    }

    /**
	 * SNS 연동 정보 저장 fm_membersns
     * fm_membersns 테이블은 공용 SNS 키 저장 컬럼명으로 `sns_f`을 사용
	 *
	 * @param $mbinfo : 가입이 아닌 기존 계정에 통합인 경우 이 변수로 회원 정보 넘어옴
	 */
	private function saveSocialAddition($params, $snstype = 'sns_f', $mbinfo = null ) {
		if (!$params[$snstype]) return '';

		// SNS 가입 정보 조회
		$where_arr = ['sns_f' => $params[$snstype], 'rute' => $params['rute']];
		$snsmbdata = get_data('fm_membersns', $where_arr);
		$snsmbparams = $snsmbdata[0];

		// 기존 SNS 가입 정보가 있는 경우 업데이트
		if ($snsmbparams) {
			// 회원 정보 업데이트 항목
			$updateParam = [
				"user_name" => $params['user_name'],
				"email" => $params['email'],
				"sex" => $params['sex'],
				"birthday" => $params['birthday'],
				"member_seq" => $mbinfo['member_seq'],
			];

			// 회원 seq가 있는 경우 해당 seq로 업데이트
			if ($params['member_seq']) $updateParam['member_seq'] = $params['member_seq'];

			// fm_membersns는 각 SNS 별 연동아이디를 sns_f 컬럼으로 통일되어있음
			$this->ci->db->where(['sns_f' => $params[$snstype], 'rute' => $params['rute']]);
			$this->ci->db->update('fm_membersns', $updateParam);
		} else {
			// 가입이 아닌 기존 계정에 통합인 경우 $mbinfo 에 seq로 치환
			if ($mbinfo['member_seq']) $params['member_seq'] = $mbinfo['member_seq'];

			// 연동 정보 insert
			$params['sns_f'] = $params[$snstype];
			$data = filter_keys($params, $this->ci->db->list_fields('fm_membersns'));
			$this->ci->db->insert('fm_membersns', $data);
		}

		$memberSeq = ($mbinfo['member_seq']) ? $mbinfo['member_seq'] : $params['member_seq'];
		$this->saveSocialAdditionJoin($memberSeq);
	}

	// SNS 연동 정보 저장 fm_membersns_join
	private function saveSocialAdditionJoin($memberSeq) {
		$where = ['session_id' => session_id()];
		$snsJoinData = get_data('fm_membersns_join', $where);
		$snsJoinData = $snsJoinData[0];

        // 연동 정보가 있는 경우 업데이트
		if ($snsJoinData) {
			$this->ci->db->where('session_id', session_id());
			$this->ci->db->update('fm_membersns_join', ["member_seq" => $memberSeq, "session_id" => session_id(), "update_date" => date('Y-m-d H:i:s')]);
		} else {
            // 기존 회원 번호로 되어있는 데이터를 지우고 새로 저장
			$this->ci->db->delete('fm_membersns_join', ['member_seq' => $memberSeq]);

            $param = [
                'member_seq' => $memberSeq,
                'session_id' => session_id(),
                'regist_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
            ];
			$data = filter_keys($param, $this->ci->db->list_fields('fm_membersns_join'));
			$this->ci->db->insert('fm_membersns_join', $data);
		}
	}

    // 네이버 연동 기존 회원 데이터 조회
	// 이전에 네이버 연동 시 enc_id(공통회원인증키) 인 경우 개별 인증키로 치환
	public function migrationMemberDataForNaver($sns_n, $sns_n_old = ''){
		if (!$sns_n) return null;

		// 네이버 연동 id 검색 조건
		$where_in = [$sns_n];
		if ($sns_n_old) $where_in[] = $sns_n_old;

		// 네이버 연동 회원 정보 조회
		$this->ci->db->from('fm_member');
		$this->ci->db->where('status !=', 'withdrawal');
		$this->ci->db->where_in('sns_n', $where_in);
		$data = $this->ci->db->get()->row_array();

		// 회원 정보 없는 경우
		if (!$data) return null;

		// SNS 연동 정보 조회
		$datasns = $this->ci->db->select('sns_f')
				->from('fm_membersns')
				->where('member_seq', $data['member_seq'])
				->get()
				->row_array();

		// 등록된 네이버 id가 end_id(공통회원인증키)일 경우 id(client id별 회원인증키)로 변경.
		if(strlen($data['sns_n']) > 20){
			$this->ci->db->where('member_seq', $data['member_seq']);
			$this->ci->db->update('fm_member', ["sns_n" => $sns_n]);
		}

		if(strlen($datasns['sns_f']) > 20){
			$this->ci->db->where('member_seq', $data['member_seq']);
			$this->ci->db->update('fm_membersns', ["sns_f" => $sns_n]);
		}

		return $data;
	}

    // 기본앱 여부 확인
    private function isSharedApp($rute, $socialKey) {
        switch ($rute) {
            case 'facebook':
                return $this->isSharedFacebookApp($socialKey);
            case 'twitter':
                return $this->isSharedTwitterApp($socialKey);
            default:
                break;
        }
    }

    // 페이스북 기본앱 여부
    private function isSharedFacebookApp($socialKey) {
        $targetKey = '455616624457601';
        return $socialKey === $targetKey;
    }

    // 트위터 기본앱 여부
    private function isSharedTwitterApp($socialKey) {
        $targetKey = 'ifHWJYpPA2ZGYDrdc5wQ';
        return $socialKey === $targetKey;
    }

    // 기본앱 지원종료로 인해 SNS 연동 타입이 기본앱으로 설정되어있는 경우 전용앱으로 타입 변경
    private function setSocialAppType($rute, $memberSeq) {
        switch ($rute) {
            case 'facebook':
                return $this->setFacebookSocialAppType($memberSeq);
            case 'twitter':
                return $this->setTwitterSocialAppType($memberSeq);
            default:
                break;
        }
    }

    // 페이스북 기본앱 -> 전용앱 설정 변경
    private function setFacebookSocialAppType($memberSeq) {
        $this->ci->membermodel->setSocialAppType($memberSeq, 'sns_f_type');
	}

    // 트위터 기본앱 -> 전용앱 설정 변경
    private function setTwitterSocialAppType($memberSeq) {
        $this->ci->membermodel->setSocialAppType($memberSeq, 'sns_t_type');
	}

    // 현재 요청에 대한 세션값 가져오기
    private function getSocialSession() {
        // SNS 로그인 관련 파라미터
        $mtype = $this->ci->session->userdata('mtype');
        $mform = $this->ci->session->userdata('mform');
        $facebooktype = $this->ci->session->userdata('facebooktype');
        $auth = $this->ci->session->userdata('auth');
        $auth_intro = $this->ci->session->userdata('auth_intro');
        $kid_auth = $this->ci->session->userdata('kid_auth');
        $kid_agree = $this->ci->session->userdata('kid_agree');
        $kid_agree_check = $this->ci->session->userdata('kid_agree_check');
        $skin_patch_14years_old = $this->ci->session->userdata('skin_patch_14years_old');

        return [
            'mtype' => $mtype,
            'mform' => $mform,
            'facebooktype' => $facebooktype,
            'auth' => $auth,
            'auth_intro' => $auth_intro,
            'kid_auth' => $kid_auth,
            'kid_agree' => $kid_agree,
            'kid_agree_check' => $kid_agree_check,
            'skin_patch_14years_old' => $skin_patch_14years_old,
        ];
    }

    // 현재 요청을 파싱하여 전역 변수에 세팅
    private function parseSocialSession() {
        // 기본값은 로그인 요청
        $requestType = 'login';

        // 회원가입인 경우
        if ($this->socialSession['mform'] == 'join') {
            $requestType = 'join';
        }

        // 일반 로그인 상태에서 SNS 회원 통합인 경우
        if ($this->socialSession['facebooktype'] == 'mbconnect_direct') {
            $requestType = 'myinfo';
        }

        return $requestType;
    }

    // 현재 클라이언트의 세션 파기 처리
    private function destroySocialSession() {
        $sessionKeys = $this->socialClient->getSessionKeys();
        $this->ci->session->unset_userdata($sessionKeys);
        foreach ($sessionKeys as $sessionKey) {
            unset($_SESSION[$sessionKey]);
        }
    }

    // 성공 결과 리턴 함수
    private function successResult($message, $redirectUrl = '/') {
        return [
            'result' => true,
            'msg' => $message,
            'redirectUrl' => $redirectUrl,
        ];
    }

    // 오류 결과 리턴 함수
    private function errorResult($message, $redirectUrl = '/') {
        // 오류 시 세션 파기
        $this->destroySocialSession();

        // 실패 결과값 리턴
        return [
            'result' => false,
            'msg' => $message,
            'redirectUrl' => $redirectUrl,
        ];
    }

    /**
     * 클라이언트를 생성할 때 ClientRequestData 클래스 생성
     *
     * @param socialConfig [DB] fm_config 'snssocial' 값
     * @param memberConfig [DB] fm_config 'member' 값
     * @param socialRequest [REQUEST] 컨트롤러에서 넘겨준 get, post 객체
     * @param socialSession [SESSION] 현재 요청 관련 세션
     */
    private function createSocialClientConfig() {
        return new ClientRequestData($this->socialConfig, $this->memberConfig, $this->socialRequest, $this->socialSession);
    }
    

    // SNS 클라이언트 객체 리플렉션
    /**
     * [생성할 수 있는 클라이언트 목록]
     * FacebookClient
     * TwitterClient
     * AppleClient
     * NaverClient
     * KakaoClient
     */
    private function createSocialClient() {
        // ClientRequestData 클래스를 인자값으로 세팅
        $parameters = [$this->createSocialClientConfig()];

        try {
            // 리플렉션 클래스를 통해 클라이언트 생성
            $ref = new ReflectionClass($this->socialType);

            return $ref->newInstanceArgs($parameters);
        } catch (\ReflectionException $e) {
            throw new SocialManagerException('지원하지 않는 SNS 클라이언트 입니다.');
        }

    }
}

class SocialManagerException extends \Exception{

}