<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/data/skin/responsive_ver1_default_gl/board/goods_review/_goods_review/write.html 000031518 */  $this->include_("sslAction");
$TPL_categorylist_1=empty($TPL_VAR["categorylist"])||!is_array($TPL_VAR["categorylist"])?0:count($TPL_VAR["categorylist"]);
$TPL_displayGoods_1=empty($TPL_VAR["displayGoods"])||!is_array($TPL_VAR["displayGoods"])?0:count($TPL_VAR["displayGoods"]);
$TPL_reviewcategorylist_1=empty($TPL_VAR["reviewcategorylist"])||!is_array($TPL_VAR["reviewcategorylist"])?0:count($TPL_VAR["reviewcategorylist"]);
$TPL_goodsreview_sub_1=empty($TPL_VAR["goodsreview_sub"])||!is_array($TPL_VAR["goodsreview_sub"])?0:count($TPL_VAR["goodsreview_sub"]);
$TPL_filelist_1=empty($TPL_VAR["filelist"])||!is_array($TPL_VAR["filelist"])?0:count($TPL_VAR["filelist"]);?>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++
@@ 상품후기 Write @@
- 파일위치 : [스킨폴더]/board/goods_review/_goods_review/write.html
++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<div class="mypage_greeting Pb20">
<?php if($TPL_VAR["reserves"]["autoemoney"]== 1&&$TPL_VAR["reserves"]["autoemoneytype"]!= 3&&$TPL_VAR["reserves"]["autoemoneytitle"]){?><span designElement="text" textIndex="1"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >구매자(회원)가 작성한</span><br /><?php }?>
<?php if($TPL_VAR["reserves"]["autoemoney_video"]> 0||$TPL_VAR["reserves"]["autopoint_video"]> 0){?><span class="gray_04" designElement="text" textIndex="2"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >동영상 상품후기는</span>
<?php if($TPL_VAR["reserves"]["autoemoneytype"]!= 1&&($TPL_VAR["reserves"]["autoemoneystrcut1"]> 0||$TPL_VAR["reserves"]["autoemoneystrcut2"]> 0)){?>
			<span class="gray_05">(
<?php if($TPL_VAR["reserves"]["autoemoneytype"]== 2&&$TPL_VAR["reserves"]["autoemoneystrcut1"]> 0){?>
				<?php echo number_format($TPL_VAR["reserves"]["autoemoneystrcut1"])?>

<?php }elseif($TPL_VAR["reserves"]["autoemoneytype"]== 3&&$TPL_VAR["reserves"]["autoemoneystrcut2"]> 0){?>
				<?php echo number_format($TPL_VAR["reserves"]["autoemoneystrcut2"])?>

<?php }?>자 이상)</span>
<?php }?>
<?php if($TPL_VAR["reserves"]["autoemoney_video"]> 0){?>마일리지 <strong class="pointcolor2"><?php echo number_format($TPL_VAR["reserves"]["autoemoney_video"])?></strong>원<?php }?>
<?php if($TPL_VAR["reserves"]["autopoint_video"]> 0){?>, 포인트 <strong class="pointcolor2"><?php echo number_format($TPL_VAR["reserves"]["autopoint_video"])?></strong>P<?php }?>
		지급.<br />
<?php }?>

<?php if($TPL_VAR["reserves"]["autoemoney_photo"]> 0||$TPL_VAR["reserves"]["autopoint_photo"]> 0){?><span class="gray_04" designElement="text" textIndex="3"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >포토 상품후기는</span>
<?php if($TPL_VAR["reserves"]["autoemoneytype"]!= 1&&($TPL_VAR["reserves"]["autoemoneystrcut1"]> 0||$TPL_VAR["reserves"]["autoemoneystrcut2"]> 0)){?>
			<span class="gray_05">(
<?php if($TPL_VAR["reserves"]["autoemoneytype"]== 2&&$TPL_VAR["reserves"]["autoemoneystrcut1"]> 0){?>
				<?php echo number_format($TPL_VAR["reserves"]["autoemoneystrcut1"])?>

<?php }elseif($TPL_VAR["reserves"]["autoemoneytype"]== 3&&$TPL_VAR["reserves"]["autoemoneystrcut2"]> 0){?>
				<?php echo number_format($TPL_VAR["reserves"]["autoemoneystrcut2"])?>

<?php }?>자 이상)</span>
<?php }?>
<?php if($TPL_VAR["reserves"]["autoemoney_photo"]> 0){?>마일리지 <strong class="pointcolor2"><?php echo number_format($TPL_VAR["reserves"]["autoemoney_photo"])?></strong>원<?php }?>
<?php if($TPL_VAR["reserves"]["autopoint_photo"]> 0){?>, 포인트 <strong class="pointcolor2"><?php echo number_format($TPL_VAR["reserves"]["autopoint_photo"])?></strong>P<?php }?>
		지급.<br />
<?php }?>

