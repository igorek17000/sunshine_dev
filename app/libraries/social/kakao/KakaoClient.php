<?php
/**
 * 카카오 연동 클라이언트
 * 해당 클라이언트 클래스를 통해 카카오 연동 관련 기능을 제공
 * Client 추상메소드를 재정의 하여 사용
 *
 * @author pjw <pjw@gabiacns.com>
 */

namespace App\Libraries\Social\Kakao;

use App\Libraries\Social\Client;
use App\Libraries\Social\ClientRequestData;
use App\Libraries\Social\Kakao\Sdk\KakaoService;

class KakaoClient extends Client
{
    public function __construct(ClientRequestData $clientRequestData)
    {
        $config = new KakaoConfig($clientRequestData);
        $instance = new KakaoService($config->getAllConfig());
        parent::__construct($config, $instance);
    }

    // 인증 URL 생성
    public function getAuthorizeUrl() {
        return $this->instance->getKakaoLoginLink();
    }

    // 인증 처리
    public function authenticate() {
        // 액세스 토큰 발급
        $accessToken = $this->getAccessToken();

        // 인증 실패
        if (!$accessToken) {
            return $this->errorResult(getAlert('mb091'));
        }

        // 토큰 값이 없는 경우
        if( !$accessToken['access_token'] || !$accessToken['refresh_token']) {
            //잘못된 접근입니다. 브라우저를 새로고침 후 다시 로그인 해주세요.
            return $this->errorResult(getAlert('mb116'));
        }

        // 토큰 값이 있으면 회원 정보 가져오기
        $kakaoUser = $this->getProfile();

        // 로그인, 회원가입에 사용할 파라미터 생성
        $facebookMemberData = [
            'userid' => 'kko_'.$kakaoUser['id'],
            'user_name' => $kakaoUser['properties']['nickname'],
            'nickname' => $kakaoUser['properties']['nickname'],
            'sns_k' => $kakaoUser['id'],
        ];

        // 신규 값을 추가하고 전체 회원 정보를 반환받는다
        $data = $this->config->addMemberData($facebookMemberData);

        // 닉네임 10자 자르기
        if($data['nickname'] && mb_strlen($data['nickname'],'utf-8') > 10) {
            $data['nickname'] = substr($data['nickname'], 0, 10);
        }

        // 세션에 저장할 데이터 생성
        $sessions = [
            'snslogn' => 'kakao',
            'kkouser' => [
                'id' => $kakaoUser['id'],
                'nickname' => $kakaoUser['properties']['nickname'],
            ],
        ];

        // 연동 정보를 리턴
        return $this->successResult($data, $sessions);
    }

    // 액세스 토큰 발급
    public function getAccessToken() {
        $tokenResult = $this->instance->getToken();
        return $tokenResult;
    }

    // 유저 프로필 조회
    public function getProfile() {
        return $this->instance->getProfile();
    }

    // 카카오에서 사용하는 세션 키 목록
    public function getSessionKeys() {
        return [
            'snslogn',
            'kkouser',
        ];
    }
}