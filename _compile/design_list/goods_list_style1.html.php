<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/design_list/goods_list_style1.html 000006581 */ 
$TPL_record_1=empty($TPL_VAR["record"])||!is_array($TPL_VAR["record"])?0:count($TPL_VAR["record"]);?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++
@@ goods_list_style1 @@
- 파일 위치 : /data/design_list/goods_list_style1.html
++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<?php if($TPL_record_1){foreach($TPL_VAR["record"] as $TPL_V1){?>
<li class="goods_list_style1">
<?php if(!$TPL_VAR["issample"]){?>
		<div class="item_img_area">
			<a href="/goods/view?no=<?php echo $TPL_V1["goods_seq"]?>"><img src="<?php echo $TPL_V1["image"]?>" onerror="this.src='/data/skin/<?php echo $TPL_VAR["skin"]?>/images/common/noimage.gif';" alt="" /></a>
			<div class="display_zzim">
<?php if($TPL_V1["wish"]){?>
				<img src="/data/icon/goodsdisplay/preview/thumb_zzim_off.png" class="zzimOffImg"  alt="찜하기" style="display:none" data-member="<?php echo $TPL_VAR["aParams"]["member_seq"]?>" data-goods="<?php echo $TPL_V1["goods_seq"]?>" data-wish="<?php echo $TPL_V1["wish"]?>" onclick="setWish(this)">
				<img src="/data/icon/goodsdisplay/preview/thumb_zzim_on.png" class="zzimOnImg" alt="찜하기" data-member="<?php echo $TPL_VAR["aParams"]["member_seq"]?>" data-goods="<?php echo $TPL_V1["goods_seq"]?>" data-wish="<?php echo $TPL_V1["wish"]?>" onclick="setWish(this)">
<?php }else{?>
				<img src="/data/icon/goodsdisplay/preview/thumb_zzim_off.png" class="zzimOffImg" alt="찜하기" data-member="<?php echo $TPL_VAR["aParams"]["member_seq"]?>" data-goods="<?php echo $TPL_V1["goods_seq"]?>" data-wish="<?php echo $TPL_V1["wish"]?>" onclick="setWish(this)">
				<img src="/data/icon/goodsdisplay/preview/thumb_zzim_on.png" class="zzimOnImg" alt="찜하기" style="display:none" data-member="<?php echo $TPL_VAR["aParams"]["member_seq"]?>" data-goods="<?php echo $TPL_V1["goods_seq"]?>" data-wish="<?php echo $TPL_V1["wish"]?>" onclick="setWish(this)">
<?php }?>
			</div>
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
	<ul class="item_info_area">
<?php if($TPL_V1["color_pick"]){?>
		<li class="displaY_color_option">
<?php if(is_array($TPL_R2=explode(',',$TPL_V1["color_pick"]))&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
			<span class="areA" style="background-color:#<?php echo $TPL_V2?>;"></span>
<?php }}?>
		</li>
<?php }?>

		<li class="goods_name_area">
<?php if($TPL_VAR["aParams"]["searchMode"]!='brand'&&$TPL_V1["brand_title"]){?>
			<span class="brand_name"><?php echo $TPL_V1["brand_title"]?></span>
<?php }?>

<?php if($TPL_V1["goods_name"]){?>
			<a href="/goods/view?no=<?php echo $TPL_V1["goods_seq"]?>"><span class="name"><?php echo $TPL_V1["goods_name"]?></span></a>
<?php }?>
		</li>

<?php if($TPL_V1["summary"]){?>
		<li class="goods_desc_area">
			<?php echo $TPL_V1["summary"]?>

		</li>
<?php }?>

		<!-- 비회원 대체문구 -->
<?php if($TPL_V1["string_price"]){?>
		<li class="goods_price_area">
			<span class="warning_text"><?php echo $TPL_V1["string_price"]?></span>
		</li>
<?php }else{?>
		<li class="goods_price_area">
			<span class="sale_price">
<?php if($TPL_V1["sale_price"]>= 0){?>
				<?php echo get_currency_price($TPL_V1["sale_price"], 2,'','<b class="num">_str_price_</b>')?>

<?php }else{?>
				<?php echo get_currency_price($TPL_V1["price"], 2,'','<b class="num">_str_price_</b>')?>

<?php }?>
			</span>

<?php if($TPL_V1["consumer_price"]>$TPL_V1["sale_price"]){?>
			<span class="consumer_price">
				<?php echo get_currency_price($TPL_V1["consumer_price"], 2,'','<span class="num">_str_price_</span>')?>

			</span>
<?php }?>

<?php if($TPL_V1["sale_per"]> 0){?>
			<span class="discount_rate">
				<b class="num"><?php echo $TPL_V1["sale_per"]?></b>%
			</span>
<?php }?>
		</li>
<?php }?>

<?php if($TPL_VAR["aParams"]["searchMode"]!='catalog'&&$TPL_V1["category"]){?>
		<li class="goods_category_area">
			<ul class="cate">
				<li><?php echo $TPL_V1["category"]?></li>
			</ul>
		</li>
<?php }?>

<?php if($TPL_V1["shipping_group"]["free_shipping_use"]=='Y'||$TPL_V1["shipping_group"]["gl_shipping_yn"]=='Y'){?>
		<li class="goods_besong_area">
			<!-- 무료배송 -->
<?php if($TPL_V1["shipping_group"]["free_shipping_use"]=='Y'){?>
			<span class="besong">무료배송</span>
<?php }?>
			<!-- 해외배송 -->
<?php if($TPL_V1["shipping_group"]["gl_shipping_yn"]=='Y'){?>
			<span class="besong">해외배송</span>
<?php }?>
		</li>
<?php }?>

<?php if($TPL_V1["purchase_ea"]> 0||$TPL_V1["review_count"]> 0||$TPL_V1["wish_count"]> 0){?>
		<li class="goods_sold_area">
<?php if($TPL_V1["purchase_ea"]> 0){?>
			<span class="sold">구매 <b class="num"><?php echo number_format($TPL_V1["purchase_ea"])?></b></span>
<?php }?>
<?php if($TPL_V1["review_count"]> 0){?>
			<span class="review">리뷰 <b class="num"><?php echo number_format($TPL_V1["review_count"])?></b></span>
<?php }?>
<?php if($TPL_V1["wish_count"]> 0){?>
			<span class="zzim">찜 <b class="num"><?php echo number_format($TPL_V1["wish_count"])?></b></span>
<?php }?>
		</li>
<?php }?>

<?php if(serviceLimit('H_AD')){?>
<?php if($TPL_VAR["aParams"]["searchMode"]!='mshop'){?>
			<li class="goods_seller_area">
				<span class="name"><?php echo $TPL_V1["provider_name"]?></span>
				<span class="rank">
<?php if($TPL_V1["pgroup_icon"]){?>
					<img src="<?php echo $TPL_V1["pgroup_icon"]?>" class="rank_img" alt= "" />
<?php }?>
<?php if($TPL_V1["pgroup_name"]){?>
					(<?php echo $TPL_V1["pgroup_name"]?>)
<?php }?>
				</span>
			</li>
<?php }?>
<?php }?>

<?php if($TPL_V1["today_icon"]){?>
		<!-- 아이콘 모음 -->
		<li class="goods_icon_area">
<?php if(is_array($TPL_R2=explode(',',$TPL_V1["today_icon"]))&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
			<img src="/data/icon/goods/<?php echo $TPL_V2?>.gif" alt="" />
<?php }}?>
		</li>
<?php }?>

	</ul>
</li>
<?php }}?>