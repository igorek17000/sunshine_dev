<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/setting/_talkbuy_config.html 000018768 */ 
$TPL_talkbuy_shipping_1=empty($TPL_VAR["talkbuy_shipping"])||!is_array($TPL_VAR["talkbuy_shipping"])?0:count($TPL_VAR["talkbuy_shipping"]);?>
<table class="table_basic thl">		
	<tr>
		<th>사용</th>
		<td>
			<div class="resp_radio">
				<label><input type="radio" name="talkbuy_use" value="y" <?php if($TPL_VAR["talkbuy"]["use"]=='y'){?>checked="checked"<?php }?>/> 사용</label>
				<label><input type="radio" name="talkbuy_use" value="n" <?php if($TPL_VAR["talkbuy"]["use"]=='n'||$TPL_VAR["talkbuy"]["use"]==''){?>checked="checked"<?php }?>/> 사용 안 함</label>
			</div>
			<input type="hidden" name="talkbuyServiceStatus" value="<?php echo $TPL_VAR["talkbuy_status"]["serviceStatus"]?>" />
			<span id="talkbuy_status" class="blue bold pdl10">[<?php echo $TPL_VAR["talkbuy_status"]["serviceStatusKorDetail"]?>]</span>
		</td>
	</tr>
	<tr>
		<th>상점 인증 키</th>
<?php if($TPL_VAR["talkbuy"]["shopKey"]){?>
		<td>
			<input type="text" name="talkbuy_shopKey_show" size="50" class="line disabled" disabled value="<?php echo $TPL_VAR["talkbuy"]["shopKey"]?>" />
			<input type="hidden" name="talkbuy_shopKey" size="50" class="line" value="<?php echo $TPL_VAR["talkbuy"]["shopKey"]?>" />
		</td>
<?php }else{?>
		<td><input type="text" name="talkbuy_shopKey" size="50" class="line" value="<?php echo $TPL_VAR["talkbuy"]["shopKey"]?>" /></td>
<?php }?>
	</tr>
	<tr class="talkbuy_use_show hide">
		<th>버튼 인증 키</th>
		<td><input type="text" name="talkbuy_button_key" size="50" class="line disabled" disabled value="<?php echo $TPL_VAR["talkbuy"]["button_key"]?>"/></td>
	</tr>
	<tr class="talkbuy_use_show hide">
		<th>버튼타입 (PC)</th>
		<td>
			<div style="margin: 15px 0;">
				<button type="button" class="resp_btn v2 mr5" onclick="talkbuy_btn_style('pc_goods')">버튼 선택</button>	
				<span id="talkbuy_pc_goods_text"><?php echo $TPL_VAR["sel_talkbuy_btn_text"]['pc_goods']?></span>
			</div>
			<table class="table_basic v7 wauto">
				<tr>
					<th>상품상세 페이지</th>
					<th>장바구니 페이지</th>
				</tr>
				<tr>
					<td class="pd10">
						<iframe name="talkbuy_pc_goods" id="talkbuy_pc_goods" src="../marketing/talkbuy_btn_style_iframe?mode=pc_goods" frameborder=0 border=0 align="center" width="350" height="<?php echo $TPL_VAR["sel_talkbuy_btn_text"]['pc_goods_h']?>"></iframe>						
					</td>
					<td class="pd10">	
						<iframe name="talkbuy_pc_goods_cart" id="talkbuy_pc_goods_cart" src="../marketing/talkbuy_btn_style_iframe?mode=pc_goods&type=cart" frameborder=0 border=0 align="center" width="350" height="<?php echo $TPL_VAR["sel_talkbuy_btn_text"]['pc_goods_h']?>"></iframe>						
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>버튼 타입 (MOBILE)</th>
		<td>
			
			<button type="button" class="resp_btn v2 mr5" onclick="talkbuy_btn_style('mobile_goods')">버튼 선택</button>	
			<span id="talkbuy_mobile_goods_text"><?php echo $TPL_VAR["sel_talkbuy_btn_text"]['mobile_goods']?></span>
			
			<table class="table_basic v7 wauto mt5">
				<tr>
					<th>상품상세 페이지</th>
					<th>장바구니 페이지</th>
				</tr>
				<tr>
					<td class="pd10">
						<iframe name="talkbuy_mobile_goods" id="talkbuy_mobile_goods" src="../marketing/talkbuy_btn_style_iframe?mode=mobile_goods" frameborder=0 border=0 width="350" height="<?php echo $TPL_VAR["sel_talkbuy_btn_text"]['mobile_goods_h']?>"></iframe>
					</td>
					<td class="pd10">	
						<iframe name="talkbuy_mobile_goods_cart" id="talkbuy_mobile_goods_cart" src="../marketing/talkbuy_btn_style_iframe?mode=mobile_goods&type=cart" frameborder=0 border=0 width="350" height="<?php echo $TPL_VAR["sel_talkbuy_btn_text"]['mobile_goods_h']?>"></iframe>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>
			상품 연동 제외
		</th>
		<td class="clear">
			<table class="table_basic thl v3">
				<tbody>
					<tr>
						<th>상품</th>								
						<td>
							<input type="button" value="상품 선택" class="btn_select_goods resp_btn active" data-goodstype='talkbuy_expect_goods' />
							<span class="span_select_goods_del <?php if(count($TPL_VAR["talkbuy"]["except_goods"])== 0){?>hide<?php }?>"><input type="button" value="선택 삭제" class="select_goods_del resp_btn v3" selectType="goods" /></span>
							<div class="mt10 wx600 <?php if(count($TPL_VAR["talkbuy"]["except_goods"])== 0){?>hide<?php }?>">
								<div class="goods_list_header">
									<table class="table_basic tdc">
										<colgroup>
											<col width="10%" />
