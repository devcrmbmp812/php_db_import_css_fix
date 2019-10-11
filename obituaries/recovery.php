<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
$client = new Client($mysqli);

$meta_subtitle = ' | Reset Password'; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div class="obit-create container">
    <div class="title">Reset Your Password</div>
    <?
	if( $_REQUEST['error'] ) {
		?><div class="message"><?=$client->get_error( $_REQUEST['error'] )?></div><?
	}
	?>
    <form id="login" action="/admin/index.php" method="post">
    	<input type="hidden" name="process" value="client">
        <label class="pull-left">Username</label>
        <input type="text" class="pull-right" name="username" value="<?=$_POST['username']?>">
        <div class="clearfix"></div>
        <div class="input-width text-center pull-right">OR</div>
        <div class="clearfix"></div>
        <label class="pull-left">Email</label>
        <input type="email" class="pull-right" name="email" value="<?=$_POST['email']?>">
        <div class="clearfix"></div>
        <input type="submit" class="btn btn-primary button pull-right" name="submit" value="RESET PASSWORD">
        <div class="clearfix"></div>
    </form>
    <div class="fclear"></div>
</div>
<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>