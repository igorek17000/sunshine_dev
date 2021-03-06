<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once(APPPATH ."libraries/o2o/o2oconfiglibrary".EXT);

Class o2oservicelibrary extends o2oconfiglibrary
{
	public function __construct() {
		parent::__construct();
		
		$this->CI->load->model("o2o/o2oconfigmodel");
		$this->CI->load->model("o2o/o2omembermodel");
	}
	
	
	public function get_block_benefit($member_seq, &$check_o2o_benefit, &$unset_time){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$timestamp = strtotime("-5 minutes");
		$sqlData['member_seq']							= $member_seq;
		$sqlData['where_custom']['regist_date']			= ' regist_date between \''.date("Y-m-d H:i:s", $timestamp).'\' and \''.date("Y-m-d H:i:s").'\'';
		
		$this->CI->load->model("o2o/o2oblockmodel");
		$o2o_block = $this->CI->o2oblockmodel->select_o2o_block($sqlData);
		
		if($o2o_block && empty($this->CI->o2oConfig)){
			$check_o2o_benefit = true;
			$unset_time = date("Y-m-d H:i:s", strtotime("+5 minutes", strtotime($o2o_block['regist_date'])));
		}
	}
	public function set_block_benefit($member_seq, $o2oConfig){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$insertData = array();
		$insertData['o2o_store_seq'] = $o2oConfig['o2o_config_pos'][0]['o2o_store_seq'];
		$insertData['o2o_pos_seq'] = $o2oConfig['o2o_config_pos'][0]['o2o_pos_seq'];
		$insertData['member_seq'] = $member_seq;
		
		if(!empty($insertData['o2o_store_seq'])
			&& !empty($insertData['o2o_pos_seq'])
			&& !empty($insertData['member_seq'])){
			$this->CI->load->model("o2o/o2oblockmodel");
			$this->CI->o2oblockmodel->insert_o2o_block($insertData);
		}
	}
	
	public function check_o2o_benefit($allow_exit, $member_seq){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$check_o2o_benefit = false;
		$unset_time = date("Y-m-d H:i:s");
		
		$this->get_block_benefit($member_seq, $check_o2o_benefit, $unset_time);
		
		if($check_o2o_benefit){
			if($this->CI->displaymode == 'coupon'){
				$return		= array('coupon_error'				=> 1);
				echo json_encode($return);
			}else{
				$err_msg = '???????????? ???????????? ?????? ??????????????????.\n?????????????????? : '.$unset_time;
				$callback_script = 'parent.cancel_emoney();parent.cancel_cash();parent.location.href="/";';
				pageLocation('/',$err_msg,'parent');
			}
			if($allow_exit){
				exit;
			}
		}
	}
	public function check_o2o_service($o2o_auth_info=null) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		$result = false;
		if(!empty($o2o_auth_info)
			&& !empty($o2o_auth_info['store_seq'])
			&& !empty($o2o_auth_info['pos_seq'])
			&& !empty($o2o_auth_info['pos_key'])
			){
			$params = array(
				'store_seq'		=> $o2o_auth_info['store_seq'],
				'pos_seq'		=> $o2o_auth_info['pos_seq'],
				'pos_key'		=> $o2o_auth_info['pos_key'],
				'use_yn'		=> 'y',
			);
			$o2oConfig = $this->get_o2o_config($params);
			if(!empty($o2oConfig) && !empty($o2oConfig['o2o_config_pos'])){
				$result = $o2oConfig;
			}
		}
		return $result;
	}
	
	// o2o ?????? ?????? ??????
	public function get_o2o_config($params=array(), $limit=1, $mode=null) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		// DB ??????
		$result = $this->CI->o2oconfigmodel->select_o2o_config($params, $limit, $mode);
		
		//====================================================
		// ?????? ??????
		//====================================================
		// scm ????????? ??????
		// ????????????
		$warehouses = array();
		if($this->CI->scm_cfg['use']=="Y"){
			unset($sc);
			$this->CI->load->model('scmmodel');
			$sc['orderby']	= 'wh_name asc';
			$warehouses		= $this->CI->scmmodel->get_warehouse($sc);
		}
		$o2o_pos_info = json_decode($this->o2o_system_info['o2o_pos_info'], true);
		if($limit==1){
			unset($row);
			$row = $result;
			unset($result);
			$result[] = $row;
		}
		foreach($result as $k=>&$row){
			foreach($warehouses as $wh){
				if($wh['wh_seq']==$row['scm_store']){
					$row['scm_store_text'] = $wh['wh_name'];
				}
			}
			foreach($o2o_pos_info as $posCode=>$posInfo){
				if($row["pos_code"]==$posCode){
					$row["pos_code_text"] = $posInfo['name'];
				}
			}
			foreach($this->code as $codeName=>$codeValueArray){
				if(!empty($row[$codeName])){
					foreach($codeValueArray as $codeKey=>$codeValue){
						if($row[$codeName]==$codeKey){
							$row[$codeName."_text"] = $codeValue;
						}
					}
				}
			}
			if(!empty($row)){
				$row['address_nation']				= $row['pos_address_nation'];
				$row['zoneAddress_type']			= $row['pos_address_type'];
				$row['zoneZipcode']					= $row['pos_address_zipcode'];
				$row['zoneAddress']					= $row['pos_address'];
				$row['zoneAddress_street']			= $row['pos_address_street'];
				$row['zoneAddressDetail']			= $row['pos_address_detail'];
				if($row['address_nation'] == 'global'){
					$row['international_postcode']				= $row['zoneZipcode'];
					$row['international_country']				= $row['pos_international_country'];
					$row['international_town_city']				= $row['pos_international_town_city'];
					$row['international_county']				= $row['pos_international_county'];
					$row['international_address']				= $row['pos_international_address'];
				}
				$pos_params						= array();
				$pos_params['o2o_store_seq']	= $row['o2o_store_seq'];
				if($params['use_yn']){
					$pos_params['use_yn']			= $params['use_yn'];
				}
				$row['o2o_config_pos'] = $this->get_o2o_config_pos($pos_params, 'unlimit', $mode);
			}
		}
		if($limit==1){
			unset($row);
			$row = $result[0];
			unset($result);
			$result = $row;
		}
		//====================================================
		// ?????? ??????
		//====================================================
		
		return $result;
	}
	// ???????????? ??????
	public function get_o2o_config_pos($params=array(), $limit=1, $mode=null) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		// DB ??????
		$result = $this->CI->o2oconfigmodel->select_o2o_config_pos($params, $limit, $mode);
		
		//====================================================
		// ?????? ??????
		//====================================================
		if($limit==1){
			unset($row);
			$row = $result;
			unset($result);
			$result[] = $row;
		}
		foreach($result as $k=>&$row){
			foreach($this->code as $codeName=>$codeValueArray){
				if(!empty($row[$codeName])){
					foreach($codeValueArray as $codeKey=>$codeValue){
						if($row[$codeName]==$codeKey){
							$row[$codeName."_text"] = $codeValue;
						}
					}
				}
			}
		}
		if($limit==1){
			unset($row);
			$row = $result[0];
			unset($result);
			$result = $row;
		}
		//====================================================
		// ?????? ??????
		//====================================================
		return $result;
	}
	// ??????/?????? ?????? ??????
	public function set_o2o_config($params=array(), $mode="store") {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2oconfigmodel->insert_o2o_config($params, $mode);
		
		return $result;
	}
	// ??????/?????? ?????? ??????
	public function upd_o2o_config($params=array(), $mode="store") {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2oconfigmodel->update_o2o_config($params, $mode);
		
		return $result;
	}
	// ??????/?????? ?????? ??????
	public function del_o2o_config($params=array(), $mode="store") {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2oconfigmodel->delete_o2o_config($params, $mode);
		
		// o2o ????????? ???????????? ????????????
		$this->CI->load->library('o2o/o2oinitlibrary');
		$this->CI->o2oinitlibrary->init_shipping_store();
		
		// o2o ?????? ????????? ?????? ??? ?????? ???????????? ??????????????? ???????????? ??? shipping_set??? ?????? ???????????????.
		$this->CI->load->library('o2o/o2oinitlibrary');
		$this->CI->o2oinitlibrary->init_delete_shipping_store($params);
		
		return $result;
	}
	// ?????? ?????? ??????
	public function merge_o2o_config($params=array()){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		// ?????? ???????????? ?????? ?????? ??????
		if($this->CI->scm_cfg['use']!="Y"){
			$params['scm_store'] = "";
		}
		
		unset($o2oConfigData);
		$o2oConfigData = array(
			'o2o_store_seq'			=> $params['o2o_store_seq'],
		);
		$o2oConfig = $this->get_o2o_config($o2oConfigData);
		unset($insertData);
		$insertData = array(
			'pos_code'			=> $params['pos_code'],
			'store_seq'			=> $params['store_seq'],
			'pos_name'			=> $params['pos_name'],
			'pos_phone'			=> $params['pos_phone'],
			'pos_key'			=> $params['pos_key'],
			'scm_store'			=> $params['scm_store'],
		);
		$insertData['pos_address_nation']		= $params['address_nation'];
		$insertData['pos_address_type']			= $params['zoneAddress_type'];
		$insertData['pos_address_zipcode']		= (is_array($params['zoneZipcode'])) ? implode('',$params['zoneZipcode']) : $params['zoneZipcode'];
		$insertData['pos_address']				= $params['zoneAddress'];
		$insertData['pos_address_street']		= $params['zoneAddress_street'];
		$insertData['pos_address_detail']		= $params['zoneAddressDetail'];
		if($params['address_nation'] == 'global'){
			$insertData['pos_international_postcode']	= $insertData['address_zipcode'];
			$insertData['pos_international_country']		= $params['international_country'];
			$insertData['pos_international_town_city']	= $params['international_town_city'];
			$insertData['pos_international_county']		= $params['international_county'];
			$insertData['pos_international_address']		= $params['international_address'];
		}
		
		if($o2oConfig){
			$insertData['o2o_store_seq'] = $o2oConfig['o2o_store_seq'];
			$row_cnt = $this->upd_o2o_config($insertData);
		}else{
			// ?????? ?????? ??? scm ?????? ????????? ?????? ?????? ?????? ??????
			if($this->CI->scm_cfg['use']=="Y" && $insertData['scm_store'] == 'auto'){
				$this->CI->load->model('scmmodel');
				unset($makeScm);
				$makeScm['wh_name']							= $insertData['pos_name'];
				$makeScm['location_width']					= '1';	// ??????????????? ?????????
				$makeScm['location_length']					= '1';	// ??????????????? ?????????
				$makeScm['location_height']					= '1';	// ??????????????? ?????????
				$makeScm['wh_group']						= '???????????? ??????';
				$makeScm['Address_type']					= $insertData['pos_address_type'];
				$makeScm['Zipcode']							= array($insertData['pos_address_zipcode']);
				$makeScm['Address']							= $insertData['pos_address'];
				$makeScm['Address_street']					= $insertData['pos_address_street'];
				$makeScm['address_detail']					= $insertData['pos_address_detail'];
				$makeScm['wh_admin_memo']					= '?????? ????????? ???????????? ?????? ??????';
				$makeScm['location_width_type']				= '1';	// ???????????? ????????? ?????????
				$makeScm['location_length_type']			= '1';	// ???????????? ????????? ?????????
				$makeScm['location_height_type']			= '1';	// ???????????? ????????? ?????????
				$makeScm['manager'][0]['seq']				= 0;	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['name']				= '';	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['partname']			= '';	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['charge']			= '';	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['phone_number']		= $insertData['pos_phone'];	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['extension_number']	= '';	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['cellphone_number']	= '';	// ????????? ????????? ?????? ???
				$makeScm['manager'][0]['email']				= '';	// ????????? ????????? ?????? ???
				
				$data		= $this->CI->scmmodel->chk_warehouse_params($makeScm);
				$wh_seq		= $this->CI->scmmodel->save_warehouse($data['warehouse']);
				if	($wh_seq > 0){
					if	($data['location'])	$this->CI->scmmodel->save_location($data['location'], $wh_seq);
					if	($data['manager'])	$this->CI->scmmodel->save_manager('warehouse', $wh_seq, $data['manager']);
				}
				
				// ?????? ?????? ?????? ??? ?????????????????? ???????????? ???????????? ??????
				$this->set_o2o_scm_basic_store_regist($wh_seq);
				
				$insertData['scm_store']	= $wh_seq;
			}
			
			if(empty($insertData['pos_key'])){
				unset($posKeyData);
				$posKeyData = array(
					'time'				=> time(),
					'auth_text'			=> $this->auth_text,
					'pos_code'			=> $params['pos_code'],
					'store_seq'			=> $params['store_seq'],
				);
				$pos_key = $this->generatePosKey($posKeyData);
				$insertData['pos_key'] = $pos_key;
			}
			// ????????? ????????? ??????
			$params['o2o_store_seq'] = $this->set_o2o_config($insertData);
			$o2oConfigData = array(
				'o2o_store_seq'			=> $params['o2o_store_seq'],
			);
		}
		
		$o2oConfig = $this->get_o2o_config($o2oConfigData);
		// pos ?????? ??????
		foreach($params['pos_seq'] as $k=>$v){
			unset($sqlData);
			$sqlData = array(
				'o2o_store_seq'					=> $o2oConfig['o2o_store_seq'],
				'del_o2o_pos_seq'				=> $params['del_o2o_pos_seq'][$k],
				'pos_seq'						=> $v,
				'contracts_status'				=> $params['contracts_status'][$k],
				'use_yn'						=> ($params['use_yn'])?$params['use_yn']:'y',
			);
			$this->merge_o2o_config_pos($sqlData);
		}
		
		// o2o ????????? ???????????? ????????????
		$this->CI->load->library('o2o/o2oinitlibrary');
		$this->CI->o2oinitlibrary->init_shipping_store();
		
		$o2oConfig = $this->get_o2o_config($o2oConfigData);
		$result = $o2oConfig;
		return $result;
	}
	public function merge_o2o_config_pos($params=array()){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		unset($o2oConfigPosData);
		$o2oConfigPosData = array(
			'o2o_store_seq'			=> $params['o2o_store_seq'],
			'pos_seq'				=> $params['pos_seq'],
		);
		$o2oConfigPos = $this->get_o2o_config_pos($o2oConfigPosData);
		unset($insertData);
		$insertData = array(
			'o2o_store_seq'		=> $params['o2o_store_seq'],
			'pos_seq'			=> $params['pos_seq'],
			'contracts_status'	=> $params['contracts_status'],
			'pos_key'			=> $params['pos_key'],
			'use_yn'			=> $params['use_yn'],
		);
		if($o2oConfigPos){
			$insertData['o2o_pos_seq'] = $o2oConfigPos['o2o_pos_seq'];
			$row_cnt = $this->upd_o2o_config($insertData, "pos");
		}else{
			$o2o_store_seq = $this->set_o2o_config($insertData, "pos");
		}
		
		if($params['del_o2o_pos_seq']){
			unset($sqlData);
			$sqlData = array(
				'o2o_pos_seq'				=> $params['del_o2o_pos_seq'],
			);
			$this->del_o2o_config($sqlData, "pos");
		}
		
		$o2oConfigPos = $this->get_o2o_config_pos($o2oConfigPosData);
		$result = $o2oConfigPos;
		return $result;
	}
	
	
	// ????????? ??????
	public function generatePosKey($posKeyData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$shopSno = $this->CI->config_system['shopSno'];
		$subDomain = $this->CI->config_system['subDomain'];
		$o2o_relay_api_key = $this->o2o_system_info['o2o_relay_api_key'];
		
		$posKeyData['shop_seq'] = $shopSno;
		$posKeyData['sub_domain'] = $subDomain;
		
		$enc_pos_key = serialize($posKeyData);
		$pos_key = hash_hmac('sha256', $enc_pos_key, $o2o_relay_api_key, false);
		$pos_key = substr($pos_key,1,20);
		return $pos_key;
	}
	
	// ?????? DB??? ??????
	public function sharePosInfo($o2o_relay_params){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$shopSno = $this->CI->config_system['shopSno'];
		$subDomain = $this->CI->config_system['subDomain'];
		$o2o_relay_host = $this->o2o_system_info['o2o_relay_host'];
		$o2o_relay_api_key = $this->o2o_system_info['o2o_relay_api_key'];
		
		$query = "select hex(aes_encrypt(?, 'firstmall')) as info";
		$row = $this->CI->db->query($query,$o2o_relay_api_key)->row_array();
		$o2o_authorization = $row['info'];
		
		$o2o_relay_params['shop_seq'] = $shopSno;
		$o2o_relay_params['sub_domain'] = $subDomain;

		// call read url
		$api_url	= 'https://'.$o2o_relay_host.'/setContracts';
		$binary			= true;
		$timeout		= 7;
		$headers		= array('authorization'=>$this->auth_text.' '.$o2o_authorization);
		$http_build		= true;
		$debug			= false;
		$method			= "POST";
		try {
			$res_array = null;

			$this->CI->load->helper('o2o/readurl');
			$res = o2o_readurl($api_url, $o2o_relay_params, $binary, $timeout, $headers, $http_build, $debug, $method);

			if($res){
				$res_array = json_decode($res, true);
			}
			if($res_array){
				$o2o_relay_info = $res_array;
			}
		} catch (Exception $exc) {
			debug($exc);
		}
		return $o2o_relay_info;
	}
	
	// ?????? ?????? ?????? - ?????????
	public function refresh_o2o_config(){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		/*
		$o2o_pos_info = json_decode($this->CI->config_system['o2o_pos_info'], true);
		$o2oConfigList = $this->get_o2o_config(null,"unlimit");		
		$shopSno = $this->CI->config_system['shopSno'];
		
		// POS ???????????? ???????????? ?????? ?????? ?????? API??? ????????? ????????? ???????????? ?????? URL ????????? ??????
		unset($call_result);
		foreach($o2oConfigList as $o2oConfigStore){
			
			foreach($o2oConfigStore['o2o_config_pos'] as $o2oConfig){
				// ????????? POS ?????? ??????
				$call_url = $o2o_pos_info[$o2oConfigStore['pos_code']]['url'];
				$call_params = array(
					'shop_seq'	=> $shopSno,
					'pos_code'	=> $o2oConfigStore['pos_code'],
					'store_seq'	=> $o2oConfigStore['store_seq'],
					'pos_seq'	=> $o2oConfig['pos_seq'],
				);

				// call read url
				$api_url		= ''.$call_url.'/contracts';
				$api_params		= $call_params;
				$binary			= true;
				$timeout		= 3;
				$headers		= array();
				$http_build		= true;
				$debug			= false;
				$method			= "GET";
				
				try {
					$res_array = null;

					$this->CI->load->helper('o2o/readurl');
					$res = o2o_readurl($api_url, $api_params, $binary, $timeout, $headers, $http_build, $debug, $method);

					if($res){
						$res_array = json_decode($res, true);
					}
					if($res_array){
						$call_result[] = $res_array;
					}
				} catch (Exception $exc) {
					debug($exc);
				}
			}
		}
		return $call_result;
		 */
	}
	
	// O2O ?????? ??????
	public function join_o2o_member($sqlData = array()){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$o2oMemberJoinMsg = array('error_msg'=>'?????? ????????? ??????????????????.');
		
		// ???????????? POS?????? ??????
		$o2oConfig = $this->check_o2o_service($sqlData['o2o_auth_info']);
		if($o2oConfig){
			// ???????????? ?????? ?????? cellphone
			$member_info = $this->get_member_info(array('cellphone'=>$sqlData['cellphone']));
			if($member_info['code'] == "0"){
				if( empty($this->CI->memberlibrary)) $this->CI->load->library('memberlibrary');
				// ?????? ?????? ??????
				$sqlData['platform'] = 'POS';
				$o2oMemberJoinMsg = $this->CI->memberlibrary->join_member($sqlData);
				
				if($o2oMemberJoinMsg['memberseq']){
					$sqlData['member_seq'] = $o2oMemberJoinMsg['memberseq'];
					// O2O ?????? ?????? ??????
					$this->set_member_o2o($sqlData);
					
					// ????????? ?????? ?????? - ????????? ??????
					// $this->send_barcode($sqlData['cellphone']);
				}
			}elseif($member_info['code'] == "1"){
				$o2oMemberJoinMsg = array('error_msg'=>'????????? ?????????????????? ?????? ???????????? ????????????.');
			}else{
				$o2oMemberJoinMsg = array('error_msg'=>$member_info['msg']);
			}
		}else{
			$o2oMemberJoinMsg = array('error_msg'=>'O2O ???????????? ????????? ??? ????????????.');
		}
		
		return $o2oMemberJoinMsg;
	}
	
	/**
	 * o2o ?????? ?????? ?????? ??????
	 * fm_member ???????????? 1:1 ??????
	 */
	public function set_member_o2o($sqlData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$sqlData['store_seq']	= $sqlData['o2o_auth_info']['store_seq'];
		$sqlData['pos_seq']		= $sqlData['o2o_auth_info']['pos_seq'];
		$sqlData['pos_key']		= $sqlData['o2o_auth_info']['pos_key'];
		
		if($sqlData['o2oauthnum_required'] == 'Y' && !empty($sqlData['o2oauthnum'])){
			$sqlData['auth_yn']		= 'Y';
			$sqlData['auth_date']	= date('Y-m-d H:i:s');
		}else{
			$sqlData['auth_yn']		= 'N';
			$sqlData['auth_date']	= null;
		}
		
		unset($sqlData['o2o_auth_info']);
		unset($sqlData['o2oauthnum_required']);
		unset($sqlData['o2oauthnum']);
		
		$result = $this->CI->o2omembermodel->insert_member_o2o($sqlData);
		
		return $result;
	}
	
	// o2o ?????? ?????? ?????? ??????
	public function upd_member_o2o($params){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2omembermodel->update_member_o2o($params);
			
		return $result;
	}
	
	// o2o ?????? ?????? ?????? ??????
	public function del_member_o2o($sqlData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2omembermodel->delete_member_o2o($sqlData);
		
		return $result;
	}
	
	// o2o ?????? ?????? ?????? ??????
	public function get_member_o2o($params, $limit=1) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2omembermodel->select_member_o2o($params, $limit);
		
		return $result;
	}
	
	// o2o ?????? ?????? ?????? ?????? ??????
	public function set_member_o2o_dr($sqlData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2omembermodel->insert_member_o2o_dr($sqlData);
		
		return $result;
	}
	
	// o2o ?????? ?????? ?????? ?????? ??????
	public function get_member_o2o_dr($params, $limit=1) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2omembermodel->select_member_o2o_dr($params, $limit);
		
		return $result;
	}
	
	// o2o ?????? ?????? ?????? ?????? ??????
	public function del_member_o2o_dr($sqlData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result = $this->CI->o2omembermodel->delete_member_o2o_dr($sqlData); //
		
		return $result;
	}
	
	// o2o ?????? ?????? ????????? ??????
	public function dormancy_on_member_o2o($sqlData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		$result = false;
		$member_o2o_rs	= $this->get_member_o2o($sqlData, "unlimit");
		foreach($member_o2o_rs as $member_o2o){
			
			$member_o2o_dr_seq = $this->set_member_o2o_dr($member_o2o);
			
			if($member_o2o_dr_seq){
				unset($paramUpdate);
				foreach($this->CI->o2omembermodel->tb_column_member_o2o as $fields){
					$paramUpdate[$fields] = '';
				}
				$paramUpdate['member_o2o_seq'] = $member_o2o['member_o2o_seq'];
				$result = $this->upd_member_o2o($paramUpdate);
			}
		}
		
		return $result;
	}
	// o2o ?????? ?????? ????????? ??????
	public function dormancy_off_member_o2o($sqlData){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		$result = false;

		$member_o2o_dr_rs	= $this->get_member_o2o_dr($sqlData, "unlimit");

		if($member_o2o_dr_rs){
			foreach($member_o2o_dr_rs as $member_o2o_dr){
				
				$paramUpdate = $member_o2o_dr;
				unset($paramUpdate['dormancy_seq']);
				$check = $this->upd_member_o2o($paramUpdate);
				
				if($check){
					$result = $this->del_member_o2o_dr(array('member_seq'=>$member_o2o_dr['member_seq']));
				}
			}
		}
		
		return $result;
	}
	
	// ?????? ?????? ?????? ?????? ??????
	// ????????? ?????????????????? pos ?????? ????????? ????????? ??????, ?????? userid??? ?????????????????? ???????????? ?????????.
	public function check_member_o2o($params, $mode='merge'){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		$result = false;
		unset($params_member);
		$params_member['cellphone'] = $params['cellphone'];
		
		// ???????????? ?????? ?????? cellphone
		$member_info = $this->get_member_info($params_member);
		
		if($mode=="merge"){
			if($member_info['result']['platform'] == 'POS' && $member_info['result']['userid'] == ''){
				$result = $member_info['result']['member_seq'];
			}
		}elseif($mode=="all"){
			$result = $member_info['result']['member_seq'];
		}
		return $result;
	}
	
	// ??????????????? ???????????? ?????? ?????? ?????? : ?????? ????????? ?????? ??????.
	public function get_member_info($params, $type='none') {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$phone = $params['cellphone'];
		
		// ?????? ?????? ??????
		unset($sc);
		$this->CI->load->model('membermodel');
		$sc['keyword']				= $phone;
		$sc['body_search_type']		= "cellphone";
		$sc['page']					= "0";
		$sc['perpage']				= "1";
		if($type=='all'){
			$sc['perpage']				= "999";
		}
		$memberInfo		= $this->CI->membermodel->admin_member_list($sc);
		if($memberInfo['count']>0){
			if($type=='all'){
				return $memberInfo;
			}else{
				$memberInfo = $memberInfo['result']['0'];
			}
		}else{
			$memberInfo = null;
		}
		
		// ????????? ??????
		unset($result);
		$result = array('code'=>'0', 'result'=>null, 'msg'=>'');
		if($memberInfo && $memberInfo['status'] == 'done'){			
			$result['result']['group_name']		= $memberInfo['group_name'];
			$result['result']['member_seq']		= $memberInfo['member_seq'];
			$result['result']['user_name']		= $memberInfo['user_name'];
			$result['result']['email']			= $memberInfo['email'];
			$result['result']['phone']			= $memberInfo['cellphone'];
			$result['result']['zipcode']		= $memberInfo['zipcode'];
			$result['result']['address_street']	= $memberInfo['address_street'];
			$result['result']['address_detail']	= $memberInfo['address_detail'];
			$result['result']['emoney']			= $memberInfo['emoney'];
			$result['result']['cash']			= $memberInfo['cash'];
			
			$result['result']['userid']			= $memberInfo['userid'];
			$result['result']['platform']		= $memberInfo['platform'];
			
			$result['code'] = '1';
			$result['msg'] = '??????';
		}elseif($memberInfo && $memberInfo['status'] == 'hold'){
			$result['code'] = '-1';
			$result['msg'] = '????????? ???????????????.';
		}elseif($memberInfo && $memberInfo['status'] == 'hold'){
			$result['code'] = '-2';
			$result['msg'] = '?????? ???????????????.';
		}else{
			$result['code'] = '0';
			$result['msg'] = '?????? ???????????? ????????????.';
		}
		return $result;
	}
	
	// ?????? ????????? ???????????? ?????? ?????? ?????? : ?????? ???????????? ??????????????? ?????? ??????
	public function get_member_info_by_barcode($params, $type='none') {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$member_barcode = $params['member_barcode'];
		
		// ???????????? ?????? ???????????? ??????
		// ???????????? ?????? - ?????? ????????? ??????
		$this->CI->load->library('o2o/o2obarcodelibrary');
		$member_seq = $this->CI->o2obarcodelibrary->decode_barcode_member($member_barcode);
		
		// ?????? ?????? ??????
		unset($sc);
		$this->CI->load->model('membermodel');
		$sc['member_seq']				= $member_seq;
		$sc['page']					= "0";
		$sc['perpage']				= "1";
		$memberInfo		= $this->CI->membermodel->admin_member_list($sc);
		if($memberInfo['count']>0){
			if($type=='all'){
				return $memberInfo;
			}else{
				$memberInfo = $memberInfo['result']['0'];
			}
		}else{
			$memberInfo = null;
		}
		
		// ????????? ??????
		unset($result);
		$result = array('code'=>'0', 'result'=>null, 'msg'=>'');
		if($memberInfo && $memberInfo['status'] == 'done'){			
			$result['result']['group_name']		= $memberInfo['group_name'];
			$result['result']['member_seq']		= $memberInfo['member_seq'];
			$result['result']['user_name']		= $memberInfo['user_name'];
			$result['result']['email']			= $memberInfo['email'];
			$result['result']['phone']			= $memberInfo['cellphone'];
			$result['result']['zipcode']		= $memberInfo['zipcode'];
			$result['result']['address_street']	= $memberInfo['address_street'];
			$result['result']['address_detail']	= $memberInfo['address_detail'];
			$result['result']['emoney']			= $memberInfo['emoney'];
			$result['result']['cash']			= $memberInfo['cash'];
			
			$result['result']['userid']			= $memberInfo['userid'];
			$result['result']['platform']		= $memberInfo['platform'];
			
			$result['code'] = '1';
			$result['msg'] = '??????';
		}elseif($memberInfo && $memberInfo['status'] == 'hold'){
			$result['code'] = '-1';
			$result['msg'] = '????????? ???????????????.';
		}elseif($memberInfo && $memberInfo['status'] == 'hold'){
			$result['code'] = '-2';
			$result['msg'] = '?????? ???????????????.';
		}else{
			$result['code'] = '0';
			$result['msg'] = '?????? ???????????? ????????????.';
		}
		return $result;
	}
	
	// ?????? ?????? ??????
	public function merge_member_o2o($params){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		$result = false;
		
		$member_seq = $this->check_member_o2o($params);
		if($member_seq){
			unset($params['regist_date']);
			unset($params['lastlogin_date']);
			unset($params['group_seq']);
			unset($params['platform']);			// ?????? ?????? o2o ????????? ??????
			
			$params['member_seq'] = $member_seq;
			$this->CI->load->model('membermodel');
			$data = filter_keys($params, $this->CI->db->list_fields('fm_member'));
			$this->CI->membermodel->update_member($data);
			
			// ???????????? ??? ???????????? ????????? ??????
			if( empty($this->CI->memberlibrary)) $this->CI->load->library('memberlibrary');
			$this->CI->memberlibrary->private_encrypt($member_seq, $params);
			
			$result = $member_seq;
		}
		return $result;
	}
	
	// ????????? ???????????? ?????? ?????? ????????? ??????.
	public function get_goods_onlyone_by_barcode(&$msg, $barcode){
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		// data = ?????? ??????, type = opt : ????????????, sub : ????????????
		$returnGoodsInfo = null;	// array('data'=>null, 'type'=>'' , 'goods'=>null);
		
		$this->CI->load->model('goodsmodel');
		
		unset($goods_params);
		$goods_params['full_barcode'][] = $barcode;
		
		unset($goodsOption);
		unset($goodsSuboption);
		$goodsOption = $this->CI->goodsmodel->get_goods_option_by_barcode($goods_params);
		$goodsSuboption = $this->CI->goodsmodel->get_goods_suboption_by_barcode($goods_params);

		if( 
			($goodsOption && $goodsSuboption)							//	?????? ????????? ?????? ?????? ??? ??? ?????? ?????? ????????????
			|| ($goodsOption && count($goodsOption) > 1)				//	?????? ????????? 1??? ??????
			|| ($goodsSuboption && count($goodsSuboption) > 1)			//	?????? ?????? ???????????? 1??? ??????
			|| ($goodsSuboption[0] && count($goodsSuboption[0]) > 1)	//	?????? ????????? 1??? ??????
		){		
			$msg .= "[".$barcode.":????????? ????????? ????????? ?????????????????????.]";
		}elseif($goodsOption && count($goodsOption) == 1){		//	?????? ????????? 1???
			// data = ?????? ??????, type = opt : ????????????, sub : ????????????
			$returnGoodsInfo = array('data'=>$goodsOption[0], 'type'=>'opt');
		}elseif($goodsSuboption[0] && count($goodsSuboption[0]) == 1){
			// data = ?????? ??????, type = opt : ????????????, sub : ????????????
			$returnGoodsInfo = array('data'=>$goodsSuboption[0][0], 'type'=>'sub');
		}
		if($returnGoodsInfo['data']['goods_seq']){		
			$returnGoodsInfo['goodsMasterInfo'] = $this->CI->goodsmodel->get_goods($returnGoodsInfo['data']['goods_seq']);
			// ????????? ?????? ??????
			$_images = $this->CI->goodsmodel->get_goods_image($returnGoodsInfo['data']['goods_seq'], array('cut_number'=>1,'image_type'=>'thumbCart'));
			$returnGoodsInfo['goodsMasterInfo']['image'] = $_images['1']['thumbCart']['image'];
		}
		return $returnGoodsInfo;
	}
	
	// O2O ?????? ???????????? ??????
	public function get_o2o_shipping_group($o2o_store_seq) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$result['shipping_method'] = null;
		$result['shipping_store_seq'] = null;
			
		// O2O ????????? ?????? ????????????, ?????? ????????? ????????? ????????? ?????? ???????????? ?????? ??????
		$this->CI->load->model('shippingmodel');
		$ship_list = $this->CI->shippingmodel->get_shipping_group_simple('1', 'O');
		if($ship_list[0]){
			$shipping_store = null;
			$result['shipping_method'] = $ship_list[0]['shipping_group_seq'];
			$shipping_store = $this->CI->shippingmodel->get_shipping_store($result['shipping_method']
									, 'shipping_group_seq_tmp'
									, array('shipping_address_seq'=>$this->CI->o2oConfig['o2o_store_seq']));
			$result['shipping_store_seq'] = $shipping_store[0]['shipping_store_seq'];
			
			// ?????? ??????
			$result['shippingGroup']		= $ship_list[0];		// ????????????
			$result['shippingStore']		= $shipping_store;		// ????????????
		}
		return $result;
	}
	
	// ????????? ????????? ????????? ??????
	public function get_o2o_sales_stat($params, &$out) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$this->CI->load->model("statsmodel");
		$out = $this->CI->statsmodel->o2o_sales_stat($params);
		/*
		?????? ??????
		$params_stats_v2 = array();
		$params_stats_v2['sdate']				= $params['sdate'];
		$params_stats_v2['edate']				= $params['edate'];
		$params_stats_v2['sitetype']			= array('POS');
		$params_stats_v2['provider_seq']		= '1';	// ?????? ?????? 
		$params_stats_v2['base_key']			= 'order_referer';	// ????????? ????????? ?????? ??????

		$this->CI->load->model("accountallmodel");
		$out = $this->CI->accountallmodel->get_sales_stat_v2($params_stats_v2);
		
		// ???????????? ??????????????? ??????
		$arr_o2o_store_seq = array();
		foreach($out as $row){
			$arr_o2o_store_seq[] = $row['order_referer'];
		}
		
		// ????????? ??????
		$loop = $this->get_o2o_config(array('o2o_store_seq'=>$arr_o2o_store_seq),"unlimit");
		
		// ???????????? ????????? ??????
		foreach($out as &$row){
			foreach($loop as $o2o_store){
				if($o2o_store['o2o_store_seq'] == $row['order_referer']){
					$row['pos_name'] = $o2o_store['pos_name'];
				}
			}
		}
		 */
	}
	
	// ?????? ????????? ????????? ????????? ??????
	public function get_o2o_goods_stat($params, &$out) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$this->CI->load->model("statsmodel");
		$out = $this->CI->statsmodel->o2o_goods_stat($params);
		/*
		?????? ??????
		$params_stats_v2 = array();
		$params_stats_v2['sdate']				= $params['sdate'];
		$params_stats_v2['edate']				= $params['edate'];
		$params_stats_v2['sitetype']			= array('POS');
		$params_stats_v2['provider_seq']		= '1';	// ?????? ?????? 
		$params_stats_v2['base_key']			= 'order_referer';	// ????????? ????????? ?????? ??????
		$params_stats_v2['order_referer']		= $params['o2o_store_seq'];

		$this->CI->load->model('accountallmodel');
		$out = $this->CI->accountallmodel->get_goods_stat_v2($params_stats_v2);
		*/
	}
	
	// ????????? ???????????? ???????????????
	public function get_o2o_goods_shipping_code($params, &$out) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$this->CI->load->model("statsmodel");
		$out = $this->CI->statsmodel->o2o_goods_shipping_code($params);
	}
	
	// ????????? ???????????? ???????????????
	public function get_o2o_refund_stat($params, &$out) {
		if(!$this->checkO2OService){return $this->checkO2OService;}
		
		$this->CI->load->model("statsmodel");
		$out = $this->CI->statsmodel->o2o_refund_stat($params);
	}


	// scm ?????? ?????? ??????
	public function set_o2o_scm_basic_store_regist($insert_wh_seq) {
		$this->CI->load->model('scmmodel');
		
		// ?????? ??????
		$warehouses		= $this->CI->scmmodel->get_warehouse(array('orderby'=>'wh_name'));
		
		// ?????? ?????? ????????????
		$stores = array();
		$store_list = array();
		$this->CI->load->library('scmlibrary');
		$this->CI->scmlibrary->get_scm_basic_store(array(), $stores, $store_list);
		
		if	($stores['record']) foreach($stores['record'] as $k => $data){
			if	($data['admin_env_seq'] > 0){
				
				// ?????? ?????? ??????
				$store = array();
				$manager = array();
				$this->CI->load->library('scmlibrary');
				$this->CI->scmlibrary->get_scm_basic_store_regist(array('sno'=>$data['admin_env_seq']), $store, $warehouses, $manager);
				
				$params['admin_env_seq']					= $store['admin_env_seq']; // 1
				$params['admin_shop_no']					= $store['shopSno']; // 106122
				$params['store_type']						= $store['store_type']; // on
				$params['admin_env_name']					= $store['admin_env_name']; // ???????????????
				$params['store_location']					= $store['store_location']; // KOR

				foreach($warehouses as $k=>$warehouse_detail){
					if($warehouse_detail['mine'] == 'y'){
						$params['used_wh'][]						= $warehouse_detail['wh_seq']; // 1
						$params['chk_wh'][]							= $warehouse_detail['wh_seq']; // 1
					}
					if($warehouse_detail['export_wh']=='y'){
						$params['export_wh']						= $warehouse_detail['wh_seq']; // 1
					}
					if($warehouse_detail['return_wh']=='y'){
						$params['return_wh']						= $warehouse_detail['wh_seq']; // 1
					}
				}
				
				$params['manager'][0][seq]					= $manager['manager_seq']; // 2
				$params['manager'][0][name]					= $manager['manager_name']; // 
				$params['manager'][0][partname]				= $manager['manager_partname']; // 
				$params['manager'][0][charge]				= $manager['manager_charge']; // 
				$params['manager'][0][phone_number]			= $manager['phone_number']; // 
				$params['manager'][0][extension_number]		= $manager['extension_number']; // 
				$params['manager'][0][cellphone_number]		= $manager['cellphone_number']; // 
				$params['manager'][0][email]				= $manager['email']; // 

				if($insert_wh_seq){
					$params['used_wh'][]						= $insert_wh_seq; // 1
					$params['chk_wh'][]							= $insert_wh_seq; // 1
				}
				
				$save_data = array();
				$this->CI->load->library('scmlibrary');
				$this->CI->scmlibrary->set_save_store($params, $save_data);
			}
		}
	}
}