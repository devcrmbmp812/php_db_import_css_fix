<?php
/**
 * Login Class
 *
 */
class Login extends Support {
	public $mysqli;
    public $user;
    public $sec_levels;
    private $user_id;
    private $password;
    private $new_password;
    private $confirm_password;
    private $remember;
	public $change_pwd = false;
    public $message;

    public function __construct( $mysqli ) {
		parent::__construct();
		$this->mysqli = $mysqli;
        $this->user_id = $_POST['user'];
        $this->password = trim(md5($_POST['pwd']));
        $this->new_password = $_POST['new_pwd'];
        $this->confirm_password = $_POST['confirm_pwd'];
        $this->remember = $_POST['remember'];
        $this->sec_levels = array( 1 => 'lv_user', 2 => 'lv_edit', 4 => 'lv_admin' );
    }

    public function validate_password() {
        $rs = $this->mysqli->query("SELECT * FROM " . USER_ID_TABLE . " WHERE username = '" . $this->mysqli->real_escape_string($_POST['user']) . "'");
        $user = $rs->fetch_assoc();
        if ( ( $this->password == $user['pwd'] ) && $user['reset'] == 'Y' ) {
            $this->message = 'Password is a temporary password.  Please change your password.';
			$this->change_pwd = true;
			return false;
        }
		return true;
    }

    public function login_user() {
        $rs = $this->mysqli->query("SELECT * FROM " . USER_ID_TABLE . " WHERE username = '" . $this->mysqli->real_escape_string($this->user_id) . "'");
        $this->user = $rs->fetch_assoc();
		$_SESSION['debug']['USER DATA'] = var_export( $this->user, TRUE );

        if ( (trim($this->user['pwd']) == $this->password) && ($this->user['level'] > 0 )) {
            $_SESSION['usr_id'] = $this->user['ID'];
			$_SESSION['usr_username'] = $this->user['username'];
            $_SESSION['usr_name'] = $this->user['name'];
            $_SESSION['usr_level'] = $this->user['level'];
            //if ( $this->remember ) {
                setcookie("zdmplp_username", $this->user['username'], time()+365*24*60*60);
            //}
            /**
             * set access level
             */
            foreach ( $this->sec_levels as $bit => $level ) {
                $_SESSION[$level] = false;
                if ( $bit & $_SESSION['usr_level'] ) {
                    $_SESSION[$level] = true;
                }
            }
            setcookie("zdmplp_status", time()+12*60*60, time()+24*60*60);
            /**
             * log login into .txt file
            
            return $this->_log_user_login(); */
			return true;
        } else {
            $this->message = 'Invalid username/password.';
            return false;
        }
    }

    public function _log_user_login() {
		if ($handle = @fopen("logs/login.txt",'a+')) {
            $log_content = date("F j, Y, g:i a").", "."host ip: ".$_SERVER['REMOTE_ADDR'].", ". $_SESSION["usr_name"]."\r\n";
            if ( fwrite($handle, $log_content) === false ) {
                $this->message = 'Unable to write to system log.';
                return false;
            }
            return true;
        } else {
            $this->message = 'Unable to log user into system.';
            return false;
        }
    }
	
	public function change_password() {
		if ( $_POST['pwd_new'] != $_POST['pwd_cnew'] ) {
			$this->message = 'New Password fields do not match.';
			return false;
		} else {
			$pwd = trim(md5($_POST['pwd']));
			$pwd_new = trim(md5($_POST['pwd_new']));
			$rs = @$this->mysqli->query("SELECT pwd FROM " . USER_ID_TABLE . " WHERE ID = '" . $_POST['user'] . "'");
			$row = @$rs->fetch_assoc();
			if( $row['pwd'] == $pwd ) {
				$sql = "UPDATE " . USER_ID_TABLE . " SET pwd = '" . $this->mysqli->real_escape_string($pwd_new) . "' WHERE ID = '" . $_POST['user'] . "' LIMIT 1";
				if( @$this->mysqli->query($sql) ) {
					$this->message = 'Please log in with your new password.';
					$this->change_pwd = false;
					return true;
				} else {
					$this->message = 'There was an error updating the password.';
					return false;
				}
			} else {
				$this->message = 'The current password is incorrect.';
				return false;
			}
		}
	}
	
	public function recover_password() {
		if( $_POST['email'] != $_POST['conf_email'] ) {
			$this->message = 'ERROR: Email fields do not match.';
			return false;
		}
		$fields = array(
						'name'			=> 'Name',
						'email'			=> 'Email',
						);
		$this->subject = 'Forgot Password for PassedLife Pro';
		foreach( $fields as $key => $val ) {
			$this->content .= strtoupper($val) . ": " . $_POST[$key] . "\r\n";
		}
		$this->from = $_POST['email'];
		return $this->send_mail();
	}
	
}