<?php if($TPL_VAR["reserves"]["autoemoney_review"]> 0||$TPL_VAR["reserves"]["autopoint_review"]> 0){?><span class="gray_04" designElement="text" textIndex="4"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >일반 상품후기는</span>
<?php if($TPL_VAR["reserves"]["autoemoneytype"]!= 1&&($TPL_VAR["reserves"]["autoemoneystrcut1"]> 0||$TPL_VAR["reserves"]["autoemoneystrcut2"]> 0)){?>
			<span class="gray_05">(
<?php if($TPL_VAR["reserves"]["autoemoneytype"]== 2&&$TPL_VAR["reserves"]["autoemoneystrcut1"]> 0){?>
				<?php echo number_format($TPL_VAR["reserves"]["autoemoneystrcut1"])?>

<?php }elseif($TPL_VAR["reserves"]["autoemoneytype"]== 3&&$TPL_VAR["reserves"]["autoemoneystrcut2"]> 0){?>
				<?php echo number_format($TPL_VAR["reserves"]["autoemoneystrcut2"])?>

<?php }?>자 이상)</span>
<?php }?>
<?php if($TPL_VAR["reserves"]["autoemoney_review"]> 0){?>마일리지 <strong class="pointcolor2"><?php echo number_format($TPL_VAR["reserves"]["autoemoney_review"])?></strong>원<?php }?>
<?php if($TPL_VAR["reserves"]["autopoint_review"]> 0){?>, 포인트 <strong class="pointcolor2"><?php echo number_format($TPL_VAR["reserves"]["autopoint_review"])?></strong>P<?php }?>
		지급.<br />
<?php }?>
</div>

<form name="writeform" id="writeform" method="post" action="<?php echo sslAction('../board_process')?>"  enctype="multipart/form-data" target="boardactionFrame">
	<input type="hidden" name="mode" id="mode" value="<?php echo $TPL_VAR["mode"]?>" />
	<input type="hidden" name="board_id" id="board_id" value="<?php echo $TPL_VAR["manager"]["id"]?>" />
	<input type="hidden" name="reply" id="reply" value="<?php echo $_GET["reply"]?>" />
<?php if($TPL_VAR["seq"]){?>
	<input type="hidden" name="seq" id="seq" value="<?php echo $TPL_VAR["seq"]?>" />
<?php }?>
	<input type="hidden" name="returnurl" id="returnurl" value="<?php if($TPL_VAR["backtype"]=='view'){?><?php echo $TPL_VAR["boardurl"]->view?><?php }else{?><?php echo $TPL_VAR["boardurl"]->lists?><?php }?>" />
	<input type="hidden" name="popup" value="<?php echo $_GET["popup"]?>" >
	<input type="hidden" name="iframe" value="<?php echo $_GET["iframe"]?>" >
	<input type="hidden" name="gdviewer" value="<?php echo $_GET["gdviewer"]?>" >
	<input type="hidden" name="goods_seq" value="<?php echo $_GET["goods_seq"]?>" >
	<input type="hidden" name="backtype" value="list" >
	<input type="hidden" name="review_reserve_ok"  class="review_reserve_ok" value="" >
<?php if($TPL_VAR["pw"]){?>
	<input type="hidden" name="oldpw" value="<?php echo $TPL_VAR["pw"]?>" >
<?php }?>


	<div class="table_top_line1"></div>
	<table id="boardDetailTable" class="table_row_a v2 Thc" width="100%" cellpadding="0" cellspacing="0">
	<colgroup><col class="size_b"><col></colgroup>
	<tbody>
<?php if($TPL_VAR["categorylist"]){?>
		<tr>
			<th><p designElement="text" textIndex="5"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >분류</p></th>
			<td>
				<select  name="category" id="addcategory">
					<option value="" selected="selected" >- 분류선택 -</option>
<?php if($TPL_categorylist_1){foreach($TPL_VAR["categorylist"] as $TPL_V1){?>
					<option value="<?php echo $TPL_V1?>" <?php if($TPL_VAR["datacategory"]==$TPL_V1){?> selected="selected"  <?php }?>><?php echo $TPL_V1?></option>
<?php }}?>
				</select>
			</td>
		</tr>
<?php }?>
		<tr>
			<th><p designElement="text" textIndex="6"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >작성자</p></th>
			<td>
