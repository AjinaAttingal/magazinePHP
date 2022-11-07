<?php
    include("../connection/db_conn.php");
    error_reporting(0);
    session_start();        
    /*if($_SESSION['uname'] != 'admin'){
          header("location:login.php");
          die();
       }*/
       $sql = "update users set status ='1' where id='$_GET[sts_upd]'";
       mysqli_query($conn, $sql);
       echo "<script> alert('Updated Successfully...!'); window.location.href='notification.php';</script>";
       ?>