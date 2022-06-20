<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/skin/responsive_ver1_default_gl/_modules/display/goods_display_lattice_a.html 000033402 */  $this->include_("showGoodsSearchForm","showCompareCurrency","snsLikeButton");
$TPL_orders_1=empty($TPL_VAR["orders"])||!is_array($TPL_VAR["orders"])?0:count($TPL_VAR["orders"]);
$TPL_displayTabsList_1=empty($TPL_VAR["displayTabsList"])||!is_array($TPL_VAR["displayTabsList"])?0:count($TPL_VAR["displayTabsList"]);?>
<?php if(!$TPL_VAR["ajax_call"]){?>

<div><b><?php echo $TPL_VAR["title"]?></b></div>
<div><?php echo $TPL_VAR["displayTitle"]?></div>

<?php if($TPL_VAR["perpage"]){?>
<!--[ 상품 검색 폼 ]-->
<div class="mb20">
	<?php echo showGoodsSearchForm($TPL_VAR["sc"])?>

</div>
<div class="goods_list_top">
	<ul class="float_wrap">
		<li>
<?php if($TPL_VAR["sort"]){?>
			<span class="sort_item">
<?php if($TPL_orders_1){$TPL_I1=-1;foreach($TPL_VAR["orders"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1){?>
					&nbsp;&nbsp;|&nbsp;&nbsp;
<?php }?>
<?php if($TPL_K1==$TPL_VAR["sort"]){?>
						<a href="?sort=<?php echo $TPL_K1?>&<?php echo get_args_list(array('page','sort'))?>"><b><?php echo $TPL_V1?></b></a>
<?php }else{?>
						<a href="?sort=<?php echo $TPL_K1?>&<?php echo get_args_list(array('page','sort'))?>"><?php echo $TPL_V1?></a>
<?php }?>
<?php }}?>
			</span>
<?php }?>
		</li>
		<li class="right">
			<select name="perpage" onchange="document.location.href='?perpage='+this.value+'&<?php echo get_args_list(array('page','perpage'))?>'">
				<option value="<?php echo $TPL_VAR["perpage_min"]?>" <?php if($_GET["perpage"]==$TPL_VAR["perpage_min"]){?>selected<?php }?>><?php echo number_format($TPL_VAR["perpage_min"])?>개씩 보기</option>
				<option value="<?php echo $TPL_VAR["perpage_min"]* 2?>" <?php if($_GET["perpage"]==$TPL_VAR["perpage_min"]* 2){?>selected<?php }?>><?php echo number_format($TPL_VAR["perpage_min"]* 2)?>개씩 보기</option>
				<option value="<?php echo $TPL_VAR["perpage_min"]* 5?>" <?php if($_GET["perpage"]==$TPL_VAR["perpage_min"]* 5){?>selected<?php }?>><?php echo number_format($TPL_VAR["perpage_min"]* 5)?>개씩 보기</option>
				<option value="<?php echo $TPL_VAR["perpage_min"]* 10?>" <?php if($_GET["perpage"]==$TPL_VAR["perpage_min"]* 10){?>selected<?php }?>><?php echo number_format($TPL_VAR["perpage_min"]* 10)?>개씩 보기</option>
			</select>
			<ul class="goods_list_style">
				<li <?php if($TPL_VAR["list_style"]=='lattice_a'){?>class="lattice_a_on"<?php }else{?>class="lattice_a"<?php }?>><a href="?display_style=lattice_a&<?php echo get_args_list(array('page','display_style'))?>" title="격자형A"></a></li>
				<li <?php if($TPL_VAR["list_style"]=='lattice_b'){?>class="lattice_b_on"<?php }else{?>class="lattice_b"<?php }?>><a href="?display_style=lattice_b&<?php echo get_args_list(array('page','display_style'))?>" title="격자형B"></a></li>
				<li <?php if($TPL_VAR["list_style"]=='list'){?>class="list_on"<?php }else{?>class="list"<?php }?>><a href="?display_style=list&<?php echo get_args_list(array('page','display_style'))?>" title="리스트형"></a></li>
			</ul>
		</li>
	</ul>
</div>
<?php }?>

<?php if(count($TPL_VAR["displayTabsList"])> 1){?>
<ul class="displayTabContainer <?php echo $TPL_VAR["tab_design_type"]?>">
<?php if($TPL_displayTabsList_1){$TPL_I1=-1;foreach($TPL_VAR["displayTabsList"] as $TPL_V1){$TPL_I1++;?>
		<li <?php if($TPL_I1== 0){?>class="current"<?php }?>><?php echo $TPL_V1["tab_title"]?></li>
<?php }}?>
</ul>
<?php }?>

<?php }?>

