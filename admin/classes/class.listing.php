<?
class Listing {
	private $mysqli;
	private $service_id;
	private $fields;
	public $users = array();
	public $pages;
	public $message = false;
	public $data;
	public $options;
	
	public function __construct( $mysqli, $service_id = false ) {
		$this->mysqli = $mysqli;
		$this->service_id = $service_id;
	}
	
	public function get_options() {
		$this->options = array(
						'arrangementStatus'		=>	array( 'RESERVED', 'PENDING' ),
						'cemetery'				=>	array(
														'RHMP',
														'Rockwall Memorial Cemetery',
														'Sacred Heart Cemetery',
														'Royse City Cemetery',
														'DFW National Cemetery',
														'Restland',
														'Heath Cemetery'
														),
						'funeralDirector'		=>	$this->get_directors(),
						'familyServiceStaff'	=>	$this->get_staff(),
						'originatingLocation'	=>	array(
														'Rockwall'		=>	'table_green',
														'Royse City'	=>	'table_red',
														'Rowlett'		=>	'table_blue',
														'RHMP'			=>	'table_orange',
														'Other'			=>	'table_other'
														),
						'serviceLocation'		=>	array(
														'Rockwall Chapel',
														'Rowlett Chapel',
														'Royse City Chapel',
														'FUMC Rockwall',
														'FUMC Rowlett',
														'FUMC Royse City',
														'FUMC Heath',
														'FBC Rockwall',
														'FBC Rowlett',
														'FBC Royse City',
														'FBC Heath',
														'Lake Pointe Church Rockwall',
														'Our Lady of The Lake',
														'Sacred Heart Cemetery Chapel',
														'Sacred Heart Church',
														'Holy Trinity Heath',
														'First Presbyterian Rockwall',
														'Lakeshore Church'
														),
						'serviceStatus'			=>	array( 'RESERVED', 'PENDING' ),
						'visitationStatus'		=>	array( 'RESERVED', 'PENDING' )
					);
	}
	
	private function get_directors() {
		$arr = array();
		$sql = "SELECT abbr FROM " . SERVICE_DIRECTORS_TABLE . " ORDER BY abbr ASC";
		$rs = @$this->mysqli->query($sql);
		while( $row = @$rs->fetch_assoc() ) {
			$arr[] = $row['abbr'];
		}
		$rs->free();
		return $arr;
	}
	
	private function get_staff() {
		$arr = array();
		$sql = "SELECT abbr FROM " . SERVICE_STAFF_TABLE . " ORDER BY abbr ASC";
		$rs = @$this->mysqli->query($sql);
		while( $row = @$rs->fetch_assoc() ) {
			$arr[] = $row['abbr'];
		}
		$rs->free();
		return $arr;
	}
	
	public function build_display() {
		$this->data['fields'] = $this->get_display_fields();
		$sql = "SELECT i.*, f.*, p.* FROM " . SERVICE_INFO_TABLE . " i JOIN (" . SERVICE_FLOWERS_TABLE . " f, ". SERVICE_PICKUP_TABLE . " p) ON i.ID = f.serviceID AND i.ID = p.serviceID WHERE i.status = 'Active' ORDER BY dateTime ASC";
		$rs = @$this->mysqli->query( $sql );
		while( $row = @$rs->fetch_assoc() ) {
			$this->data['listings'][$row['ID']] = $row;
		}
	}
	