<?php if(defined('__ISUSER__')&&$TPL_VAR["name"]){?>
					<input type="hidden" name="name" id="name" value="<?php echo $TPL_VAR["name"]?>" >
					<input type="text" value="<?php echo $TPL_VAR["name"]?>" readonly="readonly" />
<?php }else{?>
					<input type="text" name="name" id="name" value="<?php echo $TPL_VAR["name"]?>"  title="작성자를 입력해 주세요" />
<?php }?>
				<span class="<?php echo $TPL_VAR["hiddenlay"]?>"><input type="checkbox" name="hidden" id="hidden"  value="1" <?php echo $TPL_VAR["hiddenckeck"]?> /><label for="hidden" > <span designElement="text" textIndex="7"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >비밀글</span></label></span>
				<?php echo $TPL_VAR["displayckeck"]?>

			</td>
		</tr>
<?php if(!$TPL_VAR["pw"]){?>
		<tr>
			<th><p designElement="text" textIndex="8"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >비밀번호</p></th>
			<td>
				<input type="password" name="pw" id="pw" value=""  password="password"  title="비밀번호 입력" />
			</td>
		</tr>
<?php }?>
		<tr>
			<th><p designElement="text" textIndex="9"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >답변받기</p></th>
			<td>
				<ul class="form_multi_row2">
<?php if($TPL_VAR["manager"]["sms_reply_user_yn"]=='Y'){?>
					<li>
						<input type="text" name="tel1" id="tel1" value="<?php if($TPL_VAR["tel2"]){?><?php echo $TPL_VAR["tel2"]?><?php }elseif($TPL_VAR["tel1"]){?><?php echo $TPL_VAR["tel1"]?><?php }?>" class="size_mail" title="휴대폰번호 입력(-포함)" <?php if(defined('__ISUSER__')){?><?php }?> />
						<label class="Dib"><input type="checkbox" name="board_sms" id="board_sms" value="1" <?php if(($TPL_VAR["seq"]&&$TPL_VAR["rsms"]=='Y')||(!$TPL_VAR["seq"]&&($TPL_VAR["tel1"]||$TPL_VAR["tel2"]))){?> checked="checked" <?php }?> /> <span designElement="text" textIndex="10"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >SMS받기</span></label>
					</li>
<?php }?>
					<li>
						<input type="text" name="email" id="email" value="<?php echo $TPL_VAR["email"]?>" class="size_mail" title="이메일주소를 입력" />
						<label class="Dib"><input type="checkbox" name="board_email" id="board_email" value="1"  <?php if(($TPL_VAR["seq"]&&$TPL_VAR["remail"]=='Y')||(!$TPL_VAR["seq"]&&$TPL_VAR["email"])){?> checked="checked" <?php }?>/> <span designElement="text" textIndex="11"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >메일받기</span></label>
					</li>
				</ul>
			</td>
		</tr>

		<tr>
			<th><p designElement="text" textIndex="12"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >후기상품</p></th>
			<td class="Pt0">
				<!-- 상품선택 & 선택된 상품 -->
				<div class="board_goods_select">
<?php if($TPL_VAR["seq"]){?>
<?php if($TPL_VAR["order_seq"]){?>
						<b><?php echo $TPL_VAR["order_seq"]?></b> 해당 상품은 배송완료된 주문내역입니다.
						<input type="hidden" name="order_seq" value="<?php echo $TPL_VAR["order_seq"]?>">
<?php }?>
<?php }else{?>
					<div class="btn_area">
<?php if(!$TPL_VAR["displayGoods"]){?>
						<button type="button" id="issueGoodsButton" class="btn_resp size_b color2"><span designElement="text" textIndex="13"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >상품 선택</span></button>&nbsp;
<?php }?>
<?php if(defined('__ISUSER__')){?>
						<select id="ordergoodslist"  name="ordergoodslist" class="Ls-1 hide">
							<option value="">선택하세요!</option>
						</select>&nbsp;
						<span id="orderbtnlay" class="res_st_desc"><?php if(!$_GET["goods_seq"]&&!$TPL_VAR["seq"]){?><span class="pointcolor" designElement="text" textIndex="14"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >상품을 먼저 선택하세요.</span><?php }?></span>
<?php }else{?>
						<span id="orderbtnlay"><button type="button" id="OrderauthButton" class="btn_resp size_b"><span designElement="text" textIndex="15"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >주문조회하기</span></button></span>
						<div class="hide" id="nonemblay" >
							<select id="ordergoodslist"  name="ordergoodslist" class="Ls-1 hide">
								<option value="">선택하세요!</option>
							</select>&nbsp;
							<span id="ordertxtlay" class="res_st_desc"><?php if(!$_GET["goods_seq"]&&!$TPL_VAR["seq"]){?><span class="pointcolor" designElement="text" textIndex="16"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >상품을 먼저 선택하세요.</span><?php }?></span>
						</div>
<?php }?>
					</div>
<?php }?>
					<div id="displayGoods" class="board_goods_select_display">
