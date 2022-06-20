<?php

Class BasicService extends ServiceBase
{

	protected $_ServiceName	= 'basic';

	public function __construct($params = array())
	{
		parent::__construct($params);
	}

	public function getServiceName(){ return $this->_ServiceName; }
	
	/* 상품고시 정보 불러오기 */
	public function getNotificationInfo($fmNotificationCode, $notificationDescJson, $market = '') {
		
		$this->_CI->load->helper('notification');
		
		$notificationDetail	= notificationDetail('forSearch');
		$notificationCode	= notificationCodeMatch($fmNotificationCode);
		$notificationInfo	= json_decode($notificationDescJson);
		
		$notifictionList	= array();
		
		foreach ((array)$notificationInfo as $key => $val) {
			$searchKey		= makeTextForSearch($key);
			$notiCode		= array_search($searchKey, $notificationDetail);
			preg_match('/^(D[0-9]+)/', $notiCode, $keyTemp);
			$notiKey		= $keyTemp[1];
			$notifictionList[$notiKey]	= $val;
		}

		if ($market != '') {
			
			if(stripos($market,"API") !== false){
				$rawNotiInfo		= $this->callOtherConnector("Notification/getNotificationInfo/{$notificationCode}/shoplinker");
			}else{
				$rawNotiInfo		= $this->callOtherConnector("Notification/getNotificationInfo/{$notificationCode}/{$market}");
			}
			
			$marketNotiInfo		= $rawNotiInfo['resultData'];
			$notificationCode	= $marketNotiInfo['notificationType']['key'];
			$marketNotiList		= array();
			
			foreach ((array)$marketNotiInfo['requiredList'] as $key => $val) {
				$keyExp	= explode('_', $key);
				$setKey	= $keyExp[0];
				$marketNotiList[$val]	= (isset($notifictionList[$setKey])) ? $notifictionList[$setKey] : '상세설명참조';
			}

			$notifictionList	= $marketNotiList;
		}

		$return['notificationCode']	= $notificationCode;
		$return['notifictionList']	= $notifictionList;
		
		return $return;
	}

	public function getAllMarkets($justMarkets = false, $onlyUsetAccount = true) {

		$supportMarkets	= $this->getSupportMarkets();
		$marketList		= array();
		$this->_CI->load->model('connectormodel');

		/*2017-12-06 샵링커 마켓 설정 추가*/
		$find			= $this->_CI->db->query("SELECT * FROM fm_market_account WHERE market LIKE 'API%' and delete_yn = 'N' and account_use = 'Y' group by market");
		$findRow		= $find->result();
		
		$this->_CI->load->model('connectormodel');
		$connectorModel		=& $this->_CI->connectormodel;
		foreach ($findRow as $val){
			$getParam['searchMarket'] = $val->market;
			$rtn = $connectorModel->getLinkageMarket($getParam);
			$supportMarkets[$val->market]['name'] = $rtn[0]['marketName'];
			$supportMarkets[$val->market]['productLink'] = '';
		}
		
		/*2017-12-06 샵링커 마켓 설정 추가*/
		
		foreach ($supportMarkets as $market => $val) {
			$marketList[$market]	= $val;

			if ($justMarkets !== true) {
				$marketList[$market]['sellerList']	= $this->getMarketSellers($market, $onlyUsetAccount);
				if (count($marketList[$market]['sellerList']) < 1)
					unset($marketList[$market]);
			}
		}
		return $marketList;

	}

	public function getMarketSellers($market, $onlyUsetAccount = true, $seller_id='') {

		$whereArr[]			= 'market = ?';
		$whereData[]		= $market;

		$whereArr[]			= 'delete_yn = ?';
		$whereData[]		= 'N';

		if ($onlyUsetAccount === true) {
			$whereArr[]		= 'account_use = ?';
			$whereData[]	= 'Y';
		}

		if ($seller_id) {
			$whereArr[]		= 'seller_id = ?';
			$whereData[]	= $seller_id;
		}
		
		$where			= implode(' AND ', $whereArr);

		$find			= $this->_CI->db->query("SELECT seller_id, market_other_info FROM fm_market_account WHERE {$where}", $whereData);
		$findRow		= $find->result();

		$sellerList		= [];
		foreach ($findRow as $val)
			$sellerList[]	= $val->seller_id;
		return $sellerList;
	}
	
	public function getShoplinkerMarkets($market) {
		$this->_CI->load->model('connectormodel');
		$connectorModel		=& $this->_CI->connectormodel;
		
		$whereArr[]			= "market LIKE 'API%'";
		
		$whereArr[]			= 'delete_yn = ?';
		$whereData[]		= 'N';
		
		$whereArr[]			= 'account_use = ?';
		$whereData[]		= 'Y';
		
		
		$where			= implode(' AND ', $whereArr);
		
		$find			= $this->_CI->db->query("SELECT market_auth_info FROM fm_market_account WHERE {$where}", $whereData);
		$findRow		= $find->result();
		
		$marketsList		= [];
		foreach ($findRow as $val){
			$authInfo = json_decode($val->market_auth_info,true);
			$params = array('mallCode'=>$authInfo['mallId']);
			$marketInfo = $connectorModel->getLinkageCompany($params);
			$marketsList[]	= $marketInfo[0]['mall_name'];
		}
		
		return $marketsList;
	}
	


	public function isConnectorUse()
	{
		if (strlen($this->_FmAccessKey) == 36)
			return true;
		else
			return false;
	}

}