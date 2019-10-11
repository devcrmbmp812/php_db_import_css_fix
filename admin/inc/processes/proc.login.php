<?
$login = new Login( $mysqli );
switch( $_POST['submit'] ) {
	case 'REQUEST PASSWORD':
		$_REQUEST['view'] = ( $login->recover_password() ) ? 'login': 'recover';
		break;
	default:
		if ( $login->validate_password() ) {
			if ( $login->login_user() ) {
				header('Location: /admin/');
			}
		}
}
$_SESSION['page'] = 'login';
?>