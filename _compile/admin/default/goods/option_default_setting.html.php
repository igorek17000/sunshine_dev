<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/goods/option_default_setting.html 000005326 */ ?>
<script type="text/javascript">
	$(function(){
		/* 관련상품 조건 선택 버튼 */
		$("#set_option_view_lay button.btnRelationSetting").on("click",function(){
			var displayResultId			= $(this).attr('dp_id');
			var auto_condition_use_id	= $(this).attr('use_id');
			var criteria				= $("#set_option_view_lay  .relationCriteria").val();
			if (criteria=="") {
				criteria = "admin∀type=select_auto,provider=all,month=1,act=recently,min_ea=1";
			}
			//openDialog("조건 선택", "#displayGoodsSelectPopup", {"width":"960","height":"560","show" : "fade","hide" : "fade"});
	//		set_goods_list("displayGoodsSelect",displayResultId,'criteria',criteria);
	
			var kind = 'criteria';
<?php if($TPL_VAR["sub_kind"]=="relation"){?> kind = 'relation'; <?php }?>
			//set_goods_list_auto("displayGoodsSelect",displayResultId,criteria,'relation',kind);

			open_criteria_condition(displayResultId,auto_condition_use_id,criteria,kind,'default');

		});
	});
</script>
<form name="ovFrm" method="post" action="../goods_process/set_option_view_count" target="actionFrame" class="hx100">
<input type="hidden" name="goods_kind" value="<?php echo $TPL_VAR["goods_kind"]?>" />
<input type="hidden" name="sub_kind" value="<?php echo $TPL_VAR["sub_kind"]?>" />
<input type="hidden" name="editor_view" value="N" />
<div class="content">
	<table class="table_basic thl">	
<?php if($TPL_VAR["sub_kind"]=="option"){?>
	<colgroup>
		<col width="35%">
		<col width="65%">
	</colgroup>
	<tr>
		<th>필수 옵션</th>
		<td>
			기본 <input type="text" size="5" name="option_view_count" class="right" value="<?php echo $TPL_VAR["config_goods"]["option_view_count"]?>" /> 개씩 보기
		</td>
	</tr>
	<tr>
		<th>추가 구성 옵션</th>
		<td>
			기본 <input type="text" size="5" name="suboption_view_count" class="right" value="<?php echo $TPL_VAR["config_goods"]["suboption_view_count"]?>" /> 개씩 보기
		</td>
	</tr>
<?php }elseif($TPL_VAR["sub_kind"]=="relation"){?>
	<tr>
		<th>관련 상품</th>
		<td>
			<button type="button" class="btnRelationSetting resp_btn active" dp_id='relationCriteria' use_id='auto_condition_use' kind='relation' >조건 설정</button>

			<input type='hidden' class="displayCriteria relationCriteria" id="relationCriteriaDeault" name='relation_criteria' value="<?php if($TPL_VAR["config_goods"]["relation_criteria"]){?><?php echo $TPL_VAR["config_goods"]["relation_criteria"]?><?php }else{?><?php }?>" />
			<div class="displayCriteriaDesc"></div>
		</td>
	</tr>
<?php }elseif($TPL_VAR["sub_kind"]=="commonContents"){?>
	<colgroup>
		<col width="30%">
		<col width="70%">
	</colgroup>
	<tr>
		<th>상품 공통 정보</th>
		<td>
			<select name="common_info_seq" class="wp85">
<?php if($TPL_VAR["config_goods"]["common_info_loop"]){?>
				<option value="">선택하세요</option>
<?php if(is_array($TPL_R1=$TPL_VAR["config_goods"]["common_info_loop"])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1["info_name"]!='== 선택하세요 =='&&$TPL_V1["info_name"]!='== ←좌측에 상품 공통 정보명을 입력하여 새로운 상품 공통 정보를 만드시거나 또는 ↓아래에서 이미 만들어진 상품 공통 정보를 불러오세요 =='){?>
				<option value="<?php echo $TPL_V1["info_seq"]?>" <?php if($TPL_V1["info_seq"]==$TPL_VAR["config_goods"]["common_info_seq"]){?>selected="selected"<?php }?>><?php echo $TPL_V1["info_name"]?> &nbsp;[고유번호 : <?php echo $TPL_V1["info_seq"]?>]</option>
<?php }?>
<?php }}?>
<?php }else{?>
					<option value="">상품 공통 정보가 없습니다.</option>
<?php }?>
			</select>

		</td>
	</tr>
<?php }else{?>
	<tr>
		<th>노출 항목 선택</th>
		<td>
			<label class='resp_checkbox mr20'><input type="checkbox" name="list_default_condition[category]" value="y" <?php if($TPL_VAR["config_goods"]["list_condition_category"]=='y'){?>checked<?php }?> /> 대표 카테고리</label>
			<label class='resp_checkbox mr20'><input type="checkbox" name="list_default_condition[brand]" value="y" <?php if($TPL_VAR["config_goods"]["list_condition_brand"]=='y'){?>checked<?php }?> /> 대표 브랜드</label>
			<label class='resp_checkbox'><input type="checkbox" name="list_default_condition[stringprice]" value="y" <?php if($TPL_VAR["config_goods"]["list_condition_stringprice"]=='y'){?>checked<?php }?> /> 가격 대체 문구</label>
		</td>
	</tr>
<?php }?>
	</table>
<?php if($TPL_VAR["sub_kind"]!="options"){?>
	<ul class="bullet_hyphen resp_message">
<?php if($TPL_VAR["sub_kind"]=="commonContents"){?>
		<li>기본 정보 설정 시, 선택한 내용이 기본 상품 공통 정보로 제공됩니다.</li>
<?php }elseif($TPL_VAR["sub_kind"]!="relation"){?>
		<li>설정은 관리자 ID 당 저장됩니다.</li>
<?php }else{?>
		<li>선택한 조건은 상품 등록 시 기본 조건으로 제공 됩니다.</li>	
<?php }?>
	</ul>
<?php }?>
</div>
<div class="footer">
	<button type="submit" class="resp_btn active size_XL">저장</button>
	<button type="button" class="resp_btn v3 size_XL" onclick="closeDialog('set_option_view_lay');">취소</button>
</div>
</form>