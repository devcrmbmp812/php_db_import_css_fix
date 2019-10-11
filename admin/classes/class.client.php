<?php
/**
 * Client Class
 *
 */
class Client {
	public $mysqli;
    public $user;
    public $message;
	public $error;

    public function __construct( $mysqli ) {
		$this->mysqli = $mysqli;
    }
	
	public function get_error( $error ) {
		$error_messages = array(
				0	=>	'There was an error registering the account.',
				1	=>	'Invalid username/password.',
				2	=>	'Please enter a username or email.',
				3	=>	'Username or email error.  Please try again.',
				4	=>	'There was an error sending the email with the new password.',
				5	=>	'There was an error writing the temporary password to the database.',
				6	=>	'A new password has been sent to the email address provided.<br>Please allow several minutes for it to arrive then log in below.',
				7	=>	'You are using a temporary password.  Please update your password below.',
				8	=>	'Passwords do not match.  Please try again.',
				9	=>	'There was an error updating the password.',
				10	=>	'Sorry, that username is already taken.',
				11	=>	'This email is already registered. Please login instead.'
			);
		return $error_messages[$error];
	}

    public function login() {
        $rs = $this->mysqli->query("SELECT * FROM " . CLIENT_USER_TABLE . " WHERE username = '" . $this->mysqli->real_escape_string($_POST['username']) . "'");
        $this->user = $rs->fetch_assoc();
		if ( (trim($this->user['pwd']) == trim(md5($_POST['pwd'])) ) ) {
			if( $this->user['reset'] != 0 ) {
				$this->error = 7;
				return false;
			}
			$_SESSION['client_id'] = $this->user['ID'];
			return true;
        } else {
            $this->error = 1;
            return false;
        }
    }

    public function register() {
		$fields = array(
						'name'		=>	$this->mysqli->real_escape_string($_POST['name']),
						'username'	=>	$this->mysqli->real_escape_string($_POST['username']),
						'pwd'		=>	$this->mysqli->real_escape_string(trim(md5($_POST['pwd']))),
						'email'		=>	$this->mysqli->real_escape_string($_POST['email']),
						'terms'		=>	1
						);
		$sql = "SELECT username, email FROM " . CLIENT_USER_TABLE;
		if( $rs = @$this->mysqli->query($sql) ) {
			while( $row = $rs->fetch_assoc() ) {
				if( $row['username'] == $_POST['username'] ) $this->error = 10;
				if( $row['email'] == $_POST['email'] ) $this->error = 11;
			}
			if( !$this->error ) {
				$sql = "INSERT INTO " . CLIENT_USER_TABLE . "(" . implode( ',', array_keys( $fields ) ) . ") VALUES ('" . implode( "','", $fields ) . "')";
				if( @$this->mysqli->query($sql) ) {
					$_SESSION['client_id'] = $this->mysqli->insert_id;
					return true;
				} else {
					$this->error = 0;
				}
			}
		} else {
			$this->error = 0;
		}
		return false;
	}
	
	public function reset_pwd() {
		if( $_POST['username'] != '' ) {
			$where = "username = '" . $this->mysqli->real_escape_string($_POST['username']) . "'";
		} elseif( $_POST['email'] != '' ) {
			$where = "email = '" . $this->mysqli->real_escape_string($_POST['email']) . "'";
		} else {
			$this->error = 2;
			return false;
		}
		$sql = "SELECT * FROM " . CLIENT_USER_TABLE . " WHERE " .$where;
		$rs = @$this->mysqli->query($sql);
		$count = $rs->num_rows;
		if( $count == 1 ) {
			$row = @$rs->fetch_assoc();
			//Generate password
			$odd = 'AbcdEfghjkmnpqrstUvwxYz234567';
			$even = 'aBCDeFGHJKMNPQRSTuVWXyZ89@#$%';
			$password = '';
			$alt = time() % 2;
			for ($i = 0; $i < 10; $i++) {
				if ($alt == 1) {
					$password .= $odd[(rand() % strlen($odd))];
					$alt = 0;
				} else {
					$password .= $even[(rand() % strlen($even))];
					$alt = 1;
				}
			}
			$encrypt = $this->mysqli->real_escape_string(trim(md5($password)));
			//Send email
			$to      = $row['email'];
			$subject = 'Account notification from ' . SITE_NAME;
			$message = "As requested your password has been reset.\r\n\r\n";
			$message .= "Username: " . $_POST['username'] . "\r\n\r\n";
			$message .= "Temporary Password: " . $password . "\r\n\r\n";
			$message .= "You will be required to change the password when you login.\r\n";
			if( @mail($to, $subject, $message) ) {
				if( @$this->mysqli->query("UPDATE " . CLIENT_USER_TABLE . " SET pwd = '" . $encrypt . "', `reset` = 1 WHERE ID = " . $row['ID']) ) {
					$this->error = 6;
					return true;
				} else {
					$this->error = 5;
					return false;
				}
			} else {
				$this->error = 4;
				return false;
			}
		} else {
			$this->error = 3;
			return false;
		}
		return false;
	}
	
	public function change_pwd() {
		if( $_POST['pwd'] != $_POST['conf_pwd'] ) {
			$this->error = 8;
			return false;
		}
		$sql = "SELECT ID FROM " . CLIENT_USER_TABLE . " WHERE username = '" . $_POST['username'] . "' AND pwd = '" . $this->mysqli->real_escape_string(trim(md5($_POST['old_pwd']))) . "'";
		$rs = @$this->mysqli->query($sql);
		if( $rs->num_rows > 0 ) {
			$row = @$rs->fetch_assoc();
			$pwd = $this->mysqli->real_escape_string(trim(md5($_POST['pwd'])));
			$sql = "UPDATE " . CLIENT_USER_TABLE . " SET pwd = '" . $pwd . "', reset = 0 WHERE ID = " . $row['ID'];
			if( !@$this->mysqli->query($sql) ) {
				$this->error = 9;
				return false;
			}
			$_SESSION['client_id'] = $row['ID'];
			return true;
		} else {
			$this->error = 1;
			return false;
		}
	}
	
}


