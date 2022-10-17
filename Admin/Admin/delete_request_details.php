<?php
include("connection/db_conn.php");
error_reporting(0);
session_start();
if($_SESSION['username'] != 'admin'){
      header("location:login.php");
      die();
   }

mysqli_query($conn,"DELETE FROM request_details WHERE rd_id = '".$_GET['rd_del']."'");
header("location:request_details.php");  

?>