<?php if($TPL_displayTabsList_1){foreach($TPL_VAR["displayTabsList"] as $TPL_V1){?>
<div class="displayTabContentsContainer displayTabContentsA <?php if(count($TPL_VAR["displayTabsList"])> 1){?>displayTabContentsContainerBox<?php }?>">
<?php if($TPL_V1["contents_type"]=='text'){?>
		<ul>
			<li>
<?php if($TPL_VAR["mobileMode"]||$TPL_VAR["storemobileMode"]){?><?php echo $TPL_V1["tab_contents_mobile"]?><?php }else{?><?php echo $TPL_V1["tab_contents"]?><?php }?>
			</li>
		</ul>
<?php }else{?>		
<?php if(is_array($TPL_R2=$TPL_V1["grid"])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
		<ul>
<?php if(is_array($TPL_R3=$TPL_V2)&&!empty($TPL_R3)){$TPL_I3=-1;foreach($TPL_R3 as $TPL_V3){$TPL_I3++;?>
<?php if($TPL_I3){?><li class="goodsDisplayItemPadding"></li><?php }?>
			<li class="goodsDisplayWrap">
				<?php
					 $TPL_VAR["idx"] =  $TPL_I2* $TPL_VAR["count_w"]+ $TPL_I3;
					 $TPL_VAR["goodsDisplayObj"] =  $TPL_V1["record"][$TPL_VAR["idx"]];
				?>				
<?php if($TPL_VAR["goodsDisplayObj"]){?>
				<div class="goodsDisplayItemWrap">
					<div class="goodsDisplayImageWrap" decoration="<?php echo $TPL_VAR["image_decorations"]?>" goodsInfo="<?php echo base64_encode(json_encode($TPL_VAR["goodsDisplayObj"]))?>" style="<?php if($TPL_VAR["img_optimize"]!= 1){?>max-width:<?php echo $TPL_VAR["goodsImageSize"]["width"]?>px;<?php }?>" version="20141110" img_opt="<?php echo $TPL_VAR["img_optimize"]?>">
						<a href="javascript:void(0);" onclick="display_goods_view('<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>','<?php echo $TPL_VAR["target"]?>',this,'goods_view')">
<?php if($TPL_VAR["img_optimize"]!= 1&&$TPL_VAR["goodsDisplayObj"]["image_size"]&&$TPL_VAR["goodsDisplayObj"]["image_size"][ 0]/$TPL_VAR["goodsDisplayObj"]["image_size"][ 1]<$TPL_VAR["goodsImageSize"]["width"]/$TPL_VAR["goodsImageSize"]["height"]){?>
								<img src="<?php echo $TPL_VAR["goodsDisplayObj"]["image"]?>" data-src="<?php echo $TPL_VAR["goodsDisplayObj"]["image"]?>" class="goodsDisplayImage lazyload" height="<?php echo $TPL_VAR["goodsImageSize"]["height"]?>" onerror="this.src='/data/skin/responsive_ver1_default_gl/images/common/noimage.gif';this.style.height='<?php echo $TPL_VAR["goodsImageSize"]["height"]?>px';" alt="<?php echo $TPL_VAR["goodsDisplayObj"]["goods_name"]?>" />
<?php }else{?>
								<img src="<?php echo $TPL_VAR["goodsDisplayObj"]["image"]?>" data-src="<?php echo $TPL_VAR["goodsDisplayObj"]["image"]?>" class="goodsDisplayImage lazyload" width="<?php if($TPL_VAR["img_optimize"]== 1){?>100%<?php }else{?><?php echo $TPL_VAR["goodsImageSize"]["width"]?><?php }?>" onerror="this.src='/data/skin/responsive_ver1_default_gl/images/common/noimage.gif';this.style.width='<?php if($TPL_VAR["img_optimize"]== 1){?>100%<?php }else{?><?php echo $TPL_VAR["goodsImageSize"]["width"]?>px<?php }?>';" alt="<?php echo $TPL_VAR["goodsDisplayObj"]["goods_name"]?>" />
<?php }?>
<?php if($TPL_VAR["decorations"]["image_icon_type"]!='condition'){?>
<?php if($TPL_VAR["decorations"]["image_icon"]&&preg_match("/^icon_sale/",$TPL_VAR["decorations"]["image_icon"])){?>
<?php if($TPL_VAR["goodsDisplayObj"]["sale_per"]> 0){?>
								<div class='goodsDisplayImageIcon'>
									<img src='/data/icon/goodsdisplay/<?php echo $TPL_VAR["decorations"]["image_icon"]?>' alt="" />
									<span class='goodsDisplayImageIconText'><?php echo $TPL_VAR["goodsDisplayObj"]["sale_per"]?><span class="per">%</span></span>
								</div>
<?php }?>
<?php }elseif($TPL_VAR["decorations"]["image_icon"]){?>
								<div class='goodsDisplayImageIcon'>
									<img src='/data/icon/goodsdisplay/<?php echo $TPL_VAR["decorations"]["image_icon"]?>' alt="" />
<?php if(preg_match("/^(icon_best_no|icon_number)/",$TPL_VAR["decorations"]["image_icon"])){?>
									<span class='goodsDisplayImageIconText'><?php echo $TPL_VAR["idx"]+ 1?></span>
<?php }?>
								</div>
<?php }?>
<?php }elseif($TPL_VAR["decorations"]["image_icon_type"]=='condition'){?>
								<div class='goodsDisplayImageIcon'>				
									<div class="goodsDisplayImageIconWrap"></div>
								</div>
<?php }?>
<?php if($TPL_VAR["decorations"]["image_send"]||$TPL_VAR["decorations"]["image_zzim"]){?>
								<div class='goodsDisplayImageSend'>
<?php if($TPL_VAR["decorations"]["image_send"]){?>
									<img class='goodsSendBtn' src='/data/icon/goodsdisplay/send/<?php echo $TPL_VAR["decorations"]["image_send"]?>' alt="" />
<?php }?>
<?php if($TPL_VAR["decorations"]["image_zzim"]){?>
									<span class='goodsZzimBtn'><img src='/data/icon/goodsdisplay/zzim/<?php echo $TPL_VAR["decorations"]["image_zzim"]?>' class='zzimOffImg' <?php if($TPL_VAR["goodsDisplayObj"]["wish"]=='1'){?>style="display:none"<?php }?> alt="" /><img src='/data/icon/goodsdisplay/zzim_on/<?php echo $TPL_VAR["decorations"]["image_zzim_on"]?>' class='zzimOnImg' <?php if($TPL_VAR["goodsDisplayObj"]["wish"]!='1'){?>style="display:none"<?php }?> alt="" /></span>
<?php }?>
								</div>
<?php }?>
<?php if($TPL_VAR["decorations"]["image_slide"]&&$TPL_VAR["goodsDisplayObj"]["image_cnt"]> 1){?>
								<div class='goodsDisplayImageSlide'><img src='/data/icon/goodsdisplay/slide/<?php echo $TPL_VAR["decorations"]["image_slide"]?>' alt="" /></div>
<?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]||$TPL_VAR["decorations"]["image_overay1_text"]){?>
								<div class='goodsDisplayImageOveray1'>
									<div class='goodsDisplayImageOveray1Bg'></div>
									<div class='goodsDisplayImageOveray1Text'>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='goods_name'){?><?php echo $TPL_VAR["goodsDisplayObj"]["goods_name"]?><?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='price'){?><?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["price"], 2)?><?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='sale_price'){?><?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["sale_price"], 2)?><?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='consumer_price'){?><?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["consumer_price"], 2)?><?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='discount'){?>
<?php if($TPL_VAR["goodsDisplayObj"]["string_price"]){?>
												<?php echo $TPL_VAR["goodsDisplayObj"]["string_price"]?>

<?php }elseif($TPL_VAR["goodsDisplayObj"]["consumer_price"]>$TPL_VAR["goodsDisplayObj"]["price"]){?>
												<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["consumer_price"])?> → <?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["price"])?>

<?php }else{?>
												<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["price"])?>

<?php }?>
<?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='sale_discount'){?>
<?php if($TPL_VAR["goodsDisplayObj"]["string_price"]){?>
												<?php echo $TPL_VAR["goodsDisplayObj"]["string_price"]?>

<?php }elseif($TPL_VAR["goodsDisplayObj"]["consumer_price"]>$TPL_VAR["goodsDisplayObj"]["sale_price"]){?>
												<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["consumer_price"])?> → <?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["sale_price"])?>

