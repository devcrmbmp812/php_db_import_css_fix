<?php
/**
 * Obituary Class
 *
 */
class Obituary {
	public $mysqli;
	private $service_id;
	public $id;
    public $obituary;
	public $message;
	public $error = false;
	public $users;
	public $clients;
	public $locations = array();

    public function __construct( $mysqli, $service_id = false ) {
		$this->mysqli = $mysqli;
		$this->service_id = $service_id;
    }
	
	public function get_error( $error = false ) {
		if( !$error ) $error = $this->error;
		$error_messages = array(
				0	=>	'ERROR: Unable to add obituary to the database.',
				1	=>	'ERROR: Unable to upload file.',
				2	=>	'ERROR: File to be uploaded not found.',
				3	=>	'ERROR: File is too large.  Files should be under 1MB.',
				4	=>	'ERROR: Unable to write files to database.',
				5	=>	'ERROR: Unable to retrieve information from the database.',
				6	=>	'ERROR: Unable to save your condolence.',
				7	=>	'ERROR: Unable to update the database.'
			);
		return $error_messages[$error];
	}
	
	public function get_listings( $client = false ) {
		$arr = array();
		if( $client ) {
			$sql = "SELECT * FROM " . OBITUARY_TABLE . " WHERE client = " . $client . " ORDER BY modifiedOn DESC";
		} else {
			$sql = "SELECT * FROM " . OBITUARY_TABLE . " WHERE approvedOn IS NOT NULL ORDER BY passed DESC, petName ASC";
		}
		if( $rs = @$this->mysqli->query($sql) ) {
			while( $row = @$rs->fetch_assoc() ) {
				$arr[$row['ID']] = $row;
			}
			return $arr;
		} else {
			$this->error = 5;
		}
		return false;
	}
	
	public function get_obituary( $id ) {
		$sql = "SELECT * FROM " . OBITUARY_TABLE . " WHERE ID = " . $id . " LIMIT 1";
		if( $rs = @$this->mysqli->query($sql) ) {
			$this->obituary = @$rs->fetch_assoc();
			return true;
		} else {
			$this->error = 5;
		}
		return false;
	}
	
	public function create() {
		$fields = array(
					'client'		=>	$_POST['client'],
					'familyName'	=>	$this->mysqli->real_escape_string($_POST['familyname']),
					'petName'		=>	$this->mysqli->real_escape_string($_POST['petname']),
					'passed'		=>	date("Y-m-d", strtotime($_POST['passed'])),
					'bio'			=>	$this->mysqli->real_escape_string($_POST['bio']),
					'createdOn'		=>	date("Y-m-d H:i:s")
				);
		$sql = "INSERT INTO " . OBITUARY_TABLE . "(" . implode( ',', array_keys( $fields ) ) . ") VALUES ('" . implode( "','", $fields ) . "')";
		if( @$this->mysqli->query($sql) ) {
			$this->id = $this->mysqli->insert_id;
			$fields = array();
			$files_uploaded = false;
			foreach( $_FILES as $filekey => $file ) {
				if( $_FILES[$filekey]['size'] > 0 ) {
					$dest_name = str_replace( 'photo', '', $filekey );
					if( $this->upload_image( $filekey, $dest_name ) ) {
						$fields[$filekey] = pathinfo( $_FILES[$filekey]['name'], PATHINFO_EXTENSION );
						$files_uploaded = true;
					} else {
						return false;
					}
				}
			}
			if( $files_uploaded ) {
				$set_arr = array();
				foreach( $fields as $key => $val ) {
					$set_arr[] = $key . "='" . $val . "'";
				}
				$sql = "UPDATE " . OBITUARY_TABLE . " SET " . implode( ',', $set_arr ) . " WHERE ID = " . $this->id;
				if( !@$this->mysqli->query($sql) ) {
					$this->error = 4;
				}
			}
			return true;
		} else {
			$this->error = 0;
		}
		return false;
	}
	
