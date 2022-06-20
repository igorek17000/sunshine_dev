<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/accountall/accountallviewer.html 000050001 */ 
$TPL_year_1=empty($TPL_VAR["year"])||!is_array($TPL_VAR["year"])?0:count($TPL_VAR["year"]);
$TPL_month_1=empty($TPL_VAR["month"])||!is_array($TPL_VAR["month"])?0:count($TPL_VAR["month"]);
$TPL_provider_1=empty($TPL_VAR["provider"])||!is_array($TPL_VAR["provider"])?0:count($TPL_VAR["provider"]);?>
<?php $this->print_("layout_header",$TPL_SCP,1);?>

<script type="text/javascript" >
	// 정산 데이터 ajax 호출
	var loading_status					= new Array();
	loading_status['sale']				= new Array();
	loading_status['sale']['carry']		= 'n';
	loading_status['sale']['current']	= 'n';
	loading_status['acc']				= new Array();
	loading_status['acc']				= new Array();
	loading_status['acc']['carry']		= 'n';
	loading_status['acc']['current']	= 'n';

	// 페이지당 노출 수 전역변수
	var gl_perpage	= "<?php echo $TPL_VAR["perpage"]?>";
	
	$(document).ready(function() {
		
		gSearchForm.init({'pageid':'accountallviewerall','sc':<?php echo $TPL_VAR["scObj"]?>});

		//해더타이틀과 body 따라다니기 checked-tr-background
		$(".account-table-grid-body").on("scroll", $.proxy(function(e) {
			$(".account-table-grid-header").scrollLeft(e.target.scrollLeft);
		}, this));

		$("button[name='order_referer_btn']").click(function(){
			var order_referer = $(this).attr("order_referer");
			$("#order_referer").val(order_referer);
			$("#accountsearch").submit();
		});

		

		$("select[name='s_year'] option[value='<?php echo $TPL_VAR["sc"]["s_year"]?>']").attr('selected',true);
		$("select[name='s_month'] option[value='<?php echo $TPL_VAR["sc"]["s_month"]?>']").attr('selected',true);

		$(".result_false_file").click(function(){
			var result_excel_url = $(this).attr("result_excel_url");
			$("iframe[name=actionFrame]").attr("src", result_excel_url);
			//document.location.href=result_excel_url;
		});
		
		/*
		$("input[name='order_referer[]'][value='all']").on("click",function(){
			if($(this).is(":checked") == true){
				$("input[name='order_referer[]']").prop("checked",true);
			}else{
				$("input[name='order_referer[]']").prop("checked",false);
			}
		});*/

		// 정산데이터 조회
		get_acc_all_list();
		
		// 검산툴 실행
		$("#btn_checker_tool").on("click", function(){
			loadCheckerTool();
		});
		// 검산툴 활성화
		$("#open_checker_tool").on("click", function(){
			var checker_tool = $("input[name=checker_tool]").length;
			var cnt = $(this).data("cnt");
			cnt = parseInt(cnt) + 1;
			$(this).data("cnt", cnt);
			if($(this).data("cnt") >= 5 && checker_tool == 0){
				if(confirm("검산툴을 활성화 하시겠습니까?")){
					var connector = '?';
					if(location.href.indexOf("?") > -1){
						connector = '&';
					}
					location.href = location.href + connector + 'checker_tool=1';
				}
			}
		});
		// 검산툴 결과 저장
		$("#btn_check_result_download").on("click", function(){
			downloadCheckResult();
		});
		
	});

	// 정산데이터 전체 조회
	function get_acc_all_list(){
		get_acc_carry_list();
		get_acc_current_list();
	}
	// 정산데이터 이월 조회
	function get_acc_carry_list(){
		get_data_list_ajax('sale', 'carry');
		get_data_list_ajax('acc', 'carry');
	}
	// 정산데이터 당월 조회
	function get_acc_current_list(){
		get_data_list_ajax('sale', 'current');
		get_data_list_ajax('acc', 'current');
	}
	// 정산데이터 ajax
	function get_data_list_ajax(pagemode, targetmode){
		var params 		= $("#accountsearch").serialize();
		var page 		=  $("#"+targetmode+"_page").val();
		var last_num 	=  $("#"+targetmode+"_last_num").val();
		var add_params 	= 
			"&pagemode=" + pagemode + 
			"&targetmode=" + targetmode + 
			"&"+targetmode+"_page=" + page +
			"&"+targetmode+"_last_num="+last_num
		;
		
		params = params + add_params;
		
		if(loading_status[pagemode][targetmode] == 'n' 
			&& $("#"+targetmode+"_total_count").val() != '0'
			&& (parseInt($("#"+targetmode+"_total_count").val()) > parseInt($("#"+targetmode+"_last_num").val()))
		){
			loading_status[pagemode][targetmode] = 'y';
			
			$("#ajaxLoadingLayer").ajaxStart(function() { loadingStop(this); });
			$(".more_btn_" + pagemode + "_" + targetmode).remove();

			$.ajax({
				type: 'get',
				url: 'accountallviewerall',
				data: params,
				dataType: 'html',
				success: function(result) {
					$("#list_" + pagemode + "_" + targetmode).append(result);
					// 데이터 존재 여부 확인
					if(
						$("#"+targetmode+"_total_count").val() != '0'
						&& parseInt($("#"+targetmode+"_total_count").val()) > parseInt($("#"+targetmode+"_last_num").val()
						&& parseInt($("#"+targetmode+"_total_count").val()) > parseInt(gl_perpage) // 100개 이상일때만 더보기 출력
					)){
						var more_btn = $("<div class='more_btn_" + pagemode + "_" + targetmode + "'><button type='button'>더보기</button></div>");
						$("#list_" + pagemode + "_" + targetmode).append(more_btn);
					}

					$(".more_btn_" + pagemode + "_" + targetmode + "").off("click");
					$(".more_btn_" + pagemode + "_" + targetmode + "").on("click", function(){
						if(targetmode=='carry'){
							get_acc_carry_list();
						}else if(targetmode=='current'){
							get_acc_current_list();
						}
					});
					
					loading_status[pagemode][targetmode] = 'n';
					
					// 검산툴 데이터 갱신
					var checker_tool		= $("input[name=checker_tool]").val();
					if(checker_tool){
						$("#checker_tool_"+targetmode+"_total_cnt").html($("#"+targetmode+"_total_count").val());
						$("#checker_tool_"+targetmode+"_load_cnt").html($("#"+targetmode+"_last_num").val());
					}
				}
			});
		}
	}
	
	function loadCheckerTool(){
		var checker_tool_carry_load_cnt = $("#checker_tool_carry_load_cnt").html();
		var checker_tool_carry_total_cnt = $("#checker_tool_carry_total_cnt").html();
		var checker_tool_current_load_cnt = $("#checker_tool_current_load_cnt").html();
		var checker_tool_current_total_cnt = $("#checker_tool_current_total_cnt").html();
		
		var confirmTxt = ""
			+ "이월데이터 총 " + checker_tool_carry_total_cnt + "개 중 " + checker_tool_carry_load_cnt + "개와 \n"
			+ "당월데이터 총 " + checker_tool_current_total_cnt + "개 중 " + checker_tool_current_load_cnt + "개의 \n\n"
			+ "검산을 실행하시겠습니까?"
		;
		if(confirm(confirmTxt)){
			// 정산데이터가 모두 호출된 이후 검산툴 실행
			callCheckerTool('sale', 'carry');
			callCheckerTool('sale', 'current');
		}
	}
	
	// 검산툴 순차시행
	function callCheckerTool(pagemode, targetmode){
		var checker_tool		= $("input[name=checker_tool]").val();
		if(pagemode == "sale" && checker_tool == "1"){
			rowCallCheckerTool(pagemode, targetmode);
		}
	}

	var checker_tool_pointer = {'carry':0,'current':0};
	function rowCallCheckerTool(pagemode, targetmode){
		// 각 페이지의 첫번째 row 부터 검증
		var pointer						= checker_tool_pointer[targetmode];
		var arr_tr						= $("#list_" + pagemode + "_" + targetmode + " tr.tr");
		var obj							= arr_tr.eq(pointer);
		var seq							= obj.data("seq");
		var accountData					= obj.data("accountData");
		var carryover					= obj.data("carryover");
		var checker_tool_view_succ		= $("input[name=checker_tool_view_succ]").val();
		var checked						= obj.data("checked");
		var checker_tool				= $("input[name=checker_tool]").val();
		
		var div_pagemod  = carryover;
		var div_pagemod_sub = carryover;
		if(div_pagemod == ""){
			div_pagemod = "current";
			div_pagemod_sub = "current";
		}
		if(div_pagemod == "carryover"){
			div_pagemod_sub = "carry";
		}
		var checker_tool_carry_load_cnt = $("#checker_tool_carry_load_cnt").html();
		var checker_tool_carry_total_cnt = $("#checker_tool_carry_total_cnt").html();
		var checker_tool_current_load_cnt = $("#checker_tool_current_load_cnt").html();
		var checker_tool_current_total_cnt = $("#checker_tool_current_total_cnt").html();
		checker_tool_carry_load_cnt = parseInt(checker_tool_carry_load_cnt);
		checker_tool_carry_total_cnt = parseInt(checker_tool_carry_total_cnt);
		checker_tool_current_load_cnt = parseInt(checker_tool_current_load_cnt);
		checker_tool_current_total_cnt = parseInt(checker_tool_current_total_cnt);
		
		var now_cnt = checker_tool_pointer['carry'] + 1 + checker_tool_pointer['current'] + 1;
		var load_cnt = checker_tool_carry_load_cnt + checker_tool_current_load_cnt;
		var total_cnt = checker_tool_carry_total_cnt + checker_tool_current_total_cnt;
		
		if(checked == "" && checker_tool){
			$.ajax({
				type: 'post',
				url: 'accountallviewerall_checker_tool_ajax',
				sync: true,
				data: {
					"accountData"				: accountData,
					"carryover"					: carryover,
					"checker_tool_view_succ"	: checker_tool_view_succ,
				},
				dataType: 'html',
				success: function(result) {
					var target_tr = $("#list_" + pagemode + "_" + targetmode + "").find("#" + div_pagemod + "_" + seq);
					target_tr.data("checked", "1");
					var target_span = target_tr.find("#span_" + div_pagemod + "_" + seq);
					target_span.html(result);
					
					// 다음 행 실행
					checker_tool_pointer[div_pagemod_sub]++;
					$("#checker_tool_" + div_pagemod_sub + "_now_cnt").html(checker_tool_pointer[div_pagemod_sub]);
					rowCallCheckerTool(pagemode, targetmode);

					if(now_cnt == load_cnt){
						if(load_cnt != total_cnt){
							var alert_text = "총 " + checker_tool_current_total_cnt + "개의 정산데이터 중 " + checker_tool_current_load_cnt + "개의 완료되었습니다.";
							alert_text = "\n나머지 정산데이터를 검산하려면 스크롤을 내려 정산데이터를 로드 후 검산툴 실행을 다시 눌러주세요.";
							alert(alert_text);
						}else{
							var alert_text = "모든 정산데이터가 검산되었습니다.";
							alert(alert_text);
						}
					}
				}
			});
		}
	}
	
	// 현재 검산된 내역 중 모든 에러 내역을 저장한다.
	function downloadCheckResult(){
		var checker_tool_carry_now_cnt = $("#checker_tool_carry_now_cnt").html();
		var checker_tool_carry_load_cnt = $("#checker_tool_carry_load_cnt").html();
		var checker_tool_carry_total_cnt = $("#checker_tool_carry_total_cnt").html();
		var checker_tool_current_now_cnt = $("#checker_tool_current_now_cnt").html();
		var checker_tool_current_load_cnt = $("#checker_tool_current_load_cnt").html();
		var checker_tool_current_total_cnt = $("#checker_tool_current_total_cnt").html();
		checker_tool_carry_now_cnt = parseInt(checker_tool_carry_now_cnt);
		checker_tool_carry_load_cnt = parseInt(checker_tool_carry_load_cnt);
		checker_tool_carry_total_cnt = parseInt(checker_tool_carry_total_cnt);
		checker_tool_current_now_cnt = parseInt(checker_tool_current_now_cnt);
		checker_tool_current_load_cnt = parseInt(checker_tool_current_load_cnt);
		checker_tool_current_total_cnt = parseInt(checker_tool_current_total_cnt);

		var now_cnt = checker_tool_carry_now_cnt + checker_tool_current_now_cnt;
		var load_cnt = checker_tool_carry_load_cnt + checker_tool_current_load_cnt;
		var total_cnt = checker_tool_carry_total_cnt + checker_tool_current_total_cnt;
		
		if(now_cnt == 0){
			alert("검산내역이 없습니다.");
			return;
		}
		
		var base_text = "에러내역 다운로드를 진행하시겠습니까?";
		if(now_cnt != total_cnt){
			base_text = total_cnt+"개의 데이터 중 " + now_cnt + "개가 검산되었습니다.\n" + base_text;
		}
		
		var arr_order_seq = [];
		if(confirm(base_text)){
			var arr_targetmode = ["carry", "current"];
			for(var i in arr_targetmode){
				var targetmode = arr_targetmode[i];
				var arr_tr						= $("#list_sale_" + targetmode + " tr.tr");
				arr_tr.each(function(){
					var obj = $(this);
					var checker_tool_detail = obj.find(".checker_tool_detail");
					if(checker_tool_detail.length > 0){
						var order_seq = checker_tool_detail.attr("order_seq");
						var checker_flag = checker_tool_detail.attr("checker_flag");
						if(checker_flag != "00"){
							var add_order_seq = true;
							$.each(arr_order_seq, function(i, el){
								if(el != order_seq && add_order_seq){
									add_order_seq = true;
								}else{
									add_order_seq = false;
								}
							});
							if(add_order_seq){
								arr_order_seq.push(order_seq);
							}
						}
					}
				});
			}
			
			// 엑셀 다운로드용 임시 form 생성
			var tmp_form_excel_download = $("<form id='tmp_form_excel_download' name='tmp_form_excel_download' method='post' target='actionFrame' action='accountallviewerall_checker_tool_download' />");
		
			var tmp_form_s_year = $("<input type='hidden' name='s_year' value='" + $("form[name='accountsearch'] select[name='s_year']").val() + "'/>");
			$(tmp_form_excel_download).append(tmp_form_s_year);
			var tmp_form_s_month = $("<input type='hidden' name='s_month' value='" + $("form[name='accountsearch'] select[name='s_month']").val() + "'/>");
			$(tmp_form_excel_download).append(tmp_form_s_month);
			
			for(i in arr_order_seq){
				var tmp_form_arr_order_seq = $("<input type='hidden' name='arr_order_seq[]' value='" + arr_order_seq[i] + "'/>");
				$(tmp_form_excel_download).append(tmp_form_arr_order_seq);
			}
			$("body").append(tmp_form_excel_download);
			
			tmp_form_excel_download.submit();
			
			// 사용한 임시 form 제거
			$("#tmp_form_excel_download").remove();
		}
	}
	
	function accountlallExcel(){
		var formData		= $('[name="accountsearch"]').serialize();
		actionFrame.location.href		= '../accountall/accountallviewerall?accountall_excel=1&'+formData;
	}

	
	function set_provider()
	{
		$.ajax({
			type: "get",
			url: "get_provider_for_viewer",
			success: function(data){
				$("select[name='provider_seq_selector'] option").remove();
				$("select[name='provider_seq_selector']").append(data);
			}
		});

		$( "select[name='provider_seq_selector']" )
		.combobox()
		.change(function(){
			$("input[name='provider_base']").removeAttr('checked').change();
			$("input[name='provider_seq']").val($(this).val());
			$("input[name='provider_name']").val($("option:selected",this).text());
		});
	}
	