<?php if($TPL_displayGoods_1){foreach($TPL_VAR["displayGoods"] as $TPL_V1){?>
						<div class="goods_loop_area">
							<ul class="goods_area">
								<li class="img_area"><img src="<?php echo $TPL_V1["image"]?>" class="goodsThumbView goods_img" alt=""></li>
								<li class="info_area">
									<div class="name"><?php echo $TPL_V1["goods_name"]?></div>
									<div class="price"><?php if($TPL_V1["consumer_price"]> 0&&$TPL_V1["consumer_price"]<$TPL_V1["price"]){?><?php echo number_format($TPL_V1["consumer_price"])?> →<?php }?> <?php echo number_format($TPL_V1["price"])?></div>
								</li>
							</ul>
							<input type='hidden' name='displayGoods[]' value='<?php echo $TPL_V1["goods_seq"]?>' />
						</div>
<?php }}?>
					</div>
				</div>

				<!-- 동영상 사용인 경우( 반응형 1차에서 작업 제외 ) -->
<?php if($TPL_VAR["manager"]["video_use"]=='Y'){?>
				<div class="bbswrite_division">
					<span style="width:100%;"><!-- 동영상<br /> -->
					<table width="50%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center">
							<div id="boardVideolay" >
<?php if($TPL_VAR["file_key_i"]&&$TPL_VAR["uccdomain_fileurl"]){?>
								<label ><input type="checkbox" name="video_del" value="1" >삭제</label>
								<div class="content" >
									<iframe   width="100" height="100" src="<?php echo $TPL_VAR["uccdomain_fileurl"]?>&g=tag&width=<?php echo $TPL_VAR["manager"]["video_size_mobile0"]?>&height=<?php echo $TPL_VAR["manager"]["video_size_mobile1"]?>" frameborder="0" allowfullscreen></iframe>
								</div>
<?php }elseif($TPL_VAR["file_key_w"]&&$TPL_VAR["uccdomain_fileurl"]){?>
								<label ><input type="checkbox" name="video_del" value="1" >삭제</label>
								<div class="content" >
									<iframe   width="100" height="100" src="<?php echo $TPL_VAR["uccdomain_fileurl"]?>&g=tag&width=<?php echo $TPL_VAR["manager"]["video_size_mobile0"]?>&height=<?php echo $TPL_VAR["manager"]["video_size_mobile1"]?>" frameborder="0" allowfullscreen></iframe>
								</div>
<?php }?>
							</div>
						</td>
						<td  ><button type="button" class="batchVideoRegist btn_style" board_seq="<?php echo $TPL_VAR["seq"]?>" >동영상등록</button></td>
					</tr>
					</table>
					</span>
				</div>
<?php }elseif($TPL_VAR["file_key_i"]&&$TPL_VAR["uccdomain_fileurl"]){?>
				<div class="bbswrite_division">
					<span style="width:100%;"><!-- 동영상<br /> -->
					<label ><input type="checkbox" name="video_del" value="1" >삭제</label>
					<div>
						<iframe   width="100" height="100" src="<?php echo $TPL_VAR["uccdomain_fileurl"]?>&g=tag&width=<?php echo $TPL_VAR["manager"]["video_size_mobile0"]?>&height=<?php echo $TPL_VAR["manager"]["video_size_mobile1"]?>" frameborder="0" allowfullscreen></iframe>
					</div>
					</span>

					<div style="height:6px;"></div>
<?php }elseif($TPL_VAR["file_key_w"]&&$TPL_VAR["uccdomain_fileurl"]){?>
					<span style="width:100%;">동영상<br />
					<label ><input type="checkbox" name="video_del" value="1" >삭제</label>
					<div>
						<iframe width="100" height="100" src="<?php echo $TPL_VAR["uccdomain_fileurl"]?>&g=tag&width=<?php echo $TPL_VAR["manager"]["video_size_mobile0"]?>&height=<?php echo $TPL_VAR["manager"]["video_size_mobile1"]?>" frameborder="0" allowfullscreen></iframe>
					</div>
					</span>
				</div>
<?php }?>
			</td>
		</tr>
