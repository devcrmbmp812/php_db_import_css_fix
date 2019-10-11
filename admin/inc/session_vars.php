<?
if( !$_SESSION['usr_id'] ) {
	$_SESSION['page'] = 'login';
} elseif( !$_SESSION['lv_edit'] && $_SESSION['site'] == 'admin' ) {
	$_SESSION['page'] = 'login';
} elseif( $_REQUEST['page'] ) {
	$_SESSION['page'] = $_REQUEST['page'];
} elseif( !$_SESSION['page'] || ( $_SESSION['page'] == 'listing' && !$_REQUEST['id'] ) || ( $_SESSION['usr_id'] && $_SESSION['page'] == 'login' ) ) {
	$_SESSION['page'] = 'default';
}
$_SESSION['debug']['GET'] = var_export( $_GET, TRUE );
$_SESSION['debug']['POST'] = var_export( $_POST, TRUE );
$_SESSION['debug']['SESSION'] = var_export( array_diff_key( $_SESSION, array( 'debug' => '' ) ), TRUE );
?>