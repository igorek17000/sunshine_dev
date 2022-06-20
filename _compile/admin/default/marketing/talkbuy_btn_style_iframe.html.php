<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/marketing/talkbuy_btn_style_iframe.html 000000815 */  $this->include_("defaultScriptFunc");?>
<html>
<head>

<style>
body {margin:0px;padding:0px;}
.npay_storebtn_bx { margin-left:0px !important; }
#nhn_btn{text-align:center;}
</style>
<?php echo defaultScriptFunc()?></head>

<body>
<?php if($TPL_VAR["sel_talkbuy_btn"]){?>
<div id="nhn_btn">
	<img src="/admin/skin/default/images/common/talkbuy/<?php echo $TPL_VAR["sel_talkbuy_btn"]["size"]?>-<?php echo $TPL_VAR["sel_talkbuy_btn"]["darkMode"]?>-<?php echo $TPL_VAR["sel_talkbuy_btn"]["wishButton"]?>.png">
</div>
<?php }else{?>
<div style="margin:3px;font-size:12px; color:#000;">버튼 스타일을 선택해 주세요.</div>
<?php }?>

</body>
</html>