<?php if(!$TPL_VAR["isplusfreenot"]){?>
		<tr>
			<th><p designElement="text" textIndex="17"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >평점</p></th>
			<td>
				<div class="free_score">
					<?php echo $TPL_VAR["scorelay"]?>

				</div>
			</td>
		</tr>
<?php }else{?>
<?php if($TPL_VAR["reviewcategorylist"]){?>
<?php if($TPL_reviewcategorylist_1){$TPL_I1=-1;foreach($TPL_VAR["reviewcategorylist"] as $TPL_V1){$TPL_I1++;?>
		<tr>
			<th><p><?php echo $TPL_V1["title"]?></p></th>
			<td>
				<?php echo getGoodsScore($TPL_V1["score"],$TPL_VAR["manager"],'m_v3_write',$TPL_I1)?>

			</td>
		</tr>
<?php }}?>
<?php }?>
<?php }?>
<?php if($TPL_VAR["goodsreview_sub"]){?>
<?php if($TPL_goodsreview_sub_1){foreach($TPL_VAR["goodsreview_sub"] as $TPL_V1){?>
<?php if($TPL_V1["used"]=='Y'){?>
		<tr>
			<th><p><?php echo $TPL_V1["label_title"]?> <?php if($TPL_V1["required"]=='Y'){?><span  class="writerequired" /></span><input type="hidden" name="required[]" value="<?php echo $TPL_V1["bulkorderform_seq"]?>"> <?php }?></p></th>
			<td class="score_select">
				<?php echo $TPL_V1["label_view"]?>

				<span class="score_desc">(<?php echo $TPL_V1["label_desc"]?>)</span>
			</td>
		</tr>
<?php }?>
<?php }}?>
<?php }?>
		<tr>
			<th><p designElement="text" textIndex="18"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >제목</p></th>
			<td>
				<input type="text" name="subject" id="subject" value="<?php echo $TPL_VAR["subject"]?>" class="Wmax"  title="제목을 입력해 주세요" />
			</td>
		</tr>
	</tbody>
	</table>

<?php if(!$TPL_VAR["seq"]&&$TPL_VAR["manager"]["content_default"]){?>
<?php if($TPL_VAR["contents"]){?>
		<div class="Pt10">
			<?php echo nl2br($TPL_VAR["contents"])?>

		</div>
<?php }?>
		<textarea name="contents" id="contents" class="size3 Mt10" <?php if(!$TPL_VAR["contents"]){?>title="내용을 입력하세요"<?php }?>></textarea>
<?php }else{?>
		<textarea name="contents" id="contents" class="size3 Mt10"><?php echo $TPL_VAR["contents"]?></textarea>
<?php }?>

<?php if(($TPL_VAR["manager"]["file_use"]=='Y'||$TPL_VAR["filelist"])){?>
	<div class="bbswrite_division">
		<!-- 게시판 파일첨부. 파일위치 : [스킨폴더]/board/_mobile_file.html -->
<?php $this->print_("mobile_file",$TPL_SCP,1);?>

		<!-- //게시판 파일첨부 -->
	</div>
<?php }?>

<?php if($TPL_VAR["manager"]["autowrite_use"]=='Y'&&!defined('__ISUSER__')){?>
	<div>
<?php $this->print_("securimage",$TPL_SCP,1);?>

	</div>
<?php }?>

	<div class="board_detail_btns2">
<?php if(!defined('__ISUSER__')){?>
		<div class="L Pb20">
			<span class="Bo">개인정보 수집 및 이용 (필수)</span>
			<textarea class="cs_policy_textarea Mt10" readonly><?php echo $TPL_VAR["policy"]?></textarea>
			<label class="Dib fright Pt10 gray_01"><input type="checkbox" name="agree"/> 개인정보 수집 및 이용에 동의합니다.</label> &nbsp; &nbsp;
		</div>
<?php }?>

		<button type="button" class="data_save_btn btn_resp size_c color2"><span designElement="text" textIndex="19"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >저장</span></button>
		<button type="button" class="btn_resp size_c" onclick="<?php if($_GET["popup"]&&!$_GET["iframe"]){?>self.close();<?php }else{?>document.location.href='<?php echo $TPL_VAR["boardurl"]->lists?>';<?php }?>"><span designElement="text" textIndex="20"  textTemplatePath="cmVzcG9uc2l2ZV92ZXIxX2RlZmF1bHRfZ2wvYm9hcmQvZ29vZHNfcmV2aWV3L19nb29kc19yZXZpZXcvd3JpdGUuaHRtbA==" >취소</span></button>
	</div>

