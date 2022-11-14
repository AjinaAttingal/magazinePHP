<?php
include("../../connection/db_conn.php");
error_reporting(0);
session_start();   


$sql = "DELETE FROM feedback WHERE feed_id='".$_GET['feed_del']."'";
mysqli_query($conn, $sql);
header("location:feedback.php");
?>