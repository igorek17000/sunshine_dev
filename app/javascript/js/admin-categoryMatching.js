var reloaded	= false;

$('document').ready(function() {

	if (reloaded === true)
		return false;

	reloaded	= true;

	category_admin_select_load('','searchCategory1','', function (){ searchCategoryReset('searchCategory', 1); });

	$("select[name='searchCategory1']").off('change').on("change", function(e, callback){
		category_admin_select_load('searchCategory1','searchCategory2',$(this).val(),function(){
			if (typeof callback == 'function')
				callback();
		});
		category_admin_select_load('searchCategory2','searchCategory3',"");
		category_admin_select_load('searchCategory3','searchCategory4',"");
	});

	$("select[name='searchCategory2']").off('change').on("change",function(e, callback){
		category_admin_select_load('searchCategory2','searchCategory3',$(this).val(),function(){
			if (typeof callback == 'function')
				callback();
		});
		category_admin_select_load('searchCategory3','searchCategory4',"");
	});

	$("select[name='searchCategory3']").off('change').on("change",function(e, callback){
		category_admin_select_load('searchCategory3','searchCategory4',$(this).val(),function(){
			if (typeof callback == 'function')
				callback();
		});
	});

	category_admin_select_load('','selectCategory1', '');

	$("select[name='selectCategory1']").off('change').on("change",function(e, callback){
		category_admin_select_load('selectCategory1','selectCategory2', $(this).val(), function(){
			if (typeof callback == 'function')
				callback();
		});
		category_admin_select_load('selectCategory2','selectCategory3',"");
		category_admin_select_load('selectCategory3','selectCategory4',"");
	});
	$("select[name='selectCategory2']").off('change').on("change",function(e, callback){
		category_admin_select_load('selectCategory2','selectCategory3',$(this).val(), function(){
			if (typeof callback == 'function')
				callback();
		});
		category_admin_select_load('selectCategory3','selectCategory4',"");
	});
	$("select[name='selectCategory3']").off('change').on("change",function(e, callback){
		category_admin_select_load('selectCategory3','selectCategory4',$(this).val(), function(){
			if (typeof callback == 'function')
				callback();
		});
	});


	$('#setMyCategory').click(function() {
		var categoryCode	= '';
		var categoryText	= '';

		if ($('#selectCategory1').val() !== '') {
			categoryCode	= $('#selectCategory1').val();
			categoryText	= $('#selectCategory1 > option:selected').text();
		} else {
			openDialogAlert('??????????????? ????????? ?????????');
			return;
		}

		if ($('#selectCategory2').val() !== '') {
			categoryCode	= $('#selectCategory2').val();
			categoryText	+= ' > ' + $('#selectCategory2 > option:selected').text();
		}

		if ($('#selectCategory3').val() !== '') {
			categoryCode	= $('#selectCategory3').val();
			categoryText	+= ' > ' + $('#selectCategory3 > option:selected').text();
		}

		if ($('#selectCategory4').val() !== '') {
			categoryCode	= $('#selectCategory4').val();
			categoryText	+= ' > ' + $('#selectCategory4 > option:selected').text();
		}

		$('#fmCategoryCode').val(categoryCode);
		$('#selectedCateName').html(categoryText);
	});

	$("#chkAll").click(function(){
		if($(this).attr("checked"))
			$(".chk").attr("checked",true).change();
		else
			$(".chk").attr("checked",false).change();
	});

	$("#delete_btn, .deleteBtn").click(function(){
		var cnt = $("input:checkbox[name='seq[]']:checked").length;
		if(cnt<1){
			openDialogAlert("????????? ??????????????? ????????? ?????????.");
			return;
		}else{
			seqList = $("input:checkbox[name='seq[]']:checked").map(function(){
				return this.value;
			}).get();

			if(!confirm("????????? ??????????????? ?????? ??????????????????? "))
				return;

			var params			= {};
			params.matchedSeq	= seqList;

			$.ajax({
				url: '../market_connector_process/deleteCategoryMatch',
				type: 'DELETE',
				dataType: "json",
				data: params,
				success: function(response){
					if (response.success == 'Y') {
						openDialogAlert('????????????');
						location.reload();
					} else {
						openDialogAlert('????????????');
					}
				}
			});
		}
	});


	$('#selMatchingMarket').change(function() {
		var market		= this.value;
		if(market == "shoplinker"){
			var marketOtherList	= marketObj[market].marketOtherList;
		}
		
		var sellerList	= marketObj[market].sellerList;
		var sellerCnt	= sellerList.length;

		$('.requiredAddInfo').hide();
		$('.requiredAddInfoValue').attr('disabled', true);

		$('.requiredAddInfo[market="' + market + '"]').show();
		$('.requiredAddInfoValue[market="' + market + '"]').attr('disabled', false);
		
		// ?????? ????????? ?????????
		$('.marketCategoryInfo').val('');
		$('#selMatchingMarketUserId > option').remove();
		$('.marketCategory > option').remove();
		
		$('.marketCategory').append('<option value="">??????</option>');
		

		if (sellerCnt < 1) {
			$('#selMatchingMarketUserId').append('<option value="">????????? ?????? ???????????? ????????????.</option>');
			return;
		}

		$('#selMatchingMarketUserId').append('<option value="">??????</option>');

		for (i = 0; i < sellerCnt; i++){
			$('#selMatchingMarketUserId').append('<option value="' + sellerList[i] + '">' + sellerList[i] + '</option>');				
			/*if(market == "shoplinker"){
				$('#selMatchingMarketUserId').append('<option value="' + sellerList[i] + '">' + marketOtherList[i] + "(" + sellerList[i] + ")" + '</option>');
			}else{
				
			}*/
			
		}

	});

	$('#selMatchingMarketUserId').change(function() {
		seller_id	= this.value;
		market		= $('#selMatchingMarket').val();

		if (market != '' && seller_id != ''){
			getCategory('dep1_category');	
		}
			
	});


	$('#selMatchingMarket > option').remove();

	for(market in marketObj)
		$('#selMatchingMarket').append('<option value="' + market + '">' + marketObj[market].name + '</option>');

	if (searchObj.limit > 0) {
		var $limitOpeion	= $('#limit > option[value="' + searchObj.limit + '"]');
		$limitOpeion.parent().parent().find('.drop_multi_main > a').html($limitOpeion.text())
	}

});

