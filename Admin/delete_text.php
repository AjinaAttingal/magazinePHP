<?php
include("../connection/db_conn.php");
error_reporting(0);
session_start();   


$sql = "DELETE FROM contents WHERE id='".$_GET['text_del']."'";
mysqli_query($conn, $sql);
header("location:text.php");
?>