	public function fullupdate() {
		$fields = array(
					'familyName'	=>	$this->mysqli->real_escape_string($_POST['familyname']),
					'petName'		=>	$this->mysqli->real_escape_string($_POST['petname']),
					'passed'		=>	date("Y-m-d", strtotime($_POST['passed'])),
					'bio'			=>	$this->mysqli->real_escape_string($_POST['bio']),
				);
		if( $_POST['submit'] == 'SAVE AS APPROVED' ) {
			$fields['approvedOn'] = date( "Y-m-d H:i:s" );
			$fields['approvedBy'] = $_SESSION['usr_id'];
		}
		$set_arr = array();
		foreach( $fields as $key => $val ) {
			$set_arr[] = $key . "='" . $val . "'";
		}
		$sql = "UPDATE " . OBITUARY_TABLE . " SET " . implode( ',', $set_arr ) . " WHERE ID = " . $_POST['id'];
		if( @$this->mysqli->query($sql) ) {
			$this->id = $_POST['id'];
			$fields = array();
			$files_uploaded = false;
			foreach( $_FILES as $filekey => $file ) {
				if( $_FILES[$filekey]['size'] > 0 ) {
					$dest_name = str_replace( 'photo', '', $filekey );
					if( $this->upload_image( $filekey, $dest_name ) ) {
						$fields[$filekey] = pathinfo( $_FILES[$filekey]['name'], PATHINFO_EXTENSION );
						$files_uploaded = true;
					} else {
						return false;
					}
				}
			}
			if( $files_uploaded ) {
				$set_arr = array();
				foreach( $fields as $key => $val ) {
					$set_arr[] = $key . "='" . $val . "'";
				}
				$sql = "UPDATE " . OBITUARY_TABLE . " SET " . implode( ',', $set_arr ) . " WHERE ID = " . $this->id;
				if( !@$this->mysqli->query($sql) ) {
					$this->error = 4;
				}
			}
			return true;
		} else {
			$this->error = 7;
		}
		return false;
	}
	
	public function update() {
		$fields = array(
					'familyName'	=>	$this->mysqli->real_escape_string($_POST['familyname']),
					'petName'		=>	$this->mysqli->real_escape_string($_POST['petname']),
					'passed'		=>	date("Y-m-d", strtotime($_POST['passed'])),
					'bio'			=>	$this->mysqli->real_escape_string($_POST['bio']),
				);
		$set_arr = array();
		foreach( $fields as $key => $val ) {
			$set_arr[] = $key . "='" . $val . "'";
		}
		$sql = "UPDATE " . OBITUARY_TABLE . " SET " . implode( ',', $set_arr ) . " WHERE ID = " . $_POST['id'];
		if( @$this->mysqli->query($sql) ) {
			$this->id = $_POST['id'];
			$fields = array();
			$files_uploaded = false;
			foreach( $_FILES as $filekey => $file ) {
				if( $_FILES[$filekey]['size'] > 0 ) {
					$dest_name = str_replace( 'photo', '', $filekey );
					if( $this->upload_image( $filekey, $dest_name ) ) {
						$fields[$filekey] = pathinfo( $_FILES[$filekey]['name'], PATHINFO_EXTENSION );
						$files_uploaded = true;
					} else {
						return false;
					}
				}
			}
			if( $files_uploaded ) {
				$set_arr = array();
				foreach( $fields as $key => $val ) {
					$set_arr[] = $key . "='" . $val . "'";
				}
				$sql = "UPDATE " . OBITUARY_TABLE . " SET " . implode( ',', $set_arr ) . " WHERE ID = " . $this->id;
				if( !@$this->mysqli->query($sql) ) {
					$this->error = 4;
				}
			}
			return true;
		} else {
			$this->error = 7;
		}
		return false;
	}
	