function searchCategoryReset(target, targetNum, lastFunction) {
	var categoryObj	= searchObj['searchCategory' + targetNum];

	if (typeof categoryObj == 'string' && categoryObj != '') {
		$("select[name='" + target + targetNum + "']").val(categoryObj).trigger('change', function() {
			var nextNum  		= targetNum + 1;
			var nextCategoryObj	= searchObj['searchCategory' + nextNum];

			if (typeof $("select[name='" + target + nextNum + "']").prop("tagName") != 'undefined') {
				if (typeof nextCategoryObj == 'string' && nextCategoryObj != '') {
					searchCategoryReset(target, nextNum, lastFunction);
				} else {
					if (typeof lastFunction == 'function')
						lastFunction();
				}

			}
		});
	}

}

function addCategoryMatching(fmCategoryCode){
	if(!marketObj[market].sellerList){
		openDialogAlert('????????? ????????? ????????????. ?????? ?????? ??? ?????? ???????????????.', 0, 0, function(){
			location.href='/admin/market_connector/market_setting?pageMode=AccountSet';
		});
		return false;
	}
	$('#selMatchingMarket').val($('#market').val()).trigger('change', 'dd');
	$('#selMatchingMarketUserId').val($('#sellerId').val()).trigger('change');
	if (typeof searchObj.searchCategory1 == 'string' && searchObj.searchCategory1 != '') {
		searchCategoryReset('selectCategory', 1, function(){
			$('#setMyCategory').click();
		});
	}

	openDialog("???????????? ?????? ??????", "categoryMatchingLay", {"width":"1040","height":"700"}, function(){
		var page	= $('#page').val();
		movePage(page);
	});

	$('#categoryMatchingLay').closest('.ui-dialog').css({'left':'calc(50% - 520px)', 'top':'calc(50% - 350px)'});

	if (typeof fmCategoryCode != 'undefined' && fmCategoryCode.length > 3)
		setMatchedCategory(fmCategoryCode)
}

