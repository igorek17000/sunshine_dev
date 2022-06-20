<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/goods/view_goods_options.html 000018688 */ 
$TPL_options_1=empty($TPL_VAR["options"])||!is_array($TPL_VAR["options"])?0:count($TPL_VAR["options"]);?>
<!-- 필수옵션 > 옵션 생성 > 팝업에서 생성 후 확인 시 부모창에 노출 -->
<div id="optionLayer">
	<table class="table_basic mt5 v7">
		<input type="hidden" name="optionAddPopup" value="y" />
		<input type="hidden" name="reserve_policy" value="<?php echo $TPL_VAR["options"][ 0]["tmp_policy"]?>" />
		<input type="hidden" name="goodsCode" id="goodsCode" value="<?php echo $TPL_VAR["goods"]["goods_code"]?>" />
		<thead>
		<tr>
			<th style="width:40px">기준</th>
<?php if($TPL_VAR["package_yn"]!='y'){?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
				<th style="min-width:60px">
					<?php echo $TPL_V1?>

					<input type="hidden" name="optionTitle[]" value="<?php echo $TPL_V1?>" />
					<input type="hidden" name="optionType[]" value="<?php echo $TPL_VAR["options"][ 0]["option_divide_type"][$TPL_I1]?>" />
				</th>
<?php }}?>
				<th style="min-width:50px">상품코드 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_code', 'sizeS')"></span></th>
				
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
				<th style="min-width:50px" class="couponinputtitle"><span class="couponinputsubtitle"><?php if($TPL_VAR["sc"]["socialcp_input_type"]=='price'){?>금액<?php }else{?>횟수<?php }?></span></th>
<?php }else{?>
				<th style="min-width:40px">무게(kg)</th>
<?php }?>
<?php }else{?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><th style="min-width:50px"><?php echo $TPL_V1?></th><?php }}?>
<?php }?>

