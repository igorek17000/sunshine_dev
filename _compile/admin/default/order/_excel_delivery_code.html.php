<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/order/_excel_delivery_code.html 000001114 */ ?>
<table class="info-table-style table_basic v7" class="info-table-style" style="width:100%">
	<colgroup>
		<col width="28%" />
		<col width="24%" />
		<col width="24%" />
		<col width="24%" />
	</colgroup>
	<thead>
	<tr>
		<th class="its-th-align center">택배사</th>		
		<th class="its-th-align center">택배사</th>
		<th class="its-th-align center">택배사</th>		
		<th class="its-th-align center">택배사</th>		
	</tr>
	</thead>
	<tbody>
	<tr>
<?php if(is_array($TPL_R1=array_merge(get_invoice_company(),config_load('delivery_url')))&&!empty($TPL_R1)){$TPL_S1=count($TPL_R1);$TPL_I1=-1;foreach($TPL_R1 as $TPL_V1){$TPL_I1++;?>
<?php if($TPL_I1% 4== 0&&$TPL_I1!= 0){?></tr><tr><?php }?>
		<td class="its-td-align center"><?php echo $TPL_V1["company"]?></td>		
<?php if($TPL_S1% 4!= 0&&$TPL_I1==$TPL_S1- 1){?>
		<td class="its-td-align center" colspan="<?php echo $TPL_S1% 4?>"></td>	
<?php }?>
<?php }}?>	
	</tr>
	</tbody>
</table>
<br/><br/>