<?php /* Template_ 2.2.6 2022/03/07 12:32:25 /www/suns_firstmall_kr/admin/skin/default/tooltip/shipping_group.html 000007514 */ ?>
<div id="tip1" class="tip_wrap">
	<h1>묶음계산-묶음배송</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>본 배송그룹이 적용된 해당 상품(추가구성상품 포함)들의 배송비를 묶어서 계산합니다.</li>	
		</ul>

		<ul class="bullet_circle mt10"">
			<li>배송비 계산 방법</li>	
		</ul>

		<table class="table_row_basic v4">
			<col width="15%" /><col width="42%" /><col width="43%" />
			<thead>
				<tr>
					<th>주문상품</th>
					<th>배송비 계산</th>
					<th>설명</th>
				</tr>
			</thead>
			<tr>
				<td class="center">상품①</td>
				<td rowspan="3">
					배송비 = 기본배송비 부과조건(상품①+상품②+상품③) + 추가배송비 부과조건(상품①+상품②+상품③)
				</td>
				<td rowspan="3">
					판매자 입장에서 해당 상품이 함께 주문되면
					1개의 운송장번호로 함께 합포장 배송이 가능한 상품으로
					소비자에게 부과하는 배송비를 통합 계산합니다.<br/>
					<span class="desc">※ 상품 출고 시 필요한 경우 (수량/상품별)부분출고와 (다른주문과의)합포장출고 기능을 지원합니다.</span>
				</td>
			</tr>
			<tr>
				<td class="center">상품②</td>
			</tr>
			<tr>
				<td class="center">상품③</td>
			</tr>
		</table>
	</div>
</div>

<div id="tip2" class="tip_wrap">
	<h1>개별계산-개별배송</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>본 배송그룹이 적용된 해당 상품(추가구성상품 포함)들의 배송비를 각각 계산합니다.</li>	
		</ul>

		<ul class="bullet_circle mt10"">
			<li>배송비 계산 방법</li>	
		</ul>

		<table class="table_row_basic v4">
			<col width="15%" /><col width="42%" /><col width="43%" />
			<thead>
				<tr>
					<th>주문상품</th>
					<th>배송비 계산</th>
					<th>설명</th>
				</tr>
			</thead>
			<tr>
				<td class="center">상품④</td>
				<td>
					배송비 = 기본배송비 부과조건(상품④) + 추가배송비 부과조건(상품④)
				</td>
				<td rowspan="3">
					판매자 입장에서 해당 상품이 함께 주문되면
					여러 개의 운송장번호로 각각 개별 배송되어야 하는 상품으로
					소비자에게 부과하는 배송비를 개별 계산합니다.<br/>
					<span class="desc">※ 상품 출고 시 필요한 경우 (수량/상품별)부분출고와 (다른주문과의)합포장출고 기능을 지원합니다.</span>
				</td>
			</tr>
			<tr>
				<td class="center">상품⑤</td>
				<td>
					배송비 = 기본배송비 부과조건(상품⑤) + 추가배송비 부과조건(상품⑤)
				</td>
			</tr>
			<tr>
				<td class="center">상품⑥</td>
				<td>
					배송비 = 기본배송비 부과조건(상품⑥) + 추가배송비 부과조건(상품⑥)
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="tip3" class="tip_wrap">
	<h1>무료계산-묶음배송</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>본 배송그룹이 적용된 해당 상품(추가구성상품 포함)들의 기본 배송비는 무료. 단, 추가 배송비(도서산간, 희망배송일) 는 설정에 따라 부과 가능합니다.</li>	
		</ul>

		<ul class="bullet_circle mt10"">
			<li>배송비 계산 방법</li>	
		</ul>

		<table class="table_row_basic v4">
			<col width="15%" /><col width="42%" /><col width="43%" />
			<thead>
				<tr>
					<th>주문상품</th>
					<th>배송비 계산</th>
					<th>설명</th>
				</tr>
			</thead>
			<tr>
				<td class="center">상품⑦</td>
				<td rowspan="3">
					배송비 = 기본배송비 무료(상품⑦+상품⑧+상품⑨) + 추가배송비 부과조건(상품⑦+상품⑧+상품⑨)
				</td>
				<td rowspan="3">
					판매자 입장에서 해당 상품이 주문되면 조건 없이 무료 배송합니다.<br/>
					<span class="desc">※ 상품 출고 시 필요한 경우 (수량/상품별)부분출고와 (다른주문과의)합포장출고 기능을 지원합니다.</span><br/>				
					<span class="desc">※ 본 배송그룹은 [묶음계산-묶음배송]과 [개별계산-개별배송]의 배송비를 무료화할 수도 있습니다.</span>
				</td>
			</tr>
			<tr>
				<td class="center">상품⑧</td>
			</tr>
			<tr>
				<td class="center">상품⑨</td>
			</tr>
		</table>
	</div>
