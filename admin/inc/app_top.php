<?
/* Start Session */
 @session_start();
 unset( $_SESSION['debug'] );

/* Autoload function for classes */
 function __autoload($class) {
     $filename = $_SERVER['DOCUMENT_ROOT'] . '/admin/classes/class.' . strtolower($class) . '.php';
     if ( file_exists($filename)) {
         include_once($filename);
     }
 }

/* Load Variables */
 require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/tables.php';
 include $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/common.php';
 include $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/session_vars.php';

/* Load platform */
 $platform = new Platform();

/* Load DB */
 require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/inc/db.php';
 $database = new Database($db, $platform->environment);
 $mysqli = $database->connect();

?>