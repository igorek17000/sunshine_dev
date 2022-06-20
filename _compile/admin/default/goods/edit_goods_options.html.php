<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/goods/edit_goods_options.html 000046491 */ 
$TPL_frequentlyoptlistAll_1=empty($TPL_VAR["frequentlyoptlistAll"])||!is_array($TPL_VAR["frequentlyoptlistAll"])?0:count($TPL_VAR["frequentlyoptlistAll"]);
$TPL_options_1=empty($TPL_VAR["options"])||!is_array($TPL_VAR["options"])?0:count($TPL_VAR["options"]);
$TPL_frequentlyoptlist_1=empty($TPL_VAR["frequentlyoptlist"])||!is_array($TPL_VAR["frequentlyoptlist"])?0:count($TPL_VAR["frequentlyoptlist"]);?>
<style>
	body { overflow:hidden;  }
	body::-webkit-scrollbar { display:none;}
	.item-title {padding-left:0 !important;}
	#table-grid { padding:0px; border-left:0px solid #ccc !important;border-right:0px solid #ccc !important;overflow:scroll; -webkit-overflow-scrolling:touch; }
	#table-grid table.grid-cell{width:none;}
	#table-grid table.grid-cell th, #table-grid table.grid-cell td {padding:0px; text-align:center; overflow:hidden; white-space: nowrap;}
	#table-grid table.grid-cell td span {text-align:left; }
	#table-grid table.grid-cell tr th:first-child, #table-grid table.grid-cell tr td:first-child {border-left:0px;}
	#table-grid table.grid-cell tr th:last-child, #table-grid table.grid-cell tr td:last-child {border-right:0px;}
	#table-grid input[type='text'] { width:50%; }
	#table-grid input[type='text'].wp30 { width:30%; }
	#table-grid input[type='text'].optioncode,
	#table-grid input[type='text'].optionval { width: 70%; }
	#table-grid input[name='reserve_rate_all'] { max-width: 40px; }
	#table-grid .optionTr input[type='text'] { width:80%;}
	#table-grid .optionTr .half input[type='text'] { width:60%;}
	#table-grid select[name='option_view_all'] {width:70%;}
	#table-grid .btn.small.black { height:30px !important; background-color:#000;line-height:29px !important; }
	#table-grid .save_all { height:29px; line-height:29px;}
	#table-grid .btn.small.black {margin-left:-1px; }
	#table-grid .price span { padding-right:10px;}
	#table-grid .addrhelpicon, #table-grid .datehelpicon { width:40px;}
	#table-grid .dayinputhelpicon, #table-grid .dayautohelpicon { width:70px;}
	

</style>
	<div class="contents_container" style="background-color:#fff;padding:0px;margin:0px;">
		<div class="content wrap" style="padding:20px;">
			<form name="tmp_option_form" method="post" target="optionFrame" action="about:blank;">
			<input type="hidden" name="goods_seq" value="<?php echo $TPL_VAR["goods_seq"]?>" />
			<input type="hidden" name="socialcp_input_type" value="<?php echo $TPL_VAR["sc"]["socialcp_input_type"]?>" />
	
<?php if($TPL_VAR["sc"]["package_yn"]=='y'){?>
			<input type="hidden" name="reg_package_count" value="<?php echo $TPL_VAR["package_count"]?>">
			<input type="hidden" name="tmp_option_seq" value="<?php echo $TPL_VAR["sc"]["tmp_seq"]?>">
			<input type="hidden" name="use_warehouse" value="|<?php echo implode('|',array_keys($TPL_VAR["scm_cfg"]['use_warehouse']))?>|" />
<?php }?>			
			<span class="item-title" style="padding-top:0 !important;">필수 옵션 생성/수정</span>		
			<div id="optionLayer">
				<table class="table_basic v7 optionInfo">
				<colgroup>
					<col width="15%">
					<col width="85%">
				</colgroup>
				<tr>
					<th class="left">
						옵션 타입
						<span class="tooltip_btn" onClick="showTooltip(this, '../tooltip/goods', '#regist_option_type', 'sizeS')"></span>
					</th>
					<td>
						<div class="resp_radio">
							<label><input type="radio" name="optionViewTypeTmp" value="divide" <?php if($TPL_VAR["goods"]["option_view_type"]!='join'&&$TPL_VAR["sc"]["optionViewTypeTmp"]!='join'){?>checked<?php }?>> 옵션 분리형</label>
							<label><input type="radio" name="optionViewTypeTmp" value="join" <?php if($TPL_VAR["goods"]["option_view_type"]=='join'||$TPL_VAR["sc"]["optionViewTypeTmp"]=="join"){?>checked<?php }?>> 옵션 합체형</label>
						</div>
						
						<span class='fr mt5' style="margin-right:-10px;"><a href="javascript:void(0)" class="bx_arrow closeOptInfo OPEN" data-type="CLOSE"></a></span>
					</td>
				</tr>
				<tr>
					<th class="left">신규/기존 옵션</th>
					<td>
						<div class="resp_radio">
							<label><input type="radio" name="optionCreateType" value="new" <?php if($TPL_VAR["sc"]["optionCreateType"]!="old"){?>checked<?php }?>> 신규 생성</label>
							<label><input type="radio" name="optionCreateType" value="old" <?php if($TPL_VAR["sc"]["optionCreateType"]=="old"){?>checked<?php }?>> 기존 옵션</label>
						</div>
					</td>
				</tr>
				<tr class="newOption">
					<th class="left">옵션 생성</th>
					<td>
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'&&$TPL_VAR["scmTotalStock"]> 0){?>
						<button type="button" class="resp_btn v2">신규생성</button>
						<!-<?php }else{?>
						<button type="button" id="optionMake" goods_seq="<?php echo $TPL_VAR["goods_seq"]?>" class="resp_btn active">신규생성</button>
<?php }?>
					</td>
				</tr>
