<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/setting/manager_reg.html 000083931 */ 
$TPL_auth_1=empty($TPL_VAR["auth"])||!is_array($TPL_VAR["auth"])?0:count($TPL_VAR["auth"]);
$TPL_boardmanagerlist_1=empty($TPL_VAR["boardmanagerlist"])||!is_array($TPL_VAR["boardmanagerlist"])?0:count($TPL_VAR["boardmanagerlist"]);
$TPL_limit_ip_msg_1=empty($TPL_VAR["limit_ip_msg"])||!is_array($TPL_VAR["limit_ip_msg"])?0:count($TPL_VAR["limit_ip_msg"]);
$TPL_limit_ip_1=empty($TPL_VAR["limit_ip"])||!is_array($TPL_VAR["limit_ip"])?0:count($TPL_VAR["limit_ip"]);
$TPL_admin_limit_ip_msg_1=empty($TPL_VAR["admin_limit_ip_msg"])||!is_array($TPL_VAR["admin_limit_ip_msg"])?0:count($TPL_VAR["admin_limit_ip_msg"]);
$TPL_admin_limit_ip_1=empty($TPL_VAR["admin_limit_ip"])||!is_array($TPL_VAR["admin_limit_ip"])?0:count($TPL_VAR["admin_limit_ip"]);
$TPL_certify_1=empty($TPL_VAR["certify"])||!is_array($TPL_VAR["certify"])?0:count($TPL_VAR["certify"]);
$TPL_action_history_data_1=empty($TPL_VAR["action_history_data"])||!is_array($TPL_VAR["action_history_data"])?0:count($TPL_VAR["action_history_data"]);?>
<?php $this->print_("layout_header",$TPL_SCP,1);?>


<script type="text/javascript" src="/app/javascript/jquery/jquery.ajax.form.js"></script>
<script type="text/javascript" src="/app/javascript/js/ajaxFileUpload.js"></script>

