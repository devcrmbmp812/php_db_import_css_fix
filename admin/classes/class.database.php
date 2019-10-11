<?php
/**
 * Standard Database Class
 *
 */
class Database {
    public $conn;
    private $db;
    private $environment;

    public function __construct($db, $environment) {
        $this->db = $db;
        $this->environment = $environment;
    }

    /**
     * Connect to db
     *
     */
     public function connect() {
		$this->conn = new MySQLi($this->db[$this->environment]['hostname'], $this->db[$this->environment]['username'], $this->db[$this->environment]['password'],$this->db[$this->environment]['database']);
		if( mysqli_connect_errno($mysqli) ) {
			'ERROR: Unable to connect to ' . $this->db[$this->environment]['database'];
		}
        return $this->conn;
     }
}