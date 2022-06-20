<?php
/*
	라이트용 상품 리스팅 모델(front 사용)
	카테고리(goods/catalog), 지역(goods/location), 브랜드(goods/brand), 검색(goods/search), 베스트(goods/best), 신상품(goods/new_arrivals),
	이벤트(promotion/event_view), 사은품이벤트(promotion/gift_view), 미니샵(mshop/index)
*/
class goodslistmodel extends CI_Model {

	var $aFilterConfig	= array();
	var $aPageType		= array();
	var $aOrderby		= array();

	public function __construct(){
		parent::__construct();
		$this->load->driver('cache');
		$this->load->model('goodsmodel');
		$this->load->library('sale');
		$this->load->library('goodsList');
		$this->load->model('categorymodel');

		$this->aPageType = array(
			'catalog'		=> 'category',
			'brand'			=> 'brand',
			'location'		=> 'location',
			'search'		=> 'search_result',
			'event_view'	=> 'sales_event',
			'gift_view'		=> 'gift_event',
			'mshop'			=> 'mshop',
			'best'			=> 'bestproduct',
			'new_arrivals'	=> 'newproduct'
		);
		$this->aOrderby = array(
			'rank'			=> 'ranking',
			'new'			=> 'regist',
			'low'			=> 'low_price',
			'high'			=> 'high_price',
			'review'		=> 'review',
			'sales'			=> 'sale'
		);
	}

	protected function resetFilterConfig(){
		$this->aFilterConfig['category']	= false;
		$this->aFilterConfig['location']	= false;
		$this->aFilterConfig['brand']		= false;
		$this->aFilterConfig['freeship']	= false;
		$this->aFilterConfig['abroadship']	= false;
		$this->aFilterConfig['price']		= false;
		$this->aFilterConfig['rekeyword']	= false;
		$this->aFilterConfig['color']		= false;
		$this->aFilterConfig['seller']		= false;
		$this->aFilterConfig['orderby']		= 'ranking';
		$this->aFilterConfig['normal']		= true;
	}

	protected function loadFilterConfig($sPageType){
		$this->load->model('pagemanagermodel');
		$aDefaultSetting	= $this->pagemanagermodel->default_filters[$sPageType];
		if(in_array('category', $aDefaultSetting)){
			if( $sPageType == 'location' ) $this->aFilterConfig['location']	= true;
			else $this->aFilterConfig['category']	= true;
		}
		if(in_array('brand', $aDefaultSetting)){
			$this->aFilterConfig['brand']	= true;
		}
		if(in_array('freeship', $aDefaultSetting)){
			$this->aFilterConfig['freeship']	= true;
		}
		if(in_array('abroadship', $aDefaultSetting)){
			$this->aFilterConfig['abroadship']	= true;
		}
		if(in_array('price', $aDefaultSetting)){
			$this->aFilterConfig['price']	= true;
		}
		if(in_array('rekeyword', $aDefaultSetting)){
			$this->aFilterConfig['rekeyword']	= true;
		}
		if(in_array('color', $aDefaultSetting)){
			$this->aFilterConfig['color']	= true;
		}
		if(in_array('seller', $aDefaultSetting)){
			$this->aFilterConfig['seller']	= true;
		}
	}

	protected function setFilterConfig($sSearchFilter, $sSetMode){
		if( preg_match('/category/', $sSearchFilter) && $sSetMode != 'location' ){
			$this->aFilterConfig['category']	= true;
		}
		if( preg_match('/category/', $sSearchFilter) && $sSetMode == 'location' ){
			$this->aFilterConfig['location']	= true;
		}
		if( preg_match('/brand/', $sSearchFilter) && $sSetMode != 'brand' ){
			$this->aFilterConfig['brand']	= true;
		}
		if( preg_match('/freeship/', $sSearchFilter) ){
			$this->aFilterConfig['freeship']	= true;
		}
		if( preg_match('/abroadship/', $sSearchFilter) ){
			$this->aFilterConfig['abroadship']	= true;
		}
		if( preg_match('/price/', $sSearchFilter) ){
			$this->aFilterConfig['price']	= true;
		}
		if( preg_match('/rekeyword/', $sSearchFilter) ){
			$this->aFilterConfig['rekeyword']	= true;
		}
		if( preg_match('/color/', $sSearchFilter) ){
			$this->aFilterConfig['color']	= true;
		}
		if( preg_match('/seller/', $sSearchFilter) && !preg_match('/event_view|gift_view|mshop|best|new_arrivals/', $sSetMode) ){
			$this->aFilterConfig['seller']	= true;
		}
	}

	protected function getCategoryCodeFromLink($aResultGoodsSeq){
		if( !$aResultGoodsSeq || count($aResultGoodsSeq) == 0 ) return false;
		$query = "select goods_seq, category_code, link from fm_category_link where goods_seq in ('".implode("','", $aResultGoodsSeq)."')";
		$query = $this->db->query($query);
		foreach($query->result_array() as $data){
			foreach($this->categorymodel->split_category($data['category_code']) as $cate) $tmp_category_arr[$data['goods_seq']][] = $cate;
			$result[$data['goods_seq']]['r_category'] = array_values(array_unique($tmp_category_arr[$data['goods_seq']]));
			if( $data['link']  == 1 ){
				$result_category[$data['goods_seq']]['category_code'] = $data['category_code'];
			}
		}
		return array($result, $result_category);
	}