<script type="text/javascript">
	var auth_arr = new Array();
	var auth_flag = <?php if(!$TPL_VAR["auth_limit"]){?>true<?php }else{?>false<?php }?>;
	var auth_limit = <?php if($TPL_VAR["auth_limit"]&&$TPL_VAR["auth"]["manager_yn"]=='Y'){?>true<?php }else{?>false<?php }?>;

	$(document).ready(function() {
		$(".class_check_password_validation").each(function(){
			init_check_password_validation($(this));
		});

		$('#managerIconBtn').createAjaxFileUpload(uploadConfig, uploadCallback);
<?php if($TPL_VAR["mphoto"]){?>imgUploadEvent("#managerIconBtn", "", "/data/icon/manager/", "<?php echo $TPL_VAR["mphoto"]?>")<?php }?>;	
		


		$(".auth").each(function(i){
			auth_arr[i] = $(this).attr('name');
		});

		$("#id_chk").click(function(){
			var id = $("input[name='manager_id']").val();
			if(!id){
				$("input[name='manager_id']").focus();
				return;
			}
			$.post("../setting_process/id_chk", { manager_id : id }, function(response){
				alert(response.return_result);
			},'json');
		});

		$("#allClick").click(function(){
			if($(this).attr("gb")=="none"){
				$(".auth").attr("checked",true);
				$("input.authboard").attr("checked",true);
				$("#click_text").html("전체해제");
				$(this).attr("gb","click");
				$("input.board_view_pw").attr("disabled",false);
				$("input.board_act").attr("disabled",false);
			}else{
				$(".auth").attr("checked",false);
				$("input.authboard").attr("checked",false);
				$("#click_text").html("전체선택");
				$(this).attr("gb","none");
				$("input.board_view_pw").attr("disabled",true);
				$("input.board_act").attr("disabled",true);
			}
			init_auth();
		});

		$(".board_view").click(function() {
			if($(this).attr("checked")){
				$(this).parent().parent().find(".board_view_pw").attr("checked",true);
				$(this).parent().parent().find(".board_act").attr("checked",true);
				$(this).parent().parent().find(".board_view_pw").attr("disabled",false);
				$(this).parent().parent().find(".board_act").attr("disabled",false);
			}else{
				$(this).parent().parent().find(".board_view_pw").attr("checked",false);
				$(this).parent().parent().find(".board_act").attr("checked",false);
				$(this).parent().parent().find(".board_view_pw").attr("disabled",true);
				$(this).parent().parent().find(".board_act").attr("disabled",true);
			}
		});

		$("input[name='modify_passwd']").click(function(){
			if($(this).attr("checked")){
				$("#manager_passwd_confirm").show();
				$("input[name='mpasswd']").attr("disabled",false);
				$("input[name='mpasswd_re']").attr("disabled",false);
			}else{
				$("#manager_passwd_confirm").hide();
				$("input[name='mpasswd']").attr("disabled",true);
				$("input[name='mpasswd_re']").attr("disabled",true);
			}
		});

<?php if($TPL_VAR["manager_seq"]){?>
<?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>
			$(".auth").attr("checked",true);
			$(".authprivate").attr("checked",false);
<?php }else{?>
<?php if($TPL_auth_1){foreach($TPL_VAR["auth"] as $TPL_K1=>$TPL_V1){?>
				if('<?php echo $TPL_V1?>'=='Y' && !auth_flag) $("input[name='<?php echo $TPL_K1?>']").attr("checked",true);
				if(auth_flag && '<?php echo $TPL_V1?>'!='Y'){
					$("input[name='<?php echo $TPL_K1?>']").closest("label").css('color','#b6b6b6');
				}
<?php }}?>
<?php if($TPL_boardmanagerlist_1){foreach($TPL_VAR["boardmanagerlist"] as $TPL_V1){?>
				if(auth_flag && '<?php echo $TPL_V1["board_view"]?>' == 0){
					$("input[name='board_view[<?php echo $TPL_V1["id"]?>]']").closest("label").css('color','#b6b6b6');
				}
				if(auth_flag && '<?php echo $TPL_V1["board_view_pw"]?>' == 0){
					$("input[name='board_view_pw[<?php echo $TPL_V1["id"]?>]']").closest("label").css('color','#b6b6b6');
				}
				if(auth_flag && '<?php echo $TPL_V1["board_act"]?>' == 0){
					$("input[name='board_act[<?php echo $TPL_V1["id"]?>]']").closest("label").css('color','#b6b6b6');
				}
<?php }}?>
<?php }?>
<?php }?>

	

		$("input[name='member_download'], input[name='member_view']").bind('click',function(){
			if($("input[name='member_view']").attr("checked") && $("input[name='member_download']").attr("checked")){
				openDialog('회원정보 다운로드 기능 사용 시 개인정보 보호 주의사항','admin_member_download', {'width':550,'height':380});
			}
		});

		$("input[name='list_member_down']").bind('click',function(){
			if(!$("#manager_alert_dialog").length){
				$("<div id='manager_alert_dialog'></div>").appendTo('body');
			}
<?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>
			$("#manager_alert_dialog").load('/admin/common/manager_alert_history');
<?php }else{?>
			$("#manager_alert_dialog").load('/admin/common/manager_alert_history?keyword=<?php echo $TPL_VAR["manager_id"]?>');
<?php }?>
			openDialog("중요행위발생을 알려 드립니다!", "manager_alert_dialog", {"width":900, "height":700});
		});

		$(".auth").bind('click',function(){
			var tmp = $(this).attr("name").split("_");
			if(tmp[tmp.length-1]=='view'){
				if($(this).attr("checked")){
					for(var i=0;i<auth_arr.length;i++){
						if(tmp[0]=='setting'){
							var tmp_text = tmp[0]+"_"+tmp[1];
							if(tmp_text==auth_arr[i].substring(0,tmp_text.length)){
								if($(this).attr("name")!=auth_arr[i]) $("input[name='"+auth_arr[i]+"']").attr("disabled",false);
							}
						}else{
							if(tmp[0]==auth_arr[i].substring(0,tmp[0].length)){
								if($(this).attr("name")!=auth_arr[i]) $("input[name='"+auth_arr[i]+"']").attr("disabled",false);
							}
						}
					}
				}else{
					for(var i=0;i<auth_arr.length;i++){
						if(tmp[0]=='setting'){
							var tmp_text = tmp[0]+"_"+tmp[1];
							if(tmp_text==auth_arr[i].substring(0,tmp_text.length)){
								if($(this).attr("name")!=auth_arr[i]){
									$("input[name='"+auth_arr[i]+"']").attr("checked",false);
									$("input[name='"+auth_arr[i]+"']").attr("disabled",true);
								}
							}
						}else if(tmp[0]==auth_arr[i].substring(0,tmp[0].length) && tmp[0]!='setting'){
							if($(this).attr("name")!=auth_arr[i]){
								$("input[name='"+auth_arr[i]+"']").attr("checked",false);
								$("input[name='"+auth_arr[i]+"']").attr("disabled",true);
							}
						}
					}
				}
			}
		});

		// ICON
		$("button#iconBtn").live("click",function(){
			openDialog("아이콘 선택  <span class='desc'>아이콘으로 사용할 이미지를 등록해 주세요.</span>", "iconPopup", {"width":"350","height":"250","show" : "fade","hide" : "fade"});
		});

		$(".icons").live("click",function(){
			var img = $(this).attr("filenm");
			var html = "<img src=\""+$(this).attr('src')+"\" align='absmiddle'>";
			$("#imgHtml").html(html);
			$("input[name='mphoto']").val(img);
			closeDialog("iconPopup");
		});

		$("input[name='ip_chk']").click(function(){
			init_func();
		});

		$("input[name='hp_chk']").click(function(){
			init_hp();
		});


		/******** 티켓사용 확인코드 관련 **********/

		//SMS보내기
		$(".manager_sms_send").live("click",function(event){
			if( $(this).parent().parent().find("input[name='certify_code[]']").val() == $(this).parent().parent().find("input[name='certify_code[]']").attr('title') ){
				openDialogAlert("확인코드를 입력해주세요.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
				return false;
			}
			if(  $(this).parent().parent().find("input[name='certify_code_chk[]']").val() != 'ok' ){
				openDialogAlert("사용가능한 확인코드인지 [인증]해 주세요!", 350, 150, function(){});
				return false;
			}

			var certify_code = $(this).parent().parent().find("input[name='certify_code[]']").val();
			$.get('../member/sms_pop?certify_code='+certify_code, function(data) {
				$('#sendPopup').html(data);
				openDialog("SMS 발송", "sendPopup", {"width":"750"});
			});
		});

		// 직원추가
		$("#addManager").bind("click", function(){
			var addHTML	= '';
			addHTML	+= '<tr>'+"\n";
			addHTML	+= '<td><input type="hidden" name="certify_seq[]" value="" size="10" class="line" />'+"\n";
			addHTML	+= '<input type="text" name="manager_name[]" value="" size="35" class="line" title="매장 정보"/></td>'+"\n";
			addHTML	+= '<td><input type="hidden" name="certify_code_chk[]" value="" /><input type="text" name="certify_code[]" value="" size="35" class="line" title="6-16 자리 이하 영문 또는 숫자" /></td>'+"\n";
			addHTML	+= '<td><button type="button" class="certify_btn resp_btn v2">인증</button></td>'+"\n";
			addHTML	+= '<td><button type="button" class="manager_sms_send resp_btn">SMS 전송</button></td>'+"\n";
			addHTML	+= '<td><button type="button" class="delManager btn_minus btnplusminus"></button></td></tr>'+"\n";
			

			$("#cerfify_manager").append(addHTML);
			setDefaultText();
		});

		// 직원 삭제
		$(".delManager").live('click', function(){
			
			if($(this).closest('tr').siblings().length>0){
				$(this).parent().parent().remove();
			}
		});

		// 인증
		$(".certify_btn").live('click', function(){
			var parent			= $(this).parent().parent();
			$(parent).find("input[name='certify_code_chk[]']").val('');//초기화
			var certify_seq		= $(parent).find("input[name='certify_seq[]']").val();
			var certify_code	= $(parent).find("input[name='certify_code[]']").val();
			var titles			= $(parent).find("input[name='certify_code[]']").attr('title');
			certify_code		= certify_code.replace(titles, '');

			if	(!certify_code){
				openDialogAlert("확인코드를 입력해주세요.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
				return;
			}
			if	(certify_code.length < 6 || certify_code.length > 16){
				openDialogAlert("확인코드는 6자리 이상 16자리 이하로 입력해주세요.", 400, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
				return;
			}
			if	(certify_code.search(/[^0-9a-zA-Z]/) != -1){
				openDialogAlert("확인코드는 영문 또는 숫자로 입력해주세요.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
				return;
			}

			var dup = false;
			var $inp = $("input[name='certify_code[]']");
			var certify_code_idx = $(".certify_btn").index(this);
			$inp.each(function() {
				var selidx = $("input[name='certify_code[]']").index(this);
				var codenew = $(this).val();
				var codetitle = $(this).attr('title');
				codenew = codenew.replace(codetitle, '');
				if( certify_code == codenew && certify_code_idx != selidx ) {
					dup = true;
					return false;
				}
			});

			if(dup){
				openDialogAlert("중복된 확인코드입니다.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
				return false;
			}

			$.ajax({
				type: "get",
				url: "../provider/chk_certify_code",
				data: "certify_code="+certify_code+"&certify_seq="+certify_seq,
				success: function(result){
					if	(result == 'ok')
						openDialogAlert("사용 가능한 확인코드입니다.", 300, 150, function(){$(parent).find("input[name='certify_code_chk[]']").val('ok')});
					else if	(result == 'duple')
						openDialogAlert("중복된 확인코드입니다.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
					else if	(result == 'error_1')
						openDialogAlert("확인코드를 입력해주세요.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
					else if	(result == 'error_2')
						openDialogAlert("확인코드는 6자리 이상 16자리 이하로 입력해주세요.", 400, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
					else if	(result == 'error_3')
						openDialogAlert("확인코드는 영문 또는 숫자로 입력해주세요.", 300, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
					else
						openDialogAlert("확인코드 인증에 실패하였습니다.", 400, 150, function(){$(parent).find("input[name='certify_code[]']").focus()});
				}
			});
		});

		/******** /티켓사용 확인코드 관련 **********/

		$("input[name='passwd_chg']").bind("click",function(){
			if($(this).attr("checked")){
				$("#r_pass").show();
				$("#manager_passwd_confirm").show();
			}else{
				$("#r_pass").hide();
				$("#manager_passwd_confirm").hide();
			}
		});


		/* 아이피 추가 */
		$("#ipViewTable button#ipAdd").bind("click",function(){
			var html="";
			html = '<tr>';
			html += '	<td>';
			html += '	<input type="text" name="limit_ip1[]" value="" class="line limit_ip" size=6 maxlength=3 />.';
			html += '	<input type="text" name="limit_ip2[]" value="" class="line limit_ip" size=6 maxlength=3 />.';
			html += '	<input type="text" name="limit_ip3[]" value="" class="line limit_ip" size=6 maxlength=3 />.';
			html += '	<input type="text" name="limit_ip4[]" value="" class="line limit_ip" size=6 maxlength=3 />';
			html += '	</td><td class="center"><button type="button" id="ipDel" class="btn_minus" onclick="del_ip(this)"></button>';
			html += '	</td>';
			html += '</tr>';

			$("#ipViewTable tbody").append(html);
			init_func();
		});

		/* 아이피 추가 */
		$("#adminIpAdd").bind("click",function(){
			var html		= '';
			var disabled	= '';
			if	(!$("input[name='admin_ip_chk']").attr('checked')){
				disabled	= 'disabled="disabled"';
			}
			html += '	<tr><td>';
			html += '	<input type="text" name="admin_limit_ip1[]" value="" class="line admin_limit_ip" size="6" maxlength="3" ' + disabled + ' />.';
			html += '	<input type="text" name="admin_limit_ip2[]" value="" class="line admin_limit_ip" size="6" maxlength="3" ' + disabled + ' />.';
			html += '	<input type="text" name="admin_limit_ip3[]" value="" class="line admin_limit_ip" size="6" maxlength="3" ' + disabled + ' />.';
			html += '	<input type="text" name="admin_limit_ip4[]" value="" class="line admin_limit_ip" size="6" maxlength="3" ' + disabled + ' />';
			html += '	</td><td class="center"><button type="button" class="btn_minus" id="adminIpDel" onclick="del_admin_ip(this)"></button>';
			html += '	</td></tr>';
			$("#adminIpCell tbody").append(html);
			init_func();
		});
		
		/* 포토 */
		$("#manager_icon").change(function (e) {
			if(this.disabled) return alert('File upload not supported!');
			var F = this.files;
			if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );		
		});
		
		$("#cancle_btn").bind("click",function(){
			if ($.browser.msie) { 				
				$("#manager_icon").replaceWith( $("#manager_icon").clone(true) ); 
			} else { 				
				$("#manager_icon").val(""); 
			}

			$("#iconBtn").text("찾아보기");
		
			$("#preview").attr("src", "/admin/skin/default/images/common/noimage_list.gif");
			$("#mphoto").val("");
		});

		init_func();
		init_auth();
		init_hp();
		admin_init_func();

		if(auth_flag || auth_limit){
			//$('.auth,.authboard').closest("label").css({'cursor':'default'});
			//$('.auth,.authboard').remove();
			$('.auth, .authboard, .authprivate').attr("disabled", true);
		}

<?php if($TPL_VAR["managerInfo"]["manager_yn"]!='Y'){?>
			// 관리자 설정
			//$(".auth").hide();
			//$("input.authboard").hide();
			$('.auth, .authboard, .authprivate').attr("disabled", true);
<?php }?>
	});

	function readImage(file) {
		var reader = new FileReader();
		var image  = new Image();

		reader.readAsDataURL(file);

		reader.onload = function(_file) {
			image.src    = _file.target.result;
			image.onload = function() {
				var w = this.width,
					h = this.height,
					t = file.type,
					n = file.name,
					s = ~~(file.size/1024) +'KB';

				if(w > 100||h > 100)
				{
					openDialogAlert("이미지 크기는 가로 세로 100pixel 이하로 등록 가능합니다.", 400, 150);
					$("#file").val("");				
				}else{
					
					$("#iconBtn").text("변경");

					$("#preview").attr("src", image.src);
				}					
			};

			image.onerror= function() {
				alert('Invalid file type: '+ file.type);
			};
		};
	}


	function del_ip(obj){
		var bobj = $(obj);
		
		if(bobj.closest("tr").siblings().length>0)
		{
			bobj.closest("tr").remove();
		}
	}

	function del_admin_ip(obj){
		var bobj = $(obj);
		
		if(bobj.closest("tr").siblings().length>0)
		{
			bobj.closest("tr").remove();
		}
	}

	function init_func(){

		if($("input[name='ip_chk']").attr("checked")){
			$(".ip_view").show();
			$(".limit_ip").attr("disabled",false);
		}else{
			$(".limit_ip").val('');
			$(".ip_view").hide();
			$(".limit_ip").attr("disabled",true);
		}
	}

	function admin_init_func(){
		if($("input[name='admin_ip_chk']").attr("checked")){			
			$(".admin_limit_ip").show();
		}else{
			$(".admin_limit_ip").val('');		
			$(".admin_limit_ip").hide();
		}
	}


	function init_hp(){
		if($("input[name='hp_chk']").attr("checked")){
			$(".auth_hp").show();
			$(".auth_hp").attr("disabled",false);
		}else{
			$("input[name='auth_hp']").val('');
			$(".auth_hp").hide();
			$(".auth_hp").attr("disabled",true);
		}
	}


	function init_auth(){
		for(var z=0;z<auth_arr.length;z++){
			if(auth_arr[z]=='event_view' || auth_arr[z]=='setting_manager_view'){
			}else{
				var tmp = auth_arr[z].split("_");
				if(tmp[tmp.length-1]=='view'){
					if(!$("input[name='"+auth_arr[z]+"']").attr("checked")){
						for(var i=0;i<auth_arr.length;i++){
							if(tmp[0]=='setting'){
								var tmp_text = tmp[0]+"_"+tmp[1];
								if(tmp_text==auth_arr[i].substring(0,tmp_text.length)){
									if(auth_arr[z]!=auth_arr[i]) $("input[name='"+auth_arr[i]+"']").attr("disabled",true);
								}
							}else{
								if(tmp[0]==auth_arr[i].substring(0,tmp[0].length)){
									if($("input[name='"+auth_arr[z]+"']").attr("name")!=auth_arr[i]) $("input[name='"+auth_arr[i]+"']").attr("disabled",true);
								}
							}
						}
					}else{
						for(var i=0;i<auth_arr.length;i++){
							if(tmp[0]!='setting'){
								if(tmp[0]==auth_arr[i].substring(0,tmp[0].length)){
									if($("input[name='"+auth_arr[z]+"']").attr("name")!=auth_arr[i]) $("input[name='"+auth_arr[i]+"']").attr("disabled",false);
								}
							}else{
								if(tmp[0]==auth_arr[i].substring(0,tmp[0].length)){
									if($("input[name='"+auth_arr[z]+"']").attr("name")!=auth_arr[i]) $("input[name='"+auth_arr[i]+"']").attr("disabled",false);
								}
							}
						}
					}
				}
			}
		}
	}


	function iconFileUpload(str){
		if(str > 0) {
			alert('아이콘을 선택해 주세요.');
			return false;
		}
		//파일전송
		var frm = $('#iconRegist');
		frm.attr("action","../setting_process/iconUpload");
		frm.submit();
	}

	function iconDisplay(filenm){
		//alert(filenm);
		var html = "<img src=\"../../data/icon/manager/"+filenm+"\" class=\"hand icons\" filenm=\""+filenm+"\">";
		$("#iconDisplay").html(html);
	}

	function info_policy(){
		openDialog('안내) 개인정보 보호 법률','admin_policy_info',{'width':800,'height':380});
	}

	// IP 필수 입력 확인
	function check_vaild_ip(){

		var ip1	= ip2 = ip3 = '';
		var chkStatus		= true;
		var errMsg			= '아이피 대역이 잘못되었습니다.<br />아이피 대역은 0~255 사이의 숫자만 입력해주세요.<br />아이피 3번째 자리까지는 필수 입력하셔야 합니다.';
		
		if	($("input[name='ip_chk']:checked").val()=="Y"){
			$("input[name='limit_ip1[]']").each(function(idx){
				ip1		= $(this).val();
				ip2		= $("input[name='limit_ip2[]']").eq(idx).val();
				ip3		= $("input[name='limit_ip3[]']").eq(idx).val();
				if	( !( ( ip1 > 0 && ip1 <= 255 ) && ( ip2 > 0 && ip2 <= 255 ) && ( ip3 > 0 && ip3 <= 255 ) ) ){
					chkStatus	= false;
				}
			});
			if	(!chkStatus){
				openDialogAlert(errMsg, 400,260, function(){});
				return false;
			}
		}
		if	($("input[name='admin_ip_chk']:checked").val()=="Y"){
			$("input[name='admin_limit_ip1[]']").each(function(idx){
				ip1		= $(this).val();
				ip2		= $("input[name='admin_limit_ip2[]']").eq(idx).val();
				ip3		= $("input[name='admin_limit_ip3[]']").eq(idx).val();
				if	( !( ( ip1 > 0 && ip1 <= 255 ) && ( ip2 > 0 && ip2 <= 255 ) && ( ip3 > 0 && ip3 <= 255 ) ) ){
					chkStatus	= false;
				}
			});
			if	(!chkStatus){
				openDialogAlert(errMsg, 400, 260, function(){});
				return false;
			}
		}

		return true;
	}

	// 자신의 아이피를 허용하지 않았을 경우 경고 메시지처리
	function check_self_ip(){
		var self_ip = '<?php echo $_SERVER["REMOTE_ADDR"]?>';
		var apply_exist = false;
		var self_apply = false;
		var apply_exist_login = false;
		var self_apply_login = false;
		var ip = '';
		var patt = '';
		var result = '';
		var ips = '';
		var ips_login = '';
		var ip_num = 0;
		var ip_num_login = 0;

		if	(!check_vaild_ip())	return false;
		$("input[name='limit_ip1[]']").each(function(idx){
			if( $(this).val() ){
				apply_exist = true;
				ip = $(this).val();
				if( $("input[name='limit_ip2[]']").eq(idx).val() ){
					ip += '.'+$("input[name='limit_ip2[]']").eq(idx).val();
				}
				if( $("input[name='limit_ip3[]']").eq(idx).val() ){
					ip += '.'+$("input[name='limit_ip3[]']").eq(idx).val();
				}
				if( $("input[name='limit_ip4[]']").eq(idx).val() ){
					ip += '.'+$("input[name='limit_ip4[]']").eq(idx).val();
				}
				eval('patt = /^'+ip+'/i;');
				result =  patt.test(self_ip);
				if( result ){
					self_apply = true;
				}
				if( $("input[name='limit_ip4[]']").eq(idx).val() == '' ){
					ips += ip+'.1 ~ '+ip+'.255<br>';
				}else{
					ips += ip+'<br>';
				}
				ip_num++;
			}
		});
		$("input[name='admin_limit_ip1[]']").each(function(idx){
			if( $(this).val() ){
				apply_exist_login = true;
				ip = $(this).val();
				if( $("input[name='admin_limit_ip2[]']").eq(idx).val() ){
					ip += '.'+$("input[name='admin_limit_ip2[]']").eq(idx).val();
				}
				if( $("input[name='admin_limit_ip3[]']").eq(idx).val() ){
					ip += '.'+$("input[name='admin_limit_ip3[]']").eq(idx).val();
				}
				if( $("input[name='admin_limit_ip4[]']").eq(idx).val() ){
					ip += '.'+$("input[name='admin_limit_ip4[]']").eq(idx).val();
				}
				eval('patt = /^'+ip+'/i;');
				result =  patt.test(self_ip);
				if( result ){
					self_apply_login = true;
				}
				if( $("input[name='admin_limit_ip4[]']").eq(idx).val() == '' ){
					ips_login += ip+'.1 ~ '+ip+'.255<br>';
				}else{
					ips_login += ip+'<br>';
				}
				ip_num_login++;
			}
		});

		var height = 0;
		if( (!self_apply && apply_exist) || ( !self_apply_login && apply_exist_login ) ){
			var msg = '<div class="left">';
			if( !self_apply && apply_exist ){
				msg += '<b>[관리환경 관리페이지]</b><br>아래는 입력하신 접속허용 IP입니다.<br>'+ips+'<br>현재 접속 IP는 입력하신 접속허용 IP에는 포함되어 있지 않습니다.';
				msg += '<br>계속 진행하시면 현재 접속 IP에서는';
				msg += " 관리페이지";
				msg += '를 접속할 수 없게 됩니다.<br>';
				height += 6 + ip_num;
			}
			if( !self_apply_login && apply_exist_login ){
				if( !self_apply && apply_exist ){
					msg += '<br>';
				}
				msg += '<b>[관리환경 로그인페이지]</b><br>아래는 입력하신 접속허용 IP입니다.<br>'+ips_login+'<br>현재 접속 IP는 입력하신 접속허용 IP에는 포함되어 있지 않습니다.';
				msg += '<br>계속 진행하시면 현재 접속 IP에서는';
				msg += " 로그인페이지";
				msg += '를 접속할 수 없게 됩니다.';
				height += 7 + ip_num_login;
			}
			msg += '</div>';

			height = height * 20 + 170;
			openDialogConfirm(msg,550,height,function(){
				settingForm.submit();
				return true;
			},function(){
				return false;
			});
		}else{
			settingForm.submit();
		}
	}
</script>
<style>
	table.change_password tr th {font-weight:normal;padding-right:10px;text-align:right;}
<?php if(!$TPL_VAR["auth_limit"]||$TPL_VAR["auth"]["manager_yn"]=='Y'){?>
	table#authority_tbl tr td { color:#747474; background:#f9fbfc; }
	table#authority_tbl tr th { color:#747474; }
	table#authority_tbl tr td input[type='checkbox'] {}
<?php }?>

	.iconBox {height:56px;}
	.iconBox > li {padding-right:10px; float:left;}
	.iconBox > li:nth-child(n+2) {padding-top:14px;}
	#manager_icon {opacity:0; position:relative; overflow:hidden;}
	.change_password {display: flex;}
	.change_password dt {width: 120px;}

</style>

<?php if($TPL_VAR["manager_seq"]){?>
<form name="settingForm" method="post" enctype="multipart/form-data" action="../setting_process/manager_modify" target="actionFrame">
<input type="hidden" name="manager_seq" value="<?php echo $TPL_VAR["manager_seq"]?>"/>
<input type="hidden" name="manager_yn" value="<?php echo $TPL_VAR["auth"]["manager_yn"]?>" />
<?php }else{?>
<form name="settingForm" method="post" enctype="multipart/form-data" action="../setting_process/manager_reg" target="actionFrame">
<?php }?>

<!-- 페이지 타이틀 바 : 시작 -->
<div id="page-title-bar-area">
	<div id="page-title-bar">

		<!-- 타이틀 -->
		<div class="page-title">
			<h2>관리자 <?php if($TPL_VAR["manager_seq"]){?>수정<?php }else{?>등록<?php }?></h2>
		</div>		

		<!-- 우측 버튼 -->
		<div class="page-buttons-right">			
<?php if(($TPL_VAR["managerInfo"]["manager_yn"]=='Y'&&$TPL_VAR["managerInfo"]["manager_seq"]==$TPL_VAR["manager_seq"])||$TPL_VAR["isdemo"]["isdemo"]){?>
			<button class="resp_btn active size_L" type="button" <?php if($TPL_VAR["isdemo"]["isdemo"]){?><?php echo $TPL_VAR["isdemo"]["isdemojs1"]?><?php }else{?> onclick="check_self_ip();"<?php }?>>저장</button>
<?php }else{?>
			<button class="resp_btn active size_L" type="submit">저장</button>
<?php }?>		
		</div>

		<!-- 좌측 버튼 -->
		<div class="page-buttons-left">
			<button type="button" onclick="document.location.href='manager';" class="resp_btn v3 size_L">리스트 바로가기</button>
		</div>
	</div>
</div>
<!-- 페이지 타이틀 바 : 끝 -->

<!-- 서브 레이아웃 영역 : 시작 -->
<!-- 서브메뉴 바디 : 시작-->
<div class="contents_dvs">
	<div class="item-title">관리자 정보</div>
	<table class="table_basic thl">
<?php if($TPL_VAR["manager_seq"]){?>
		<tr>
			<th>최근 접속일</th>
			<td><?php echo $TPL_VAR["lastlogin_date"]?></td>
		</tr>
		<tr>
			<th>등록일</th>
			<td><?php echo $TPL_VAR["mregdate"]?></td>
		</tr>
		<tr>
			<th>관리자 구분</th>
			<td><b><?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>대표운영자<?php }else{?>부운영자<?php }?></b></td>
		</tr>
<?php }?>
		<tr>
			<th>관리자 아이디</th>
			<td>						
<?php if($TPL_VAR["manager_seq"]){?>
				<b><?php echo $TPL_VAR["manager_id"]?></b>
<?php }else{?>
				<input type="text" name="manager_id" value="<?php echo $TPL_VAR["manager_id"]?>" class="line"/> <button type="button" class="resp_btn v2" id="id_chk">중복확인</button>
				<div class="gray">- 첫 글자는 영문이며, 영문 또는 숫자 대소문자 4-16자 이하</div>
<?php }?>
			</td>
		</tr>

		<tr>
			<th>이미지</th>
			<td>
				<div class="webftpFormItem">									
					<label class="resp_btn v2"><input type="file" id="managerIconBtn" accept="image/*">파일선택</label>
					<input type="hidden" class="webftpFormItemInput" name="mphoto" value="<?php echo $TPL_VAR["mphoto"]?>" size="30" maxlength="255" />									
					<div class="preview_image"></div>
				</div>

				
				<div class="gray" >- 이미지사이즈 54px*54px, 파일 형식 jpg, gif, png</div>	
				
			</td>
		</tr>
<?php if($TPL_VAR["manager_seq"]){?>
		<tr>
			<th>
				비밀번호
			</th>
			<td>						
				<label class="resp_checkbox"><input type="checkbox" name="passwd_chg" value="Y" /> 변경</label>						
			</td>
		</tr>
<?php }?>
		
		<tr id="r_pass" <?php if($TPL_VAR["manager_seq"]){?>style="display:none;"<?php }?>>
			<th>
				비밀번호 설정
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip6', 'sizeM')"></span>
			</th>
			<td>
<?php if($TPL_VAR["manager_seq"]){?>						
				<dl class="change_password">
					<dt>현재 비밀번호</dt>
					<dd><input type="password" name="manager_password" value="" class="line" /></dd>
				</dl>
				<dl class="change_password">
					<dt>비밀번호 변경</dt>
					<dd><input type="password" name="mpasswd" class="line class_check_password_validation" /></dd>
				</dl>
				<dl class="change_password">
					<dt>비밀번호 변경 확인</dt>
					<dd><input type="password" name="mpasswd_re" class="line" /></dd>
				</dl>
<?php }else{?>
				<dl class="change_password">
					<dt>비밀번호</dt>
					<dd><input type="password" name="mpasswd" class="line class_check_password_validation" /></dd>
				</dl>
				<dl class="change_password">
					<dt>비밀번호 확인</dt>
					<dd><input type="password" name="mpasswd_re" class="line" /></dd>							
				</dl>
<?php }?>
			</td>
		</tr>

		<tr>
			<th>관리자명</th>
			<td><input type="text" name="mname" value="<?php echo $TPL_VAR["mname"]?>" class="line"/></td>
		</tr>

		<tr>
			<th>전화번호</th>
			<td><input type="text" name="mphone" value="<?php echo $TPL_VAR["mphone"]?>" class="line"/></td>
		</tr>

		<tr>
			<th>핸드폰</th>
			<td><input type="text" name="mcellphone" value="<?php echo $TPL_VAR["mcellphone"]?>" class="line"/></td>
		</tr>

		<tr>
			<th>이메일</th>
			<td><input type="text" name="memail" value="<?php echo $TPL_VAR["memail"]?>" class="line"/></td>
		</tr>
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">
		관리자 로그인 보안
		<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip1')"></span>
	</div>
	<table class="table_basic thl">		
		<tr>
			<th>비밀번호 변경</th>
			<td>비밀번호 변경 후 90일 경과 시 비밀번호 변경 자동 안내</td>
		</tr>
		<tr>
			<th>자동 로그아웃</th>
			<td>
<?php if($TPL_VAR["autoLogout"]["auto_logout"]=="Y"){?>
<?php if($TPL_VAR["autoLogout"]["until_time"]=="0.01"){?>36초<?php }else{?><?php echo $TPL_VAR["autoLogout"]["until_time"]?>시간<?php }?> 동안 액션이 없으면 자동 로그아웃
<?php }else{?>
				미사용
				<div class="gray">- 관리자 리스트에 있는 자동로그아웃 설정 버튼을 클릭하여 설정 가능</div>
<?php }?>
			</td>
		</tr>
	
		<tr>
			<th>
				접속 허용  IP
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip7')"></span>
			</th>
			<td>						
<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'){?>
					<div class="resp_radio">
						<label><input type="radio" name="ip_chk" value="Y" <?php if($TPL_VAR["limit_ip"]){?>checked<?php }?>> 사용함</label>
						<label><input type="radio"  name="ip_chk" value="N" <?php if($TPL_VAR["limit_ip"]==""||$TPL_VAR["limit_ip"]=="N"){?>checked<?php }?>> 사용 안 함</label>
					</div>
<?php }else{?>
<?php if($TPL_VAR["limit_ip_msg"]){?>
						<div>해당 관리자는 아래의 IP에서만 관리페이지 접속 허용</div>
<?php if($TPL_limit_ip_msg_1){foreach($TPL_VAR["limit_ip_msg"] as $TPL_V1){?>
						<div>
							<?php echo $TPL_V1?>

						</div>
<?php }}?>
<?php }else{?>
						관리환경 관리페이지 접속 제한 없음
<?php }?>
<?php }?>					
			</td>
		</tr>
<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'){?>
		<tr class="ip_view">
			<th>접속 IP 설정</th>
			<td>
				<table class="table_basic wauto v7 " id="ipViewTable">				
					<thead>
						<th>IP</th>
						<th><button type="button" id="ipAdd" class="btn_plus"></button></th>
					</thead>
					<tbody>
<?php if(!$TPL_VAR["limit_ip"]){?>
					<tr>
						<td>
							<input type="text" name="limit_ip1[]" value="" class="line limit_ip" size=6 maxlength=3/>.
							<input type="text" name="limit_ip2[]" value="" class="line limit_ip" size=6 maxlength=3/>.
							<input type="text" name="limit_ip3[]" value="" class="line limit_ip" size=6 maxlength=3/>.
							<input type="text" name="limit_ip4[]" value="" class="line limit_ip" size=6 maxlength=3/>
						</td>
						<td class="center">
							<button type="button" id="ipDel" class="btn_minus"  onclick="del_ip(this)"></button>
						</td>
					</tr>
<?php }else{?>
<?php if($TPL_limit_ip_1){foreach($TPL_VAR["limit_ip"] as $TPL_V1){?>
					<tr>
						<td>
							<input type="text" name="limit_ip1[]" value="<?php echo $TPL_V1[ 0]?>" class="line limit_ip" size=6 maxlength=3/>.
							<input type="text" name="limit_ip2[]" value="<?php echo $TPL_V1[ 1]?>" class="line limit_ip" size=6 maxlength=3/>.
							<input type="text" name="limit_ip3[]" value="<?php echo $TPL_V1[ 2]?>" class="line limit_ip" size=6 maxlength=3/>.
							<input type="text" name="limit_ip4[]" value="<?php echo $TPL_V1[ 3]?>" class="line limit_ip" size=6 maxlength=3/>
						</td>
						<td class="center">
							<button type="button" id="ipDel" class="btn_minus" onclick="del_ip(this)"></button>
						</td>
					</tr>
<?php }}?>
<?php }?>
					</tbody>
				</table>
			</td>
		</tr>
<?php }?>
		<tr>
			<th>
				로그인 접속 허용 IP
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip9')"></span>
			</th>
			<td>					
<?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>	
					<div class="resp_radio">
						<label><input type="radio" name="admin_ip_chk" value="Y" <?php if($TPL_VAR["admin_limit_ip"]){?>checked<?php }?> onclick="admin_init_func();"> 사용함</label>
						<label><input type="radio"  name="admin_ip_chk" value="N" <?php if($TPL_VAR["admin_limit_ip"]==""||$TPL_VAR["admin_limit_ip"]=="N"){?>checked<?php }?> onclick="admin_init_func();"> 사용 안 함</label>	
					</div>
<?php }else{?>
<?php if($TPL_VAR["admin_limit_ip_msg"]){?>
						<div>아래의 IP에서만 관리환경 로그인페이지 관리환경 관리페이지 접속 제한 없음</div>
<?php if($TPL_admin_limit_ip_msg_1){foreach($TPL_VAR["admin_limit_ip_msg"] as $TPL_V1){?>
						<div>
							<?php echo $TPL_V1?>

						</div>
<?php }}?>
<?php }else{?>
						관리환경 로그인페이지 접속 제한 없음
<?php }?>
<?php }?>				
			</td>
		</tr>

<?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>	
		<tr class="admin_limit_ip">
			<th>로그인 IP 설정</th>
			<td>					
				<table class="table_basic wauto v7" id="adminIpCell">	
					
					<thead>
						<th>IP</th>
						<th><button type="button" id="adminIpAdd" class="btn_plus"></button></th>
					</thead>
					<tbody>	
<?php if(!$TPL_VAR["admin_limit_ip"]){?>								
					<tr>
						<td>
							<input type="text" name="admin_limit_ip1[]" value="" class="line admin_limit_ip" size="6" maxlength="3" />.
							<input type="text" name="admin_limit_ip2[]" value="" class="line admin_limit_ip" size="6" maxlength="3" />.
							<input type="text" name="admin_limit_ip3[]" value="" class="line admin_limit_ip" size="6" maxlength="3" />.
							<input type="text" name="admin_limit_ip4[]" value="" class="line admin_limit_ip" size="6" maxlength="3" />
						</td>
						<td class="center">
							<button type="button" class="btn_minus" id="adminIpDel" onclick="del_admin_ip(this)"></button>
						</td>
						
					</tr>
<?php }else{?>
<?php if($TPL_admin_limit_ip_1){foreach($TPL_VAR["admin_limit_ip"] as $TPL_V1){?>
					<tr>
						<td>
							<input type="text" name="admin_limit_ip1[]" value="<?php echo $TPL_V1[ 0]?>" class="line admin_limit_ip" size="6" maxlength="3" />.
							<input type="text" name="admin_limit_ip2[]" value="<?php echo $TPL_V1[ 1]?>" class="line admin_limit_ip" size="6" maxlength="3" />.
							<input type="text" name="admin_limit_ip3[]" value="<?php echo $TPL_V1[ 2]?>" class="line admin_limit_ip" size="6" maxlength="3" />.
							<input type="text" name="admin_limit_ip4[]" value="<?php echo $TPL_V1[ 3]?>" class="line admin_limit_ip" size="6" maxlength="3" />
						</td>
						<td class="center">								
							<button type="button" class="btn_minus" id="adminIpDel" onclick="del_admin_ip(this)"></button>								
						</td>
					</tr>
<?php }}?>
<?php }?>
					</tbody>
				</table>			
			</td>
		</tr>
<?php }?>

		<tr>
			<th>
				접속 허용 휴대폰
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip8')"></span>
			</th>
<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'){?>	
			<td class="clear">						
					<ul class="ul_list_02">
																	
<?php if($TPL_VAR["sms_st"]=='1'){?>
					<li>
						<span class="red bold"> SMS 발송 보안키가 없습니다. 먼저 보안키를 등록해 주세요.</span> <a href="/admin/member/sms_auth" class="resp_btn">등록</a>
					</li>
<?php }elseif($TPL_VAR["sms_st"]=='2'){?>
					<li>
						<span class="red bold">SMS 발신번호 인증이 완료되지 않았습니다. 먼저 발신번호를 인증해주세요.</span> <a href="https://firstmall.kr/myshop/index.php" target="_blank" class="resp_btn">인증</a>
					</li>
<?php }?>
					
					<li>
						<div class="resp_radio">
							<label><input type="radio" name="hp_chk" value="Y" <?php if($TPL_VAR["auth_hp"]){?>checked<?php }?>> 사용함</label>
							<label><input type="radio"  name="hp_chk" value="N" <?php if($TPL_VAR["auth_hp"]==""||$TPL_VAR["auth_hp"]=="N"){?>checked<?php }?>> 사용 안 함</label>	
						</div>
					</li>
				</ul>
			</td>
<?php }else{?>	
			<td>
<?php if(!$TPL_VAR["auth_hp"]){?>
					관리환경 관리페이지 접속 제한 없음
<?php }?>
			</td>
<?php }?>	
		</tr>

		<tr class="auth_hp">
			<th>휴대폰 설정</th>
			<td>						 
