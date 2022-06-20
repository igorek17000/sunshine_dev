<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH ."controllers/batch/displayCache".EXT);
class _gabiaFront extends displayCache {
	/*
	상품 디스플레이 캐시 자동 갱신
	*/
	public function create_display_cache()
	{
		$this->_create_display_cache();
		echo "complete";
	}

	public function set_google_verification()
	{
		$this->load->library('googleAdsApi');
		$aPostParams = $this->input->post();
		$this->googleadsapi->fileLog('set_google_verification', $aPostParams);
		if ($aPostParams['shopNo'] != $this->config_system['shopSno']) {
			echo json_encode(array(
				"result" => "error authentication"
			));
			exit();
		}
		if (! $aPostParams['googleVerificationToken']) {
			echo json_encode(array(
				"result" => "error verification"
			));
			exit();
		}
		config_save('partner', array(
			'google_verification_token' => $aPostParams['googleVerificationToken']
		));
		echo json_encode(array(
			"result" => "set verification"
		));
	}
}