	protected function goodsListInfo($sPlatform, $aGoodsSeqs)
	{
		$result = array();
		$this->db->select("go.goods_seq, go.goods_status, go.provider_seq, go.goods_name, go.summary, go.review_count, go.review_sum, go.color_pick, go.purchase_ea, go.shipping_group_seq, go.reserve_policy, go.wish_count, go.sale_seq, gp.consumer_price, gp.price, gp.reserve_rate, gp.reserve_unit, gp.reserve, gs.brand_code, gs.today_icon, gs.today_solo_start, gs.today_solo_end, gs.brand_title, go.string_price_use, go.string_price,go.string_price_link, go.string_price_link_url, go.member_string_price_use, go.member_string_price, go.member_string_price_link, go.member_string_price_link_url, go.allmember_string_price_use, go.allmember_string_price, go.allmember_string_price_link, go.allmember_string_price_link_url, go.string_price_color, go.member_string_price_color, go.allmember_string_price_color,go.tax,gp.option1,gp.option2,gp.option2,gp.option3,gp.option4,gp.option5");
		$this->db->from("fm_goods go");
		$this->db->join("fm_goods_option gp", "go.goods_seq = gp.goods_seq", "inner");
		$this->db->join("fm_goods_list_summary gs", "go.goods_seq = gs.goods_seq", "inner");
		$this->db->where('gp.default_option', 'y');
		$this->db->where('gs.platform', $sPlatform);
		$this->db->where_in('go.goods_seq', $aGoodsSeqs);
		foreach ($this->db->get()->result_array() as $data) {
			$result[$data['goods_seq']] = $data;
		}
		return $result;
	}

