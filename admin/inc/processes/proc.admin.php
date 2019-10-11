<?
$admin = new Admin( $mysqli );
switch( $_REQUEST['proc_type'] ) {
	case 'admin_delete':
		$admin->delete_admin();
		break;
	case 'change_pwd':
		if( $admin->change_password() ) {
			header('Location: admin/logoff.php');
		}
		break;
	case 'create_admin':
		$admin->create_admin();
		break;
	case 'create_director':
		$admin->create_director();
		break;
	case 'create_staff':
		$admin->create_staff();
		break;
	case 'director_delete':
		$admin->delete_director();
		break;
	case 'edit_admin':
		$admin->edit_admin();
		break;
	case 'edit_director':
		$admin->edit_director();
		break;
	case 'edit_staff':
		$admin->edit_staff();
		break;
	case 'staff_delete':
		$admin->delete_staff();
		break;
	default:
		
}
$_SESSION['page'] = 'admin';
?>