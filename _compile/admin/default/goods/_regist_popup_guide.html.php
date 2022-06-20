<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/goods/_regist_popup_guide.html 000063211 */ 
$TPL_frequentlyinplistAll_1=empty($TPL_VAR["frequentlyinplistAll"])||!is_array($TPL_VAR["frequentlyinplistAll"])?0:count($TPL_VAR["frequentlyinplistAll"]);
$TPL_inputs_1=empty($TPL_VAR["inputs"])||!is_array($TPL_VAR["inputs"])?0:count($TPL_VAR["inputs"]);
$TPL_discount_event_list_1=empty($TPL_VAR["discount_event_list"])||!is_array($TPL_VAR["discount_event_list"])?0:count($TPL_VAR["discount_event_list"]);
$TPL_systemmobiles_1=empty($TPL_VAR["systemmobiles"])||!is_array($TPL_VAR["systemmobiles"])?0:count($TPL_VAR["systemmobiles"]);
$TPL_nationsInfo_1=empty($TPL_VAR["nationsInfo"])||!is_array($TPL_VAR["nationsInfo"])?0:count($TPL_VAR["nationsInfo"]);
$TPL_frequentlyinplist_1=empty($TPL_VAR["frequentlyinplist"])||!is_array($TPL_VAR["frequentlyinplist"])?0:count($TPL_VAR["frequentlyinplist"]);?>
<!-- 오픈마켓 검색어 미리보기 -->
<div id="keyword_linkage_info_dialog" class="hide">
	<div class="content">
		<span class="item-title">연동 정보</span>
		<table class="table_basic thl mb10">
			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>
			<tr>
				<th>연동 정보</th>
				<td><span class='keyword'></span></td>
			</tr>
		</table>

		<span class="item-title">검색어</span>
		<table class="table_basic thl">
			<colgroup>
				<col width="30%" />
				<col width="70%" />
			</colgroup>
			<tr class="shoplinker hide">
				<th>샵링커</th>
				<td class="shoplinker_keyword" ></td>
			</tr>
			<tr class="storefarm hide">
				<th>스마트 스토어</th>
				<td></td>
			</tr>
			<tr class="open11st hide">
				<th>11번가</th>
				<td></td>
			</tr>
			<tr class="coupang hide">
				<th>쿠팡</th>
				<td></td>
			</tr>
		</table>
		<ul class='bullet_hyphen resp_message'>
			<li class="storefarm hide">스마트 스토어: 최대 10개, 검색어 쉼표로 구분</li>
			<li class="open11st hide">11번가: 최대 40 byte</li>
			<li class="coupang hide">쿠팡: 최대 40개, 검색어 쉼표로 구분</li>
			<li class="shoplinker hide">샵링커: 최대 40자</li>
		</ul>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onclick="closeDialog('keyword_linkage_info_dialog')">닫기</button>
	</div>

</div>

<!-- 재고에 따른 판매 설정 - 개별설정-->
<div id="popup_runout_setting" class="hide">
	<div class="content">
		<table class="table_basic thl mb10" id="goods_runout">
		<colgroup><col width="20%"><col width="80%"></colgroup>
		<tr>
			<th>개별 설정</th>
			<td>
				<div class="resp_radio">
					<label><input type="radio" name="runout" value="stock" /> 재고가 있으면 판매</label>
						<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_stock_tip1', 'sizeS')"></span>
					<label><input type="radio" name="runout" value="ableStock" checked /> 가용 재고가 있으면 판매</label>
						<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_stock_tip2', 'sizeS')"></span>
					<label><input type="radio" name="runout" value="unlimited" /> 재고와 상관 없이 판매</label>
						<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_stock_tip3', 'sizeS')"></span>
				</div>
			</td>
		</tr>
		<tr class="ableStock_sub <?php if($TPL_VAR["cfg_order"]["runout"]!='ableStock'){?>hide<?php }?>">
			<th>가용 재고</th>
			<td>
				<input type="text" name="ableStockLimit" size="5" value="<?php echo $TPL_VAR["cfg_order"]["ableStockLimit"]?>" class="right line onlynumber_signed"> 이하 일 때 품절 또는 재고 확보 중 처리
				<div class="gray">※ 가용재고 = 상품의 재고 - 출고 예약량 - 불량재고</div>
			</td>
		</tr>
		</table>
	</div>

	<div class="footer">
		<input type="button" class="resp_btn active size_XL" value="확인" onClick="check_runout('popup_runout_setting')" />
		<input type="button" class="resp_btn v3 size_XL" onclick="closeDialog('popup_runout_setting')" value="취소" />
	</div>
</div>

<!-- 브랜드/지역 선택 팝업 -->
<div id="categoryPopup"></div>

<!-- 옵션 코드 자동 생성 -->
<div id="makeGoodsCodLay" class="hide">
	<div class="content">
		<div class="center" style="padding-top:10px;color:blue">현재 상품 기본코드 자동생성규칙</div>
		<div class="center" style="padding-top:10px;">
<?php if($TPL_VAR["goodscodesettingview"]){?><?php echo substr($TPL_VAR["goodscodesettingview"], 0,strlen($TPL_VAR["goodscodesettingview"])- 3)?><?php }else{?>규칙없음<?php }?>
		</div>
	</div>
	<div class="footer">
<?php if($TPL_VAR["goodscodesettingview"]&&$TPL_VAR["goods"]["goods_seq"]){?>
		<button type="button" onClick="makeGoodsCode();" class="resp_btn active size_XL">자동생성</button>
<?php }else{?>
		<button type="button" class="resp_btn active size_XL disabled" disabled>자동생성</button>
<?php }?>
		<button type="button" class="resp_btn v3 size_XL" onclick="closeDialog('makeGoodsCodLay')">취소</button>
	</div>
</div>

<!--### 옵션보기 설정 -->
<div id="set_option_view_lay" class="hide"></div>

<!--### 필수옵션 미리보기 -->
<div id="popPreviewOpt" class="hide"></div>

<!-- 필수 옵션 default form -->
<div id="optionDefaultForm" class="hide">
	<table class="table_basic">
	<thead>
	<tr>
