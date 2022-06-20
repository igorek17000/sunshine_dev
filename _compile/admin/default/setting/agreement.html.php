<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/setting/agreement.html 000002027 */ ?>
<!-- 회원설정 : 이용약관 -->
<script type="text/javascript">
	apply_input_style();
	// 치환코드 복사
	function replace_code_copy(tmp){
		var code = '\{'+tmp+'\}';
		clipboard_copy(code);
		alert('치환코드가 복사되었습니다.\nCtrl+V로 붙여넣기 하세요.');
	}
</script>

			
<!-- 상단 단계 링크 : 끝 -->
<ul id="subTab" class="tab_02 tabEvent mt20">
	<li><a href="javascript:void(0);" onclick="formMoveSub('agreement',1);" id="agreement" class="current">이용약관</a></li>
	<li><a href="javascript:void(0);" onclick="formMoveSub('privacy',2);" id="privacy">개인정보처리방침</a></li>
	<li><a href="javascript:void(0);" onclick="formMoveSub('cancellation',4);" id="cancellation">청약철회 관련방침</a></li>
	<li><a href="javascript:void(0);" onclick="formMoveSub('policy',5);" id="policy">개인정보 제공 동의</a></li>
</ul>

<div class="contents_dvs v2">
	<div class="item-title">
		이용약관
		<span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/member', '#tip4')"></span>
		<a class="resp_btn v3 fr" href="https://www.ftc.go.kr/solution/skin/doc.html?fn=b5bbcffdef4f9e856121b2ba1c0089df8c1dac13565ee8e66ba6d0ab318c011f&rs=/fileupload/data/result/BBSMSTR_000000002320/" target="_blank">공정위 표준약관</a>
	</div>

	<div class="box_style_03">
		<textarea rows="30" name="policy_agreement" class="daumeditor"><?php echo $TPL_VAR["policy_agreement"]?></textarea>
	</div>
</div>

<div class="box_style_05 mt20">
	<div class="title">안내</div>
	<ul class="bullet_hyphen ">
		<li>약관 및 개인정보처리방침 치환 코드 안내 <span class="tooltip_btn" onClick="showTooltip(this, '/admin/tooltip/member', '#tip35', 520)"></span></li>
		<li>설정한 약관 항목이 스킨에서 보이지 않는 경우 스킨 패치 여부를 확인해 주세요.</li>
	</ul>
</div>