	// image_size
	public function goodsSearch($aParams, $sGoodsQuery, $iTotcount='')
	{	    
		$cfg_reserve = ($this->reserves) ? $this->reserves : config_load('reserve');
		switch ($aParams['sorting']) {
			case "ranking":
				$sSorting	= "gs.ranking_point DESC";
				break;
			case "regist":
				$sSorting	= "go.goods_seq DESC";
				break;
			case "low_price":
				$sSorting	= "go.default_price ASC";
				break;
			case "high_price":
				$sSorting	= "go.default_price DESC";
				break;
			case "review":
				$sSorting	= "go.review_count DESC";
				break;
			case "sale":
				$sSorting	= "go.purchase_ea DESC";
				break;
		}

		$this->db->select("go.goods_seq");
		$this->db->from("fm_goods go use index (view_index_orderby_seq)");
		$this->db->join("fm_goods_list_summary gs", "go.goods_seq = gs.goods_seq", "inner");
		$this->db->where("EXISTS (SELECT 1 FROM ".$sGoodsQuery." fm_goods WHERE fm_goods.goods_seq = go.goods_seq)", null, false);
		$this->db->where("gs.platform", $aParams['platform']);

		// 카테고리 페이지에서 카테고리 외 검색 조건이 없을 경우 랭킹으로 정렬시 정렬 재정의
		if ($aParams['sorting'] == 'ranking' && $aParams['searchMode'] == 'catalog' && $aParams['category'] && ! $aParams['brand'] && ! $aParams['color'] && ! $aParams['delivery'] && ! $aParams['provider'] && ! $aParams['re_search'] && ! $aParams['location'] && ! $aParams['min_price'] && ! $aParams['max_price']) {
			$this->db->join("fm_category_link cl", "go.goods_seq = cl.goods_seq", "inner");
			$this->db->where("cl.category_code", str_replace('c', '', $aParams['category']));
			$sSorting	= "cl.sort ASC, go.goods_seq DESC";
		}

		// 브랜드 페이지에서 브랜드 외 검색 조건이 없을 경우 랭킹으로 정렬시 정렬 재정의
		if ($aParams['sorting'] == 'ranking' && $aParams['searchMode'] == 'brand' && $aParams['brand'] && ! $aParams['category'] && ! $aParams['color'] && ! $aParams['delivery'] && ! $aParams['provider'] && ! $aParams['re_search'] && ! $aParams['location'] && ! $aParams['min_price'] && ! $aParams['max_price']) {
			$this->db->join("fm_brand_link cl", "go.goods_seq = cl.goods_seq", "inner");
			$this->db->where("cl.category_code", str_replace('b', '', $aParams['brand'][0]));
			$sSorting	= "cl.sort ASC, go.goods_seq DESC";
		}

		// 지역 페이지에서 지역 외 검색 조건이 없을 경우 랭킹으로 정렬시 정렬 재정의
		if ($aParams['sorting'] == 'ranking' && $aParams['searchMode'] == 'location' && $aParams['location'] && ! $aParams['category'] && ! $aParams['color'] && ! $aParams['delivery'] && ! $aParams['provider'] && ! $aParams['re_search'] && ! $aParams['brand'] && ! $aParams['min_price'] && ! $aParams['max_price']) {
			$this->db->join("fm_location_link cl", "go.goods_seq = cl.goods_seq", "inner");
			$this->db->where("cl.location_code", str_replace('b', '', str_replace('l', '', $aParams['location'])));
			$sSorting = "cl.sort ASC, go.goods_seq DESC";
		}

		
		// 베스트
		if ($aParams['sorting'] == 'sale' && $aParams['searchMode'] == 'best') {
			// 설정 내용 호출
			$this->load->model('pagemanagermodel');
			$page_config = $this->pagemanagermodel->get_page_config('bestproduct', 'responsive');
			$sSorting	= "go.purchase_ea DESC";
			if ($page_config['orderby'][0] == 'monthly') {
				$sSorting	= "go.purchase_ea_3mon DESC, go.purchase_ea DESC";
			}
		}
		$this->db->order_by($sSorting);
		$sQuery = $this->db->get_compiled_select();
		$result = select_page($aParams['perpage'], $aParams['page'], 5, $sQuery, $bind, null, $iTotcount);
		foreach ($result['record'] as $k => $data) {
			$data['org_price']		= ($data['consumer_price']) ? $data['consumer_price'] : $data['price'];
			$aResultGoodsSeq[]		= $data['goods_seq'];
			$aShippingGroupSeqForGoods[$data['goods_seq']]	= $data['shipping_group_seq'];
			$aShippingGroupSeq[]							= $data['shipping_group_seq'];
			$result['record'][$k]	= $data;
		}
		
		// 추가 정보
		$aGoods = $this->goodsListInfo($aParams['platform'], $aResultGoodsSeq);
		$aImagesGoods			= $this->goodsmodel->get_images($aResultGoodsSeq, $aParams['image_size']);
		$aColorsGoods			= $this->goodsmodel->get_colors($aResultGoodsSeq);
		$aProviderGoods			= $this->goodsmodel->get_provider_names($aResultGoodsSeq);
		$aBrandsGoods			= $this->goodsmodel->get_goods_brands($aResultGoodsSeq);
		$aShippingSummarys		= $this->goodsmodel->get_goods_shipping_summary($aShippingGroupSeqForGoods, $aShippingGroupSeq);
		list ($aCategoryCodesGoods, $aCategoryCodeGoods) = $this->getCategoryCodeFromLink($aResultGoodsSeq);
		$aCategorysGoods		= $this->goodsmodel->get_goods_categorys($aCategoryCodeGoods);
		if (! empty($aParams['member_seq'])) {
			$aWishsGoods = $this->goodsmodel->get_goods_wish($aResultGoodsSeq, $aParams['member_seq']);
		}
		// 추가 정보 조합
		foreach ($result['record'] as $k => $data) {
			$data = $aGoods[$data['goods_seq']];
			$data['image']			= $aImagesGoods[$data['goods_seq']]['image1'];
			$data['image2']			= $aImagesGoods[$data['goods_seq']]['image2'];
			$data['image_cnt']		= $aImagesGoods[$data['goods_seq']]['image_cnt'];
			$data['image1_large']	= $aImagesGoods[$data['goods_seq']]['image1_large'];
			$data['image2_large']	= $aImagesGoods[$data['goods_seq']]['image2_large'];
			// 19mark 이미지
			$markingAdultImg = $this->goodslist->checkingMarkingAdultImg($data);
			if ($markingAdultImg) {
				$data['image'] = $data['image2'] = $data['image1_large'] = $data['image2_large']	= $this->goodslist->adultImg;
			}
			$data['colors']			= $aColorsGoods[$data['goods_seq']];
			$data['provider_name']	= $aProviderGoods[$data['goods_seq']]['provider_name'];
			$data['pgroup_icon']	= $aProviderGoods[$data['goods_seq']]['pgroup_icon'];
			$data['pgroup_name']	= $aProviderGoods[$data['goods_seq']]['pgroup_name'];
			$data['category_code']	= $aCategoryCodeGoods[$data['goods_seq']]['category_code'];
			$data['r_category']		= $aCategoryCodesGoods[$data['goods_seq']]['r_category'];
			$data['r_brand']		= $aBrandsGoods[$data['goods_seq']]['r_brand'];
			$data['wish']			= $aWishsGoods[$data['goods_seq']]['wish'];
			$data['shipping_group'] = $aShippingSummarys[$data['goods_seq']]['shipping_group'];
			$data['category']		= $aCategorysGoods[$data['goods_seq']]['title'];
			
			/**
			 * 무료배송 사용 여부
			 * 2019-07-10
			 * @author Sunha Ryu
			 * @see #36384
			 */
			if (! empty($data['shipping_group']) && $data['shipping_group']['free_shipping_use'] === 'Y') {
			    $data['free_delivery'] = true;
			} else {
			    $data['free_delivery'] = false;
			}
			
			/**
			 * 해외배송 사용 여부
			 * 2019-07-10
			 * @author Sunha Ryu
			 * @see #36384
			 */
			if (! empty($data['shipping_group']) && $data['shipping_group']['gl_shipping_yn'] === 'Y') {
			    $data['free_overseas'] = true;
			} else {
			    $data['free_overseas'] = false;
			}

			//--> sale library 적용
			$aSaleParams = array(
				'consumer_price' => $data['consumer_price'],
				'price' => $data['price'],
				'total_price' => $data['price'],
				'ea' => 1,
				'category_code' => $data['r_category'],
				'brand_code' => $data['r_brand'],
				'goods_seq' => $data['goods_seq'],
				'goods' => $data,
				'group_seq' => $this->userInfo['group_seq']
			);
			$this->sale->set_init($aSaleParams);
			$aSales	= $this->sale->calculate_sale_price('list');
            // GA4연동으로 인해 sale_list 전달
            $data['sale_list'] = $aSales['sale_list'];
			$data['sale_price']	= $aSales['result_price'];
			$data['sale_per']	= $aSales['sale_per'];
			$data['eventEnd']	= $aSales['eventEnd'];
			$data['event_text']	= trim($aSales['text_list']['event']);
			$data['event_order_ea']	= $aSales['event_order_ea'];
			$reserve				= $this->goodsmodel->get_reserve_with_policy($data['reserve_policy'], $aSales['result_price'], $cfg_reserve['default_reserve_percent'], $data['reserve_rate'], $data['reserve_unit'], $data['reserve']);
			$data['reserve']		= $reserve + $aSales['tot_reserve'];
			$this->sale->reset_init();
			//<-- sale library 적용			

			$data['string_price'] = get_string_price($data);
			$data['string_price_use'] = 0;
			if ($data['string_price'] != '') {
				$data['string_price_use'] = 1;
			}			
			$result['record'][$k]		= $data;
		}
		return $result;
	}

