<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/selleradmin/skin/default/excel/_gl_excel_download.html 000003553 */ ?>
<script>
$(function(){

	// 다운로드 항목 설정
	$(".btn_download_item").on("click",function(){
		var mode = 'GOODS';
		if("<?php echo $TPL_VAR["socialcpuse"]?>" == "1") {
			mode = "COUPONS";
		}
		var downloadType = $("#lay_excel_down input[name='download_type']:checked").val();
        $.ajax({
            'url' : '/selleradmin/excel_spout/excel_download_setting',
            'data' : {'mode':'GOODS','downloadType':downloadType},
            'type' : 'get',
            'dataType': 'html',
            'success' : function(res){
                $("#lay_download_config").html(res);
                openDialog("다운로드 항목 설정", "lay_download_config", {"width":"600","height":"740","show" : "fade","hide" : "fade"});
            }
        }); 
   }) ;
   
   $("button[name='btn_excel_download']").on('click',function(){
        var mode = $("input[name='download_type']:checked").val();
        excel_down(mode);
    });

    /*
    $("input:radio[name='excel_type']").on('click',function(){
        if($(this).val() == "search"){
            $(".downloadType label").eq(0).find('span').html('검색한');
        }else{
            $(".downloadType label").eq(0).find('span').html('선택한');
        }
    });
    */
    
    $("input:radio[name='download_type']").on('click',function(){
        if($(this).val() == "barcode"){
            $("button.btn_download_item").closest("tr").hide();
        }else{
            $("button.btn_download_item").closest("tr").show();
        }
    });
}) ;
</script>

<div id="lay_excel_down" class="hide">
	<table class="table_basic thl">
	<tr>
		<th>다운로드 범위</th>
		<td>
			<div class="resp_radio">
				<label><input type="radio" name="excel_type" value="search" checked />검색 상품 (<span class="search_count"><?php echo number_format($TPL_VAR["page"]["searchcount"])?></span>개)</label>
				<label><input type="radio" name="excel_type" value="select"/>선택 상품 (<span class="select_count"></span>개)</label>					
			</div>
		</td>	
	</tr>
	<tr>
		<th>다운로드 유형</th>
		<td>
			<div class="resp_radio">
				<label><input type="radio" name="download_type" value="new" checked />상품 다운로드</label>
				<label><input type="radio" name="download_type" value="barcode"/>바코드 다운로드</label>					
				<label><input type="radio" name="download_type" value="old"/>(구) 다운로드</label>
			</div>
		</td>	
	</tr>
	<tr>
		<th>다운로드 항목 설정</th>
		<td><button type="button" class="resp_btn active btn_download_item" data-download_type='goods'>항목 설정</button></td>	
	</tr>
	</table>
	<div class="box_style_05 mt20">
		<div class="title">안내</div>
		<ul class="bullet_hyphen">					
			<li>엑셀 다운로드 내역은 <a href="/selleradmin/excel_spout/excel_download?category=1" target="_blank" class="resp_btn_txt">엑셀 다운로드</a>에서 확인할 수 있습니다</li>		
			<li>설명용 샘플 <span class="resp_btn_txt pointer btn_sample_down">엑셀 다운로드</span></li>		
		</ul>
	</div>
	<div class="mt20 center">
		<button type="button" name='btn_excel_download' class="resp_btn active size_XL">다운로드</button>
		<button type="button" class="resp_btn v3 size_XL btn_close" data-layId='lay_excel_down'>취소</button>
	</div>
</div>
<div id="lay_download_config"></div>