<?php if($TPL_VAR["package_yn"]=='y'){?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
				<th class="reg_package_option_title_tbl" style="min-width:40px">상품<?php echo $TPL_V1?></th>
<?php }}?>
<?php }else{?>
			<th style="min-width:40px">재고 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_stock', 'sizeS')"></span></th>
			<th style="min-width:40px">불량 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_bedstock', 'sizeS')"></span></th>
			<th style="min-width:40px">가용 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_availablestock', 'sizeS')"></span></th>
			<th style="width:70px">
				안전재고
<?php if(($TPL_VAR["goods"]["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')&&$TPL_VAR["scm_cfg"]['use']){?>
				<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_safestock', 'sizeS')"></span>
				<input type="hidden" class="safestock_text" title="<?php echo $TPL_VAR["scm_cfg"]['admin_env_name']?>"/>
<?php }else{?>
				<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_safestock', 'sizeS')"></span>
				<input type="hidden" class="safestock_text" title="<?php if(($TPL_VAR["goods"]["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')){?>기본매장<?php }else{?>입점사<?php }?>"/>
<?php }?>
			</th>
<?php if($TPL_VAR["goods"]["provider_seq"]== 1){?>
			<th style="min-width:60px">매입가(평균)</th>
<?php }?>
<?php }?>
			<th style="min-width:60px" class="<?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>">정산 금액</th>
			<th style="min-width:60px" class="<?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>">
<?php if($TPL_VAR["provider_info"]["commission_type"]=='SACO'||$TPL_VAR["provider_info"]["commission_type"]==''){?>
				수수료
<?php }else{?>
				<span class="SUCO_title">공급가</span>
<?php }?>
			</th>
			<th style="min-width:60px">정가</th>
			<th style="min-width:60px">판매가 <span class="required_chk"></span></th>
			<th style="min-width:50px">부가세</th>
			<th style="min-width:60px">마일리지 지급</th>
			<th style="min-width:40px" class="optionStockSetText">옵션 노출</th>
			<th style="width:40px">설명</th>
		</tr>
		</thead>
<?php if($TPL_VAR["options"]){?>
		<tbody>
<?php if($TPL_options_1){$TPL_I1=-1;foreach($TPL_VAR["options"] as $TPL_K1=>$TPL_V1){$TPL_I1++;?>
<?php if(!$TPL_VAR["config_goods"]["option_view_count"]||$TPL_VAR["config_goods"]["option_view_count"]>$TPL_I1||$TPL_VAR["islimit"]!='limit'){?>
		<tr class="optionTr">
			<td class="center">
<?php if($TPL_V1["default_option"]=='y'){?>●<?php }?>
				<input type="hidden" name="optionSeq[]" value="<?php echo $TPL_V1["option_seq"]?>" />
			</td>

<?php if(is_array($TPL_R2=$TPL_V1["opts"])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
			<td class="center optionTitle" >
				<?php echo $TPL_V2?>

<?php if($TPL_V1["optcodes"][$TPL_I2]&&$TPL_VAR["package_yn"]!='y'){?><br/><span class="desc">[<?php echo $TPL_V1["optcodes"][$TPL_I2]?>]</span><?php }?>
				<input type="hidden" name="optionNames[]" value="<?php echo $TPL_V2?>" />
<?php if($TPL_V1["divide_newtype"][$TPL_K2]){?>
				<input type="hidden"  name="optnewtype[]" value="<?php echo $TPL_V1["divide_newtype"][$TPL_K2]?>">
				<br/>
<?php if($TPL_V1["divide_newtype"][$TPL_K2]=='color'){?>
					<input type="hidden"  name="optcolor[]" value="<?php echo $TPL_V1["color"]?>">
					<button type="button" class="colorPickerBtn helpicon1" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" style="background-color:<?php echo $TPL_V1["color"]?>" ></button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='address'){?>
					<button type="button" class="addrhelpicon helpicon resp_btn" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["zipcode"]){?>[<?php echo $TPL_V1["zipcode"]?>]  <br> (지번) <?php echo $TPL_V1["address"]?> <?php echo $TPL_V1["addressdetail"]?><br>(도로명) <?php echo $TPL_V1["address_street"]?> <?php echo $TPL_V1["addressdetail"]?> <?php }?> <?php if($TPL_V1["biztel"]){?>업체 연락처:<?php echo $TPL_V1["biztel"]?><?php }?><br/>수수료 : <?php echo $TPL_V1["address_commission"]?> %">지역</button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='date'){?>
					<input type="hidden"  name="codedate[]" value="<?php echo $TPL_V1["codedate"]?>">
					<button type="button" class="codedatehelpicon helpicon resp_btn" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["codedate"]&&$TPL_V1["codedate"]!='0000-00-00'){?><?php echo $TPL_V1["codedate"]?><?php }?>">날짜</button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='dayinput'){?>
					<input type="hidden"  name="sdayinput[]" value="<?php echo $TPL_V1["sdayinput"]?>">
					<input type="hidden"  name="fdayinput[]" value="<?php echo $TPL_V1["fdayinput"]?>">
					<button type="button" class="dayinputhelpicon helpicon resp_btn" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["sdayinput"]&&$TPL_V1["fdayinput"]){?><?php echo $TPL_V1["sdayinput"]?> ~ <?php echo $TPL_V1["fdayinput"]?><?php }?>">수동기간</button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='dayauto'){?>
					<button type="button" class="dayautohelpicon helpicon resp_btn"  opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["dayauto_type"]){?>'결제확인' <?php echo $TPL_V1["dayauto_type_title"]?> <?php echo $TPL_V1["sdayauto"]?>일 <?php if($TPL_V1["dayauto_type"]=='day'){?>이후<?php }?>부터 + <?php echo $TPL_V1["fdayauto"]?>일<?php echo $TPL_V1["dayauto_day_title"]?><?php }?>">자동기간</button>
<?php }?>
<?php }?>
			</td>
<?php }}?>
<?php if($TPL_VAR["package_yn"]!='y'){?><td class="center"><span class="goodsCode"></span><?php echo $TPL_V1["optioncode"]?></td><?php }?>
<?php if($TPL_VAR["package_yn"]!='y'&&!$TPL_VAR["sc"]["socialcp_input_type"]){?><td class="right pdr10"><?php echo $TPL_V1["weight"]?></td><?php }?>
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
			<td class="right pdr10 couponinputtitle"><?php echo get_currency_price($TPL_V1["coupon_input"])?></td>
<?php }?>

