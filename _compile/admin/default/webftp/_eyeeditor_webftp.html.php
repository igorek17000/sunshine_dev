<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/webftp/_eyeeditor_webftp.html 000026643 */ ?>
<link rel="stylesheet" type="text/css" href="/app/javascript/plugin/jqcontextmenu/jquery.contextMenu.css" />

<style>
#miniWebFtpOpenBtn {position:fixed; top:70px; left:0px; width:16px; height:32px; line-height:32px; text-align:center; color:red; font-size:11px; cursor:pointer; border:1px solid black; background-color:#fff;}
#miniWebFtpCloseBtn {float:right; width:16px; height:32px; line-height:32px; text-align:center; color:red; font-size:11px; cursor:pointer; border-left:1px solid #ccc; background-color:#fff;}

#miniWebFtpContainer {position:fixed; width:200px; overflow:hidden; top:70px; left:0px; border-top:1px solid #aaa; border-right:1px solid #ccc; display:none;}
#miniWebFtpContainer		.miniWebFtpBodyLayer {}
#miniWebFtpContainer 		.miniWebFtpTitleLayer {position:absolute; width:120px; left:50%; margin-left:-60px; border-bottom:1px solid #7c7c7c; text-align:center; height:19px; margin-top:-19px;}
#miniWebFtpContainer		.miniWebFtpTitleLayer .closedBtn {display:block; cursor:pointer}
#miniWebFtpContainer		.miniWebFtpTitleLayer .openedBtn {display:none; cursor:pointer}
#miniWebFtpContainer.show	.miniWebFtpTitleLayer .openedBtn {display:block}
#miniWebFtpContainer.show	.miniWebFtpTitleLayer .closedBtn {display:none}

#directoryExplorerHeader td {height:32px; border-bottom:1px solid #ccc;}
#directoryExplorer {background-color:#fff; width:200px; height:200px; overflow:auto;}

#fileExplorerHeader td {padding:5px; border-top:1px solid #ccc; border-bottom:1px solid #ccc;}
#fileExplorer {background-color:#fff; height:200px; overflow:auto;}
#fileExplorer ul li {cursor:pointer}
#fileExplorer ul li.item {height:20px; line-height:20px; text-indent:4px; border:1px solid #fff; font-size:11px; color:#333; font-family:tahoma;  white-space:nowrap;}
#fileExplorer ul li.item:hover {background-color:#ddeeff;}
#fileExplorer ul li.item.selectedItem,
#fileExplorer ul li.selectedItem {border:1px dotted #ddd; background-color:#0066cc; color:#fff;}

#searchFileKeyword {height:14px; width:140px; padding:2px; font-size:11px;}
#fileExplorerSearchBar td {padding:5px; border-top:1px solid #ccc;}

#imagePreviewLayer {display:none; position:fixed; left:200px; top:103px; padding:30px; border:2px solid #333; background-color:#fff;}
#imagePreviewLayer table {width:200px; height:100%; text-align:center; border-collapse:collapse;}
#imagePreviewLayer .ipl-image {display:inline-block; max-width:550px; max-height:500px; border:2px dotted #ddd; overflow:hidden; margin:auto; text-align:center;}
#imagePreviewLayer .ipl-image img {max-width:500px; max-height:500px;}
#imagePreviewLayer .ipl-name {text-align:center; margin-top:5px; font-size:11px; background-color:#fff;}
#imagePreviewLayer .ipl-scalesize {margin-top:2px; font-size:11px; background-color:#fff;}

</style>

<script type="text/javascript" src="/app/javascript/plugin/jstree/jquery.jstree.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jqcontextmenu/jquery.contextMenu.js"></script>
<script type="text/javascript">

var webftpNowPath;
var fileListOptions = {
	'keyword' : '',
	'sortBy' : 'name', // time, name
	'sortOrder' : 'desc' // desc, asc
};
var imagePreviewLayerForcedShow = false;
var lastContextMenuObj = null;
var fileContextMenuItems = {};

