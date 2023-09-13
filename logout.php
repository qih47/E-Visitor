<?php  
 //logout.php  
 session_start();  
 session_destroy();

require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';

$delete = $database->deleteSessionsWithToken();
if ($delete > 0) {
    header('location:?hal=login');  
} else {
    header('location:?hal=login');  
}
