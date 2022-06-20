<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/skin/responsive_ver1_default_gl/goods/coupon_location_ajax.html 000000681 */ ?>
<script type='text/javascript'>
$(document).ready(function(){
	map_id = $('.goods_mapview').find('._nmap_mapbox').prop('id');
	$('#'+map_id).html('');
	callMap(map_id,'<?php echo $TPL_VAR["x_lang"]?>','<?php echo $TPL_VAR["y_lang"]?>','<?php echo $TPL_VAR["width"]?>','<?php echo $TPL_VAR["height"]?>','<?php echo $TPL_VAR["option"]?>');
	$('#address').html('<?php echo $TPL_VAR["address"]?>');
	$('#street').html('<?php echo $TPL_VAR["street"]?>');
	$('#biztel').html('<?php echo $TPL_VAR["biztel"]?>');
});
</script>