// 스크롤 컨트롤
$(function() {
	var xxx = 0;
	
	$(".listCarryScroll").mouseenter(function() {
		$(".listCarryScroll").not($(this)).off('scroll');
		$(this).on('scroll', function() {
			var scroll_value = $(this).scrollTop();
			$(".listCarryScroll").not($(this)).scrollTop( scroll_value );
			
			var tableLayer = $(this).height();
			var listLayer = $(this).find(".calc-table-style").height();
			
			if(((listLayer - tableLayer) - scroll_value) < 200 ){
				get_acc_carry_list();
			}
		});
	});
	$(".listCurrentScroll").mouseenter(function() {
		$(".listCurrentScroll").not($(this)).off('scroll');
		$(this).on('scroll', function() {
			var scroll_value = $(this).scrollTop();
			$(".listCurrentScroll").not($(this)).scrollTop( scroll_value );
			
			var tableLayer = $(this).height();
			var listLayer = $(this).find(".calc-table-style").height();
			
			if(((listLayer - tableLayer) - scroll_value) < 200 ){
				get_acc_current_list();
			}
		});
	});
	$(".colgroupAcc").mouseenter(function() {
		$(".colgroupAcc").not($(this)).off('scroll');
		$(this).on('scroll', function() {
			var scroll_value = $(this).scrollLeft();
			$(".colgroupAcc").not($(this)).scrollLeft( scroll_value );
		});
	});
	

	$('#topScroll .calc-table-style colgroup col').each(function() {
		xxx = xxx + parseInt( $(this).attr('width') );
	});
	$('#topScroll .calc-table-style').css( 'width', xxx + 'px' );
	$('.colgroupAcc .calc-table-style').css( 'width', xxx + 'px' );

});
</script>

