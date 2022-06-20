<?php
class admin_menu extends CI_Model {
	var $arr_menu			= array();
	var $arr_menu2			= array();
	var $arr_setting		= array();
	var $admin_skin_type	= '';

	public function __construct(){
		$arr_menu		= $this->load_menu_ini();
		$arr_setting	= $this->load_setting_ini();

		$this->load->library('servicecheck');		
		
		$this->load->helper('cookie');
		$this->managerInfo = $this->session->userdata('manager');
		
		// 관리자별 스킨 버전 불러오기
		$this->admin_skin_type = $this->getSkinSwipeToggle();

		$this->servicecheck->menu_limit($arr_menu,$arr_setting);
		
		if($this->admin_skin_type == "org"){
			$this->get_org_menu_array($arr_menu);
			$this->get_setting_array($arr_setting);
		}else{
			$this->get_menu_array($arr_menu);
		}
	}

	protected function load_menu_ini(){
		if( defined('__SELLERADMIN__') === true ) {
			$arr_menu = parse_ini_file(APPPATH."config/_provider_menu.ini", true, INI_SCANNER_RAW);
		}else{
			$arr_menu = parse_ini_file(APPPATH."config/_pc_menu.ini", true, INI_SCANNER_RAW);
		}		 
		return $arr_menu;
	}


	protected function load_menu_ini2(){
		if( defined('__SELLERADMIN__') === true ) {
			$arr_menu2 = parse_ini_file(APPPATH."config/_provider_menu2.ini", true);
		}else{
			$arr_menu2 = parse_ini_file(APPPATH."config/_pc_menu2.ini", true);
		}

		return $arr_menu2;
	}

	protected function load_setting_ini(){
		if( defined('__SELLERADMIN__') === true ) {
			$arr_setting = array();
		}else{
			$arr_setting = parse_ini_file(APPPATH."config/_setting_menu.ini");
		}

		return $arr_setting;
	}

	protected function get_menu_array($arr_menu){
		foreach($arr_menu as $k=>$v){
			$v_name = explode(":", $k);
			$k = $v_name[0];
			
			$this->arr_menu[$k]['folders'] = array();
			$this->arr_menu[$k]['submenu'] = array();				
			$_save = "";
			$_count = 0;

			foreach($v as $k2=>$v2){
				$v2tmp = explode(":",$v2);
				$urls = array();

				if($k2=="category"){						
					$this->arr_menu[$k]['name'] = $v2tmp[0];	
					$this->arr_menu[$k]['url'] = $v2tmp[1];	
				}

				if(is_array($v2)){
					foreach($v2 as $k3=>$v3){					
						$tmp = explode(":",$v3);						
						$tmp[0] = str_replace(array('<','>'),array('[',']'),$tmp[0]);
						$tmp2 = explode("/",$tmp[1]);		
						if(!in_array(trim($tmp2[1]), $this->arr_menu[$k]['folders'])) $this->arr_menu[$k]['folders'][] = trim($tmp2[1]);
						$arr = explode("|", $tmp2[2]);			
						$arr_url = explode("?",$arr[0]);
						$files = [];								

						foreach($arr as $value) {
							$arr_url[1]&&$tmp2[1]=="page_manager" ? $urls[] = $tmp2[1]."/".explode("?", $value)[0] : $urls[] = $tmp2[1]."/".$value;														
							$files[] = explode("?", $value)[0];									
						}
						
						$sub_name = explode(",", $tmp[0]);
						if($k2 != $_save) $_count++;
						if($tmp[1]=="")$this->arr_menu[$k]['submenu'][$_count-1]['name'] = $sub_name[0];	
						$this->arr_menu[$k]['submenu'][$_count-1]['urls'] = $urls;
						$this->arr_menu[$k]['submenu'][$_count-1]['childs'][] = array('name'=>$sub_name[0],'class'=>$sub_name[1],'url'=> explode("|", $tmp[1])[0],'folder'=>$tmp2[1],'file'=>$files,'limit'=>$tmp[2]);	
						$_save = $k2;
					}
				}else{
					$tmp = explode(":",$v2);	
					$tmp2 = explode("/",$tmp[1]);	
					if(!in_array(trim($tmp2[1]), $this->arr_menu[$k]['folders'])) $this->arr_menu[$k]['folders'][] = trim($tmp2[1]);
				}
			}		
		}
		
		if (isset($this->arr_menu['market_connector']) == true)
			$this->arr_menu['market_connector']['folders'][] = 'market_connector';	
		
	
	}