<?php if($TPL_VAR["package_yn"]!='y'){?>
		<th style="min-width:90px;">상품코드
			<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_code', 'sizeS')"></span>
		</th>
<?php if($TPL_VAR["socialcpuse"]){?>
		<th style="min-width:80px;" class="couponinputtitle">값어치<br/><span class="couponinputsubtitle"><?php if($TPL_VAR["goods"]["socialcp_input_type"]=='price'){?>금액<?php }else{?>횟수<?php }?></span></th>
<?php }else{?>
		<th style="min-width:60px;">무게(kg)</th>
<?php }?>

		<th style="min-width:70px;">재고 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_stock', 'sizeS')"></span></th>
		<th style="min-width:70px;">불량 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_bedstock', 'sizeS')"></span></th>
		<th style="min-width:70px;">가용 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_availablestock', 'sizeS')"></span></th>
		<th style="min-width:70px;">안전재고
<?php if(($TPL_VAR["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')&&$TPL_VAR["scm_cfg"]['use']){?>
				<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_safestock', 'sizeS')"></span>
				<input type="hidden" class="safestock_text" title="<?php echo $TPL_VAR["scm_cfg"]['admin_env_name']?>"/>
<?php }else{?>
				<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_safestock', 'sizeS')"></span>
				<input type="hidden" class="safestock_text" title="<?php if(($TPL_VAR["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')){?>기본매장<?php }else{?>입점사<?php }?>"/>
<?php }?>
		</th>
<?php if(($TPL_VAR["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')){?>
		<th style="min-width:90px;">매입가(평균)</th>
<?php }?>
<?php }else{?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<th style="min-width:100px;" class="reg_package_option_title_tbl">상품<?php echo $TPL_V1?></th>
<?php }}?>
		<!--<div class="pdb5">
		실제 상품
		<span class="btn small"><button type="button" class="package_goods_make" onclick="package_goods_make();">검색</button></span>
		<span class="btn small"><button type="button" onclick="package_error_check('option');">연결 상태 확인</button></span>
		</div>
		<span class="storeinfo_title">' + storeinfo_title + '</span>
		</th>
		-->
<?php }?>

<?php if($TPL_VAR["provider_seq"]== 1){?>
		<th style="min-width:90px;" class="not_for_seller hide" rowspan="2">정산 금액</th>
		<th style="min-width:90px;" class="not_for_seller hide" rowspan="2"><span class="commission_type_title">수수료</span>
<?php }else{?>
		<th style="min-width:90px;">정산 금액</th>
		<th style="min-width:90px;"><span class="commission_type_title">수수료</span>
<?php }?>
		<th style="min-width:90px;">정가</th>
		<th style="min-width:90px;">판매가 <span class="required_chk"></span></th>
		<th style="min-width:80px;">부가세</th>
		<th style="min-width:110px;">마일리지</th>
<?php if($TPL_VAR["package_yn"]=='y'){?>
		<th style="min-width:80px;" class="optionStockSetText">옵션 노출</th>
<?php }?>
	</tr>
	</thead>
	<tbody>
	<tr class="optionTr">
<?php if($TPL_VAR["package_yn"]!='y'){?>
		<td class="center">
<?php if($TPL_VAR["goods"]["goods_seq"]> 0){?>
			<button type="button" id="goodsCodeBtn" class="resp_btn v2" title="기본코드자동생성" >코드생성</button>
<?php }?>
			<input type="text" name="goodsCode"  id="goodsCode" value="" class="wp80" />
		</td>
<?php if(!$TPL_VAR["socialcpuse"]){?>
			<td class="center"><input class="line onlyfloat input-box-default-text right" name="weight[]" value="0" size="3" type="text"></td>
<?php }?>
<?php }?>

<?php if($TPL_VAR["socialcpuse"]){?>
		<td class="pdr10 couponinputtitle"><input type="text" name="coupon_input[]" class="right onlynumber" size="10" value=""/></td>
<?php }?>
<?php if($TPL_VAR["package_yn"]=='y'){?>
		<input type="hidden" name="stock[]" value="50" />
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<td class="center reg_package_option_tbl">
			<div>
			<span class="reg_package_goods_seq<?php echo $TPL_V1?>"></span>
			<span class="reg_package_goods_name<?php echo $TPL_V1?>"></span>
			</div>
			<div class="reg_package_option<?php echo $TPL_V1?>"></div>
			<div class="reg_package_unit_ea<?php echo $TPL_V1?>">
				주문당 <input type="text" name="package_unit_ea<?php echo $TPL_V1?>[]" size="3" value="1" class="right">
				발송 <span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_package_ea')" ></span>
			</div>
			<div class="reg_package_option_seq<?php echo $TPL_V1?>">
			</div>
			<input type="hidden" name="reg_package_option_seq<?php echo $TPL_V1?>[]" value="">
		</td>
<?php }}?>
<?php }else{?>
		<td class="center  _stock">
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'&&($TPL_VAR["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')){?>
			<span>0</span>
			<input type="hidden" name="stock[]" value="0" size="5" class="right onlynumber" />
<?php }else{?>
			<input type="text" name="stock[]" value="0" size="5" class="right onlynumber" />
<?php }?>
		</td>
		<td class="center _stock">
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'&&($TPL_VAR["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')){?>
			<span>0</span>
			<input type="hidden" name="badstock[]" value="0" size="5" class="right onlynumber" />
<?php }else{?>
			<input type="text" name="badstock[]" value="0" size="5" class="right onlynumber"/>
<?php }?>
		</td>

		<td class="right _stock">
			<span class="optionUsableStock">0</span>
			<input type="hidden" name="unUsableStock[]" value="0" />
			<input type="hidden" name="reservation15[]" value="" />
			<input type="hidden" name="reservation25[]" value="" />
		</td>
		<td class="center _stock">
			<input type="text" name="safe_stock[]" value="0" size="5" class="right onlynumber"/>
		</td>
<?php if($TPL_VAR["provider_seq"]== 1){?>
		<td class="right pdr10">
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'&&($TPL_VAR["provider_seq"]=='1'||$TPL_VAR["sc"]["provider"]=='base')){?>
			<span>0</span>
			<input type="hidden" name="supplyPrice[]" value="0" />
<?php }else{?>
			<input type="text" name="supplyPrice[]" value="0" class="onlyfloat right wp80"/>
<?php }?>
		</td>
<?php }?>
<?php }?>

<?php if($TPL_VAR["provider_seq"]== 1){?>
		<td class="right pdr10 settlementAmount not_for_seller hide"><input type="hidden" name="optionSeq[]" value="" /></td>
		<td class="right pdr10 not_for_seller hide">
			<input class="right onlyfloat input-box-default-text" name="commissionRate[]" value="<?php echo $TPL_VAR["provider"]["charge"]?>" size="4" type="text">
			<span class="commission_type SACO_unit">%</span>
			<span class="commission_type SUPPLY_unit" style="display:none;">
				<select name="commissionType[]" class="commission_type_sel">
					<option value="SUCO">%</option>
					<option value="SUPR"><?php echo $TPL_VAR["basic_currency_info"]['currency_symbol']?></option>
				</select>
			</span>
		</td>
<?php }else{?>
		<td class="pdr10 settlementAmount right"><input type="hidden" name="optionSeq[]" value="" /></td>
		<td class="center">
			<!--공급가액 방식-->
<?php if($TPL_VAR["provider"]["commission_type"]=="SUPR"){?>
				<?php echo get_currency_price($TPL_VAR["provider"]["charge"], 2)?>

<?php }?>
<?php if($TPL_VAR["sellermode"]!='SELLER'){?>
				<input type="text" class="right onlyfloat input-box-default-text wp40" name="commissionRate[]" value="<?php echo $TPL_VAR["provider"]["charge"]?>">
<?php }else{?>
				<input type="hidden" class="right onlyfloat input-box-default-text" name="commissionRate[]" value="<?php echo $TPL_VAR["provider"]["charge"]?>"> <?php echo $TPL_VAR["provider"]["charge"]?>

<?php }?>
			<span class="commission_type SACO_unit">%</span>
			<span class="commission_type SUPPLY_unit" style="display:none;">
<?php if($TPL_VAR["sellermode"]=='SELLER'){?>
					<input type="hidden" name="commissionType[]" value="<?php echo $TPL_VAR["provider"]["commission_type"]?>"><?php if($TPL_VAR["provider"]["commission_type"]=='SUCO'){?>%<?php }else{?><?php echo $TPL_VAR["basic_currency_info"]['currency_symbol']?><?php }?>
<?php }else{?>
				<select name="commissionType[]" class="commission_type_sel">
					<option value="SUCO">%</option>
					<option value="SUPR"><?php echo $TPL_VAR["basic_currency_info"]['currency_symbol']?></option>
				</select>
			</span>
<?php }?>
		</td>
<?php }?>

		<td class="center pricetd"><input type="text" name="consumerPrice[]" value="0" class="onlyfloat right black wp70" /></td>
		<td class="center pricetd"><input type="text" name="price[]" value="0" class="onlyfloat right wp70" /></td>
		<td class="right pdr10 tax"><?php echo get_currency_price( 0)?></td>
		<td class="center">

<?php if($TPL_VAR["sellermode"]!='SELLER'){?>
				<select name="reserve_policy" readonly>
				<option value="shop">통합</option>
				<option value="goods">개별</option><br/>
				</select>
<?php }?>
<?php if($TPL_VAR["sellermode"]!='SELLER'){?>
			<input type="text" name="reserveRate[]" value="0" size="4" class="onlyfloat right" />
			<select name="reserveUnit[]" class="wx50">
				<option value="percent">%</option>
				<option value="<?php echo $TPL_VAR["config_system"]['basic_currency']?>"><?php echo $TPL_VAR["config_system"]['basic_currency']?></option>
			</select>
			<input type="hidden" name="reserve[]" class="noborder onlynumber right" value="0" size="7" readonly />
<?php }else{?>
			<input type="hidden" name="reserveRate[]" value="<?php echo $TPL_VAR["default_reserve_percent"]?>" />
			<input type="hidden" name="reserveUnit[]" value="percent" />
			<input type="hidden" name="baseReserveRate[]" value="<?php echo $TPL_VAR["default_reserve_percent"]?>" />
			<input type="hidden" name="baseReserveUnit[]" value="percent" />
			<span class="reserveRateValue"><?php echo get_currency_price( 0, 2)?></span>
<?php }?>
		</td>
