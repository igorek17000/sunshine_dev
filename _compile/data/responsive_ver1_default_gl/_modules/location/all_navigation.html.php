<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/skin/responsive_ver1_default_gl/_modules/location/all_navigation.html 000002016 */ ?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++
@@ 전체 지역 @@
- 파일위치 : [스킨폴더]/_modules/location/all_navigation.html
++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<div class="all_list_contents">
	<h2 class="all_list_title"><span designElement="text" textIndex="1"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvX21vZHVsZXMvbG9jYXRpb24vYWxsX25hdmlnYXRpb24uaHRtbA==" >ALL LOCATION</span></h2>
<?php if(is_array($TPL_R1=array_chunk($TPL_VAR["locationData"], 99,true))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
	<ul class="all_list_depth1">
<?php if(is_array($TPL_R2=$TPL_V1)&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
		<li>
			<a href="/goods/location?code=<?php echo $TPL_V2["location_code"]?>"><?php echo $TPL_V2["title"]?></a>
<?php if($TPL_V2["childs"]){?>
			<ul class="all_list_depth2">
<?php if(is_array($TPL_R3=$TPL_V2["childs"])&&!empty($TPL_R3)){foreach($TPL_R3 as $TPL_V3){?>
				<li>
					<a href="/goods/location?code=<?php echo $TPL_V3["location_code"]?>"><?php echo $TPL_V3["title"]?></a>
<?php if($TPL_V3["childs"]){?>
					<ul class="all_list_depth3">
<?php if(is_array($TPL_R4=$TPL_V3["childs"])&&!empty($TPL_R4)){foreach($TPL_R4 as $TPL_V4){?>
						<li>
							<a href="/goods/location?code=<?php echo $TPL_V4["location_code"]?>"><?php echo $TPL_V4["title"]?></a>
						</li>
<?php }}?>
					</ul>
<?php }?>
				</li>
<?php }}?>
			</ul>
<?php }?>
		</li>
<?php }}?>
	</ul>
<?php }}else{?>
	<div class="nodata">설정된 지역 메뉴가 없습니다.</div>
<?php }?>

<?php if($TPL_VAR["location_gnb_banner"]){?>
	<div class="all_list_banner">
		<?php echo $TPL_VAR["location_gnb_banner"]?>

	</div>
<?php }?>
	<a href="javascript:void(0)" class="locationAllClose all_list_close">닫기</a>
</div>
<!-- //지역 전체보기 -->