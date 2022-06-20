<?
    /* ============================================================================== */
    /* =   PAGE : 결제 정보 환경 설정 PAGE                                          = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2015.02   LGCNS Inc.   All Rights Reserved.               = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   데이터 셋업	# 프론트에서 https:// 필 기재                               = */
    /* = -------------------------------------------------------------------------- = */
    /* = 테스트시 :																	= */
    /* =	CNSPAY_WEB_SERVER_URL	=> kmpaytest.lgcns.com:8543						= */
	/* =	targetUrl				=> kmpaytest.lgcns.com:8543						= */
	/* =	msgName					=> /merchant/requestDealApprove.dev				= */
	/* =	CnsPayDealRequestUrl	=> test.cnspay.co.kr:8443						= */
    /* = -------------------------------------------------------------------------- = */
	/* = 실결제시 :																	= */
    /* =	CNSPAY_WEB_SERVER_URL	=> kmpay.lgcns.com:8443							= */
	/* =	targetUrl				=> kmpay.lgcns.com:8443							= */
	/* =	msgName					=> /merchant/requestDealApprove.dev				= */
	/* =	CnsPayDealRequestUrl	=> pg.cnspay.co.kr:443							= */
    /* = -------------------------------------------------------------------------- = */

	//인증,결제 및 웹 경로
	$CNSPAY_WEB_SERVER_URL		= "kmpay.lgcns.com:8443";
	$targetUrl					= "kmpay.lgcns.com:8443";
	$msgName					= "/merchant/requestDealApprove.dev";
	$CnsPayDealRequestUrl		= "pg.cnspay.co.kr:443";

	//TXN_ID 호출전용 키값
	$MID						= "cnstest22m"; // cnstest22m  /  cnstest01m
	$merchantEncKey				= "52b017585c98067b";
	$merchantHashKey			= "12e913690a5eaad5";
	$cancelPwd					= "123456";

	//버전
	$phpVersion					= "PLP-0.1.1.3";

	//가맹점서명키 (꼭 해당 가맹점키로 바꿔주세요)
	$merchantKey = "33F49GnCMS1mFYlGXisbUDzVf2ATWCl9k3R++d5hDd3Frmuos/XLx8XhXpe+LDYAbpGKZYSwtlyyLOtS/8aD7A==";

	//로그 경로
	$LogDir = "pg/kakaopay/log";



	/* ============================================================================== */
    /* =   인증 참조 코드				                                            = */
    /* = -------------------------------------------------------------------------- = */
	//	00		성공																= */
	//	801		입력받은 merchantID가 MerchantProperty.xml 파일에 없습니다.			= */
	//	802		MerchantProperty.xml 파일을 찾을수 없습니다.						= */
	//	804		결제요청타입은 필수입력사항 입니다.									= */
	//	805		잘못된 결제요청타입 입니다.											= */
	//	806		가맹점 ID는 필수입력사항 입니다.									= */
	//	807		가맹점 ID는 숫자형입니다.											= */
	//	808		가맹점 ID의 제한 길이가 초과 되었습니다.							= */
	//	809		상품명은 필수입력사항 입니다.										= */
	//	810		상품명은 영문 200자 이내입니다.										= */
	//	811		상품금액은 필수입력사항 입니다.										= */
	//	812		상품금액은 숫자형입니다.											= */
	//	813		거래통화는 필수입력사항 입니다.										= */
	//	814		카드 가맹점 번호는 숫자형입니다.									= */
	//	815		공급가액은 숫자형입니다.											= */
	//	816		부가세는 숫자형입니다.												= */
	//	817		봉사료는 숫자형입니다.												= */
	//	818		결제취소시간(분)은 숫자형입니다.									= */
	//	819		최대할부개월이 잘못되었습니다.										= */
	//	820		고정할부개월이 잘못되었습니다.										= */
	//	821		결제요청 ID는 필수입력사항 입니다.									= */
	//	822		결제요청 ID가 너무 깁니다.											= */
	//	823		가맹점 거래번호는 필수입력사항 입니다.								= */
	//	824		가맹점 거래번호의 제한 길이가 초과 되었습니다.						= */
	//	825		취소금액은 숫자형입니다.											= */
	//	826		부분취소구분코드가 틀렸습니다.										= */
	//	827		공급가액은 숫자형입니다.											= */
	//	828		부가세는 숫자형입니다.												= */
	//	829		봉사료는 숫자형입니다.												= */
	//* = ------------------------------------------------------------------------- = */
	
	/* ============================================================================== */
    /* =   라이브러리 에러코드			                                            = */
    /* = -------------------------------------------------------------------------- = */
	//	S999	기타오류가 발생하였습니다.											= */
	//	S001	요청템플릿이 존재하지 않습니다.										= */
	//	S002	응답템플릿이 존재하지 않습니다.										= */
	//	T001	수신메시지 인코딩 중 예외가 발생하였습니다.							= */
	//	T002	비정상적인 수신 전문입니다.											= */
	//	T003	수신데이터 파싱 중 예외가 발생하였습니다.							= */
	//	T004	요청 전문의 헤더부 생성 중 오류가 발생하였습니다.					= */
	//	T005	요청 전문의 바디부 생성 중 오류가 발생하였습니다.					= */
	//	X001	서버 도메인명이 잘못 설정되었습니다.								= */
	//	X002	서버로 소켓 연결 중 오류가 발생하였습니다.							= */
	//	X003	전문 수신 중 오류가 발생하였습니다.									= */
	//	X004	전문 송신 중 오류가 발생하였습니다.									= */
	//	V005	지원하지 않는 지불수단입니다.										= */
	//	V101	암호화 플래그 미설정 오류입니다.									= */
	//	V102	서비스모드를 설정하지 않았습니다.									= */
	//	V103	지불수단을 설정하지 않았습니다.										= */
	//	V104	상품개수 미설정 오류입니다.											= */
	//	V201	가맹점ID 미설정 오류입니다.											= */
	//	V202	LicenseKey 미설정 오류입니다.										= */
	//	V203	통화구분 미설정 오류입니다.											= */
	//	V204	MID 미설정 오류입니다.												= */
	//	V205	MallIP 미설정 오류입니다.											= */
	//	V301	구매자이름 미설정 오류입니다.										= */
	//	V302	구매자인증번호 미설정 오류입니다.									= */
	//	V303	구매자연락처 미설정 오류입니다.										= */
	//	V304	구매자메일주소 미설정 오류입니다.									= */
	//	V401	상품명 미설정 오류입니다.											= */
	//	V402	상품금액 미설정 오류입니다.											= */
	//	V501	카드형태 미설정 오류입니다.											= */
	//	V502	카드구분 미설정 오류입니다.											= */
	//	V503	카드코드 미설정 오류입니다.											= */
	//	V504	카드번호 미설정 오류입니다.											= */
	//	V505	카드무이자여부 미설정 오류입니다.									= */
	//	V506	카드인증구분 미설정 오류입니다.										= */
	//	V507	카드형태 설정 오류입니다.											= */
	//	V508	카드형태 허용하지 않는 값을 설정하였습니다.							= */
	//	V509	카드구분 허용하지 않는 값을 설정하였습니다.							= */
	//	V510	유효기간 미설정 오류입니다.											= */
	//	V511	유효기간 허용하지 않는 값을 설정하였습니다.							= */
	//	V512	유효기간의 월 형태가 잘못 설정되었습니다.							= */
	//	V513	카드 비밀번호 미입력 오류입니다.									= */
	//	V602	금융결제원 암호화 데이터 미설정 오류입니다.							= */
	//	VA01	거래KEY 미설정 오류입니다.											= */
	//	VA02	이통사구분 미설정 오류입니다.										= */
	//	VA03	SMS승인번호 미설정 오류입니다.										= */
	//	VA04	업체TID 미설정 오류입니다.											= */
	//	VA05	휴대폰번호 미설정 오류입니다.										= */
	//	VA09	고객고유번호(주민번호,사업자번호) 미설정 오류입니다.				= */
	//	VA10	ENCODE 업체TID 미설정 오류입니다.									= */
	//	VB02	이통사구분 미설정 오류입니다.										= */
	//	VB05	휴대폰번호 미설정 오류입니다.										= */
	//	VB09	고객고유번호(주민번호,사업자번호) 미설정 오류입니다.				= */
	//	VB10	고객 IP 미설정 오류입니다.											= */
	//	V801	취소금액 미설정 오류입니다.											= */
	//	V802	취소사유 미설정 오류입니다.											= */
	//	V803	취소패스워드 미설정 오류입니다.										= */
	//* = ------------------------------------------------------------------------- = */

	$_kakao_result_code['3001']	= '카드 결제 성공';
	$_kakao_result_code['3011']	= '카드번호 오류';
	$_kakao_result_code['3012']	= '카드가맹점 정보 미확인';
	$_kakao_result_code['3013']	= '카드 가맹점 개시 안됨';
	$_kakao_result_code['3014']	= '카드가맹점 정보 오류';
	$_kakao_result_code['3021']	= '유효기간 오류';
	$_kakao_result_code['3022']	= '할부개월오류';
	$_kakao_result_code['3023']	= '할부개월 한도 초과';
	$_kakao_result_code['3031']	= '무이자할부 카드 아님';
	$_kakao_result_code['3032']	= '무이자할부 불가 개월수';
	$_kakao_result_code['3033']	= '무이자할부 가맹점 아님';
	$_kakao_result_code['3034']	= '무이자할부 구분 미설정';
	$_kakao_result_code['3041']	= '금액 오류(1000원 미만 신용카드 승인 불가)';
	$_kakao_result_code['3051']	= '해외카드 미등록 가맹점';
	$_kakao_result_code['3052']	= '통화코드 오류';
	$_kakao_result_code['3053']	= '확인 불가 해외카드';
	$_kakao_result_code['3054']	= '환률전환오류';
	$_kakao_result_code['3055']	= '인증시 달러승인 불가';
	$_kakao_result_code['3056']	= '국내카드 달러승인불가';
	$_kakao_result_code['3057']	= '인증 불가카드';
	$_kakao_result_code['3061']	= '국민카드 인터넷안전결제 적용 가맹점';
	$_kakao_result_code['3062']	= '신용카드 승인번호 오류';
	$_kakao_result_code['3071']	= '매입요청 가맹점 아님';
	$_kakao_result_code['3072']	= '매입요청 TID 정보 불일치';
	$_kakao_result_code['3073']	= '기매입 거래';
	$_kakao_result_code['3081']	= '카드 잔액 값 오류';
	$_kakao_result_code['3091']	= '제휴카드 사용불가 가맹점';
	$_kakao_result_code['3095']	= '카드사 실패';
?>