<?php if($TPL_VAR["package_yn"]=='y'){?>
		<td class="center">
			노출<input type="hidden" name="option_view[]" value="Y"/>
		</select>
		</td>
<?php }?>
	</tr>
	</tbody>
	</table>
</div>

<!-- 추가구성옵션 주문 단계별 설정-->
<div id="subOptionProcessSet" class="hide">
	<div class="content">
		<table class="table_basic">
			<colgroup>
				<col width="20%" />
				<col width="80%" />
			</colgroup>
			<tr>
				<th>취소 시</th>
				<td>
					<label class="resp_radio"><input type="radio" id="individual_refund_set_1" name="individual_refund" value="1" /> 개별 취소 가능</label>
					<label class="resp_checkbox">( <input type="checkbox" id="individual_refund_inherit_set" name="individual_refund_inherit" value="1" /> 단, 필수 상품과 함께 취소 )</label>
					<label class="resp_radio ml20"><input type="radio" id="individual_refund_set_0" name="individual_refund" value="0" checked /> 개별 취소 불가</label>
				</td>
			</tr>
			<tr>
				<th>출고 시</th>
				<td>
					<div class="resp_radio">
						<label><input type="radio" id="individual_export_set_1" name="individual_export" value="1" /> 개별 출고 가능</label>
						<label><input type="radio" id="individual_export_set_0" name="individual_export" value="0" checked /> 개별 출고 불가(필수 상품과 함께 출고)</label>
					</div>
				</td>
			</tr>
			<tr>
				<th>반품 시</th>
				<td>
					<div class="resp_radio">
						<label><input type="radio" id="individual_return_set_1" name="individual_return" value="1" /> 개별 반품 가능</label>
						<label><input type="radio" id="individual_return_set_2" name="individual_return" value="0" checked /> 개별 반품 불가(필수 상품과 함께 반품)</label>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="footer">
		<button type="button" onClick="setSubOptionProcess();" class="resp_btn active size_XL">확인</button>
		<button type="button" class="resp_btn v3 size_XL" onclick="closeDialog('subOptionProcessSet')">취소</button>
	</div>
</div>

<!-- 추가구성옵션 :: 구매 방법 설정-->
<div id="set_option_select_layout" class="hide">
	<div class="content">
		<table class="table_basic">
		<colgroup>
			<col width="25%"/>
			<col width="75%" />
		</colgroup>
			<!-- 추가 구성 옵션 -->
			<tr class="suboption">
				<th>연결 방법</th>
				<td>
					<select name="set_suboption_select_layout_group" onchange="set_option_select_display('');">
						<option value="group">필수옵션과 쌍으로 묶임</option>
						<option value="first">첫번째 필수옵션에 묶임</option>
					</select>
				</td>
			</tr>
			<tr class="suboption">
				<th>노출 위치</th>
				<td>
					<select name="set_suboption_select_layout_position" class="disable" onchange="$(this).find('option').eq(0).attr('selected', true);">
						<option value="up">옵션선택 영역에 노출</option>
					</select>
				</td>
			</tr>
			<!-- 추가 입력 옵션 -->
			<tr class="inputoption hide">
				<th>연결 방법</th>
				<td>
					<select name="set_inputoption_select_layout_group" class="disable" onchange="$(this).find('option').eq(0).attr('selected', true);">
						<option value="group">필수옵션과 쌍으로 묶임</option>
						<option value="first">첫번째 필수옵션에 묶임</option>
					</select>
				</td>
			</tr>
			<tr class="inputoption hide">
				<th>노출 위치</th>
				<td>
					<select name="set_inputoption_select_layout_position" onchange="set_option_select_display('');">
						<option value="up">옵션선택 영역에 노출</option>
						<option value="down">선택된 옵션 영역에 노출</option>
					</select>
				</td>
			</tr>
			<tr class="suboption inputoption">
				<th>미리 보기</th>
				<td>
					<img src="/admin/skin/default/images/common/option_select_layout_1.jpg" id="display_option_select_layout_image" width="350" />
				</td>
			</tr>
		</tbody>
		</table>

		<?php echo $TPL_VAR["option_select_layout_notice"]?>


		<ul class="bullet_hyphen resp_message">
			<li>모바일 동일 적용</li>
		</ul>
	</div>

	<div class="footer">
		<button type="button" onClick="set_option_select_display('apply');" class="resp_btn active size_XL">확인</button>
		<button type="button" class="resp_btn v3 size_XL" onclick="closeDialog('set_option_select_layout')">취소</button>
	</div>
</div>

<!-- 추가입력만들기 다이얼로그 -->
<div id="memberInputDialog" class="hide">
	<div class="content" style="overflow-y:scroll;">
		<div class="item-title">추가 입력 옵션 생성/수정</div>
		<table class="table_basic">
		<colgroup>
			<col width="20%">
			<col width="80%">
		</colgroup>
		<tr>
			<th class="left">신규/기존 옵션</th>
			<td>
				<div class="resp_radio">
					<label><input type="radio" name="optionCreateType" value="new" <?php if($TPL_VAR["sc"]["optionCreateType"]!="old"){?>checked<?php }?>>신규 생성</label>
					<label><input type="radio" name="optionCreateType" value="old" <?php if($TPL_VAR["sc"]["optionCreateType"]=="old"){?>checled<?php }?>>기존 옵션</label>
				</div>
			</td>
		</tr>
		<tr class="oldOption hide">
			<th class="left">옵션 가져오기</th>
			<td>
				<span id="frequentlytypeinputoptlay">
					<select name="frequentlytypeinputopt" class="frequentlytypeinputopt">
						<option value="0">자주 쓰는 상품의 추가입력옵션</option>
<?php if($TPL_VAR["frequentlyinplistAll"]){?>
<?php if($TPL_frequentlyinplistAll_1){foreach($TPL_VAR["frequentlyinplistAll"] as $TPL_V1){?><option value="<?php echo $TPL_V1["goods_seq"]?>"><?php echo getstrcut(strip_tags($TPL_V1["goods_name"]), 20)?></option><?php }}?>
<?php }?>
					</select>
				</span>
				<button type="button" class="resp_btn v2" id="frequentlytypeoptbtn" goods_seq="<?php echo $TPL_VAR["goods_seq"]?>">가져오기</button>
			</td>
		</tr>
		</table>

		<div class="item-title mt10">추가 입력 옵션 상세</div>
		
		<table class="table_row_basic optionList">
		<thead>
		<colgroup>
			<col width="60" />
			<col width="60"/>
			<col/>
			<col width="300"/>
			
		</colgroup>
		<thead>
			<tr>
				<th><button type="button" class="addMemberInputMake btn_plus"></button></th>
				<th>필수</th>
				<th>옵션명</th>
				<th>옵션값</th>
			</tr>
		</thead>
		<tbody>
