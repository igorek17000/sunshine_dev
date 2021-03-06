<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = "이메일 검증은 반드시 배열로 전달 해야 합니다.";
$lang['email_invalid_address'] = "이메일 형식이 틀립니다: %s";
$lang['email_attachment_missing'] = "다음 메일의 첨부파일을 찾을 수 없습니다: %s";
$lang['email_attachment_unreadable'] = "다음의 첨부파일을 열수 없습니다: %s";
$lang['email_no_from'] = '보내는주소가 없어 메일을 발송하실수 없습니다.';
$lang['email_no_recipients'] = "대상 (To, Cc, Bcc)가 지정되어 있지 않습니다.";
$lang['email_send_failure_phpmail'] = "PHP mail()를 사용하여 메일을 보낼 수 없습니다. 귀하의 서버는 PHP mail()로 메일을 보낼 수 있도록 설정되지 않을 수 있습니다.";
$lang['email_send_failure_sendmail'] = "PHP Sendmail로 메일을 보낼 수 없습니다. 귀하의 서버는 PHP Sendmail 메일을 보낼 수 있도록 설정되지 않을 수 있습니다.";
$lang['email_send_failure_smtp'] = "PHP SMTP를 통해 메일을 보낼 수 없습니다. 귀하의 서버는 PHP SMTP 메일을 보낼 수 있도록 설정되지 않을 수 있습니다.";
$lang['email_sent'] = "메시지는 다음 프로토콜을 사용하여 성공적으로 전송 되었습니다: %s";
$lang['email_no_socket'] = "Sendmail 소켓을 열 수 없습니다. 설정파일을 확인 하시기 바랍니다.";
$lang['email_no_hostname'] = "SMTP 호스트 이름이 지정되어 있지 않습니다.";
$lang['email_smtp_error'] = "다음 SMTP 오류가 발생했습니다: %s";
$lang['email_no_smtp_unpw'] = "오류 : SMTP 사용자 이름과 암호를 지정 해야합니다.";
$lang['email_failed_smtp_login'] = "AUTH LOGIN 명령을 보내는데 실패했습니다. 오류: %s";
$lang['email_smtp_auth_un'] = "아이디 인증이 실패했습니다. 오류: %s";
$lang['email_smtp_auth_pw'] = "암호 인증에 실패했습니다. 오류: %s";
$lang['email_smtp_data_failure'] = "데이터를 보낼 수 없습니다: %s";
$lang['email_exit_status'] = "완료상태 코드: %s";


/* End of file email_lang.php */
/* Location: ./system/language/korean/email_lang.php */
