<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$client = new Client($mysqli);

$meta_subtitle = ' | Reset Password'; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div class="obit-create"><div class="container">
    <div class="title">Reset Your Password</div>
    <?
	if( $_REQUEST['error'] ) {
		?><div class="message"><?=$client->get_error( $_REQUEST['error'] )?></div><?
	}
	?>
    <form id="login" action="/admin/index.php" method="post">
    	<input type="hidden" name="process" value="client">
        <label class="pull-left">Username</label>
        <input type="text" class="pull-right" name="username" value="<?=$_POST['username']?>" required>
        <div class="clearfix"></div>
        <label class="pull-left">Current Password</label>
        <input type="password" class="pull-right" name="old_pwd" value="<?=$_POST['old_pwd']?>" required>
        <div class="clearfix"></div>
        <label class="pull-left">New Password</label>
        <input type="password" class="pull-right" name="pwd" value="<?=$_POST['pwd']?>" required>
        <div class="clearfix"></div>
        <label class="pull-left">Confirm Password</label>
        <input type="password" class="pull-right" name="conf_pwd" value="<?=$_POST['conf_pwd']?>" required>
        <div class="clearfix"></div>
        <input type="submit" class="button pull-right" name="submit" value="UPDATE PASSWORD">
        <div class="clearfix"></div>
    </form>
    <div class="fclear"></div>
</div></div>
<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>