<?php if($TPL_inputs_1){$TPL_I1=-1;foreach($TPL_VAR["inputs"] as $TPL_V1){$TPL_I1++;?>
			<tr>
				<td class="center">
					<span class="<?php if($TPL_I1== 0){?>hide<?php }?>"><button type="button" class="delMemberInputMake btn_minus"></button></span>
				</td>
				<td class="center">
					<label class="resp_checkbox"><input type="checkbox" name="memberInputRequire[]" value="require" <?php if($TPL_V1["input_require"]){?>checked="checked"<?php }?> /></label>
				</td>
				<td class="center">
					<input type="text" name="memberInputMakeName[]" class="wp95" value="<?php echo $TPL_V1["input_name"]?>"/>
				</td>
				<td>
					<select name="memberInputMakeForm[]">
						<option value="text" <?php if($TPL_V1["input_form"]=='text'){?>selected<?php }?>>텍스트박스</option>
						<option value="edit" <?php if($TPL_V1["input_form"]=='edit'){?>selected<?php }?>>에디트박스</option>
						<option value="file" <?php if($TPL_V1["input_form"]=='file'){?>selected<?php }?>>이미지 업로드</option>
					</select>

<?php if($TPL_V1["input_form"]=='text'||$TPL_V1["input_form"]=='edit'){?>
					<span class="textLimit">
						<input type="text" name="memberInputMakeLimit[]" class="line onlynumber" size="3" value="<?php echo $TPL_V1["input_limit"]?>" max="255" />자 이내
					</span>
					<span class="uploadLimit" style="display:none;">2M이하</span>
<?php }else{?>
					<span class="uploadLimit">2M이하</span>
					<span class="textLimit" style="display:none;">
						<input type="text" name="memberInputMakeLimit[]" class="line onlynumber" size="3" value="imageUpload" max="255" />자 이내
					</span>
<?php }?>
				</td>
			</tr>
<?php }}else{?>
			<tr>
				<td class="center">
					<span class="hide"><button type="button" class="addMemberInputMake btn_minus"></button></span>
				</td>
				<td class="center">
					<label class="resp_checkbox"><input type="checkbox" name="memberInputRequire[]" value="require" /></label>
				</td>
				<td class="center">
					<input type="text" name="memberInputMakeName[]" value="" class="wp95" />
				</td>
				<td>
					<select name="memberInputMakeForm[]">
						<option value="text">텍스트박스</option>
						<option value="edit">에디트박스</option>
						<option value="file">이미지 업로드</option>
					</select>

					<span class="textLimit"><input type="text" name="memberInputMakeLimit[]" size="3" value="" />자 이내</span>
					<span class="uploadLimit" style="display:none;">2M이하</span>
				</td>
			</tr>
<?php }?>
		</tbody>
		</table>

		<div id="frequentlay" class="mt10">
			<label class="resp_checkbox" id="frequentlyinplay">
				<input type="checkbox" name="frequentlyinpbtn" value="1" <?php if($TPL_VAR["goods"]["frequentlyinp"]== 1){?> checked="checked" <?php }?>> 옵션 정보 저장
			</label>
		</div>
		
	</div>
	<div class="footer">
		<button type="button" id="memberInputMakeApply" class="resp_btn active size_XL">확인</button>
		<button type="button" class="resp_btn v3 size_XL" onclick="closeDialog('memberInputDialog')">취소</button>
	</div>
</div>

<!-- 상품 사진 - 등록 팝업-->
<div id="set_popup_image_multi_lay" class="hide"></div>
<!-- 상품 사진 - 순서 변경 삭제 팝업-->
<div id="set_popup_image_sort_lay" class="hide"></div>
<!-- 상품 사진 - 개벌 등록 팝업-->
<div id="set_popup_image_lay" class="hide"></div>

<!-- 상품등록 : 상품설명/공용 정보 -->
<div id="view_editor_div" class="hide">
	<div class="content">
		<form name="tmpContentsFrm" id="tmpContentsFrm" method="post" enctype="multipart/form-data" action="../goods_process/goods_edit_upload" target="actionFrame">
		<input type="hidden" name="goodsSeq" value="<?php echo $TPL_VAR["goods"]["goods_seq"]?>" />
		<input type="hidden" name="regist_date" value="<?php echo $TPL_VAR["goods"]["regist_date"]?>" />
		<input type="hidden" name="provider_seq" value="<?php echo $TPL_VAR["goods"]["provider_seq"]?>" />
		<input type="hidden" name="contents_type" value="" />
		<input type="hidden" name="r_info" value="create_info" />
		<input type="hidden" name="info_select_seq" value="" />
		<table class="table_basic v7" style="height:300px">
			<tr class="view_common_info">
				<th>상품 공통 정보명</th>
				<td>
					<input type="text" name="info_name" size="100"/>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="clear"><div class="view_contents_area"></div></td>
			</tr>
		</table >
		</form>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn active size_XL" onclick="view_editor_save()">확인</button>
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('view_editor_div')">취소</button>
	</div>
</div>

<!-- 상품등록 : 이미지 호스팅 설정 -->
<?php if($TPL_VAR["openmarketuse"]&&$TPL_VAR["goods_type"]!='gift'&&!$TPL_VAR["batchModify"]){?><div id="openmarketimghostinglay" class="hide"><?php $this->print_("openmarketimghosting",$TPL_SCP,1);?></div><?php }?>

<!--### 워터마크세팅 -->
<div id="watermark_setting_popup"></div>

<!-- 상품등록 : 배송방법(or 티켓) -->
<?php if($TPL_VAR["socialcpuse"]){?>
<?php }else{?>
<div class="shipping_group_tb hide">
	<table class="table_basic">
		<colgroup>
			<col width="" /><!-- 배송그룹명 -->
			<col width="90px" /><!-- 배송비계산 -->
			<col width="90px" /><!-- 배송가능국가 -->
			<col width="" /><!-- 배송방법 -->
			<col width="60px" /><!-- 상품상세안내 -->
			<col width="90px" /><!-- 기본 -->
			<col width="90px" /><!-- 추가 -->
			<col width="90px" /><!-- 희망 -->
			<col width="90px" /><!-- 수령 -->
			<col width="100px" /><!-- 지불방법 -->
			<col width="100px" /><!-- 관리 -->
		</colgroup>
		<thead>
			<tr>
				<th rowspan="2">배송그룹명<br/>(그룹번호)</th>
				<th rowspan="2">배송비계산</th>
				<th rowspan="2">배송가능국가</th>
				<th rowspan="2">배송방법</th>
				<th rowspan="2">상품상세</th>
				<th colspan="4">배송비</th>
				<th rowspan="2">지불</th>
				<th rowspan="2">관리</th>
			</tr>
			<tr>
				<th width="80px">기본</th>
				<th width="80px">추가</th>
				<th width="80px">희망배송일</th>
				<th width="80px">수령매장</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<!-- 배송안내 팝업  --><div id="shipDescPopup" class="hide"></div>
<!-- 배송그룹선택 팝업 --><div id="shipping_grp_sel" class="hide"></div>
<?php }?>

<!-- 결제 수단 -->
<div id="possible_pay" class="hide">
	<div class="content">
		<table class="table_basic">
			<colgroup>
				<col width="25%" />
				<col width="75%" />
			</colgroup>
			<tbody>
				<tr>
					<th class="left">무통장입금</th>
					<td>
						<div class="resp_checkbox">
							<label><input type="checkbox" name="possible_pay[]" value="bank" <?php if(!$TPL_VAR["payment"]["bank"]){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["bank"]){?>checked<?php }?>> 무통장 입금</label>
						</div>
					</td>
				</tr>
				<tr>
					<th class="left">통합 전자 결제</th>
					<td>
						<div class="resp_checkbox">
							<label><input type="checkbox" name="possible_pay[]" value="card" <?php if(!$TPL_VAR["payment"]["card"]){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["card"]){?>checked<?php }?>> 신용카드</label>
							<label><input type="checkbox" name="possible_pay[]" value="cellphone" <?php if(!$TPL_VAR["payment"]["cellphone"]){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["cellphone"]){?>checked<?php }?>> 핸드폰</label>
						</div>
						<div class="resp_checkbox">
							<label><input type="checkbox" name="possible_pay[]" value="account" <?php if(!$TPL_VAR["payment"]["account"]){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["account"]){?>checked<?php }?>> 계좌이체</label>
							<label><input type="checkbox" name="possible_pay[]" value="escrow_account" <?php if(!$TPL_VAR["escrow"]["account"]){?>disabled<?php }?> <?php if($TPL_VAR["escrow_check"]["account"]){?>checked<?php }?>> 계좌이체 에스크로</label><br />
						</div>
						<div class="resp_checkbox">
							<label><input type="checkbox" name="possible_pay[]" value="virtual" <?php if(!$TPL_VAR["payment"]["virtual"]){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["virtual"]){?>checked<?php }?>> 가상계좌</label>
							<label><input type="checkbox" name="possible_pay[]" value="escrow_virtual" <?php if(!$TPL_VAR["escrow"]["virtual"]){?>disabled<?php }?> <?php if($TPL_VAR["escrow_check"]["virtual"]){?>checked<?php }?>> 가상계좌 에스크로</label>
						</div>
					</td>
				</tr>
				<tr>
					<th class="left">간편 결제</th>
					<td>
						<div class="resp_checkbox">
							<label><input type="checkbox" name="possible_pay[]" value="kakaopay" <?php if($TPL_VAR["config_system"]["not_use_kakao"]=='y'){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["kakaopay"]){?>checked<?php }?>> 카카오페이</label>
							<label><input type="checkbox" name="possible_pay[]" value="payco" <?php if($TPL_VAR["config_system"]["not_use_payco"]=='y'){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["payco"]){?>checked<?php }?>> 페이코</label>
						</div>
					</td>
				</tr>
				<tr>
					<th class="left">해외 결제</th>
					<td>
						<div class="resp_checkbox">
							<label><input type="checkbox" name="possible_pay[]" value="paypal" <?php if($TPL_VAR["config_system"]["not_use_paypal"]=='y'){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["paypal"]){?>checked<?php }?>> 페이팔</label>
							<label><input type="checkbox" name="possible_pay[]" value="eximbay" <?php if($TPL_VAR["config_system"]["not_use_eximbay"]=='y'){?>disabled<?php }?> <?php if($TPL_VAR["payment_check"]["eximbay"]){?>checked<?php }?>> 엑심베이</label>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="footer">
		<button type="button" id="possible_pay_button" class="resp_btn active size_XL">확인</button>
		<button type="button" onClick="closeDialog('possible_pay')" class="resp_btn v3 size_XL">취소</button>
	</div>
