<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/design/goods_info_style_5.html 000008774 */ 
$TPL_goodsList_1=empty($TPL_VAR["goodsList"])||!is_array($TPL_VAR["goodsList"])?0:count($TPL_VAR["goodsList"]);?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++
@@ goods_info_style_5 @@
- 파일 위치 : /data/design/goods_info_style_5.html
- CSS 경로 : /data/design/goods_info_style.css
- 상품정보 관련 CSS 수정 및 추가는 다음의 CSS파일에서 작업하시기 바랍니다.
/data/design/goods_info_user.css
※ /data 폴더는 /skin 폴더 상위 폴더입니다.
++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<?php if(!$TPL_VAR["issample"]&&$TPL_VAR["style"]=='responsible'){?>
	<style>
		.<?php echo $TPL_VAR["display_key"]?>.goods_list li.gl_item{ width:<?php echo $TPL_VAR["goodsImageSize"]["width"]?>px; }
	</style>
	<ul class="goods_list <?php echo $TPL_VAR["display_key"]?> goods_info_style_5">
<?php }?>
<?php if($TPL_goodsList_1){foreach($TPL_VAR["goodsList"] as $TPL_V1){?>
<?php if(!$TPL_VAR["issample"]&&$TPL_VAR["style"]=='sizeswipe'){?><ul class="goods_list swiper-slide"><?php }?>
<?php if(!$TPL_VAR["issample"]){?>
	<li class="gl_item">
	<div class="gl_inner_item_wrap">

		<!--상품이미지-->
		<div class="gli_image goodsDisplayImageWrap">
			<a href="javascript:void(0);" class="respItemImageArea" onclick="display_goods_view('<?php echo $TPL_V1["goods_seq"]?>','<?php echo $TPL_VAR["target"]?>',this,'goods_view')">
<?php if($TPL_VAR["decorations"]["use_seconde_image"]){?>
				<img src="<?php echo $TPL_V1["image"]?>" data-src="<?php echo $TPL_V1["image"]?>" class="goodsDisplayImage lazyload item1cut" onerror="this.src='/data/skin/<?php echo $TPL_VAR["skin"]?>/images/common/noimage.gif';" alt="<?php echo $TPL_V1["goods_name"]?>" />
				<img src="<?php if($TPL_V1["image2"]){?><?php echo $TPL_V1["image2"]?><?php }else{?><?php echo $TPL_V1["image"]?><?php }?>" data-src="<?php if($TPL_V1["image2"]){?><?php echo $TPL_V1["image2"]?><?php }else{?><?php echo $TPL_V1["image"]?><?php }?>" class="goodsDisplayImage lazyload item2cut" onerror="this.src='/data/skin/<?php echo $TPL_VAR["skin"]?>/images/common/noimage.gif';" alt="<?php echo $TPL_V1["goods_name"]?>"  />
<?php }else{?>
				<img src="<?php echo $TPL_V1["image"]?>" data-src="<?php echo $TPL_V1["image"]?>" class="goodsDisplayImage lazyload" onerror="this.src='/data/skin/<?php echo $TPL_VAR["skin"]?>/images/common/noimage.gif'" alt="<?php echo $TPL_V1["goods_name"]?>"/>
<?php }?>
			</a>

			<!-- 반응형 icon new -->
<?php if($TPL_VAR["decorations"]["use_image_icon"]){?>
				
<?php if($TPL_VAR["decorations"]["image_icon_type"]=='condition'){?>

				<!-- 텍스트형 아이콘-->
<?php if($TPL_V1["text_icon"]){?>
				<div class="respGoodsIcon typeText <?php echo $TPL_V1["text_icon_type"]?>" style="background: <?php echo $TPL_V1["text_background"]?>">
					<div class="respGoodsIconInner">
						<div class="iconArea">
							<span class="nuM"><?php echo $TPL_V1["text_icon"][ 0]?></span><span class="secondMessage"><?php echo $TPL_V1["text_icon"][ 1]?></span>
							<span class="nextMessage"><?php echo $TPL_V1["text_icon"][ 2]?></span><!-- 부가 텍스트 있는 경우, 없으면 항목 미노출 -->
						</div>
					</div>
				</div>
<?php }?>

<?php }else{?>

				<!-- 이미지형 아이콘 -->
				<div class="respGoodsIcon typeImage">
					<div class="iconArea">
						<img src="/data/icon/goodsdisplay/<?php echo $TPL_VAR["decorations"]["image_icon"]?>" alt="" />
					</div>
				</div>

<?php }?>

<?php }?>

			<!-- 반응형 zzim -->
<?php if($TPL_VAR["decorations"]["use_image_zzim"]){?>
			<div class="respGoodsZzim">
				<a class="zzimArea" href="javascript:void(0)" onclick="display_goods_zzim(this, <?php echo $TPL_V1["goods_seq"]?>)">
					<img src="/data/icon/goodsdisplay/zzim/<?php echo $TPL_VAR["decorations"]["image_zzim"]?>" class="zzimImage normal <?php if($TPL_V1["wish"]== 1){?>hide<?php }?>" alt="찜하기" title="찜하기" />
					<img src="/data/icon/goodsdisplay/zzim_on/<?php echo $TPL_VAR["decorations"]["image_zzim_on"]?>" class="zzimImage active <?php if($TPL_V1["wish"]!= 1){?>hide<?php }?>" alt="찜한 상품" title="찜한 상품" />
				</a>
			</div>
<?php }?>

			<!-- 미리보기/옵션보기/SNS보내기 -->
<?php if($TPL_VAR["decorations"]["use_review_option_like"]){?>
			<div class="respGoodsFuncMenu">
				<ul class="goodsDisplayItemWrap">
					<li class="funcMenu_quickview"><a href="javascript:void(0)" onclick="display_goods_quickview(this, <?php echo $TPL_V1["goods_seq"]?>);"><span class="txt">미리보기</span></a></li>
					<li class="funcMenu_option"><a href="javascript:void(0)" onclick="display_goods_show_opt(this, <?php echo $TPL_V1["goods_seq"]?>);"><span class="txt">옵션보기</span></a></li>
					<li class="funcMenu_send"><a href="javascript:void(0)" onclick="display_goods_send(this,'bottom', '<?php echo $TPL_V1["goods_seq"]?>', '<?php echo $TPL_V1["goods_name"]?>' );"><span class="txt">SNS보내기</span></a></li>
				</ul>
			</div>
<?php }?>

			<!-- 상품 상태 표시 -->
<?php if($TPL_V1["goods_status"]!='normal'){?>
			<div class="respGoodsStatus">
				<a href="/goods/view?no=<?php echo $TPL_V1["goods_seq"]?>" class="area">
<?php if($TPL_V1["goods_status"]=='runout'){?>
					<span class="status_style type1"><em>SOLD OUT!</em></span>
<?php }elseif($TPL_V1["goods_status"]=='purchasing'){?>
					<span class="status_style type2"><em>재고확보중</em></span>
<?php }elseif($TPL_V1["goods_status"]=='unsold'){?>
					<span class="status_style type3"><em>판매중지</em></span>
<?php }?>
				</a>
			</div>
<?php }?>
		</div>
<?php }?>

<div class="resp_display_goods_info infO_style_5">
<!-- +++++++++++++++++++++++++++++++++ NEW 상품 정보 ++++++++++++++++++++++++++++++++ -->
	<!-- 상품명-->
<?php if($TPL_V1["goods_name"]){?>
	<div class="goodS_info displaY_goods_name">
		<span class="areA"><a href="/goods/view?no=<?php echo $TPL_V1["goods_seq"]?>"><?php echo $TPL_V1["goods_name"]?></a></span>
	</div>
<?php }?>

	<!-- 비회원 대체문구 -->
<?php if($TPL_V1["string_price"]){?>
	<div class="infO_group">
		<div class="goodS_info">
			<span class="areA warning_text">
			<?php echo $TPL_V1["string_price"]?>

			</span>
		</div>
	</div>
<?php }else{?>
	<div class="infO_group">
		<!-- 정가 -->
<?php if($TPL_V1["consumer_price"]>$TPL_V1["sale_price"]){?>
		<div class="goodS_info displaY_consumer_price">
			<span class="areA">				
				<?php echo get_currency_price($TPL_V1["consumer_price"], 2,'','<span class="nuM">_str_price_</span>')?>

			</span>
		</div>
<?php }?>

		<!-- (할인혜택)판매가 -->
<?php if($TPL_V1["sale_price"]>= 0){?>
		<div class="goodS_info displaY_sales_price">
			<span class="areA">				
				<?php echo get_currency_price($TPL_V1["sale_price"], 2,'','<span class="nuM">_str_price_</span>')?>

			</span>
		</div>
<?php }?>
	</div>
<?php }?>

<?php if($TPL_V1["review_divide"]||$TPL_V1["review_usercnt"]){?>
	<div class="infO_group">
		
<?php if($TPL_V1["review_divide"]){?>
		<!-- 상품후기 평가점수( 별점 ) -->
		<div class="goodS_info displaY_review_score_a">
			<span class="areA">
				<span class="ev_active2"><b style="width:<?php echo round($TPL_V1["review_divide"]/ 5* 100, 1)?>%;"></b></span>
			</span>
		</div>

		<!-- 상품후기 평가점수( 점수 ) -->
		<div class="goodS_info displaY_review_score_b">
			<span class="areA"><span class="nuM"><?php echo number_format($TPL_V1["review_divide"], 1)?></span>점</span>
		</div>
<?php }?>

		<!-- 상품후기 가장 좋은 평가정보( 사람수 ) -->
<?php if($TPL_V1["review_usercnt"]){?>
		<div class="goodS_info displaY_review_score_b">
			<span class="areA"><span class="nuM"><?php echo number_format($TPL_V1["review_usercnt"])?></span>명</span>
		</div>
<?php }?>
	</div>
<?php }?>
	
	<!-- 리뷰 영역 -->
<?php if($TPL_V1["review_info"]){?>
<?php if(is_array($TPL_R2=$TPL_V1["review_info"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
		<div class="goodS_info displaY_best_review">
			<span class="areA titlE">
				<?php echo $TPL_V2["subject"]?>

			</span>
			<span class="areB desC"><?php echo $TPL_V2["contents"]?></span>
		</div>
<?php }}?>
<?php }?>
<!-- +++++++++++++++++++++++++++++++++ //NEW 상품 정보 ++++++++++++++++++++++++++++++++ -->
</div>

<?php if(!$TPL_VAR["issample"]){?>
	</div>
  </li>
<?php }?>
<?php if(!$TPL_VAR["issample"]&&$TPL_VAR["style"]=='sizeswipe'){?></ul><?php }?>
<?php }}?>
<?php if(!$TPL_VAR["issample"]&&$TPL_VAR["style"]=='responsive'){?></ul><?php }?>