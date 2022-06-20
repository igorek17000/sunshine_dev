/**
 * mypage 에서 사용되는 스크립트
 * 스킨 상관없이 호출하여 사용함
 * 스킨 분기는 gl_operation_type , gl_mobile_mode 로 체킹함
 * added by hyem 2021-06-11
 */
$(document).ready(function(){
	$(".taxBtn").on('click',function(){
		var tax_seq = $(this).attr("tax_seq");
		var order_seq = $(this).attr("order_seq");
		$.ajax({
			url: '../mypage/taxwrite',
			type : 'post',
			dataType: 'json',
			data : {'order_seq':order_seq, 'tax_seq':tax_seq, 'request_mode':'js'},
			success: function(data) {
				if(data.result == false) {
					openDialogAlert(data.msg,'400','140',function(){});
				} else {
					if(gl_operation_type == 'light') {
						$('#tax_bill .layer_pop_contents').html(data.taxwrite);
						showCenterLayer('#tax_bill');
					} else {
						$('#taxlay').html(data.taxwrite);
						//세금계산서 <span class='desc'>세금계산서를 신청합니다.</span>
						openDialog(getAlert('mo122'), "taxlay", {"width":"700","height":"600"});
					}
				}
				
			}
		});
	});

	$(".taxDellBtn").on('click',function(){
		var tax_seq = $(this).attr("tax_seq");
		var order_seq = $(this).attr("order_seq");
		//정말로 삭제하시겠습니까?
		if(confirm(getAlert('mo138'))) {
			$.ajax({
				url: '../sales_process/taxdelete',
				type : 'post',
				dataType: 'json',
				data : {'order_seq':order_seq, 'tax_seq':tax_seq},
				success: function(data) {
					if(data) {
						if(data.result == true){
							openDialogAlert(data.msg,'400','140',function(){document.location.reload();});
						}else{
							openDialogAlert(data.msg,'400','140',function(){});
						}
					}else{
						//잘못된 접근입니다.
						openDialogAlert(getAlert('mo139'),'400','140',function(){});
					}
				}
			});
		}
	});
});

/**
 * 세금계산서 신청 후 종료
 */
function taxlayerclose(){
	$('#taxlay').dialog('close');
}