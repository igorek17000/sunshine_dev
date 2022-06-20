<?php
/**
 * @author lgs
 */
function dataGoodsTodayLight($mode='list', $limit=null)
{
	$CI =& get_instance();
	$CI->load->library('snssocial');
	$result = array();
	$today_view = $_COOKIE['today_view'];
	if( $today_view ) {
		$today_view = unserialize($today_view);
		if($mode == 'count') return count($today_view);
		$CI->load->model('goodslistmodel');
		$aSearch['page']	= 1;
		$aSearch['perpage'] = 12;
		$aSearch['sorting'] = 'regist';
		$aSearch['image_size']	= 'thumbScroll';
		$aSearch['platform']	= 'P';
		if( $CI->mobileMode || $CI->_is_mobile_agent ){
			$aSearch['platform']	= 'M';
		}
		if($limit){
			$today_view = array_slice($today_view, -$limit);
			$aSearch['perpage'] = $limit;
		}

		$sGoodsQuery = "(select goods_seq from `fm_goods` where goods_seq in (" . implode(',', $today_view) . "))";
		$aTmp		= $CI->goodslistmodel->goodsSearch($aSearch, $sGoodsQuery);
		
		//최신 본 순으로 정렬 by kmj
		$today_view = array_reverse($today_view);
		$result = array();
		foreach($aTmp['record'] as $seq => $val){
			$result[array_search($val['goods_seq'], $today_view)] = $val;
		}
		ksort($result);
	}
	if($mode == 'count') return false;
	return $result;
}
?>