</form>

<!-- 상품 선택/검색 레이어 -->
<div id="displayGoodsSelect" class="resp_layer_pop hide">
	<h4 class="title">상품 검색</h4>
	<div class="y_scroll_auto">
		<div class="layer_pop_contents v3">
		</div>
	</div>
	<a href="javascript:void(0)" class="btn_pop_close" onclick="hideCenterLayer()"></a>
</div>

<div id="openDialogLayer" style="display: none">
	<div align="center" id="openDialogLayerMsg"></div>
</div>

<script type="text/javascript">
//<![CDATA[
var board_id = '<?php echo $TPL_VAR["manager"]["id"]?>';
var boardlistsurl = '<?php echo $TPL_VAR["boardurl"]->lists?>';
var boardwriteurl = '<?php echo $TPL_VAR["boardurl"]->write?>';
var boardviewurl = '<?php echo $TPL_VAR["boardurl"]->view?>';
var boardmodifyurl = '<?php echo $TPL_VAR["boardurl"]->modify?>';
		var file_use = '<?php echo $TPL_VAR["manager"]["file_use"]?>';
//]]>
</script>
<iframe name="boardactionFrame" src="" frameborder="0" width="0" height="0" class="hide"></iframe>


<!-- 주문검색 폼 선택상품정보 -->
<div id="displayOrderlay" class="hide"></div>
<input type="hidden"  id="order_goods_list" value="<?php if($_GET["goods_seq"]){?><?php echo $_GET["goods_seq"]?><?php }else{?><?php echo $TPL_VAR["goods_seq"]?><?php }?>" >

<script type="text/javascript">
var totalScore = 5; //현재 점수
var MaxScore = 5; //최대 점수
var MinScore = 1; //최저점수 ps.최저 점수가 음수일 경우 에러 발생.
var fullStar; //별로 보여질때 가득찬 별

$(document).ready(function() {
<?php if($TPL_VAR["isplusfreenot"]){?>
<?php if($TPL_VAR["reviewcategorylist"]){?>
<?php if($TPL_reviewcategorylist_1){$TPL_I1=-1;foreach($TPL_VAR["reviewcategorylist"] as $TPL_V1){$TPL_I1++;?>
			/* 별점 관련 */
<?php if($TPL_V1["score"]){?>
				showStar('<?php echo $TPL_I1?>','<?php echo $TPL_V1["score"]?>');
<?php }else{?>
				showStar('<?php echo $TPL_I1?>',totalScore);
<?php }?>
<?php }}?>
<?php }?>
<?php }?>

	$(".review_scoreM").live("click",function(){ //마이너스 버튼 클릭시 이벤트
		var idx = $(".review_scoreM").index(this);
		totalScore = $('.review_score').eq(idx).val();
		totalScore--;
		showStar(idx,totalScore);
	});

	$(".review_scoreP").live("click",function () { //플러스 버튼 클릭시 이벤트
		var idx = $(".review_scoreP").index(this);
		totalScore = $('.review_score').eq(idx).val();
		totalScore++;
		showStar(idx,totalScore);
	});

	$('.review_score').bind("change keyup",function() {
		//최대점수는 "+MaxScore+" 입니다.
		if($(this).val() > MaxScore) { alert(getAlert('et074',MaxScore)); totalScore = MaxScore; $(this).val(MaxScore); }
		//최저점수는 "+MinScore+"점 입니다.
		else if($(this).val() < 1) { alert(getAlert('et075',MinScore)); totalScore = MinScore; $(this).val(MinScore); }
		else{ totalScore = $(this).val(); }
		var idx = $(".review_score").index(this);
		showStar(idx,totalScore);
	});

});