<?php if(serviceLimit('H_AD')){?>
											<col width="25%" />
											<col width="45%" />
<?php }else{?>
											<col width="70%" />
<?php }?>

											<col width="20%" />
										</colgroup>
										<tbody>
											<tr>
											<th><label class="resp_checkbox"><input type="checkbox" name="chkAll" onClick="gGoodsSelect.checkAll(this)" value="goods"></label></th>
<?php if(serviceLimit('H_AD')){?>
											<th>입점사명</th>
<?php }?>
											<th>상품명</th>
											<th>판매가</th>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="goods_list">
									<table class="table_basic tdc">
										<colgroup>
											<col width="10%" />
<?php if(serviceLimit('H_AD')){?>
											<col width="25%" />
											<col width="45%" />
<?php }else{?>
											<col width="70%" />
<?php }?>
											<col width="20%" />
										</colgroup>
										<tbody>
											<tr rownum=0 <?php if(count($TPL_VAR["talkbuy"]["except_goods"])== 0){?>class="show"<?php }else{?>class="hide"<?php }?>>
												<td class="center" colspan="4">상품을 선택하세요</td>
											</tr><!-- issueGoods, issueGoodsSeq  ==> select_goods_list -->
<?php if(is_array($TPL_R1=$TPL_VAR["talkbuy"]["except_goods"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
											<tr rownum="<?php echo $TPL_V1["goods_seq"]?>">
												<td><label class="resp_checkbox"><input type="checkbox" name='talkbuy_expect_goodsTmp[]' class="chk" value='<?php echo $TPL_V1["goods_seq"]?>' /></label>
													<input type="hidden" name='talkbuy_expect_goods[]' class="chk" value='<?php echo $TPL_V1["goods_seq"]?>' />
													<input type="hidden" name="talkbuy_expect_goodsSeq[<?php echo $TPL_V1["goods_seq"]?>]" value="<?php echo $TPL_V1["issuegoods_seq"]?>" /></td>
<?php if(serviceLimit('H_AD')){?>
													<td><?php echo $TPL_V1["provider_name"]?></td>
<?php }?>
												<td class='left'>
													<div class="image"><img src="<?php echo viewImg($TPL_V1["goods_seq"],'thumbView')?>" width="50"></div>
													<div class="goodsname">
<?php if($TPL_V1["goods_code"]){?><div>[상품코드:<?php echo $TPL_V1["goods_code"]?>]</div><?php }?>
														<div><?php echo $TPL_V1["goods_kind_icon"]?> <a href="/admin/goods/regist?no=<?php echo $TPL_V1["goods_seq"]?>" target="_blank">[<?php echo $TPL_V1["goods_seq"]?>]<?php echo getstrcut(strip_tags($TPL_V1["goods_name"]), 30)?></a></div>
													</div>
												</td>
												<td class='right'><?php echo get_currency_price($TPL_V1["price"], 2)?></td>
											</tr>
<?php }}?>
										</tbody>
									</table>
								</div>
							</div>	
						</td>
					</tr>
					
					<tr>
						<th>카테고리</th>	
						<td class="categoryList">
							<input type="button" value="카테고리 선택" class="btn_category_select resp_btn active" data-fieldName='talkbuy_issueCategoryCode' data-listLay='talkbuy_category_list' />								
							<div class="mt10 wx600 talkbuy_category_list  <?php if(count($TPL_VAR["talkbuy"]["except_category_code"])== 0){?>hide<?php }?>">
								<table class="table_basic fix">
									<colgroup>
										<col width="85%" />
										<col width="15%" />
									</colgroup>
									<thead>
										<tr class="nodrag nodrop">
											<th>카테고리명</th>
											<th>삭제</th>	
										</tr>
									</thead>
									<tbody>
										<tr rownum=0 <?php if(count($TPL_VAR["talkbuy"]["except_category_code"])== 0){?>class="show"<?php }else{?>class="hide"<?php }?>>
											<td class="center" colspan="2">카테고리를 선택하세요</td>
										</tr>													
<?php if(is_array($TPL_R1=$TPL_VAR["talkbuy"]["except_category_code"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
										<tr rownum="<?php echo $TPL_V1["category_code"]?>">
											<td class="center"><?php echo $TPL_V1["category_name"]?></td>
											<td class="center">
												<input type="hidden" name='talkbuy_issueCategoryCode[]' value='<?php echo $TPL_V1["category_code"]?>' />
												<input type="hidden" name="talkbuy_issueCategoryCodeSeq[<?php echo $TPL_V1["category_code"]?>]" value="<?php echo $TPL_V1["issuecategory_seq"]?>" />
												<button type="button" class="btn_minus"  selectType="category" category_seq="<?php echo $TPL_V1["category_code"]?>"></button>
											</td>
										</tr>
<?php }}?>
									</tbody>
								</table>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>

	<tr>
		<th>배송비</th>
		<td>
			<button type="button" class="shippingTalkbuyGroupInfoBtn resp_btn v2">보기</button>					
		</td>
	</tr>
	<tr>
		<th>지역별 추가 배송비 <span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/marketing', '#tip16', '620')"></span></th>
		<td class="clear">
			<table class="table_basic v3">
				<colgroup><col width="200px"/><col /></colgroup>
				<tr>
					<th class="left">2구간 (제주 추가배송비)</th>
					<td><input type="text" name="talkbuy_surchargeByArea2Price" size="12" class="onlynumber right" value="<?php echo $TPL_VAR["talkbuy"]["surchargeByArea2Price"]?>" /> 원</td>
				</tr>
				<tr>
					<th class="left">3구간 (도서산간 추가배송비)</th>
					<td><input type="text" name="talkbuy_surchargeByArea3Price" size="12" class="onlynumber right" value="<?php echo $TPL_VAR["talkbuy"]["surchargeByArea3Price"]?>" /> 원</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>도서 공연비<br/>소득 공제 대상 상품</th>
		<td class="clear">
			<ul class="ul_list_02">
				<li>
					<div class="resp_radio">
						<label><input type="radio" name="talkbuy_culture" value="n" <?php if($TPL_VAR["talkbuy"]["culture"]==''||$TPL_VAR["talkbuy"]["culture"]=='n'){?>checked="checked"<?php }?> /> 없음</label>
						<label><input type="radio" name="talkbuy_culture" value="all" <?php if($TPL_VAR["talkbuy"]["culture"]=='all'){?>checked="checked"<?php }?>/> 전체 상품</label>
						<label><input type="radio" name="talkbuy_culture" value="choice" <?php if($TPL_VAR["talkbuy"]["culture"]=='choice'){?>checked="checked"<?php }?>/> 선택 상품</label>
					</div>
				</li>
				<li class="talkbuy_culture_choice hide clear">
					<table class="table_basic thl v3">									
						<tbody>
							<tr>
								<th>상품</th>								
								<td>
									<input type="button" value="상품 선택" class="btn_select_goods resp_btn active" data-goodstype='talkbuy_culture_goods' />
									<span class="span_select_goods_del <?php if(count($TPL_VAR["talkbuy"]["culture_goods"])== 0){?>hide<?php }?>"><input type="button" value="선택 삭제" class="select_goods_del resp_btn v3" /></span>
									<div class="mt10 wx600 <?php if(count($TPL_VAR["talkbuy"]["culture_goods"])== 0){?>hide<?php }?>">

										<div class="goods_list_header">
											<table class="table_basic tdc">
												<colgroup>
													<col width="10%" />
<?php if(serviceLimit('H_AD')){?>
													<col width="25%" />
													<col width="45%" />
<?php }else{?>
													<col width="70%" />
<?php }?>

													<col width="20%" />
												</colgroup>
												<tbody>
													<tr>
													<th><label class="resp_checkbox"><input type="checkbox" name="chkAll" onClick="gGoodsSelect.checkAll(this)" value="goods"></label></th>
<?php if(serviceLimit('H_AD')){?>
														<th>입점사명</th>
<?php }?>
														<th>상품명</th>
														<th>판매가</th>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="goods_list">
											<table class="table_basic tdc">
												<colgroup>
													<col width="10%" />
<?php if(serviceLimit('H_AD')){?>
													<col width="25%" />
													<col width="45%" />
<?php }else{?>
													<col width="70%" />
<?php }?>
													<col width="20%" />
												</colgroup>
												<tbody>
													<tr rownum=0 <?php if(count($TPL_VAR["talkbuy"]["culture_goods"])== 0){?>class="show"<?php }else{?>class="hide"<?php }?>>
														<td class="center" colspan="4">상품을 선택하세요</td>
													</tr><!-- issueGoods, issueGoodsSeq  ==> select_goods_list -->
<?php if(is_array($TPL_R1=$TPL_VAR["talkbuy"]["culture_goods"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
													<tr rownum="<?php echo $TPL_V1["goods_seq"]?>">
														<td><label class="resp_checkbox"><input type="checkbox" name='talkbuy_culture_goodsTmp[]' class="chk" value='<?php echo $TPL_V1["goods_seq"]?>' /></label>
															<input type="hidden" name='talkbuy_culture_goods[]' class="chk" value='<?php echo $TPL_V1["goods_seq"]?>' />
															<input type="hidden" name="talkbuy_culture_goodsSeq[<?php echo $TPL_V1["goods_seq"]?>]" value="<?php echo $TPL_V1["issuegoods_seq"]?>" /></td>
<?php if(serviceLimit('H_AD')){?>
															<td><?php echo $TPL_V1["provider_name"]?></td>
<?php }?>
														<td class='left'>
															<div class="image"><img src="<?php echo viewImg($TPL_V1["goods_seq"],'thumbView')?>" width="50"></div>
															<div class="goodsname">
<?php if($TPL_V1["goods_code"]){?><div>[상품코드:<?php echo $TPL_V1["goods_code"]?>]</div><?php }?>
																<div><?php echo $TPL_V1["goods_kind_icon"]?> <a href="/admin/goods/regist?no=<?php echo $TPL_V1["goods_seq"]?>" target="_blank">[<?php echo $TPL_V1["goods_seq"]?>]<?php echo getstrcut(strip_tags($TPL_V1["goods_name"]), 30)?></a></div>
															</div>
														</td>
														<td class='right'><?php echo get_currency_price($TPL_V1["price"], 2)?></td>
													</tr>
<?php }}?>
												</tbody>
											</table>
										</div>
									</div>
								</td>
							</tr>										
						</tbody>
					</table>									
				</li>
			</ul>			
		</td>
	</tr>

	<tr>
		<th>신청 및 관리</th>
		<td>	
			<a href="https://seller.pay.kakao.com/" class="resp_btn active size_XL" target="_blank">신청</a>
			<a href="https://seller.pay.kakao.com/" class="resp_btn v2 size_XL" target="_blank">관리</a>		
		</td>
	</tr>
</table>	

<!--카카오페이 구매 가능 배송그룹 :: 시작-->
<div id="shippingTalkbuyGroupInfo" class="hide">
	<div class="content">		
		<table class="table_basic v7 tdc">
			<colgroup>
<?php if(serviceLimit('H_AD')){?>
				<col width="21%" />
<?php }?>
				<col width="21%" />
				<col width="21%" />
				<col width="23%" />
				<col width="14%" />
			</colgroup>
			<tr>
<?php if(serviceLimit('H_AD')){?>
				<th>판매자</th>
<?php }?>
				<th>가능 배송그룹</th>
				<th>가능 배송방법</th>
				<th>연결된상품</th>
				<th>관리</th>
			</tr>			

<?php if($TPL_VAR["talkbuy_shipping"]){?>
<?php if($TPL_talkbuy_shipping_1){foreach($TPL_VAR["talkbuy_shipping"] as $TPL_V1){?>
<?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
<?php if(count($TPL_V2["shipping_set"])> 0){?>
			<tr>
<?php if(serviceLimit('H_AD')){?>
<?php if($TPL_I2== 0){?>
				<td rowspan="<?php echo count($TPL_V1)?>"><?php echo $TPL_V2["provider_info"]?></td>
<?php }?>
<?php }?>
				<td><?php echo $TPL_V2["shipping_group_name"]?>(<?php echo $TPL_V2["shipping_group_seq"]?>)</td>
				<td><?php echo implode("<br/>",$TPL_V2["shipping_set"])?></td>
				<td>
					<input name="modify_btn" onclick="window.open('/admin/goods/package_catalog?ship_grp_seq=<?php echo $TPL_V2["shipping_group_seq"]?>');" type="button" value="패키지 : <?php echo $TPL_V2["rel_goods_cnt"]['package']?>개" class="resp_btn"></span>
					<input name="modify_btn" onclick="window.open('/admin/goods/catalog?ship_grp_seq=<?php echo $TPL_V2["shipping_group_seq"]?>');" type="button" value="상품 : <?php echo $TPL_V2["rel_goods_cnt"]['goods']?>개" class="resp_btn"></span>
				</td>
				<td>
<?php if($TPL_V2["shipping_provider_seq"]> 1){?>
					<input name="modify_btn" onclick="window.open('/admin/setting/shipping_group_regist?provider_seq=<?php echo $TPL_V2["shipping_provider_seq"]?>&provider_name=<?php echo $TPL_V2["provider_info"]?>&shipping_group_seq=<?php echo $TPL_V2["shipping_group_seq"]?>');" type="button" value="수정" class="resp_btn v2">
<?php }else{?>
					<input name="modify_btn" onclick="window.open('/admin/setting/shipping_group_regist?shipping_group_seq=<?php echo $TPL_V2["shipping_group_seq"]?>');" type="button" value="수정" class="resp_btn v2">
<?php }?>
				</td>
			</tr>
<?php }?>
<?php }}?>
<?php }}?>
<?php }else{?>
			<tr>
				<td id="no_talkbuy_shipping" colspan="<?php if(serviceLimit('H_AD')){?>5<?php }else{?>4<?php }?>">
					카카오페이 구매 결제가 가능한 배송그룹이 없습니다.
				</td>
			</tr>
<?php }?>
		</table>		
		
		<div class="box_style_05 mt15">
			<div class="title">안내</div>
			<ul class="bullet_hyphen">					
				<li>카카오페이 구매 배송비 규정에 의해 위의 배송그룹으로 연결된 상품만 카카오페이 구매 결제가 가능합니다.</li>							
				<li>주소 오류, 카카오페이 구매 통신 오류 등으로 배송비가 추가 과금 또는 누락될 수 있습니다. 이점 유의하시기 바랍니다.</li>
				<li>카카오페이 구매 배송비 규정 <a href="https://www.firstmall.kr/customer/faq/1631" class="resp_btn_txt" target="_blank">자세히 보기</a></li>
				<li>새로운 배송그룹 추가를 원하는 경우 <a href="/admin/setting/shipping_group" class="resp_btn_txt" target="_blank">배송비</a>에서 추가해주세요.</li>
			</ul>
		</div>
	</div>

	<div class="footer">							
		<button type="button" class="btnLayClose resp_btn v3 size_XL">닫기</button>
	</div>
</div>
<!--카카오페이 구매 가능 배송그룹 :: 끝-->