<?php if($TPL_VAR["sc"]["package_yn"]=='y'){?>
				<tr class="newOption">
					<th class="left">상품</th>
					<td>
						<span><button type="button" class="package_goods_make resp_btn active" onclick="package_goods_make();">상품 검색</button></span>
					</td>
				</tr>
<?php }?>
				<tr class="oldOption hide">
					<th class="left">옵션 가져오기</th>
					<td>
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'&&$TPL_VAR["scmTotalStock"]> 0){?>
						<select class="gray">
							<option value="0">선택</option>
						</select>
						<button type="button" class="resp_btn v2">가져오기</button>
						<!-<?php }else{?>
						<span id="frequentlytypeoptlay">
							<select name="frequentlytypeopt" class="frequentlytypeopt" style="width:300px">
								<option value="0">선택</option>
<?php if($TPL_VAR["frequentlyoptlistAll"]){?>
<?php if($TPL_frequentlyoptlistAll_1){foreach($TPL_VAR["frequentlyoptlistAll"] as $TPL_V1){?>
								<option value="<?php echo $TPL_V1["goods_seq"]?>"  ><?php echo strip_tags($TPL_V1["goods_name"])?></option>
<?php }}?>
<?php }?>
							</select>
	
							<button type="button" class="resp_btn v2" id="frequentlytypeoptbtn" goods_seq="<?php echo $TPL_VAR["goods_seq"]?>">가져 오기</button>
							<button type="button" class="resp_btn v3" id="optionSetting">옵션 관리</button></span>
						</span>
<?php }?>
					</td>
				</tr>
				</table>
	
				<div class="item-title">필수 옵션 상세</div>
				<div class="table_row_frame">
					<div class="dvs_top">	
						<div class="dvs_left">	
							<button type="button" onclick="removeOption(this);" class="resp_btn v3">선택 삭제</button>
							<button type="button" class="addOption resp_btn v2">옵션 추가</button>
						</div>
					</div>

					<div id="table-grid">
						<table class="table_row_basic fix optionList grid-cell">
						<colgroup>
							<col width="45"><!-- 선택 -->
							<col width="65"><!-- 기준 -->
<?php if($TPL_VAR["sc"]["package_yn"]!='y'){?>
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
<?php if($TPL_VAR["options"][ 0]["option_divide_title"]){?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><col width="100"><col width="220"><?php }}?><!-- 티켓 옵션/코드 -->
<?php }else{?>
								<col width="100"><col width="220">
<?php }?>
								<col width="80"><!-- 횟수 -->
<?php }else{?>
<?php if($TPL_VAR["options"][ 0]["option_divide_title"]){?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><col width="105"><col width="125"><?php }}?>
<?php }else{?>
									<col width="105"><col width="125">
<?php }?><!-- 일반 코드/옵션명 -->
								<col width="100"><!-- 무게 -->
<?php }?>
<?php }else{?>
<?php if($TPL_VAR["options"][ 0]["option_divide_title"]){?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><col width="120"><?php }}?>
<?php }else{?>
							<col width="150">
<?php }?><!-- 패키지 옵션명 -->
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><col width="220"><?php }}?><!-- 패키지 연결 상품 -->
<?php }?>
<?php if($TPL_VAR["sc"]["package_yn"]!='y'){?>
							<col width="105"><!-- 재고 -->
							<col width="105"><!-- 불량 -->
							<col width="105"><!-- 안전재고 -->
<?php }?>
<?php if($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["sc"]["package_yn"]!='y'){?>
							<col width="120"><!-- 매입가 -->
<?php }elseif($TPL_VAR["sc"]["provider_seq"]!= 1){?>
							<col width="170"><!-- 정산금액 -->
<?php }?>
							<col width="105"><!-- 정가 -->
							<col width="105"><!-- 판매가 -->
							<col width="170"><!-- 마일리지 -->
							<col width="105"><!-- 옵션노출 -->
							<col width="100"><!-- 설명 -->
						</colgroup>
						<thead>
						<tr>
							<th><label class="resp_checkbox"><input type="checkbox" name="chkall" value="y"></label></th>
							<th>기준</th>
							
<?php if($TPL_VAR["sc"]["package_yn"]!='y'){?>
<?php if($TPL_VAR["options"][ 0]["option_divide_title"]){?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><th colspan="2"><?php echo $TPL_V1?></th><?php }}?>
<?php }else{?>
							<th colspan="2">옵션명</th>
<?php }?>
<?php if(!$TPL_VAR["sc"]["socialcp_input_type"]){?><th>무게(Kg)</th><?php }?>
<?php }?>
	
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
							<th class="couponinputtitle"><span class="couponinputsubtitle"><?php if($TPL_VAR["sc"]["socialcp_input_type"]=='price'){?>금액<?php }else{?>횟수<?php }?></span></th>
<?php }?>
<?php if($TPL_VAR["sc"]["package_yn"]=='y'){?>
<?php if($TPL_VAR["options"][ 0]["option_divide_title"]> 0){?>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><th class="reg_option_title_tbl"><?php echo $TPL_V1?></th><?php }}?>
<?php }else{?>
							<th class="reg_option_title_tbl">옵션</th>
<?php }?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
								<th class="reg_package_option_title_tbl">상품<?php echo $TPL_V1?></th>
<?php }}?>
							<script>reg_select_package_count();</script>
<?php }else{?>
							<th>재고</th>
							<th>불량</th>
							<th>안전재고</th>
<?php if($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["sc"]["package_yn"]!='y'){?>
							<th>매입가(평균)</th>
<?php }?>
<?php }?>
							<!--th class="<?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>">정산 금액</th-->
