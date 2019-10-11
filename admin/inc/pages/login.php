<div class="obits_body">
<div class="navbar-filler"></div>
<div class="container">
<?
if( is_object( $login ) ) {
	?><div class="message"><?=$login->message?></div><?
}
$viewname = $_REQUEST['view'] ? $_REQUEST['view']: 'login';
include 'inc/views/' . $viewname . '.php';
?>
</div>