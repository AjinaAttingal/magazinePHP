<?php
include("connection/db_conn.php");
error_reporting(0);
session_start();
if($_SESSION['username'] != 'admin'){
      header("location:login.php");
      die();
   }

mysqli_query($conn,"DELETE FROM category WHERE category_id = '".$_GET['cat_del']."'");
header("location:category.php");  

?>
