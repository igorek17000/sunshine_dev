<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admincrm/skin/default/_modules/layout/right.html 000013575 */ ?>
<script type="text/javascript">
	function statusBg(str){
		if(str == "request"){
			$("form#counselForm select[name='counsel_status']").css("background-color", "#ff0000");
			$("form#counselForm select[name='counsel_status']").css("color", "#ffffff");
		}else{
			$("form#counselForm select[name='counsel_status']").css("background-color", "#ffffff");
			$("form#counselForm select[name='counsel_status']").css("color", "#000000");
		}
	}

	function blacklistBg(str){
		if(str == "blacklist"){
			$("form#blacklistFrm select[name='blacklist']").css("background-color", "#ff0000");
			$("form#blacklistFrm select[name='blacklist']").css("color", "#ffffff");
			$(".blacklistRow").show();
		}else{
			$("form#blacklistFrm select[name='blacklist']").css("background-color", "#ffffff");
			$("form#blacklistFrm select[name='blacklist']").css("color", "#000000");
			$(".blacklistRow").hide();
		}
	}
	
	function blacklistover(str){
		for(i=0; i<str; i++){
			$(".blackimg").eq(i).attr("src", "/admin/skin/default/images/blacklist/devil.png");
		}
	}

	function blacklistout(){
		var count = $("input[name='blacklist']").val();
		for(i=0; i<5; i++){
			if(i > parseInt(count)-1){
				$(".blackimg").eq(i).attr("src", "/admin/skin/default/images/blacklist/angel.png")
			}
		}
		
	}

	function blacklistClick(str, parent_id){
		$("input[name='blacklist_level']").val(str);
		for(i=0; i<5; i++){
			if(i < str){
				$("#"+parent_id+" .blackimg").eq(i).attr("src", "/admin/skin/default/images/blacklist/devil.png");
			}else{
				$("#"+parent_id+" .blackimg").eq(i).attr("src", "/admin/skin/default/images/blacklist/angel.png")
			}
		}
		
	}

	function addBlacklist(){
		if(!$("#blacklist_contents").val()){
			alert("내용을 작성하세요.");
			return;
		}
		$("#blacklistForm").submit();
	}