<?php if($TPL_VAR["sc"]["provider_seq"]!= 1){?>
							<th>
<?php if($TPL_VAR["provider_info"]["commission_type"]=='SACO'||$TPL_VAR["provider_info"]["commission_type"]==''){?>
								수수료(%)
<?php }else{?>
								<span class="SUCO_title">
									공급가(<?php if($TPL_VAR["provider_info"]["commission_type"]=='SUPR'){?><?php echo $TPL_VAR["basic_currency"]?><?php }else{?>%<?php }?>)
								</span>
<?php }?>
							</th>
<?php }?>
							<th>정가</th>
							<th>판매가  <span class="required_chk"></span></th>
							<th>
								마일리지 지급
<?php if(count($TPL_VAR["options"][ 0]["option_divide_title"])> 0){?>
									<select name="reserve_policy" onchange="chgReservePolicy(this);">
									<option value="shop">통합</option>
									<option value="goods" <?php if($TPL_VAR["goods"]["reserve_policy"]=='goods'){?>selected<?php }?>>개별 </option>
									</select>
<?php }?>
							</th>
							<th class="optionStockSetText"></th>
							<th>설명</th>
						</tr>
						</thead>
						<tbody>
						<!-- ######## 일괄 적용 폼 ########  -->
<?php if(count($TPL_VAR["options"][ 0]["option_divide_title"])> 0){?>
						<tr class="tr_save_all">
<?php if($TPL_VAR["package_yn"]!='y'){?>
							<td colspan="<?php echo (count($TPL_VAR["options"][ 0]["option_divide_title"])* 2)+ 2?>" >
<?php }else{?>
							<td colspan="<?php echo (count($TPL_VAR["options"][ 0]["option_divide_title"]))+ 2?>" >
<?php }?>
								<b>일괄적용 →</b>
							</td>
<?php if($TPL_VAR["package_yn"]!='y'&&!$TPL_VAR["sc"]["socialcp_input_type"]){?>
							<td>
								<input type="text" name="weight_all" class="onlynumber" value="" /> 
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="weight_all">▼</button></span>
							</td>
<?php }?>
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
							<td>
								<input type="text" name="coupon_input_all" value="" /> 
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="coupon_input_all">▼</button></span>
							</td>
<?php }?>
<?php if($TPL_VAR["sc"]["package_yn"]!='y'){?>
							<td>
<?php if($TPL_VAR["sc"]["provider_seq"]!= 1||$TPL_VAR["scm_cfg"]['use']!='Y'){?>
								<input type="text" name="stock_all" value="" / >
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="stock_all">▼</button></span>
<?php }?>
							</td>
							<td>
<?php if($TPL_VAR["sc"]["provider_seq"]!= 1||$TPL_VAR["scm_cfg"]['use']!='Y'){?>
								<input type="text" name="badstock_all" value="" />
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="badstock_all">▼</button></span>
<?php }?>
							</td>
							<td>
								<input type="text" name="safe_stock_all" value="" />
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow " id="safe_stock_all">▼</button></span>
							</td>
<?php }else{?>
<?php if(is_array($TPL_R1=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
							<td class="reg_package_option_input_tbl"></td>
<?php }}?>
<?php }?>
<?php if($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["sc"]["package_yn"]!='y'){?>
							<td>
<?php if($TPL_VAR["scm_cfg"]['use']!='Y'){?>
								<input type="text" name="supply_price_all" value="" />
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="supply_price_all">▼</button></span>
<?php }?>
							</td>
<?php }?>
							<td class="<?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>">
								<input type="text" class="onlyfloat right" name="commission_rate_all" value="<?php echo $TPL_VAR["provider_info"]["charge"]?>" style="width:40px !important;"/>
<?php if($TPL_VAR["provider_info"]["commission_type"]=='SACO'||$TPL_VAR["provider_info"]["commission_type"]==''){?>
								%
								<input type="hidden" name="commission_type_all" class="commission_type"><span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="commission_rate_all" commission_type = "<?php if($TPL_VAR["provider_info"]["commission_type"]=='SACO'||$TPL_VAR["provider_info"]["commission_type"]==''){?>SACO<?php }else{?><?php echo $TPL_VAR["provider_info"]["commission_type"]?><?php }?>">▼</button></span>
<?php }else{?>
								<select name="commission_type_all" class="commission_type_sel">
									<option value="SUCO" <?php if($TPL_VAR["provider_info"]["commission_type"]!='SUPR'){?>selected<?php }?>>%</option>
									<option value="SUPR" <?php if($TPL_VAR["provider_info"]["commission_type"]=='SUPR'){?>selected<?php }?>>원</option>
								</select><span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="commission_rate_all" commission_type = "<?php if($TPL_VAR["provider_info"]["commission_type"]=='SACO'||$TPL_VAR["provider_info"]["commission_type"]==''){?>SACO<?php }else{?><?php echo $TPL_VAR["provider_info"]["commission_type"]?><?php }?>">▼</button></span>
<?php }?>
								
							</td>
							<td>
								<input type="text" name="consumer_price_all" value="" class="onlyfloat right" /> 
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="consumer_price_all">▼</button></span>
							</td>
							<td>
								<input type="text" name="price_all" value="" class="onlyfloat right" />
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="price_all">▼</button></span>
							</td>
							<td>
								<input type="text" name="reserve_rate_all" value="" <?php if($TPL_VAR["goods"]["reserve_policy"]=='shop'){?>disabled<?php }?> class="right onlyfloat wp30"  maxlength=5 />
								<select name="reserve_unit_all" style="width:60px;margin-left:-1px" <?php if($TPL_VAR["goods"]["reserve_policy"]=='shop'){?>disabled<?php }?>>
									<option value="percent">%</option>
									<option value="<?php echo $TPL_VAR["config_system"]['basic_currency']?>"><?php echo $TPL_VAR["basic_currency_info"]['currency_symbol']?></option>
								</select> 
								<span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="reserve_rate_all">▼</button></span>
							</td>
							<td>
								<select name="option_view_all" >
									<option value="Y">노출</option>
									<option value="N">미노출</option>
								</select> <span class="btn small gray"><button type="button" class="save_all resp_btn v2 arrow" id="option_view_all">▼</button></span>
							</td>
							<td>
								<button type="button" onclick="applyAllOptInfomation();" class="resp_btn v2">입력</button>
							</td>
						</tr>
