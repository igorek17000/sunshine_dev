<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/skin/responsive_ver1_default_gl/layout_footer/standard.html 000014241 */  $this->include_("confirmLicenseLink","escrow_mark");
$TPL_bank_loop_1=empty($TPL_VAR["bank_loop"])||!is_array($TPL_VAR["bank_loop"])?0:count($TPL_VAR["bank_loop"]);
$TPL_dataRightQuicklist_1=empty($TPL_VAR["dataRightQuicklist"])||!is_array($TPL_VAR["dataRightQuicklist"])?0:count($TPL_VAR["dataRightQuicklist"]);?>
<div id="layout_footer" class="layout_footer">

	<div class="footer_a" <?php if(preg_match('/goods\/view/',$_SERVER["REQUEST_URI"])){?>style="display:none;"<?php }?>>
		<div class="resp_wrap">
			<ul class="menu1">
				<li class="foot_menu_d1 cs">
					<h4 class="title"><a href="/service/cs" designElement="text" textIndex="1"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >CS CENTER</a></h4>
					<ul class="list v4">
						<li class="compay_phone">
							<a href="tel:<?php echo $TPL_VAR["config_basic"]["companyPhone"]?>"><img src="/data/skin/responsive_ver1_default_gl/images/common/icon_call_02.png" class="img_call" alt="" /><?php echo $TPL_VAR["config_basic"]["companyPhone"]?></a>
						</li>
						<li><span designElement="text" textIndex="2"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >open : am 10:00 ~ pm 06:00 / Sat, Sun, Holiday OFF</span></li>
						<li class="Pt2"><a href="mailto:<?php echo $TPL_VAR["config_basic"]["companyEmail"]?>"><?php echo $TPL_VAR["config_basic"]["companyEmail"]?></a></li>
					</ul>
				</li>
				<li class="foot_menu_d2 bank">
					<h4 class="title"><span designElement="text" textIndex="3"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >BANK INFO</span></h4>
					<ul class="list v3 gray_03">
<?php if($TPL_bank_loop_1){foreach($TPL_VAR["bank_loop"] as $TPL_V1){?>
						<li>
							<p><?php echo $TPL_V1["bank"]?> <?php echo $TPL_V1["account"]?></p>
							<p><span class="gray_06" designElement="text" textIndex="4"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >????????? :</span> <?php echo $TPL_V1["bankUser"]?></p>
						</li>
<?php }}?>
					</ul>
				</li>
				<li class="foot_menu_d3 guide">
					<h4 class="title"><span designElement="text" textIndex="5"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >SHOP MENU</span></h4>
					<ul class="list v2 clearbox">
						<li>
							<a href="/mypage/index"><img src="/data/skin/responsive_ver1_default_gl/images/common/menu_guide_03.png" alt="" /></a>
							<p class="desc" designElement="text" textIndex="6"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >MYPAGE</p>
						</li>
						<li>
							<a href="/order/cart"><img src="/data/skin/responsive_ver1_default_gl/images/common/menu_guide_04.png" alt="" /></a>
							<p class="desc" designElement="text" textIndex="7"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >CART</p>
						</li>
						<li>
							<a href="/service/cs"><img src="/data/skin/responsive_ver1_default_gl/images/common/menu_guide_01.png" alt="" /></a>
							<p class="desc" designElement="text" textIndex="8"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >CS CENTER</p>
						</li>
						<li>
							<a href="/promotion/event"><img src="/data/skin/responsive_ver1_default_gl/images/common/menu_guide_02.png" alt="" /></a>
							<p class="desc" designElement="text" textIndex="9"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >EVENT</p>
						</li>
					</ul>
				</li>
				<li class="foot_menu_d4 delivery">
					<h4 class="title"><span designElement="text" textIndex="10"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >DELIVERY INFO</span></h4>
					<ul class="list v5">
						<li><span designElement="text" textIndex="11"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >???????????? :</span> (<?php echo $TPL_VAR["refund_address"]["address_zipcode"]?>)<?php if($TPL_VAR["refund_address"]["address_type"]=="street"){?><?php echo $TPL_VAR["refund_address"]["address_street"]?><?php }else{?><?php echo $TPL_VAR["refund_address"]["address"]?><?php }?> <?php echo $TPL_VAR["refund_address"]["address_detail"]?></li>
						<li style="text-indent:0; padding-left:0;">
							<span designElement="text" textIndex="12"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >???????????? : ??????????????? 1588-0000</span>
							<a href="#" target="_blank" title="??????" class="btn_resp size_a" designElement="text" textIndex="13"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s"  alt="????????? ???????????? ????????? ???????????????.">????????????</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>

	<div class="footer_b">
		<div class="resp_wrap">
			<ul class="menu2">
				<li><a href="/" designElement="text" textIndex="14"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >HOME</a></li>
				<li><a href="/service/company" designElement="text" textIndex="15"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >COMPANY</a></li>
				<li><a href="/service/agreement" designElement="text" textIndex="16"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >AGREEMENT</a></li>
				<li><a href="/service/privacy" designElement="text" textIndex="17"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >PRIVACY POLICY</a></li>
			</ul>
		</div>
	</div>

	<div class="footer_c">
		<div class="resp_wrap">
			<ul class="menu3">
				<li><span designElement="text" textIndex="18"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >????????? :</span> <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["companyName"]?></span></li>
				<li><span designElement="text" textIndex="19"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >????????? :</span> <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["ceo"]?> </span></li>
				<li><span designElement="text" textIndex="20"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >?????? :</span> <span class="pcolor"><?php if($TPL_VAR["config_basic"]["companyAddress_type"]=="street"){?><?php echo $TPL_VAR["config_basic"]["companyAddress_street"]?><?php }else{?><?php echo $TPL_VAR["config_basic"]["companyAddress"]?><?php }?> <?php echo $TPL_VAR["config_basic"]["companyAddressDetail"]?></span></li>
				<li><span designElement="text" textIndex="21"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >?????? :</span> <a href="tel:<?php echo $TPL_VAR["config_basic"]["companyPhone"]?>" class="pcolor"><?php echo $TPL_VAR["config_basic"]["companyPhone"]?></a></li>