<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'){?>								
					<input type="text" name="auth_hp" value="<?php echo $TPL_VAR["auth_hp"]?>" class="line auth_hp"/>
<?php if($TPL_VAR["sms_st"]!='Y'){?>
					<script>$("input[name='hp_chk']").attr('disabled',true);</script>
<?php }?>
<?php }else{?>
<?php if($TPL_VAR["auth_hp"]){?>								
					해당 관리자는 아래의 휴대폰번호로 인증 시 관리페이지 접속 허용<br>
					<?php echo $TPL_VAR["auth_hp"]?>

<?php }?>
<?php }?>
					<div class="gray">- 1일 1회 1기기에 한해 인증 필요, 문자 잔여건수가 없을 경우 미 동작</div>						
			</td>
		</tr>				
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">
		메뉴 상단 건수 표시
		<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip2')"></span>
	</div>

	<table class="table_basic thl">
<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'||$TPL_VAR["managerInfo"]["manager_id"]==$TPL_VAR["manager_id"]){?>
		<tr>
			<th>
				주문
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip3', 'sizeR')"></span>
			</th>
			<td>
				최근
				<select name="noti_count_priod_order">
					<option value="1주일" <?php if($TPL_VAR["noti_acount_priod"]["order"]=='1주일'){?>selected<?php }?>>1주일</option>
					<option value="2주일" <?php if($TPL_VAR["noti_acount_priod"]["order"]=='2주일'){?>selected<?php }?>>2주일</option>
					<option value="1개월" <?php if($TPL_VAR["noti_acount_priod"]["order"]=='1개월'){?>selected<?php }?>>1개월</option>
					<option value="3개월" <?php if($TPL_VAR["noti_acount_priod"]["order"]=='3개월'){?>selected<?php }?>>3개월</option>
					<option value="6개월" <?php if($TPL_VAR["noti_acount_priod"]["order"]=='6개월'){?>selected<?php }?>>6개월</option>
				</select>
				동안 처리해야 할 주문 건수
			</td>
		</tr>

		<tr>
			<th>게시판</th>
			<td>
				최근
				<select name="noti_count_priod_board">
					<option value="1주일" <?php if($TPL_VAR["noti_acount_priod"]["board"]=='1주일'){?>selected<?php }?>>1주일</option>
					<option value="2주일" <?php if($TPL_VAR["noti_acount_priod"]["board"]=='2주일'){?>selected<?php }?>>2주일</option>
					<option value="1개월" <?php if($TPL_VAR["noti_acount_priod"]["board"]=='1개월'){?>selected<?php }?>>1개월</option>
					<option value="3개월" <?php if($TPL_VAR["noti_acount_priod"]["board"]=='3개월'){?>selected<?php }?>>3개월</option>
					<option value="6개월" <?php if($TPL_VAR["noti_acount_priod"]["board"]=='6개월'){?>selected<?php }?>>6개월</option>
				</select>
				동안 처리해야 할 게시물 건수 <span class="fx11">(1:1문의, 상품문의)</span>
			</td>
		</tr>