<?php }?>
<?php if(count($TPL_VAR["options"][ 0]["option_divide_title"])){?>
<?php if($TPL_options_1){foreach($TPL_VAR["options"] as $TPL_K1=>$TPL_V1){?>
						<tr class="optionTr">
							<td class="center">
								<input type="hidden" name="option_seq[]" value="<?php echo $TPL_V1["option_seq"]?>" />
<?php if($TPL_VAR["scm_cfg"]['use']!='Y'||!$TPL_V1["total_stock"]){?>
								<label class="resp_checkbox"><input type="checkbox" name="optDel[]" class="chk" value="<?php echo $TPL_V1["option_seq"]?>" <?php if($TPL_V1["default_option"]=='y'){?>disabled<?php }?> ></label>	
								<!--<span class="btn-minus"><button type="button" class="removeOption" onclick="removeOption(this);"></button></span>-->
<?php }?>
							</td>
							<td class="center">
								<label class="resp_radio"><input type="radio" name="default_option" value="y" onclick="save_input_value(this);" <?php if($TPL_V1["default_option"]=='y'){?>checked<?php }?> /></label>
							</td>
<?php if(is_array($TPL_R2=$TPL_V1["opts"])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_K2=>$TPL_V2){$TPL_I2++;?>
<?php if($TPL_VAR["sc"]["package_yn"]!='y'){?>
							<td class="center">
								<input type="text"  name="optioncode<?php echo $TPL_I2+ 1?>" class="optioncode" value="<?php if($TPL_V1["optcodes"][$TPL_I2]!=''){?><?php echo $TPL_V1["optcodes"][$TPL_I2]?><?php }else{?>옵션코드<?php }?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" title="옵션코드" />
							</td>
<?php }?>
							<td class="center <?php if($TPL_V1["divide_newtype"][$TPL_K2]){?>half<?php }?>">
								<input type="text" name="option<?php echo $TPL_I2+ 1?>" class="optionval resp_text" value="<?php echo $TPL_V2?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
								<input type="hidden" name="newtype[<?php echo $TPL_I2?>]" value="<?php echo $TPL_V1["divide_newtype"][$TPL_K2]?>" />
	
<?php if($TPL_V1["divide_newtype"][$TPL_K2]){?>
<?php if($TPL_V1["divide_newtype"][$TPL_K2]=='color'){?>
										<input type="hidden"  name="optcolor[]" value="<?php echo $TPL_V1["color"]?>">
										<div class="colorPickerBtn colorhelpicon helpicon1" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" optno="<?php echo $TPL_K2+ 1?>" style="background-color:<?php echo $TPL_V1["color"]?>" title="[색상]을 클릭하여 변경할 수 있습니다." onclick="chgColorOption(this);"></div>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='address'){?>
										<input type="hidden"  name="optzipcode[]" value="<?php echo $TPL_V1["zipcode"]?>">
										<input type="hidden"  name="optaddress_type[]" value="<?php echo $TPL_V1["address_type"]?>">
										<input type="hidden"  name="optaddress[]" value="<?php echo $TPL_V1["address"]?>">
										<input type="hidden"  name="optaddress_street[]" value="<?php echo $TPL_V1["address_street"]?>">
										<input type="hidden"  name="optaddressdetail[]" value="<?php echo $TPL_V1["addressdetail"]?>">
										<input type="hidden"  name="optbiztel[]" value="<?php echo $TPL_V1["biztel"]?>">
										<input type="hidden"  name="optaddress_commission[]" value="<?php echo $TPL_V1["address_commission"]?>">
										<button type="button" class="addrhelpicon helpicon resp_btn v2" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["zipcode"]){?>[<?php echo $TPL_V1["zipcode"]?>]  <br> (지번) <?php echo $TPL_V1["address"]?> <?php echo $TPL_V1["addressdetail"]?><br>(도로명) <?php echo $TPL_V1["address_street"]?> <?php echo $TPL_V1["addressdetail"]?>  <?php }else{?>지역 정보가 없습니다. <?php }?> <br/> <?php if($TPL_V1["biztel"]){?>업체 연락처:<?php echo $TPL_V1["biztel"]?><?php }?><br/>수수료: <?php echo $TPL_V1["address_commission"]?>%<br/>[지역]을 클릭하여 변경할 수 있습니다." optno="<?php echo $TPL_K2+ 1?>" onclick="chgAddressOption(this);">지역</button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='date'){?>
										<input type="hidden"  name="codedate[]" value="<?php echo $TPL_V1["codedate"]?>">
										<button type="button" class="codedatehelpicon helpicon resp_btn v2" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" optno="<?php echo $TPL_K2+ 1?>" onclick="chgDateOption(this);"title="<?php if($TPL_V1["codedate"]&&$TPL_V1["codedate"]!='0000-00-00'){?><?php echo $TPL_V1["codedate"]?> <?php }else{?>날짜 정보가 없습니다.<?php }?><br/>[날짜]를 클릭하여 변경할 수 있습니다.">날짜</button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='dayinput'){?>
										<input type="hidden"  name="sdayinput[]" value="<?php echo $TPL_V1["sdayinput"]?>">
										<input type="hidden"  name="fdayinput[]" value="<?php echo $TPL_V1["fdayinput"]?>">
										<button type="button" class="dayinputhelpicon helpicon resp_btn v2" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["sdayinput"]&&$TPL_V1["fdayinput"]){?><?php echo $TPL_V1["sdayinput"]?> ~ <?php echo $TPL_V1["fdayinput"]?> <?php }else{?>수동기간 정보가 없습니다.<?php }?> <br/> [생성 및 변경]에서 변경할 수 있습니다." optno="<?php echo $TPL_K2+ 1?>" onclick="chgInputDateOption(this);">수동기간</button>
<?php }elseif($TPL_V1["divide_newtype"][$TPL_K2]=='dayauto'){?>
										<input type="hidden"  name="sdayauto[]" value="<?php echo $TPL_V1["sdayauto"]?>">
										<input type="hidden"  name="fdayauto[]" value="<?php echo $TPL_V1["fdayauto"]?>">
										<input type="hidden"  name="dayauto_type[]" value="<?php echo $TPL_V1["dayauto_type"]?>">
										<input type="hidden"  name="dayauto_day[]" value="<?php echo $TPL_V1["dayauto_day"]?>">
										<button type="button" class="dayautohelpicon helpicon resp_btn v2" opttype="<?php echo $TPL_V1["option_divide_type"][$TPL_K2]?>" title="<?php if($TPL_V1["dayauto_type"]){?>'결제확인' <?php echo $TPL_V1["dayauto_type_title"]?> <?php echo $TPL_V1["sdayauto"]?>일 <?php if($TPL_V1["dayauto_type"]=='day'){?>이후<?php }elseif($TPL_V1["dayauto_type"]=='month'){?>부터<?php }?> + <?php echo $TPL_V1["fdayauto"]?>일<?php echo $TPL_V1["dayauto_day_title"]?> <?php }else{?>자동기간 정보가 없습니다.<?php }?> <br/>[생성 및 변경]에서 변경할 수 있습니다." optno="<?php echo $TPL_K2+ 1?>" onclick="chgAutoDateOption(this);">자동기간</button>
<?php }?>
<?php }?>
	
<?php if($TPL_VAR["sc"]["package_yn"]=='y'){?>
								<input type="hidden" name="optioncode<?php echo $TPL_I2+ 1?>" value="<?php echo $TPL_V1["optcodes"][$TPL_I2]?>" />
<?php }?>
							</td>
<?php }}?>
<?php if($TPL_VAR["sc"]["package_yn"]!='y'&&!$TPL_VAR["sc"]["socialcp_input_type"]){?>
							<td class="center ">
								<input type="text" class="right" name="weight" value="<?php echo $TPL_V1["weight"]?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);">
							</td>
<?php }?>
<?php if($TPL_VAR["sc"]["socialcp_input_type"]){?>
							<td class="center">
								<input type="text" class="right" name="coupon_input" value="<?php echo $TPL_V1["coupon_input"]?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
<?php }?>
	