</div>

<!--### 구매자(비회원 또는 회원)별 판매가격 디스플레이 -->
<div id="popStringPrice" class="hide"></div>

<!-- 아이콘 선택 -->
<div id="goodsIconPopup" class="hide">
	<div class="content">
		<form name='iconUpdateForm' enctype="multipart/form-data" method="post" action="../goods_process/icon" target="actionFrame">
		<input type="hidden" name="iconIndex" value="0" />
		<table class="table_basic">
			<colgroup>
				<col width="25%">
				<col width="75%">
			</colgroup>
			<tr>
				<th>신규 등록</th>
				<td>
					<div>
						<label class="resp_btn v2"><input type="file" id="goodsIconImg" accept="image/*" class="uploadify">파일선택</label>
						<input type="hidden" class="webftpFormItemInput" name="goodsIconImg" maxlength="255" />
						<button type="submit" class="resp_btn active iconSubmit">추가</button>
						<div class="preview_image box_style_03 hide mt10 wx200 center"><img src=""></div>
					</div>
					<ul class="bullet_hyphen resp_message clear">
						<li>파일 형식 gif</li>
						<li>업로드한 이미지 사이즈가 그대로 제공됩니다.</li>
					</ul>
				</td>
			</tr>
		</table>
		</form>
		<table class="table_basic mt10 icon_list">
			<colgroup>
				<col width="15%">
				<col width="20%">
				<col width="15%">
				<col>
				<col width="20%">
			</colgroup>
		<thead>
		<tr>
			<th>번호</th>
			<th>선택</th>
			<th>구분</th>
			<th>아이콘</th>
			<th>삭제</th>
		</tr>
		</thead>
		<tbody>
		<tr class="nothing">
			<td colspan="5" class="center">등록된 아이콘이 없습니다.</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('goodsIconPopup')">취소</button>
	</div>
</div>

<!-- 빅데이터 : 조건 선택 팝업 -->
<?php if(!$TPL_VAR["batchModify"]){?>
<div id="displayGoodsSelectPopup">
	<div id="displayGoodsSelect" class="hx100"></div>
</div>
<?php }?>

<!-- 상품선택 레이어 -->
<div id="lay_goods_select"></div>

<!-- 이미지 수정 상세보기 -->
<div class="hide">
	<table id="goodsImageMake">
	<colgroup>
		<col width="280">
		<col width="450">
		<col>
	</colgroup>
	<tr>
		<th class="left" valign="top">
			<div class="center pd10 relative" style="border:1px solid #ddd;min-width:280px;min-height:206px;">
				<img id="viewImg" class="absolute tp50 lp50" style="margin-top:-103px;margin-left:-125px;"><img id="viewImgtmp" class="hide">
			</div>
		</th>
		<td style="min-width: 450px;" valign="top">
			<input type="hidden" name="idx" id="idx" value="" />
			<input type="hidden" name="imgKind" id="imgKind" value="" />
			<table class="table_basic ml10">
			<colgroup>
				<col width="20%">
				<col width="80%">
			</colgroup>
			<tr>
				<th class="left">이미지 구분</td>
				<td>
					<span></span>
				</td>
			</tr>
			<tr>
				<th class="left">레이블</td>
				<td>
					<span id="goodsImgLabel_view"></span>
				</td>
			</tr>
			<tr>
				<th class="left">주소</th>
				<td>
					<span id="fileurl"></span>
				</td>
			</tr>
			<tr>
				<th class="left">사이즈</th>
				<td>
					<span id="filesize"></span>
				</td>
			</tr>
			<tr id="FileColorView">
				<th class="left">색상</th>
				<td>
					<span id="filecolor"></span>
				</td>
			</tr>
			</table>
		</td>
		<td valign="top">
			<div class="ml20" style="height:70px;margin-bottom:0px;">
				<button type="button" class="resp_btn v2 eachImageRegist" data-type="each">개별등록</button><br />
				<button type="button" class="resp_btn v3 mt5" id="imgDownload" onclick="each_goods_image_download();">다운로드</button>
			</div>
		</td>
	</tr>
	</table>
</div>
<!-- 이미지 수정 상세보기 -->

<!-- 적용된 이벤트 -->
<div id="eventDetailViewLay" class="eventView hide">
	<div class="content">
	<div class="item-title">할인 이벤트</div>
	<table class="table_row_basic">
		<colgroup>
			<col width="15%" />
			<col />
			<col width="20%" />
			<col width="35%" />
		</colgroup>
		<thead>
			<tr>
				<th>이벤트</th>
				<th>이벤트명</th>
				<th>기간</th>
				<th>혜택</th>
			</tr>
		</thead>
		<tbody>
<?php if($TPL_discount_event_list_1){foreach($TPL_VAR["discount_event_list"] as $TPL_V1){?>
			<tr class="row-event">
				<th>할인 이벤트</th>
				<td>
					<a href="../event/regist?event_seq=<?php echo $TPL_V1["common"]["event_seq"]?>" target="_blank"><span class="underline black"><?php echo $TPL_V1["common"]["title"]?></span></a>
				</td>
				<td class="center">
					<?php echo $TPL_V1["common"]["start_date"]?> ~ <?php echo $TPL_V1["common"]["end_date"]?>

<?php if($TPL_V1["common"]["weekday"]){?>&nbsp;<?php echo $TPL_V1["common"]["weekday"]?><?php }?>
<?php if($TPL_V1["common"]["app_start_time"]&&$TPL_V1["common"]["app_end_time"]){?>&nbsp;<?php echo $TPL_V1["common"]["app_start_time"]?>시 ~ <?php echo $TPL_V1["common"]["app_end_time"]?>시<?php }?>
				</td>
				<td>
<?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_K2=>$TPL_V2){?>
<?php if($TPL_K2!='common'){?>
					<div class="sec-cells">
						<div class="sec-cell">
<?php if($TPL_V2["target_sale"]== 0){?>
							판매가 <?php echo get_currency_price($TPL_V2["event_sale"], 1)?>% 추가할인
<?php }elseif($TPL_V2["target_sale"]== 1){?>
							정가 <?php echo get_currency_price($TPL_V2["event_sale"], 1)?>% 추가할인
<?php }elseif($TPL_V2["target_sale"]== 2){?>
							<?php echo get_currency_price($TPL_V2["event_sale"], 2)?> × 수량 추가할인
<?php }?>
<?php if($TPL_V2["event_reserve"]!='0.00'){?>
							<div style="padding:5px 0 0 0;;">
							마일리지 <?php echo $TPL_V2["event_reserve"]?>% 추가 적립<span class="event-date"> (유효기간 : <?php echo $TPL_VAR["reservetitle"]?>)</span>
							</div>
<?php }?>
						</div>
<?php if($TPL_V2["event_point"]!='0.00'){?>
						<div class="sec-cell" style="margin:18px 0 0 3%;">
							포인트 <?php echo $TPL_V2["event_point"]?>% 추가 적립<span class="event-date"> (유효기간 : <?php echo $TPL_VAR["pointtitle"]?>)</span>
						</div>
<?php }?>
					</div>
<?php }?>
<?php }}?>
				</td>
			</tr>