<?php if($TPL_VAR["num_menu_count"]> 0){?>

<?php if($TPL_VAR["is_provider_solution"]){?>
		<tr>					
			<th>정산</th>
			<td>
				최근
				<select name="noti_count_priod_account">
					<option value="1주일" <?php if($TPL_VAR["noti_acount_priod"]["account"]=='1주일'){?>selected<?php }?>>1주일</option>
					<option value="2주일" <?php if($TPL_VAR["noti_acount_priod"]["account"]=='2주일'){?>selected<?php }?>>2주일</option>
					<option value="1개월" <?php if($TPL_VAR["noti_acount_priod"]["account"]=='1개월'){?>selected<?php }?>>1개월</option>
					<option value="3개월" <?php if($TPL_VAR["noti_acount_priod"]["account"]=='3개월'){?>selected<?php }?>>3개월</option>
					<option value="6개월" <?php if($TPL_VAR["noti_acount_priod"]["account"]=='6개월'){?>selected<?php }?>>6개월</option>
				</select>
				동안 처리해야 할 정산 건수
			</td>					
		</tr>
<?php }?>
		
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'){?>
		<tr>					
			<th>발주/입고</th>
			<td>
				최근
				<select name="noti_count_priod_warehousing">
					<option value="1주일" <?php if($TPL_VAR["noti_acount_priod"]["warehousing"]=='1주일'){?>selected<?php }?>>1주일</option>
					<option value="2주일" <?php if($TPL_VAR["noti_acount_priod"]["warehousing"]=='2주일'){?>selected<?php }?>>2주일</option>
					<option value="1개월" <?php if($TPL_VAR["noti_acount_priod"]["warehousing"]=='1개월'){?>selected<?php }?>>1개월</option>
					<option value="3개월" <?php if($TPL_VAR["noti_acount_priod"]["warehousing"]=='3개월'){?>selected<?php }?>>3개월</option>
					<option value="6개월" <?php if($TPL_VAR["noti_acount_priod"]["warehousing"]=='6개월'){?>selected<?php }?>>6개월</option>
				</select>
				동안 처리해야 할 주문 건수 표시
			</td>					
		</tr>
<?php }?>
<?php }?>

