<!-- �ش� �������� ����ڰ� ISP{����/BC) ī�� ������ �����Ͽ��� ��, ����ڿ��� �������� �������Դϴ�.-->
<?php

    $LGD_OID                 = $HTTP_GET_VARS["LGD_OID"];

	echo "LGD_OID = ".$LGD_OID;
	
	// ���������ÿ���, �����翡�� ������ �ֹ���ȣ (LGD_OID)�� �ش��������� �����մϴ�.  
	// LGD_KVPMISPNOTEURL ���� ������  �����������  �����Ͽ�  ����ڿ��� ������  �����Ϸ�ȭ���� �����Ͻñ� �ٶ��,
	// ��������� LGD_KVPMISPNOTEURL �� ���� ���۵ǹǷ� �ش���� DB������  ����� �̿��Ͽ� �����ϷῩ�θ� ���̵��� �մϴ�.    
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	// ����, �����翡�� 'App To App' ������� ����, BCī��翡�� ���� ���� ������ �ް� �������� ���� �����ϰ��� �Ҷ� 
	// ������ ���� initilize function�� ����޴� Custom URL�� ȣ���ϸ� �˴ϴ�.
	// ex) window.location.href = smartxpay://TID=1234567890&OID=0987654321 
	//
	// window.location.href = "������ �۸�://" �� ȣ���Ͻø� �˴ϴ�. 
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	

?>