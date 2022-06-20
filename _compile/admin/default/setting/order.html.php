<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/setting/order.html 000024443 */ 
$TPL_reasonLoop_1=empty($TPL_VAR["reasonLoop"])||!is_array($TPL_VAR["reasonLoop"])?0:count($TPL_VAR["reasonLoop"]);
$TPL_reasoncouponLoop_1=empty($TPL_VAR["reasoncouponLoop"])||!is_array($TPL_VAR["reasoncouponLoop"])?0:count($TPL_VAR["reasoncouponLoop"]);
$TPL_shipping_nation_codes_1=empty($TPL_VAR["shipping_nation_codes"])||!is_array($TPL_VAR["shipping_nation_codes"])?0:count($TPL_VAR["shipping_nation_codes"]);?>
<?php $this->print_("layout_header",$TPL_SCP,1);?>


<script type="text/javascript" src="/app/javascript/jquery/jquery.tablednd.js"></script>

<script type="text/javascript">
	var gl_runout = '<?php echo $TPL_VAR["runout"]?>';
	var gl_cartDuration = '<?php echo $TPL_VAR["cartDuration"]?>';
	var gl_cancelDuration = '<?php echo $TPL_VAR["cancelDuration"]?>';
	var gl_ableStockStep = '<?php echo $TPL_VAR["ableStockStep"]?>';
	var gl_refundDuration = '<?php echo $TPL_VAR["refundDuration"]?>';
	var gl_cashreceiptuse = '<?php echo $TPL_VAR["cashreceiptuse"]?>';
	var gl_biztype = '<?php echo $TPL_VAR["biztype"]?>';
	var gl_taxuse = '<?php echo $TPL_VAR["taxuse"]?>';
	var gl_hiworks_use = '<?php echo $TPL_VAR["hiworks_use"]?>';
	var gl_cashreceiptpg = '<?php echo $TPL_VAR["cashreceiptpg"]?>';
	var gl_cashreceipt_date = '<?php echo $TPL_VAR["cashreceipt_date"]?>';
	var gl_cancelDisabledStep35 = '<?php echo $TPL_VAR["cancelDisabledStep35"]?>';
	var gl_provider_do_order_done = '<?php echo $TPL_VAR["provider_do_order_done"]?>';
	var gl_pgCompany = '<?php echo $TPL_VAR["config_system"]["pgCompany"]?>';
	var gl_autocancel = '<?php echo $TPL_VAR["autocancel"]?>';
	var gl_export_err_handling = '<?php echo $TPL_VAR["export_err_handling"]?>';
	var gl_cutting_sale_price = '<?php echo $TPL_VAR["config_system"]["cutting_sale_price"]?>';
	var gl_cutting_sale_action = '<?php echo $TPL_VAR["config_system"]["cutting_sale_action"]?>';
	var gl_cutting_settle_price = '<?php echo $TPL_VAR["config_system"]["cutting_settle_price"]?>';
	var gl_cutting_settle_action = '<?php echo $TPL_VAR["config_system"]["cutting_settle_action"]?>';
	var gl_save_type = '<?php echo $TPL_VAR["save_type"]?>';
	var gl_save_term = '<?php echo $TPL_VAR["save_term"]?>';
	var gl_buy_confirm_use = '<?php echo $TPL_VAR["buy_confirm_use"]?>';
	var gl_cutting_settle_use	= false;
	var gl_cutting_sale_use	= false;
	var gl_servicelimit_h_ad	= false;
	var gl_servicelimit_h_fr	= false;
<?php if($TPL_VAR["config_system"]["cutting_settle_use"]){?>
	gl_cutting_settle_use	= true;
<?php }?>
<?php if($TPL_VAR["config_system"]["cutting_sale_use"]){?>
	gl_cutting_sale_use	= true;
<?php }?>
<?php if(serviceLimit('H_AD')){?>
	gl_servicelimit_h_ad	= true;
<?php }?>
<?php if(serviceLimit('H_FR')){?>
	gl_servicelimit_h_fr	= true;
<?php }?>
	var gl_not_match_goods_order		= 'y';		// 미매칭 주문 처리 상태 기본값
