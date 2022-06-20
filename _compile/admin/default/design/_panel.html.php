<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/design/_panel.html 000039846 */ 
$TPL_folders_1=empty($TPL_VAR["folders"])||!is_array($TPL_VAR["folders"])?0:count($TPL_VAR["folders"]);
$TPL_boards_1=empty($TPL_VAR["boards"])||!is_array($TPL_VAR["boards"])?0:count($TPL_VAR["boards"]);?>
<script type="text/javascript" src="/app/javascript/plugin/jquery.hotkeys.js"></script>
<script type="text/javascript" src="/admin/skin/default/images/design/jquery.scrollbar.js"></script>
<link rel="stylesheet" type="text/css" href="/admin/skin/default/images/design/jquery.scrollbar.css">
<style type="text/css">
	/******************************************* 공통 *******************************************/
	/*@import url('//fonts.googleapis.com/earlyaccess/nanumgothic.css');*/
	@font-face {font-family:"NanumGothic"; font-weight:400; font-style:normal; src:url("/admin/skin/default/css/font/NanumGothic.eot"); src:url("/admin/skin/default/css/font/NanumGothic.eot?#iefix") format("embedded-opentype"), url("/admin/skin/default/css/font/NanumGothic.woff") format("woff"), url("/admin/skin/default/css/font/NanumGothic.ttf") format("truetype");}
	@font-face {font-family:"NanumGothic"; font-weight:600; font-style:normal; src:url("/admin/skin/default/css/font/NanumGothicBold.eot"); src:url("/admin/skin/default/css/font/NanumGothicBold.eot?#iefix") format("embedded-opentype"), url("/admin/skin/default/css/font/NanumGothicBold.woff") format("woff"), url("/admin/skin/default/css/font/NanumGothicBold.ttf") format("truetype");}

	html {overflow-x:hidden;}
	#DMWindow *,  #DMPanelTop *, #DMPanelNavigator * {font-family:'NanumGothic', 'Malgun Gothic', sans-serif !important;}
	#DMWindow img, #DMPanelTop img, #DMPanelNavigator img {vertical-align:middle;}
	#nochk_login_btn {border:1px solid; background:#fff;}
	#chk_login_btn {border:1px solid; background:#050099; color:#fff;}

	/* 모듈 롤오버 시 라인선 */
	.designPopupIcon {position:absolute; display:block;}
	.designElement {}
	.designElementEditBtn {position:absolute; z-index:10; left:0px; top:0px; width:100%; height:100%; cursor:pointer; background:white;}
	.designElementHover[designElement] {cursor:pointer; margin:-2px;}
	.designElementHover[designElement='image'] {border:2px dashed #494949 !important;}
	.designElementHover[designElement='video'] {border:2px dashed #000 !important;}
	.designElementHover[designElement='popup'] {border:2px dashed red !important;}
	.designElementHover[designElement='flash'] {border:2px dashed blue !important;}
	.designElementHover[designElement='banner'] {border:2px dashed #996600 !important;}
	.designElementHover[designElement='searchGoodsDisplay'],
	.designElementHover[designElement='goodsRecommDisplay'],
	.designElementHover[designElement='display'] {border:2px dashed green !important;}
	.designElementHover[designElement='categoryNavigation'] {border:2px dashed orange !important;}
	.designElementHover[designElement='brandNavigation'] {border:2px dashed purple !important;}
	.designElementHover[designElement='locationNavigation'] {border:2px dashed brown !important;}
	.designElementHover[designElement='categoryRecommendDisplay'] .designElementEditBtn {background:red;}
	.designElementHover[designElement='categoryGoodsDisplay'] .designElementEditBtn {background:red;}
	.designElementHover[designElement='brandRecommendDisplay'] .designElementEditBtn {background:red;}
	.designElementHover[designElement='brandGoodsDisplay'] .designElementEditBtn {background:red;}
	.designElementHover[designElement='locationRecommendDisplay'] .designElementEditBtn {background:red;}
	.designElementHover[designElement='locationGoodsDisplay'] .designElementEditBtn {background:red;}
	.designElementHover[designElement='goodsRelationDisplay'] .designElementEditBtn {background:yellow;}
	.designElementHover[designElement='goodsSellerRelationDisplay'] .designElementEditBtn {background:yellow;}
	.designElementHover[designElement='goodsBigdataDisplay'] .designElementEditBtn {background:purple;}
	.designElementHover[designElement='displaylastest'] .designElementEditBtn {background:purple;}
	.designElementHover[designElement='topBar'] {border:2px dashed brown !important;}
	.designElementHover[designElement='mainTopBar'] {border:2px dashed brown !important;}
	.designElementHover[designElement='text'] {border:2px dashed black !important;}
	.designElementHover[designElement='category'] {border:2px dashed black !important;}
	.designDisplay { min-height:30px;}

	/******************************************* DARK 버전 *******************************************/

	/* 레이어 팝업창 */
	#DMModalBackground {display:none; position:fixed; left:0px; top:0px; z-index:2110; width:100%; height:100%; background:#999;}
	#DMWindow {display:none; position:fixed; left:50%; top:50%; margin-left:-500px; margin-top:-317.5px; border:1px solid #222; z-index:2111; margin:auto;}
	/*	#DMWindow {display:none; z-index:1000; position:fixed; margin:auto; top:50px;}*/
	#DMWindow #DMWindowTitle {position:relative; border-bottom:1px solid #222; background:#222; height:34px; line-height:34px; text-align:center; cursor:move;}	
	#DMWindow #DMWindowTitle .DMWTTextCenter {text-align:center; font-size:12px; color:#fff;}	
	#DMWindow #DMWindowTitle .DMWTTextCenter span {font-size:inherit; color:inherit;}
	#DMWindow #DMWindowTitle .DMWTTextLeft {position:absolute; width:40%; left:10px; top:0px; height:34px; line-height:34px; text-align:left;}
	#DMWindow #DMWindowTitle .DMWTTextLeft a {vertical-align:top; font-size:12px; color:#00ccff;}
	#DMWindow #DMWindowTitle .DMWTTextRight {position:absolute; width:40%; left:60%; top:0px; margin-left:-10px; height:34px; line-height:34px;}
	#DMWindow #DMWindowTitle .DMWTClose {position:absolute; top:6px; right:6px; margin-left:-31px; line-height:0px; cursor:pointer;}
	#DMWindow #DMWindowTitle .DMWTClose span {display:inline-block; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat; vertical-align:middle; text-indent:-9999px; cursor:pointer;}
	#DMWindow #DMWindowTitle .DMWTClose span.ico_expand {background-position:0 -80px; width:20px; height:20px;}
	#DMWindow #DMWindowTitle .DMWTClose span.ico_reduction {background-position:-20px -80px; width:20px; height:20px;}
	#DMWindow #DMWindowTitle .DMWTClose span.ico_close {background-position:-40px -80px; width:20px; height:20px;}
	#DMWindow #DMWindowBody {background:#fff; padding:0px;}
	#DMWindow #DMWindowBody iframe {width:100%; height:100%; border:0px; background:#fff;}	
	#DMWindow.zoomIn {top:0 !important; left:0 !important; margin:0 !important; width:100%; height:100%;}
	#DMWindow.zoomIn #DMWindowBody {width:100% !important; height:100% !important;}
	#DMWindow.zoomIn #DMWindowBody iframe { height:calc( 100% - 35px ); }


	/* 상단 툴바 */
	#DMPanelTop {display:none; position:fixed; left:0px; top:0px; z-index:2100; margin-top:-38px; /*min-width:800px;*/ width:100%; height:40px; background:#282828; background:rgba(40,40,40,0.95);}
	#DMPanelTop .DMPTLeft {position:absolute; top:0; left:0; line-height:40px; padding-left:15px;}
	#DMPanelTop .DMPTLeft span,
	#DMPanelTop .DMPTLeft a {display:inline-block; vertical-align:top; margin-right:10px; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat 0 -142px; padding-left:10px;  font-size:11px; color:#c4c4c4; cursor:pointer; text-decoration:none;}
	#DMPanelTop .DMPTLeft span:hover, #DMPanelTop .DMPTLeft a:hover {color:#fff;}
	#DMPanelTop .DMPTCenter {line-height:40px; text-align:center;}
	#DMPanelTop .DMPTCenter .skinName {vertical-align:top; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; margin-right:10px; text-align:right; font-size:13px; font-weight:400; color:#fff;}
	#DMPanelTop .DMPTCenter .skinLogin {display:inline-block; vertical-align:top;}
	#DMPanelTop .DMPTCenter .skinLogin input[type="button"] { vertical-align:top; margin-top:10px; border:0; border-radius:2px; background:#535353; min-width:52px; padding:3px 0; font-size:11px; color:#bdbdbd; cursor:pointer;}
	#DMPanelTop .DMPTCenter .skinLogin input[type="button"]:hover {background:#147fcb; color:#fff;}
	#DMPanelTop .DMPTRight {position:absolute; top:0; right:0; line-height:40px;}
	#DMPanelTop .DMPTRight .DMPTRSetMode-title, 
	#DMPanelTop .DMPTRight a.DMPTRGoadmin {display:inline-block; vertical-align:top; margin-left:10px; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat 0 -182px; padding-left:10px; font-size:11px; color:#c4c4c4; text-decoration:none; cursor:pointer;}
	#DMPanelTop .DMPTRight .DMPTRSetMode-title:hover, #DMPanelTop .DMPTRight a.DMPTRGoadmin:hover {color:#fff;}
	#DMPanelTop .DMPTRight .DMPTRSetMode-subnb {display:none; position:absolute; left:0px; top:40px; border-left:1px solid #454545; border-right:1px solid #454545; border-bottom:1px solid #454545; background:#3a3a3a;}
	#DMPanelTop .DMPTRight .DMPTRSetMode-subnb li.DMPTRSetMode-subnb-item a {display:block; width:80px; height:20px; line-height:20px; padding:0 5px 0 5px; font-size:11px; color:#c4c4c4; text-decoration:none;}
	#DMPanelTop .DMPTRight .DMPTRSetMode-subnb li.DMPTRSetMode-subnb-item:hover a {display:block; background:#666; color:#fff;}
	#DMPanelTop .DMPTRight .lightColor {display:inline-block; vertical-align:top; width:58px; height:21px; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat 0 -640px; margin:10px 15px; text-indent:-9999px; cursor:pointer;}
	#DMPanelTop .DMPTRight .darkColor {display:none; vertical-align:top; width:58px; height:21px; background:url('/admin/skin/default/images/design/bg_light.png') no-repeat 0 -640px; margin:10px 15px; text-indent:-9999px; cursor:pointer;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .lightColor {display:none;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .darkColor {display:inline-block;}
	@media only screen and (max-width:768px) {
		#DMPanelTop .DMPTCenter {display:none;}
	}
	@media only screen and (max-width:500px) {
		#DMPanelTop .DMPTLeft {display:none;}
	}

	/* 우측 툴바 - 최소화 */
	#DMPanelNavigatorBtn {position:fixed; left:100%; bottom:150px; z-index:1999; margin-left:-50px; width:50px; height:154px; cursor:pointer;}
	#DMPanelNavigatorBtn .offImg {display:block; background:#222 url('/admin/skin/default/images/design/bg_dark.png') no-repeat 0 -480px;}
	#DMPanelNavigatorBtn .onImg {display:none; background:#222 url('/admin/skin/default/images/design/bg_dark.png') no-repeat -50px -480px;}
	#DMPanelNavigatorBtn .onoff {width:50px; height:24px; cursor:pointer; text-indent:-9999px;}
	#DMPanelNavigatorBtn .open {width:50px; height:134px; cursor:pointer; text-indent:-9999px;}		
	#DMPanelNavigatorBtn.designEditMode .offImg {display:none;}
	#DMPanelNavigatorBtn.designEditMode .onImg {display:block;}

	/* 우측 툴바 - 활성화 */
	#DMPanelNavigator {display:none; position:fixed; left:100%; top:40px; bottom:0; z-index:2000; width:200px; border:1px solid transparent; background:#222; background:rgba(25,25,25,0.95); margin-left:-200px;}
	#DMPanelNavigator .DMPNHeader {height:50px; line-height:50px; text-align:center;}
	#DMPanelNavigator .DMPNHeader span {display:inline-block; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat; vertical-align:middle; text-indent:-9999px;}
	#DMPanelNavigator .DMPNHeader span.DMPNHTitle {background-position:0 -20px; width:117px; height:11px; margin:0 10px 0 5px;}
	#DMPanelNavigator .DMPNHeader span.DMPNHSwitch {background-position:0 -40px; width:33px; height:21px; cursor:pointer}
	#DMPanelNavigator .DMPNHeader.designEditMode span.DMPNHSwitch {background-position:-40px -40px;}	
	
	/* 우측 툴바 - 리스트 */
	#DMPanelNavigator .DMPNBody {position:relative; height:100%;}
	#DMPanelNavigator .DMPNBody > .DMPNList {position:absolute; top:0; bottom:250px; left:10px; right:10px; border:1px solid #1e1e1e; overflow:hidden;}
	#DMPanelNavigator .DMPNBody > .DMPNList:hover {overflow:auto;}	
	#DMPanelNavigator .DMPNBody .DMPNListDepth1 {margin:0px; padding:0px; background:#272727;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth1 > li:first-child .DMPNListDepth1ItemTitle {margin-top:0;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item {position:relative;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item .DMPNListDepth1ItemBg1,
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item .DMPNListDepth1ItemBg2 {background:transparent;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item .DMPNListDepth1ItemTitle {display:block; position:relative; height:35px; line-height:35px; margin-top:1px; background:#333 url('/admin/skin/default/images/design/bg_dark.png') no-repeat 12px -224px; padding-left:29px; font-size:12px; color:#999; cursor:pointer}
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item:hover .DMPNListDepth1ItemTitle,
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item.opened .DMPNListDepth1ItemTitle {background:#121212 url('/admin/skin/default/images/design/bg_dark.png') no-repeat 12px -264px; color:#fff;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth1Item.opened .DMPNListDepth2 {display:block; margin:0px; padding:0px;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 {display:none; overflow:hidden; background:#1a1a1a;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item {}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2ItemBg1,
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2ItemBg2 {background:transparent;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item a {display:block; position:relative; height:35px; line-height:35px; margin-top:1px; background:#272727 url('/admin/skin/default/images/design/bg_dark.png') no-repeat 14px -303px; padding-left:30px; font-size:11px; color:#999; letter-spacing:0;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item a span.dn_text {display:block; width:80%; text-overflow:ellipsis; white-space:nowrap; overflow:hidden; font-size:inherit; color:inherit; text-decoration:none;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item:hover a,
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item.opened a {background:#147fcb url('/admin/skin/default/images/design/bg_dark.png') no-repeat 14px -343px; padding-left:30px; color:#fff; text-decoration:none;}	
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item a span.dn_icon {position:absolute; top:8px; right:12px; width:17px; height:17px; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat 0 -100px; text-indent:-9999px;}
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item:hover a span.dn_icon,
	#DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item.controlMenuOpened a span.dn_icon {background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat -20px -100px;}
	#DMPanelNavigator .DMPNBtn {position:absolute; bottom:35px; left:10px; right:10px; height:165px;}
	#DMPanelNavigator .DMPNBtn .layout {margin:10px auto; border:1px solid #333;}
	#DMPanelNavigator .DMPNBtn .layout li {border-top:1px solid #333; background:#181818; padding-left:12px; font-size:12px; color:#999; line-height:35px; cursor:pointer;}
	#DMPanelNavigator .DMPNBtn .layout li:first-child {border-top:none;}
	#DMPanelNavigator .DMPNBtn .layout li:hover {background:#111; color:#ccc;}
	#DMPanelNavigator .DMPNBtn .layout li span, 
	#DMPanelNavigator .DMPNBtn .quick li span {display:inline-block; margin-right:6px; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat; vertical-align:middle; text-indent:-9999px; cursor:pointer;}
	#DMPanelNavigator .DMPNBtn .layout li span.ico_allpage {background-position:-40px -100px; width:11px; height:13px;}
	#DMPanelNavigator .DMPNBtn .layout li span.ico_layout {background-position:-60px -100px; width:11px; height:13px;}
	#DMPanelNavigator .DMPNBtn .layout li span.ico_newpage {background-position:-80px -100px; width:11px; height:13px;}
	#DMPanelNavigator .DMPNBtn .layout li span.ico_mobile {background-position:-100px -100px; width:12px; height:14px; margin-right:5px;}
	#DMPanelNavigator .DMPNBtn .layout li:hover span.ico_allpage {background-position:-40px -120px;}
	#DMPanelNavigator .DMPNBtn .layout li:hover span.ico_layout {background-position:-60px -120px;}
	#DMPanelNavigator .DMPNBtn .layout li:hover span.ico_newpage {background-position:-80px -120px;}
	#DMPanelNavigator .DMPNBtn .layout li:hover span.ico_mobile {background-position:-100px -120px;}
	#DMPanelNavigator .DMPNBtn .quick {margin:0 auto;}
	#DMPanelNavigator .DMPNBtn .quick li {border:1px solid #000; background:#000; padding-left:12px; font-size:12px; color:#8a8a8a; line-height:34px; cursor:pointer;}
	#DMPanelNavigator .DMPNBtn .quick li:hover {background:#000; color:#ccc;}
	#DMPanelNavigator .DMPNBtn .quick li span.ico_mobile {background-position:-100px -100px; width:11px; height:14px;}
	#DMPanelNavigator .DMPNBtn .quick li:hover span.ico_mobile {background-position:-100px -120px;}
	#DMPanelNavigator .DMPNFooter {position:absolute; bottom:0px; width:100%; height:30px; line-height:32px; background:#121212; text-align:center; font-size:10px; color:#8a8a8a; letter-spacing:1px; cursor:pointer;}
	#DMPanelNavigator .DMPNFooter:hover {background:#000; color:#ccc;}
	#DMPanelNavigator .DMPNFooter span {display:inline-block; margin-left:6px; background:url('/admin/skin/default/images/design/bg_dark.png') no-repeat; vertical-align:middle; text-indent:-9999px; cursor:pointer;}
	#DMPanelNavigator .DMPNFooter span.ico_arrow {background-position:0 -197px; width:5px; height:12px;}
	
	/* 우측 툴바 - 스크롤바 */
	#DMPanelNavigator .DMPNBody .scrollbar-inner > .scroll-content {overflow:hidden;}
	#DMPanelNavigator .DMPNBody .scrollbar-inner > .scroll-element.scroll-y {width:6px; top:6px; right:6px;}
	#DMPanelNavigator .DMPNBody .scrollbar-inner > .scroll-element .scroll-element_track,
	#DMPanelNavigator .DMPNBody .scrollbar-inner > .scroll-element .scroll-bar {background-color:rgba(0,0,0,0.2);}
	#DMPanelNavigator .DMPNBody .scrollbar-inner > .scroll-element:hover .scroll-bar,
	#DMPanelNavigator .DMPNBody .scrollbar-inner > .scroll-element.scroll-draggable .scroll-bar {background-color:rgba(0,0,0,0.6);}

	/* 기능 넣기 레이어 */
	#DMPanelNavigatorControlMenu {display:none; z-index:1; /*position:absolute; left:14px; right:32px; margin-top:1px; border:1px solid transparent;*/ border-top:1px solid #005691;}
	#DMPanelNavigatorControlMenu .DMPNCMTitle {display:none; height:35px; line-height:35px; background:#444; text-align:center; font-size:11px; color:#00cef3;}
	#DMPanelNavigatorControlMenu .DMPNCMItem {height:35px; line-height:35px; border-top:1px solid #005691; background:#0064a9 url('/admin/skin/default/images/design/bg_dark.png') no-repeat 16px -385px; padding-left:30px; font-size:11px; color:#d8f0ff; cursor:pointer;}
	#DMPanelNavigatorControlMenu .DMPNCMItem:first-child {border-top:none;}	
	#DMPanelNavigatorControlMenu .DMPNCMItem.sel {background-color:#0170b9;}
	#DMPanelNavigatorControlMenu .DMPNCMItem:hover {background:#005691 url('/admin/skin/default/images/design/bg_dark.png') no-repeat 16px -425px; color:#fff;}	
	#DMPanelNavigatorControlMenu .DMPNCMItem span {display:block; font-size:inherit; color:inherit;}
	#DMPanelNavigatorControlMenu .DMPNCMHighlight {color:#ffba00;}


	/******************************************* LIGHT 버전 *******************************************/

	/* 레이어 팝업창 */
	#EYE-DESIGN.lightColor #DMModalBackground {background:#999;}
	#EYE-DESIGN.lightColor #DMWindow {border-color:#8c98b0;}
	#EYE-DESIGN.lightColor #DMWindow #DMWindowTitle {border-color:#8c98b0; background:#8c98b0; color:#fff;}
	#EYE-DESIGN.lightColor #DMWindow #DMWindowTitle .DMWTTextLeft a {color:#ffe552;}
	#EYE-DESIGN.lightColor #DMWindow #DMWindowTitle .DMWTClose span {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat;}
	#EYE-DESIGN.lightColor #DMWindow #DMWindowTitle .DMWTClose span.ico_expand {background-position:0 -80px;}
	#EYE-DESIGN.lightColor #DMWindow #DMWindowTitle .DMWTClose span.ico_reduction {background-position:-20px -80px;}
	#EYE-DESIGN.lightColor #DMWindow #DMWindowTitle .DMWTClose span.ico_close {background-position:-40px -80px;}

	/* 상단 툴바 */
	#EYE-DESIGN.lightColor #DMPanelTop {background:#fefefe; background:rgba(254,254,254,0.95); box-shadow:0 0 5px 3px rgba(164,164,164,0.5);}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTLeft span,
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTLeft a {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat 0 -142px; color:#666;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTLeft span:hover, 
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTLeft a:hover {color:#000;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTCenter .skinName {font-weight:600; color:#333;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTCenter .skinLogin input[type="button"] {background:#9faabe; color:#fff;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTCenter .skinLogin input[type="button"]:hover {background:#33a6ff; color:#fff;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .DMPTRSetMode-title, 
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight a.DMPTRGoadmin {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat 0 -182px; color:#666;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .DMPTRSetMode-title:hover, 
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight a.DMPTRGoadmin:hover {color:#000;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .DMPTRSetMode-subnb {border-color:#d1d4d9; background:#fefefe;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .DMPTRSetMode-subnb li.DMPTRSetMode-subnb-item a {color:#333;}
	#EYE-DESIGN.lightColor #DMPanelTop .DMPTRight .DMPTRSetMode-subnb li.DMPTRSetMode-subnb-item:hover a {background:#9faabe; color:#fff;}	

	/* 우측 툴바 - 최소화 */
	#EYE-DESIGN.lightColor #DMPanelNavigatorBtn .offImg {background:#c2c2c2 url('/admin/skin/default/images/design/bg_light.png') no-repeat 0 -480px;}
	#EYE-DESIGN.lightColor #DMPanelNavigatorBtn .onImg {background:#fff url('/admin/skin/default/images/design/bg_light.png') no-repeat -50px -480px; box-shadow:0 3px 5px 2px rgba(164,164,164,0.5);}

	/* 우측 툴바 - 활성화 */
	#EYE-DESIGN.lightColor #DMPanelNavigator {border:1px solid #a4a4a4; background:#f7f7f7; background:rgba(247,247,247,0.98);}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNHeader span {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNHeader span.DMPNHTitle {background-position:0 -20px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNHeader span.DMPNHSwitch {background-position:0 -40px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNHeader.designEditMode span.DMPNHSwitch {background-position:-40px -40px;}

	/* 우측 툴바 - 리스트 */
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNList {border-color:#cad1db;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth1 {background:#cad1db;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth1Item .DMPNListDepth1ItemTitle {background:#fff url('/admin/skin/default/images/design/bg_light.png') no-repeat 12px -224px; color:#323232;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth1Item:hover .DMPNListDepth1ItemTitle,
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth1Item.opened .DMPNListDepth1ItemTitle {background:#d6dbe1 url('/admin/skin/default/images/design/bg_light.png') no-repeat 12px -264px; font-weight:600; color:#323232;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 {background:#8c98b0;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item a {background:#9faabe url('/admin/skin/default/images/design/bg_light.png') no-repeat 14px -303px; color:#fff;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item:hover a,
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item.opened a {background:#4da2ff url('/admin/skin/default/images/design/bg_light.png') no-repeat 14px -343px; color:#fff;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item a span.dn_icon {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat 0 -100px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item:hover a span.dn_icon,
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBody .DMPNListDepth2 .DMPNListDepth2Item.controlMenuOpened a span.dn_icon {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat -20px -100px;}	
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout {border-color:#cad1db;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li {border-color:#cad1db; background:#f5f6f8; color:#666;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li:hover {background:#fff; color:#000;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li span, 
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .quick li span {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li span.ico_allpage {background-position:-40px -100px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li span.ico_layout {background-position:-60px -100px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li span.ico_newpage {background-position:-80px -100px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li span.ico_mobile {background-position:-100px -100px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li:hover span.ico_allpage {background-position:-40px -120px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li:hover span.ico_layout {background-position:-60px -120px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li:hover span.ico_newpage {background-position:-80px -120px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNBtn .layout li:hover span.ico_mobile {background-position:-100px -120px;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNFooter {border-top:1px solid #cad1db; background:#fff; color:#8a8a8a;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNFooter:hover {background:#fefefe; color:#000;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNFooter span {background:url('/admin/skin/default/images/design/bg_light.png') no-repeat;}
	#EYE-DESIGN.lightColor #DMPanelNavigator .DMPNFooter span.ico_arrow {background-position:0 -197px;}

	 /* 기능 넣기 레이어 */
	#EYE-DESIGN.lightColor #DMPanelNavigatorControlMenu {border-top-color:#397ad5;}
	#EYE-DESIGN.lightColor #DMPanelNavigatorControlMenu .DMPNCMItem {border-color:#397ad5; background:#3b8be4 url('/admin/skin/default/images/design/bg_light.png') no-repeat 16px -385px; color:#d8f0ff;}	
	#EYE-DESIGN.lightColor #DMPanelNavigatorControlMenu .DMPNCMItem.sel {background-color:#3f9aed;}
	#EYE-DESIGN.lightColor #DMPanelNavigatorControlMenu .DMPNCMItem:hover {background:#1f70cb url('/admin/skin/default/images/design/bg_light.png') no-repeat 16px -425px; color:#fff;}	
</style>

<div id="EYE-DESIGN">
	<div id='DMModalBackground'></div>
	<div id='DMWindow'>
		<div id='DMWindowTitle' class='clearbox'>
			<div class='DMWTTextCenter'>
				<span class="prefix"></span>
				<span class="title"></span>
			</div>
			<div class='DMWTTextLeft'></div>
			<div class='DMWTTextRight'></div>
			<div class='DMWTClose'>
				<span onclick="zoomIn();" class="ico_expand" title="확대하기">확대하기</span>
				<span onclick="zoomOut();" class="ico_reduction" title="축소하기">축소하기</span>
				<span onmousedown="DM_window_close()" class="ico_close" title="닫기">닫기</span>
			</div>
		</div>
		<div id='DMWindowBody'>
			<iframe id='DMWindowBodyIframe'></iframe>
		</div>
	</div>
	<!-- //레이어 팝업창 -->

	<div id="DMPanelTop">
		<div class="DMPTLeft">
			<a href="http://gmanual.firstmall.kr/manual/view?category=00110002" target="_blank">온라인 매뉴얼</a>		
			<span id="css_editor_btn" onclick="DM_window_sourceeditor('<?php echo $TPL_VAR["css_path"]?>');">CSS 편집</span>
			<span onclick="DM_window_eyeeditor('data/skin/<?php echo $TPL_VAR["designWorkingSkin"]?>/<?php echo $TPL_VAR["template_path"]?>');">HTML 편집</span>		
		</div>
		<div class="DMPTCenter">
			<span class="skinName" title="<?php echo $TPL_VAR["designWorkingSkin"]?>">작업스킨 : <?php echo $TPL_VAR["designWorkingSkin"]?></span>
			<span class="skinLogin">
<?php if($TPL_VAR["design_userlogin"]=='N'){?>
				<span class="<?php if($TPL_VAR["design_userlogin"]!='N'){?>cyanblue<?php }?>"><input type="button" value="로그인" onclick="t_id_list_login()"/></span>
<?php }else{?>
				<span class="<?php if($TPL_VAR["design_userlogin"]=='N'){?>cyanblue<?php }?>"><input type="button" value="로그아웃" onclick="t_id_list_logout()" /></span>
<?php }?>
			</span>			
		</div>
		<div class="DMPTRight">
<?php if($TPL_VAR["config_system"]["operation_type"]!='light'){?>
			<span class="DMPTRSetMode">
				<span class="DMPTRSetMode-title">디자인 환경</span>
				<ul class="DMPTRSetMode-subnb">
<?php if(!serviceLimit('H_ST')){?>
					<li class="DMPTRSetMode-subnb-item"><a href="//<?php echo $TPL_VAR["pcDomain"]?>/?setMode=pc" >PC</a></li>
					<li class="DMPTRSetMode-subnb-item"><a href="//<?php echo $TPL_VAR["mobileDomain"]?>/?setMode=mobile">Mobile/Tablet</a></li>
<?php if(serviceLimit('H_FR')){?>
					<li class="DMPTRSetMode-subnb-item hand"><span onclick="<?php echo serviceLimit('A1')?>"><a>Facebook PC</a></span></li>
<?php }else{?>
					<li class="DMPTRSetMode-subnb-item"><a href="//<?php echo $TPL_VAR["pcDomain"]?>/?setMode=fammerce">Facebook PC</a></li>
<?php }?>
<?php }?>
<?php if(serviceLimit('H_ST')){?>
					<li class="DMPTRSetMode-subnb-item"><a href="//<?php echo $TPL_VAR["pcDomain"]?>/?setMode=store" >PC</a></li>
					<li class="DMPTRSetMode-subnb-item"><a href="//<?php echo $TPL_VAR["mobileDomain"]?>/?setMode=storemobile">Mobile</a></li>
					<li class="DMPTRSetMode-subnb-item"><a href="//<?php echo $TPL_VAR["mobileDomain"]?>/?setMode=storefammerce">Facebook PC</a></li>
<?php }?>
				</ul>
			</span>
<?php }?>
			<a href="/admin" target="_blank" class="DMPTRGoadmin">관리자 환경</a>
			<span onclick="lightColor();" class="lightColor">LIGHT 색상선택</span>
			<span onclick="darkColor();" class="darkColor">DARK 색상선택</span>
		</div>	
	</div>
	<!-- //상단 툴바 -->

	<div id="DMPanelNavigatorBtn">
		<ul class="offImg">
			<li class="onoff" onclick="$('#DMPanelNavigator .DMPNHSwitch').click();" title="EYE-DESIGN 기능 Off">EYE-DESIGN 기능 Off</li>
			<li class="open" onclick="DMPanelOpen(true);" title="EYE-DESIGN 패널 Open">EYE-DESIGN 패널 Open</li>
		</ul>
		<ul class="onImg">
			<li class="onoff" onclick="$('#DMPanelNavigator .DMPNHSwitch').click();" title="EYE-DESIGN 기능 On">EYE-DESIGN 기능 On</a></li>
			<li class="open" onclick="DMPanelOpen(true);" title="EYE-DESIGN 패널 Open">EYE-DESIGN 패널 Open</a></li>
		</ul>
	</div>
	<!-- //우측 툴바 - 최소화 -->

	<div id="DMPanelNavigator">
		<div class="DMPNHeader">
			<span class="DMPNHTitle">EYE-DESIGN</span>
			<span class="DMPNHSwitch" title="EYE-DESIGN 기능 On/Off">On/Off</span>
		</div>
		<div class="DMPNBody">		
			<div class="DMPNList scrollbar-inner" style="<?php if($_COOKIE["DPNListHeight"]){?>height:<?php echo $_COOKIE["DPNListHeight"]?>px<?php }?>;">
				<ul class="DMPNListDepth1">
<?php if($TPL_folders_1){$TPL_I1=-1;foreach($TPL_VAR["folders"] as $TPL_V1){$TPL_I1++;?>
					<li class="DMPNListDepth1Item">
						<span class="DMPNListDepth1ItemTitle <?php if($TPL_I1% 2== 0){?>DMPNListDepth1ItemBg1<?php }else{?>DMPNListDepth1ItemBg2<?php }?>">
							<?php echo $TPL_V1["name"]?>

						</span>
<?php if($TPL_V1["files"]){?>
						<ul class="DMPNListDepth2">
<?php if(is_array($TPL_R2=$TPL_V1["files"])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
							<li class="DMPNListDepth2Item <?php if($TPL_I2% 2== 0){?>DMPNListDepth2ItemBg1<?php }else{?>DMPNListDepth2ItemBg2<?php }?>" path="<?php echo $TPL_V2["path"]?>" file_type="<?php echo $TPL_V2["file_type"]?>">
<?php if(in_array($TPL_V2["file_type"],array('layout','goods_view','view','nologin','noview','settle'))){?>
									<a href="<?php echo $TPL_V2["url"]?>" onclick="openDialogAlert('<?php echo $TPL_V2["file_type_msg"]?>',800,170); <?php if($TPL_V2["file_type"]!='nologin'){?>DM_window_sourceeditor('<?php echo $TPL_V2["path"]?>');<?php }?> return false;"><span class="dn_text"><?php echo $TPL_V2["desc"]?></span><span class="dn_icon">아이콘</span></a>
<?php }elseif($TPL_V2["file_type"]=='_blank'){?>
									<a href="<?php echo $TPL_V2["url"]?>" target='_blank'><span class="dn_text"><?php echo $TPL_V2["desc"]?></span><span class="dn_icon">아이콘</span></a>
<?php }else{?>
									<a href="<?php echo $TPL_V2["url"]?>"><span class="dn_text"><?php echo $TPL_V2["desc"]?></span><span class="dn_icon">아이콘</span></a>
<?php }?>
							</li>
<?php }}?>
						</ul>
<?php }?>
					</li>
<?php }}?>
<?php if($TPL_boards_1){$TPL_I1=-1;foreach($TPL_VAR["boards"] as $TPL_V1){$TPL_I1++;?>
					<li class="DMPNListDepth1Item">
						<span class="DMPNListDepth1ItemTitle <?php if($TPL_I1% 2== 0){?>DMPNListDepth1ItemBg1<?php }else{?>DMPNListDepth1ItemBg2<?php }?>">
							<?php echo $TPL_V1["name"]?>

						</span>
<?php if($TPL_V1["files"]){?>
						<ul class="DMPNListDepth2">
<?php if(is_array($TPL_R2=$TPL_V1["files"])&&!empty($TPL_R2)){$TPL_I2=-1;foreach($TPL_R2 as $TPL_V2){$TPL_I2++;?>
							<li class="DMPNListDepth2Item <?php if($TPL_I2% 2== 0){?>DMPNListDepth2ItemBg1<?php }else{?>DMPNListDepth2ItemBg2<?php }?>" path="<?php echo $TPL_V2["path"]?>" file_type="<?php echo $TPL_V2["file_type"]?>">
								<a href="<?php echo $TPL_V2["url"]?>"  <?php if(in_array($TPL_V2["file_type"],array('board_view','layout','goods_view','noview','settle'))){?>onclick="openDialogAlert('<?php echo $TPL_V2["file_type_msg"]?>',800,160); <?php if($TPL_V2["file_type"]!='nologin'){?>DM_window_sourceeditor('<?php echo $TPL_V2["path"]?>');<?php }?> return false;"<?php }?>><span class="dn_text"><?php echo $TPL_V2["desc"]?></span><span class="dn_icon">아이콘</span></a>
							</li>
<?php }}?>
						</ul>
<?php }?>
					</li>
<?php }}?>
				</ul>
			</div>
			<!-- //메뉴 리스트 -->

			<div id="DMPanelNavigatorControlMenu">
				<div class="DMPNCMTitle">이 페이지에</div>
				<ul>
					<li class="DMPNCMItem" cmd="image_insert"><span>이미지 넣기</span></li>
<?php if($TPL_VAR["config_system"]["operation_type"]!='light'){?>
					<li class="DMPNCMItem" cmd="flash_insert"><span>플래시 넣기</span></li>
<?php }?>
					<li class="DMPNCMItem" cmd="banner_insert"><span>슬라이드 배너 넣기</span></li>
<?php if($TPL_VAR["config_system"]["operation_type"]!='light'){?>
					<li class="DMPNCMItem" cmd="video_insert"><span>동영상 넣기</span></li>
<?php }?>
					<li class="DMPNCMItem" cmd="display_insert"><span>상품디스플레이 넣기</span></li>
					<li class="DMPNCMItem" cmd="popup_insert"><span>띠배너/팝업 띄우기</span></li>
					<li class="DMPNCMItem" cmd="lastest_insert"><span>게시판 넣기</span></li>
					<li class="DMPNCMItem" cmd="broadcast_insert"><span>라이브 방송 넣기</span></li>
					<li class="DMPNCMItem sel" cmd="source_edit"><span>HTML소스 편집하기</span></li>
					<li class="DMPNCMItem sel" cmd="layout_edit"><span>페이지별 레이아웃 설정</span></li>
				</ul>
			</div>
			<!-- //기능 넣기 레이어 -->
		</div>
		<div class="DMPNBtn">			
			<ul class="layout">				
				<li onclick="DM_window_layout('basic')"><span class="ico_layout">아이콘</span>전체 레이아웃 설정</li>
				<li onclick="DM_window_allpages('<?php echo $TPL_VAR["template_path"]?>')"><span class="ico_allpage">아이콘</span>전체 페이지 보기</li>
				<li onclick="DM_window_layout_create()"><span class="ico_newpage">아이콘</span>새 페이지 만들기</li>
				
<?php if(!$TPL_VAR["mobileMode"]&&!$TPL_VAR["storemobileMode"]){?>
				<!-- <li onclick="DM_window_pc_quick_design()"><span class="ico_pc">아이콘</span>PC버튼 QUICK 디자인</li> -->
<?php }?>

<?php if(($TPL_VAR["mobileMode"]||$TPL_VAR["storemobileMode"])&&$TPL_VAR["config_system"]["operation_type"]!='light'){?>
				<li onclick="DM_window_mobile_quick_design()"><span class="ico_mobile">아이콘</span>모바일 QUICK 디자인</li>
<?php }?>

<?php if($TPL_VAR["config_system"]["operation_type"]=='light'){?>
				<li onclick="DM_window_responsive_quick_design()"><span class="ico_mobile">아이콘</span>반응형 QUICK 디자인</li>
<?php }?>
			</li>
		</div>
		<!-- //하단 패널 버튼 -->
		<div onclick="DMPanelClose();" class="DMPNFooter">
			CLOSE<span class="ico_arrow">&gt;</span>
		</div>
	</div>
	<!-- //우측 툴바 - 활성화 -->
</div>

<script type="text/javascript">	
	var designWorkingSkin = "<?php echo $TPL_VAR["designWorkingSkin"]?>";
	$(function(){
		// 현재페이지 처리
		$(".DMPNListDepth2Item[path='<?php echo $TPL_VAR["template_path"]?>']").each(function(){
			// 메뉴 열어놓기
			$(this).addClass("opened");
			$(this).closest(".DMPNListDepth1Item").addClass("opened");
		});
		if(!$.cookie('DMPanelClosed')){
			DMPanelOpen();
		}
	});

	//테스트 로그인
	function t_id_list_login(chk) {	
<?php if($TPL_VAR["design_userlogin"]=='N'){?>
		DM_window('테스트용 회원',800,400,'../admin/design/t_id_list',{'alone':true});		
<?php }else{?>
		alert('이미 test 계정 로그인이 되셨습니다.');
<?php }?>
	}
	function t_id_list_logout() {
<?php if($TPL_VAR["design_userlogin"]!='N'){?>
		alert('로그아웃 화면이 되었습니다.');
		document.location.href="/login_process/logout";
<?php }else{?>
		alert('로그인이 되어있지 않습니다.');
<?php }?>
	}

	$(function(){		
		//상단 툴바
		$("#DMPanelTop .DMPTRSetMode").each(function(){
			$(this)
			.bind('mouseenter',function(){
				$(".DMPTRSetMode-subnb",this).stop(true,true).slideDown('fast');
			})
			.bind('mouseleave',function(){
				$(".DMPTRSetMode-subnb",this).stop(true,true).slideUp('fast');
			});
		});

		//스크롤바 스타일
		$("#DMPanelNavigator .scrollbar-inner").scrollbar();

		//레이어 팝업창 확대/축소
		$("#DMWindow .ico_reduction").hide();
		$("#DMWindow .ico_expand").click(function(){
			$(this).hide();
			$("#DMWindow .ico_reduction").show();
		});
		$("#DMWindow .ico_reduction").click(function(){
			$(this).hide();
			$("#DMWindow .ico_expand").show();
		});
	
		//DARK/LIGHT 색상 변경
		$("#EYE-DESIGN .lightColor").click(function(){
			$.cookie("lightColord","no",1,{path:'/'});
			lightColor();
		});
		$("#EYE-DESIGN .darkColor").click(function(){
			$.cookie("lightColord","yes",1,{path:'/'});
			darkColor();	
		});
		if($.cookie("lightColord") == 'no'){
			lightColor();
		};
		//alert( $.cookie("lightColord") );
	});

	//레이어 팝업창 확대/축소
	function zoomIn() {
		$("#DMWindow").addClass("zoomIn")
	};
	function zoomOut() {
		$("#DMWindow").removeClass("zoomIn")
	};
	
	//DARK/LIGHT 색상 변경
	function lightColor() {
		$("#EYE-DESIGN").addClass("lightColor");	
		$("#EYE-DESIGN").removeClass("darkColor");
	};
	function darkColor() {
		$("#EYE-DESIGN").addClass("darkColor");	
		$("#EYE-DESIGN").removeClass("lightColor");
	};
</script>