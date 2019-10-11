<?
$bypass = true;
$client = new Client( $mysqli );
switch( $_POST['submit'] ) {
	case 'REGISTER':
		if( $client->register() ) {
			header('Location: /obituaries/listings.php');
		} else {
			header('Location: /obituaries/login.php?error='.$client->error);
		}
		break;
	case 'RESET PASSWORD':
		if( $alert = $client->reset_pwd() ) {
			header('Location: /obituaries/index.php?error='.$client->error);
		} else {
			header('Location: /obituaries/recovery.php?error='.$client->error);
		}
		break;
	case 'UPDATE PASSWORD':
		if( $client->change_pwd() ) {
			header('Location: /obituaries/listings.php');
		} else {
			header('Location: /obituaries/change_pwd.php?error='.$client->error);
		}
		break;
	case 'SIGN IN':
	default:
		if( $client->login() ) {
			header('Location: /obituaries/listings.php');
		} else {
			if( $client->error == 7 ) {
				header('Location: /obituaries/change_pwd.php?error='.$client->error);
			} else {
				header('Location: /obituaries/index.php?error='.$client->error);
			}
		}
}
?>