<?php if($TPL_VAR["package_count"]){?>
<?php if(is_array($TPL_R2=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
				<td class="reg_package_option_tbl">
<?php if($TPL_V2== 1){?>
						<input type="hidden" name="stock[]" value="<?php echo $TPL_V1["stock"]?>" />
<?php if($TPL_VAR["cfg_order"]["ableStockStep"]== 15){?>
						<input type="hidden" name="unUsableStock[]" value="<?php echo ($TPL_V1["badstock"]+$TPL_V1["reservation15"])?>" />
<?php }?>
<?php if($TPL_VAR["cfg_order"]["ableStockStep"]== 25){?>
						<input type="hidden" name="unUsableStock[]" value="<?php echo ($TPL_V1["badstock"]+$TPL_V1["reservation25"])?>" />
<?php }?>
<?php }?>

<?php if($TPL_V1["package_error_code"][$TPL_V2]){?>
					<div class="package_error">
						<script>package_error_msg('<?php echo $TPL_V1["package_error_code"][$TPL_K1+ 1]?>');</script>
					</div>
<?php }?>
					<div>
<?php if($TPL_V1["package_goods_seq"][$TPL_V2]){?>
						<a href="../goods/regist?no=<?php echo $TPL_V1["package_goods_seq"][$TPL_V2]?>" target="_blank">
						<span class="reg_package_goods_seq<?php echo $TPL_V2?>">[<?php echo $TPL_V1["package_goods_seq"][$TPL_V2]?>]</span>
<?php }?>
						<span class="reg_package_goods_name<?php echo $TPL_V2?>"><?php echo $TPL_V1["package_goods_name"][$TPL_V2]?></span>
<?php if($TPL_V1["package_goods_seq"][$TPL_V2]){?>
						</a>
<?php }?>
					</div>
					<div class="reg_package_option<?php echo $TPL_V2?>">
<?php if($TPL_V1["package_option"][$TPL_V2]){?>
						<?php echo $TPL_V1["package_option"][$TPL_V2]?>

<?php }else{?>
						기본
<?php }?>
					</div>
					<div class="reg_package_option_code<?php echo $TPL_V2?>"><?php echo $TPL_V1["package_option_code"][$TPL_V2]?> <?php if($TPL_V1["package_weight"][$TPL_V2]){?><?php if($TPL_V1["package_option_code"][$TPL_V2]){?>|<?php }?> <?php echo $TPL_V1["package_weight"][$TPL_V2]?>kg<?php }?></div>
					<div class="reg_package_unit_ea<?php echo $TPL_V2?>">
<?php if($TPL_V1["package_unit_ea"][$TPL_V2]){?>주문당 <?php echo $TPL_V1["package_unit_ea"][$TPL_V2]?>

						발송
						<input type="hidden" name="package_unit_ea<?php echo $TPL_V2?>[]" size="3" value="<?php echo $TPL_V1["package_unit_ea"][$TPL_V2]?>">
						<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_package_ea')" ></span>
					</div>
					<div class="reg_package_option_seq<?php echo $TPL_V2?>">
<?php if($TPL_V1["package_option_seq"][$TPL_V2]){?>
					<?php echo number_format($TPL_V1["package_stock"][$TPL_V2])?>

					(<?php echo number_format($TPL_V1["package_badstock"][$TPL_V2])?>)
					/
					<?php echo number_format($TPL_V1["package_ablestock"][$TPL_V2])?>

					/
					<?php echo number_format($TPL_V1["package_safe_stock"][$TPL_V2])?>

<?php }?>
					</div>
					<input type="hidden" name="reg_package_option_seq<?php echo $TPL_V2?>[]" value="<?php echo $TPL_V1["package_option_seq"][$TPL_V2]?>">
				</td>
<?php }?>
<?php }}?>
<?php }else{?>
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'&&$TPL_VAR["provider_seq"]== 1&&$TPL_VAR["goods"]["goods_seq"]> 0&&$TPL_V1["org_option_seq"]> 0){?>
			<td class="right pdr10 hand" onclick="goods_option_btn('<?php echo $TPL_VAR["goods"]["goods_seq"]?>',this,<?php if($TPL_VAR["scm_cfg"]['use']=='Y'){?>'<?php echo $TPL_VAR["goods"]["provider_seq"]?>'<?php }else{?>'2'<?php }?>)">
				<span class="option-stock" optType="option" optSeq="<?php echo $TPL_V1["org_option_seq"]?>"><?php echo number_format($TPL_V1["stock"])?></span>
				<input type="hidden" name="stock[]" value="<?php echo $TPL_V1["stock"]?>" size="5" class="onlynumber input-box-default-text right"/>
			</td>
<?php }else{?>
			<td class="right pdr10">
				<span><?php echo number_format($TPL_V1["stock"])?></span>
				<input type="hidden" name="stock[]" value="<?php echo $TPL_V1["stock"]?>" size="5"  class="onlynumber right" />
			</td>
<?php }?>
			<td class="right pdr10">
				<span><?php echo number_format($TPL_V1["badstock"])?></span>
				<input type="hidden" name="badstock[]" value="<?php echo $TPL_V1["badstock"]?>" size="5"  class="onlynumber right"  />
			</td>
			<td class="right pdr10">
				<input type="hidden" name="reservation15[]" value="<?php echo $TPL_V1["reservation15"]?>" />
				<input type="hidden" name="reservation25[]" value="<?php echo $TPL_V1["reservation25"]?>" />