<?php }else{?>
		<tr>
			<th>
				주문
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip3', 'sizeR')"></span>
			</th>
			<td>
				최근
				<?php echo $TPL_VAR["noti_acount_priod"]["order"]?>

				동안 처리해야 할 주문 건수 표시
			</td>
		</tr>

		<tr>
			<th>게시판</th>
			<td>
				최근
				<?php echo $TPL_VAR["noti_acount_priod"]["board"]?>

				동안 처리해야 할 게시물 건수 표시
				<div>
					<span class="desc-reference-mark">※</span>
					<span class="desc">1:1문의, 상품문의</span>
				</div>
			</td>
		</tr>

<?php if($TPL_VAR["num_menu_count"]> 0){?>
		<tr>
<?php if($TPL_VAR["is_provider_solution"]){?>
			<th>정산</th>
			<td>
				최근
				<?php echo $TPL_VAR["noti_acount_priod"]["account"]?>

				동안 처리해야 할 정산 건수 표시
			</td>
<?php }?>
<?php if($TPL_VAR["scm_cfg"]['use']=='Y'){?>
			<th>발주/입고</th>
			<td>
				최근
				<?php echo $TPL_VAR["noti_acount_priod"]["warehousing"]?>

				동안 처리해야 할 주문 건수 표시
			</td>
<?php }?>
		</tr>
<?php }?>

<?php }?>
	</table>
