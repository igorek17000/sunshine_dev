<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/popup/zipcode.html 000014588 */ 
$TPL__GET_1=empty($_GET)||!is_array($_GET)?0:count($_GET);
$TPL_arrSido_1=empty($TPL_VAR["arrSido"])||!is_array($TPL_VAR["arrSido"])?0:count($TPL_VAR["arrSido"]);
$TPL_arrSigungu_1=empty($TPL_VAR["arrSigungu"])||!is_array($TPL_VAR["arrSigungu"])?0:count($TPL_VAR["arrSigungu"]);
$TPL_loop_1=empty($TPL_VAR["loop"])||!is_array($TPL_VAR["loop"])?0:count($TPL_VAR["loop"]);?>
<script type="text/javascript">
function getZipcodeResult(zipcodeFlag,page){
	var url = '/admin/popup/zipcode';
	$.get(url,{'keyword':$(':input[name=zipcode_keyword]',$("#<?php echo $TPL_VAR["zipcodeFlag"]?>Id<?php echo $_GET["goodsoption"]?>")).val(),'SIDO':$("select[name='SIDO']",$("#<?php echo $TPL_VAR["zipcodeFlag"]?>Id")).val(),'SIGUNGU':$("select[name='SIGUNGU']",$("#<?php echo $TPL_VAR["zipcodeFlag"]?>Id")).val(), 'zipcodeFlag':zipcodeFlag, 'page':page, 'idx':'<?php echo $_GET["idx"]?>', 'goodsoption':'<?php echo $_GET["goodsoption"]?>','zipcode_type':'<?php echo $TPL_VAR["zipcode_type"]?>','zipcode':'<?php echo $_GET["zipcode"]?>'} , function(data) {
		$("#"+zipcodeFlag+"Id<?php echo $_GET["goodsoption"]?>").html(data);
		if($(".zsfText").val()) $(".zsfText").addClass("on");
	});
}

function enterchk(){
	if(event.keyCode==13){
		getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>',1);
		event.returnValue=false;
	}
}


$(document).ready(function() {
	$('.zsfText').focusin(function(){		
		$(this).addClass("on");
	});

	$('.zsfText').focusout(function(){	
		if(!$(this).val()) $(this).removeClass("on");		
	});

	$("#zipcodeSearchButton",$("#<?php echo $TPL_VAR["zipcodeFlag"]?>Id<?php echo $_GET["goodsoption"]?>")).bind("click",function(){
		
		getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>',1);
				
	});

	$(".zipcodeResult",$("#<?php echo $TPL_VAR["zipcodeFlag"]?>Id<?php echo $_GET["goodsoption"]?>")).bind("click",function(){
		var zip = $(this).find(".zipcode").html();
		zip = zip.replace("-", "");
<?php if($TPL_VAR["zipcodeFlag"]=='order_multi'){?>
		$(":input[name='recipient_address_type'][idx='<?php echo $_GET["idx"]?>']").val( "<?php echo $TPL_VAR["zipcode_type"]?>" );
		$(":input[name='recipient_address'][idx='<?php echo $_GET["idx"]?>']").val( $(this).find(".address").html() );
		$(":input[name='recipient_address_street'][idx='<?php echo $_GET["idx"]?>']").val( $(this).find(".address_street").html() );
		$(":input[name='recipient_zipcode[]'][idx='<?php echo $_GET["idx"]?>']").eq(0).val(zip);
<?php }elseif($TPL_VAR["zipcodeFlag"]=='windowLabel'||substr($TPL_VAR["zipcodeFlag"], 0, 11)=='windowLabel'){?>
			$(".windowLabelAddress_type<?php echo $_GET["idx"]?>").val( "<?php echo $TPL_VAR["zipcode_type"]?>" );
			$(".windowLabelAddress<?php echo $_GET["idx"]?>").val( $(this).find(".address").html() );
			$(".windowLabelAddress_street<?php echo $_GET["idx"]?>").val( $(this).find(".address_street").html() );
			$(".windowLabelZipcode1<?php echo $_GET["idx"]?>").val(zip);

<?php }elseif(preg_match('/_/',$TPL_VAR["zipcodeFlag"])){?>
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>address_type']").val( "<?php echo $TPL_VAR["zipcode_type"]?>" );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>address']").val( $(this).find(".address").html() );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>address_street']").val( $(this).find(".address_street").html() );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>zipcode'],:input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>zipcode[]']").val(zip);
<?php }elseif($TPL_VAR["zipcodeFlag"]=='zone'){?>
		// 배송지 장소리스트 등록 :: 2016-06-07 lwh
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address_type']").val( "<?php echo $TPL_VAR["zipcode_type"]?>" );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address']").val( $(this).find(".address").html() );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address_street']").val( $(this).find(".address_street").html() );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Zipcode[]']").eq(0).val(zip);
<?php if($TPL_VAR["zipcode_type"]=='street'){?>
			$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address_street']").show();
			$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address']").hide();
<?php }else{?>
			$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address_street']").hide();
			$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address']").show();
<?php }?>
<?php }else{?>
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address_type']").val( "<?php echo $TPL_VAR["zipcode_type"]?>" );

		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address']").val( $(this).find(".address").html() );
		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Address_street']").val( $(this).find(".address_street").html() );

		$(":input[name='<?php echo $TPL_VAR["zipcodeFlag"]?>Zipcode[]']").eq(0).val(zip);

<?php }?>
<?php if($TPL_VAR["zipcodeFlag"]=="recipient_"){?>
			try{opener.order_price_calculate();}catch(e){};
			try{order_price_calculate();}catch(e){};
<?php }?>
		closeDialog('<?php echo $TPL_VAR["zipcodeFlag"]?>Id<?php echo $_GET["goodsoption"]?>')
	});
});