<?php if($TPL_VAR["sc"]["package_yn"]=='y'){?>
<?php if(is_array($TPL_R2=range( 1,$TPL_VAR["package_count"]))&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
									<td class="reg_package_option_tbl">
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
										<div class="reg_package_unit_ea<?php echo $TPL_V2?> reg_package_unit">
											주문당
											<input type="text" name="package_unit_ea<?php echo $TPL_V2?>[]" value="<?php echo $TPL_V1["package_unit_ea"][$TPL_V2]?>" class="right" style="width:20px !important;">
											발송
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
<?php }}?>
<?php }else{?>					
<?php if($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["scm_cfg"]['use']=='Y'&&$TPL_VAR["sc"]["goods_seq"]> 0&&$TPL_V1["org_option_seq"]> 0){?>
							<td class="scm-td-stock hand price" onclick="scm_warehouse_on('<?php echo $TPL_VAR["goods"]["goods_seq"]?>', this);">
								<span class="option-stock" optType="option" optSeq="<?php echo $TPL_V1["org_option_seq"]?>"><?php echo number_format($TPL_V1["stock"])?></span>
								<input type="hidden" name="stock" value="<?php echo $TPL_V1["stock"]?>" />
							</td>
<?php }elseif($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["scm_cfg"]['use']=='Y'){?>
							<td class="scm-td-stock price">
								<span><?php echo number_format($TPL_V1["stock"])?></span>
								<input type="hidden" name="stock" value="<?php echo $TPL_V1["stock"]?>" />
							</td>
<?php }else{?>
							<td class="center">
								<input type="text" class="right" name="stock" value="<?php echo $TPL_V1["stock"]?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
<?php }?>
<?php if($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["scm_cfg"]['use']=='Y'){?>
							<td class="scm-td-badstock price">
								<span><?php echo number_format($TPL_V1["badstock"])?></span>
								<input type="hidden" name="badstock" value="<?php echo $TPL_V1["badstock"]?>" />
							</td>
<?php }else{?>
							<td class="center">
								<input type="text" class="right" name="badstock" value="<?php echo $TPL_V1["badstock"]?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
<?php }?>
							<td class="center">
								<input type="text" class="right" name="safe_stock" value="<?php echo $TPL_V1["safe_stock"]?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
<?php if($TPL_VAR["sc"]["provider_seq"]== 1&&$TPL_VAR["sc"]["package_yn"]!='y'){?>
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'){?>
							<td class="scm-td-supplyprice price">
								<span><?php echo get_currency_price($TPL_V1["supply_price"], 1)?></span>
								<input type="hidden" name="supply_price" value="<?php echo $TPL_V1["supply_price"]?>" />
							</td>
<?php }else{?>
							<td class="center scm-td-supplyprice">
								<input type="text" class="right" name="supply_price" value="<?php echo get_currency_price($TPL_V1["supply_price"])?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
<?php }?>
<?php }?>
<?php }?>
							<td class="half center <?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>hide<?php }?>">
								<input type="text" class="onlyfloat right wp30" name="commission_rate" value="<?php echo $TPL_V1["commission_rate"]?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
								<input type="hidden" class="onlyfloat" name="org_commission_rate" value="<?php echo $TPL_V1["commission_rate"]?>"/>
								<input type="hidden" class="onlyfloat" name="org_commission_type" value="<?php echo $TPL_V1["commission_type"]?>"/>
	