<?php }}else{?>
			<tr class="row-event">
				<th>할인 이벤트</th>
				<td colspan="3" class="center">혜택 없음</td>
			</tr>
<?php }?>
<?php if(serviceLimit('H_NFR')){?>
			<tr class="row-referer">
				<th>유입경로 할인</th>
				<td colspan="3" class="center">혜택 없음</td>
			</tr>
			<tr class="row-gift">
				<th>사은품 이벤트</th>
				<td colspan="3" class="center">혜택 없음</td>
			</tr>
<?php }?>
		</tbody>
	</table>

	<div class="item-title">모바일 할인</div>
	<table class="table_row_basic">
		<colgroup>
			<col />
			<col width="16%" />
			<col width="30%" />
			<col width="30%" />
		</colgroup>
		<thead>
			<tr>
				<th>조건</th>
				<th>혜택</th>
				<th>마일리지 적립</th>
				<th>포인트 적립혜택</th>
			</tr>
		</thead>
		<tbody id='multiDiscountView'>
<?php if($TPL_systemmobiles_1){foreach($TPL_VAR["systemmobiles"] as $TPL_V1){?>
			<tr>
<?php if($TPL_V1["price2"]&&$TPL_V1["price2"]!='0 '.$TPL_VAR["config_system"]["basic_currency"]){?>
				<td><?php echo get_currency_price($TPL_V1["price1"], 2)?> ~ <?php echo get_currency_price($TPL_V1["price2"], 2)?> 구매</td>
<?php }else{?>
				<td><?php echo get_currency_price($TPL_V1["price1"], 2)?> 이상 구매</td>
<?php }?>
				<td>
<?php if($TPL_V1["sale_price"]){?>
					<?php echo $TPL_V1["sale_price"]?>% 추가 할인
<?php }else{?>
					추가 할인 없음
<?php }?>
				</td>
				<td>
<?php if($TPL_V1["sale_emoney"]){?>
					마일리지 <?php echo $TPL_V1["sale_emoney"]?>% 추가적립  (유효기간 : <?php echo $TPL_VAR["reservetitle"]?>)
<?php }else{?>
					마일리지 추가 적립 없음
<?php }?>
				</td>
				<td>
<?php if($TPL_V1["sale_point"]){?>
					포인트 <?php echo $TPL_V1["sale_point"]?>% 추가적립 (유효기간 : <?php echo $TPL_VAR["pointtitle"]?>)
<?php }else{?>
					포인트 추가 적립 없음
<?php }?>
				</td>
			</tr>
<?php }}else{?>
			<tr>
				<th>모바일 할인</th>
				<td colspan="3" class="center">혜택 없음</td>
			</tr>
<?php }?>
		</tbody>
	</table>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('eventDetailViewLay')">닫기</button>
	</div>

</div>

<!-- 회원 등급별 할인 이벤트 상세보기-->
<div id="viewMemberGradeEvent" class="hide">

	<div class="content">
		<div class="item-title">혜택 세트 정보</div>
		<table class="table_basic">
		<colgroup>
			<col width="25%">
			<col width="75%">
		</colgroup>
		<tr>
			<th class="left">혜택 세트명(번호)</th>
			<td><?php echo $TPL_VAR["promotion_grade"]["sale_title"]?></td>
		</tr>
		</table>

		<div class="item-title mt10">추가 할인</div>
		<table class="table_basic">
		<colgroup>
			<col width="20%">
			<col width="20%">
			<col width="30%">
			<col width="30%">
		</colgroup>
		<thead>
		<tr>
			<th></th>
			<th>조건</th>
			<th>할인</th>
			<th>추가 구성 옵션 할인</th>
		</tr>
		</thead>
		<tbody>
