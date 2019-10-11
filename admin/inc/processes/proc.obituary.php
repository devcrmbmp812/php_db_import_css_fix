<?
$bypass = true;
$obituary = new Obituary( $mysqli );
switch( $_POST['proc_type'] ) {
	case 'create':
		if ( $obituary->create() ) {
			header('Location: /obituaries/listings.php');
		} else {
			if( $obituary->id ) {
				header('Location: /obituaries/edit.php?id='.$obituary->id.'&error='.$obituary->error);
			} else {
				header('Location: /obituaries/create.php?error='.$obituary->error);
			}
		}
		break;
	case 'fullupdate':
		if ( $obituary->fullupdate() ) {
			header('Location: /admin/index.php?page=default');
		} else {
			header('Location: /admin/index.php?page=listing&view=edit&id='.$obituary->id.'&error='.$obituary->error);
		}
		break;
	case 'update':
		if ( $obituary->update() ) {
			header('Location: /obituaries/listings.php');
		} else {
			header('Location: /obituaries/edit.php?id='.$_POST['id'].'&error='.$obituary->error);
		}
		break;
	case 'view':
		$obituary->get_obituary( $_POST['id'] );
		include $_SERVER['DOCUMENT_ROOT'] . '/obituaries/modules/listing.php';
		break;
}
?>