</script>
<style>

.tabs {*zoom:1; width:100%; display:table;}
.tabs li {display:table-cell; width:50%; font-size:15px; }
.tabs li a {display:block; text-align:center; padding:8px 0; background-color:#fff; color:#6b6b73; font-weight:600; border:1px solid #e7e7e7;}
.tabs li.on a { background-color:#4291f0; color:#FFF; border:1px solid #4291f0;}

.addr{font-size:15px; color:#41454b; letter-spacing:-0.5px; padding:15px; line-height:1.5;}
.addr_ex{font-size:13px; color:#aeaeae;}

.search_wrap {border:1px solid #d7d7d7; padding:17px 23px; border-radius:5px; }
.search_addr, .search_keyword{display:table; width:100%;}
.search_addr > li, .search_keyword > li{display:table-cell;}
.search_addr {margin-top:10px; }
.search_addr > li {width:50%;}
.search_addr > li:first-child{padding-right:5px;}
.search_addr > li:last-child{padding-left:5px;}
.search_keyword > li:last-child{width:75px;}
.search_wrap select{width:100%; background:#f2f2f2; height:43px; border-radius:0; border:0; font-size:15px; color:#41454b;}

.zipcodeResult {cursor:pointer; height:19px; line-height:19px;}
.zipcodeResult:hover {text-decoration:underline;}

.oldZipcodeResult {cursor:pointer; height:19px; line-height:19px;}
.oldZipcodeResult:hover {text-decoration:underline;}

ul.zipcodeSearchEx {width:400px; text-align:left;}

.zsfText {color:#41454b; height:41px; line-height:41px; vertical-align: top; padding:0 10px !important; background:#f2f2f2; border:1px solid #f2f2f2 !important; width:100%; font-size:15px !important;  border-radius:0 !important;}
.zsfText.on {border:1px solid #393b3f !important; background:#FFF;}
.zsfSubmit {height:43px !important; padding:0 !important; border:1px solid #393b3f !important; background-color:#666; color:#fff; cursor:pointer; font-weight:bold; font-size:15px; width:100%; background:#393b3f; vertical-align: middle;}

.totalcount_wrap {margin-top:15px; color:#41454b; padding:5px 0; font-size:14px; font-weight:600;}
.addr_type {display:inline-block; width:40px; border:1px solid #d8d8d8; color:#949494; font-size:11px; text-align:center;  border-radius:2px; margin-right:5px; line-height:2.0;}

.table_row_basic > thead > tr > th {background:#FFF; border-top:1px solid #333333; border-bottom:1px solid #b4b4b4; font-weight:600; line-height:2.0;}
.table_row_basic > tbody > tr > td {padding:13px 15px;}
.nodata {text-align:center; padding:45px 0; color:#4291f0; font-size:15px;}
</style>

<div class="content">
	<ul class="tabs">
<?php if($TPL_VAR["cfg_zipcode"]["street_zipcode_5"]){?>
		<li <?php if($TPL_VAR["zipcode_type"]=="street"){?>class="on"<?php }?>><a href="javascript:openDialogZipcode<?php echo $_GET["goodsoption"]?>('<?php echo $TPL_VAR["zipcodeFlag"]?>','','street','','');">도로명으로 검색</a></li>
<?php }?>
<?php if($TPL_VAR["cfg_zipcode"]["street_zipcode_6"]){?>
		<!---<li <?php if($TPL_VAR["zipcode_type"]==""||$TPL_VAR["zipcode_type"]=="zibun"){?>class="on"<?php }?>><a href="javascript:openDialogZipcode<?php echo $_GET["goodsoption"]?>('<?php echo $TPL_VAR["zipcodeFlag"]?>','','zibun','','');">구우편번호(6자리)로 도로명(지번)주소 검색</a></li>--->
<?php }?>
<?php if($TPL_VAR["cfg_zipcode"]["old_zipcode_lot_number"]){?>
		<li <?php if($TPL_VAR["zipcode_type"]=="oldzibun"){?>class="on"<?php }?>><a href="javascript:openDialogZipcode<?php echo $_GET["goodsoption"]?>('<?php echo $TPL_VAR["zipcodeFlag"]?>','','oldzibun','','');">지번으로 검색</a></li>
<?php }?>
	</ul>

	<div class="tabBody">
		<form name="zipForm" id="zipForm" method="get">
		<input type="hidden" name="zipcode_type" value="<?php echo $TPL_VAR["zipcode_type"]?>">
		<input type="hidden" name="old_zipcode" value="<?php echo $_GET["old_zipcode"]?>">
		<input type="text" name="addtext" value="" class="hide">
		
		<div class="addr">	
<?php if($TPL_VAR["zipcode_type"]=="zibun"){?>			
			찾고 싶으신 동이름을 입력해 주세요.
			<div class="addr_ex">예) 삼평동 670, 암사동 480-1</div>			
<?php }elseif($TPL_VAR["zipcode_type"]=="street"){?>		
			찾고 싶으신 도로명 + 길번호, 도로명 + 번지, 건물명을 입력해 주세요.								
			<div class="addr_ex">예) 남부순환로123가길, 남부순환로 8, 전쟁기념관</div>
<?php }elseif($TPL_VAR["zipcode_type"]=="oldzibun"){?>		
			찾고 싶으신 동을 입력해 주세요. 
			<div class="addr_ex">예) 압구정동</div>			
<?php }?>
		</div>
				
		<div class="search_wrap">
<?php if($TPL__GET_1){foreach($_GET as $TPL_K1=>$TPL_V1){?>
<?php if(!in_array($TPL_K1,array('page','keyword','SIDO','SIGUNGU'))){?><input type="hidden" name="<?php echo $TPL_K1?>" value="<?php echo $TPL_V1?>" /><?php }?>
<?php }}?>
			<ul class="search_keyword">
				<li><input type="text" name="zipcode_keyword" value="<?php echo $TPL_VAR["keyword"]?>" size="45" class="zsfText"  onkeydown="enterchk();" /></li>
				<li><input type="button" id="zipcodeSearchButton" value="검색" class="zsfSubmit" /></li>
			</ul>

<?php if($TPL_VAR["keyword"]&&$TPL_VAR["arrSido"]){?>
			<ul class="search_addr">
				<li>					
					<select name="SIDO" id="SIDO" onchange="getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>');">
					<option value="">시/도</option>
<?php if($TPL_arrSido_1){foreach($TPL_VAR["arrSido"] as $TPL_V1){?>
						<option value="<?php echo $TPL_V1["SIDO"]?>" <?php if($_GET["SIDO"]==$TPL_V1["SIDO"]){?>selected<?php }?>><?php echo $TPL_V1["SIDO"]?></option>
<?php }}?>
					</select>
				</li>
				<li>
					
					<select name="SIGUNGU" onchange="getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>');">
					<option value="">시/군/구</option>
<?php if($TPL_arrSigungu_1){foreach($TPL_VAR["arrSigungu"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1["SIGUNGU"]?>" <?php if($_GET["SIGUNGU"]==$TPL_V1["SIGUNGU"]){?>selected<?php }?>><?php echo $TPL_V1["SIGUNGU"]?></option>
<?php }}?>
					</select>
				</li>
			</ul>				
<?php }?>
		</div>				
		</form>
		
<?php if($TPL_VAR["page"]["totalcount"]){?>
		<div class="totalcount_wrap">총 <?php echo number_format($TPL_VAR["page"]["totalcount"])?> 건</div>
<?php }?>
		
<?php if($TPL_VAR["loop"]){?>
		<table class="table_row_basic">
			<col />								
			<col width="25%" />	
			<thead>
			<tr>		
				<th>주소</th>	
				<th>우편번호</th>				
			</tr>
			</thead>
			<tbody>
<?php if($TPL_loop_1){foreach($TPL_VAR["loop"] as $TPL_V1){?>					
			<tr class="zipcodeResult">						
				<td class="left">
<?php if($TPL_VAR["zipcode_type"]=="oldzibun"){?>
					<?php echo $TPL_V1["ADDRESSVIEW"]?>

					<div class="address hide"><?php echo $TPL_V1["ADDRESS"]?></div>
<?php }else{?>
					<div><span class="addr_type">도로명</span><?php echo $TPL_V1["ADDRESS_STREET"]?><div class="address_street hide"><?php echo $TPL_V1["ADDRESS_STREET"]?></div></div>
					<div class="mt5"><span class="addr_type">지번</span><?php echo $TPL_V1["ADDRESS"]?><div class="address hide"><?php echo $TPL_V1["ADDRESS"]?></div></div>
<?php }?>
				</td>
				<td><div class="zipcode"><?php echo $TPL_V1["ZIPCODE"]?></div></td>		
			</tr>					
<?php }}?>	
			</tbody>
		</table>
<?php }else{?>	
		<div class="nodata">	
<?php if($TPL_VAR["keyword"]){?>
				<br><br>
				검색 결과가 없습니다.
				<br><br><span class="desc">주소가 검색되지 않는 경우는 행정안전부 새주소안내시스템<br>
				<a href="http://www.juso.go.kr" target="_blank">http://www.juso.go.kr</a> 에서 확인하시기 바랍니다.</span>
<?php }else{?>
				<br><br>
<?php if($TPL_VAR["zipcode_type"]=="zibun"||$TPL_VAR["zipcode_type"]=="oldzibun"){?>
				읍/면/동을 검색해 주세요.
<?php }else{?>
					도로명/건물명을 검색해 주세요
<?php }?>
<?php }?>
		</div>
<?php }?>	
			
<?php if($TPL_VAR["page"]["totalpage"]> 1){?>		
		<div class="paging_navigation center">
<?php if($TPL_VAR["page"]["first"]){?><a href="javascript:getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>','<?php echo $TPL_VAR["page"]["first"]?>');" class="first" ></a><?php }?>
<?php if($TPL_VAR["page"]["prev"]){?><a href="javascript:getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>','<?php echo $TPL_VAR["page"]["prev"]?>');" class="prev" ></a><?php }?>
<?php if(is_array($TPL_R1=$TPL_VAR["page"]["page"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_VAR["page"]["nowpage"]==$TPL_V1){?>
					<a href="javascript:getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>','<?php echo $TPL_V1?>');" class="on"><?php echo $TPL_V1?></a>
<?php }else{?>
					<a href="javascript:getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>','<?php echo $TPL_V1?>');"><?php echo $TPL_V1?></a>
<?php }?>
<?php }}?>
<?php if($TPL_VAR["page"]["next"]){?><a href="javascript:getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>','<?php echo $TPL_VAR["page"]["next"]?>');" class="next" ></a><?php }?>
<?php if($TPL_VAR["page"]["last"]){?><a href="javascript:getZipcodeResult('<?php echo $TPL_VAR["zipcodeFlag"]?>','<?php echo $TPL_VAR["page"]["last"]?>');" class="last" ></a><?php }?>
		</div>			
<?php }?>			
	</div>	
</div>
<div class="footer"><button type="button" class="resp_btn v3 size_XL" onclick="closeDialogEvent(this);">닫기</button></div>