<!-- 페이지 타이틀 바 : 시작 -->
<div id="page-title-bar-area">
	<div id="page-title-bar">
		<!-- 타이틀 -->
		<div class="page-title">
			<h2>주문별 정산</h2>
		</div>		
	</div>
</div>
<!-- 페이지 타이틀 바 : 끝 -->


<!-- 서브 레이아웃 영역 : 시작 -->
<!-- 리스트검색폼 : 시작 -->
<div id="search_container" class="search_container">
	<input type="hidden" name="carry_total_count" id="carry_total_count" value="<?php echo $TPL_VAR["carryoverloopcnt"]?>"/>
	<input type="hidden" name="carry_page" id="carry_page" value="<?php echo $TPL_VAR["carry_page"]?>"/>
	<input type="hidden" name="carry_last_num" id="carry_last_num" value="0"/>
	<input type="hidden" name="current_total_count" id="current_total_count" value="<?php echo $TPL_VAR["loopcnt"]?>"/>
	<input type="hidden" name="current_page" id="current_page" value="<?php echo $TPL_VAR["current_page"]?>"/>
	<input type="hidden" name="current_last_num" id="current_last_num" value="0"/>

	<form name="accountsearch" id="accountsearch"  class="search_form">
<?php if($TPL_VAR["sc"]['debug']){?><input type="hidden" name="debug" value="<?php echo $TPL_VAR["sc"]['debug']?>"><?php }?>
	<input type="hidden" name="perpage" id="perpage" value="<?php echo $TPL_VAR["perpage"]?>"/>
	<table class="table_search">
		<tr>
			<th>기간</th>
			<td>
				<select name="s_year" class="wx80" defaultValue="<?php echo date('Y')?>">