	private function get_display_fields() {
		$arr = array(
						'Name of Deceased'			=>	array( 'firstName', 'lastName' ),
						'Arrangement Date & Time'	=>	array( 'arrangementConference' ),
						'FD'						=>	'funeralDirector',
						'FS'						=>	'familyServiceStaff',
						'Visitation Date & Time'	=>	array( 'visitation', 'visitationStatus' ),
						'Casket'					=>	'casket',
						'Service Location'			=>	'serviceLocation',
						'Service Date & Time'		=>	array( 'dateTime' ),
						'Cemetery'					=>	'cemetery',
						'Outer Burial Container'	=>	'outerBurialContainer',
						'Limo Driver'				=>	'driver',
						'Pick Up Time'				=>	array( 'time' ),
						'Pick Up Address'			=>	array( 'address', 'address2', 'city', 'state', 'zip' ),
						'Coach'						=>	'coach',
						'Flower Van/Driver'			=>	'vanDriver',
						'TH'						=>	'thumbies',
						'Additional Information'	=>	'notes'
					);
		return $arr;
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
		$arr = array();
		$sql = "SELECT ID, firstName, lastName, dateTime, serviceLocation, owner, created, modifiedBy, modifiedOn FROM " . SERVICE_INFO_TABLE . " WHERE status = '" . $view . "' ORDER BY dateTime DESC";
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
	
	public function get_logging( $page = 1 ) {
		$this->get_user_names();
		$arr = array();
		$sql = "SELECT l.ID, l.userID, l.action, l.modifiedOn, s.firstName, s.lastName FROM " . LOGGING_TABLE . " l JOIN " . SERVICE_INFO_TABLE . " s ON l.serviceID = s.ID ORDER BY l.modifiedOn DESC";
		$_SESSION['debug']['GET LOGGING'] = $sql;
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
	
	private function get_listing_fields() {
		return array(
					SERVICE_INFO_TABLE		=> array(
												'originatingLocation'		=>	'originatingLocation',
												'firstName'					=>	'firstName',
												'lastName'					=>	'lastName',
												'arrangementConference'		=>	array( 'day', 'hr', 'min', 'ampm' ),
												'arrangementStatus'			=>	'arrangementStatus',
												'funeralDirector'			=>	'funeralDirector',
												'familyServiceStaff'		=>	'familyServiceStaff',
												'visitation'				=>	array( 'day', 'hr', 'min', 'ampm' ),
												'visitationEnd'				=>	array( 'hr', 'min', 'ampm' ),
												'visitationStatus'			=>	'visitationStatus',
												'casket'					=>	'casket',
												'serviceLocation'			=>	'serviceLocation',
												'dateTime'					=>	array( 'day', 'hr', 'min', 'ampm' ),
												'serviceStatus'				=>	'serviceStatus',
												'cemetery'					=>	'cemetery',
												'outerBurialContainer'		=>	'outerBurialContainer',
												'notes'						=>	'notes'
											),
					SERVICE_PICKUP_TABLE	=> array(
												'driver'					=>	'driver',
												'time'						=>	array( 'hr', 'min', 'ampm' ),
												'address'					=>	'address',
												'address2'					=>	'address2',
												'city'						=>	'city',
												'state'						=>	'state',
												'zip'						=>	'zip'
											),
					SERVICE_FLOWERS_TABLE	=> array(
												'coach'						=>	'coach',
												'thumbies'					=>	'thumbies',
												'van'						=>	'van',
												'vanDriver'					=>	'vanDriver'
											)
				);
	}
	
	public function get_listing_info() {
		$this->fields = $this->get_listing_fields();
		$this->get_options();
		$sql = "SELECT i.*, f.*, p.* FROM " . SERVICE_INFO_TABLE . " i JOIN (" . SERVICE_FLOWERS_TABLE . " f, ". SERVICE_PICKUP_TABLE . " p) ON i.ID = f.serviceID AND i.ID = p.serviceID WHERE i.ID = " . $this->service_id;
		$rs = @$this->mysqli->query( $sql );
		$info = @$rs->fetch_assoc();
		foreach( $this->fields as $db_table => $fields ) {
			foreach( $fields as $db_field => $form_field ) {
				if( is_array( $form_field ) ) {
					switch( $db_field ) {
						case 'arrangementConference':
						case 'visitation':
						case 'dateTime':
							if( $info[$db_field] ) {
								$timestamp = strtotime( $info[$db_field] );
								$day = $db_field . '_day';
								$hour = $db_field . '_hr';
								$minute = $db_field . '_min';
								$ampm = $db_field . '_ampm';
								$this->data[$day] = date( 'l, F j, Y', $timestamp );
								$this->data[$hour] = date( 'g', $timestamp );
								$this->data[$minute] = date( 'i', $timestamp );
								$this->data[$ampm] = date( 'A', $timestamp );
							}
							break;
						case 'visitationEnd':
						case 'time':
							if( $info[$db_field] ) {
								$timestamp = strtotime( $info[$db_field] );
								$hour = $db_field . '_hr';
								$minute = $db_field . '_min';
								$ampm = $db_field . '_ampm';
								$this->data[$hour] = date( 'g', $timestamp );
								$this->data[$minute] = date( 'i', $timestamp );
								$this->data[$ampm] = date( 'A', $timestamp );
							}
							break;
					}
				} else {
					$this->data[$db_field] = $info[$db_field];
				}
			}
		}
		$_SESSION['debug']['INFO'] = var_export( $this->data, true );
		$rs->free();
	}
	
	public function post_listing_info( $edit = false ) {
		$logging = '';
		if( $_POST['originatingLocation'] == '' ) {
			$this->message = 'Please select an Originating Location.';
			return false;
		}
		$this->fields = $this->get_listing_fields();
		foreach( $this->fields as $db_table => $fields ) {
			$field_arr = array();
			$value_arr = array();
			$set_arr = array();
			foreach( $fields as $db_field => $form_field ) {
				$field_arr[] = $db_field;
				if( is_array( $form_field ) ) {
					switch( $db_field ) {
						case 'arrangementConference':
						case 'visitation':
						case 'visitationEnd':
						case 'dateTime':
							$day = ( $db_field == 'visitationEnd' ) ? 'visitation_day': $db_field . '_day';
							if( $_POST[$day] ) {
								$hour = $db_field . '_hr';
								$minute = $db_field . '_min';
								$ampm = $db_field . '_ampm';
								$hour_var = ( $_POST[$hour] == '' ) ? '12': $_POST[$hour];
								$minute_var = ( $_POST[$minute] == '' ) ? '00': $_POST[$minute];
								$date = strtotime( $_POST[$day] . ' ' . $hour_var . ':' . $minute_var . $_POST[$ampm] );
								$value_arr[] = date( "Y-m-d H:i:s", $date );
								$set_arr[] = $db_field . '="' . date( "Y-m-d H:i:s", $date ) . '"';
							} else {
								$value_arr[] = 'NULL';
								$set_arr[] = $db_field . '=NULL';
							}
							break;
						case 'time':
							$hour = $db_field . '_hr';
							if( $_POST[$hour] ) {
								$minute = $db_field . '_min';
								$ampm = $db_field . '_ampm';
								$hour_var = ( $_POST[$hour] == '' ) ? '12': $_POST[$hour];
								$minute_var = ( $_POST[$minute] == '' ) ? '00': $_POST[$minute];
								$time = $hour_var . ':' . $minute_var . $_POST[$ampm];
								$value_arr[] = date( "H:i:s", strtotime( $time ) );
								$set_arr[] = $db_field . '="' . date( "H:i:s", strtotime( $time ) ) . '"';
							} else {
								$value_arr[] = 'NULL';
								$set_arr[] = $db_field . '=NULL';
							}
							break;
					}
				} else {
					$value_arr[] = $this->mysqli->real_escape_string( $_POST[$form_field] );
					$set_arr[] = $db_field . '="' . $this->mysqli->real_escape_string( $_POST[$form_field] ) . '"';
				}
			}
			if( $edit ) {
				if( !$this->service_id ) {
					$this->message = 'ERROR: Unable to determine database ID.';
					return false;
				}
				$sql = 'UPDATE ' . $db_table . ' SET ';
				if( $db_table == SERVICE_INFO_TABLE ) $sql .= 'modifiedBy = "' . $_SESSION['usr_id'] . '", ';
				$sql .= implode( ',', $set_arr ) . ' WHERE ';
				$sql .= ( $db_table == SERVICE_INFO_TABLE ) ? 'ID = ': 'serviceID = ';
				$sql .= $this->service_id;
				$logging .= $sql . "\r\n";
				$rs = $this->mysqli->query( $sql );
				//$rs->free();
			} else {
				if( ( $db_table != SERVICE_INFO_TABLE ) && !$this->service_id ) {
					$this->message = 'Error building database queries.';
					return false;
				}
				$sql = 'INSERT INTO ' . $db_table . ' (';
				if( $db_table == SERVICE_INFO_TABLE ) {
					$sql .= 'owner,created,';
				} else {
					$sql .= 'serviceID,';
				}
				$sql .= implode( ',', $field_arr ) . ') VALUES ("';
				if( $db_table == SERVICE_INFO_TABLE ) {
					$sql .= $_SESSION['usr_id'] . '","' . date( "Y-m-d H:i:s" ) . '","';
				} else {
					$sql .= $this->service_id . '","';
				}
				$sql .= implode( '","', $value_arr ) . '")';
				$sql = str_replace( '"NULL"', 'NULL', $sql );
				$logging .= $sql . "\r\n";
				$rs = $this->mysqli->query( $sql );
				if( $db_table == SERVICE_INFO_TABLE ) $this->service_id = $this->mysqli->insert_id;
				//$rs->free();
			}
		}
		$action = $edit ? 'UPDATE': 'CREATE';
		$sql = "INSERT INTO " . LOGGING_TABLE . " (serviceID,userID,action,detail) VALUES (" . $this->service_id . "," . $_SESSION['usr_id'] . ",'" . $action . "','" . $logging . "')";
		$_SESSION['debug']['LOGGING'] = $sql;
		@$this->mysqli->query( $sql );
		return $this->service_id;
	}
	
	public function archive_listing() {
		if( !$this->service_id ) {
			$this->message = 'ERROR: Unable to determine database ID.';
			return false;
		}
		$sql = 'UPDATE ' . SERVICE_INFO_TABLE . ' SET modifiedBy = "' . $_SESSION['usr_id'] . '", status = "Archive" WHERE ID = ' . $this->service_id;
		$_SESSION['debug']['UPDATE'] .= $sql.'<br>';
		$rs = $this->mysqli->query( $sql );
		//$rs->free();
		$sql = "INSERT INTO " . LOGGING_TABLE . " (serviceID,userID,action,detail) VALUES (" . $this->service_id . "," . $_SESSION['usr_id'] . ",'ARCHIVE','" . $sql . "')";
		$_SESSION['debug']['LOGGING'] = $sql;
		@$this->mysqli->query( $sql );
		return $this->service_id;
	}
	
	public function unarchive_listing() {
		if( !$this->service_id ) {
			$this->message = 'ERROR: Unable to determine database ID.';
			return false;
		}
		$sql = 'UPDATE ' . SERVICE_INFO_TABLE . ' SET modifiedBy = "' . $_SESSION['usr_id'] . '", status = "Active" WHERE ID = ' . $this->service_id;
		$_SESSION['debug']['UPDATE'] .= $sql.'<br>';
		$rs = $this->mysqli->query( $sql );
		//$rs->free();
		$sql = "INSERT INTO " . LOGGING_TABLE . " (serviceID,userID,action,detail) VALUES (" . $this->service_id . "," . $_SESSION['usr_id'] . ",'UNARCHIVE','" . $sql . "')";
		$_SESSION['debug']['LOGGING'] = $sql;
		@$this->mysqli->query( $sql );
		return $this->service_id;
	}
	
	public function delete_listing() {
		if( !$this->service_id ) {
			$this->message = 'ERROR: Unable to determine database ID.';
			return false;
		}
		$sql = 'DELETE FROM ' . SERVICE_INFO_TABLE . ' WHERE ID = ' . $this->service_id;
		$logging = $sql."\r\n";
		$rs = $this->mysqli->query( $sql );
		//$rs->free();
		$sql = 'DELETE FROM ' . SERVICE_FLOWERS_TABLE . ' WHERE serviceID = ' . $this->service_id;
		$logging .= $sql."\r\n";
		$rs = $this->mysqli->query( $sql );
		//$rs->free();
		$sql = 'DELETE FROM ' . SERVICE_PICKUP_TABLE . ' WHERE serviceID = ' . $this->service_id;
		$logging .= $sql;
		$rs = $this->mysqli->query( $sql );
		//$rs->free();
		$sql = "INSERT INTO " . LOGGING_TABLE . " (serviceID,userID,action,detail) VALUES (" . $this->service_id . "," . $_SESSION['usr_id'] . ",'DELETE','" . $logging . "')";
		$_SESSION['debug']['LOGGING'] = $sql;
		@$this->mysqli->query( $sql );
		return true;
	}
	
	public function get_results( $search_str ) {
		$search_arr = explode( ' ', $search_str );
		foreach( $search_arr as $key => $val ) {
			$search_arr[$key] .= '*';
		}
		$search = implode( ' ', $search_arr );
		$date_search = false;
		if(( $timestamp = strtotime( $search_str ) ) !== false ) {
			$date_search = date( "Y-m-d", $timestamp );
			$sql = "SELECT ID, status, firstName, lastName, dateTime FROM " . SERVICE_INFO_TABLE . " WHERE dateTime LIKE '" . $date_search . "%'";
		} else {
			$sql = "SELECT ID, status, firstName, lastName, dateTime, MATCH(firstName,lastName) AGAINST ('" . $search . "' IN BOOLEAN MODE) as Relevance FROM " . SERVICE_INFO_TABLE . " WHERE MATCH(firstName,lastName) AGAINST('" . $search . "' IN BOOLEAN MODE) HAVING Relevance >= 1 ORDER BY Relevance DESC";
		}
		$_SESSION['debug']['RESULTS'] = $sql;
		$rs = $this->mysqli->query( $sql );
		while( $row = @$rs->fetch_assoc() ) {
			$arr[$row['ID']] = $row;
		}
		$rs->free();
		return $arr;
	}
	
}
?>