function shoplinkerAddCategoryMatching(fmCategoryCode, sellerId){
	$('#selMatchingMarket').val($('#market').val()).trigger('change', 'dd');
	$('#selMatchingMarketUserId').val(sellerId).trigger('change');
	if (typeof searchObj.searchCategory1 == 'string' && searchObj.searchCategory1 != '') {
		searchCategoryReset('selectCategory', 1, function(){
			$('#setMyCategory').click();
		});
	}

	openDialog("???????????? ?????? ??????", "categoryMatchingLay", {"width":"1040","height":"700"}, function(){
		var page	= $('#page').val();
		movePage(page);
	});

	$('#categoryMatchingLay').closest('.ui-dialog').css({'left':'calc(50% - 520px)', 'top':'calc(50% - 350px)'});

	if (typeof fmCategoryCode != 'undefined' && fmCategoryCode.length > 3)
		setMatchedCategory(fmCategoryCode)
}

function setMatchedCategory(fmCategoryCode) {
	var params	= {};
	params.fm_categor_code	= fmCategoryCode;

	var callback	= function(response) {
		var matchedCnt	= response.marketCategoryList.length;

		$('#selectedCateName').html(response.fmCategoryName);
		$('#fmCategoryCode').val(response.fmCategoryCode);
		$('#matchedCategoryList > tr').remove();

		if (matchedCnt < 1) {
			$('#matchedCategoryList').append('<tr><td colspan="5">????????? ??????????????? ????????????.</td></tr>');
			return;
		}

		var baseTr	= '<tr><td></td>';
		baseTr		+= '<td></td>';
		baseTr		+= '<td></td>';
		baseTr		+= '<td class="left"></td>';
		baseTr		+= '<td></td>';
		baseTr		+= '<td></td></tr>';

		var $baseTrObj	= $(baseTr);

		for (i = 0; i < matchedCnt; i++) {
			var $nowObj			= $baseTrObj.clone();
			var nowMatchedInfo	= response.marketCategoryList[i];

			if (marketObj.hasOwnProperty(nowMatchedInfo.market) == true)
				var marketName		= marketObj[nowMatchedInfo.market].name;
			else
				var marketName		= '????????????';

			requiredAddInfoSummery	= nowMatchedInfo.required_addInfo_summery.replace(/\n/g,"<br>");

			var delBtn	= "<button type='button' onclick='doMatchingDelete(" + nowMatchedInfo.seq + ")' class='btn_minus'></button>";

			$nowObj.find('td:eq(0)').html(marketName);
			$nowObj.find('td:eq(1)').html(nowMatchedInfo.seller_id);
			$nowObj.find('td:eq(2)').html(nowMatchedInfo.category_code);
			$nowObj.find('td:eq(3)').html(nowMatchedInfo.full_category_name);
			$nowObj.find('td:eq(4)').html(requiredAddInfoSummery);
			$nowObj.find('td:eq(5)').html(delBtn);

			$('#matchedCategoryList').append($nowObj);
		}
	}

	$.get('../market_connector_process/getMatchedCategory',params, callback, 'json');
}