<?php if($TPL_VAR["provider_info"]["commission_type"]=='SACO'||$TPL_VAR["provider_info"]["commission_type"]==''){?>
								<input type="hidden" name="commission_type" class="commission_type" value="SACO" />
								%
<?php }else{?>
								<select name="commission_type" onfocus="ready_input_save(this);" onchange="save_input_value(this);">
									<option value="SUCO" <?php if($TPL_V1["commission_type"]!='SUPR'){?>selected<?php }?>>%</option>
									<option value="SUPR" <?php if($TPL_V1["commission_type"]=='SUPR'){?>selected<?php }?>><?php echo $TPL_VAR["basic_currency_info"]['currency_symbol']?></option>
								</select>
<?php }?>
	
							</td>
							<td class="center pricetd">
								<input type="text" class="right" name="consumer_price" value="<?php echo get_currency_price($TPL_V1["consumer_price"], 1)?>" style="color:#000;" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
							<td class="center pricetd">
								<input type="text" class="right" name="price" value="<?php echo get_currency_price($TPL_V1["price"], 1)?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
							</td>
							<td class="center">
								<div class="reserve-shop-lay right <?php if($TPL_VAR["goods"]["reserve_policy"]=='goods'){?>hide<?php }?>" style="padding-right:10px;">
									<?php echo $TPL_VAR["reserves"]["default_reserve_percent"]?>%
									(<span class="reserve-shop"><?php echo get_currency_price($TPL_V1["shop_reserve"], 2)?></span>)
								</div>
								<div class="reserve-goods-lay <?php if($TPL_VAR["goods"]["reserve_policy"]=='shop'){?>hide<?php }?>">
									<input type="text" name="reserve_rate" style="max-width: 40px;" class="right onlyfloat" maxlength=5 value="<?php echo get_currency_price($TPL_V1["reserve_rate"])?>" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);" />
									<select name="reserve_unit" class="resp_select" style="max-width: 60px; padding:4px 3px !important;"  onfocus="ready_input_save(this);" onchange="save_input_value(this);">
										<option value="percent">%</option>
										<option value="<?php echo $TPL_VAR["config_system"]['basic_currency']?>" <?php if($TPL_V1["reserve_unit"]==$TPL_VAR["config_system"]['basic_currency']){?>selected<?php }?>><?php echo $TPL_VAR["basic_currency_info"]['currency_symbol']?></option>
									</select>
									(<span class="reserve"><?php echo get_currency_price($TPL_V1["reserve"], 2)?></span>)
								</div>
							</td>
							<td class="center">
								<span class="option_view_only <?php if($TPL_V1["default_option"]!='y'){?>hide<?php }?>">노출</span>
								<select name="option_view" class="option_view <?php if($TPL_V1["default_option"]=='y'){?>hide<?php }?>" onfocus="ready_input_save(this);" onchange="save_input_value(this);">
									<option value="Y" <?php if($TPL_V1["option_view"]!='N'||$TPL_V1["default_option"]=='y'){?>selected<?php }?>>노출</option>
									<option value="N" <?php if($TPL_V1["option_view"]=='N'){?>selected<?php }?>>미노출</option>
								</select>
							</td>
							<td class="center">
								<input type="hidden" name="infomation" value="<?php echo $TPL_V1["infomation"]?>" id="infomation_<?php echo $TPL_K1?>">
								<a href="javascript:applyOptInfomation('<?php echo $TPL_K1?>')" id="viewInfomation_<?php echo $TPL_V1["key"]?>" idx="<?php echo $TPL_K1?>"><span class="viewInfomationTextAll" id="viewInfomationText_<?php echo $TPL_K1?>"><?php if($TPL_V1["infomation"]){?><span class="underline">보기</span><?php }else{?>미입력<?php }?></span></a>
								<!--textarea name="infomation" rows="3" width="width:90%;" onkeyup="key_input_value(event, this);" onfocus="ready_input_save(this);" onblur="save_input_value(this);"><?php echo $TPL_V1["infomation"]?></textarea-->
							</td>
						</tr>
<?php }}?>
<?php }else{?>
						<tr>
							<td colspan="<?php if($TPL_VAR["sc"]["package_yn"]=='y'){?><?php if($TPL_VAR["sc"]["provider_seq"]== 1){?>11<?php }else{?>10<?php }?><?php }else{?>14<?php }?>" class="center" height=50>등록된 옵션이 없습니다.</td>
						</tr>
<?php }?>
						</tbody>
						</table>
					</div>
					<div class="dvs_bottom">	
						<div class="dvs_left">	
							<button type="button" onclick="removeOption(this);" class="resp_btn v3">선택 삭제</button>
							<button type="button" class="addOption resp_btn v2">옵션 추가</button>
						</div>	
						<div class="dvs_right">	