<?php if($TPL_VAR["promotion_grade"]["discount"]){?>
<?php if(is_array($TPL_R1=$TPL_VAR["promotion_grade"]["discount"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<tr>
			<td><?php echo $TPL_V1["group_name"]?></td>
			<td><?php echo $TPL_V1["sale_use"]?></td>
			<td><?php if($TPL_V1["sale_price"]> 0){?><?php echo $TPL_V1["sale_price"]?><?php echo $TPL_V1["sale_price_type"]?><?php }else{?>할인 없음<?php }?></td>
			<td><?php if($TPL_V1["sale_option_price"]> 0){?><?php echo $TPL_V1["sale_option_price"]?><?php echo $TPL_V1["sale_option_price_type"]?><?php }else{?>추가 할인 없음<?php }?></td>
		</tr>
<?php }}?>
<?php }else{?>
		<tr>
			<td colspan="4" height="30" class="center">추가 할인 이벤트가 없습니다.</td>
		</tr>
<?php }?>
		</tbody>
		</table>

		<div class="item-title mt10">추가 적립</div>
		<table class="table_basic">
		<colgroup>
			<col width="20%">
			<col width="20%">
			<col width="30%">
			<col width="30%">
		</colgroup>
		<thead>
		<tr>
			<th></th>
			<th>조건</th>
			<th>마일리지 적립</th>
			<th>포인트 적립</th>
		</tr>
		</thead>
		<tbody>
<?php if($TPL_VAR["promotion_grade"]["save"]){?>
<?php if(is_array($TPL_R1=$TPL_VAR["promotion_grade"]["save"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<tr>
			<td><?php echo $TPL_V1["group_name"]?></td>
			<td><?php echo $TPL_V1["point_use"]?></td>
			<td><?php if($TPL_V1["reserve_price"]> 0){?><?php echo $TPL_V1["reserve_price"]?><?php echo $TPL_V1["reserve_price_type"]?> <span style="font-size:11px; color:#777777;">(유효기간 : <?php echo $TPL_VAR["reservetitle"]?>)</span><?php }else{?>추가 적립 없음<?php }?></td>
			<td><?php if($TPL_V1["point_price"]> 0){?><?php echo $TPL_V1["point_price"]?><?php echo $TPL_V1["point_price_type"]?> <span style="font-size:11px; color:#777777;">(유효기간 : <?php echo $TPL_VAR["pointtitle"]?>)</span><?php }else{?>추가 적립 없음<?php }?></td>
		</tr>
<?php }}?>
<?php }else{?>
		<tr>
			<td colspan="4" height="30" class="center">추가 적립 이벤트가 없습니다.</td>
		</tr>
<?php }?>
		</tbody>
		</table>

	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('viewMemberGradeEvent')">닫기</button>
	</div>
</div>


<!-- 티켓 상품 : 엑셀 등록 -->
<div id="coupon_serial_upload_lay" class="hide">
	<div class="content">
		<form name="coupon_serial_upload_form" id="coupon_serial_upload_form" method="post" action="../goods_process/coupon_serial_upload" enctype="multipart/form-data"  target="actionFrame">
		<table class="table_basic">
		<tr>
				<th>엑셀 업로드</th>
				<td>
					<div class="displayTabMakeImages">
						<input type="file" name="coupon_serial_file" id="coupon_serial_file" size="20" mode="new" class="hide" iclass="resp_text pointer" />
					</div>
				</td>
		</table>
		</form>

		<div class="box_style_05 mt5">
			<div class="title">안내</div>
			<ul class="bullet_circle">
				<li>Excel 97 - 2003 통합문서로 저장하셔야 합니다.</li>
				<li>xls 파일만 등록가능합니다.</li>
				<li>A열에 티켓번호를 등록합니다.</li>
			</ul>
		</div>
	</div>
	<div class="footer">
		<button type="button" onClick="upload_coupon_serial()" class="resp_btn active size_XL">등록</button>
		<button class="resp_btn v3 size_XL" onClick="closeDialog('coupon_serial_upload_lay')">취소</button>
	</div>
</div>

<!-- 아이콘 추가 -->
<table id="iconTr" class="hide">
<tr>
	<td class="center">
		<input type="hidden" name="iconSeq[]" value="" />
		<span>
		<input type="text" name="iconStartDate[]" value="" class="line"  maxlength="10" size="8" /> ~
		<input type="text" name="iconEndDate[]" value="" class="line"  maxlength="10" size="8" />
		</span>
	</td>
	<td class="center">
		<input type="hidden" name="goodsIcon[]" value="1" />
<?php if(is_array($TPL_R1=code_load('goodsIcon'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
		<img src="/data/icon/goods/<?php echo $TPL_V1["codecd"]?>.gif" border="0" class="goodsIcon hand" align="absmiddle">
<?php }?>
<?php }}?>
		<btton type="button" class="goodsIcon resp_btn v2">선택</button>
	</td>
	<td class="center"><button type="button" class="iconDel btn_minus"></button></td>
</tr>
</table>

<!-- 티켓 상품 : 엑셀 등록 -->
<div id="bigdata_test" class="hide">
	<style>
		#bigdata_test .goods_list .table_basic td:first-child { border-left:0px !important;}
		#bigdata_test .goods_list_header .table_basic,#bigdata_test .goods_list_header .table_basic tr, #bigdata_test .goods_list_header .table_basic th {border-top:0px;}
	</style>
	<div class="content mt10">
		<div class="goods_list_header" style="border:1px solid #ccc !important;">
		<table class="table_basic">
			<colgroup>
<?php if(serviceLimit('H_AD')){?>
				<col width="30%" />
				<col width="50%" />
<?php }else{?>
				<col width="80%" />
<?php }?>
				<col width="20%" />
			</colgroup>
			<thead>
				<tr>
<?php if(serviceLimit('H_AD')){?>
					<th>입점사명</th>
<?php }?>
					<th>상품명</th>
					<th>판매가</th>
				</tr>
			</thead>
		</table>
		</div>
		<div class="goods_list long" style="border:1px solid #ccc;max-height:300px;border-right:0px;">
			<table class="table_basic" style="border-top:0px;border-left:0px;border-bottom:0px;">
				<colgroup>
<?php if(serviceLimit('H_AD')){?>
					<col width="30%" />
					<col width="50%" />
<?php }else{?>
					<col width="80%" />
<?php }?>
					<col width="20%" />
				</colgroup>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
	<div class="footer">
		<button class="resp_btn v3 size_XL" onClick="closeDialog('bigdata_test')">닫기</button>
	</div>
</div>

<!-- 입점 마케팅: 필수 항목 자세히보기 -->
<div id="regist_marketing_required" class="hide">
	<div class="content">
		<ul class="resp_message" style="margin-top:0px;">
			<li>입점 마케팅 상품 데이터 전달을 위한 필수 입력 항목입니다. 필수 항목 미 설정 시, 상품이 전달되지 않으니 주의하세요.</li>
		</ul>

		<table class="table_basic v7 mt5">
		<colgroup>
			<col width="25%" />
		</colgroup>
		<thead>
		<tr>
			<th>구분</th><th>네이버</th><th>다음</th><th>페이스북</th><th>구글</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th>상품명</th>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
		</tr>
		<tr>
			<th>대표 카테고리</th>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center">선택</td>
			<td class="center">선택</td>
		</tr>
		<tr>
			<th>검색어</th>
			<td class="center">선택</td>
			<td class="center">선택</td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
		</tr>
		<tr>
			<th>간략설명</th>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
		</tr>
		<tr>
			<th>재고</th>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
		</tr>
		<tr>
			<th>판매방식 구분</th>
			<td class="center"><span style="color:orange; font-weight:bold;">해당상품필수</span></td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
		</tr>
		<tr>
			<th>상품 상태</th>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
		</tr>
		<tr>
			<th>별도 설치비 유무</th>
			<td class="center"><span style="color:orange; font-weight:bold;">해당상품필수</span></td>
			<td class="center">선택</td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
		</tr>
		<tr>
			<th>병행수입 및 주문 제작</th>
			<td class="center"><span style="color:orange; font-weight:bold;">해당상품필수</span></td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
		</tr>
		<tr>
			<th>이벤트</th>
			<td class="center">선택</td>
			<td class="center">선택</td>
			<td class="center">해당 없음</td>
			<td class="center">해당 없음</td>
		</tr>
		<tr>
			<th>노출 배송비</th>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
			<td class="center">선택</td>
			<td class="center"><span style="color:orange; font-weight:bold;">필수</span></td>
		</tr>
	</tbody>
	</table>
	</div>
	<div class="footer">
		<button class="resp_btn v3 size_XL" onClick="closeDialog('regist_marketing_required')">닫기</button>
	</div>
</div>



<!-------------------- ↓↓↓↓↓ 미확인 팝업 레이어 -------------------->

<!-- 이미지 업로드 다이얼로그 -->
<div id="imageUploadDialog" class="hide">
	<table width="100%" class="info-table-style">
	<col width="100" />
	<tr>
		<th>업로드경로</th>
		<td>/<span class="uploadPath"></span></td>
	</tr>
	<tr>
		<th>파일찾기</th>
		<td>
			<div class="pdr10">
				<img class="imageUploadBtnImage hide" src="/admin/skin/default/images/common/btn_filesearch.gif">
				<input id="imageUploadButton" type="file" name="file" value="" class="uploadify" />
			</div>
		</td>
	</tr>
	</table>
	<div class="center pdt20 pdb20"><span class="btn medium"><input type="button" value="업로드" onclick="$('#imageUploadButton').uploadifyUpload();" /></span></div>
</div>

<!-- 상품상태별 이미지 선택 -->
<div id="popGoodsStatusImageChoice" class="hide">
	<form enctype="multipart/form-data" method="post" action="../goods_process/goods_status_image_upload" target="actionFrame">
		<input type="hidden" name="goodsStatusImageCode" value="" />
		<table align="center" height="160">
		<tr>
			<td><div class="nowGoodsStatusImage pd10"></div></td>
			<td><input type="file" name="goodsStatusImage" /> <span class="btn small black"><button type="submit">확인</button></span></td>
		</tr>
		</table>
	</form>
</div>

<!-- 여러개의 상품 컷 노출 안내 -->
<div id="displayVideoGuide" style="display:none;">
	<br style="line-height:10px;">
	<table width="100%">
	<cols width="50%"><cols width="50%">
	<tr><td align="Center"><img src="/admin/skin/default/images/common/video_img_pc.gif"></td><td align="Center"><img src="/admin/skin/default/images/common/video_img_mobile.gif"></td></tr>
	</table>
	<br style="line-height:25px;">
</div>

<!--### 추가혜택 -->
<div id="popup_benefits" class="hide"></div>

<!--### 상품상태별 이미지세팅 -->
<div id="popGoodsStatusImage" class="hide"></div>

<!--### 동영상 URL 복사 -->
<div id="realvideourl_dialog" class="hide">
	<table width="100%" >
		<tr>
			<td><textarea style='width:300px;' rows='5' id="realvideourl" readOnly><?php echo $TPL_VAR["realvideourl"]?></textarea></td>
			<td><span class="btn small lightblue"><button type="button" id="videourlCopybtn" onclick="clip_copy()">URL 복사</button></span></td>
		</tr>
	</table>
</div>

<div id="option_infomation" class="hide"><img src="/admin/skin/default/images/design/opt_func_img.jpg" /></div>
<div id="special_newlist" class="hide"><img src="/admin/skin/default/images/design/img_speinfo.jpg" /></div>

<div id="coupon_serial_list_lay" class="hide">
	<div class="content">
	<table class="table_basic">
		<colgroup>
			<col />
			<col width="40%" />
		</colgroup>
		<thead>
			<tr>
				<th>티켓번호</th>
				<th>상 태</th>
			</tr>
		</thead>
		<tbody id="coupon_serial_list">
		</tbody>
	</table>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn size_XL v3" onClick="closeDialog('coupon_serial_list_lay')">확인</button>
	</div>
</div>

<div id="openmarket_lay" class="hide"></div>
<div id="market_option_price_lay" class="hide"></div>
<div id="px_infomation" class="hide"></div>
<div id="chk_linkagemall_lay" class="hide"></div>
<div id="src_ready_send_goods" class="hide"></div>

<!--### 역마진 방지 승인팝업-->
<div id="goods_permit_lay" class="hide"></div>

<!--### 에디터 세팅 팝업 -->
<div id="setting_editor_popup" class="hide"></div>

<div id="bigdata_pc_screen" class="hide"><img src="/admin/skin/default/images/design/bigdata_pc_screen.gif" /></div>
<div id="bigdata_mobile_screen" class="hide"><img src="/admin/skin/default/images/design/bigdata_mobile_screen.gif" /></div>
<div id="ticket_goods_refund_helper" class="hide"><img src="/admin/skin/default/images/design/ticket_goods_refund_helper.gif" ></div>

<!-- 패키지 연결오류 레이어 -->
<div id="packageErrorDialog" class="hide"></div>

<div id="unable_provider_status" class="hide">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="info-table-style">
		<colgroup>
			<col width="20%" />
			<col />
		</colgroup>
		<tbody>
			<tr>
				<th>1. 행위자</th>
				<td>입점사 관리자</td>
			</tr>
			<tr>
				<th>2. 행위</th>
				<td>
					<div>아래 항목 수정</div>
					<div>- 일반상품 : 상품명, 정가, 판매가, 구매 대상자, 위탁배송</div>
					<div>- 패키지/복합상품 : 상품명, 정가, 판매가, 구매 대상자, 위탁배송</div>
					<div>- 티켓 : 상품명, 정가, 판매가, 구매 대상자, 위탁배송, 티켓 취소(환불), 미사용 티켓환불</div>
					<div>- 사은품 : 없음</div>
					<!--div style="margin-left:10px;">유효기간 전 후 취소(환불) 또는 미사용 티켓환불 설정</div-->
				</td>
			</tr>
			<tr>
				<th>3. 자동처리</th>
				<td>행위 발생 시 자동 처리 항목 : 미승인 + 판매중지 + 미노출</td>
			</tr>
		</tbody>
	</table>
</div>

<!-- 수출입상품코드 설정 -->
<div id="hscode_lay" class="hide">
	<table class="info-table-style" style="width:643px;">
		<colgroup>
			<col width="30" />
			<col width="175" />
			<col width="95" />
			<col width="95" />
			<col />
			<col width="105" />
		</colgroup>
		<thead>
			<tr>
				<th rowspan="3"><input type="checkbox" id="nation_all"/></th>
				<th class="its-th-align pd5" rowspan="3">국가</th>
				<td class="center pd5" colspan="3">HS CODE</td>
				<td class="center pd5" rowspan="2">세율</td>
			</tr>
			<tr>
				<td class="center pd5">류</td>
				<td class="center pd5">호</td>
				<td class="center pd5">번호</td>
			</tr>
			<tr>
				<td class="left pd5">
					<input type="text" id="hscode_type_all" value="<?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeTypeCode"]?>" style="width:43px"/>
					<span class="btn small black"><button type="button" class="hscode_all_btn resp_btn v2 arrow" target="hscode_type" target_name="류">▼</button></span>
				</td>
				<td class="left pd5">
					<input type="text" id="hscode_unit_all" value="<?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeUnitCode"]?>" style="width:43px"/>
					<span class="btn small black"><button type="button" class="hscode_all_btn resp_btn v2 arrow" target="hscode_unit" target_name="호">▼</button></span>
				</td>
				<td class="left pd5">
					<input type="text" id="hscode_num_all" class="" style="width:90px"/>
					<span class="btn small black"><button type="button" class="hscode_all_btn resp_btn v2 arrow" target="hscode_num" target_name="번호">▼</button></span>
				</td>
				<td class="left pd5">
					<input type="text" id="hscode_tax_all" class="onlyfloat" style="width:53px"/>
					<span class="btn small black"><button type="button" class="hscode_all_btn resp_btn v2 arrow" target="hscode_tax"  target_name="세율">▼</button></span>
				</td>
			</tr>
		</thead>
	</table>
	<div style="height:580px;overflow:auto">
		<form name="hscode_form">

		<input type="hidden" name="hscode_type" value="<?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeTypeCode"]?>" class="hscode_type"/>
		<input type="hidden" name="hscode_unit" value="<?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeUnitCode"]?>" class="hscode_unit"/>
		<table class="info-table-style" style="width:643px;border-top:0">
			<colgroup>
				<col width="30" />
				<col width="175" />
				<col width="95" />
				<col width="95" />
				<col />
				<col width="105" />
			</colgroup>
			<tbody>
