<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/goods/shipping_select_popup.html 000007603 */ 
$TPL_admin_list_1=empty($TPL_VAR["admin_list"])||!is_array($TPL_VAR["admin_list"])?0:count($TPL_VAR["admin_list"]);
$TPL_list_1=empty($TPL_VAR["list"])||!is_array($TPL_VAR["list"])?0:count($TPL_VAR["list"]);?>
<script type="text/javascript">
$(document).ready(function() {
	var trust_ship	= $("input[name='trust_shipping']").val();
	$("input[name='trust_shipping_set']").each(function(){
		if($(this).val() == trust_ship)	$(this).attr("checked", true);
	});
	if(trust_ship == 'N'){
		$("#select_admin_shipping_group_seq").eq(0).attr("checked",true);
	}

	$("input[name='trust_shipping_set']").bind("change", function(){
		var trust_shipping_set = $("input:radio[name='trust_shipping_set']:checked").val();
		if(trust_shipping_set == 'Y'){
<?php if($TPL_VAR["admin_login"]=='Y'){?>
			$(".base_shipping_group").show();
<?php }?>
			$(".shipping_group").hide();
		}else{
<?php if($TPL_VAR["admin_login"]=='Y'){?>
			$(".base_shipping_group").hide();
<?php }?>
			$(".shipping_group").show();
		}
	});

	$("input:radio[name='trust_shipping_set']").trigger("change");
});

// 부모창 hidden 박스에 적용
function apply_select(){
	var trust_shipping_set	= $("input:radio[name='trust_shipping_set']:checked").val();
	if(trust_shipping_set == 'Y'){
		var chk_obj	= $("input[name='select_admin_shipping_group_seq']:checked");
	}else{
		var chk_obj	= $("input[name='select_shipping_group_seq']:checked");
	}

	var grp_obj		= $(".shipping_group_div"); // 부모창 설정 값 div
	var grp_seq		= chk_obj.val();
	var grp_name	= chk_obj.attr('grp_name');
	var grp_cnt		= chk_obj.attr('grp_cnt');
	var grp_calcul	= chk_obj.closest("tr").find(".calcul_type").html();

	if(!grp_seq){
		alert('배송그룹을 먼저 선택해주세요.');
		return false;
	}else{
		if(trust_shipping_set == 'Y'){
			grp_obj.find("#trust_shipping").val('Y');
		}else{
			grp_obj.find("#trust_shipping").val('N');
		}
		grp_obj.find("#shipping_group_seq").val(grp_seq).trigger('change');
		get_shipping_group_info(grp_seq);
		//$(".shipping_group_tb").show();
	}

	closeDialog('shipping_grp_sel');
}
</script>

<div class="content">
<?php if($TPL_VAR["provider_seq"]> 1){?>
	<div class="pdb10 resp_radio">
		<label><input type="radio" name="trust_shipping_set" value="N" /> 판매자 직접배송</label>
		&nbsp;&nbsp;&nbsp;
		<label><input type="radio" name="trust_shipping_set" value="Y" /> 본사 위탁 배송</label>
	</div>
<?php }?>

	<table class="table_basic base_shipping_group hide v7">
	<colgroup>
		<col width="60">
		<col width="270">
		<col>
		<col width="120">
	</colgroup>
	<thead>
	<tr>
		<th>선택</th>
		<th>배송그룹명(번호)</th>
		<th>배송비 계산 기준</th>
		<th>연결 상품</th>
	</tr>
	</thead>
	<tbody>