<?php }else{?>
												<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["sale_price"])?>

<?php }?>
<?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='brand_title'){?><?php echo $TPL_VAR["goodsDisplayObj"]["brand_title"]?><?php }?>
<?php if($TPL_VAR["decorations"]["image_overay1"]=='related_goods'){?><span class='hand' onclick="return show_display_related_goods(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')" style='display:block;'>관련상품보기</span><?php }?>
<?php if(!$TPL_VAR["decorations"]["image_overay1"]&&$TPL_VAR["image_overay1_text"]){?><?php echo $TPL_VAR["goodsDisplayObj"]["image_overay1_text"]?><?php }?>
									</div>
								</div>
<?php }?>
<?php if($TPL_VAR["decorations"]["use_review_option_like"]){?>
								<div class="goodsDisplayBottomFuncWrap">
									<div class="goodsDisplayBottomFunc">
										<div class="display_newwin hide" onclick="window.open('/goods/view?no=<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')"><img src='/data/icon/goodsdisplay/preview/thumb_newwin.png' alt="새창보기" /></div>
										<div class="display_quickview" onclick="display_goods_quickview(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')"><img src='/data/icon/goodsdisplay/preview/thumb_quickview.png' alt="미리보기" /></div>
										<div class="display_option" onclick="display_goods_show_opt(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')" goods_seq="<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>"><img src='/data/icon/goodsdisplay/preview/thumb_option.png' alt="옵션보기" /><div class="hide display_opt_bak"></div></div>
										<div class="display_send" onclick="display_goods_send(this,'bottom')"><img src='/data/icon/goodsdisplay/preview/thumb_send.png' alt="SNS보내기" /></div>
										<div class="display_zzim" onclick="display_goods_zzim(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')" <?php if($TPL_VAR["goodsDisplayObj"]["wish"]=='1'){?>act="stay"<?php }?>><img src='/data/icon/goodsdisplay/preview/thumb_zzim_off.png' class='zzimOffImg' <?php if($TPL_VAR["goodsDisplayObj"]["wish"]=='1'){?>style="display:none"<?php }?> alt="찜하기" /><img src='/data/icon/goodsdisplay/preview/thumb_zzim_on.png' class='zzimOnImg' <?php if($TPL_VAR["goodsDisplayObj"]["wish"]!='1'){?>style="display:none"<?php }?> alt="찜하기"/></div>
									</div>
								</div>
<?php }?>
						</a>
					</div>
