<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/app_top.php';
if( !is_object( $client ) ) $client = new Client($mysqli);

$meta_subtitle = ' | Login'; 
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_html.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/header_nav.php";
?>
<div class="obits_body">
<div class="navbar-filler"></div>
<div id="login_form" class="container clearfix">
	<? if( $_GET['error'] ) { ?><div class="message"><?=$client->get_error($_GET['error'])?></div><? } ?>
    <div class="col1 pull-left">
        <div class="title">Returning Users</div>
        <form action="/admin/index.php" method="post">
            <input type="hidden" name="process" value="client">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <input type="submit" class="btn btn-primary button" name="submit" value="SIGN IN">
            <a class="link_client-recover pull-right">Forgot username/password?</a>
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="col2 pull-right">
        <div class="title">New Users</div>
        <form action="/admin/index.php" method="post">
            <input type="hidden" name="process" value="client">
            <div class="pull-left">
                <input type="text" name="name" placeholder="Full Name" tabindex="1" required>
                <input type="email" name="email" placeholder="Email" tabindex="3" required>
                <input type="password" name="pwd" placeholder="Password" tabindex="5" required>
                <input type="checkbox" name="terms" value="1" tabindex="7" required><label>I accept the <a class="link_terms">Terms of Use</a></label>
                <input type="submit" class="btn btn-primary button" name="submit" value="REGISTER" tabindex="8">
            </div>
            <div class="pull-right">
                <input type="text" name="username" placeholder="Username" tabindex="2" required>
                <input type="email" name="conf_email" placeholder="Confirm Email" tabindex="4" required>
                <input type="password" name="conf_pwd" placeholder="Confirm Password" tabindex="6" required>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
</div>
<?
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_site.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_html.php";
?>