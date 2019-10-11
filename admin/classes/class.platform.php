<?php
class Platform {
	private $server;
	private $path;
	public $environment;
	
	public function __construct() {
        $this->server = $_SERVER['HTTP_HOST'];
		$this->path = dirname(__FILE__);
		//$_SESSION['debug']['PATH'] = dirname(__FILE__);
		$this->_load_platform_vars();
    }
	
	private function _load_platform_vars() {
		//if( strpos( $this->path, 'resthave/public_html' ) ) {
		//	$this->environment = 'production';
		//} elseif( strpos( $this->path, 'passed/public_html' ) ) {
			$this->environment = 'development';
		//}
	}

}
?>