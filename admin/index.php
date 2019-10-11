<?php
include 'inc/app_top.php';

if( $_REQUEST['process'] ) {
	switch( $_REQUEST['process'] ) {
		default:
			require $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/processes/proc.' . strtolower( $_REQUEST['process'] ) . '.php';
	}
}

if( !$bypass ) {
	$_REQUEST['process'] = FALSE;
	
	$meta_subtitle = ' | ADMIN PANEL'; 
	include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
	include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
	
	if( !@include $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/pages/' . $_SESSION['page'] . '.php' ) include $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/modules/construction.php';
	
	/* DEBUG section 
	if( $_SESSION['debug'] || ( $platform->environment == 'development' || $_SESSION['usr_name'] == 'Chris Larkin' ) ) {
		?><div id="debug"><?
		foreach( $_SESSION['debug'] as $key => $var ) {
			echo '[',$key,']<br />',$var,'<br />';
		}
		?></div><?
	}*/
	
	include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
	include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
}
?>