<?php if($TPL_VAR["cfg_order"]["ableStockStep"]== 15){?>
				<input type="hidden" name="unUsableStock[]" value="<?php echo $TPL_V1["badstock"]+$TPL_V1["reservation15"]?>" />
				<span class="optionUsableStock"><?php echo number_format($TPL_V1["stock"]-$TPL_V1["badstock"]-$TPL_V1["reservation15"])?></span>
<?php }?>
<?php if($TPL_VAR["cfg_order"]["ableStockStep"]== 25){?>
				<input type="hidden" name="unUsableStock[]" value="<?php echo $TPL_V1["badstock"]+$TPL_V1["reservation25"]?>" />
				<span class="optionUsableStock"><?php echo number_format($TPL_V1["stock"]-$TPL_V1["badstock"]-$TPL_V1["reservation25"])?></span>
<?php }?>
			</td>
			<td class="right pdr10">
				<?php echo number_format($TPL_V1["safe_stock"])?>

				<input type="hidden" name="safe_stock[]" value="<?php echo $TPL_V1["safe_stock"]?>" />
			</td>
<?php if($TPL_VAR["goods"]["provider_seq"]== 1){?>
			<td class="right pdr10"><span title="<?php echo $TPL_V1["supply_price"]?>"><?php echo get_currency_price($TPL_V1["supply_price"])?></span></td>
<?php }?>
<?php }?>
			<td class="right pdr10 <?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>"><?php echo get_currency_price($TPL_V1["commission_price"],'','KRW')?></td>
			<td class="right pdr10 <?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>">
<?php if($TPL_V1["commission_rate"]){?>
<?php if($TPL_V1["commission_type"]=='SUPR'){?><?php echo get_currency_price($TPL_V1["commission_rate"], 2,'basic')?><?php }else{?><?php echo $TPL_V1["commission_rate"]?>%<?php }?>
<?php }else{?>
				0
<?php }?>
			</td>
			<td class="right pdr10 pricetd"><?php echo get_currency_price($TPL_V1["consumer_price"])?></td>
			<td class="right pdr10 pricetd">
				<span class="priceSpan"><?php echo get_currency_price($TPL_V1["price"])?></span>
				<input type="hidden" name="consumerPrice[]" value="<?php echo $TPL_V1["consumer_price"]?>">
				<input type="hidden" name="price[]" value="<?php echo $TPL_V1["price"]?>" />
			</td>
			<td class="right pdr10">
<?php if($TPL_VAR["goodsTax"]=='exempt'){?>0<?php }else{?><?php echo get_currency_price($TPL_V1["tax"])?><?php }?>
			</td>
			<td class="right pdr10 ">