	public function queryBuild($aParams, $sPageMode='search', $bTmpCreate=true)
	{
		$not_in_goods_seq		= array();
		$not_in_category_code	= array();
		$in_goods_seq			= array();
		$in_category_code		= array();
		$aProvider_seq			= array();

		$bTmpCreate = false; // 서브쿼리 사용으로 변경

		$sGoodsStatusWhere	= "go.goods_type = 'goods' AND go.provider_status ='1' AND go.goods_view = 'look'";
		if( $this->aFilterConfig['normal'] ){
			$aGoodsStatusWhere[] = 'normal';
		}
		if( $this->aFilterConfig['runout'] ){
			$aGoodsStatusWhere[] = 'runout';
		}
		if( $this->aFilterConfig['purchasing'] ){
			$aGoodsStatusWhere[] = 'purchasing';
		}
		if( $this->aFilterConfig['unsold'] ){
			$aGoodsStatusWhere[] = 'unsold';
		}
		
		$iGoodsStatusWhere = count($aGoodsStatusWhere);
		if( $aGoodsStatusWhere && $iGoodsStatusWhere > 1 ){						
			$sGoodsStatusWhere .= " AND go.goods_status in ('".implode("','", $aGoodsStatusWhere)."')";
						
		}else{
			$sGoodsStatusWhere .= " AND go.goods_status = 'normal'";
		}
		
		if($aParams['platform']){
			$sTable	.= " INNER JOIN fm_goods_list_summary gl ON go.goods_seq = gl.goods_seq AND gl.platform = ?";
			$aBind[]	= $aParams['platform'];
		}
		if($aParams['category']){
			$sTable	.= " INNER JOIN fm_category_link cl ON go.goods_seq = cl.goods_seq ";
		}
		if($aParams['location']){
			$sTable	.= " INNER JOIN fm_location_link cl ON go.goods_seq = cl.goods_seq ";
		}
		if($aParams['bcode']){
			$aBrandTable[] = "bl.category_code like ?";
			$aBind[]	= str_replace('b', '', $aParams['bcode'])."%";
		}
		if($aParams['brand']){
			$aBrandTable[] = "bl.category_code in ('".str_replace('b','',implode("','", $aParams['brand']))."')";
		}
		if( $aBrandTable ){
			$sTable	.= " INNER JOIN fm_brand_link bl ON go.goods_seq = bl.goods_seq";
			$aWhere[]	= "(".implode(' AND ', $aBrandTable).")";
		}
		if($aParams['delivery']){
			foreach( $aParams['delivery'] as $sDelivery ){
				if( $sDelivery == 'free' ){
					$aTmpDelivery[] = "free_shipping_use = 'Y'";
				}
				if( $sDelivery == 'overseas' ){
					$aTmpDelivery[] = "gl_shipping_yn = 'Y'";
				}
			}
			if($aTmpDelivery){
				$sTable .= " INNER JOIN fm_shipping_group_summary sg ON go.shipping_group_seq = sg.shipping_group_seq AND (".implode(' OR ', $aTmpDelivery).')';
			}
		}

		if($aParams['category']){
			$aWhere[]	= "cl.category_code = ?";
			$aBind[]	= str_replace('c','',$aParams['category']);
		}
		if($aParams['location']){
			$aWhere[]	= "cl.location_code = ?";
			$aBind[]	= str_replace('l','',$aParams['location']);
		}
		if($aParams['keyword']){
			$aWhere[]	= "(go.goods_name like ? OR go.keyword like ?)";
			$aBind[]	= "%".$aParams['keyword']."%";
			$aBind[]	= $aBind[count($aBind)-1];
		}
		if($aParams['re_search']){
			$aWhere[]	= "(go.goods_name like ? OR go.keyword like ?)";
			$aBind[]	= "%".$aParams['re_search']."%";
			$aBind[]	= $aBind[count($aBind)-1];
		}
		if($aParams['provider']){
			$aWhere[]	= "go.provider_seq = ?";
			$aBind[]	= $aParams['provider'];
		}
		if($aParams['min_price']){
			$aWhere[]	= "go.default_price >= ?";
			$aBind[]	= $aParams['min_price'];
		}
		if($aParams['max_price']){
			$aWhere[]	= "go.default_price <= ?";
			$aBind[]	= $aParams['max_price'];
		}
		if( $aParams['color'] ){
			foreach( $aParams['color'] as $sColor ){
				$aTmpColor[]	= "go.color_pick like ?";
				$aBind[]		= "%".$sColor."%";
			}
			$aWhere[]	= "(".implode(' OR ', $aTmpColor).")";
		}
		if($aParams['shop_group']){
			$aWhere[]	= "go.shipping_group_seq = ?";
			$aBind[]	= $aParams['shop_group'];
		}
		if($aParams['searchMode'] == 'best'){
		    $sSubQuery	= "SELECT go.goods_seq FROM fm_goods go WHERE ".$sGoodsStatusWhere." ORDER BY go.purchase_ea DESC LIMIT ".$aParams['searchLimit'];
			$rSubQuery	= $this->db->query($sSubQuery);
			foreach($rSubQuery->result_array() as $aSubData){
				$in_goods_seq[] = $aSubData['goods_seq'];
			}
		}
		if($aParams['searchMode'] == 'new_arrivals'){
			$sSubQuery	= "SELECT go.goods_seq FROM fm_goods go WHERE ".$sGoodsStatusWhere." ORDER BY go.goods_seq DESC LIMIT 100";
			$rSubQuery	= $this->db->query($sSubQuery);
			foreach($rSubQuery->result_array() as $aSubData){
				$in_goods_seq[] = $aSubData['goods_seq'];
			}
		}

		if($aParams['event']){
			$query = "select goods_seq, category_code, choice_type from fm_event_choice where choice_type in ('except_goods','except_category','category','goods') and event_seq = ?";
			$query = $this->db->query($query, array($aParams['event']));
			foreach($query->result_array() as $event_choice_data){
				if( $event_choice_data['choice_type']=='except_goods'
						&& !in_array( $event_choice_data['goods_seq'], $not_in_goods_seq) )
				{
					$not_in_goods_seq[] = $event_choice_data['goods_seq'];
				}
				if( $event_choice_data['choice_type']=='goods'
						&& !in_array($event_choice_data['goods_seq'],$in_goods_seq) )
				{
					$in_goods_seq[]	= $event_choice_data['goods_seq'];
				}
				if( $event_choice_data['choice_type']=='except_category'
						&& !in_array($event_choice_data['category_code'],$not_in_category_code) )
				{
					$not_in_category_code[]	= $event_choice_data['category_code'];
				}
				if( $event_choice_data['choice_type']=='category'
						&& !in_array($event_choice_data['category_code'],$in_category_code) )
				{
					$in_category_code[]	= $event_choice_data['category_code'];
				}
			}

			$sQuery = "SELECT provider_list FROM fm_event_benefits WHERE event_seq = ?";
			$rQuery = $this->db->query($sQuery,$aParams['event']);

			foreach($rQuery->result_array() as $k => $v)
			{
				$aProvider_seq = array_filter(explode('|',$v['provider_list']));
			}
			if(count($aProvider_seq)>0){
				$aWhere[]	= "go.provider_seq in (".implode(',', $aProvider_seq).")";
			}
		}

		if($aParams['gift']){
			$query = "select * from fm_gift_choice where gift_seq=?";
			$query = $this->db->query($query, array($aParams['gift']));
			foreach($query->result_array() as $gift_choice_data){

				if( $gift_choice_data['choice_type']=='goods'
				&& !in_array( $gift_choice_data['goods_seq'],$in_goods_seq) )
				{
					$in_goods_seq[] = $gift_choice_data['goods_seq'];
				}
				if( $gift_choice_data['choice_type']=='category'
				&& !in_array( $gift_choice_data['category_code'],$in_category_code) )
				{
					$in_category_code[] = $gift_choice_data['category_code'];
				}
			}
		}

		if( $aParams['event'] || $aParams['gift'] ) {
			// 이벤트 상품, 카테고리 모두 미 설정 시 상품 0개로 노출
			if( count($not_in_goods_seq) == 0 && count($in_goods_seq) == 0 && count($not_in_category_code) == 0 && count($in_category_code) == 0 ) {
				return;
			}
		}

		if( count($not_in_goods_seq) > 0 ){
			$aWhere[]	= "go.goods_seq not in (".implode(',', $not_in_goods_seq).")";
		}
		if( count($in_goods_seq) > 0 ){
			$aWhere[]	= "go.goods_seq in (".implode(',', $in_goods_seq).")";
		}
		if(!$aWhere) $aWhere[] = 'go.goods_seq';

		$sQuery = "SELECT go.goods_seq FROM fm_goods go use index (view_index_orderby_seq)";
		// 이벤트 카테고리로 설정 시 $sQuery를 서브쿼리로 변환 2019-06-18 by hyem
		if( count($not_in_category_code) > 0 || count($in_category_code) > 0 ){
			if( count($not_in_category_code) > 0 ) $EventWheres[] = "category_code not in ('".implode("','", $not_in_category_code)."')";
			if( count($in_category_code) > 0 ) $EventWheres[] = "category_code in ('".implode("','", $in_category_code)."')";
			if( count($EventWheres) > 0 ){
				$sQuery = "SELECT go.goods_seq FROM (select g.* from fm_category_link ccl, fm_goods as g where ".implode(' OR ', $EventWheres)." and g.goods_seq=ccl.goods_seq) go";
			}
		}
		if( $sTable ){
			$sQuery .= $sTable;
		}
		if( $aWhere ){
			$sQuery .= " WHERE ".$sGoodsStatusWhere." AND ".implode(' AND ', $aWhere)." group by go.goods_seq";
		}

		$sResult	= $this->db->compile_binds($sQuery, $aBind);

		if( $bTmpCreate ){
			$sTempQuery	= "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_goods_list` ( INDEX( goods_seq ) ) ENGINE = MYISAM AS " . $sResult;
			$this->db->query($sTempQuery);
			$sResult	= "tmp_goods_list";
		}else{
			$sResult = "(".$sResult.")";
		}

		return $sResult;
	}