</script>

<script type="text/javascript" src="/app/javascript/js/admin-settingOrder.js"></script>
<style>
	.buyerHighlight {background:url("/admin/skin/default/images/common/icon_buyer.gif") no-repeat; display:inline-block; width:40px; height:15px; text-indent:-1000px; overflow:hidden; margin-right:2px; margin-bottom:1px;}
	.managerHighlight {background:url("/admin/skin/default/images/common/icon_seller.gif") no-repeat; display:inline-block; width:40px; height:15px; text-indent:-1000px; overflow:hidden; margin-right:2px; margin-bottom:1px;}	
	table.info-table-style th.ltsbgred {font-size:18px;background-color:#f00;width:18px;}
	table.info-table-style .its-th-align {padding-left:5px; font-weight:normal !important;}
	.coupon_status{color:red}
	.coupon_status_all{color:red}
	.coupon_order_status{color:gray}
	.coupon_status_use{color:blue}
	.coupon_input_value{color:green}
	.right-padding{text-align:right;padding-right:10px;border-left: 1px solid #dadada;border-bottom: 1px solid #dadada; height:32px;}
</style>

<form name="settingForm" method="post" enctype="multipart/form-data" action="../setting_process/order" target="actionFrame">

<!-- 페이지 타이틀 바 : 시작 -->
<div id="page-title-bar-area">
	<div id="page-title-bar">
<?php $this->print_("require_info",$TPL_SCP,1);?>

		
		<!-- 타이틀 -->
		<div class="page-title">
			<h2>주문</h2>
		</div>

		<!-- 우측 버튼 -->
		<div class="page-buttons-right">
			<button  class="resp_btn active size_L" type="submit">저장</button>
		</div>

	</div>
</div>
<!-- 페이지 타이틀 바 : 끝 -->


<!-- 서브 레이아웃 영역 : 시작 -->
<!-- 서브메뉴 바디 : 시작-->
<div class="contents_dvs">
	<div class="item-title">
		재고에 따른 상품 판매
		<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip1', 'sizeM')"></span>
	</div>

	<table class="table_basic thl">
		<tr>
			<th>
				상품 판매 여부
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip18')"></span>
			</th>
			<td>
				<div class="resp_radio">
					<label><input type="radio" name="runout" value="stock" /> 재고가 있으면 판매</label>
					<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip2')"></span>
				
					<label><input type="radio" name="runout" value="ableStock" checked /> 가용재고 사용</label>
					<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip21')"></span>							
				
					<label><input type="radio" name="runout" value="unlimited" /> 재고와 상관없이 판매</label>
					<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip3')"></span>
				</div>				
			</td>
		</tr>

		<tr class="ableStockDetail">
			<th>
				가용 재고
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip20')"></span>
			</th>
			<td>						
				<input type="text" name="ableStockLimit" size="5" value="<?php echo $TPL_VAR["ableStockLimit"]?>" class="right line onlynumber_signed"> 
				이하일 때 품절 또는 재고확보 중 처리
				<span class="gray ml10">※ 가용재고  = 상품의 재고 – 출고 예약량 - 불량재고</span>
			</td>
		</tr>

		<tr class="ableStockDetail">
			<th>
				출고 예약량 기준
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip5')"></span>
			</th>
			<td>
				<div class="resp_radio col">
					<label><input type="radio" name="ableStockStep" value="15" checked/> 주문 접수, 결제확인, 상품준비, 출고준비 상태의 상품 수량</label><br/>
					<label><input type="radio" name="ableStockStep" value="25"/> 결제확인, 상품준비, 출고준비 상태의 상품 수량</label>		
				</div>
			</td>
		</tr>
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">재고에 따른 상품 출고</div>
	<table class="table_basic thl">
		<tr>
			<th>
				티켓 상품 출고
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip4')"></span>
			</th>
			<td>
				<div class="resp_radio">
					<label><input type="radio" name="export_err_handling" value="error" /> 재고가 있으면 출고</label>
					<label><input type="radio" name="export_err_handling" value="ignore" checked="checked" /> 재고와 상관없이 출고</label>
				</div>
			</td>
		</tr>				
	</table>	
</div>

<div class="contents_dvs">
	<div class="item-title">구매 확정</div>
	<table class="table_basic thl">					
		<tr>
			<th>
				구매확정 사용
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip11')"></span>
			</th>
			<td>
			   <div id="select_buy_confirm_use">	
					<label class="mr15"><input type="radio" name="buy_confirm_use" value="1"/> 사용함</label>
					<label><input type="radio" name="buy_confirm_use" value="0" /> 사용 안 함</label>	
				</div>

				<div id="msg_buy_confirm_use">
					사용함
				</div>
				
				<span class="resp_message v2">※ 판매자 구매 확정 처리 가능 단계: 출고완료, 배송중, 배송완료</span>
			</td>
		</tr>
		
		<tr class="buy_confirm_use_con">
			<th>자동 구매 확정 기간</th>
			<td>						
				<select name="save_term">
					<option value="1" >1일</option>
					<option value="2" >2일</option>
					<option value="3" >3일</option>
					<option value="4" >4일</option>
					<option value="5" >5일</option>
					<option value="6" >6일</option>
					<option value="7" selected="selected" >7일</option>
					<option value="8">8일</option>
					<option value="9">9일</option>
					<option value="10">10일</option>
					<option value="11">11일</option>
					<option value="12">12일</option>
					<option value="13">13일</option>
					<option value="14">14일</option>
					<option value="20">20일</option>
					<option value="25">25일</option>
					<option value="30">30일</option>
				</select>
				<span class="gray ml10">(출고 완료 후 해당 기간 경과 시 자동 구매 확정)</span>
			</td>
		</tr>
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">실물상품 주문 설정</div>
	<table class="table_basic thl">			
		<tr>
			<th>
				취소(환불) 단계
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip12', 'sizeM')"></span>
			</th>
			<td>						
				<select name="cancelDisabledStep35">
					<option value="0" <?php if($TPL_VAR["cancelDisabledStep35"]!= 1){?> selected="selected" <?php }?>> 결제확인, 상품준비</option>
					<option value="1"  <?php if($TPL_VAR["cancelDisabledStep35"]== 1){?> selected="selected" <?php }?>>결제확인</option>
				</select> 상태에서 주문 취소 가능  					
			</td>
		</tr>

		<tr>
			<th>
				구매 적립
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip13', 'sizeM')"></span>
			</th>
			<td class="buy_confirm_use_con" >구매 확정 시 지급</td>
			<td class="buy_confirm_unused_con" >배송완료 시 지급</td>
		</tr>

		<tr class="buy_confirm_use_con">
			<th>
				자동 구매 확정 적립
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip13', 'sizeM')"></span>
			</th>
			<td>						
				구매자가 기간 내 구매확정을 하지 않으면, 자동 구매 확정 후 마일리지/포인트
				<select name="save_type">
					<option value="give" selected>지급</option>
					<option value="exist">미지급</option>							
				</select>							
			</td>
		</tr>

		<tr>
			<th>
				반품(환불)<br/>교환(교환주문)
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip14', 'sizeM')"></span>
			</th>
			<td>
				<span class="buy_confirm_use_con">구매 확정 이전 가능</span>

				<span class="buy_confirm_unused_con">
					배송완료 후 
					<select name="save_term">
						<option value="1" >1일</option>
						<option value="2" >2일</option>
						<option value="3" >3일</option>
						<option value="4" >4일</option>
						<option value="5" >5일</option>
						<option value="6" >6일</option>
						<option value="7" selected="selected" >7일</option>
						<option value="8">8일</option>
						<option value="9">9일</option>
						<option value="10">10일</option>
						<option value="11">11일</option>
						<option value="12">12일</option>
						<option value="13">13일</option>
						<option value="14">14일</option>
						<option value="20">20일</option>
						<option value="25">25일</option>
						<option value="30">30일</option>
					</select>
					이내 반품/맞교환 가능 
				</span>
				
				<div class="gray">※ 판매자 반품, 교환 처리 가능 단계: 출고완료, 배송중, 배송완료</div>
			</td>
		</tr>

		<tr>
			<th>
				반품(환불)<br/>교환(교환주문)<br/>사유					
			</th>
			<td>						
				<div class="mb5">
					<button type="button" class="btn_plus valign-middle" onclick="addReason(120,'');"></button> <span class="mr15">변심(구매자책임)</span>
					<button type="button" class="btn_plus valign-middle" onclick="addReason(210,'');"></button> <span class="mr15">하자(관리자책임)</span>
					<button type="button" class="btn_plus valign-middle" onclick="addReason(310,'');"></button> <span>오배송(관리자책임)</span>
				</div>

				<table id="reasonTable" class="table_basic tdc tablednd wx900 v7">
					<col width="10%"/><col width="10%"/><col width="70%"/><col width="10%"/>					
					<thead>
					<tr class="nodrag nodrop">
						<th>순서</th>
						<th>구분</th>
						<th>내용</th>
						<th>삭제</th>
					</tr>
					</thead>
				
<?php if($TPL_VAR["reasonLoop"]){?>
<?php if($TPL_reasonLoop_1){foreach($TPL_VAR["reasonLoop"] as $TPL_V1){?>
						<tr>
							<td><img src="/admin/skin/default/images/common/icon_move.png"></td>
							<td><?php if($TPL_V1["codecd"]=='120'){?>변심<?php }elseif($TPL_V1["codecd"]=='210'){?>하자<?php }elseif($TPL_V1["codecd"]=='310'){?>오배송<?php }?></td>
							<td class="left">
								<input type="hidden" name="codecd[]" value="<?php echo $TPL_V1["codecd"]?>">
								<input type="text" name="reason[]" size="65" value="<?php echo $TPL_V1["reason"]?>">
							</td>
							<td><button type="button" class="btn_minus" onclick="delReason(this);" /></td>
						</tr>
<?php }}?>
<?php }else{?>
					<tr>
						<td><img src="/admin/skin/default/images/common/icon_move.png"></td>
						<td>변심</td>
						<td class="left">
							<input type="hidden" name="codecd[]" value="120">
							<input type="text" name="reason[]" size="65" value="사이즈가 맞지 않아요">
						</td>
						<td><button type="button" class="btn_minus" onclick="delReason(this);" /></td>
					</tr>
					<tr>
						<td><img src="/admin/skin/default/images/common/icon_move.png"></td>
						<td>하자</td>
						<td class="left">
							<input type="hidden" name="codecd[]" value="210">
							<input type="text" name="reason[]" size="65" value="제품파손-파손되었어요">
						</td>
						<td><button type="button" class="btn_minus" onclick="delReason(this);" /></td>
					</tr>
					<tr>
						<td><img src="/admin/skin/default/images/common/icon_move.png"></td>
						<td>오배송</td>
						<td class="left">
							<input type="hidden" name="codecd[]" value="310">
							<input type="text" name="reason[]" size="65" value="제품불일치-다른 상품이 왔어요">
						<td><button type="button" class="btn_minus" onclick="delReason(this);" /></td>
					</tr>
<?php }?>									
				</table>							
			</td>
		</tr>
	</table>
	<div class="resp_message">- 주문 상태 별 처리 기능 <a href="https://www.firstmall.kr/customer/faq/1116" class="link_blue_01" target="_blank">자세히 보기</a></div>
</div>

<?php if(serviceLimit('H_NFR')){?>
<div class="contents_dvs">
	<div class="item-title">티켓 상품 주문 설정</div>
	<table class="table_basic thl">
		<tr>
			<th>
				취소(환불)
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip15', 'sizeM')"></span>
			</th>
			<td>결제확인, 상품 준비 상태의 주문을 취소 가능</td>
		</tr>

		<tr>
			<th>
				구매 적립
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip16')"></span>
			</th>
			<td>티켓의 유효성을 종합(사용, 소멸, 환불)하여 배송완료 및 적립 처리</td>
		</tr>

		<tr>
			<th>
				티켓 환불
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip17', 'sizeM')"></span>
			</th>
			<td>유효 기간 시작 전, 후 취소(환불)은 상품 등록, 수정 시 상품 별로 조건을 설정 가능</td>
		</tr>

		<tr>
			<th>취소(환불) 사유</th>
			<td>
				<div class="mb5"><button type="button" onclick="addReason(120,'coupon');" class="btn_plus valign-middle"></button> 변심(구매자책임)</div>
				<table id="reasonTablecoupon" class="table_basic tdc tablednd wx900 v7">
					<col width="10%"/><col width="10%"/><col width="65%"/><col width="15%"/>
					<thead>
						<tr class="nodrag nodrop">
							<th>순서</th>
							<th>구분</th>
							<th>내용</th>
							<th>삭제</th>
						</tr>
					</thead>
					<tbody>
<?php if($TPL_VAR["reasoncouponLoop"]){?>
<?php if($TPL_reasoncouponLoop_1){foreach($TPL_VAR["reasoncouponLoop"] as $TPL_V1){?>
						<tr>
							<td><img src="/admin/skin/default/images/common/icon_move.png"></td>
							<td><?php if($TPL_V1["codecd"]=='120'){?>변심<?php }elseif($TPL_V1["codecd"]=='210'){?>하자<?php }elseif($TPL_V1["codecd"]=='310'){?>오배송<?php }?></td>
							<td class="left">
								<input type="hidden" name="codecdcoupon[]" value="<?php echo $TPL_V1["codecd"]?>">
								<input type="text" name="reasoncoupon[]" size="65" value="<?php echo $TPL_V1["reason"]?>">
							</td>
							<td>
								<button type="button" class="btn_minus" onclick="delReason(this);"></button></div>
							</td>
						</tr>
<?php }}?>
<?php }else{?>
						<tr>
							<td><img src="/admin/skin/default/images/common/icon_move.png"></td>
							<td>변심</td>
							<td>
								<input type="hidden" name="codecdcoupon[]" value="120">
								<input type="text" name="reasoncoupon[]" size="65" value="사이즈가 맞지 않아요">
							</td>
							<td>
								<button type="button" class="btn_minus" onclick="delReason(this);"></button>
							</td>
						</tr>
<?php }?>
					</tbody>
				</table>
			</td>
		</tr>				
	</table>
	<div class="resp_message">- 주문 상태 별 처리 기능 <a href="https://www.firstmall.kr/customer/faq/1116" class="link_blue_01" target="_blank">자세히 보기</a></div>
</div>
<?php }?>

<!-- O2O 미매칭 관련 설정 추가 -->
<?php if($TPL_VAR["checkO2ORequired"]){?>
<?php $this->print_("o2o_order",$TPL_SCP,1);?>

<?php }?>

<?php if(serviceLimit('H_AD')){?>
<div class="contents_dvs">
	<div class="item-title">입점사 권한	</div>
	<table class="table_basic thl">
		<tr>
			<th>
				배송완료 처리 권한
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip10', 'sizeM')"></span>
			</th>
			<td>
				<div class="resp_radio">
					<label><input type="radio" name="provider_do_order_done" value="Y" /> 처리가능</label>
					<label><input type="radio" name="provider_do_order_done" value="N" /> 처리불가</label>
				</div>
			</td>
		</tr>				
	</table>
</div>		
<?php }?>

<div class="contents_dvs">
	<div class="item-title">장바구니</div>

	<table class="table_basic thl">
		<tr>
			<th>
				보존 기간 설정
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip6')"></span>
			</th>
			<td>						
				<select name="cartDuration">
					<option value="1">1일</option>
					<option value="2">2일</option>
					<option value="3">3일</option>
					<option value="4">4일</option>
					<option value="5">5일</option>
					<option value="6">6일</option>
					<option value="7" selected="selected" >7일</option>
					<option value="8">8일</option>
					<option value="9">9일</option>
					<option value="10">10일</option>
					<option value="11">11일</option>
					<option value="12">12일</option>
					<option value="13">13일</option>
					<option value="14">14일</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>기본배송국가</th>
			<td>
				<select name="cfg_default_nation">
<?php if($TPL_shipping_nation_codes_1){foreach($TPL_VAR["shipping_nation_codes"] as $TPL_K1=>$TPL_V1){?>
					<option value="<?php echo $TPL_K1?>" <?php if($TPL_K1==$TPL_VAR["cfg_default_nation"]){?>selected<?php }?>><?php echo $TPL_V1?></option>
<?php }}?>
				</select>
			</td>
		</tr>
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">
		추가 할인 금액
		<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip7', 'sizeM')"></span>
	</div>

	<table class="table_basic thl">
		<tr>
			<th>차감 금액 계산</th>
			<td>
				<div class="resp_radio">
					<label><input type="radio" value="none" name="cutting_sale_use" class="use_setting" checked="checked"> 차감 금액을 그대로 적용</label>
					<label><input type="radio" value="" name="cutting_sale_use" class="use_setting"> 차감 금액을 절사 또는 올림</label>
				</div>
			</td>
		</tr>	
		
		<tr class="saleDetail">
			<th>차감 금액 기준</th>
			<td>												
				<select name="cutting_sale_price">
					<option value="10000">1000(천단위)</option>
					<option value="1000">100(백단위)</option>
					<option value="100">10(십단위)</option>
					<option value="10">1(일단위)</option>
					<option value="0.01">0.1(소수 첫째 자리)</option>
					<option value="0.001">0.01(소수 둘째 자리)</option>
				</select> 
				<select name="cutting_sale_action">
					<option value="dscending">절사(버림)</option>
					<option value="rounding">반올림</option>
					<option value="ascending">올림</option>
				</select>						
			</td>
		</tr>	
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">
		주문 무효 처리
		<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/order', '#tip8', 'sizeM')"></span>
	</div>

	<table class="table_basic thl">
		<tr>
			<th>자동 실행</th>
			<td>
				<div class="resp_radio">
					<label class="mr15"><input type="radio" value="y" name="autocancel"> 사용함</label>
					<label><input type="radio" value="n" name="autocancel" > 사용 안 함</label>
				</div>
			</td>
		</tr>		
		
		<tr class="autocancelDetail">
			<th>무효 처리 기간</th>
			<td>						
				<span>주문일로부터 미 입금</span>
				<select name="cancelDuration">
					<option value="1">1일</option>
					<option value="2">2일</option>
					<option value="3">3일</option>
					<option value="4">4일</option>
					<option value="5">5일</option>
					<option value="6">6일</option>
					<option value="7">7일</option>
					<option value="8">8일</option>
					<option value="9">9일</option>
					<option value="10">10일</option>
					<option value="11">11일</option>
					<option value="12">12일</option>
					<option value="13">13일</option>
					<option value="14">14일</option>
				</select>

				<span>경과 시</span>	
			</td>
		</tr>	
	</table>
</div>
	
<!-- 서브메뉴 바디 : 끝 -->
<!-- 서브 레이아웃 영역 : 끝 -->
</form>

<!-- 아이콘 선택 -->
<div id="goodsIconPopup" class="hide">
	<form enctype="multipart/form-data" method="post" action="../goods_process/icon" target="actionFrame">
	<input type="hidden" name="iconIndex" value="0" />
	<ul>
<?php if(is_array($TPL_R1=code_load('goodsIcon'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<li style="float:left;width:100px;height:30px;text-align:center">
		<input type="hidden" name="goodsIconCode[]" value="<?php echo $TPL_V1["codecd"]?>">
		<img src="/data/icon/goods/<?php echo $TPL_V1["codecd"]?>.gif" border="0" class="hand hover-select">
	</li>
<?php }}?>
	</ul>
	<div class="clearbox"></div>
	<div>
	<input type="file" name="goodsIconImg" /> <span class="btn small black"><button type="submit">추가</button></span>
	</div>
	</form>
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

<!--### 상품상태별 이미지세팅 -->
<div id="popGoodsStatusImage" class="hide"></div>
<div id="popup" class="hide"></div>

<?php $this->print_("layout_footer",$TPL_SCP,1);?>