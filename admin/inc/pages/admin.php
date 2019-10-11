<div class="obits_body">
<div class="navbar-filler"></div>
<div class="container">
<?
if( $_SESSION['lv_admin'] ) {
	?>
    <div class="admin_panel open_sans">
    <div class="section_head">WELCOME SYSTEM ADMINISTRATOR</div>
    <div class="link_active btn_active button mtop pull-left"></div>
    <div class="admin_space pull-left"></div>
    <div class="link_logout btn_logout button mtop pull-right"></div>
    <div class="clearfix"></div>
    <?
    if( is_object( $admin ) ) {
        ?>
        <div class="section_box mtop">
            <div class="message"><?=$admin->message?></div>
        </div>
        <?
    } else {
		$admin = new Admin( $mysqli );
	}
	?>
    <div class="section_box half mtop pull-left">
    	<div class="title">Content Admins<div class="subtitle pull-right">EDIT&nbsp;&nbsp;/&nbsp;&nbsp;DELETE&nbsp;</div><div class="clearfix"></div></div>
        <?
		foreach( $admin->data['admins'] as $key => $val ) {
			?>
            <div class="admin_holder" id="admin-<?=$key?>">
                <div class="admin_name pull-left"><?=$val['name']?></div>
                <div class="admin_username hidden"><?=$val['username']?></div>
                <div class="icon_delete link_admin_delete pull-right"></div>
                <div class="icon_edit admin_edit pointer pull-right"></div>
                <div class="clearfix"></div>
            </div>
			<?
		}
		?>
        <div class="btn_create_admin button mtop pull-right"></div>
        <div class="clearfix"></div>
    </div>
    <div class="section_box half mtop pull-right">
    	<div class="title">System Admin Password</div>
        <form class="change_pwd" method="post">
        	<input type="hidden" name="process" value="admin">
            <input type="hidden" name="proc_type" value="change_pwd">
            <input type="hidden" name="user" value="<?=$_SESSION['usr_id']?>">
            <label>Current Password</label>
            <input type="password" name="pwd" required>
            <label>New Password</label>
            <input type="password" name="pwd_new" required>
            <label>Confirm New Password</label>
            <input type="password" name="pwd_cnew" required>
            <input type="submit" name="submit" class="btn_update button pull-right" value="">
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="clearfix"></div>
    <div id="create_admin" class="section_box mtop cancel_div hidden">
    	<div class="title">Create a Content Admin</div>
        <form class="create_admin" method="post">
        	<input type="hidden" name="process" value="admin">
            <input type="hidden" name="proc_type" id="admin_proc" value="create_admin">
            <label class="pull-left">Name</label><label class="pull-right">Password</label>
            <div class="clearfix"></div>
            <input type="text" name="name" id="a_name" class="pull-left" tabindex="1" required><input type="password" name="pwd" class="pull-right" tabindex="3" required>
            <div class="clearfix"></div>
            <label class="pull-left">Login Name</label><label class="pull-right">Confirm Password</label>
            <div class="clearfix"></div>
            <input type="text" name="username" id="a_username" class="pull-left" tabindex="2" required><input type="password" name="cpwd" class="pull-right" tabindex="4" required>
            <div class="clearfix"></div>
            <input type="submit" id="a_submit" name="submit" class="button pull-right" value="" tabindex="5">
            <div class="cancel btn_cancel button mright pull-right"></div>
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="clearfix"></div>
    </div>
    <?
} else {
	echo 'You are not authorized to view this page.';
}
?>
</div>