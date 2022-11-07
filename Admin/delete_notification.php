<?php
include("../connection/db_conn.php");
error_reporting(0);
session_start();   


$sql = "DELETE FROM users WHERE id='".$_GET['sts_del']."'";
mysqli_query($conn, $sql);
header("location:notification.php");
?>