<?php if($TPL_VAR["config_basic"]["companyFax"]){?>
				<li><span designElement="text" textIndex="22"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >?????? :</span> <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["companyFax"]?></span></li>
<?php }?>
				<li><span designElement="text" textIndex="23"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >????????????????????? :</span> <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["businessLicense"]?> <?php echo confirmLicenseLink("[?????????????????????]")?></span></li>
				<li><span designElement="text" textIndex="24"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >??????????????????????????? :</span> <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["mailsellingLicense"]?></span></li>
				<li><span designElement="text" textIndex="25"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >??????????????????????????? :</span> <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["member_info_manager"]?> (<a class="pcolor" href="mailto:<?php echo $TPL_VAR["config_basic"]["companyEmail"]?>"><?php echo $TPL_VAR["config_basic"]["companyEmail"]?></a>)</span></li>
				<li>????????? ????????? : <span class="pcolor">(???)?????????????????????</span></li>
			</ul>
			<p class="copyright" designElement="text" textIndex="26"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >COPYRIGHT (c) <span class="pcolor"><?php echo $TPL_VAR["config_basic"]["companyName"]?></span> ALL RIGHTS RESERVED.</p>
			<div class="escrow"><?php echo escrow_mark( 60)?></div>
		</div>
	</div>
</div>

<?php if(preg_match('/goods\/view/',$_SERVER["REQUEST_URI"])){?>
<?php if($TPL_VAR["navercheckout_tpl"]){?>
<div class="pcHideMoShow" style="height:117px;">&nbsp;</div>
<?php }?>
<div class="pcHideMoShow" style="height:80px;">&nbsp;</div>
<?php }?>
<!-- ???????????? : ??? -->

<!-- ????????? - BACK/TOP(????????????) -->
<div id="floating_over">
	<a href="javascript:history.back();" class="ico_floating_back" title="?????? ??????"></a>
	<a href="javascript:history.forward();" class="ico_floating_foward" title="????????? ??????"></a>
	<a href="#layout_header" class="ico_floating_top" title="?????? ??????">TOP</a>