	protected function get_org_menu_array($arr_menu){
		foreach($arr_menu as $k=>$v){
			$ktmp = explode(":",$k);
			$k = $ktmp[0];
		
			if($ktmp[1]!="T1") $this->arr_menu[$k]['folders'] = array();		
			
			foreach($v as $k2=>$v2){
				$v2tmp = explode(":", $v2);	
				
				if($k2=="category" && $ktmp[1]!="T1"){					
					$this->arr_menu[$k]["name"] = $v2tmp[0];
					$this->arr_menu[$k]["url"] = $v2tmp[1];					
				}

				$index = 0;				
				foreach($v2 as $k3=>$v3){
					$tmp = explode(":", $v3);						
					
					$tmp[0] = str_replace(array('<','>'),array('[',']'),$tmp[0]);
					$tmp2 = explode("/",$tmp[1]);

				
					if($tmp[2] != "H" && $tmp[3] != "H"){
						if ($tmp2[1] == 'market_connector')
							$tmp2[1] = $tmp2[2];						
						if($ktmp[1]=="T1"){							
							if($index=="0"){
								$this->arr_menu[$k2]['name'] = $tmp[0];													
							}else{
								if($index=="1") $this->arr_menu[$k2]['url'] = explode("|", $tmp[1])[0];							
								if(!in_array(trim($tmp2[1]),$this->arr_menu[$k2]['folders'])) $this->arr_menu[$k2]['folders'][] = trim($tmp2[1]);
								$this->arr_menu[$k2]['childs'][] = array('name'=>$tmp[0],'url'=> explode("|", $tmp[1])[0],'folder'=>$tmp2[1],'limit'=>$tmp[2]);
							}					
						}else{	
							if($ktmp[1]=="T2"){								
								if($index=="0" ||$index=="1"){								
									if($index=="0"){
										$arr = [];
										$arr['name'] = $tmp[0];
										
									}else if($index=="1"){										
										$arr['url'] = explode("|", $tmp[1])[0];
										$arr['limit'] = $tmp[2]; 
										$this->arr_menu[$k]['childs'][] = $arr;										
									}
								}
								
								if($k3=="index" && $tmp[1]!=""){									
									$arr = [];
									$arr['name'] = $tmp[0];
									$arr['url'] = explode("|", $tmp[1])[0];
									$arr['limit'] = $tmp[2]; 
									$this->arr_menu[$k]['childs'][] = $arr;		
								}							
							}else{								
								if($tmp[1]!=""){
									$name = $tmp[0];
									if($k3=="joinform") $name="회원";															
									$this->arr_menu[$k]['childs'][] = array('name'=>$name,'url'=>explode("|", $tmp[1])[0],'folder'=>$tmp2[1],'limit'=>$tmp[2]);
								}								
							}
							
							if(!in_array(trim($tmp2[1]),$this->arr_menu[$k]['folders'])) $this->arr_menu[$k]['folders'][] = trim($tmp2[1]);
						}
					}				
					$index++;
				}
			}			
		}		
		if (isset($this->arr_menu['market_connector']) == true)
			$this->arr_menu['market_connector']['folders'][] = 'market_connector';
		
	}

	protected function get_menu_array2($arr_menu2){
		foreach($arr_menu2 as $k=>$v){
			foreach($v as $k2=>$v2){
				$v2[0] = str_replace(array('<','>'),array('[',']'),$v2[0]);
				if	($k2 == 0)
					$this->arr_menu2['menu_titles'][$k]	= array('name'=>$v2[0],'url'=>$v2[1],'alt'=>$v2[2], 'required'=>$v2[3], 'etype'=>$v2[4], 'url2'=>$v2[5]);
				else
					$this->arr_menu2[$k][]				= array('name'=>$v2[0],'url'=>$v2[1],'alt'=>$v2[2], 'required'=>$v2[3], 'etype'=>$v2[4], 'url2'=>$v2[5], 'lines'=>$v2[6]);
			}
		}
	}

	protected function get_setting_array($arr_setting){
		foreach($arr_setting as $k=>$v){
			$this->arr_setting[$k]['folders'] = array();

			foreach($v as $k2=>$v2){
				$tmp = explode(":",$v2);
				$tmp[0] = str_replace(array('<','>'),array('[',']'),$tmp[0]);
				$tmp2 = explode("/",$tmp[2]);
				if(!in_array(trim($tmp2[2]),$this->arr_setting[$k]['folders'])) $this->arr_setting[$k]['folders'][] = trim($tmp2[2]);				
				$this->arr_setting[$k]['childs'][] = array('name'=>$tmp[0],'class'=>$tmp[1],'url'=>$tmp[2],'folder'=>$tmp2[2],'limit'=>$tmp[3]);
			}
		}

		
	}

	// 물류관리 메뉴 제거
	public function except_scm_menu(){
		if	($this->admin_menu->arr_menu) foreach($this->admin_menu->arr_menu as $name => $data){		
			if	(!in_array($name, array('scm'))){
				$re_arr_menu[$name]	= $data;
			}
		}
		$this->admin_menu->arr_menu		= $re_arr_menu;
	}

	// 구)정산 제거
	public function except_old_accountall_menu() {
		$re_arr_menu = $this->admin_menu->arr_menu;
		$data = $re_arr_menu['accountall'];
		foreach($data['childs'] as $key => $val) {
			if($val['folder'] == 'account') {
				unset($re_arr_menu['accountall']['childs'][$key]);
			}
		}
		$this->admin_menu->arr_menu		= $re_arr_menu;
	}

	/*
	관리자UI/UX 스킨 타입 저장
	*/
	public function setAdminSkinType($skinType = 'new') {
		if (defined('__SELLERADMIN__') === true) {
			$adminType 		= 'sellerAdmin_'.$this->providerInfo['provider_seq'];
		}else{
			$adminType 		= 'admin_'.$this->managerInfo['manager_seq'];
		}

		config_save('adminSkinType', array($adminType => $skinType));
		return 'success';
	}
	
	/*
	관리자UI/UX 스킨 타입 불러오기
	*/
	public function getSkinSwipeToggle() {

		if (defined('__SELLERADMIN__') === true) {
			$adminType 		= 'sellerAdmin_'.$this->providerInfo['provider_seq'];
		}else{
			$adminType 		= 'admin_'.$this->managerInfo['manager_seq'];
		}

		$adminSkinType		= config_load('adminSkinType', $adminType);

		//신규설치본에 저장된 디자인 버전이 없으면 무조건 신디자인으로 노출
		if(getAdminSkinUserType() == 'newSetting' && !$adminSkinType[$adminType]) 
		{
			$this->setAdminSkinType('new');
			$adminSkinType[$adminType] = 'new';
		}

		// 관리자별 설정값대로 노출. 설정값 없으면 예전타입(org) 타입 노출
		return ($adminSkinType[$adminType])? $adminSkinType[$adminType] : 'org';
	}
}
?>
