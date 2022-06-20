<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/o2o/_modules/barcode_download.html 000000415 */ ?>
<li onclick="excel_down('barcode');" class="choose-item">
					바코드 실물 다운로드<?php if(serviceLimit('H_NFR')){?>(본사 상품)<?php }?>
				</li>
				<script>
				$(document).ready(function() {
					$(".choose-down-lay").width(200);
				});
				</script>