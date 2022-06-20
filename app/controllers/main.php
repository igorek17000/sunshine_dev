<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH ."controllers/base/front_base".EXT);
class main extends front_base {

	public function main_index()
	{
		redirect("main/index");
	}
	
	## 메인 캐쉬 읽기
	protected function _index(){
		$this->load->library('cachemain');
		$sSkinPath  = 'main/cache_main.html';
		$this->cachemain->cache_file_path = $this->template->template_dir."/".$this->skin.'/';
		$this->cachemain->set_cache_file($sSkinPath);
		$cachepreview   = $this->input->get('cachepreview');
		$mainCachePrn = "skinCache";
		if($this->fammerceMode){
			$mainCachePrn = "fammerceSkinCache";
		}else if($this->mobileMode){
			$mainCachePrn = "mobileSkinCache";
		}
		// 비회원, 아이디자인 off, 관리자가 아닌 경우, cache 파일 정상일 경우
		$chk	= $this->cachemain->check_cache_file();
		if(
			($chk == '10' && $this->config_system[$mainCachePrn]=='y' && !$this->userInfo['member_seq'] && !$this->designMode && !$this->managerInfo) ||
			($chk == '10' && $cachepreview=='y')
			){
				$this->template->define('LAYOUT', $this->skin . '/' . $sSkinPath);
				$this->template->assign('main', true);
				$this->template->print_('LAYOUT');				
		}else{
			$aResult		= $this->_read();
			$category_plan  = $aResult['category_plan'];
			$default_shipping_address  = $aResult['default_shipping_address'];
			$this->template->assign('category_plan', $category_plan);
			$this->template->assign('default_shipping_address', $default_shipping_address);
			$this->template->assign('main', true);
			$this->print_layout($this->template_path());
		}		
	}
	
	## 메인에 노출 필요 데이터 로드
	protected function _read()
	{
		$this->load->model('shippingmodel');
		// 대표매장 정보
		// 입력장소를 위한 세팅
		if(defined('__ADMIN__') === true){
			$provider_seq = 1;
		}else{
			$provider_seq = $this->providerInfo['provider_seq'];
		}
		$sc									= array();
		$sc['address_provider_seq']			= $provider_seq;
		$sc['store_info_display_yn']		= 'Y';
		$sc['default_yn']					= 'Y';
		$list = $this->shippingmodel->shipping_address_list($sc);
		$default_shipping_address = array();
		if($list['record'][0]){
			$default_shipping_address = $list['record'][0];
		}
		
		$this->load->model('categorymodel');
		$category_plan = array();
		$query = $this->db->query("select * from fm_category where plan='y' and level=3 order by category_code asc");
		foreach($query->result_array() as $row){
			$childCategoryData = $this->categorymodel->get_list($row['category_code'],array(
				"hide = '0'",
				"plan_main_display != 'n'",
				"level=4",
				"parent_id=" . $row['id']
			));
			$category_plan[substr($row['category_code'],0,4)] = $childCategoryData;
		}
		return array('category_plan' => $category_plan, 'default_shipping_address' => $default_shipping_address);
	}
	