	public function categorysForFilter($sGoodsQuery, $category = '', $sPageMode = 'search')
	{
		$category_main_qb = (clone $this->db)->reset_query();
		$category_count_qb = (clone $this->db)->reset_query();
		$category_count_qb->select('count(1)')
			->from('fm_category_link')
			->where('fm_category_link.category_code = fm_category.category_code');
		
		$category_main_qb->from('fm_category')->having('cnt > 0');
		
		if (is_array($category)) {
			$category_main_qb->where_in('category_code', $category);
		} else {
			$category_level = intdiv(strlen($category), 4) + 1;
			$category_main_qb->where('level', $category_level + 1);
			if ($category) {
				$category_main_qb->like('category_code', $category, 'after');
			}
		}
		$category_main_qb->where('hide', '0');

		$category_count_qb->where("EXISTS (SELECT 1 FROM {$sGoodsQuery} fm_goods WHERE fm_goods.goods_seq = fm_category_link.goods_seq)", null, false);
		$result_set = $category_main_qb->select("fm_category.category_code, fm_category.title as category_name, ({$category_count_qb->get_compiled_select()}) cnt")->get();
		return $result_set ? $result_set->result_array() : [];
	}

	public function locationsForFilter($sGoodsQuery, $location = '', $sPageMode = 'search')
	{
		$location_main_qb = (clone $this->db)->reset_query();
		$location_count_qb = (clone $this->db)->reset_query();
		$location_count_qb->select('count(1)')
			->from('fm_location_link')
			->where('fm_location_link.location_code = fm_location.location_code');
		
		$location_main_qb->from('fm_location')->having('cnt > 0');
		
		if (is_array($location)) {
			$location_main_qb->where_in('location_code', $location);
		} else {
			$location_level = intdiv(strlen($location), 4) + 1;
			$location_main_qb->where('level', $location_level + 1);
			if ($location) {
				$location_main_qb->like('location_code', $location, 'after');
			}
		}
		$location_main_qb->where('hide', '0');

		$location_count_qb->where("EXISTS (SELECT 1 FROM {$sGoodsQuery} fm_goods WHERE fm_goods.goods_seq = fm_location_link.goods_seq)", null, false);
		$result_set = $location_main_qb->select("fm_location.location_code, fm_location.title as location_name, ({$location_count_qb->get_compiled_select()}) cnt")->get();
		return $result_set ? $result_set->result_array() : [];
	}

