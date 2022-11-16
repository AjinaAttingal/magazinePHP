<?php
include("../connection/db_conn.php");
error_reporting(0);
session_start();   


$sql = "DELETE FROM magazine WHERE mag_id='".$_GET['mag_del']."'";
mysqli_query($conn, $sql);
header("location:magazine.php");
?>