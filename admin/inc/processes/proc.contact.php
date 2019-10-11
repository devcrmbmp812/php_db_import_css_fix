<?
$contact = new Support();
if( $contact->send_form('contact') ) unset($_POST);
?>