<?php if($TPL_VAR["decorations"]["quick_shopping"]&&$TPL_VAR["decorations"]["quick_shopping_data"]){?>
					<div class="goodsDisplayQuickShopping">
						<ul class="quick_shopping_container">
<?php if(is_array($TPL_R4=($TPL_VAR["decorations"]["quick_shopping_data"]))&&!empty($TPL_R4)){foreach($TPL_R4 as $TPL_V4){?>
<?php if($TPL_V4=='newwin'){?>
								<li class='goodsNewwinBtn' onclick="window.open('/goods/view?no=<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')"><img src='/data/icon/goodsdisplay/quick_shopping/thumb_newwin.gif' alt="새창보기" /></li>
<?php }?>
<?php if($TPL_V4=='quickview'){?>
								<li class='goodsQuickviewBtn' onclick="display_goods_quickview(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')"><img src='/data/icon/goodsdisplay/quick_shopping/thumb_quickview.gif' alt="미리보기" /></li>
<?php }?>
<?php if($TPL_V4=='send'){?>
								<li class='goodsSendBtn' onclick="display_goods_send(this,'bottom')"><img src='/data/icon/goodsdisplay/quick_shopping/thumb_send.gif' alt="SNS보내기" /></li>
<?php }?>
<?php if($TPL_V4=='zzim'){?>
								<li class='goodsZzimBtn' onclick="display_goods_zzim(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>')"><img src='/data/icon/goodsdisplay/quick_shopping/thumb_zzim.gif' class='zzimOffImg' <?php if($TPL_VAR["goodsDisplayObj"]["wish"]=='1'){?>style="display:none"<?php }?> alt="찜하기" /><img src='/data/icon/goodsdisplay/quick_shopping/thumb_zzim_on.gif' class='zzimOnImg' <?php if($TPL_VAR["goodsDisplayObj"]["wish"]!='1'){?>style="display:none"<?php }?> alt="찜하기"/>
								</li>
<?php }?>
<?php }}?>
						</ul>
					</div>
<?php }?>
					<ul class="goodsDisplayTextWrap" style="text-align:<?php echo $TPL_VAR["text_align"]?>;">