<?php if($TPL_VAR["EYE_EDITOR"]){?>
<?php if($_GET["template_path"]){?>
		var defaultPath = '<?php echo dirname($_GET["template_path"])?>';
<?php }else{?>
	var defaultPath = 'data/skin/<?php echo $TPL_VAR["designWorkingSkin"]?>';
<?php }?>
<?php }else{?>
	var defaultPath = 'data/skin/<?php echo $TPL_VAR["designWorkingSkin"]?>/images';
<?php }?>
var webftpReady = false;
var useWebftpFormItem = true;

$(function () {
	/* 폼 셀렉터 사용 설정 */
	$(".webftpFormItem:first-child input[type=radio][name=webftpFormItemSelector]").attr('checked',true);
	if($(".webftpFormItem").length==0) useWebftpFormItem = false;
	
	/* 슬라이딩 버튼 */
	$("#miniWebFtpOpenBtn").bind("click",function(){
		$(".EyeEditorSideBlank").show();
		$("#miniWebFtpContainer").show();
		$("#miniWebFtpOpenBtn").hide();
		miniWebFtpContainerResize();
	}).click();
	$("#miniWebFtpCloseBtn").bind("click",function(){
		$(".EyeEditorSideBlank").hide();
		$("#miniWebFtpContainer").hide();
		$("#miniWebFtpOpenBtn").show();
	});

	/* 파일 메뉴 설정*/
	if(useWebftpFormItem) fileContextMenuItems["apply_to_form"] = {name: "선택"};
<?php if($TPL_VAR["EYE_EDITOR"]){?>
	fileContextMenuItems["source_edit"] = {name: "파일편집", icon: "edit"};
<?php }else{?>
	//fileContextMenuItems["image_edit"] = {name: "이미지편집", icon: "edit"};
<?php }?>
	fileContextMenuItems["url_copy"] = {name: "주소복사", icon: "copy"};
	fileContextMenuItems["download_file"] = {name: "PC 저장", icon: "paste"};
	fileContextMenuItems["popup"] = {name: "새창으로 보기"};
	fileContextMenuItems["sep1"] = "---------";
	fileContextMenuItems["remove_file"] = {name: "삭제", icon: "delete"};

	$("#directoryExplorer")
	.jstree({
		"plugins" : [ "themes","json_data","ui","crrm","contextmenu","types"],
		"json_data" : {
			"ajax" : {
				"url" : "/admin/webftp/process",
				"global" : false,
				"data" : function (n) {
					return {
						"operation" : "get_folder_children",
						"childPath" : n.attr ? n.attr("childPath") : ''
					};
				}
			}
		},
		"core" : {
			"strings" : {
				new_node	: "new_folder"
			}
		},
		"types" : {
			"valid_children" : [ "root" ],
			"types" : {
				"root" : {
					"icon" : {
						"image" : "/admin/skin/default/images/common/_drive.png"
					},
					"close_node" : false
				}
			}
		},
		"contextmenu" : {
			"items" : {
				"create" : {"label"				: "새 폴더", "separator_after" : false},
				"rename" : {"label"				: "폴더 이름변경"},
				"remove" : {"label"				: "폴더 삭제"},
				"ccp" : null
			}
		},
		"ui" : {
			"select_limit" : 1
		}
	})
	.bind("loaded.jstree",function(e, data){
		$.jstree._focused().select_node("li:eq(0)");
	})
	.bind("open_node.jstree", function (e, data) {
		if(!webftpReady) $.jstree._focused().deselect_all();
		$.jstree._focused().select_node(data.rslt.obj);

    })
	.bind("select_node.jstree",function(e, data){

		var childPath = data.rslt.obj.attr('childPath');

		if(!webftpReady && childPath){

			var defaultPathDiv = defaultPath.split('/');
			var childPathDiv = childPath.split('/');
			for(var i=0;i<childPathDiv.length;i++){
				if(childPathDiv[i]==defaultPathDiv[0]) {
					defaultPathDiv.shift();
				}
			}

			if(defaultPathDiv.length){
				var nextChildPath = childPathDiv.join('/') + '/' + defaultPathDiv[0];

				if($("#directoryExplorer li[childPath='"+nextChildPath+"']").hasClass('jstree-leaf')){
					setTimeout(function(){
					$.jstree._focused().select_node($("#directoryExplorer li[childPath='"+nextChildPath+"']"));
					},500);
				}else{
					$("#directoryExplorer").jstree('open_node',$("#directoryExplorer li[childPath='"+nextChildPath+"']"));
				}
				return;
			}else{
				webftpReady = true;

				$("#directoryExplorer").scrollTop(
				$("#directoryExplorer li[childPath='"+childPath+"']").offset().top
				- $("#directoryExplorer").offset().top
				+ $("#directoryExplorer").scrollTop()
				);

			}
		}

		if(event && event.type){
			if(event.type=='dblclick'){
				$("#directoryExplorer").jstree('toggle_node',data.rslt.obj);
			}
		}

		getFileList(childPath);
	})
	.bind("create.jstree", function (e, data) {

		if(data.rslt){
			$.get(
				"/admin/webftp/process",
				{
					"operation" : "create_folder",
					"parentPath" : data.rslt.parent.attr("childPath"),
					"name" : data.rslt.name
				},
				function (r) {

					if(r.status) {
						$(data.rslt.obj).attr("childPath", r.childPath);
					}
					else{
						$.jstree.rollback(data.rlbk);
						if(r.msg){
							openDialogAlert(r.msg,400,140);
						}
					}
				}
			);
		}else{
			$.jstree.rollback(data.rlbk);
		}
	})
	.bind("remove.jstree", function (e, data) {
		openDialogConfirm("선택한 폴더를 정말 삭제하시겠습니까?",400,140,function(){
			data.rslt.obj.each(function (i) {
				$.ajax({
					async : false,
					type: 'get',
					url: "/admin/webftp/process",
					data : {
						"operation" : "remove_folder",
						"childPath" : $(this).attr('childPath')
					},
					success : function (r) {
						if(!r.status) {
							$.jstree.rollback(data.rlbk);
							if(r.msg){
								openDialogAlert(r.msg,400,140);
							}else{
								openDialogAlert("삭제에 실패했습니다.",400,140);
							}
						}
					}
				});
			});
		},function(){
			$.jstree.rollback(data.rlbk);
		});

	})
	.bind("rename.jstree", function (e, data) {
		$.get(
			"/admin/webftp/process",
			{
				"operation" : "rename_folder",
				"childPath" : data.rslt.obj.attr('childPath'),
				"name" : data.rslt.new_name
			},
			function (r) {
				if(r.status) {
					$(data.rslt.obj).attr("childPath", r.childPath);
				}else{
					$.jstree.rollback(data.rlbk);
					if(r.msg){
						openDialogAlert(r.msg,400,140);
					}else{
						openDialogAlert("폴더 이름 변경에 실패했습니다.",400,140);
						$.jstree._focused().select_node(data.rslt.obj);
					}

				}

			}
		);
	});

	/* 정렬버튼 클릭 이벤트 정의 */
	$("select[name='fileSort']").live("change",function(){
		fileListOptions['sortOrder'] = fileListOptions['sortBy'] == $(this).val() ? toggleSortOrder(fileListOptions['sortOrder']) : fileListOptions['sortOrder'];
		sortFileList($(this).val(),fileListOptions['sortOrder']);
	});

	/* 확장자 선택 이벤트 정의 */
	$("select[name='fileExtension']").live("change",function(){
		getFileList(webftpNowPath, true);
	});

	/* 정렬 버튼 마크 설정 */
	setSortOrderBtn();

	/* 드래그차단 */
	$("#fileExplorer").bind("selectstart",false);

	/* 파일항목 마우스 이벤트 정의 */
	$("#fileExplorer ul li.item").live("mousedown contextmenu",function(){
		$("#fileExplorer ul li.selectedItem").removeClass("selectedItem");
		$(this).addClass("selectedItem");
	}).live("mouseenter",function(){
		showImagePreview(this);
	});
	$("#fileExplorer").live("mouseleave",function(){
		if(!imagePreviewLayerForcedShow)	hideImagePreview();
	});

	/* 우클릭메뉴 */
	$.contextMenu({
        selector: '#fileExplorer ul li.item',
        /* 실행 액션 */
        callback: function(key, options) {

        	var $item = $(this);

			switch(key){

				/* 파일 편집 */
				case "source_edit" :
					sourceFileEdit($item.attr('path'));
				break;

				/* 주소 복사 */
				case "url_copy" :
					// setUrlCopy() 함수에서 처리함
				break;

				/* 파일 삭제처리 */
				case "remove_file" :
					openDialogConfirm("\"" + $item.attr('name') + "\"<br /><br /> 파일을 삭제하시겠습니까?",400,175,function(){
						$.ajax({
							"url" : "/admin/webftp/process",
							"type" : "get",
							"data" : {"operation" : "remove_file","path" : $item.attr('path')},
							"success" : function(r){
								if(r.status) {
									/*
									openDialogAlert("삭제되었습니다.",400,140,function(){
										getFileList(webftpNowPath,true);
									});
									*/
									getFileList(webftpNowPath,true);

								}else{
									if(r.msg){
										openDialogAlert(r.msg,400,140);
									}else{
										openDialogAlert("삭제에 실패했습니다.",400,140);
									}
								}
							}
						});
					});
				break;

				/* 새창으로 보기 */
				case "popup" :
					window.open("/"+$item.attr("path"));
				break;

				/* 다운로드 */
				case "download_file" :
					$("iframe[name='actionFrame']").attr("src","/admin/webftp/download_file?path=" + encodeURI($item.attr("path")));
				break;

				/* 파일선택 */
				case "apply_to_form" :
					if(useWebftpFormItem){
						var webftpFormItemObj = $("input[type=radio][name='webftpFormItemSelector']:checked").closest(".webftpFormItem");
						webftpFormItemObj.find(".webftpFormItemInput").val($item.attr("path"));
						webftpFormItemObj.find(".webftpFormItemInputOriName").val($item.attr("name"));
						webftpFormItemObj.find(".webftpFormItemPreview").attr('src','/'+$item.attr("path"));
					}
				break;

			}
        },
        /* 메뉴 정의 */
        items: fileContextMenuItems,
        events: {
        	'show' : function(obj){
        		showImagePreview(this);
        		imagePreviewLayerForcedShow = true;
        		lastContextMenuObj = this;

        		setTimeout("setUrlCopy('"+$(this).attr('path')+"')",100);

        	},
        	'hide' : function(){
        		imagePreviewLayerForcedShow = false;
        		hideImagePreview();
        	}
        }
    });


	/* 이미지업로드 레이어 세팅 */
	openDialog("이미지 업로드 <span class='desc'>이미지 파일을 업로드합니다.</span>", "webftpImageUploadDialog", {"width":600,"height":300,"autoOpen":false,"close":function(){
		
	}});

	
	$(window).resize(function(){
		miniWebFtpContainerResize();
	}).trigger('resize');

});