function showStar(idx, totalScore) { //별모양 점수를 보여주기 위한 함수
	$(".review_showScore").eq(idx).text(function () {
		var printStar = ""; //출력할 별 문자형 초기화
		fullStar = totalScore; //가득찬 별의 갯수를 구함

		if (totalScore >= MinScore && totalScore <= MaxScore) { //점수가 최저와 최대 점수 사이일때
			if (totalScore == MinScore) { showScore(idx); return "★" } //점수가 최저일때 "-"문자 출력
			else { //점수가 0이 아닐때 별을 출력
				for (i = 1; i <= fullStar; i++) { printStar += "★"; }
				showScore(idx); //텍스트로 점수 출력
				return printStar;
			}
		}
		else { //점수가 0과 10사이가 아닐때
			if (totalScore == MaxScore + 1) {
				alert(getAlert('et074',MaxScore)); totalScore = MaxScore; $('.review_score').eq(idx).val(MaxScore);
			}
			else if (totalScore == (MinScore-1)) {
				alert (getAlert('et075',MinScore)); totalScore = MinScore; $('.review_score').eq(idx).val(MinScore);
			}
			//showStar(idx);
		}
	});
	$('.review_score').eq(idx).val(totalScore);
}

function showScore(idx) { //텍스트로 점수 출력을 위한 함수
	$(".review_score_number").eq(idx).val(totalScore);
}

</script>
<script type="text/javascript">
//<![CDATA[

function set_goods_list(displayId,inputGoods) {
<?php if(!defined('__ISUSER__')){?>
		$("#orderbtnlay").show();
		$("#nonemblay").hide();
<?php }?>

	var sheight = $('body').prop("scrollHeight");

	$.ajax({
		type: "get",
		url: "/goods/user_select",
		data: "page=1&goods_review=1&inputGoods="+inputGoods+"&displayId="+displayId,
		success: function(result){
			$("#" + displayId + " .layer_pop_contents").html(result);
			//상품 검색
			showCenterLayer('#' + displayId);
			//openDialogModal(displayId+'Dialog',getAlert('et073'),'',displayId);
		}
	});
}

//비회원 상품조회 새창 >> 검색완료후 처리함부
function goodslistclose(displayId, goods_seq) {
	closeDialogAll(displayId+'Dialog');
	//$("div#"+displayId).dialog('close');
	$("#ordergoodslist").empty();//초기화
	$("#order_goods_list").val(goods_seq);
<?php if(defined('__ISUSER__')){?>
		goods_review_order_load(goods_seq, '', '');
<?php }?>
}

//주문조회 새창 >> 검색완료후 처리함수
function gdordersearch() {
	var goods_seq = $("#order_goods_list").val();
	if(!goods_seq){
		//상품을 먼저 선택해 주세요.
		alert(getAlert('et146'));
		return false;
	}
	$("#orderbtnlay").hide();
	$("#nonemblay").show();
	goods_review_order_load(goods_seq, '', '');
}

$(document).ready(function() {
<?php if($_GET["goods_seq"]){?>
	gdordersearch();
<?php }?>
	$("#OrderauthButton").live("click", function(){
		var goodsseq = $("#order_goods_list").val();
		if(!goodsseq){
			//상품을 먼저 선택해 주세요.
			alert(getAlert('et146'));
			return false;
		}
<?php if($_SERVER["HTTPS"]=='on'){?>
			var openurl = 'https://<?php echo $_SERVER["HTTP_HOST"]?>'
<?php }else{?>
			var openurl = 'http://<?php echo $_SERVER["HTTP_HOST"]?>'
<?php }?>
		window.open(openurl + '/member/login?order_auth=1&goodsseq='+goodsseq+'&popup=1&return_url=<?php echo urlencode($_SERVER["REQUEST_URI"])?><?php echo urlencode('&goodsseq=')?>'+goodsseq,'goodrevieworder','width=700px,height=900px,statusbar=no,scrollbars=auto,toolbar=no');
	});


	$("button#issueGoodsButton").live("click",function(){
		set_goods_list("displayGoodsSelect","displayGoods");
	});

	EditorJSLoader.ready(function(Editor) {
		DaumEditorLoader.init(".daumeditor");
	});

	$("#backtype2").click(function() {
		$("#returnurl").val('<?php echo $TPL_VAR["boardurl"]->view?>');
	});

	$("#backtype1").click(function() {
		$("#returnurl").val('<?php echo $TPL_VAR["boardurl"]->lists?>');
	});

	// 게시글저장
	$('.data_save_btn').click(function() {
		// 2018-06-07 byuncs 수정시 파일이 포함 되어 있는 경우 체크..
		checkAttachImage();

<?php if($TPL_VAR["categorylist"]){?>
		if( !$("#addcategory").val()){
			alert(getAlert('et140'));
			$("#addcategory").focus();
			return false;
		}
<?php }?>
		$("#writeform").submit();
	});

	$('#writeform').validate({
		onkeyup: false,
		rules: {

<?php if($TPL_VAR["manager"]["autowrite_use"]=='Y'&&!defined('__ISUSER__')){?>
			captcha_code:{required:true},
<?php }?>
<?php if(!defined('__ISUSER__')){?>
			name: {required: true},
			pw:{required:true},

<?php }?>
			subject: {required:true},
		},
		errorClass: "input_round_style_rounded",
		validClass: "input_round_style", 
		highlight: function(element, errorClass, validClass) {
			$(element).parent().addClass(errorClass);
			$(element).parent().removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parent().removeClass(errorClass);
			$(element).parent().addClass(validClass);
		},errorPlacement: function(error, element) {
			setDefaultText();
		},
		submitHandler: function(f) {
			//if(readyEditorForm(f)){

<?php if(!defined('__ISUSER__')){?>
					if(!$("input[name='agree']").is(":checked")){
						setDefaultText();
						//개인정보 수집 및 이용에 동의하셔야 합니다.
						alert(getAlert('et152'));
						$("input[name='agree']").focus();
						return false;
					}
<?php }?>

<?php if($TPL_VAR["categorylist"]){?>
				if( !$("#addcategory").val()){ 
					setDefaultText();
					//분류를 선택해 주세요.
					alert(getAlert('et153'));
					$("#addcategory").focus();
					return false; 
				}
<?php }?>

				var bcontents = $("#writeform").find("#contents").val();
				if(!bcontents || bcontents.toLowerCase() == "<p>&nbsp;</p>"  || bcontents.toLowerCase() == "<p><br></p>" ){
					setDefaultText();
					//내용을 입력해 주세요.
					alert(getAlert('et216'));
					$("#contents").focus();
					return false;
				}

				loadingstartsubmit();
				

				if (submitFlag == true)
				{
				//게시물을 등록하고 있습니다. 잠시만 기다려 주세요.
				 alert(getAlert('et154'));
				 return false;
				}   
				submitFlag = true;
				f.submit();
			//}
		}
	});

iframeset();
});