	public function brandsForFilter($sGoodsQuery, $sPageMode)
	{
		$brand_main_qb = (clone $this->db)->reset_query();
		$brand_count_qb = (clone $this->db)->reset_query();
		$brand_count_qb->select('count(1)')
			->from('fm_brand_link')
			->where('fm_brand_link.category_code = fm_brand.category_code');
		
		$brand_main_qb->from('fm_brand')->having('cnt > 0')->order_by('cnt', 'DESC');
		
		$iLevel = 2;
		if ($sPageMode == 'brand') {
			$iLevel = 3;
		}
		
		$brand_main_qb->where('level', $iLevel);
		if ($brand) {
			$brand_main_qb->like('category_code', $brand, 'after');
		}
		$brand_main_qb->where('hide', '0');

		$brand_count_qb->where("EXISTS (SELECT 1 FROM {$sGoodsQuery} fm_goods WHERE fm_goods.goods_seq = fm_brand_link.goods_seq)", null, false);
		$result_set = $brand_main_qb->select("fm_brand.category_code as brand_code, fm_brand.title as brand_name, ({$brand_count_qb->get_compiled_select()}) cnt")->get();
		return $result_set ? $result_set->result_array() : [];
	}

	public function colorsForFilter($sGoodsQuery)
	{
		$result = array();
		$this->db->select("fm_goods.color_pick");
		$this->db->from("fm_goods");
		$this->db->where("fm_goods.color_pick!=", "");
		$this->db->group_by("fm_goods.color_pick");
		if($sGoodsQuery){
			$this->db->join($sGoodsQuery." as stb", 'stb.goods_seq = fm_goods.goods_seq', 'inner');
		}
		$result_set = $this->db->get();
		foreach ($result_set->result_array() as $aData) {
			$aTmp = explode(',', $aData['color_pick']);
			foreach ($aTmp as $sColor) {
				if (! in_array($sColor, $result)) {
					$result[] = $sColor;
				}
			}
		}
		return $result;	
	}

