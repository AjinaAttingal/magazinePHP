<?php
include("../connection/db_conn.php");
error_reporting(0);
session_start();   


$sql = "DELETE FROM ads WHERE ad_id='".$_GET['ads_del']."'";
mysqli_query($conn, $sql);
header("location:ads.php");
?>