<?php if(($TPL_VAR["manager"]["file_use"]=='Y'||$TPL_VAR["filelist"])&&!$TPL_VAR["ismobile"]){?>
function readfilelistNew(attachments){
<?php if($TPL_VAR["filelist"]){?>
attachments['image'] = [];
attachments['file'] = [];
<?php if($TPL_filelist_1){foreach($TPL_VAR["filelist"] as $TPL_V1){?>
	var  filePath = '<?php echo $TPL_V1["realfiledir"]?>';
	var  filePathurl = '<?php echo $TPL_V1["realfileurl"]?>';
<?php if($TPL_VAR["realthumbfile"]){?>
		var  realthumbfile = '<?php echo $TPL_V1["realthumbfiledir"]?>';
		var  thumbfilePathurl = 'http://<?php echo $_SERVER["HTTP_HOST"]?><?php echo $TPL_V1["realthumbfileurl"]?>';
<?php }?>
	var  orig_name = '<?php echo $TPL_V1["orignfile"]?>';
	var  file_size = <?php echo $TPL_V1["sizefile"]?>;
	var  typefile = '<?php echo $TPL_V1["typefile"]?>';

<?php if($TPL_V1["is_image"]||strstr($TPL_V1["typefile"],'image')||in_array($TPL_V1["typefile"],array('jpg','jpeg','png','gif','bmp','tif','pic'))){?>
		attachments['image'].push({
			'attacher': 'image',
			'data': {
				'imageurl': filePathurl,
				'filename': orig_name,
				'filesize': file_size,
				'imagealign': 'C',
				'originalurl': filePath,
				'thumburl': <?php if($TPL_VAR["realthumbfile"]){?> thumbfilePathurl <?php }else{?>filePathurl<?php }?>
			}
		});
<?php }else{?>
		attachments['file'].push({
			'attacher': 'file',
			'data': {
				'filename': orig_name,
				'filesize': file_size,
				'filemime':typefile,
				'originalurl': filePath,
				'attachurl': filePath
			}
		});
<?php }?>
<?php }}?>
return attachments;
<?php }?>
}
<?php }?>
//]]>
</script>

<script type="text/javascript">
$(document).ready(function(){
	$(document).resize(function(){iframeset();}).resize();
	setInterval(function(){iframeset();},1000);
<?php if($TPL_VAR["contents"]){?>
	$('.infomation').click(function(){
		$(this).hide();
		$('#contents').focus();
	});
	$('#contents').blur(function(){
		if($(this).val() == '') $('.infomation').show();
	});
<?php }?>
});
function iframeset(){
	  $('#'+board_id+'_frame',parent.document).height($('#boardlayout').height());
}
</script>