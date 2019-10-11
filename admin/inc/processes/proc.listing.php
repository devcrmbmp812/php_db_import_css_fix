<?
switch( $_REQUEST['type'] ) {
	case 'archive':
		$listing = new Obituary( $mysqli, $_REQUEST['id'] );
		$_REQUEST['id'] = $listing->archive_listing();
		break;
	case 'delete':
		$listing = new Obituary( $mysqli, $_REQUEST['id'] );
		$success = $listing->delete_listing();
		if( $success ) {
			$_SESSION['page'] = 'default';
			$_REQUEST['view'] = 'Active';
		}
		break;
	case 'unarchive':
		$listing = new Obituary( $mysqli, $_REQUEST['id'] );
		$_REQUEST['id'] = $listing->unarchive_listing();
		break;
}
if( $_REQUEST['id'] ) {
	$_SESSION['page'] = 'default';
	$_REQUEST['view'] = 'Active';
}
?>