	## 메인에 노출 필요 데이터 로드
	protected function _cache()
	{
		$this->load->library('cachemain');
		$aResult		= $this->_read();
		$aTmp			= $this->cachemain->main_cache($aResult);
		$sPrintLayoutPath	= $aTmp[0];
		$aMessage			= $aTmp[1];
		$sCachedPath		= $aTmp[2];
		$sTmpCachedPath		= $aTmp[3];
		$aAutoDisplays		= $aTmp[4];
		$aAutoPopups		= $aTmp[5];
		
		if( $sPrintLayoutPath ){
			ob_start();
			$category_plan  = $aResult['category_plan'];
			$this->template->assign('category_plan', $category_plan);
			$this->template->assign('main', true);
			$this->print_layout($sPrintLayoutPath);
			$cache_contents	= ob_get_contents();
			ob_end_clean();
			if($aAutoDisplays){
				foreach($aAutoDisplays as $iSeq){
					$sSource	= "{=showDesignDisplay(".$iSeq.")}";
					$sTarget	= "[[[=showDesignDisplay(".$iSeq.")]]]";
					$cache_contents = str_replace($sTarget, $sSource, $cache_contents);
				}
			}
			if($aAutoPopups){
				foreach($aAutoPopups as $iSeq){
					$sSource	= "{=showDesignPopup(".$iSeq.")}";
					$sTarget	= "[[[=showDesignPopup(".$iSeq.")]]]";
					$cache_contents = str_replace($sTarget, $sSource, $cache_contents);
				}
			}
			$this->cachemain->set_cache_file($sCachedPath);
			$this->cachemain->make_file($cache_contents);
			$this->cachemain->set_cache_file($sTmpCachedPath);
			if( is_file( $this->cachemain->cache_full_path ) ){
				$this->cachemain->del_file();
			}
		}
		echo implode('', $aMessage);
	}
	
	## 메인 분기
	public function index()
	{
		$sCreateCached  = $this->input->get('createCached');
		$sPreviewSkin  = $this->input->get('previewSkin');

		/* 미리보기 스킨 세션처리 */
		if(count($this->uri->segments) == 0){
			/* 미리보기 스킨 세션처리 */
			if($sPreviewSkin){
				setcookie('previewSkin', $_GET['previewSkin'], 0, '/');
				set_cookie(array(
					'name'   => 'setDesignMode',
					'value'  => false,
					'path'   => '/'
				));
			}elseif($_COOKIE['previewSkin']){
				$this->load->helper("cookie");
				delete_cookie('previewSkin');
				setcookie('previewSkin', '', 0, '/');
			}
			if($sPreviewSkin || $_COOKIE['previewSkin']){
				if($_SERVER['QUERY_STRING']){
					redirect("main/index?".$_SERVER['QUERY_STRING']);
				}else{
					// 검색엔진 최적화를 위해 (http://webmastertool.naver.com/guide/basic_optimize.naver#chapter4.2)
					redirect("main/index", "auto", 301);
				}			
			}
		}
		
		if( $sCreateCached == 1 ){ // 캐쉬 생성
			$this->_cache();
		}else{
			$this->_index();
		}
	}	

	public function blank()
	{
		/* 빈 페이지를 캐싱 */
		//http_response_code(204);
		header('Cache-Control: public, max-age=31536000');
		header('Expires: '.date('r', strtotime('+1 year')));
		header('Pragma: invalid');
		exit;
	}
	
	public function viewGoodsDisplayCache()
	{
		$aGetParams	 = $this->input->get();
		$display_seq	= $aGetParams['display_seq'];
		$display_tab_index	= $aGetParams['display_tab_index'];
		$perpage	= $aGetParams['perpage'];
		$kind		= $aGetParams['kind'];
		$this->load->model('goodsdisplay');
		$aData = $this->goodsdisplay->get_display($display_seq);
		if($aData['platform'] == 'fammerce'){
			$this->skin = $this->config_system['fammerceSkin'];
			$this->fammerceMode = true;
		}else if($aData['platform'] == 'mobile'){
			$this->skin = $this->config_system['mobileSkin'];
			$this->mobileMode = true;
		}
		
		echo '<link rel="stylesheet" type="text/css" href="/data/skin/'.$this->skin.'/css/style.css" />';
		$this->template->include_('showDesignDisplay');
		showDesignDisplay($display_seq, $perpage, $kind);
	}
	
	public function googleToken(){
		$aPartner	= config_load('partner');
		if( 'google'.$aPartner['google_verification_token'].".html" != $this->uri->uri_string ){
			show_404();
			exit;
		}
		echo "google-site-verification: " . $this->uri->uri_string;
	}
}