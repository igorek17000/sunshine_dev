<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
require_once(APPPATH ."controllers/base/common_base".EXT);

use App\Errors\AuthenticateRequiredException;

class admin_base_original extends common_base {
	var $AdminMenu			= array();
	var $skin;
	var $managerInfo;
	var $auth_msg			= "권한이 없습니다.";

	public function __construct(array $options = []) {
		define('__ADMIN__',true);//관리자페이지

		parent::__construct();
		$this->load->model('managermodel');
		checkEnvironmentValidation();

		// 한글도메인으로 관리자페이지 접근시 임시도메인으로 무조건 이동 (2017-09-27 15:47  채우형)
		if(preg_match('/^(https?:\/\/)xn--(.*)([\/\?].*)$/Ui', base_url(), $find)) {
			header("Progma:no-cache");
			header("Cache-Control:no-cache,must-revalidate");
			header('Location: '.preg_replace('/^(https?:\/\/)(xn--.*)([\/\?].*)$/Ui', '${1}'.$this->config_system['subDomain'].'$3', current_url()));
		}

		/* 만기도래 체크(로그인화면 제외) */
		$file_path = $this->config_system['adminSkin']."/common/blank.html";
		$this->template->define(array('warningScript'=>$file_path));
		if(!preg_match("/^admin\/login(^_)*/",uri_string()) && !preg_match("/^admin\/main_index/",uri_string()) && uri_string()!='admin'){
			warningExpireDate();
		}

		### 데모세션처리
		$this->demo = false;
		$this->set_demo();

		/* 현재 언어 저장 */
		$this->template->assign(array('language'=>$this->config->item('language')));

		$auto_logout = config_load('autoLogout');
		$this->template->assign(array('autoLogout'=>$auto_logout));

		$this->skin = $this->config_system['adminSkin'];

		/* PC용 스킨 */
		$this->realSkin = isset($this->config_system['skin']) ? $this->config_system['skin'] : null;
		$this->workingSkin = isset($this->config_system['workingSkin']) ? $this->config_system['workingSkin'] : null;

		/* 모바일용 스킨 */
		$this->realMobileSkin = isset($this->config_system['mobileSkin']) ? $this->config_system['mobileSkin'] : null;
		$this->workingMobileSkin = isset($this->config_system['workingMobileSkin']) ? $this->config_system['workingMobileSkin'] : null;

		/* 페이머스용 스킨 */
		$this->realFammerceSkin = isset($this->config_system['fammerceSkin']) ? $this->config_system['fammerceSkin'] : null;
		$this->workingFammerceSkin = isset($this->config_system['workingFammerceSkin']) ? $this->config_system['workingFammerceSkin'] : null;

		/* 아이디자인에서 처리할 스킨 */
		if		($this->mobileMode)		$this->designWorkingSkin = $this->workingMobileSkin;
		elseif	($this->fammerceMode)	$this->designWorkingSkin = $this->workingFammerceSkin;
		else 							$this->designWorkingSkin = $this->workingSkin;

		### MANAGER SESSION
		$this->managerInfo = $this->session->userdata('manager');
		$this->template->assign(array('managerInfo' => $this->managerInfo));

		### 중요알림
		if(!is_file($this->managermodel->cach_file_path)) $this->managermodel->make_action_alert_cache();
		if( date("Y-m-d H:i:s.", fileatime($this->managermodel->cach_file_path)) < date("Y-m-d H:i:s.", strtotime("-4 hours"))  ) $this->managermodel->make_action_alert_cache();
		$action_history_data = json_decode(file_get_contents($this->managermodel->cach_file_path),true);
		$this->template->assign(array('action_history_data'=>$action_history_data));

		### 관리자 접속IP 체크
		$this->load->model('protectip');
		$this->protectip->protect_ip_admin($this->managerInfo['manager_seq']);

		### PROVIDER SESSION
		$this->providerInfo = $this->session->userdata('provider');
		$this->template->assign(array('providerInfo' => $this->providerInfo));

		### ADMIN SESSION TYPE
		if($this->managerInfo) $this->adminSessionType = 'manager';
		else if($this->providerInfo) $this->adminSessionType = 'provider';
		$this->template->assign(array('adminSessionType' => $this->adminSessionType));

		$admin_access_confirm			= false;
		$admin_access_confirm_arr		= array('login','logout','facebook');
		foreach($admin_access_confirm_arr as $_page) if( strpos($this->template_path(),$_page)) $admin_access_confirm = true;

		### 입점사관리자 접근허용 페이지
		$selleradmin_access_confirm_arr = array('searchform','gl_select_goods','gl_select_gift','gl_select_category');
		foreach($selleradmin_access_confirm_arr as $_page) if( strpos($this->template_path(),$_page) && $this->providerInfo['provider_seq']) $admin_access_confirm = true;

		### 관리자 로그인 정보 없을 시 로그인페이지로 이동 
		if (! isset($this->managerInfo['manager_seq']) ) {
			if( !$admin_access_confirm ){
				if((stristr($this->template_path(),'_process') ||stristr($this->template_path(),'webftp') || stristr($this->template_path(),'design')) && stristr( $this ->input->user_agent(),'shockwave') )
				{
					// 디자인관리에서 Uploadify(플래시)를 통해서 업로드할 경우 세션체크가 안되므로 풀어줌.
				}elseif($this->session->userdata('marketing') && stristr($this->template_path(),'marketplace')) {
					// 마케팅관리아이디 로그인상태일때 마케팅페이지 풀어줌
				}elseif(stristr($this->template_path(),'benifit')) {
					// 혜택바로가기 레이어 팝업이므로 풀어줌
				}elseif(stristr($this->template_path(),'upload_file')) {
					//맥북 shockwave session 체크 못하기 때문에 상품이미지 업로드 풀어줌
				}elseif($this->uri->segment(1) == 'cli') {
				}else{
					if($options['useException']) {
						throw new AuthenticateRequiredException;
					}
					else {
						if($_SERVER['REQUEST_METHOD']=='GET'){
							redirect("/admin/login/index?return_url=".urlencode($_SERVER['REQUEST_URI']));
							exit;
						}else{
							redirect("/admin/login/index");
							exit;
						}
					}
				}
			}
		} else {
			$this->load->model('authmodel');
			$result = $this->authmodel->manager_limit_view($this->template_path());
			//echo $result." : ".$this->template_path();
			if(!$result) pageBack("권한이 없습니다.");

			if($result && $this->uri->segment(1) == 'cli') {
				$referer_path = parse_url($_SERVER['HTTP_REFERER']);
				$referer_path = array_filter(explode("/", $referer_path['path']));
				if($referer_path[1] == "admin"){
					$this->is_excel_admin = "Y";
				} else if($referer_path[1] == "selleradmin"){
					$this->is_excel_admin = "N";
				} else {
					pageBack("잘못 된 접근 입니다.");
				}
			}
		}

		/* 사용 도메인 정의 */
		$host = $_SERVER['HTTP_HOST'];
		$host = preg_replace('/^m\./','', $host);
		$this->pcDomain = $host;
		$this->template->assign('pcDomain',$this->pcDomain);
		if($this->config_system['operation_type'] == 'light')	$this->mobileDomain = $host;
		else													$this->mobileDomain = "m.".preg_replace("/^www\./","",$host);
		$this->template->assign('mobileDomain',$this->mobileDomain);

		/* 페이스북 연결 여부 */
		$page_id_f_ar				= (isset($this->arrSns['page_id_f']))?explode(",",$this->arrSns['page_id_f']):'';
		$page_name_ar			= (isset($this->arrSns['page_name_f']))?explode(",",$this->arrSns['page_name_f']):'';
		$page_url_ar				= (isset($this->arrSns['page_url_f']))?explode(",",$this->arrSns['page_url_f']):'';
		$page_app_link_f_ar	= (isset($this->arrSns['page_app_link_f']))?explode(",",$this->arrSns['page_app_link_f']):'';
		if($page_id_f_ar){
			foreach($page_id_f_ar as $pagen=>$v) {
				if($page_id_f_ar[$pagen] && $page_app_link_f_ar[$pagen]) {
					$this->template->assign('facebookConnected',1);
					$this->template->assign('facebookapp_url',str_replace("]","",str_replace("[","",$page_app_link_f_ar[$pagen])));
					break;
				}
			}
		}
		$cfg_goods = config_load("goods");
		if( $cfg_goods['ucc_id'] && $cfg_goods['ucc_domain'] && $cfg_goods['ucc_key'] ) {
			$this->template->assign('video_use',1);
		}

		$auth_arr = explode("||",$this->managerInfo['manager_auth']);
		foreach($auth_arr as $k){
			$tmp_arr = explode("=",$k);
			$auth[$tmp_arr[0]] = $tmp_arr[1];
		}

		if($auth['member_view'] == "Y") $crmLayerView = "Y";
		$this->template->assign('crmLayerView',$crmLayerView);

		# 관리환경 리스트
		$this->template->assign('config_admin_env',$this->config_admin_env);

		/* 비밀번호 체크 */
		$this->template->assign('is_change_pass_required',$this->session->userdata('is_change_pass_required'));
		$this->template->assign('is_change_pass',$this->session->userdata('is_change_pass_required'));


		$firstmallplusservice = $this->skin."/_modules/layout/firstmallplusservice.html";
		$this->template->define(array('firstmallplusservice'=>$firstmallplusservice));

		$this->template->assign(array('designWorkingSkin'=>$this->designWorkingSkin));

		/*데모 사이트 체크*/

		//입점몰 체크 보안키 로그인 체크
		$adCheck = serviceLimit('H_AD');

		if($this->demo){
			$this->demoFunctionChk = true;
			if($adCheck){
				$this->demoChk = true;
			}
		}

		$this->template->assign('demoChk',$this->demoChk);
		$this->template->assign('functionLimit',$this->demoFunctionChk);
		if($this->demoFunctionChk) $this->demoFunctionCheck(uri_string());

		/*데모 사이트 체크*/

		// 마이퍼스트몰 상세링크를 위한 샵번호 인코딩.. :: 2019-08-26 pjw
		$this->template->assign('enc_shopsno', optimusEncode($this->config_system['shopSno']));

		// 관리자별 저장된 관리자 스킨 버전 정보 가져오기
		$this->load->model("admin_menu");
		$this->template->assign(array(
									'admin_skin_type' => $this->admin_menu->admin_skin_type,
									'admin_skin_user_type' => getAdminSkinUserType()
									)
								);
	}