	public function providersFilter($sGoodsQuery)
	{
		// sGoodsQuery 없는 경우에는 빈 배열로 return
		if(!$sGoodsQuery) return [];

		$provider_main_qb = (clone $this->db)->reset_query();
		$provider_count_qb = (clone $this->db)->reset_query();
		$tmp = $provider_count_qb->select('fm_goods.goods_seq, fm_goods.provider_seq')->from("fm_goods, ({$sGoodsQuery}) as tmp")->where("fm_goods.goods_seq=tmp.goods_seq")->get_compiled_select();
		$provider_main_qb->from("fm_provider")->join("({$tmp}) as tmp2", "fm_provider.provider_seq=tmp2.provider_seq")->group_by("fm_provider.provider_seq");
		$result_set = $provider_main_qb->select("fm_provider.provider_seq, fm_provider.provider_name, count(*) cnt")->get();
		return $result_set ? $result_set->result_array() : [];
	}

	public function deliverysForFilter($sGoodsQuery, $aCodes, $aFilterConfig){		
		if( !$aFilterConfig['freeship'] )	unset($aCodes[0]);
		if( !$aFilterConfig['abroadship'] )	unset($aCodes[1]);
		
		return $aCodes;
	}

	public function maxGoodsPriceFilter($sGoodsQuery)
	{
		$this->db->select('max(fm_goods.default_price) max_price')->from('fm_goods');
		$this->db->where("EXISTS (SELECT 1 FROM {$sGoodsQuery} fm_goods WHERE fm_goods.goods_seq = fm_goods.goods_seq)", null, false);
		$rQuery = $this->db->get();
		$aData = $rQuery->row_array();
		return $aData['max_price'];
	}

	public function goodsList($aParams, $aGoodsSeq)
	{
		$result = select_page($aParams['perpage'], $aParams['page'], 10, $sQuery, array());
		return $result;
	}

	protected function autoCompleteRecommRowFilter($aResultGoodsSeq, $aResult, $applypage){
		if(!$aResultGoodsSeq) return false;
		$aImagesGoods	= $this->goodsmodel->get_images($aResultGoodsSeq, 'list1');
		list($aCategoryCodesGoods, $aCategoryCodeGoods)	= $this->getCategoryCodeFromLink($aResultGoodsSeq);

		foreach($aResult as $row){
			// 카테고리정보
			$row['r_category']		= $aCategoryCodesGoods[$row['goods_seq']]['r_category'];
			$row['goods_img']		= $aImagesGoods[$row['goods_seq']]['image1'];

			//----> sale library 적용
			unset($param, $sales);
			$param['option_type']				= 'option';
			$param['consumer_price']			= $row['consumer_price'];
			$param['price']						= $row['price'];
			$param['total_price']				= $row['price'];
			$param['ea']						= 1;
			$param['category_code']				= $row['r_category'];
			$param['goods_seq']					= $row['goods_seq'];
			$param['goods']						= $row;
			$this->sale->set_init($param);
			$sales								= $this->sale->calculate_sale_price($applypage);
			$row['price']						= $sales['result_price'];
			$this->sale->reset_init();
			//<---- sale library 적용

			// 회원 등급별 가격대체문구 출력
			$row['string_price'] = get_string_price($row);
			$row['string_price_use']	= 0;
			if	($row['string_price'] != '')	$row['string_price_use']	= 1;

			$temp_price = "";
			if ($row['string_price_use']==1) {
				$temp_price = $row['string_price'];
			} else {
				$temp_price = get_currency_price($sales['sale_price'],2);
			}
			$row['replace_price'] = $temp_price;

			//예약 상품의 경우 문구를 넣어준다 2016-11-07
			$row['goods_name']	=  get_goods_pre_name($row);

			$result_recomm[] = $row;
		}
		return $result_recomm;
	}
	
