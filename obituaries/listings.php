<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
if( !$_SESSION['client_id'] ) header('Location: /obituaries/');
$obituary = new Obituary($mysqli);
$listings = $obituary->get_listings($_SESSION['client_id']);
$page = 'obituaries';
$meta_subtitle = ' | My Obituary Listings'; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div class="obit-mine container">
	<div class="double-stripe marginbtm30"><span class="listing_header">Your Remembrances</span></div>
    <?
	if( $obituary->error ) {
		?><div class="message"><?=$obituary->get_error()?></div><?
	}
	if( $listings ) {
		foreach( $listings as $key => $data ) {
			?>
			<div class="listing_box pull-left">
                <div class="folder small pull-left"><div class="folder_img"><? if( $data['profile'] ) { ?><img class="resize" src="/img/obits/<?=$key?>/profile.<?=$data['profile']?>"><? } ?></div></div>
                <div class="folder_detail pull-left">
                    <div class="title"><?=$data['petName']?></div>
                    <div class="links">
                    	<?
						if( $data['approvedOn'] ) {
							?><a class="link_view" data-id="<?=$key?>">View Listing</a><?
						}
						?>
                        <br>
                        <a class="link_edit" data-id="<?=$key?>">Edit Listing</a><br>
                        <a class="popup_trigger form-delete" id="form-delete" data-id="<?=$key?>">Delete Listing</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="strong_<? echo $data['approvedOn'] ? 'green' : 'orange'; ?>"><? echo $data['approvedOn'] ? 'Approved' : 'Pending Approval'; ?></div>
            </div>
			<?
		}
	}
	?>
    <div class="clearfix"></div>
    <div class="text-center" style="margin-top: 0px;"><div class="btn btn-primary obit-btn-lrg button link_create">CREATE A REMEMBRANCE</div></div>
</div></div>
<div id="popup_form-delete" class="popup" style="display: none;">
	<div class="popup_close btn btn-primary button pull-right">X</div><div class="clearfix"></div>
    <div>This will permanently delete your listing. Are you sure you want to delete?</div>
    <div class="js_delete button btn btn-primary pull-right">DELETE</div>
    <div class="clearfix"></div>
</div>
<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>