function miniWebFtpContainerResize(){
	var miniWebFtpContainerHeight = parseInt($(window).height())-parseInt($("#miniWebFtpContainer").offset().top); 
	var explorerHeight = (miniWebFtpContainerHeight-$("#directoryExplorerHeader").height()-$("#fileExplorerHeader").height()-$("#fileExplorerSearchBar").height()) / 2;
	$("#directoryExplorer,#fileExplorer").css('height',(explorerHeight)+'px');
}

/* 파일편집 */
function sourceFileEdit(filePath){
	var filename = filePath.split('/')[filePath.split('/').length-1];
	if(filename.split('.').length>1){
		var fileext = filename.split('.')[filename.split('.').length-1];
		if(fileext=='gif' || fileext=='png' || fileext=='jpg' || fileext=='bmp' || fileext=='tif' || fileext=='pic' || fileext=='ico' || fileext=='xls'){
			openDialogAlert("확장자가 " + fileext + "인 파일은 편집할 수 없습니다.",350,140);
			return;
		}
	}
	searchKeyword = '';
	addTabItem(filePath);
}

/* 주소복사버튼 올리기 */
function setUrlCopy(path){
	$(".icon-copy").css('position','relative').attr('id','fileUrlCopyBtn');
	$('#fileUrlCopyBtn').click(function(){
		clipboard_copy("/" + encodeURI(path));
		alert("주소가 복사되었습니다.\nHTML소스의 원하시는 위치에 Ctrl+V로 붙여넣기 하세요.");
		$(lastContextMenuObj).contextMenu("hide");
	});	
}