<?php if($TPL_VAR["admin_list"]){?>
<?php if($TPL_admin_list_1){foreach($TPL_VAR["admin_list"] as $TPL_V1){?>
	<tr>
		<td height="25px">
			<label class="resp_radio">
				<input type="radio" name="select_admin_shipping_group_seq" id="select_admin_shipping_group_seq" value="<?php echo $TPL_V1["shipping_group_seq"]?>" grp_name="<?php echo $TPL_V1["shipping_group_name"]?>" grp_cnt="<?php echo $TPL_V1["total_rel_cnt"]?>" <?php if($TPL_VAR["shipping_group_seq"]==$TPL_V1["shipping_group_seq"]){?>checked<?php }?>/>
			</label>
		</td>
		<td>
			<a href="../setting/shipping_group_regist?shipping_group_seq=<?php echo $TPL_V1["shipping_group_seq"]?>&provider_seq=<?php echo $TPL_V1["shipping_provider_seq"]?>" target="_blank">
				<span class="underline"><?php echo $TPL_V1["shipping_group_name"]?> (<?php echo $TPL_V1["shipping_group_seq"]?>)</span>
			</a>
<?php if($TPL_V1["default_yn"]=='Y'){?>
			<span class="basic_black_box">기본</span>
<?php }?>
		</td>
		<td class="center calcul_type">
<?php if($TPL_V1["shipping_calcul_type"]=='bundle'){?>
			묶음계산(묶음배송)
<?php }elseif($TPL_V1["shipping_calcul_type"]=='each'){?>
			개별계산(개별배송)
<?php }elseif($TPL_V1["shipping_calcul_type"]=='free'){?>
			무료계산(묶음배송)
<?php }?>
		</td>
		<td class="center">
			<button type="button" name="modify_btn" onclick="window.open('../goods/catalog?ship_grp_seq=<?php echo $TPL_V1["shipping_group_seq"]?>');" class="resp_btn v3 size_S" style="width:100px;">상품 : <?php echo $TPL_V1["target_goods_cnt"]?>개</button>
			<button type="button" name="modify_btn" onclick="window.open('../goods/package_catalog?ship_grp_seq=<?php echo $TPL_V1["shipping_group_seq"]?>');" class="resp_btn v3 mt5 size_S" style="width:100px;">패키지 : <?php echo $TPL_V1["target_package_cnt"]?>개</button>
		</td>
	</tr>
<?php }}?>
<?php }else{?>
	<tr>
		<td class="center" colspan="4">설정된 배송그룹이 없습니다.</td>
	</tr>
<?php }?>
	</tbody>
	</table>

	<table class="table_basic shipping_group v7" style="width:100%;">
	<colgroup>
		<col width="60">
		<col width="270">
		<col>
		<col width="120">
	</colgroup>
	<thead>
	<tr>
		<th>선택</th>
		<th>배송그룹명(번호)</th>
		<th>배송비 계산 기준</th>
		<th>연결 상품</th>
	</tr>
	</thead>
	<tbody>
<?php if($TPL_VAR["list"]){?>
<?php if($TPL_list_1){foreach($TPL_VAR["list"] as $TPL_V1){?>
	<tr>
		<td height="25px">
			<label class="resp_radio">
				<input type="radio" name="select_shipping_group_seq" value="<?php echo $TPL_V1["shipping_group_seq"]?>" grp_name="<?php echo $TPL_V1["shipping_group_name"]?>" grp_cnt="<?php echo $TPL_V1["total_rel_cnt"]?>" package_cnt="<?php echo $TPL_V1["target_package_cnt"]?>" goods_cnt="<?php echo $TPL_V1["target_goods_cnt"]?>" <?php if($TPL_VAR["shipping_group_seq"]==$TPL_V1["shipping_group_seq"]){?>checked<?php }?>/>
			</label>
		</td>
		<td>
			<a href="../setting/shipping_group_regist?shipping_group_seq=<?php echo $TPL_V1["shipping_group_seq"]?>&provider_seq=<?php echo $TPL_V1["shipping_provider_seq"]?>" target="_blank">
				<span class="underline"><?php echo $TPL_V1["shipping_group_name"]?> (<?php echo $TPL_V1["shipping_group_seq"]?>)</span>
			</a>
<?php if($TPL_V1["default_yn"]=='Y'){?>
			<span class="basic_black_box">기본</span>
<?php }?>
		</td>
		<td class="center calcul_type">
<?php if($TPL_V1["shipping_calcul_type"]=='bundle'){?>
			묶음계산(묶음배송)
<?php }elseif($TPL_V1["shipping_calcul_type"]=='each'){?>
			개별계산(개별배송)
<?php }elseif($TPL_V1["shipping_calcul_type"]=='free'){?>
			무료계산(묶음배송)
<?php }?>
		</td>
		<td class="center">
			<button type="button" name="modify_btn" onclick="window.open('../goods/catalog?ship_grp_seq=<?php echo $TPL_V1["shipping_group_seq"]?>');" class="resp_btn v3 size_S" style="width:100px;">상품 : <?php echo $TPL_V1["target_goods_cnt"]?>개</button>
			<button type="button" name="modify_btn" onclick="window.open('../goods/package_catalog?ship_grp_seq=<?php echo $TPL_V1["shipping_group_seq"]?>');" class="resp_btn v3 mt5 size_S" style="width:100px;">패키지 : <?php echo $TPL_V1["target_package_cnt"]?>개</button>
		</td>
	</tr>
<?php }}?>
<?php }else{?>
	<tr>
		<td class="center" colspan="4">설정된 배송그룹이 없습니다.</td>
	</tr>
<?php }?>
	</tbody>
	</table>
</div>
<div class="footer">
	<button onclick="apply_select();" type="button" class="resp_btn active size_XL" >선택</button>
	<button onclick="closeDialog('shipping_grp_sel');" type="button" class="resp_btn v3 size_XL" >취소</button>
</div>