	public function upload_image( $image_key, $dest_name ) {
		define( 'MAX_FILE_SIZE', 1024000 );
		define( 'UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/img/obits/' . $this->id . '/' );
		$dir = $_SERVER['DOCUMENT_ROOT'].'/img/obits/' . $this->id;
		if( !is_dir( $dir ) ) mkdir( $dir );
		$permitted = array( 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/png' );
		if( in_array( $_FILES[$image_key]['type'], $permitted ) && $_FILES[$image_key]['size'] > 0 && $_FILES[$image_key]['size'] <= MAX_FILE_SIZE ) {
			$ext = pathinfo( $_FILES[$image_key]['name'], PATHINFO_EXTENSION );
			$filename = $dest_name . '.' . pathinfo( $_FILES[$image_key]['name'], PATHINFO_EXTENSION );
			switch( $_FILES[$image_key]['error'] ) {
				case 0:
					if( move_uploaded_file( $_FILES[$image_key]['tmp_name'], UPLOAD_DIR . $filename ) ) {
						return true;
					} else {
						$this->error = 1;
					}
					break;
				case 3:
				case 6:
				case 7:
				case 8:
					$this->error = 1;
				break;
				case 4:
					$this->error = 2;
			}
		} else {
			$this->error = 3;
		}
		return false;
	}
	
	public function get_results() {
		$arr = array();
		$search = false;
		$search_arr = array( $_POST['familyName'], $_POST['petName'] );
		$search_arr = array_filter( $search_arr );
		if( count( $search_arr ) > 0 ) $search = $this->mysqli->real_escape_string( implode( ' ', $search_arr ) );
		if( $search ) {
			$sql = "SELECT ID, familyName, petName, passed, MATCH(familyName, petName) AGAINST ('" . $search . "' IN BOOLEAN MODE) as Relevance FROM " . OBITUARY_TABLE . " WHERE MATCH(familyName, petName) AGAINST('" . $search . "' IN BOOLEAN MODE) HAVING Relevance >= 1 ORDER BY Relevance DESC";
			if( $_POST['orderBy'] ) $sql .= ", ";
		} else {
			$sql = "SELECT ID, firstName, lastName, passed FROM " . OBITUARY_TABLE;
			if( $_POST['orderBy'] ) $sql .= " ORDER BY ";
		}
		if( $_POST['orderBy'] == 'name' ) {
			$sql .= "familyName ASC, petName ASC";
		} elseif( $_POST['orderBy'] == 'date' ) {
			$sql .= "passed DESC";
		}
		if( $rs = @$this->mysqli->query($sql) ) {
			while( $row = @$rs->fetch_assoc() ) {
				$arr[$row['ID']] = $row;
			}
			return $arr;
		} else {
			$this->error = 5;
		}
		return false;
	}
	
	public function get_admin_results( $search_str ) {
		$search_arr = explode( ' ', $search_str );
		foreach( $search_arr as $key => $val ) {
			$search_arr[$key] .= '*';
		}
		$search = implode( ' ', $search_arr );
		$sql = "SELECT ID, status, familyName, petName, passed, MATCH(familyName,petName) AGAINST ('" . $search . "' IN BOOLEAN MODE) as Relevance FROM " . OBITUARY_TABLE . " WHERE MATCH(familyName,petName) AGAINST('" . $search . "' IN BOOLEAN MODE) HAVING Relevance >= 1 ORDER BY Relevance DESC";
		$rs = $this->mysqli->query( $sql );
		while( $row = @$rs->fetch_assoc() ) {
			$arr[$row['ID']] = $row;
		}
		$rs->free();
		return $arr;
	}
	
	private function get_client_names() {
		$sql = "SELECT ID, name FROM " . CLIENT_USER_TABLE . " ORDER BY ID ASC";
		$rs = @$this->mysqli->query( $sql );
		while( $row = @$rs->fetch_assoc() ) {
			$this->clients[$row['ID']] = $row['name'];
		}
		$rs->free();
	}
	
	private function get_user_names() {
		$sql = "SELECT ID, name FROM " . USER_ID_TABLE . " ORDER BY ID ASC";
		$rs = @$this->mysqli->query( $sql );
		while( $row = @$rs->fetch_assoc() ) {
			$this->users[$row['ID']] = $row['name'];
		}
		$rs->free();
	}
	
	public function get_records( $view, $page = 1 ) {
		$this->get_user_names();
		$this->get_client_names();
		$arr = array();
		$sql = "SELECT * FROM " . OBITUARY_TABLE . " WHERE status = '" . $view . "' ORDER BY passed DESC, familyName ASC, petName ASC";
		$_SESSION['debug']['GET RECORDS'] = $sql;
		$rs = @$this->mysqli->query( $sql );
		$this->pages = ceil( $rs->num_rows / 10 );
		$i = 1;
		while( $row = @$rs->fetch_assoc() ) {
			if( $i > ($page*10-10) && $i <= $page*10 ) $arr[$row['ID']] = $row;
			$i++;
		}
		$rs->free();
		return $arr;
	}
	
	public function archive_listing() {
		if( !$this->service_id ) {
			$this->message = 'ERROR: Unable to determine database ID.';
			return false;
		}
		$sql = 'UPDATE ' . OBITUARY_TABLE . ' SET status = "Archive" WHERE ID = ' . $this->service_id;
		$rs = $this->mysqli->query( $sql );
		return $this->service_id;
	}
	
	public function unarchive_listing() {
		if( !$this->service_id ) {
			$this->message = 'ERROR: Unable to determine database ID.';
			return false;
		}
		$sql = 'UPDATE ' . OBITUARY_TABLE . ' SET status = "Active" WHERE ID = ' . $this->service_id;
		$rs = $this->mysqli->query( $sql );
		return $this->service_id;
	}
	
	public function delete_listing() {
		if( !$this->service_id ) {
			$this->message = 'ERROR: Unable to determine database ID.';
			return false;
		}
		$sql = 'DELETE FROM ' . OBITUARY_TABLE . ' WHERE ID = ' . $this->service_id;
		$rs = $this->mysqli->query( $sql );
		$this->recursiveDelete( $_SERVER['DOCUMENT_ROOT'].'/img/obits/'.$this->service_id );
		return true;
	}
	
	private function recursiveDelete($str){
        if(is_file($str)){
            return @unlink($str);
        }
        elseif(is_dir($str)){
            $scan = glob(rtrim($str,'/').'/*');
            foreach($scan as $index=>$path){
                $this->recursiveDelete($path);
            }
            return @rmdir($str);
        }
    }
	
}