<?php if($TPL_VAR["dataRightQuicklist"]&&!preg_match('/goods\/view/',$_SERVER["REQUEST_URI"])){?>
<?php if($TPL_VAR["push_count_today_images"]){?><a href="javascript:;" class="ico_floating_recently"><span designElement="text" textIndex="27"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvbGF5b3V0X2Zvb3Rlci9zdGFuZGFyZC5odG1s" >?????????</span><br /><img src="<?php echo $TPL_VAR["push_count_today_images"]?>" onerror="this.src='/data/skin/responsive_ver1_default_gl/images/common/noimage.gif'"></a><?php }?>
<?php }?>

	<!-- ?????? ??? ??????(LAYER) -->
	<div id="recently_popup">
		<div class="recently_popup">
			<h1>?????? ??? ??????</h1>
			<div class="recently_thumb">
				<div id="recently_slide_bottom" style="width:285px; min-height:80px;">
					<div class="thumb">
<?php if($TPL_VAR["dataRightQuicklist"]){?>
						<ul>
<?php if($TPL_dataRightQuicklist_1){$TPL_I1=-1;foreach($TPL_VAR["dataRightQuicklist"] as $TPL_V1){$TPL_I1++;?>
<?php if(($TPL_I1< 40)){?>
<?php if(($TPL_I1&&($TPL_I1% 4)== 0)){?></ul><ul><?php }?>
								<li><a href="../goods/view?no=<?php echo $TPL_V1["goods_seq"]?>" class="right_quick_goods"><img src="<?php echo $TPL_V1["image"]?>" onerror="this.src='/data/skin/responsive_ver1_default_gl/images/common/noimage_list.gif'" alt="<?php echo $TPL_V1["goods_name"]?>"></a><a href="javascript:rightDeleteItem('mobile_bottom_item_recent', '<?php echo $TPL_V1["goods_seq"]?>',$(this))" class="btn_delete cover">??????</a></li>
<?php }?>
<?php }}?>
						</ul>
<?php }else{?>
						<h2> ?????? ??? ????????? ????????????.</h2>
<?php }?>
					</div>
				</div>
				<div class="recently_page">
					<a href="javascript:;" class="btn_page cover">??????</a>
				</div>
			</div>
			<a href="javascript:;" class="btn_close">????????????</a>
		</div>
		<div class="recently_bg"></div>
	</div>
<?php if($TPL_dataRightQuicklist_1> 3){?>
	<script type="text/javascript">
	<!--
		$(function(){
			/* ?????? ??? ?????? - LAYER(????????????) */
			$("#recently_slide_bottom").touchSlider({
				flexible:true, roll:true, paging:$("#recently_slide_bottom").next().find(".btn_page"),
				initComplete:function(e){$("#recently_slide_bottom").next().find(".btn_page").each(function(i, el){$(this).text("page " + (i+1));});},
				counter:function(e){$("#recently_slide_bottom").next().find(".btn_page").removeClass("on").eq(e.current-1).addClass("on");}
			});
		});
	//-->
	</script>
<?php }?>
</div>
<!-- //????????? - BACK/TOP(????????????) -->


<script type="text/javascript">
$(function() {
	/* ????????? ???????????? ?????? ??????( ?????? ?????? ?????? ) */
<?php if($TPL_VAR["settle"]){?>
		$('.slider_before_loading').remove();
<?php }else{?>
		$('.slider_before_loading').removeClass('slider_before_loading');
<?php }?>

	// ?????? ?????? ????????? ?????????( new ???????????? )
	if ( $('.displaY_color_option').length > 0 ) {
		$('.displaY_color_option .areA').filter(function() {
			return ( $(this).css('background-color') == 'rgb(255, 255, 255)' );
		}).addClass('border');
	}

	$( window ).on('resize', function() {
		if ( window.innerWidth != WINDOWWIDTH ) {
			setTimeout(function(){ WINDOWWIDTH = window.innerWidth; }, 10);
		}
	});
});

/*######################## 17.12.19 gcs yjy : ??? ??????(fb ????????????) s */
function logoutfb(){
	FB.getLoginStatus(logoutfb_process);
}
function logoutfb_process(){
	FB.api('/me', function(response) {

		FB.logout(function(response) {

		});

		isLogin = false;
<?php if(defined('__ISUSER__')){?>
		loadingStart("body",{segments: 12, width: 15.5, space: 6, length: 13, color: '#000000', speed: 1.5});
			$.ajax({
			'url' : '../sns_process/facebooklogout',
			'dataType': 'json',
			'success': function(res) {

				if(res.result == true){
					alert("???????????????????????????.");

<?php if($TPL_VAR["mobileapp"]=='y'){?>
<?php if($TPL_VAR["m_device"]=='iphone'){?>
				window.webkit.messageHandlers.CSharp.postMessage("Logout?");
//				window.webkit.messageHandlers.CSharp.postMessage('GoHome');
<?php }else{?>
				CSharp.postMessage("Logout?");
//				CSharp.postMessage('GoHome');
<?php }?>
<?php }?>


				}else{
					document.location.reload();
				}
			}
			});
<?php }?>
		if (fbId != "")  initializeFbTokenValues();
		if (fbUid != "") initializeFbUserValues();

		return false;
	});
}
/*######################## 17.12.19 gcs yjy : ??? ??????(fb ????????????) e */
</script>