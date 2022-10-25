
<?php
include("../connection/db_conn.php");
error_reporting(0);
session_start();   


$sql = "DELETE FROM category WHERE cat_id='".$_GET['cat_del']."'";
mysqli_query($conn, $sql);
header("location:category.php");
?>