	public function autoCompleteRecomm($sKeyword, $enddate, $member_seq, $group_seq)
	{
		$cfg_reserve = ($this->reserves) ? $this->reserves : config_load('reserve');

		// ----> sale library 적용
		$applypage = 'list';
		$param['cal_type'] = 'list';
		$param['reserve_cfg'] = $cfg_reserve;
		$param['member_seq'] = $member_seq;
		$param['group_seq'] = $group_seq;
		$this->sale->set_init($param);
		$this->sale->preload_set_config($applypage);
		// <---- sale library 적용
		$subRand = 'rand() * (' . $this->db->select_max('goods_seq', 'max_goods_seq')
			->from('fm_goods')
			->get_compiled_select() . ')';
		$this->db->reset_query();
		$query = $this->db->select('fm_goods.goods_seq, fm_goods.goods_name, fm_goods.sale_seq, fm_goods.string_price_use, fm_goods.string_price')
			->select('fm_goods.member_string_price_use, fm_goods.member_string_price, fm_goods.allmember_string_price_use, fm_goods.allmember_string_price')
			->select('fm_goods_option.price, fm_goods_option.consumer_price')
			->from('fm_goods')
			->join('fm_order_item', 'fm_order_item.goods_seq = fm_goods.goods_seq', 'inner')
			->join('fm_goods_export_item', 'fm_goods_export_item.item_seq = fm_order_item.item_seq', 'inner')
			->join('fm_goods_export', 'fm_goods_export.export_code = fm_goods_export_item.export_code', 'inner')
			->join('fm_goods_option', 'fm_goods_option.goods_seq = fm_goods.goods_seq', 'inner')
			->where(array(
			'fm_goods_option.default_option' => 'y',
			'fm_goods.goods_view' => 'look',
			'fm_goods.goods_type' => 'goods'
		))
			->where(array(
			'fm_goods.goods_seq>=' => '{subquery}'
		))
			->where(array(
			'fm_goods_export.`status`' => '75',
			'fm_goods_export.shipping_date >=' => $enddate
		))
			->like('fm_goods.goods_name', $sKeyword)
			->group_by("fm_goods.goods_seq")
			->limit(3)
			->get_compiled_select();
		$query = str_replace("'{subquery}'", $subRand, $query);
		$query = $this->db->query($query);
		foreach ($query->result_array() as $row) {
			$aResultGoodsSeq[] = $row['goods_seq'];
			$aResult[] = $row;
		}
		if ($aResult[0]['goods_seq']) {
			$result_recomm = $this->autoCompleteRecommRowFilter($aResultGoodsSeq, $aResult, $applypage);
		}

		if (! $result_recomm) {
			$this->db->reset_query();
			$aResultGoodsSeq = array();
			$aResult = array();
			$query = $this->db->select('fm_goods.goods_seq, fm_goods.goods_name, fm_goods.sale_seq, fm_goods.string_price_use, fm_goods.string_price')
				->select('fm_goods.member_string_price_use, fm_goods.member_string_price, fm_goods.allmember_string_price_use, fm_goods.allmember_string_price')
				->select('fm_goods_option.price, fm_goods_option.consumer_price')
				->from('fm_goods')
				->join('fm_goods_option', 'fm_goods_option.goods_seq = fm_goods.goods_seq', 'inner')
				->where(array(
				'fm_goods_option.default_option' => 'y',
				'fm_goods.goods_view' => 'look',
				'fm_goods.goods_type' => 'goods'
			))
				->where(array(
				'fm_goods.goods_seq>=' => '{subquery}'
			))
				->limit(3)
				->get_compiled_select();
			$query = str_replace("'{subquery}'", $subRand, $query);
			$query = $this->db->query($query);
			foreach ($query->result_array() as $row) {
				$aResultGoodsSeq[] = $row['goods_seq'];
				$aResult[] = $row;
			}
			if ($aResult[0]['goods_seq']) {
				$result_recomm = $this->autoCompleteRecommRowFilter($aResultGoodsSeq, $aResult, $applypage);
			}
		}
		return $result_recomm;
	}

	public function getFilterConfig($sSetMode, $aParams=array()){

		$this->resetFilterConfig();

		$sPageType = $this->aPageType[$sSetMode];
		if(!$sPageType) return false;

		if( $sPageType == 'mshop' ){
			$aTmp['search_filter']	= $aParams['minishop_search_filter'];
			$aTmp['orderby']		= $aParams['minishop_orderby'];
			$aTmp['status']			= $aParams['minishop_status'];
		}else if( $sPageType == 'sales_event' ){
			$aTmp['search_filter']	= $aParams['search_filter'];
			$aTmp['orderby']		= $aParams['search_orderby'];
			$aTmp['status']			= $aParams['search_status'];
		}else if( $sPageType == 'gift_event' ){
			$aTmp['search_filter']	= $aParams['search_filter'];
			$aTmp['orderby']		= $aParams['search_orderby'];
			$aTmp['status']			= $aParams['search_status'];
		}else{
			$aTmp	= config_load($sPageType);
		}

		if( $aTmp['search_filter'] ){
			$sSearchFilter	= $aTmp['search_filter'];
		}
		if( $aTmp['orderby'] ){
			$sOrderby		= $aTmp['orderby'];
		}
		if( $aTmp['status'] ){
			$sStatus		= $aTmp['status'];
		}
		if( $sPageType == 'bestproduct' ){	// 베스트 정렬
			$sOrderby		= 'sales';
		}
		if( $sPageType == 'newproduct' ){	// 신상품 정렬
			$sOrderby		= 'new';
		}

		if( $sSearchFilter ){
			$this->setFilterConfig($sSearchFilter, $sSetMode);
		}else{
			$this->loadFilterConfig($sPageType);
		}

		if( $sOrderby ){
			$this->aFilterConfig['orderby']	= $this->aOrderby[$sOrderby];
		}

		if( $sStatus ){
			if( preg_match('/runout/', $sStatus) ){
				$this->aFilterConfig['runout']	= true;
			}
			if( preg_match('/purchasing/', $sStatus) ){
				$this->aFilterConfig['purchasing']	= true;
			}
			if( preg_match('/unsold/', $sStatus) ){
				$this->aFilterConfig['unsold']	= true;
			}
		}
		
		$this->aFilterConfig['searchFilterUse']	= 0;
		if($this->aFilterConfig['freeship'])	$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['abroadship'])	$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['rekeyword'])	$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['price'])		$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['color'])		$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['seller'])		$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['brand'])		$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['location'])	$this->aFilterConfig['searchFilterUse'] = 1;
		if($this->aFilterConfig['category'])	$this->aFilterConfig['searchFilterUse'] = 1;
	}
	
	public function goodsListTotal($sGoodsQuery)
	{
		$data['cnt'] = 0;
		if($sGoodsQuery){
			$sQuery = "select count(*) cnt from " . trim($sGoodsQuery) . " stb";
			$rQuery = $this->db->query($sQuery);
			$data	= $rQuery->row_array();
		}
		return $data['cnt'];
	}
}