</div>

<div class="contents_dvs">
	<div class="item-title">티켓 상품 판매 처리</div>
	<table class="table_basic thl">
		<tr>
			<th>
				사용 확인 코드
				<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip5', 'sizeR')"></span>
			</th>
			<td>
				<table id="cerfify_manager" class="table_row_basic v4 tdc wx900">
					<colgroup>
					<col /><col /><col width="13%"/><col width="15%"/><col width="10%"/>
					</colgroup>
					<thead>
					<tr>
						<th>매장 정보</th>
						<th>확인 코드</th>
						<th>인증</th>
						<th>SMS 전송 알림</th>
						<th><button type="button" id="addManager" class="btn_plus btnplusminus"></button></th>
					</tr>
					</thead>
					<tbody>
<?php if($TPL_VAR["certify"]){?>
<?php if($TPL_certify_1){foreach($TPL_VAR["certify"] as $TPL_V1){?>
					<tr>
						<td>
							<input type="hidden" name="certify_seq[]" value="<?php echo $TPL_V1["seq"]?>" size="10" />
							<input type="text" name="manager_name[]" value="<?php echo $TPL_V1["manager_name"]?>" size="35" title="매장 정보"/>
						</td>
						<td>
							<input type="hidden" name="certify_code_chk[]" value="ok" />
							<input type="text" name="certify_code[]" value="<?php echo $TPL_V1["certify_code"]?>" size="35" title="6-16 자리 이하 영문 또는 숫자" />
						</td>
						<td><button type="button" class="certify_btn resp_btn v2">인증</button></td>
						<td><button type="button" class="manager_sms_send resp_btn">SMS 전송</button></td>
						<td><button type="button" class="delManager btn_minus btnplusminus"></button></td>
					</tr>						
<?php }}?>
<?php }else{?>
					<tr>
						<td>
							<input type="hidden" name="certify_seq[]" value="" size="10" class="line" />
							<input type="text" name="manager_name[]" value="" size="35" class="line" title="매장 정보"/>
						</td>
						<td>
							<input type="hidden" name="certify_code_chk[]" value="" />
							<input type="text" name="certify_code[]" value="" size="35" class="line" title="6-16 자리 이하 영문 또는 숫자" />
						</td>
						<td><button type="button" class="certify_btn resp_btn v2">인증</button></td>
						<td><button type="button" class="manager_sms_send resp_btn">SMS 전송</button></td>
						<td><button type="button" class="delManager btn_minus btnplusminus"></button></td>									
					</tr>
<?php }?>
				</tbody>
			</table>
			</td>
		</tr>			
	</table>
</div>

<div class="contents_dvs">
	<div class="title_dvs">
		<div class="item-title">관리자 권한</div>
<?php if($TPL_VAR["auth_limit"]&&$TPL_VAR["auth"]["manager_yn"]!='Y'){?>
<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'){?>	
		<button class="resp_btn v3" type="button" id="allClick" gb="none"><span id="click_text">전체 선택</span></button>	
<?php }?>
<?php }?>
	</div>

	<table width="100%" class="table_basic thl" id="authority_tbl">
	
	<thead>
		<th class="left">구분</th>
		<th colspan="2">상세항목</th>
	</thead>
