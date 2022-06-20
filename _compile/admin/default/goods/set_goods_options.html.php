<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/goods/set_goods_options.html 000007922 */  $this->include_("defaultScriptFunc");?>
<?php if($TPL_VAR["mode"]!='view'){?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<title><?php echo $TPL_VAR["config_basic"]["shopName"]?><?php if(!preg_match('/order_print/',$_SERVER["REDIRECT_QUERY_STRING"])){?> 관리자환경 :: 퍼스트몰, 오직 운영자만을 생각한 가장 앞선 쇼핑몰입니다.<?php }?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<script nonce="<?php echo script_nonce()?>"><?php echo front_config_js()?></script>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/common.css?mm=<?php echo date('Ymd')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/layout.css?mm=<?php echo date('Ymd')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/buttons.css?mm=<?php echo date('Ym')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/boardnew.css?mm=<?php echo date('Ymd')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/page.css?mm=<?php echo date('Ymd')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/jqueryui/jquery-ui.css?mm=<?php echo date('Ym')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/jqueryui/black-tie/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/poshytip/style.css?mm=<?php echo date('Ym')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/goods_admin.css?mm=<?php echo date('Ymd')?>" />
<link rel="stylesheet" type="text/css" href="/admin/skin/default/css/common-ui.css?mm=<?php echo date('Ymd')?>" />
<link rel="stylesheet" type="text/css" href="/app/javascript/plugin/editor/css/editor.css?v=<?php echo date('Ym')?>" />

<?php if($TPL_VAR["config_system"]["favicon"]){?>
<!-- 파비콘 -->
<link rel="shortcut icon" href="<?php echo $TPL_VAR["config_system"]["favicon"]?>" />
<?php }?>
<!-- 자바스크립트 [순서변경하지마세요] -->
<?php if(preg_match('/goods\/regist/',$_SERVER["REQUEST_URI"])||preg_match('/category\/catalog/',$_SERVER["REQUEST_URI"])){?>
<script type="text/javascript" src="/app/javascript/jquery/jquery.min.1.6.4.js"></script>
<?php }else{?>
<script type="text/javascript" src="/app/javascript/jquery/jquery.min.js"></script>
<?php }?>
<script type="text/javascript" src="/app/javascript/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jquery.hotkeys.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jquery.poshytip.min.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jquery.activity-indicator-1.0.0.min.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jquery.cookie.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/custom-select-box.js?mm=<?php echo date('Ym')?>"></script>
<script type="text/javascript" src="/app/javascript/js/dev-tools.js"></script>
<script type="text/javascript" src="/app/javascript/js/admin-layout.js?dummy=<?php echo date('Ymd')?>&krdomain=http://<?php echo $TPL_VAR["config_system"]["subDomain"]?>"></script>
<script type="text/javascript" src="/app/javascript/js/admin-goodsRegist.js?v=<?php echo date('Ymd')?>"></script>
<script type="text/javascript" src="/app/javascript/js/admin-goodsaddlayer.js?mm=<?php echo date('Ym')?>"></script>
<script type="text/javascript" src="/app/javascript/plugin/jquery.colorpicker.min.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/custom-color-picker.js?mm=<?php echo date('Ym')?>"></script>
<script type="text/javascript" src="/app/javascript/js/admin-layout.js?dummy=<?php echo date('Ymd')?>&krdomain=http://<?php echo $TPL_VAR["config_system"]["subDomain"]?>"></script>
<script type="text/javascript" src="/data/js/language/L10n_<?php echo $TPL_VAR["config_system"]["language"]?>.js?dummy=<?php echo date('YmdHis')?>"></script>
<script type="text/javascript" src="/app/javascript/js/common-function.js?mm=<?php echo date('Ym')?>"></script>
<script type="text/javascript" src="/app/javascript/js/admin-common-ui.js?mm=<?php echo date('Ymd')?>"></script>
<script  type="text/javascript">
var gl_goods_seq 							= '<?php echo $TPL_VAR["goods_seq"]?>';
var gl_package_yn 							= '<?php echo $TPL_VAR["sc"]["package_yn"]?>';
var gl_basic_currency						= "<?php echo $TPL_VAR["config_system"]["basic_currency"]?>";	//기본통화
	//var gl_skin_currency					= "<?php echo $TPL_VAR["config_system"]["compare_currency"]?>";		//비교통화
	var gl_basic_currency_symbol			= "<?php echo $TPL_VAR["config_currency"][$TPL_VAR["basic_currency"]]['currency_symbol']?>";
	var gl_basic_currency_symbol_position	= "<?php echo $TPL_VAR["config_currency"][$TPL_VAR["basic_currency"]]['currency_symbol_position']?>";
	var gl_amout_list						= new Array();
<?php if(is_array($TPL_R1=$TPL_VAR["config_system"]["basic_amout"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
	gl_amout_list['<?php echo $TPL_K1?>'] = '<?php echo $TPL_V1?>';
<?php }}?>
	var gl_currency_exchange = "<?php echo $TPL_VAR["config_currency"][$TPL_VAR["basic_currency"]]['currency_exchange']?>";	

var scObj					= <?php echo $TPL_VAR["scObj"]?>;
var reload					= '<?php echo $TPL_VAR["reload"]?>';
var defaultReservePercent 	= '<?php echo $TPL_VAR["reserves"]["default_reserve_percent"]?>';

function socialcpinputtype() {
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
	var socialcp_input_type = '<?php echo $TPL_VAR["sc"]["socialcp_input_type"]?>';
<?php }else{?>
		var socialcp_input_type = $("input[name='socialcp_input_type']:checked", window.opener.document).val();
<?php }?>

	if(socialcp_input_type) {
		var couponinputsubtitle = '';
		$(".couponinputtitle").show();
		if( socialcp_input_type == 'price' ) {
			couponinputsubtitle = '금액';
		}else{
			couponinputsubtitle = '횟수';
		}
<?php if($TPL_VAR["mode"]!='view'){?>$(".socialcpuseopen").val(socialcp_input_type);	<?php }?>
		$(".couponinputsubtitle").text(couponinputsubtitle);
	}

<?php if($TPL_VAR["mode"]!='view'){?>
	//과세/부가세 체크
<?php if($TPL_VAR["sc"]["goodsTax"]){?>
	var goodsTax = '<?php echo $TPL_VAR["sc"]["goodsTax"]?>';
<?php }else{?>
	var goodsTax = $("input[name='tax']:checked", window.opener.document).val();
<?php }?>
	$(".goodsTax").val(goodsTax);
<?php }?>
}

<?php if($TPL_VAR["mode"]!='view'){?>
$(window).on("beforeunload", function() { 
	parent.opener.freqOptionsReload('opt');
})
<?php }?>

</script>
<script type="text/javascript" src="/app/javascript/js/admin/admin-set_options_modify.js?mm=<?php echo date('Ymd')?>"></script>	
<?php echo defaultScriptFunc()?></head>
<body>

<div id="dumy" style="display:none"></div>

<?php }?>

<!--
	EDIT_VIEW		: edit_goods_options.html		: 필수옵션(멀티 등록/수정 팝업)
	ONLY_VIEW		: view_goods_options.html
-->
<?php if($TPL_VAR["mode"]=='view'){?>
<?php $this->print_("ONLY_VIEW",$TPL_SCP,1);?>

<?php }else{?>
<?php $this->print_("EDIT_VIEW",$TPL_SCP,1);?>

<?php }?>

	<div id="packageErrorDialog" class="hide"></div>
<?php if($TPL_VAR["mode"]!='view'){?>
<?php $this->print_("layout_footer_popup",$TPL_SCP,1);?>

<?php }?>

<?php if($TPL_VAR["mode"]!='view'){?>
<?php }?>
</body>