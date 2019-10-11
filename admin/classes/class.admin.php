<?php
class Admin extends Login {
	public $data;
	
    public function __construct( $mysqli ) {
		parent::__construct( $mysqli );
		$this->get_data();
    }
	
	private function get_data() {
		$this->data['admins'] = $this->get_admins();
	}
	
	private function get_admins() {
		$arr = array();
		$sql = "SELECT ID, name, username FROM " . USER_ID_TABLE . " WHERE level = 3 ORDER BY name ASC";
		$rs = @$this->mysqli->query($sql);
		while( $row = @$rs->fetch_assoc() ) {
			$arr[$row['ID']] = $row;
		}
		$rs->free();
		return $arr;
	}
	
	public function delete_admin() {
		$sql = "DELETE FROM " . USER_ID_TABLE . " WHERE ID = " . $_REQUEST['id'] . " LIMIT 1";
		$_SESSION['debug']['DELETE'] = $sql;
		if( @$this->mysqli->query($sql) ) {
			$this->message = "Admin deleted successfully.";
			$this->data['admins'] = $this->get_admins();
			return true;
		} else {
			$this->message = "ERROR: Unable to delete the admin.";
			return false;
		}
	}
	
	public function create_admin() {
		$fields = array( 'name', 'username', 'pwd' );
		$values = array();
		foreach( $fields as $f ) {
			if( $_POST[$f] == '' ) {
				$this->message = 'ERROR: Please complete all fields in the form.';
				return false;
			}
			$values[$f] = $_POST[$f];
		}
		if( $_POST['pwd'] != $_POST['cpwd'] ) {
			$this->message = 'ERROR: The password fields do not match.';
			return false;
		}
		$values['pwd'] = trim(md5($_POST['pwd']));
		$sql = "INSERT INTO " . USER_ID_TABLE . " (" . implode( ',', $fields ) . ",level) VALUES ('" . implode( "','", $values ) . "','3')";
		if( @$this->mysqli->query( $sql ) ) {
			$this->data['admins'] = $this->get_admins();
			$this->message = 'Admin added successfully.';
			return true;
		} else {
			$this->message = 'ERROR: Unable to write new user to database.';
			return false;
		}
	}
	
	public function edit_admin() {
		if( $_POST['pwd'] != $_POST['cpwd'] ) {
			$this->message = 'ERROR: The password fields do not match.';
			return false;
		}
		$sql = "UPDATE " . USER_ID_TABLE . " SET name='" . $_POST['name'] . "', username='" . $_POST['username'] . "'";
		if( $_POST['pwd'] != '' ) $sql .= ", pwd='" . trim(md5($_POST['pwd'])) . "'";
		$sql .= " WHERE ID = " . $_POST['id'] . " LIMIT 1";
		$_SESSION['debug']['EDIT'] = $sql;
		if( @$this->mysqli->query( $sql ) ) {
			$this->data['admins'] = $this->get_admins();
			$this->message = 'Admin updated successfully.';
			return true;
		} else {
			$this->message = 'ERROR: Unable to update admin in database.';
			return false;
		}
	}
	
}