<?php if($TPL_VAR["auth_limit"]&&$TPL_VAR["auth"]["manager_yn"]=='Y'){?>
	<tr>
		<th class="its-th red bold">슈퍼 권한</th>
		<td class="its-td" colspan="2">
			슈퍼관리자만이 모든 관리자에 대하여 보기, 삭제, 생성, 변경(권한)이 가능합니다.<br />
			슈퍼관리자 정보는 본인 외 누설을 절대 금지하십시오.			
		</td>
	</tr>
<?php }?>

<?php if($TPL_VAR["scm_cfg"]['use']=='Y'){?>
<?php if(is_array($TPL_R1=code_load('auth_scmstore'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="2">재고기초</th>
	<td class="its-td">
		<!-- 쇼핑몰별 창고 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth" /> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 쇼핑몰별 창고 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- 거래처(매입처) 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- 거래처 등록 및 수정  -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- 창고 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- 창고 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td"></td>
</tr>
<?php }?>
<?php }}?>
<?php if(is_array($TPL_R1=code_load('auth_scmgoods'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="3">재고관리</th>
	<td class="its-td">
		<!-- 상품관리 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 상품관리 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- 재고조정 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- 재고조정 등록 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- 재고이동 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- 재고이동 등록	 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 6){?>
		<!-- 재고수불부 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 7){?>
		<!-- 재고자산명세서 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td"></td>
</tr>
<?php }?>
<?php }}?>
<?php if(is_array($TPL_R1=code_load('auth_scmautoorder'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="4">발주/입고</th>
	<td class="its-td">
		<!-- 자동발주 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 자동발주 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- 발주 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- 발주 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- 입고 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- 입고 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 6){?>
		<!-- 반출 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 7){?>
		<!-- 반출 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 8){?>
		<!-- 발주입고현황 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 9){?>
		<!-- 발주대비 입고현황 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 10){?>
		<!-- 거래처별 정산 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td"></td>
</tr>
<?php }?>
<?php }}?>
<?php }?>
<?php if(is_array($TPL_R1=code_load('auth_order'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="3">주문</th>
	<td class="its-td">
		<!-- 주문 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 입금확인 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- 출고/배송 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- 개인결제 만들기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- 개인결제 만들기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- 수동 실행 권한 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 6){?>
		<!-- 반품/환불 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 7){?>
		<!-- 반품/환불 정보 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>	
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 8){?>
		<!-- 삭제리스트 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 9){?>
		<!-- 매출증빙자료 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<?php }?>
<?php }}?>

<tr>
	<th class="its-th">오픈마켓</th>