<?php if($TPL_year_1){foreach($TPL_VAR["year"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1?>" ><?php echo $TPL_V1?></option>
<?php }}?>
				</select>
				<select name="s_month" class="wx80" defaultValue="<?php echo date('m')?>">
<?php if($TPL_month_1){foreach($TPL_VAR["month"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1?>"  ><?php echo $TPL_V1?></option>
<?php }}?>
				</select>

<?php if($TPL_VAR["sc"]['debug']){?>
				&nbsp;&nbsp;&nbsp;
				<label>
					<input type="radio" name="s_month_gubun" value="all"  > 전체
				</label>
				<label>
					<input type="radio" name="s_month_gubun" value="before" > 이월
				</label>
				<label>
					<input type="radio" name="s_month_gubun" value="present"> 당월
				</label>
<?php }?>
			</td>
		</tr>

		<tr>
			<th>입점사명</th>
			<td>			
				<select name="provider_seq_selector" style="vertical-align:middle;">
				</select>
				<input type="hidden" class="provider_seq" name="provider_seq" value="<?php echo $TPL_VAR["sc"]["provider_seq"]?>" />
				<!--
				<select name="provider_seq_selector">
					<option value=""></option>
					<option value="all" >전체</option>
					<option value="1" >본사</option>
<?php if($TPL_provider_1){foreach($TPL_VAR["provider"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1["provider_seq"]?>" pay_period="<?php echo $TPL_V1["calcu_count"]?>"><?php echo $TPL_V1["provider_name"]?>(<?php echo $TPL_V1["provider_id"]?>)</option>
<?php }}?>
				</select>
				<input type="hidden" class="provider_seq" name="provider_seq" value="<?php echo $TPL_VAR["sc"]["provider_seq"]?>" />				
				-->
			</td>
		</tr>

		<tr>
			<th>주문/환불 번호</th>
			<td>
				<input type="hidden" name="order_referer" id="order_referer" value="" size="20">
				<input type="text" name="search_seq" value="<?php echo $TPL_VAR["sc"]["search_seq"]?>" size="30" >
				<!--label > <input type="checkbox" name="account_hidden_name" value="hidden" <?php if($TPL_VAR["sc"]["account_hidden_name"]){?> checked="checked" <?php }?>>기본숨김</label>
				<label > <input type="checkbox" name="account_hidden_cal" value="hidden" <?php if($TPL_VAR["sc"]["account_hidden_cal"]){?> checked="checked" <?php }?>>정산숨김</label>
				<label > <input type="checkbox" name="account_hidden_sales" value="hidden" <?php if($TPL_VAR["sc"]["account_hidden_sales"]){?> checked="checked" <?php }?>>매출숨김</label-->
			</td>
		</tr>

<?php if($TPL_VAR["sc"]['debug']){?>
		<tr>
			<th>
				주문/환불/구매확정
			</th>
			<td class="its-td tl">
				<label><input type="checkbox" name="s_month_order" value="y"> 주문건만 보기</label>
				<label><input type="checkbox" name="s_confirm_order" value="y"> 구매확정건만 보기</label>
				<label><input type="checkbox" name="s_refund_order" value="y" > 환불건만 보기</label>
				<label><input type="checkbox" name="s_shipping_order" value="y"> 배송비만 보기</label>
				<label><input type="checkbox" name="s_confirm_err" value="y"> 구매확정-미정산</label>
			</td>
		</tr>
<?php }?>

		<tr>
			<th id="open_checker_tool" data-cnt="0">결제 및 주문 경로</th>
			<td>
				<div class="resp_checkbox">
					<div class="resp_radio">
					<label><input type="checkbox" name="order_referer[]" value="all" class="chkall" /> 전체 </label>
					<label><input type="checkbox" name="order_referer[]" value="shop" /> 무통장 </label>
					<label><input type="checkbox" name="order_referer[]" value="pg" /> PG </label>
					<label><input type="checkbox" name="order_referer[]" value="kakaopay" /> 카카오페이 </label>
					<label><input type="checkbox" name="order_referer[]" value="npay" /> 네이버페이 </label>
					<label><input type="checkbox" name="order_referer[]" value="talkbuy" /> 카카오페이 구매 </label>
					<label><input type="checkbox" name="order_referer[]" value="storefarm"  /> 스마트스토어 </label>
					<label><input type="checkbox" name="order_referer[]" value="open11st" /> 11번가 </label>
					<label><input type="checkbox" name="order_referer[]" value="coupang"  /> 쿠팡 </label>
					<label><input type="checkbox" name="order_referer[]" value="shoplinker" /> 샵링커 </label>
				</div>

				</div>
			</td>
		</tr>
<?php if($TPL_VAR["checker_tool"]){?>
		<tr>
			<th>
				검산툴 활성화
			</th>
			<td>
				<label><input type="checkbox" name="checker_tool" value="1" checked/> 검산툴 유지 </label>
				<label><input type="checkbox" name="checker_tool_view_succ" value="1"/> 정상데이터 보기&수정 </label>
				<br>
				<div id="btn_checker_tool" class="resp_btn active size_M">검산툴 실행</div>
				<div id="btn_check_result_download" class="resp_btn active size_M">검산오류 다운로드</div>
				<div>
					검산툴 진행도 (현재수/로드된수/전체수)
					<div>
					이월 : <span id="checker_tool_carry_now_cnt">0</span> / <span id="checker_tool_carry_load_cnt">0</span> / <span id="checker_tool_carry_total_cnt">0</span>
					</div>
					<div>
					당월 : <span id="checker_tool_current_now_cnt">0</span> / <span id="checker_tool_current_load_cnt">0</span> / <span id="checker_tool_current_total_cnt">0</span>
					</div>
				</div>
			</td>
		</tr>
<?php }?>
	</table>

	<div class="footer search_btn_lay"></div>
	</form>
</div>

<div class="contents_dvs v2">
<?php if($TPL_VAR["sc"]["provider_seq"]&&$TPL_VAR["sc"]["provider_seq"]!="all"&&$TPL_VAR["sc"]["provider_seq"]!="1"){?>
	
	<div class="seller_account_dvs">
		<ul class="ul_list_04">
			<li>
				<dl class="dl_list_01 v3">
					<dt>입점사명</dt>
					<dd class="fx14"><?php echo $TPL_VAR["provider_viewer"]["provider_name"]?></dd>
				</dl>
			</li>

			<li>
				<dl class="dl_list_01 v3">
					<dt>정산 주기</dt>
					<dd class="fx14">월 <?php echo $TPL_VAR["provider"][$TPL_VAR["provider_viewer"]["provider_seq"]]["calcu_count"]?>회 정산</dd>
				</dl>
			</li>
			
			<li>
				<dl class="dl_list_01 v3">
					<dt>정산 금액</dt>
					<dd>
<?php if($TPL_VAR["accountAllCount"][$TPL_VAR["provider_viewer"]["provider_id"]]["calcu_count"]=='2'){?>
							01일 ~ 15일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account2"][ 0])?></span>원) <br />
							16일 ~ 말일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account2"][ 1])?></span>원)
<?php }elseif($TPL_VAR["accountAllCount"][$TPL_VAR["provider_viewer"]["provider_id"]]["calcu_count"]=='4'){?>
							01일 ~ 07일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account4"][ 0])?></span>원) <br />
							08일 ~ 14일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account4"][ 1])?></span>원) <br />
							15일 ~ 21일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account4"][ 2])?></span>원) <br />
							22일 ~ 말일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account4"][ 3])?></span>원)
<?php }else{?>
							01일 ~ 말일 (<span class="blue"><?php echo number_format($TPL_VAR["accountAllCount"]["account1"][ 0])?></span>원)
<?php }?>
					</dd>
				</dl>
			</li>
		</ul>
	</div>
<?php }?>
	<div class="table_row_frame">
		<div class="dvs_top">			
			<div class="dvs_left">	
				<span class="confirm_setting_date">
<?php if($TPL_VAR["accountConfirm"]){?>
					<?php echo $TPL_VAR["sc"]["s_year"]?>년 <?php echo $TPL_VAR["sc"]["s_month"]?>월 정산마감일 : <?php echo $TPL_VAR["accountConfirm"]["confirm_name"]?>(<?php echo $TPL_VAR["accountConfirm"]["confirm_end_date"]?> 마감실행)
<?php }else{?>
					<?php echo $TPL_VAR["sc"]["s_year"]?>년 <?php echo $TPL_VAR["sc"]["s_month"]?>월 정산마감일 : <?php echo $TPL_VAR["accountallConfirmSetting"]["confirm_name"]?>(<?php echo $TPL_VAR["accountallConfirmSetting"]["confirm_date"]?> <font color="red">마감실행예정</font>)
<?php }?>
				</span>				
			</div>

			<div class="dvs_right">	
				<span class="mr5">* 부가세(VAT) 포함</span>
<?php if($TPL_VAR["loopcnt"]> 0||$TPL_VAR["carryoverloopcnt"]> 0||$TPL_VAR["overdrawloopcnt"]> 0){?>
				<button type="button" onclick="accountlallExcel()" class="resp_btn v3"><span class="icon_excel"></span> 다운로드</button>
<?php }else{?>
				<button type="button" onclick="openDialogAlert('조회내역이 없습니다',300,180);"  class="resp_btn v3"><span class="icon_excel"></span> 다운로드</button>
<?php }?>
			</div>
		</div>

		<ul class="scroll_container">	
			<?php 
			// 페이징 기능이 추가됨에 따라 동일한 소스가 여러번 반복 되어 통일함 by hed
			 $TPL_VAR["sale_table_colgroup"] = '
				<!-- 테이블 헤더 : 시작 -->
				<colgroup>
					<!--col width="50" /--><!--발생월-->
					<col width="90" /><!--순번-->
					<col width="120" /><!--발생일<br />(결제/취소/환불)-->
					<col width="140" /><!--완료일<br />(구매확정/취소/환불일)-->
					<col width="150" /><!--주문/취소/환불 번호-->
					'.((!sc.account_hidden_name)?'
						<col width="80" /><!--구매자-->
						<col width="130" /><!--입점사-->
						<col width="130" /><!--상품/배송비/반품배송비-->
						':'').'
				</colgroup>
			';
			?>
			
			<li id="account_table" class="account_left account_table" style="opacity:1; position:relative; height:<?php echo $TPL_VAR["tableheight"]?>px;">
				<div class="left_scroll_wrap">
					<div class="account-table-grid-left-header account-table-header-scrollbar">
					<table width="100%" class="calc-left-table-style" cellpadding="0" cellspacing="0">
						<!-- 테이블 헤더 : 시작 -->
						<?php echo $TPL_VAR["sale_table_colgroup"]?>

						<thead>
							<tr>
								<!--th scope="col" rowspan="2">발생월</th-->
								<th scope="col" rowspan="2">순번</th>
								<th scope="col" rowspan="2">발 생 일<br />(결제/취소/환불)</th>
								<th scope="col" rowspan="2">완 료 일<br />(구매확정/취소/환불)</th>
								<th scope="col" rowspan="2">주문/환불 번호</th>
<?php if(!$TPL_VAR["sc"]["account_hidden_name"]){?>
								<th scope="col" rowspan="2">구매자</th>
								<th scope="col" rowspan="2">입점사</th>
								<th scope="col" rowspan="2">상품명/배송비/반품배송비</th>
<?php }?>
							</tr>
							<tr>
							</tr>
						</thead>
					</table>
					</div>
			  	</div>
				<div class="left_scroll_wrap"><!-- 180702 추가 -->
					<div class="account-table-grid-left-body listCarryScroll" style="height:<?php echo $TPL_VAR["tableheight_carry"]?>px;">
						<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
							<!-- 테이블 헤더 : 시작 -->
							<?php echo $TPL_VAR["sale_table_colgroup"]?>

							<tbody id="list_sale_carry">						
<?php if($TPL_VAR["carryoverloopcnt"]){?>

<?php }else{?>
									<tr>
										<td colspan="<?php if($TPL_VAR["sc"]["account_hidden_name"]){?>4<?php }else{?>7<?php }?>" class="right pdr20 nodata bd_bt_4">이월 조회 내역이 없습니다.</td>
									</tr>
<?php }?>
							</tbody>
						</table>
					</div>
					<div class="account-table-grid-left-body summryScroll">
						<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
							<!-- 테이블 헤더 : 시작 -->
							<?php echo $TPL_VAR["sale_table_colgroup"]?>

							<tbody>
<?php if($TPL_VAR["carryoverloopcnt"]){?>
									<tr class="its_tr_looptotal">
										<td colspan="<?php if($TPL_VAR["sc"]["account_hidden_name"]){?>4<?php }else{?>7<?php }?>" class="right pdr20 bd_bt_4">합계</td>
									</tr>
<?php }?>
							</tbody>
						</table>
					</div>
					<div class="account-table-grid-left-body listCurrentScroll" style="height:<?php echo $TPL_VAR["tableheight_current"]?>px;">
						<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
							<!-- 테이블 헤더 : 시작 -->
							<?php echo $TPL_VAR["sale_table_colgroup"]?>

							<tbody id="list_sale_current">
<?php if($TPL_VAR["loopcnt"]){?>
<?php }else{?>
									<tr>
										<td colspan="<?php if($TPL_VAR["sc"]["account_hidden_name"]){?>4<?php }else{?>7<?php }?>" class="right pdr20 nodata">당월 조회 내역이 없습니다.</td>
									</tr>
<?php }?>
							</tbody>
						</table>
					</div>
					<div class="account-table-grid-left-body summryScroll">
						<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
							<!-- 테이블 헤더 : 시작 -->
							<?php echo $TPL_VAR["sale_table_colgroup"]?>

							<tbody>
<?php if($TPL_VAR["loopcnt"]){?>
									<tr  class="its_tr_looptotal">
										<td colspan="<?php if($TPL_VAR["sc"]["account_hidden_name"]){?>4<?php }else{?>7<?php }?>" class="right pdr20">합계</td>
									</tr>
<?php }?>
								<tr class="its_tr_loopname">
									<td colspan="<?php if($TPL_VAR["sc"]["account_hidden_name"]){?>4<?php }else{?>7<?php }?>"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</li>

			<?php 
			// 페이징 기능이 추가됨에 따라 동일한 소스가 여러번 반복 되어 통일함 by hed
			 $TPL_VAR["acc_table_colgroup"] = '
				<!-- 테이블 헤더 : 시작 -->
				<colgroup>
				'.((!sc.account_hidden_sales)?'
					<col width="50" /><!--판매수량-->
					<col width="80" /><!--판매금액-->
					<col width="80" /><!--할인-본사-->
					<col width="80" /><!--할인-제휴사-->
					<col width="80" /><!--할인-입점사-->
					<col width="80" /><!--결제금액(매출액)(A)-->
					<col width="80" /><!--실결제액-->
					<col width="80" /><!--예치금-->
				':'').'
				'.((!sc.account_hidden_cal)?'
					<col width="50" /><!--정산수량-->
					<col width="80" /><!--정산대상(수수료방식)-->
					<col width="80" /><!--정산대상(수수료방식)-결제금액-->
					<col width="80" /><!--정산대상(수수료방식)-본사-->
					<col width="80" /><!--정산대상(수수료방식)-제휴사-->
					<col width="80" /><!--정산대상(공급가방식)-->
					<col width="80" /><!--수수료율(%)-->
					<col width="80" /><!--수수료-->
					<col width="80" /><!--정산금액(B)-->
					<col width="80" /><!--이익금액(C)-(C)=(A)-(B)-->
					<col width="80" /><!--이익금액(C)-이익율(%)-->
					<col width="80" style="display:none;" /><!--매입가-->
				':'').'
					<col width="180" /><!--제휴사(PG)<br/>주문번호-->
					<col width="100" /><!--주문경로-->
					<col width="100" /><!--결제수단-->
				</colgroup>
			';
			?>
			<li id="account_table" class="account_right account_table" style="opacity:1; position:relative; height:<?php echo $TPL_VAR["tableheight"]?>px;">
			  <div class="account-table-grid-right-header account-table-header-scrollbar colgroupAcc" id="topScroll">
				<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
					<!-- 테이블 헤더 : 시작 -->
					<?php echo $TPL_VAR["acc_table_colgroup"]?>

					<thead>
						<tr>
<?php if(!$TPL_VAR["sc"]["account_hidden_sales"]){?>
							<th scope="col" rowspan="2">판매<br/>수량</th>
							<th scope="col" rowspan="2" style="font-weight:bold;">판매금액</th>
							<th scope="col" colspan="3">할인</th>
							<th scope="col" colspan="3" class="nobottom" style="font-weight:bold;">결제금액(매출액)(A)</th>
<?php }?>
<?php if(!$TPL_VAR["sc"]["account_hidden_cal"]){?>
							<th scope="col" rowspan="2">정산<br/>수량</th>
							<th scope="col" colspan="4" class="nobottom" style="font-weight:bold;">
								정산대상(수수료방식)
								<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/accountall', '#tip1')"></span>
								<div id="SACO_info_dialog" class="hide">
									주문된 금액에서 입점사와 무관하게 본사 정책에 따라 할인된<br/>
									금액을 합산한 정산을 위한 기준 금액
								</div>
							</th>
							<th scope="col" rowspan="2" style="font-weight:bold;">
								정산대상<br/>
								(<span style="color:blue;">공급가 방식</span>)
								<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/accountall', '#tip2')"></span>
								<div id="SUPPLY_info_dialog" class="hide">
									정산대상 (공급가 방식) : 입점사에 지급하는 금액을 정가에 대한 비율(%) 또는 지급하는 금액을 직접 등록한 정산을 위한 기준금액
								</div>
							</th>
							<th scope="col" rowspan="2" style="font-weight:bold;">
								수수료율(%)<br/>
								(<span style="color:blue;">공급률(%)</span>)
							</th>
							<th scope="col" rowspan="2">수수료</th>
							<th scope="col" rowspan="2" style="font-weight:bold;">정산금액(B)</th>
							<th scope="col" colspan="2" class="nobottom" style="font-weight:bold;">이익금액(C)</th>
							<th scope="col" rowspan="2" style="display:none;">매입가</th>
<?php }?>
							<th scope="col" rowspan="2">제휴사(PG)<br/>주문번호</th>
							<th scope="col" rowspan="2">주문경로</th>
							<th scope="col" rowspan="2">결제수단</th>
						</tr>

						<tr>
<?php if(!$TPL_VAR["sc"]["account_hidden_sales"]){?>
							<th scope="col">본사</th>
							<th scope="col">제휴사</th>
							<th scope="col">입점사</th>
							<th scope="col"></th>
							<th scope="col" class="bordertop">실결제액</th>
							<th scope="col" class="bordertop">예치금</th>
<?php }?>
<?php if(!$TPL_VAR["sc"]["account_hidden_cal"]){?>
							<th scope="col"></th>
							<th scope="col" class="bordertop">결제금액</th>
							<th scope="col" class="bordertop">본사할인</th>
							<th scope="col" class="bordertop">제휴사할인</th>
							<th scope="col">(C)=(A)-(B)</th>
							<th scope="col" class="bordertop">이익율(%)</th>
<?php }?>
						</tr>
					</thead>
				</table>
			  </div>
			  <div class="account-table-grid-right-body listCarryScroll colgroupAcc" style="height:<?php echo $TPL_VAR["tableheight_carry"]?>px;">
				<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
					<!-- 테이블 헤더 : 시작 -->
					<?php echo $TPL_VAR["acc_table_colgroup"]?>

					<tbody id="list_acc_carry">
<?php if($TPL_VAR["carryoverloopcnt"]){?>
<?php }else{?>
							<tr>
								<td colspan="<?php echo ($TPL_VAR["totalcolspan"]- 8)?>" class="nodata bd_bt_4"><!-- 조회 내역이 없습니다. --></td>
							</tr>
<?php }?>
					</tbody>
				</table>
			  </div>
			  <div class="account-table-grid-right-body summryScroll colgroupAcc">
				<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
					<!-- 테이블 헤더 : 시작 -->
					<?php echo $TPL_VAR["acc_table_colgroup"]?>

					<tbody>
<?php if($TPL_VAR["carryoverloopcnt"]){?>
							<tr class="its_tr_looptotal">
<?php if(!$TPL_VAR["sc"]["account_hidden_sales"]){?>
								<td class="bd_bt_4 acc_bg "><?php echo number_format($TPL_VAR["carryovertot"]["out_ea"]-$TPL_VAR["carryovertot"]["refund_out_ea"])?><!-- 수량 --></td>
								<td class="right bd_bt_4 acc_bg " style="font-size:13px;font-weight:bold;"><?php echo number_format($TPL_VAR["carryovertot"]["out_price"]-$TPL_VAR["carryovertot"]["refund_out_price"])?><!-- =<?php echo number_format($TPL_VAR["carryovertot"]["out_price"])?>-<?php echo $TPL_VAR["carryovertot"]["refund_out_price"]?> --><!-- 판매금액 --></td>
								<td class="right bd_bt_4 acc_bg "><?php echo number_format($TPL_VAR["carryovertot"]["out_salescost_admin"]-$TPL_VAR["carryovertot"]["refund_salescost_admin"])?><!-- 할인>본사 --></td>
								<td class="right bd_bt_4 acc_bg "><?php echo number_format($TPL_VAR["carryovertot"]["out_pg_sale_price"]-$TPL_VAR["carryovertot"]["refund_pg_sale_price"])?><!-- 할인>제휴사 --></td>
								<td class="right bd_bt_4 acc_bg "><?php echo number_format($TPL_VAR["carryovertot"]["out_salescost_provider"]-$TPL_VAR["carryovertot"]["refund_salescost_provider"])?><!-- 할인>입점사 --></td>
								<td class="right bd_bt_4 acc_bg " style="font-size:13px;font-weight:bold;"><?php echo number_format(($TPL_VAR["carryovertot"]["out_sale_price"]+$TPL_VAR["carryovertot"]["out_cash_use"])-($TPL_VAR["carryovertot"]["refund_out_sale_price"]+$TPL_VAR["carryovertot"]["refund_out_cash_use"]))?><!-- 결제금액(A) --></td>
								<td class="right bd_bt_4 acc_bg "><?php echo number_format($TPL_VAR["carryovertot"]["out_sale_price"]-$TPL_VAR["carryovertot"]["refund_out_sale_price"])?><!-- 실결제액 --></td>
								<td class="right bd_bt_4 acc_bg "><?php echo number_format($TPL_VAR["carryovertot"]["out_cash_use"]-$TPL_VAR["carryovertot"]["refund_out_cash_use"])?><!-- 이머니 --></td>
<?php }?>

<?php if(!$TPL_VAR["sc"]["account_hidden_cal"]){?>
								<td class="pdr20 <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg cal_left bd_bt_4"><?php echo number_format($TPL_VAR["carryovertot"]["out_exp_ea"]-$TPL_VAR["carryovertot"]["refund_out_exp_ea"])?>

								<!-- 정산수량 --></td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4" style="font-size:13px;font-weight:bold;"><?php echo number_format($TPL_VAR["carryovertot"]["out_total_ac_price"]-$TPL_VAR["carryovertot"]["refund_out_total_ac_price"])?>

								<!-- 정산대상(수수료방식) --></td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4"><?php echo number_format($TPL_VAR["carryovertot"]["out_pg_default_price"]-$TPL_VAR["carryovertot"]["refund_out_pg_default_price"])?>

								<!-- 정산대상(수수료방식)-결제금액 --></td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4">
									<!-- <?php echo number_format($TPL_VAR["carryovertot"]["out_ac_salescost_admin"]-$TPL_VAR["carryovertot"]["refund_out_ac_salescost_admin"])?> -->
									-
									<!-- 정산대상(수수료방식)-본사할인 -->
								</td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4">
									<!-- <?php echo number_format($TPL_VAR["carryovertot"]["out_ac_pg_price"]-$TPL_VAR["carryovertot"]["refund_out_out_ac_pg_price"])?> -->
									-
									<!-- 정산대상(수수료방식)-제휴사할인 -->
								</td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4"><?php echo number_format($TPL_VAR["carryovertot"]["out_ac_consumer_real_price"]-$TPL_VAR["carryovertot"]["refund_out_ac_consumer_real_price"])?>

								<!-- 정산대상(공급가방식) --></td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4">
									<!-- <?php if($TPL_VAR["carryovertot"]["out_ac_fee_rate"]!= 0){?><?php echo $TPL_VAR["carryovertot"]["out_ac_fee_rate"]?>%<?php }else{?>0<?php }?> -->
									-
									<!-- 수수료율(%) -->
								</td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg bd_bt_4"><?php echo number_format($TPL_VAR["carryovertot"]["out_sales_unit_feeprice"]-$TPL_VAR["carryovertot"]["refund_sales_unit_feeprice"])?>

								<!-- 수수료 -->
								</td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>cal_bottom<?php }?> cal_bg cal_right bd_bt_4" style="font-size:13px;font-weight:bold;"><?php echo number_format($TPL_VAR["carryovertot"]["out_commission_price"]-$TPL_VAR["carryovertot"]["refund_out_commission_price"])?>

									<!-- =<?php echo number_format($TPL_VAR["carryovertot"]["out_commission_price"])?>-<?php echo $TPL_VAR["carryovertot"]["refund_out_commission_price"]?> -->
									<!-- p><?php echo number_format(($TPL_VAR["carryovertot"]["out_sales_unit_feeprice"]-$TPL_VAR["carryovertot"]["refund_sales_unit_feeprice"])+$TPL_VAR["carryovertot"]["out_commission_price"]-$TPL_VAR["carryovertot"]["refund_out_commission_price"])?>

									</p -->
									<!--  -->
								<!-- 정산금액(B) --></td>
								<td class="right <?php if(!$TPL_VAR["loopcnt"]){?>profit_bottom<?php }?> profit_bg profit_left profit_right bd_bt_4" style="font-size:13px;font-weight:bold;"><?php echo number_format($TPL_VAR["carryovertot"]["out_ac_profit_price"]-$TPL_VAR["carryovertot"]["refund_out_ac_profit_price"])?>

								<!-- 이익금액(C)>(C)=(A)-(B) -->
								</td>
								<td class="right bd_bt_4"><?php if($TPL_VAR["carryovertot"]["out_ac_profit_rate"]!= 0){?><?php echo $TPL_VAR["carryovertot"]["out_ac_profit_rate"]?>%<?php }?>
								<!-- 이익금액(C)>이익율(%) -->
								</td>
								<td class="right bd_bt_4" style="display:none;">
								<!-- 매입가 -->
								</td>
<?php }?>
								<td class="bd_bt_4"></td>
								<td class="bd_bt_4"></td>
								<td class="bd_bt_4"></td>
							</tr>
<?php }?>
					</tbody>
				</table>
			  </div>
			  <div class="account-table-grid-right-body listCurrentScroll colgroupAcc" style="height:<?php echo $TPL_VAR["tableheight_current"]?>px;">
				<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
					<!-- 테이블 헤더 : 시작 -->
					<?php echo $TPL_VAR["acc_table_colgroup"]?>

					<tbody id="list_acc_current">
<?php if($TPL_VAR["loopcnt"]){?>
<?php }else{?>
							<tr>
								<td colspan="<?php echo ($TPL_VAR["totalcolspan"]- 8)?>" class="nodata"><!-- 조회 내역이 없습니다. --></td>
							</tr>
<?php }?>
					</tbody>
				</table>
			  </div>
			  <div class="account-table-grid-right-body summryScroll colgroupAcc">
				<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
					<!-- 테이블 헤더 : 시작 -->
					<?php echo $TPL_VAR["acc_table_colgroup"]?>

					<tbody>
<?php if($TPL_VAR["loopcnt"]){?>
							<tr class="its_tr_looptotal">
<?php if(!$TPL_VAR["sc"]["account_hidden_sales"]){?>
								<td  class="<?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_left acc_bg"><?php echo number_format($TPL_VAR["tot"]["out_ea"]-$TPL_VAR["tot"]["refund_out_ea"])?><!-- 수량 --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg " style="font-size:13px; font-weight:bolder;"><?php echo number_format($TPL_VAR["tot"]["out_price"]-$TPL_VAR["tot"]["refund_out_price"])?>

								<!--=<?php echo number_format($TPL_VAR["tot"]["out_price"])?>-<?php echo $TPL_VAR["tot"]["refund_out_price"]?>  --><!-- 판매금액 --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg"><?php echo number_format($TPL_VAR["tot"]["out_salescost_admin"]-$TPL_VAR["tot"]["refund_salescost_admin"])?><!-- 할인>본사 --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg"><?php echo number_format($TPL_VAR["tot"]["out_pg_sale_price"]-$TPL_VAR["tot"]["refund_pg_sale_price"])?><!-- 할인>제휴사 --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg"><?php echo number_format($TPL_VAR["tot"]["out_salescost_provider"]-$TPL_VAR["tot"]["refund_salescost_provider"])?><!-- 할인>입점사 --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg" style="font-size:13px; font-weight:bolder;"><?php echo number_format(($TPL_VAR["tot"]["out_sale_price"]+$TPL_VAR["tot"]["out_cash_use"])-($TPL_VAR["tot"]["refund_out_sale_price"]+$TPL_VAR["tot"]["refund_out_cash_use"]))?><!-- 결제금액(A) --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg"><?php echo number_format($TPL_VAR["tot"]["out_sale_price"]-$TPL_VAR["tot"]["refund_out_sale_price"])?><!-- 실결제액 --></td>
								<td class="right <?php if(!$TPL_VAR["overdrawloopcnt"]){?>acc_bottom<?php }?> acc_bg acc_right"><?php echo number_format($TPL_VAR["tot"]["out_cash_use"]-$TPL_VAR["tot"]["refund_out_cash_use"])?><!-- 이머니 --></td>
<?php }?>
<?php if(!$TPL_VAR["sc"]["account_hidden_cal"]){?>
								<td class="cal_bottom cal_bg cal_left"><?php echo number_format($TPL_VAR["alltot"]["ac_out_exp_ea"])?>

								<!-- 정산수량 --></td>
								<td class="right cal_bottom cal_bg" style="font-size:13px; font-weight:bolder;"><?php echo number_format($TPL_VAR["alltot"]["ac_out_total_ac_price"])?>

								<!-- 정산대상(수수료방식) --></td>
								<td class="right cal_bottom cal_bg"><?php echo number_format($TPL_VAR["alltot"]["ac_out_pg_default_price"])?>

								<!-- 정산대상(수수료방식)-결제금액 --></td>
								<td class="right cal_bottom cal_bg">
									<!-- <?php echo number_format($TPL_VAR["alltot"]["ac_out_salescost_admin"])?> -->
									-
									<!-- 정산대상(수수료방식)-본사할인 -->
								</td>
								<td class="right cal_bottom cal_bg">
									<!-- <?php echo number_format($TPL_VAR["alltot"]["ac_out_ac_pg_price"])?> -->
									-
									<!-- 정산대상(수수료방식)-제휴사할인 -->
								</td>
								<td class="right cal_bottom cal_bg"><?php echo number_format($TPL_VAR["alltot"]["ac_out_consumer_real_price"])?>

								<!-- 정산대상(공급가방식) --></td>
								<td class="right cal_bottom cal_bg">
									<!-- <?php if($TPL_VAR["alltot"]["ac_out_fee_rate"]!= 0){?><?php echo $TPL_VAR["alltot"]["ac_out_fee_rate"]?>%<?php }?> -->
									-
									<!-- 수수료율(%) -->
								</td>
								<td class="right cal_bottom cal_bg"><?php echo number_format($TPL_VAR["alltot"]["ac_out_sales_unit_feeprice"])?>

								<!-- 수수료 --></td>
								<td class="right cal_bottom cal_bg cal_right" style="font-size:13px; font-weight:bolder;"><?php echo number_format($TPL_VAR["alltot"]["ac_out_commission_price"])?><!-- =<?php echo number_format($TPL_VAR["tot"]["out_commission_price"])?>-<?php echo $TPL_VAR["tot"]["refund_out_commission_price"]?> -->
								<!-- p><?php echo number_format(($TPL_VAR["tot"]["out_sales_unit_feeprice"]-$TPL_VAR["tot"]["refund_sales_unit_feeprice"])+$TPL_VAR["tot"]["out_commission_price"]-$TPL_VAR["tot"]["refund_out_commission_price"])?></p -->
								<!-- 정산금액(B) --></td>
								<td class="right profit_bottom profit_bg profit_left profit_right" style="font-size:13px; font-weight:bolder;"><?php echo number_format($TPL_VAR["alltot"]["ac_out_profit_price"])?>

								<!-- 이익금액(C)>(C)=(A)-(B) --></td>
								<td class="right"><?php if($TPL_VAR["alltot"]["ac_out_profit_rate"]!= 0){?><?php echo $TPL_VAR["alltot"]["ac_out_profit_rate"]?>%<?php }?>
								<!-- 이익금액(C)>이익율(%) --></td>
								<td class="right" style="display:none;">
								<!-- 매입가 --></td>
<?php }?>
								<td></td>
								<td></td>
								<td></td>
							</tr>
<?php }?>
					</tbody>
				</table>
			  </div>
			  <div class="account-table-grid-right-body summryScroll colgroupAcc">
				<table width="100%" class="calc-table-style" cellpadding="0" cellspacing="0">
					<!-- 테이블 헤더 : 시작 -->
					<?php echo $TPL_VAR["acc_table_colgroup"]?>

					<tbody>
						<tr class="its_tr_loopname">
<?php if(!$TPL_VAR["sc"]["account_hidden_sales"]){?>
							<td colspan="8" class="acc_name acc_bottom acc_left acc_right">당월 판매 합계</td>
<?php }?>
<?php if(!$TPL_VAR["sc"]["account_hidden_cal"]){?>
							<td colspan="9" class="cal_name cal_bottom cal_left cal_right">당월 정산 합계</td>
							<td class="profit_name profit_bottom profit_left profit_right">이익 합계</td>
<?php }?>
							<td colspan="4"></td>
						</tr>
					</tbody>
				</table>
			  </div>
			</li>
		</ul>
	</div>
</div>

<div class="box_style_05">
	<div class="title">안내</div>
	<ul class="bullet_hyphen">					
		<li>주문별 정산 페이지 상세 안내 <a href="https://www.firstmall.kr/customer/faq/1247" target="_blank" class="resp_btn_txt">자세히 보기</a></li>		
		<li>정산을 위한 마감일 설정은  <a href="/admin/accountall/accountall_setting" target="_blank" class="resp_btn_txt">정산 마감일</a> 설정에서 가능합니다.</li>		
	</ul>
</div>
<!-- 서브 레이아웃 영역 : 끝 -->


<?php $this->print_("layout_footer",$TPL_SCP,1);?>