<?php if($TPL_VAR["sc"]["package_yn"]!='y'){?>
							<div id="frequentlay">
								<input type="text" id="goodsCodeOpt" class="resp_text"  value="">
<?php if($TPL_VAR["goodscodesettingview"]&&($TPL_VAR["sc"]["no"]||$TPL_VAR["goods_seq"])){?>
								<button type="button" id="goodsCodeBtn" class="resp_btn v2" title="자동생성" >기본코드자동생성</button>
<?php }?>
							</div>
<?php }?>
						</div>
					</div>
				</div>
	
				<div class="mt10 hide">
					<div id="option_international_shipping_layer">
						<label class="resp_checkbox"><input type="checkbox" name="option_international_shipping_status_view" onchange="if(check_able_option(this))check_option_international_shipping();" value="y" <?php if($TPL_VAR["goods"]["option_international_shipping_status"]=='y'){?> checked="checked" <?php }?> > 이 상품은 해외에서 수입되는 해외 배송 상품입니다. → 주문 시 구매자로부터 관세청 통관 신고를 위한 개인통관고유부호를 수집합니다.</label>
	
						<br/>
						&nbsp;&nbsp;&nbsp;※ 해외배송상품은 배송,반품,교환이 일반상품과 다르므로 배송비는 개별배송비 정책 사용을 권장 드립니다.
						<br />
						&nbsp;&nbsp;&nbsp;<button type="button"  onclick="dialog_international_shipping();" class="resp_btn v2 mt5">해외 배송 안내</button>
					</div>
				</div>
				
				<div id="frequentlay" class="mt10">
					<label class="resp_checkbox"><input type="checkbox" name="frequently" value="1" <?php if($TPL_VAR["goods"]["frequentlyopt"]== 1||$TPL_VAR["sc"]["frequentlyopt"]== 1){?> checked="checked" <?php }?> onchange="check_able_option(this)"> 옵션 정보 저장</label>
				</div>
	
	
			</div>
	
			</form>
			<div style="height:40px;"></div>
		</div>
	
		<div class="footer">
				<button type="button" id="setTmpSeq" class="resp_btn active size_XL">확인</button>
				<button type="button" class="resp_btn v3 size_XL" onclick="window.close()">취소</button>
		</div>
	</div>
	
	
	<!-- 직접입력 > 색상, 지역, 날짜  -->
	<div id="gdoptdirectmodifylay" class="hide">
		<div class="content">
	
			<!-- 직접입력 > 날짜 -->
			<div class="dayinputlay goodsoptiondirectlay hide">
				<span class="help">수동기간은 [생성 및 변경]에서 변경할 수 있습니다.</span>
			</div>
	
			<!-- 직접입력 > 날짜 -->
			<div class="dayautolay goodsoptiondirectlay hide">
			<span class="help">자동기간은 [생성 및 변경]에서 변경할 수 있습니다.</span>
			</div>
	
			<div class="goodsoptiondirectlay colordateaddresslay">
				<form name="specialOption" id="specialOption" method="post" action="../goods_process/save_special_option" target="optionFrame">
				<input type="hidden" name="tmpSeq" value="<?php echo $TPL_VAR["sc"]["tmp_seq"]?>" />
				<input type="hidden" name="optionSeq" value="" />
				<input type="hidden" name="optionNo" value="" />
				<input type="hidden" name="newType" value="" />
				<table class="table_basic">
				<colgroup>
					<col width="30%">
					<col width="70%">
				</colgroup>
				<tr class="datelay">
					<th>
						날짜 입력
					</th>
					<td><input type="text" name="direct_codedate" value="" class="datepicker"  maxlength="10"  /></td>
				</tr>
				<tr class="colorlay">
					<th>
						색상 선택
					</th>
					<td><input type="text" name="direct_color" value="" class="colorpickerreview colorpicker"  maxlength="10"  /></td>
				</tr>
				<tr class="addresslay">
					<th>우편번호</th>
					<td>
						<input type="text" name="direct_zipcode[]" value="" size="10" class="direct_zipcode1" /> 
						<button type="button" class="direct_zipcode_btn resp_btn v2">우편번호</button>
						<input type="text" name="direct_address_type" value=""  class="direct_address_type hide" />
					</td>
				</tr>
				<tr class="addresslay">
					<th>지번</th>
					<td><input type="text" name="direct_address" value=""  class="wp85 direct_address" /></td>
				</tr>
				<tr class="addresslay">
					<th>도로명</th>
					<td><input type="text" name="direct_address_street" value=""  class="wp85 direct_address_street" /></td>
				</tr>
				<tr class="addresslay">
					<th>공통상세</th>
					<td><input type="text" name="direct_addressdetail"  value=""  class="wp85 direct_addressdetail" /></td>
				</tr>
				<tr class="addresslay">
					<th>업체 연락처</th>
					<td><input type="text" name="direct_biztel" value="" class="wp85 direct_biztel" /></td>
				</tr>
				<tr class="addresslay">
					<th>수수료</th>
					<td>
						<input class="right input-box-default-text direct_address_commission onlynumber" size="4" maxlength="3" name="direct_address_commission" value="0" type="text"> %
						
						<ul class="bullet_hyphen resp_message">
							<li>해당 매장(지역,장소)에서 사용했을 경우 수수료입니다.</li>
							<li>수수료는 판매자(본사 또는 입점사)와 매장간 정산 내역에 자동 반영됩니다.</li>
						</ul>
					</td>
				</tr>
				</table>
				
				<div class="mt10 resp_checkbox">
					<label><input type="checkbox" name="same_spc_save_type" value="y" checked /> 위 내용 동일 옵션에 모두 적용</label>
				</div>
			</div>
		</div>
		<div class="footer">
				<button type="button" id="goodsoptiondirectmodifybtn" class="resp_btn active size_XL">확인</button></span>
				<input type="button" class="resp_btn v5 size_XL" onclick="closeDialog('gdoptdirectmodifylay')" value="취소" />
		</div>
	
		</form>
	</div>
	
	
	<div id="hideFormLay"></div>
	
	<div id="dialog_international_shipping" class="hide">
		<div class="content">
			<ul class="bullet_circle mt20 mb20">
				<li>
				수출입상품코드(HSCODE)란? <br />
				전 세계에서 거래되는 각종 물품을 세계관세기구(WCO)가 정한 국제통일상품분류체계(HS)에
				의거 하나의 품목번호(Heading)로 분류한 국제적 상품선택코드입니다.
				</li>
				<li class="mt10">수출입상품코드 (HSCODE) 이용<br />
				HSCODE는 통관 시 세관신고서에 기입하시게 됩니다.
				본 시스템에서는 물품의 HSCODE를 저장하여 관리할 수 있습니다.
				</li>	
			</ul>	
		</div>
		<div class="footer">
				<input type="button" class="resp_btn v5 size_XL" onclick="closeDialog('dialog_international_shipping')" value="닫기" />
		</div>
	</div>
	