/* 파일목록 가져오기 */
function getFileList(path, absolutely){

	if(webftpNowPath != path || absolutely){
		webftpNowPath = path;

		if(!absolutely) {
			fileListOptions['keyword'] = '';
			$("#searchFileKeyword").val('').focusout();
		}
		fileListOptions['fileExtension'] = document.searchFileForm.fileExtension ? document.searchFileForm.fileExtension.value : '';

		$("#fileExplorer").empty().activity({segments: 10, width: 3.5, space: 1, length: 6, color: '#999999', speed: 1.5});

		$.ajax({
			url : "/admin/webftp/process",
			global : false,
			cache: false,
			data : {
				"operation" : "get_source_file_list",
				"path" : webftpNowPath,
				"options" : fileListOptions
			},
			success : function (r) {
				showFileList(r);
			},
			complete : function(){
				$("#fileExplorer").activity(false);
			}
		});
	}
}

/* 파일목록 보여주기 */
function showFileList(loop){

	$("#fileExplorer").empty().append("<ul></ul>");

	for(var i=0;i<loop.length;i++){
		var item = $("<li>");
		item.addClass("item");
		item.html(loop[i].name);
		item.attr(loop[i]);

<?php if($TPL_VAR["EYE_EDITOR"]){?>
		$(item).bind('dblclick',function(){
			sourceFileEdit($(this).attr('path'));
		});
<?php }?>

		$("#fileExplorer ul").append(item);
	}

}