function doCategoryMatch() {
	var fmCategoryCode		= $('#fmCategoryCode').val();
	var marketCategoryCode	= $('#category_code').val();

	var requiredValues		= $('.requiredAddInfoValue');
	var requiredList		= {};

	for (cnt = requiredValues.length, i = 0; i < cnt; i++) {

		var $nowForm		= $(requiredValues[i]);
		if ($nowForm.attr('disabled') == 'disabled')
			continue;

		var formType		= ($nowForm.prop("type").match(/^select/) == 'select') ? 'select' : $nowForm.prop("type");
		var nowTitle		= $nowForm.attr('itemName');
		var tatgetName		= $nowForm.attr('name');
		var nowValue		= $nowForm.val();


		if ($nowForm.attr('required') == 'required' && $.trim(nowValue) == '') {
			openDialogAlert('"' + nowTitle + '" ????????? ?????? ?????????.');
			$('#input[name="' + $nowForm.attr('name') + '"]').focus();
			return false;
		}

		requiredList[tatgetName]	= {};
		var nowRequiredInfo			= requiredList[tatgetName];

		if (nowValue == '') {
			nowRequiredInfo.title		= nowTitle;
			nowRequiredInfo.value		= '';
			nowRequiredInfo.valueText	= '????????????';
			continue;
		}
		
		switch (formType) {
			case	'select' :
				nowRequiredInfo.title		= nowTitle;
				nowRequiredInfo.value		= nowValue;
				nowRequiredInfo.valueText	= $('#' + tatgetName).find('option:selected').text();
				break;

			case 	'radio' :
				if ($nowForm.is(":checked") !== true)
					continue;

			default :
				nowRequiredInfo.title		= nowTitle;
				nowRequiredInfo.value		= nowValue;
				nowRequiredInfo.valueText	= nowValue;
		}
	}

	if (fmCategoryCode.length < 4){
		openDialogAlert(shopName + ' ??????????????? ?????? ?????????');
		return;
	}

	if (marketCategoryCode.length < 2) {
		openDialogAlert('?????? ??????????????? ?????? ?????????');
		return;
	}

	var params				= {};
	params.fm_category_code	= fmCategoryCode;
	params.market			= $('#selMatchingMarket').val();
	params.sellerId			= $('#selMatchingMarketUserId').val();
	params.requiredAddInfo	= requiredList;

	var doMatchingCategory	= function () {
		$('.marketCategoryInfo').each(function() {
			params[$(this).attr('name')]	= this.value;
		});

		$.post('../market_connector_process/saveCategoryMatch', params, function(response){

			if (response.success == 'Y') {
				openDialogAlert("??????????????? ?????????????????????.");
				addCategoryMatching(fmCategoryCode);
			} else {
				openDialogAlert(response.errorMessage);
			}

		}, 'json');
	}

	$.get('../market_connector_process/checkMatchedCategory', params, function(response) {

		if (response.marketCategoryList.length > 0) {
			var matchedInfo	= response.marketCategoryList[0];
			var message		= "?????? ??????????????? <span class='red bold'>\"" + matchedInfo.full_category_name + "\"</span>??? <br/>?????? ???????????? ????????????.<br/><span class='blue bold'>????????? ?????? ???????????????????</span>";
			var btnOpt		= {'yesMsg':'[???] ??????', 'noMsg':'[?????????] ??????'}
			var width		= 500;
			var height		= 200;
		} else {
			var message		= "<span class='blue bold'>?????? ??????????????? ???????????? ?????????.</span>";
			var btnOpt		= {'yesMsg':'[???] ??????', 'noMsg':'[?????????] ??????'}
			var widht		= 300;
			var height		= 200;
		}

		openDialogConfirm(message, width, height, doMatchingCategory, function(){}, btnOpt);
	},'json');

}

function doMatchingDelete(seq, mode) {

	var btnOpt		= {'yesMsg':'[???] ??????', 'noMsg':'[?????????] ??????'}

	openDialogConfirm('?????? ????????? ?????? ???????????????????', 300, 160, function() {
		var params	= {};
		params.matchedSeq	= seq;
		$.ajax({
			url: '../market_connector_process/deleteCategoryMatch',
			type: 'DELETE',
			dataType: "json",
			data: params,
			success: function(response) {
				if (response.success == 'Y') {
					openDialogAlert('????????????', 0, 0, function() {
						if (mode == 'list')
							movePage($('#page').val());
						else
							addCategoryMatching($('#fmCategoryCode').val());

					} );
				} else {
					openDialogAlert('????????????')
				}

			}
		});

	}, function(){}, btnOpt);
}

function movePage(page){
	if(typeof page == "undefined") page = 1;
	$("#marketSerachFrom input[name='page']").val(page);
	$("#marketSerachFrom").submit();
}

function setCategoryDesc(response) {

	switch ($('#selMatchingMarket').val()) {
		case	'storefarm' :
			storefarmCategorySet(response);
			break;
	}

}


function storefarmCategorySet(response) {

	$('#StorefarmCertification > option').remove();

	if (response.success == 'Y' && typeof response.resultData.CertificationCategoryList == 'object') {
		var CertificationCategoryList	= response.resultData.CertificationCategoryList;
		$('#StorefarmCertification').append("<option value=''>?????? ??????????????? ??????????????? ???????????????</option>");
		$('#StorefarmCertification').append("<option value='USE_ADDINFO'>?????? ??????????????? ???????????? ??????</option>");

		for (cnt = CertificationCategoryList.length, i = 0; i < cnt; i++) {
			nowCertInfo	= CertificationCategoryList[i];
			$('#StorefarmCertification').append("<option value='" + nowCertInfo.Code + "'>" + nowCertInfo.Name + "</option>");
		}
	}

}