<?php if($TPL_V1["reserve_unit"]=='percent'){?>
				<?php echo $TPL_V1["reserve_rate"]?>% (<?php echo get_currency_price($TPL_V1["reserve"], 2)?>)
<?php }else{?>
				<?php echo get_currency_price($TPL_V1["reserve"], 2)?>

<?php }?>
			</td>
			<td class="center"><?php if($TPL_V1["option_view"]=='N'){?>미노출<?php }else{?>노출<?php }?></td>
			<td class="center">
<?php if($TPL_V1["infomation"]){?>
				<span class="underline hand" onclick="viewOptionInfomation(this);">보기</span>
				<textarea class="optionInfomation" style="display:none;"><?php echo $TPL_V1["infomation"]?></textarea>
<?php }else{?>
				<span class="desc">미입력</span>
<?php }?>
			</td>
		</tr>
<?php }?>
<?php }}?>
		</tbody>
<?php }?>
	</table>
</div>


<div id="preview_option_divide">
	<div class="content">
<?php if($TPL_VAR["options"]){?>
	<table class="table_basic">
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
	<tr>
		<th><?php echo $TPL_V1?></th>
		<td><select style='width:200px;'><option>- 선택 -</option>
<?php if(is_array($TPL_R2=$TPL_VAR["options"][ 0]["optionArr"][$TPL_I1])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
			<option><?php echo $TPL_V2?></option>
<?php }}?>
		</select>
		</td>
	</tr>
<?php }}?>
	</table>
<?php }?>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('popPreviewOpt')">닫기</button>
	</div>
</div>
<div id="preview_option_sum">
	<div class="content">
<?php if($TPL_VAR["options"]){?>
	<table class="table_basic">
	<tr>
		<th>옵션</th>
		<td><select style='width:200px;'><option>- 선택 -</option>
<?php if($TPL_options_1){foreach($TPL_VAR["options"] as $TPL_V1){?>
			<option><?php if(is_array($TPL_R2=$TPL_V1["opts"])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?><?php if($TPL_I2> 0){?> / <?php }?><?php echo $TPL_V2?><?php }}?></option>
<?php }}?>
		</select>
		</td>
	</tr>
	</table>
<?php }?>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('popPreviewOpt')">닫기</button>
	</div>
</div>

<script type="text/javascript">
<?php if($TPL_VAR["isAddr"]=='Y'){?>
parent.show_mapView();
<?php }else{?>
parent.hide_mapView();
<?php }?>

<?php if($TPL_VAR["reload"]=='y'){?>
location.replace('?provider_seq=<?php echo $TPL_VAR["provider_seq"]?>&mode=view&tmp_seq=<?php echo $TPL_VAR["tmp_seq"]?>&tmp_policy=<?php echo $TPL_VAR["tmp_policy"]?>&goodsTax=<?php echo $TPL_VAR["goodsTax"]?>&goods_seq=<?php echo $TPL_VAR["goods_seq"]?>&socialcp_input_type=<?php echo $TPL_VAR["sc"]["socialcp_input_type"]?>&islimit=<?php echo $TPL_VAR["islimit"]?>');
<?php }else{?>
<?php if($TPL_VAR["options"]){?>
		parent.document.goodsRegist.tmp_option_seq.value	= '<?php echo $TPL_VAR["tmp_seq"]?>';
		parent.document.getElementById("optionLayer").innerHTML	= document.getElementById("optionLayer").innerHTML;
		parent.document.getElementById("preview_option_divide").innerHTML	= document.getElementById("preview_option_divide").innerHTML;
		parent.document.getElementById("preview_option_sum").innerHTML	= document.getElementById("preview_option_sum").innerHTML;
		parent.help_tooltip();
		parent.set_option_select_layout();
		parent.openall_change('<?php echo $TPL_VAR["islimit"]?>');
<?php }?>
<?php }?>

var goodsCode	= parent.document.getElementById('goodsCode').value;

var optionList	= parent.document.getElementsByClassName("goodsCode");

for (i = 0, cnt = optionList.length; i < cnt; i++) {
	optionList[i].innerHTML	= goodsCode;
} 

//parent.setOptionStockSetText();
</script>