/* 검색 */
function searchFileList(){
	fileListOptions['keyword'] = document.searchFileForm.keyword.value!=document.searchFileForm.keyword.getAttribute('title') ? document.searchFileForm.keyword.value : '';
	getFileList(webftpNowPath, true);
	$("#searchFileKeyword").focus();
}

/* 정렬 */
function sortFileList(sortBy, sortOrder){
	fileListOptions['sortBy'] = sortBy;
	fileListOptions['sortOrder'] = sortOrder;
	getFileList(webftpNowPath, true);
	setSortOrderBtn();
}

/* 정렬순서 토글 */
function toggleSortOrder(sortOrder){
	return sortOrder == 'desc' ? 'asc' : 'desc';
}

/* 정렬버튼 표식 세팅 */
function setSortOrderBtn(){
	var obj = $("select[name='fileSort'].custom-select-box-multi").prev(".drop_multi_sub").prev(".drop_multi_main").children("a");
	var text = obj.text().replace(' ▼','').replace(' ▲','');
	obj.text(text + (fileListOptions['sortOrder']=='desc'?' ▼':' ▲'));
}

/* 이미지 미리보기 */
function showImagePreview(item){

	//$("#directoryExplorer").css('opacity','0.1');

	var tmpDiv = $(item).attr('path').split('.');
	var ext = tmpDiv[tmpDiv.length-1];

	if(ext!='gif' && ext!='jpg' && ext!='jpeg' && ext!='tif' && ext!='pic' && ext!='png' && ext!='bmp'){
		return;
		//$("#imagePreviewLayer .ipl-image").hide();
	}else{
		$("#imagePreviewLayer .ipl-image").show().html("<img src='/"+$(item).attr('path')+"' />");
	}

	$("#imagePreviewLayer .ipl-name").html($(item).attr('name'));
	$("#imagePreviewLayer .ipl-scale").html($(item).attr('scale'));
	$("#imagePreviewLayer .ipl-size").html(getSizeFormat($(item).attr('size')));
	$("#imagePreviewLayer").show();
}

/* 이미지 미리보기 숨기기 */
function hideImagePreview(item){
	//$("#directoryExplorer").css('opacity','1');
	$("#imagePreviewLayer").hide();
}

/* 용량 포맷 */
function getSizeFormat(bytes){
	if(bytes>1024*1024) return comma(bytes/1024/1024) + "MB";
	else if(bytes>1024) return comma(bytes/1024) + "KB";
	else return comma(bytes) + "Byte";
}