<?php if(is_array($TPL_R4=$TPL_VAR["info_settings"]["list"])&&!empty($TPL_R4)){foreach($TPL_R4 as $TPL_V4){?>
<?php if($TPL_V4->kind=='brand_title'&&$TPL_VAR["goodsDisplayObj"]["brand_title"]){?>
						<li>
							<a href="/goods/brand?code=<?php echo $TPL_VAR["goodsDisplayObj"]["brand_code"]?>">
								<span <?php echo $TPL_V4->name_css?> class="brand_title">
<?php if($TPL_V4->wrapper){?><?php echo substr($TPL_V4->wrapper, 0, 1)?><?php }?><?php echo $TPL_VAR["goodsDisplayObj"]["brand_title"]?><?php if($TPL_V4->wrapper){?><?php echo substr($TPL_V4->wrapper, 1, 1)?><?php }?>
								</span>
							</a>
						</li>
						<!-- //브랜드명 -->
<?php }?>						
<?php if($TPL_V4->kind=='goods_name'){?>
						<li>
							<a href="javascript:void(0)"  onclick="display_goods_view('<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>','<?php echo $TPL_VAR["target"]?>',this,'goods_view')"><span <?php echo $TPL_V4->name_css?> class="goods_name"><?php echo $TPL_VAR["goodsDisplayObj"]["goods_name"]?></span></a>
						</li>
						<!-- //상품명 -->
<?php }?>
<?php if($TPL_V4->kind=='summary'&&$TPL_VAR["goodsDisplayObj"]["summary"]){?>
						<li>
							<span <?php echo $TPL_V4->name_css?> class="summary"><?php echo $TPL_VAR["goodsDisplayObj"]["summary"]?></span>
						</li>
						<!-- //짧은 설명 -->
<?php }?>						
<?php if($TPL_V4->kind=='consumer_price'&&$TPL_VAR["goodsDisplayObj"]["consumer_price"]>$TPL_VAR["goodsDisplayObj"]["sale_price"]){?>
						<li class="consumer_wrap">
							<span <?php echo $TPL_V4->name_css?> class="consumer_price">
<?php if($TPL_VAR["goodsDisplayObj"]["string_price"]){?>
									<?php echo $TPL_VAR["goodsDisplayObj"]["string_price"]?>

<?php }else{?>
<?php if($TPL_V4->position=="before"&&$TPL_V4->postfix){?><?php echo $TPL_V4->postfix?><?php }?>
									<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["consumer_price"])?><?php if($TPL_V4->position=="after"&&$TPL_V4->postfix){?><?php echo $TPL_V4->postfix?><?php }?>
<?php }?>
							</span>
							<?php echo showCompareCurrency($TPL_V4->compare,$TPL_VAR["goodsDisplayObj"]["consumer_price"])?>


<?php if($TPL_VAR["goodsDisplayObj"]["sale_per"]){?>
<?php if($TPL_VAR["text_align"]=='center'||$TPL_VAR["text_align"]=='right'){?>
							<span class="sale_per">(<strong><?php echo $TPL_VAR["goodsDisplayObj"]["sale_per"]?></strong>%)</span>
<?php }else{?>
							<span class="sale_per"><strong><?php echo $TPL_VAR["goodsDisplayObj"]["sale_per"]?></strong> %</span>
<?php }?>
							<!-- //할인율 -->
<?php }?>
						</li>
						<!-- //정가 -->
<?php }?>
<?php if($TPL_V4->kind=='price'){?>
						<li>
							<span class="price_txt">판매가</span>
							<span <?php echo $TPL_V4->name_css?> class="sale_price">
<?php if($TPL_VAR["goodsDisplayObj"]["string_price"]){?>
									<?php echo $TPL_VAR["goodsDisplayObj"]["string_price"]?>

<?php }else{?>
<?php if($TPL_V4->position=="before"&&$TPL_V4->postfix){?><?php echo $TPL_V4->postfix?><?php }?>
									<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["price"])?><?php if($TPL_V4->position=="after"&&$TPL_V4->postfix){?><span class="price_unit"><?php echo $TPL_V4->postfix?></span><?php }?>
<?php }?>
							</span>
							<?php echo showCompareCurrency($TPL_V4->compare,$TPL_VAR["goodsDisplayObj"]["price"])?>

						</li>
						<!-- //판매가 -->
<?php }?>
<?php if($TPL_V4->kind=='sale_price'){?>
						<li>
							<span class="price_txt">이벤트가</span>
							<span <?php echo $TPL_V4->name_css?> class="sale_price">
<?php if($TPL_VAR["goodsDisplayObj"]["string_price"]){?>
									<?php echo $TPL_VAR["goodsDisplayObj"]["string_price"]?>

<?php }else{?>
<?php if($TPL_V4->position=="before"&&$TPL_V4->postfix){?><?php echo $TPL_V4->postfix?><?php }?>
									<?php echo get_currency_price($TPL_VAR["goodsDisplayObj"]["sale_price"])?><?php if($TPL_V4->position=="after"&&$TPL_V4->postfix){?><span class="price_unit"><?php echo $TPL_V4->postfix?></span><?php }?>
<?php }?>
							</span>
							<?php echo showCompareCurrency($TPL_V4->compare,$TPL_VAR["goodsDisplayObj"]["sale_price"])?>

						</li>
						<!-- //(혜택적용)판매가 -->
<?php }?>						
<?php if($TPL_V4->kind=='count'&&$TPL_VAR["goodsDisplayObj"]["eventEnd"]&&($TPL_V4->time_count||$TPL_V4->buy_count)){?>
						<li>
							<ul class="eventEnd">
<?php if($TPL_V4->time_count){?>
<?php if($TPL_VAR["goodsDisplayObj"]["eventEnd"]){?>
								<li class="soloEventTd_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>">
									<img src="/data/skin/responsive_ver1_default_gl/images/common/icon_clock.gif" alt="" /> 남은시간 <span class="time_count"><span id="soloday_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>"></span>일 <span id="solohour_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>"></span>:<span id="solomin_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>"></span>:<span id="solosecond_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>"></span></span>
									<script type="text/javascript">
										$(function() {
											timeInterval_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?> = setInterval(function(){
												var time_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?> = showClockTime('text', '<?php echo $TPL_VAR["goodsDisplayObj"]["eventEnd"]["year"]?>', '<?php echo $TPL_VAR["goodsDisplayObj"]["eventEnd"]["month"]?>', '<?php echo $TPL_VAR["goodsDisplayObj"]["eventEnd"]["day"]?>', '<?php echo $TPL_VAR["goodsDisplayObj"]["eventEnd"]["hour"]?>', '<?php echo $TPL_VAR["goodsDisplayObj"]["eventEnd"]["min"]?>', '<?php echo $TPL_VAR["goodsDisplayObj"]["eventEnd"]["second"]?>', 'soloday_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>', 'solohour_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>', 'solomin_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>', 'solosecond_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>', '_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>');
												if(time_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?> == 0){
												clearInterval(timeInterval_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>);
												$(".soloEventTd_<?php echo $TPL_VAR["display_key"]?>_<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>").html("단독 이벤트 종료");
												}
											},1000);
										});
									</script>
								</li>
<?php }?>
<?php }?>
<?php if($TPL_V4->buy_count){?>
								<li>
									현재 <span class="buy_count"><?php echo number_format($TPL_VAR["goodsDisplayObj"]["event_order_ea"])?></span>개 구매
								</li>
<?php }?>
							</ul>
						</li>
						<!-- //판매수량, 남은시간 -->
<?php }?>
<?php if($TPL_V4->kind=='event_text'){?>
						<li>
							<span <?php echo $TPL_V4->name_css?> class="event_text">
<?php if(is_numeric($TPL_VAR["goodsDisplayObj"]["event_text"])){?>
									<?php echo number_format($TPL_VAR["goodsDisplayObj"]["event_text"])?><?php if($TPL_V4->postfix){?><?php echo $TPL_V4->postfix?><?php }?>
<?php }else{?>
									<?php echo $TPL_VAR["goodsDisplayObj"]["event_text"]?>

<?php }?>
							</span>
						</li>
						<!-- //이벤트 텍스트 -->
<?php }?>
<?php if($TPL_V4->kind=='fblike'&&$TPL_VAR["APP_USE"]=='f'&&$TPL_VAR["APP_LIKE_TYPE"]!='NO'){?>
						<li class="fblike">
							<?php echo snsLikeButton($TPL_VAR["goodsDisplayObj"]["goods_seq"],$TPL_V4->fblike)?>

						</li>
						<!-- //좋아요(페이스북) -->
<?php }?>
<?php if($TPL_V4->kind=='icon'){?>
						<li class="icon">
<?php if(is_array($TPL_R5=$TPL_VAR["goodsDisplayObj"]["icons"])&&!empty($TPL_R5)){foreach($TPL_R5 as $TPL_V5){?>
							<img src="/data/icon/goods/<?php echo $TPL_V5?>.gif" alt="" />
<?php }}?>
<?php if($TPL_V4->list_icon_cpn&& 0){?>
							<img src="/data/icon/goods_status/icon_list_cpn.gif" alt="쿠폰" />
<?php }?>
<?php if($TPL_V4->list_icon_freedlv&& 0){?>
							<img src="/data/icon/goods_status/icon_list_freedlv.gif" alt="무료배송" />
<?php }?>
<?php if($TPL_V4->list_icon_video&&$TPL_VAR["goodsDisplayObj"]["videousetotal"]){?>
							<img src="/data/icon/goods_status/icon_list_video.gif" alt="동영상" />
<?php }?>
						</li>
						<!-- //아이콘 -->
<?php }?>
<?php if($TPL_V4->kind=='status_icon'){?>
						<li class="status_icon">
<?php if($TPL_V4->status_icon_runout&&$TPL_VAR["goodsDisplayObj"]["goods_status"]=='runout'){?>
							<img src="/data/icon/goods_status/icon_list_soldout.gif" alt="품절" />
<?php }?>
<?php if($TPL_V4->status_icon_purchasing&&$TPL_VAR["goodsDisplayObj"]["goods_status"]=='purchasing'){?>
							<img src="/data/icon/goods_status/icon_list_warehousing.gif" alt="재고확보중" />
<?php }?>
<?php if($TPL_V4->status_icon_unsold&&$TPL_VAR["goodsDisplayObj"]["goods_status"]=='unsold'){?>
							<img src="/data/icon/goods_status/icon_list_stop.gif" alt="판매중지" />
<?php }?>
						</li>
						<!-- //상태 아이콘 -->
<?php }?>						
<?php if($TPL_V4->kind=='score'){?>
						<li class="score">
<?php if(number_format(round($TPL_VAR["goodsDisplayObj"]["review_sum"]/$TPL_VAR["goodsDisplayObj"]["review_count"]))== 0){?>
							<span class="num">0</span>
<?php }else{?>
							<span class="num"><?php echo round($TPL_VAR["goodsDisplayObj"]["review_sum"]/$TPL_VAR["goodsDisplayObj"]["review_count"])?></span>
<?php }?>
							<span class="orange"><?php echo str_repeat('★',round($TPL_VAR["goodsDisplayObj"]["review_sum"]/$TPL_VAR["goodsDisplayObj"]["review_count"]))?></span>
							<span class="gray"><?php echo str_repeat('★', 5-number_format(round($TPL_VAR["goodsDisplayObj"]["review_sum"]/$TPL_VAR["goodsDisplayObj"]["review_count"])))?></span>
							상품평 (<span class="red"><?php echo number_format($TPL_VAR["goodsDisplayObj"]["review_count"])?></span>)
						</li>
						<!-- //상품평 -->
<?php }?>						
<?php if($TPL_V4->kind=='color'){?>
						<li>
<?php if(is_array($TPL_R5=($TPL_VAR["goodsDisplayObj"]["colors"]))&&!empty($TPL_R5)){foreach($TPL_R5 as $TPL_V5){?>
							<span style="background:<?php echo $TPL_V5?>; color:<?php echo $TPL_V5?>;" class="color">■</span>
<?php }}?>
						</li>
						<!-- //컬러 옵션 -->
<?php }?>
<?php if($TPL_V4->kind=='provider_name'){?>
						<li>
							<a href="javascript:void(0)"  onclick="display_goods_view('<?php echo $TPL_VAR["goodsDisplayObj"]["provider_seq"]?>','<?php echo $TPL_VAR["target"]?>',this,'provider')"><span <?php echo $TPL_V4->name_css?> class="provider_name"><?php echo $TPL_VAR["goodsDisplayObj"]["provider_name"]?></span></a>
						</li>
						<!-- //판매자명 -->
<?php }?>
<?php if($TPL_V4->kind=='bigdata'){?>
						<li>
							<a href="javascript:void(0)"  onclick="display_goods_view('<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>','<?php echo $TPL_VAR["target"]?>',this,'bigdata')"><span <?php echo $TPL_V4->name_css?> class="bigdata"><?php echo $TPL_V4->bigdata?></span></a>
						</li>
						<!-- //빅데이터 큐레이션 -->
<?php }?>
<?php if($TPL_V4->kind=='shipping'&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]){?>
						<li class="shipping">
							<ul>
<?php if($TPL_V4->shipping_free&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type"]=='free'&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["free"]){?>
								<li><?php echo $TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["free"]?></li>
<?php }?>
<?php if($TPL_V4->shipping_fixed&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type"]=='fixed'&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["fixed"]){?>
								<li><?php echo $TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["fixed"]?></li>
<?php }?>
<?php if($TPL_V4->shipping_iffree&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type"]=='iffree'&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["iffree"]){?>
								<li><?php echo $TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["iffree"]?></li>
<?php }?>
<?php if($TPL_V4->shipping_ifpay&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type"]=='ifpay'&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["ifpay"]){?>
								<li><?php echo $TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["ifpay"]?></li>
<?php }?>
							</ul>
<?php if($TPL_V4->shipping_overseas&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["gl_shipping_yn"]=='Y'&&$TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["overseas"]){?>
							<div class="shipping_overseas">
								<?php echo $TPL_VAR["goodsDisplayObj"]["shipping_group"]["default_type_code"]["overseas"]?>

							</div>
<?php }?>
						</li>
						<!-- //배송그룹 -->
<?php }?>						
<?php if($TPL_V4->kind=='pageview'){?>
						<li>
							<span class="goods_list_page_view">
								<img class="goods_list_page_view_img" src="/data/icon/goodsdisplay/preview/icon_pageview.png" alt="페이지뷰" /> 
								<span class="goods_list_page_view_count"><?php if($TPL_VAR["goodsDisplayObj"]["page_view"]> 9999){?>9,999+<?php }else{?><?php echo number_format($TPL_VAR["goodsDisplayObj"]["page_view"])?><?php }?></span>
							</span>
							<span class="goods_list_goods_zzim">
								<label onclick="display_goods_zzim(this,'<?php echo $TPL_VAR["goodsDisplayObj"]["goods_seq"]?>');"><img class="goods_list_goods_zzim_img" src="/data/icon/goodsdisplay/preview/icon_zzim_<?php if($TPL_VAR["goodsDisplayObj"]["wish"]== 1){?>on<?php }else{?>off<?php }?>.png" alt="찜하기" /> 
								찜 <span class="goods_list_goods_zzim_count"><?php echo number_format($TPL_VAR["goodsDisplayObj"]["wish_count"])?></span></label>
							</span>
						</li>
						<!-- //페이지뷰&찜하기 -->
<?php }?>
<?php }}?>
					</ul>
				</div>
