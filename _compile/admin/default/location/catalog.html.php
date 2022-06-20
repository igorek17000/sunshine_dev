<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/location/catalog.html 000007426 */ ?>
<?php $this->print_("layout_header",$TPL_SCP,1);?>


<script type="text/javascript" src="/app/javascript/plugin/editor/js/editor_loader.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/editor/js/daum_editor_loader.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jstree/jquery.jstree.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/jquery.colorpicker.min.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/custom-color-picker.js"></script>
<script type="text/javascript" src="/app/javascript/plugin/custom-font-decoration.js"></script>
<script type="text/javascript" src="/app/javascript/js/base64.js"></script>
<script type="text/javascript">var categoryDefault = <?php echo $TPL_VAR["categoryDefault"]?>;</script>
<script type="text/javascript" src="/app/javascript/js/admin/category.js?mm=<?php echo date('Ymd')?>"></script>
<script type="text/javascript" src="/app/javascript/plugin/jstree/category_jstree.js"></script>
<script type="text/javascript">
	function view(result){
		var len = result.length - 1;
		var arr = new Array();
		var isGroups = false;
		for(var i=0;i<=len;i++){
			arr[i] = result[i].title;
			if(i == len){			
				
				$("input[name='hide'][value='"+result[i].hide+"']").attr("checked",true);
				$("input[name='node_type'][value='"+result[i].node_type+"']").attr("checked",true);
				$("input[name='node_text_normal']").val(result[i].node_text_normal).change();
				$("input[name='node_text_over']").val(result[i].node_text_over).change();
				
				if(result[i].node_image_normal){
					$("#node_image_normal_preview").attr('src',result[i].node_image_normal).show();
					$("input[name='node_image_normal']").val(result[i].node_image_normal);
				}else{
					$("#node_image_normal_preview").hide();
					$("input[name='node_image_normal']").val('');
				}
				
				if(result[i].node_image_over){
					$("#node_image_over_preview").attr('src',result[i].node_image_over).show();
					$("input[name='node_image_over']").val(result[i].node_image_over);
				}else{
					$("#node_image_over_preview").hide();
					$("input[name='node_image_over']").val('');
				}
				
				$("#goodsCnt").html(comma(result[i].goodsCnt));			
				$("input[name='locationCode']").val(result[i].location_code);
				var locationCode = $("input[name='locationCode']").val();
				$("#urlLocation").html(locationUrl+locationCode);	
			}
		}
		if(!isGroups)$("input[type='checkbox'][name='memberGroup']").attr("checked",false);	
		$("#locationNavi").html(arr.join(" > "));	
		viewLocationInfo({'mode':'info'});

		$(".customFontDecoration").customFontDecoration();
		
		disableNodeTypeDecoration();	
	}

	function viewLocationInfo(opts){
		
		if(opts){
			for(var i in opts){
				$("input[name='"+i+"']").val(opts[i]);
			}
		}

		var locationCode = $("input[name='locationCode']").val();
		var mode = $("input[name='mode']").val();
		
		if($.jstree._focused() && locationCode){
			$.jstree._focused().deselect_all();
			$.jstree._focused().select_node($("#tree li ins[location='"+locationCode+"']").closest("li")[0]);
		}
		
		$("#locationSettingContainer").empty();

		if(locationCode){
			if(mode=='info'){
				$("#locationSettingContainer").append('<iframe id="ifrmLocationSetting" name="ifrmLocationSetting" style="width:100%; height:100px;" frameborder="0"></iframe>');
				$("#ifrmLocationSetting").attr('src','/admin/location/ifrm_location_info?locationCode='+locationCode);
			}
			if(mode=='design'){
				$("#locationSettingContainer").append('<iframe id="ifrmLocationSetting" name="ifrmLocationSetting" style="width:100%; height:100px;" frameborder="0"></iframe>');
				$("#ifrmLocationSetting").attr('src','/admin/location/ifrm_location_design?locationCode='+locationCode);
			}
			
			$('.page-buttons-right').show();
			$("#locationInfoFirst").hide();
			
		}else{
			$('.page-buttons-right').hide();
			$("#locationInfoFirst").show();
		}	
	}


	function locationSettingFormSubmit(){
		
		if($("#ifrmLocationSetting").length){
			var frm = document.getElementById('ifrmLocationSetting').contentWindow.document.locationSettingForm;
			document.getElementById('ifrmLocationSetting').contentWindow.submitEditorForm(frm);		
		}else{
			openDialogAlert("지역을 선택해주세요..",400,140);
		}
		
	}
</script>

<!-- 페이지 타이틀 바 : 시작 -->
<form target="actionFrame">
<input type="hidden" name="categoryCode" class='categoryCode' value="" />
<input type="hidden" name="mode" value="" />
<div id="page-title-bar-area">
	<div id="page-title-bar">

		<!-- 타이틀 -->
		<div class="page-title">
			<h2>지역</h2>
		</div>
		
		<ul class="page-buttons-left">
			<li></li>
		</ul>
		
		<ul class="page-buttons-right hide">
			<!--<li><span class="btn large gray"><input type="button" id="viewLocation" value="화면보기"/></span></li>
			<li><span class="btn large black"><button type="button" onclick="locationSettingFormSubmit()">저장하기<span class="arrowright"></span></button></span></li-->
		</ul>
	</div>
</div>
<!-- 페이지 타이틀 바 : 끝 -->

<!-- 서브메뉴 바디 : 시작-->
<div class="contents_dvs v2">
	<div class="catagroy_tree_list">
		<div class="item-title">
			<span>지역 설정</span>
			<span id="mmenu" class='fr'>
				<input type="button" id="add_folder" class='resp_btn active' value='추가'/>
				<input type="button" id="remove_button" class='resp_btn v3' value='삭제'/>
				<input type="button" id="remove" value="-" style="display:none; float:left;"/>
			</span>	
		</div>

		<table width="100%" class="info-table-style mt0">
			<col />
			<tr>
				<td class="its-td" style="background:rgba(255,255,238,0.9);width:310px;padding:0px;">	
					<div id="tree" class="tree" style="height:500px;overflow:auto; padding:10px 5px;"></div>
					<div style="height:30px; text-align:center;display:none;">
						<input type="button" style='width:170px; height:24px; margin:5px auto;' value="reconstruct" onclick="$.get('./tree?reconstruct', function () { $('#tree').jstree('refresh',-1); });" />
						<input type="button" style='width:170px; height:24px; margin:5px auto;' id="analyze" value="analyze" onclick="$('#alog').load('./tree?analyze');" />
						<input type="button" style='width:170px; height:24px; margin:5px auto;' value="refresh" onclick="$('#tree').jstree('refresh',-1);" />
					</div>
					<div id='alog' style="display:none;"></div>
				</td>
			</tr>
		</table>
	</div>	
		
	<div class="catagroy_setting_content">
		<!--
		<table width="100%" id="categoryInfoFirst" class='hide'>
			<col />	
			<tr>
			<th class="its-th" style="height:20px; padding-left:15px;">지역 정보</th>
			</tr>
			<tbody>
			<tr>				
				<td class="its-td">
					<span class="btn small cyanblue"><input type="button" value="생성"/></span> 버튼을 클릭하여 지역을 생성할 수 있습니다.
				</td>
			</tr>
			</tbody>
		</table>
		-->
		
		<div id="categorySettingContainer"></div>
	</div>
</div>
</form>

<!-- 서브메뉴 바디 : 끝 -->
<script>
	viewCategoryInfo(categoryDefault);
</script>
<?php $this->print_("layout_footer",$TPL_SCP,1);?>