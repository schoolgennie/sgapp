<?

$login_session->logout_user();
$login_session->pass_msg[]=MSG_LOGOUT_SUCCESS;
$login_session->set_pass_msg();
$login_session->set_success();
Redirect(make_url('login-signin'));
?>