<?php }?>				
			</li>
<?php }}?>
		</ul>
<?php }}?>		
<?php }?>
</div>
<?php }}?>

<?php if(!$TPL_VAR["ajax_call"]){?>

<?php if($TPL_VAR["perpage"]){?>
<?php $this->print_("paging",$TPL_SCP,1);?>

<?php }?>

<style type="text/css">
<?php if($TPL_VAR["decorations"]["image_border1_width"]&&$TPL_VAR["decorations"]["image_border_type"]!='all'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageWrap {border:<?php echo $TPL_VAR["decorations"]["image_border1_width"]?>px solid <?php echo $TPL_VAR["decorations"]["image_border1"]?>; margin:-<?php echo $TPL_VAR["decorations"]["image_border1_width"]?>px;}
<?php }elseif($TPL_VAR["decorations"]["image_border1_width"]&&$TPL_VAR["decorations"]["image_border_type"]=='all'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayItemWrap {border:<?php echo $TPL_VAR["decorations"]["image_border1_width"]?>px solid <?php echo $TPL_VAR["decorations"]["image_border1"]?>;}
    #<?php echo $TPL_VAR["display_key"]?> .goodsDisplayTextWrap {padding:15px;}
<?php }?>
<?php if($TPL_VAR["decorations"]["image_icon"]&&$TPL_VAR["decorations"]["image_icon_location"]=='right'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageIcon {right:0px; <?php if($TPL_VAR["decorations"]["image_icon_over"]=='y'){?>display:none;<?php }?>}
<?php }?>
<?php if($TPL_VAR["decorations"]["image_icon"]&&$TPL_VAR["decorations"]["image_icon_location"]=='left'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageIcon {left:0px; <?php if($TPL_VAR["decorations"]["image_icon_over"]=='y'){?>display:none;<?php }?>}
<?php }?>
<?php if($TPL_VAR["decorations"]["image_icon"]&&preg_match("/^icon_best_no/",$TPL_VAR["decorations"]["image_icon"])){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageIconText {font-size:16px; text-align:center; width:48px; top:22px;}
<?php }?>
<?php if($TPL_VAR["decorations"]["image_icon"]&&preg_match("/^icon_number/",$TPL_VAR["decorations"]["image_icon"])){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageIconText {font-size:18px; text-align:right; width:28px; top:11px;}
<?php }?>
<?php if($TPL_VAR["decorations"]["image_icon"]&&preg_match("/^icon_sale/",$TPL_VAR["decorations"]["image_icon"])){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageIconText {font-size:16px; text-align:center; width:48px; top:6px;}	
<?php }?>
<?php if(($TPL_VAR["decorations"]["image_send"]||$TPL_VAR["decorations"]["image_zzim"])&&$TPL_VAR["decorations"]["image_send_location"]=='right'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageSend {right:2px; <?php if($TPL_VAR["decorations"]["image_send_over"]=='y'){?>display:none;<?php }?>} 
<?php }?>
<?php if(($TPL_VAR["decorations"]["image_send"]||$TPL_VAR["decorations"]["image_zzim"])&&$TPL_VAR["decorations"]["image_send_location"]=='left'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayImageSend {left:2px; <?php if($TPL_VAR["decorations"]["image_send_over"]=='y'){?>display:none;<?php }?>}
<?php }?>
<?php if($TPL_VAR["text_align"]=='center'||$TPL_VAR["text_align"]=='right'){?>
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayTextWrap .consumer_price {margin-left:0;}
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayTextWrap .price_txt {display:none;}
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayTextWrap .sale_per {position:relative; left:1px; top:1px; font-family:'tahoma', sans-serif; height:18px; line-height:1.8; letter-spacing:0;}
	#<?php echo $TPL_VAR["display_key"]?> .goodsDisplayTextWrap .sale_per strong {font-family:inherit; font-size:inherit; font-weight:bold; letter-spacing:inherit;}
<?php }?>
	#<?php echo $TPL_VAR["display_key"]?> .displayTabContentsA > ul > li.goodsDisplayWrap {width:<?php if($TPL_VAR["img_optimize"]== 1){?><?php echo ( 100-$TPL_VAR["img_padding"])/$TPL_VAR["count_w"]?>%<?php }else{?><?php echo $TPL_VAR["goodsImageSize"]["width"]?>px;<?php }?>}
</style>

<?php }?>