<?php if(is_array($TPL_R1=code_load('auth_openmarket'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>		
		<td class="its-td"><label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label></td>
<?php }}?>			
</tr>


<tr>
	<th class="its-th">상품</th>
	<td class="its-td" colspan="2">
	
<?php if(is_array($TPL_R1=code_load('auth_goods'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<!-- 판매상품 보기/등록/수정/삭제 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }}?>
	</td>
</tr>
<?php if(is_array($TPL_R1=code_load('auth_member'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
<?php if(count(code_load('auth_member'))<= 8){?>
	<th class="its-th" rowspan="4">회원</th>
<?php }else{?>
	<th class="its-th" rowspan="5">회원</th>
<?php }?>
	<td class="its-td" colspan="2">
		<!-- 회원 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 회원 정보 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- 마일리지/포인트 지급 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- 회원정보 다운로드 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" id="member_download" value="Y" <?php if(!$TPL_VAR["isplusfreenot"]){?> disabled='disabled' class='gray readonly'<?php }else{?>class="auth"<?php }?> /> <?php echo $TPL_V1["value"]?></label>
<?php if(!$TPL_VAR["isplusfreenot"]){?>
		<a href="#" class="hand btn_resp" onclick="serviceUpgrade();">업그레이드</a>
<?php }?>
	</td>
</tr>
<tr>
	<td class="its-td" colspan="2">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- 휴면처리리스트 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td" colspan="2">
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- 탈퇴리스트 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 6){?>
		<!-- 회원탈퇴 처리 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td" colspan="2">
<?php }?>
<?php if($TPL_I1== 7){?>
		<!-- SMS 및 메일발송 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	
</tr>
<?php }?>
<?php if($TPL_I1== 8){?>
<tr>
	<td class="its-td" colspan="2">
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 9){?>
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<?php }?>
<?php }}?>
<?php if(is_array($TPL_R1=code_load('auth_promotion'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="3">프로모션/쿠폰</th>
	<td class="its-td" colspan="2">
		<!-- 쿠폰 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 쿠폰/코드 등록 및 발급 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- 할인 이벤트 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- 할인 이벤트 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- 사은품 이벤트 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- 사은품 이벤트 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 6){?>
		<!-- 유입 경로 할인 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 7){?>
		<!-- 유입경로 할인 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 8){?>
		<!-- 출석 이벤트 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 9){?>
		<!-- 출석 이벤트 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<?php }?>
<?php }}?>
<tr>
	<th class="its-th">마케팅</th>
	<td class="its-td">
<?php if(is_array($TPL_R1=code_load('auth_marketplace'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["codecd"]=='marketplace_act'||$TPL_V1["codecd"]=='marketplace_view'){?>
<?php if($TPL_V1["codecd"]=='marketplace_act'){?>
		<label class="resp_checkbox"><input type="checkbox" name="marketplace_view" value="Y" class="auth"/> 입점마케팅 설정 보기</label>
		<label class="resp_checkbox"><input type="checkbox" name="marketplace_act" value="Y" class="auth"/> 입점마케팅 수정</label>
<?php }?>
<?php }else{?>
		<label><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php }}?>
	</td>
</tr>
<tr>
	<th class="its-th">통계</th>
	<td class="its-td" colspan="2">
<?php if(is_array($TPL_R1=code_load('auth_statistic'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
		&nbsp;&nbsp;&nbsp;
<?php }}?>
	</td>
</tr>

<?php if($TPL_VAR["checkO2OService"]){?>
<?php $this->print_("o2o_manager_auth",$TPL_SCP,1);?>

<?php }?>

<?php if(serviceLimit('H_AD')){?>
<?php if(is_array($TPL_R1=code_load('auth_provider'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th">입점사</th>
	<td class="its-td" colspan="2">
		<!-- 입점사 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 입점사 등록 및 수정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<?php }?>
<?php }}?>
<tr>
	<th class="its-th">정산</th>
	<td class="its-td" colspan="2">
<?php if(is_array($TPL_R1=code_load('auth_account'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<!-- 정산리스트 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }}?>
	</td>
</tr>
<?php }?>

<tr>
	<th class="its-th">디자인</th>
	<td class="its-td" colspan="2">
<?php if(is_array($TPL_R1=code_load('auth_design'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<!-- 디자인 권한 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }}?>
	</td>
</tr>
<?php if(is_array($TPL_R1=code_load('auth_setting'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="8">설정</th>
	<td class="its-td">
		<!-- 상점 정보 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!-- 상점 정보 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 2){?>
		<!-- SEO 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 3){?>
		<!-- SEO 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 4){?>
		<!-- SNS/외부연동 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 5){?>
		<!-- SNS/외부연동 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 6){?>
		<!-- 운영방식 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 7){?>
		<!-- 운영방식 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 8){?>
<?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>
		전자결제 보기
<?php }else{?>
		<!-- 전자결제 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 9){?>
<?php if($TPL_VAR["auth"]["manager_yn"]=='Y'){?>
		무통장 계좌 보기
<?php }else{?>
		<!-- 무통장 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 10){?>
		<!-- 회원 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 11){?>
		<!-- 회원 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 12){?>
		<!-- 상품/코드 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 13){?>
		<!-- 상품/코드 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 14){?>
		<!-- 주소/검색 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 15){?>
		<!-- 주소/검색 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 16){?>
		<!-- 주문 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 17){?>
		<!-- 주문 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 18){?>
		<!-- 매출증빙 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 19){?>
		<!-- 매출증빙 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 20){?>
		<!-- 마일리지/예치금 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 21){?>
		<!-- 마일리지/예치금 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 22){?>
		<!-- 배송 설정 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 23){?>
		<!-- 배송 설정 보기 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 24){?>
		<!-- 택배사 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 25){?>
		<!-- 택배사 설정 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 26){?>
		<!-- 보안 보기 -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 27){?>
		<!-- 보안 설정 권한 -->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
	<td class="its-td">
<?php }?>
<?php if($TPL_I1== 28){?>
		<!-- 보안 보기 -->
		<!-- label><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label -->
	</td>
</tr>
<?php }?>
<?php }}?>
<?php if($TPL_boardmanagerlist_1){$TPL_I1=-1;foreach($TPL_VAR["boardmanagerlist"] as $TPL_V1){$TPL_I1++;?>
<tr>
<?php if($TPL_I1== 0){?>
	<th class="its-th" rowspan="<?php echo (count($TPL_VAR["boardmanagerlist"])+ 1)?>">게시판</th>
<?php }?>
	<td class="its-td">
		<input type="hidden" name="boardid[<?php echo $TPL_V1["id"]?>]" value="1"  />
		<label class="resp_checkbox"><input type="checkbox" name="board_view[<?php echo $TPL_V1["id"]?>]" value="1" <?php if($TPL_V1["board_view"]){?> checked="checked" <?php }?>  class="authboard board_view" /> <?php echo getstrcut($TPL_V1["name"], 20)?> 보기</label>
		<label class="resp_checkbox">(<input type="checkbox" name="board_view_pw[<?php echo $TPL_V1["id"]?>]" value="2" <?php if($TPL_V1["board_view_pw"]){?> checked="checked" <?php }elseif(!$TPL_V1["board_view"]){?> disabled="disabled" <?php }?> class="authboard board_view_pw" />비밀글 포함)</label>
		<label class="resp_checkbox">→ <input type="checkbox" name="board_act[<?php echo $TPL_V1["id"]?>]" value="1"   <?php if($TPL_V1["board_act"]){?> checked="checked" <?php }elseif(!$TPL_V1["board_view"]){?> disabled="disabled" <?php }?> class="authboard board_act" />게시물 등록/답변/삭제</label>
	</td>
<?php if($TPL_I1== 0){?>
	<td class="its-td"  rowspan="<?php echo (count($TPL_VAR["boardmanagerlist"])+ 1)?>">
<?php if(is_array($TPL_R2=code_load('auth_board'))&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
		<!-- 게시판 관리 (생성,수정,삭제) -->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V2["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V2["value"]?></label>
<?php }}?>
	</td>
<?php }?>
</tr>
<?php }}?>
<?php if(is_array($TPL_R1=code_load('auth_counsel'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<td class="its-td">
		<!--고객상담 통합게시판 보기-->
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth" /> <?php echo $TPL_V1["value"]?></label>
<?php }?>
<?php if($TPL_I1== 1){?>
		<!--고객상담 통합게시판 관리-->
		<label class="resp_checkbox">→ <input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth" /> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<?php }?>
<?php }}?>
<!--모바일 앱 관리-->
<tr>
	<th class="its-th">모바일앱</th>
	<td class="its-td" colspan="2">
<?php if(is_array($TPL_R1=code_load('auth_mobileapp'))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth" /> <?php echo $TPL_V1["value"]?></label> &nbsp;&nbsp;&nbsp;
<?php }}?>
	</td>
</tr>

<?php if(is_array($TPL_R1=code_load('auth_broadcast'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
<tr>
	<th class="its-th" rowspan="2">라이브 쇼핑</th>
	<td class="its-td" colspan="2">
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<tr>
	<td class="its-td" colspan="2">
<?php }?>
<?php if($TPL_I1== 1){?>
		<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="auth"/> <?php echo $TPL_V1["value"]?></label>
	</td>
</tr>
<?php }?>
<?php }}?>
</table>

</div>

<?php if(code_load('private_order')){?>
<div class="contents_dvs">
	<div class="title_dvs">
		<div class="item-title">개인정보 보호</div>
	</div>

	<table width="100%" class="table_basic thl" id="authority_tbl">
<?php if(is_array($TPL_R1=code_load('private_order'))&&!empty($TPL_R1)){$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1== 0){?>
	<tr>
		<th class="its-th" rowspan="1">주문</th>
		<td class="its-td">
			<!-- 개인정보 항목 마스킹(*) 표시 처리 -->
			<label class="resp_checkbox"><input type="checkbox" name="<?php echo $TPL_V1["codecd"]?>" value="Y" class="authprivate"/> <?php echo $TPL_V1["value"]?></label>
			<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/manager', '#tip12', '')"></span>
		</td>
	</tr>
<?php }?>
<?php }}?>
	</table>
</div>
<?php }?>

<div class="contents_dvs">
	<div class="item-title">
		처리 내역
	</div>

	<table width="100%" class="table_basic thl">
	
	<tr>
		<th>로그</th>
		<td>
			<div class="box_style_04"><?php echo $TPL_VAR["manager_log"]?></div>
			<textarea name="manager_log" style="display:none;"><?php echo $TPL_VAR["manager_log"]?></textarea>
		</td>
	</tr>
<?php if($TPL_VAR["manager_seq"]){?>
	<tr>
		<th>중요행위 발생 로그<?php if($TPL_VAR["managerInfo"]["manager_yn"]=='Y'){?><br/><input type="button" name="list_member_down" class="resp_btn v2" value="전체조회" /><?php }?></th>
		<td>
			<div class="box_style_04">
<?php if($TPL_action_history_data_1){foreach($TPL_VAR["action_history_data"] as $TPL_V1){?>
					<?php echo $TPL_V1["regist_date"]?> <?php echo $TPL_V1["mname"]?>(<?php echo $TPL_V1["manager_id"]?>) - <?php echo $TPL_V1["action_message"]?><br />
<?php }}?>
			</div>
		</td>
	</tr>
<?php }?>
	</table>
<!-- 서브메뉴 바디 : 끝 -->
</div>

<!-- 서브 레이아웃 영역 : 끝 -->
</form>




<div id="admin_limit_info" class="hide">
[관리자 설정 권한]을 부여 받은 관리자가 할 수 있는 업무<br/>
<br/>
<div class="red">
1. 관리자 목록 확인 가능<br/>
2. 관리자 삭제 가능<br/>
3. 관리자 생성 가능<br/>
4. 관리자 정보 변경 가능<br/>
5. 관리자 권한 부여 가능
</div>
<br/>
[관리자 설정 권한]은 모든 권한을 제어할 수 있는 <strong class="red">가장 강력한 권한</strong>입니다.<br/>
권한 부여 시 각별히 주의하십시오.
<br/>
<br/>
	<div align="center">
	<button onclick="closeDialog('admin_limit_info');" class="btn_resp">확인</button>
	</div>
<br/>
</div>

<div id="admin_member_download" class="hide">
회원정보 다운로드 기능 사용 시 개인정보 보호 주의사항<br/>
<br/>
<div class="red">관련 법령에 의거한 귀사의 개인정보처리방침으로 개인정보를 보호 하십시오.</div>
<br/>
<p>회원정보 다운로드 기능 사용 시 더욱 엄격히 개인정보를 보호하셔야 합니다.</p><br/>
<p style="padding-bottom:5px;">개인정보 보호 주의사항</p>
<p style="padding-bottom:5px;">- 개인정보 취급 직원을 최소화 하십시오.</p>
<p style="padding-bottom:5px;">- 개인정보의 다운로드 비밀번호를 정기적으로 갱신하십시오.</p>
<p style="padding-bottom:5px;">- 개인정보를 일정기간 저장 후 파기하십시오.</p>
<p style="padding-bottom:5px;">- 종이에 출력된 개인정보는 분쇄하거나 소각하여 파기하십시오.</p>
<p style="padding-bottom:5px;">- 파일 형태로 저장된 개인정보는 재생할 수 없는 기술적 방법으로 파기하십시오.</p>
<br/>
<br/>
	<div align="center">
	<button onclick="closeDialog('admin_member_download');" class="btn_resp">확인</button>
	</div>
<br/>
</div>

<div id="sendPopup" class="hide"></div>
<div id="admin_policy_info" class="hide">
	개인정보의 기술적, 관리적 보호조치 기준에 의거(「정보통신망 이용촉진 및 정보보호 등에 관한 법률」(이하 “법”이라 한다) <br>
	제28조제1항 및 같은 법 시행령 제15조제6항)에 따른 방통위 고시 제2012-50호<br>
	<br>
	다음 각 목의 문자 종류 중 2종류 이상을 조합하여 최소 10자리 이상 또는 3종류 이상을 조합하여 최소 8자리 이상의 길이로 구성<br>
	가. 영문 대문자(26개)<br>
	나. 영문 소문자(26개)<br>
	다. 숫자(10개)<br>
	라. 특수문자(32개)<br>
	<br>
	<hr>
	<br>
	상기 정보통신망 이용촉진 및 정보보호 등에 관한 법률에 따른 방통위 시행령에 따라 <br>
	개인정보 보호 책임자의 비밀번호는 10자 이상의 영문 대소문자 또는 숫자, 특수문자 중 <br>
	2가지 이상을 조합해서 만들어야 하며 주기적(90일)으로 변경을 하셔야 합니다.
	<br><br>
	<div class="center">
		<button type="button" onclick="closeDialog('admin_policy_info');" class="btn_resp">확인</button>
	</div>
</div>

<?php $this->print_("layout_footer",$TPL_SCP,1);?>