/* 이미지 업로드 레이어 보기 */
function showWebftpImageUploadDialog(){
	

	if(webftpNowPath){
		/* Uploadify path 변경 */
		$("#webftpImageUploadDialog .uploadPath").html(webftpNowPath);
		$("#webftpImageUploadDialog").dialog("open");


		/* 파일업로드버튼 ajax upload 적용 */
		var imgopt			= {
			'eventType' : 'none',
			'file_path' : webftpNowPath,
			'btnSubmit' : $('.btnUpload'),
			'overwrite' : false,
		};
		var imgcallback	= function(res){
			var that		= this;
			var result		= eval(res);

	

			if(result.status){
				getFileList(webftpNowPath,true);
				$('#webftpImageUploadDialog').dialog("close");
			}else{
				if(errinfo = result.msg.match(/^upload_file_already_exists(?:\:(.*))?/)) {
					openCustomDialog({
						'text': '대상 폴더에 이름이 "'+errinfo[1]+'"인 파일이 이미 있습니다.<br><br>',
						'title': '파일 이름 겹침',
						'buttons': [
							{
								'text': '덮어쓰기',
								'action': function() {
									imgopt.btnSubmit.data('opt', {'overwrite': true});
									imgopt.btnSubmit.click();
									imgopt.btnSubmit.data('opt', {});
								}
							},
							{
								'text': '이름 바꾸기',
								'action': function(e) {
									var new_name = prompt('새 이름을 입력하세요', errinfo[1]);
									if(!new_name) { e.preventDefault(); return; }
									imgopt.btnSubmit.data('opt', {'filename': new_name});
									imgopt.btnSubmit.click();
									imgopt.btnSubmit.data('opt', {});
								}
							},
							{
								'text': '취소',
								'default': true
							}
						]
					});
					return false;
				}
				openDialogAlert(result.msg,400,150);
				return false;
			}
		};

		// ajax 이미지 업로드 이벤트 바인딩
		$('#webftpImageUploadButton').createAjaxFileUpload(imgopt, imgcallback);

	}
}

</script>

<div id="miniWebFtpOpenBtn">
	▶
</div>

<div id="miniWebFtpContainer">
	<div class="miniWebFtpBodyLayer">
		<form name="searchFileForm" onsubmit="searchFileList();return false;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<col width="250" />
		<tr class="hide">
			<td>
				<!--
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<span class="fl hand"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_folder_new.gif" title="폴더추가" onclick="$('#directoryExplorer').jstree('create',null,'last')" /></span>
						<span class="fl hand"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_folder_rename.gif" title="폴더이름변경" onclick="$('#directoryExplorer').jstree('rename')" /></span>
						<span class="fl hand"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_folder_del.gif" title="폴더삭제" onclick="$('#directoryExplorer').jstree('remove')" /></span>
						<span class="fl hand"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_refresh.gif" title="새로고침" onclick="$('#directoryExplorer').jstree('refresh',$('#directoryExplorer').jstree('get_selected'));" /></span>
						<span class="fl hand"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_img_upload.gif" title="이미지업로드" onclick="showWebftpImageUploadDialog()" /></span>
					</td>
					<td align="left">
						<input type="text" id="searchFileKeyword" name="keyword" value="" title="<?php if(!$TPL_VAR["EYE_EDITOR"]){?>디렉토리 내 이미지 검색<?php }else{?>파일명, 확장자<?php }?>"/>
						<span class="btn small"><input type="submit" value="검색" /></span>
					</td>
					<td align="center">
						<span class="desc">파일명에 마우스 오른쪽을 클릭하세요. 퀵메뉴가 나타납니다.</span>
					</td>
					<td align="right">
