<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
if( !$_SESSION['client_id'] ) header('Location: /obituaries/login.php');
$obituary = new Obituary($mysqli);
$page = 'obituaries';
$meta_subtitle = ' | Create a Remembrance'; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div id="create_listing" class="container">
	<div class="double-stripe"><span class="listing_header">Create a Remembrance</span></div>
    <?
	if( $_REQUEST['error'] ) {
		?><div class="message"><?=$obituary->get_error( $_REQUEST['error'] )?></div><?
	}
	?>
    <form action="/admin/index.php" enctype="multipart/form-data" id="create_obit" method="post">
    	<input type="hidden" name="process" value="obituary">
        <input type="hidden" name="proc_type" value="create">
        <input type="hidden" name="client" value="<?=$_SESSION['client_id']?>">
        <div class="form_left">
            <div class="folder pull-left"><div class="folder_img hidden"><div class="clear_img button pull-right">X</div><img id="file_profile_preview"></div></div>
            <div class="folder_detail pull-left">
                <div class="title">Main Picture</div>
                <p>Upload the primary picture for the remembrance.<br><span class="comment">(max size 1MB)</span></p>
                <input type="file" name="profile" id="file_profile" class="folder_file btn">
            </div>
            <div class="clearfix"></div>
            <div class="folder mtop pull-left"><div class="folder_img hidden"><div class="clear_img button pull-right">X</div><img id="file_photo1_preview"></div></div>
            <div class="folder_detail mtop pull-left">
                <div class="title">Supporting Picture 1</div>
                <p>Upload a supporting picture for the remembrance.<br><span class="comment">(max size 1MB)</span></p>
                <input type="file" name="photo1" id="file_photo1" class="folder_file btn">
            </div>
            <div class="clearfix"></div>
            <div class="folder mtop pull-left"><div class="folder_img hidden"><div class="clear_img button pull-right">X</div><img id="file_photo2_preview"></div></div>
            <div class="folder_detail mtop pull-left">
                <div class="title">Supporting Picture 2</div>
                <p>Upload a supporting picture for the remembrance.<br><span class="comment">(max size 1MB)</span></p>
                <input type="file" name="photo2" id="file_photo2" class="folder_file btn">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form_right">
            <input type="text" name="familyname" id="familyname" class="pull-right" required><label class="pull-right">Family Name</label>
            <div class="clearfix"></div>
            <input type="text" name="petname" id="petname" class="pull-right mtop" required><label class="pull-right mtop">Pet's Name</label>
            <div class="clearfix"></div>
            <input type="text" class="datepicker pull-right mtop" name="passed" readonly required><label class="pull-right mtop">Passed</label>
            <div class="clearfix"></div>
            <textarea name="bio" id="bio" maxlength="1500" class="pull-right mtop"></textarea><label class="pull-right mtop">Remembrance</label>
            <div class="comment pull-right">character count<br>(<span id="textarea_count">0</span> of 1500)</div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="button_row">
            
            <input type="submit" name="submit" id="submit" value="SUBMIT FOR APPROVAL" class="btn btn-primary pull-right">
            <input type="button" id="cancel" class="btn button pull-right link_listings mright" value="CANCEL">
            <div class="clearfix"></div>
        </div>
    </form>
</div>
<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>