<?php $this->print_("CREATE_OPTION",$TPL_SCP,1);?>   <!--옵션 신규 생성 create_goods_options.html-->
	
	<div id="selectGoodsOptionsDialog" style="display:none;"></div>
	<iframe name="optionFrame" id="optionFrame" src="" width="100%" height="0" frameborder="0" class="hide"></iframe>
	<form name="save_package_tmp" id="save_package_tmp" method="post" action="../goods_process/save_tmp_option_package" target="optionFrame">
	</form>
	<script>package_unit_ea_display();</script>
	
	<!-- 옵션설명 레이어 -->
	<div id="applyAllOptInfomation" class="hide">
		<table class="table_basic">
			<tbody>
				<tr>
					<td><textarea name="infomation_all" rows="3" class="wp95" style="border:0px;"></textarea></td>
				</tr>
			</tbody>
		</table>
		<div class="footer">
			<button type="button" id="infomation_all" class="save_all resp_btn active size_XL">확인</button></span>
			<input type="button" class="resp_btn v3 size_XL" onclick="closeDialog('applyAllOptInfomation')" value="취소" />
		</div>
	</div>
	
	<div id="applyOptInfomation" class="hide">
		<table class="table_basic">
			<tbody>
				<tr>
					<td>
						<input type="hidden" id="tmpInfomationIdx" value=""/>
						<textarea id="tmpInfomation" rows="3" class="wp95" style="border:0px;"></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="footer">
			<button type="button" onClick="doApplyOptInfomation();" class="resp_btn active size_XL">적용</button>
			<input type="button" class="resp_btn v3 size_XL" onclick="closeDialog('applyOptInfomation')" value="취소" />
		</div>
	</div>
	
	<div id="viewOptInfomation" class="hide">
		<table class="info-table-style" style="width:560px;">
			<tbody>
				<tr>
<?php if(is_array($TPL_R1=$TPL_VAR["options"][ 0]["option_divide_title"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?><th width="80"><?php echo $TPL_V1?></th><?php }}?>
					<th>설명</th>
				</tr>
<?php if($TPL_options_1){foreach($TPL_VAR["options"] as $TPL_V1){?>
				<tr>
<?php if(is_array($TPL_R2=$TPL_V1["opts"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
					<td class="its-td center pd5"><?php echo $TPL_V2?>

					</td>
<?php }}?>
					<td class="its-td left pd5"><?php echo $TPL_V1["infomation"]?></td>
				</tr>
<?php }}?>
			</tbody>
		</table>
	</div>
	
	<div id="makeGoodsCodLay" class="hide">
		<div class="content">
			<div class="center" style="padding-top:10px;color:blue">현재 상품 기본코드 자동생성규칙</div>
			<div class="center" style="padding-top:10px;">
<?php if($TPL_VAR["goodscodesettingview"]){?><?php echo substr($TPL_VAR["goodscodesettingview"], 0,strlen($TPL_VAR["goodscodesettingview"])- 3)?><?php }else{?>규칙없음<?php }?>
			</div>
			<div class="center" style="padding:20px;">
			</div>
		</div>
		<div class="footer">
<?php if($TPL_VAR["goodscodesettingview"]&&($TPL_VAR["sc"]["no"]||$TPL_VAR["goods_seq"])){?>
			<button type="button" onClick="makeGoodsCode();" class="resp_btn active size_XL">자동생성</button>
<?php }?>
			<input type="button" class="resp_btn v3 size_XL" onclick="closeDialog('makeGoodsCodLay')" value="취소" />
		</div>
	</div>
	
	<!-- 옵션관리 다이얼로그 -->
	<div id="optionSettingPopup" class="hide">
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
<?php if($TPL_VAR["frequentlyoptlist"]){?>
<?php if($TPL_frequentlyoptlist_1){foreach($TPL_VAR["frequentlyoptlist"] as $TPL_V1){?>
					<tr>
						<td><span class="delFreqOptionName_<?php echo $TPL_V1["goods_seq"]?>"><?php echo $TPL_V1["goods_name"]?></span></td>
						<td class="center">
							<button type="button" class="delFreqOption resp_btn v3 size_S" value="<?php echo $TPL_V1["goods_seq"]?>" data-type="opt">삭제</button>
						</td>
					</tr>
<?php }}?>
<?php }else{?>
					<tr>
						<td colspan="2" class="center">데이터 없음</td>
					</tr>
<?php }?>
				</tbody>
			</table>
			<div class="paging_navigation"><?php echo $TPL_VAR["frequentlyoptpaginlay"]?></div>
		</div>
		<div class="footer">
			<button type="button" class="resp_btn v3 size_XL" onClick="closeDialog('optionSettingPopup')">닫기</button>
		</div>
	</div>