</script>
<style type="text/css">
	.blackimg {cursor:pointer;}
	.blacklistOffDiv {cursor:pointer;}
	.blacklistOnTd, .blacklistOpen {cursor:pointer; font-size:11px; color:#666;}
	.blackListContents {position:relative; margin-top:10px; border-top:2px solid #7f8180;}
	.blackListContents .th {border:1px solid #dadada; background:#fff; padding:8px 0px 8px 15px; font-family:"Malgun Gothic"; font-size:13px; font-weight:bold; color:#3a3b3f;}
	#blackListWrite {position:absolute; top:-2px; right:0; z-index:1; width:240px; background:#e9edf0; padding-bottom:100px;}
	#blackListWrite .close {float:right; margin-right:10px; font-family:'dotum'; font-weight:normal; color:#333;}
	#blackListModfiy {position:absolute; top:-2px; right:0; z-index:1; width:240px; background:#e9edf0; padding-bottom:100px;}
	#blackListModfiy .close {float:right; margin-right:10px; font-family:'dotum'; font-weight:normal; color:#333;}
	table.info-table-style th, table.info-table-style td {background:#fff;}
	table.info-table-style.list {border-top:0;}
	.blackListContents .nodata {background:#fff; height:35px; line-height:35px; text-align:center;}	
</style>
<form name="counselForm" id="counselForm" method="post" target="actionFrame" action="../counsel_process/counsel_write">
	<input type="hidden" name="manager_seq" value="<?php echo $TPL_VAR["managerInfo"]["manager_seq"]?>">
	<input type="hidden" name="manager_name" value="<?php echo $TPL_VAR["managerInfo"]["mname"]?>">						
	<table class="info-table-style" style="width:100%">
		<colgroup>
			<col width="30%" />
			<col />
		</colgroup>
		<thead>
			<tr>
				<th colspan="2">상담관리</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th class="its-th-align center">상 담 자</th>
				<td class="its-td"><?php echo $TPL_VAR["managerInfo"]["mname"]?></td>
			</tr>
			<tr>
				<th class="its-th-align center">처리여부</th>
				<td class="its-td">
					<select name="counsel_status" style="background-color:#ff0000; color:#ffffff;" onChange="statusBg(this.value)">
						<option value="request">미처리</option>
						<option value="ing">처리중</option>
						<option value="complete">처리완료</option>
					</select>								
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">주문번호</th>
				<td class="its-td">
					<input type="text" name="order_seq" value="<?php echo $_GET["order_seq"]?>" <?php if($_GET["order_seq"]&&!$_GET["member_seq"]){?>readonly<?php }?>>
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">출고번호</th>
				<td class="its-td">
					<input type="text" name="export_code" value="">
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">반품번호</th>
				<td class="its-td">
					<input type="text" name="return_code" value="">
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">환불번호</th>
				<td class="its-td">
					<input type="text" name="refund_code" value="">
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">상품문의</th>
				<td class="its-td">
					<input type="text" name="goods_qna_seq" value="">
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">상품후기</th>
				<td class="its-td">
					<input type="text" name="goods_review_seq" value="">
				</td>
			</tr>
			<tr>
				<th class="its-th-align center">상담번호</th>
				<td class="its-td">
					<input type="text" name="parent_counsel_seq" value="">
				</td>
			</tr>
			<!-- <tr>
				<th colspan="2" class="its-th-align center">상담내용</th>
			</tr> -->
			<tr>
				<td colspan="2" class="its-td center" style="padding:0px !important;"><textarea name="counsel_contents" style="width:97%; border:0px;" rows="7" title="상담내용을 등록하세요."></textarea></td>
			</tr>
		</tbody>
	</table>
	<span class="btn_crm_search"><button type="submit" style="width:100%;">등록하기<span class="arrow"></span></button></span>
</form>
<div style="margin-top:20px;"></div>

<div class="blackListContents">	
	<div id="blackListWrite" class="hide">
		<form name="blacklistForm" id="blacklistForm" method="post" target="actionFrame" action="../counsel_process/blacklist_add">
			<input type="hidden" name="blacklist_level" value="0">
<?php if($_GET["order_seq"]&&!$_GET["member_seq"]){?>
				<input type="hidden" name="order_seq" value="<?php echo $_GET["order_seq"]?>">
<?php }else{?>
				<input type="hidden" name="member_seq" value="<?php echo $_GET["member_seq"]?>">
<?php }?>
			<table class="info-table-style" width="100%">
				<colgroup>
					<col width="30%" />
					<col />
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">악성고객 등록<a href="javascript:;" class="close">X</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th height="25" class="its-th-align center">악성레벨</th>
						<td class="its-td">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(1,'blackListWrite');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(2,'blackListWrite');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(3,'blackListWrite');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(4,'blackListWrite');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(5,'blackListWrite');">
						</td>
					</tr>
					<tr>
						<td colspan="2" class="its-td center" style="padding:0px !important;"><textarea id="blacklist_contents" name="blacklist_contents" style="width:97%; border:0px;" rows="4" title="악성고객을 등록하세요."></textarea></td>
					</tr>
				</tbody>
			</table>
			<span class="btn_crm_search"><button type="button" onclick="addBlacklist();" style="width:100%;">등록하기<span class="arrow"></span></button></span>
		</form>
	</div>
	<div id="blackListModfiy" class="hide">
		<form name="blackModifyForm" id="blackModifyForm" method="post" target="actionFrame">
			<input type="hidden" name="blacklist_level" value="0">
			<input type="hidden" name="blacklist_seq" value="">
<?php if($_GET["order_seq"]&&!$_GET["member_seq"]){?>
				<input type="hidden" name="order_seq" value="<?php echo $_GET["order_seq"]?>">
<?php }else{?>
				<input type="hidden" name="member_seq" value="<?php echo $_GET["member_seq"]?>">
<?php }?>
			<table class="info-table-style" width="100%">
				<colgroup>
					<col width="30%" />
					<col />
				</colgroup>
				<thead>
					<tr>
						<th colspan="2">악성내역<a href="javascript:;" class="close">X</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th height="25" class="its-th-align center">악성레벨</th>
						<td class="its-td">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(1,'blackListModfiy');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(2,'blackListModfiy');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(3,'blackListModfiy');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(4,'blackListModfiy');">
							<img src="/admin/skin/default/images/blacklist/angel.png" class="blackimg" align="absmiddle" onmouseover="blacklistClick(5,'blackListModfiy');">
						</td>
					</tr>
					<tr>
						<td colspan="2" class="its-td center" style="padding:0px !important;"><textarea id="blacklist_contents" name="blacklist_contents" style="width:97%; border:0px;" rows="4"></textarea></td>
					</tr>
				</tbody>
			</table>
			<span class="btn_crm_search"><button type="button" onclick="customer_commnet_mod();" style="width:100%;">수정완료<span class="arrow"></span></button></span>
		</form>
	</div>
	<div id="blackListContents"></div>
</div>
<script type="text/javascript">
	$(function(){
		$("#blacklist").live('click', function(){
			$("#blackListWrite").show();
			$(".blacklistOnDiv").hide();
		});
		$("#blackListWrite .close").live('click', function(){
			$("#blackListWrite").hide();
			$(".blacklistOffDiv").show();
		});

		$("#blackListModfiy .close").live('click', function(){
			$("#blackListModfiy").hide();
			$(".blacklistOffDiv").show();
		});

		$(".blacklistOffDiv").live('click',function(){
			var bseq = $(this).attr("blacklist_seq");
			$("#blacklistOff"+bseq).hide();
			$("#blacklistOn"+bseq).show();
		});
		$(".blacklistOnTd").live('click',function(){
			var bseq = $(this).attr("blacklist_seq");
			$("#blacklistOff"+bseq).show();
			$("#blacklistOn"+bseq).hide();
		});
		
		$("#blacklistInit").live('click', function(){
			set_black_list_init();
		});

		get_black_list(1);
	});

	function get_black_list(page){
		memo_page = page ? page : memo_page;

		$.ajax({
			'url' : '../board/get_blacklist',
			'data' : {'page':page},
			'type' : 'post',
			'dataType' : 'html',
			'global' : false,
			'success' : function(result){
				$("#blackListContents").html(result);
			}
		});
	}

	function set_black_list_init(){
		$.ajax({
			'url' : '../board/set_blacklist_init',
			'type' : 'post',
			'dataType' : 'html',
			'global' : false,
			'success' : function(result){
				if(result == true){
					alert("초기화 되었습니다.");
					get_black_list(1);
				} else {
					alert("에러가 발생했습니다. 문제가 지속 될 경우 관리자에게 문의 하세요.");
				}
			}
		});
	}
	
	function customer_commnet_del(seq){
		var title = "악성내역 삭제";
		var msg = "악성내역을 삭제하시겠습니까?";
		var blacklist_seq = seq;
		var yesCallback = function(){
				$.ajax({
					'url'	: '../counsel_process/blacklist_delete',
					'type'	: 'post',
					'data'	: {'blacklist_seq':blacklist_seq},
					'success' : function(res){
						get_black_list(1);
					}
				})
			};
		var noCallback = '';
		var params = {yesMsg:'확인',noMsg:'취소'};
		openDialogConfirm(msg,300,150,yesCallback,noCallback,params);
	}

	function customer_commnet_load(seq){
		var blacklist_seq = seq;
		$("#blackListModfiy").show();
		$.ajax({
			'url'	: '../counsel_process/blacklist_load',
			'type'	: 'post',
			'data'	: {'blacklist_seq':blacklist_seq},
			'success' : function(res){
				var result = JSON.parse(res);
				$("#blackListModfiy #blacklist_contents").val(result.blacklist_contents);
				$("#blackListModfiy input[name='blacklist_seq']").val(result.blacklist_seq);
				blacklistClick(result.blacklist_level,'blackListModfiy');
				if(result.blacklist_modify_manager_seq){
					$("<input type='hidden' name='blacklist_modify_manager_seq' value='"+result.blacklist_modify_manager_seq+"'>").appendTo("#blackListModfiy input[name='blacklist_seq']");
				}
				$(".blacklistOnDiv").hide();
			}
		})
	}

	function customer_commnet_mod(){
		$.ajax({
			'url'	: '../counsel_process/blacklist_modify',
			'type'	: 'post',
			'data'	: $("#blackModifyForm").serialize(),
			'success' : function(res){
				$("#blackListModfiy").hide();
				get_black_list(1);
			}
		})
	}
</script>