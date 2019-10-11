<?
class Support {
	public $message;
	public $content;
	public $subject;
	public $target;
	public $from;
	
	public function __construct() {
		$this->target = 'ssatterwhite@resthavenfuneral.com';
		$this->from = 'info@passedlifepro.com';
	}
	
	public function send_form( $type ) {
		switch( $type ) {
			case 'contact':
				if( !$this->compile_contact_form() ) return false;
				break;
		}
		if( $this->send_mail() ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function send_mail() {
		$headers = "From: " . $this->from . "\r\nReply-To: " . $this->from . "\r\nX-Mailer: PHP/" . phpversion();
		if( @mail( $this->target, $this->subject, $this->content, $headers ) ) {
			$this->message = 'The email was sent successfully.';
			return true;
		} else {
			$this->message = 'There was an error sending the email.';
			return false;
		}
	}
	
	private function compile_contact_form() {
		$this->target .= ',mdumas@resthavenfuneral.com';
		$fields = array(
						'name'			=> 'Name',
						'phone'			=> 'Phone',
						'email'			=> 'Email',
						'msg'			=> 'Message'
						);
		$this->subject = 'Contact Form from PassedLife Pro';
		foreach( $_POST as $key => $val ) {
			switch( $key ) {
				case 'process':
					break;
				case 'msg':
					$this->content .= strtoupper($fields[$key]) . ":\r\n" . $val . "\r\n";
					break;
				default:
					$this->content .= strtoupper($fields[$key]) . ": " . $val . "\r\n";
			}
		}
		$this->from = $_POST['email'];
		return true;
	}
	
}
?>