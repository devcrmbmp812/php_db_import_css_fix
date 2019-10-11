<?
$target = 'mdumas@resthavenfuneral.com';
$subject = 'Message from Pet Memories Cremation Service Website';
$content = '';

$fields = array(
				'name'			=>	'Name',
				'email'			=>	'Email',
				'phone'			=>	'Phone',
				'message'		=>	'Message'
			);
foreach( $_POST as $key => $val ) {
	switch( $key ) {
		case 'message':
			$content .= strtoupper($fields[$key]) . ":\r\n" . $val . "\r\n";
			break;
		default:
			$content .= strtoupper($fields[$key]) . ": " . $val . "\r\n";
	}
}
if( @mail( $target, $subject, $content ) ) {
	echo '	<div class="formPromo">
			<h1>Thank you.</h1>
			<p>Your form has been successfully submitted.</p>
			<hr>
			<div>
			<img src="/img/Pet-Memories-Logo-Black.png" />
			<h2>972-772-5671</h2>
			<div class="clear"></div>
			</div>'
	;
} else {
	echo 'Failure!';
}
?>