<?php if($TPL_nationsInfo_1){foreach($TPL_VAR["nationsInfo"] as $TPL_K1=>$TPL_V1){?>
				<tr>
					<th>
						<input type="checkbox" name="hscode_key[]" value="<?php echo $TPL_K1?>" class="nations" <?php if($TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?>checked<?php }?>/>
					</th>
					<th class="its-th pd5">
						<img src="/admin/skin/default/images/common/icon/nation/<?php echo $TPL_V1["nationCode"]?>.png" style="vertical-align:middle"/>
						<input type="hidden" name="nation_name[<?php echo $TPL_K1?>]" value="<?php echo $TPL_V1["nationName"]?>" <?php if(!$TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?>disabled<?php }?>/>
						<input type="hidden" name="nation_flag[<?php echo $TPL_K1?>]" value="/admin/skin/default/images/common/icon/nation/<?php echo $TPL_V1["nationCode"]?>.png" <?php if(!$TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?>disabled<?php }?>/>
						<?php echo $TPL_V1["nationName"]?>

					</th>
					<td class="center pd5"><span class="<?php echo $TPL_K1?>_type_text hscode_type_text <?php if(!$TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?>disabled<?php }?>">
<?php if($TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?><?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeType"]?><?php }?>
					</td>
					<td class="center pd5"><span class="<?php echo $TPL_K1?>_unit_text hscode_unit_text <?php if(!$TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?>disabled<?php }?>">
<?php if($TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?><?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeUnit"]?><?php }?>
					</td>
					<td class="left pd5">
						<input type="text" name="hscode_num[<?php echo $TPL_K1?>]" class="hscode_num" style="width:90px" <?php if($TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?> value="<?php echo $TPL_VAR["goodsHscodeInfo"]["hscodeNum"]?>" <?php }else{?> disabled<?php }?>/>
					</td>
					<td class="left pd5">
						<input type="text" name="hscode_tax[<?php echo $TPL_K1?>]" class="hscode_tax onlyfloat" style="width:53px"  <?php if($TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]){?> value="<?php echo $TPL_VAR["goodsHscodeInfo"]["nationList"][$TPL_K1]["customs_tax"]?>" <?php }else{?> disabled<?php }?>/> %
					</td>
				</tr>
<?php }}?>
			</tbody>
		</table>

		</form>
	</div>
	<div class="contents_saveBtn center pdt10">
		<span class="btn large"><button type="button" onclick="hscodeSet()" style="width:100px;">적 용</button></span>
	</div>
</div>

<!-- 메시지 출력용 -->
<div id="helperMessageShow" class="hide"><span id="helperMessage"></div></div>

<!-- 추가입력옵션관리 다이얼로그 -->
<div id="inpoptionSettingPopup" class="hide">
	<div class="content">
		<table  class="table_basic">
			<colgroup>
				<col width="80%" />
				<col width="20%" />
			</colgroup>
			<thead>
				<tr>
					<th>상품명</th>
					<th>삭제</th>
				</tr>
			</thead>
			<tbody>
<?php if($TPL_VAR["frequentlyinplist"]){?>
<?php if($TPL_frequentlyinplist_1){foreach($TPL_VAR["frequentlyinplist"] as $TPL_V1){?>
				<tr>
					<td><span class="delFreqOptionName_<?php echo $TPL_V1["goods_seq"]?>"><?php echo $TPL_V1["goods_name"]?></span></td>
					<td class="center">
						<button type="button" class="delFreqOption resp_btn v3 size_S" value="<?php echo $TPL_V1["goods_seq"]?>" data-type="inp">삭제</button>
					</td>
				</tr>
<?php }}?>
<?php }else{?>
				<tr>
					<td colspan="2" class="center" height="40">데이터 없음</td>
				</tr>
<?php }?>
			</tbody>
		</table>
		<div class="paging_navigation"><?php echo $TPL_VAR["frequentlyinppaginlay"]?></div>
	</div>
	<div class="footer">
		<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('inpoptionSettingPopup')">닫기</button>
	</div>
</div>