<?php if($TPL_VAR["EYE_EDITOR"]){?>
						<select name="fileExtension">
							<option value="">All Files (*.*)</option>
							<option value="txt,ini,csv">Text (*.txt, *.ini, *.csv)</option>
							<option value="htm,html">Html (*.htm, *.html)</option>
							<option value="js">Javascript (*.js)</option>
							<option value="css">CSS (*.css)</option>
						</select>
<?php }?>
						<span class="btn small"><button class="sort-btn" value="time">등록순 <span class="sortOrderMark"></span></button></span>
						<span class="btn small"><button class="sort-btn" value="name">이름순 <span class="sortOrderMark"></span></button></span>
						<span class="btn small"><button class="sort-btn" value="size">용량순 <span class="sortOrderMark"></span></button></span>
					</td>
				</tr>
				</table>
				-->
				
				
			</td>
		</tr>
		<tr id="directoryExplorerHeader">
			<td>
				<div class="clearbox">
					<span class="fl hand pdl5 pdt7"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_folder_new.gif" title="폴더추가" onclick="$('#directoryExplorer').jstree('create',null,'last')" /></span>
					<span class="fl hand pdt7"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_folder_rename.gif" title="폴더이름변경" onclick="$('#directoryExplorer').jstree('rename')" /></span>
					<span class="fl hand pdt7"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_folder_del.gif" title="폴더삭제" onclick="$('#directoryExplorer').jstree('remove')" /></span>
					<span class="fl hand pdt7"><img hspace="2" src="/admin/skin/default/images/design/directory_icon_refresh.gif" title="새로고침" onclick="$('#directoryExplorer').jstree('refresh',$('#directoryExplorer').jstree('get_selected'));" /></span>

					<span class="fl hand pdt7">
<?php if($TPL_VAR["functionLimit"]){?>
						<img hspace="2" src="/admin/skin/default/images/design/directory_icon_img_upload.gif" title="이미지업로드" onclick="servicedemoalert('use_f');" />
<?php }else{?>
						<img hspace="2" src="/admin/skin/default/images/design/directory_icon_img_upload.gif" title="이미지업로드" onclick="showWebftpImageUploadDialog()" />
<?php }?>
					</span>
					<div id="miniWebFtpCloseBtn">
						◀
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="relative">
					<div id="directoryExplorer"></div>
				</div>
			</td>
		</tr>
		<tr id="fileExplorerHeader">
			<td>
				<div class="clearbox">
				<div class="fl">
				<select name="fileExtension" class="custom-select-box">
					<option value="">All Files (*.*)</option>
					<option value="txt,ini,csv">Text (*.txt, *.ini)</option>
					<option value="htm,html">Html (*.htm, *.html)</option>
					<option value="js">Javascript (*.js)</option>
					<option value="css">CSS (*.css)</option>
				</select>
				</div>
				<div class="fr">
				<select name="fileSort" class="custom-select-box-multi">
					<option value="name">이름순</option>
					<option value="time">등록순</option>
					<option value="size">용량순</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div id="fileExplorer"></div>
			</td>
		</tr>
		<tr id="fileExplorerSearchBar">
			<td>
				<input type="text" id="searchFileKeyword" name="keyword" value="" title="<?php if(!$TPL_VAR["EYE_EDITOR"]){?>디렉토리 내 이미지 검색<?php }else{?>파일명, 확장자<?php }?>"/>
				<span class="btn small"><input type="submit" value="검색" /></span>
			</td>
		</tr>
		</table>

		<!-- 이미지 업로드 다이얼로그 -->
		<div id="webftpImageUploadDialog" class="hide">

			<table width="100%" class="info-table-style">
			<col width="100" />
			<tr>
				<th class="its-th">업로드경로</th>
				<td class="its-td">/<span class="uploadPath"></span></td>
			</tr>
			<tr>
				<th class="its-th">파일찾기</th>
				<td class="its-td">
					<div class="pdr10">
						<img class="webftpImageUploadBtnImage hide" src="/admin/skin/default/images/common/btn_filesearch.gif">
						<input id="webftpImageUploadButton" type="file" name="file" value="" />
					</div>
				</td>
			</tr>
			</table>

			<div class="center pdt20 pdb10"><span class="btn medium"><input type="button" value="업로드" class="btnUpload" /></span></div>
		</div>
		</form>

	</div>
</div>

<div id="imagePreviewLayer">
	<table>
	<tr>
		<td>
			<div class="ipl-image"></div>
			<div class="ipl-name"></div>
			<div><span class="ipl-scalesize"><span class="ipl-scale"></span> (<span class="ipl-size"></span>)</span></div>
		</td>
	</tr>
	</table>
</div>