	// 관리자 메뉴 로딩
	public function admin_menu(){
		$this->load->model("admin_menu");
		$adminMenuCurrent = $this->uri->rsegments[1];
		$adminSubMenuCurrent = $this->uri->rsegments[2];	
	
		// 배송그룹 입점사용메뉴고정 :: 2017-09-18 lwh
		if	(($this->uri->rsegments[2] == 'shipping_group' || $this->uri->rsegments[2] == 'shipping_group_regist' || $this->uri->rsegments[2] == 'delivery_company') && $this->input->get("provider_seq") > 1){
			//$adminMenuCurrent = 'provider';
		}
		
		// 엑셀 다운로드 메뉴 활성
		switch($this->input->get("category")){
			case "1":
				$adminMenuCurrent = "goods";
				break;
				
			case "2":
				$adminMenuCurrent = "order";
				break;	

			case "3":
				$adminMenuCurrent = "member";
				break;	

			case "4":
				$adminMenuCurrent = "export_download";				
				break;

			case "0":
				$adminMenuCurrent = "total_download";				
				break;	
		}				

		//주문 상세 메뉴 활성
		if($adminMenuCurrent=="order" && $adminSubMenuCurrent=="view") {
			switch($this->input->get("callPage")){
				case "catalog":
					$adminSubMenuCurrent="catalog";
					break;
					
				case "company_catalog":
					$adminSubMenuCurrent="company_catalog";
					break;

				case "sales":
					$adminSubMenuCurrent = "sales";
					break;	
				
				case "returns":
					$adminMenuCurrent = "returns";
					$adminSubMenuCurrent = "catalog";
					break;	
				
				case "refund":
					$adminMenuCurrent = "refund";
					$adminSubMenuCurrent = "catalog";
					break;

				default :
				$adminSubMenuCurrent="catalog";
			}			
		}

		$adminURLCurrent = $adminMenuCurrent."/".$adminSubMenuCurrent;
		if($adminSubMenuCurrent =="multi_basic" || $adminSubMenuCurrent =="store_regist" || $adminSubMenuCurrent=="marketplace_url"||$adminSubMenuCurrent=="member") $adminURLCurrent = substr($_SERVER['REQUEST_URI'], 7);
		

		// 상품 > 패키지 상품 등록 메뉴 활성
		if($adminSubMenuCurrent=="regist" && $this->input->get("package_yn")) $adminURLCurrent = $adminMenuCurrent."/".$adminSubMenuCurrent.'?package_yn=y';

		// 상품 > 일반 상품 등록 메뉴 활성
		if($adminSubMenuCurrent=="regist" && $this->input->get("provider"))	$adminURLCurrent = $adminMenuCurrent."/".$adminSubMenuCurrent.'?provider=base';	

		// 상품 > 사은품 등록 메뉴 활성
		if($adminMenuCurrent=="goods" && $adminSubMenuCurrent=="gift_regist") $adminURLCurrent = $adminMenuCurrent."/".$adminSubMenuCurrent.'?provider=base';			
		
		// 통계 > 적립 메뉴 활성
		if($adminSubMenuCurrent=="epc_basic" && $this->input->get("stats_type")) $adminURLCurrent = $adminMenuCurrent."/".$adminSubMenuCurrent.'?stats_type='.$_GET['stats_type'];		
		
		// 설정 > 회원 > 등급 메뉴 활성
		if($adminSubMenuCurrent=="member" && $this->input->get("grade")=="modify") $adminURLCurrent = $adminMenuCurrent."/".$adminSubMenuCurrent.'?gb=grade';			
		
		// 매장 메뉴 활성
		if($adminURLCurrent =="o2osetting/index") {
			$adminMenuCurrent = "o2o";
			$adminSubMenuCurrent = "o2osetting";
			$adminURLCurrent = "o2o/o2osetting";
		}

		// 다운로드 항목설정 메뉴 활성
		if(($adminSubMenuCurrent=="download_list" || $adminSubMenuCurrent=="download_write") && $this->input->get("callPage")=="company_catalog") $adminSubMenuCurrent = 'company_catalog';	
		if(($adminSubMenuCurrent=="download_list" || $adminSubMenuCurrent=="download_write") && $this->input->get("callPage")=="catalog") $adminSubMenuCurrent = 'catalog';		
		
	
		// 물류관리 미사용 시 물류관리 메뉴 제거
		if	(!$this->scm_cfg)	$this->scm_cfg	= config_load('scm');
		if	(!serviceLimit('S6016') || $this->scm_cfg['use'] != 'Y'){
			$this->admin_menu->except_scm_menu();
		}

		// 구정산 마이그레이션 안했으면 메뉴 제거
		$accountall_setting = config_load('accountall_setting');
		if (!$accountall_setting['old_accountall_display']) {
			$this->admin_menu->except_old_accountall_menu();
		}
	
		/* 매뉴얼 바로보기 숨김처리메뉴 추가 leewh 2014-09-17 */
		$menual_hidden = false;
		if (in_array(uri_string(),array('admin/board/board'))) {
			$menual_hidden = true;
		} else {
			if (uri_string() == "admin/event/gift_regist") {
				if($_GET['gb']=="order"){
					$menual_url = urlencode("evnet/gift_regist_order");
				}else{
					$menual_url = urlencode("evnet/gift_regist_buy");
				}
			}else if (uri_string() == "admin/setting/manager_reg") {
				$menual_url = urlencode("setting/manager");
			} else if (uri_string() == "admin/brand/batch_design_setting") {
				$menual_url = urlencode("brand/catalog");
			} else if (uri_string() == "admin/location/batch_design_setting") {
				$menual_url = urlencode("location/catalog");
			} else if ($adminMenuCurrent == "member" && strstr(uri_string(),"kakaotalk")) {
				$menual_url = urlencode("member/kakaotalk");
			} else if ($adminMenuCurrent == "member" && uri_string() == "admin/member/email_history") {
				$menual_url = urlencode("member/email");
			} else {
				$menual_url = urlencode(preg_replace("/^admin\//","",uri_string()));
			}
		}
	
		// O2O 서비스에 따른 _pc_menu.ini 추가 세팅
		$this->load->library('o2o/o2oinitlibrary');
		// O2O 서비스 사용에 따른 메뉴 제거 및 현재 디렉토리 설정
		$this->o2oinitlibrary->init_exceptO2OForAdminMenu($adminMenuCurrent);
		$this->template->assign(array(
			'adminMenu' => $this->admin_menu->arr_menu,
			//'adminMenu2' => $this->admin_menu->arr_menu2, // 구메뉴 삭제처리 :: 2016-12-06 lwh
			'settingMenu' => $this->admin_menu->arr_setting,
			'adminMenuLimit' => 6,
			'adminMenuCurrent' => $adminMenuCurrent,
			'adminSubMenuCurrent' => $adminSubMenuCurrent,
			'adminURLCurrent' => $adminURLCurrent,
			'admin_menual_url' => $menual_url,
		));
	}

	// 디자인 모듈 로딩
	public function tempate_modules(){

		$filePath = APPPATH."../admin/skin/".$this->skin."/_modules/";
		$map = directory_map($filePath);

		foreach($map as $dir => $dirRow) {
			if(is_array($dirRow)) {
				$dir = str_replace('/','',$dir);
				foreach($dirRow as $modulePath) {
					$modulesList[$dir."_".substr($modulePath,0,-5)] = $this->skin."/_modules/".$dir."/".$modulePath;
				}
			}
		}
		$this->template->define($modulesList);
	}

	public function template_path($addPath=null){	
		return $this->skin."/".(($addPath)?$addPath."/":"").implode('/',$this->uri->rsegments).".html";
	}

	### 데모세션처리
	public function set_demo(){
		$filename = APPPATH."helpers/demo_helper".EXT;
		if(file_exists($filename)){
			$this->load->helper('demo');
		}
	}

}

// 커스텀 파일이 있는 경우 커스텀파일에서 현파일을 로딩하여 상속 받아 사용한다
if(!customBaseCall(__FILE__)) { class admin_base extends admin_base_original {} }

// END
/* End of file admin_base.php */
/* Location: ./app/base/admin_base.php */