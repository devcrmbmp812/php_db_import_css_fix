<?
$obituary = new Obituary($mysqli);
$obituary->get_obituary($_REQUEST['id']);
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div id="create_listing" class="container">
    <div class="double-stripe"><span class="listing_header">Edit/Approve a Remembrance</span></div>
    <?
	if( $_REQUEST['error'] ) {
		?><div class="message"><?=$obituary->get_error( $_REQUEST['error'] )?></div><?
	}
	?>
    <form action="/admin/index.php" enctype="multipart/form-data" id="create_obit" method="post">
    	<input type="hidden" name="process" value="obituary">
        <input type="hidden" name="proc_type" value="fullupdate">
        <input type="hidden" name="id" value="<?=$obituary->obituary['ID']?>">
        <div class="form_left">
            <div class="folder pull-left"><div class="folder_img<? if( !$obituary->obituary['profile'] ) echo ' hidden'; ?>"><div class="clear_img button pull-right">X</div><img id="file_profile_preview"<? if( $obituary->obituary['profile'] ) { ?> class="resize" src="/img/obits/<?=$obituary->obituary['ID']?>/profile.<?=$obituary->obituary['profile']?>"<? } ?>></div></div>
            <div class="folder_detail pull-left">
                <div class="title">Main Picture</div>
                <p>Upload the primary picture for the remembrance.<br><span class="comment">(max size 1MB)</span></p>
                <input type="file" name="profile" id="file_profile" class="folder_file btn">
            </div>
            <div class="clearfix"></div>
            <div class="folder mtop pull-left"><div class="folder_img<? if( !$obituary->obituary['photo1'] ) echo ' hidden'; ?>"><div class="clear_img button pull-right">X</div><img id="file_photo1_preview"<? if( $obituary->obituary['photo1'] ) { ?> class="resize" src="/img/obits/<?=$obituary->obituary['ID']?>/1.<?=$obituary->obituary['photo1']?>"<? } ?>></div></div>
            <div class="folder_detail mtop pull-left">
                <div class="title">Supporting Picture 1</div>
                <p>Upload a supporting picture for the remembrance.<br><span class="comment">(max size 1MB)</span></p>
                <input type="file" name="photo1" id="file_photo1" class="folder_file btn">
            </div>
            <div class="clearfix"></div>
            <div class="folder mtop pull-left"><div class="folder_img<? if( !$obituary->obituary['photo2'] ) echo ' hidden'; ?>"><div class="clear_img button pull-right">X</div><img id="file_photo2_preview"<? if( $obituary->obituary['photo2'] ) { ?> class="resize" src="/img/obits/<?=$obituary->obituary['ID']?>/2.<?=$obituary->obituary['photo2']?>"<? } ?>></div></div>
            <div class="folder_detail mtop pull-left">
                <div class="title">Supporting Picture 2</div>
                <p>Upload a supporting picture for the remembrance.<br><span class="comment">(max size 1MB)</span></p>
                <input type="file" name="photo2" id="file_photo2" class="folder_file btn">
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form_right">
            <input type="text" name="familyname" id="familyname" class="pull-right" value="<?=$obituary->obituary['familyName']?>" required><label class="pull-right">Family Name</label>
            <div class="clearfix"></div>
            <input type="text" name="petname" id="petname" class="pull-right mtop" value="<?=$obituary->obituary['petName']?>" required><label class="pull-right mtop">Pet's Name</label>
            <div class="clearfix"></div>
            <input type="text" class="datepicker pull-right mtop" name="passed" value="<?=date( "l, F j, Y", strtotime( $obituary->obituary['passed'] ) )?>" readonly required><label class="pull-right mtop">Passed</label>
            <div class="clearfix"></div>
            <textarea name="bio" id="bio" maxlength="1500" class="pull-right mtop"><?=$obituary->obituary['bio']?></textarea><label class="pull-right mtop">Remembrance</label>
            <div class="comment pull-right">character count<br>(<span id="textarea_count">0</span> of 1500)</div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="button_row">
        	<?
			if( $obituary->obituary['approvedOn'] ) {
				?>
				<input type="submit" id="submit" class="btn btn-primary obit-btn-lrg button pull-right mleft" name="submit" value="SAVE UPDATES">
				<?
			} else {
				?>
				<input type="submit" id="submit" class="btn btn-primary obit-btn-lrg button pull-right mleft" name="submit" value="SAVE AS APPROVED">
				<input type="submit" id="unapprove" class="btn btn-primary obit-btn-lrg button pull-right mleft" name="submit" value="SAVE AS UNAPPROVED">
				<?
			}
			?>
			<input type="button" id="cancel" class="btn button pull-right link_active" value="CANCEL">
			<div class="clearfix"></div>
        </div>
    </form>
</div>