</div>

<div id="tip4" class="tip_wrap">
	<h1>반송지</h1>	

	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>구매자가 상품을 반품 하는 경우 설정된 반송지가 안내되어집니다.</li>	
			<li>등록된 반송지 주소는 MY 페이지 반품/교환 신청 시 자가 반품 반송 주소로 사용합니다.</li>	
			<li>택배 자동화 연동 출고처리 시 굿스플로, 롯데택배에서 반송지를 사용합니다.</li>	
		</ul>
	</div>
</div>

<div id="tip5" class="tip_wrap">
	<h1>연결된 상품</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>배송그룹에 연결되어 있는 상품을 보여줍니다. 상품 연결은 일반 상품 조회, 패키지 상품 조회 또는 일괄 업데이트에서 가능합니다.</li>		
		</ul>
	</div>
</div>

<div id="tip6" class="tip_wrap">
	<h1>배송비 안내</h1>	

	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>상품이 속한 배송그룹에서 기본배송방법의 기본 배송비 기준입니다.</li>		
		</ul>
	</div>
</div>

<div id="tip7" class="tip_wrap">
	<h1>해외배송 가능여부 안내</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>상품이 속한 배송 그룹의 해외배송가능 여부입니다.</li>		
		</ul>
	</div>
</div>

<div id="tip8" class="tip_wrap">
	<h1>배송비 안내</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>배송비>0 일 때 배송비 과금 시점입니다.</li>		
		</ul>
	</div>
</div>

<div id="tip9" class="tip_wrap">
	<h1>상품별 배송비</h1>
	
	<div class="con_wrap">
		<ul class="bullet_hyphen">
			<li>다양한 상품 리스트 화면에서 각 상품별 배송비를 소비자에게 노출 할 수 있습니다. 상품 디스플레이 기능에서 배송비 노출 설정 시, 해당 상품의 배송비가 자동으로 노출 됩니다.</li>		
		</ul>

		<img class="mt10" width="100%" src="/admin/skin/default/images/common/img_shipping.png">
	</div>
</div>


<div id="tip10" class="tip_wrap">
	<h1>금액/수량/무게 기준</h1>
	
	<div class="con_wrap">
		<table class="table_row_basic v4">
			<colgroup><col width="15%"><col width="13%"><col width="13%"><col></colgroup>
			<thead>
				<tr>
					<th>기준</th>
					<th>기본 상품</th>
					<th>추가 상품</th>
					<th>비고</th>
				</tr>
			</thead>
			<tbody>			
				<tr>
					<th>기준 금액</th>
					<td>○</td>
					<td>○</td>
					<td>금액=판매가–할인(이벤트,복수구매,모바일,회원등급,쿠폰,코드)</td>
				</tr>
				<tr>
					<th>기준 수량</th>
					<td >○</td>
					<td class="red bold">X</td>
					<td></td>
				</tr>
				<tr>
					<th>기준 무게</th>
					<td>○</td>
					<td>○</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>