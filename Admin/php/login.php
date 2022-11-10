<?php 
session_start();

if(isset($_POST['uname']) && 
   isset($_POST['pass'])){

    include("../connection/db_conn.php");

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=".$uname;
    
    if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else {

    	$sql = "SELECT * FROM users WHERE username = ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$uname]);


      if($stmt->rowCount() == 1){
          $user = $stmt->fetch();
          

          $username =  $user['username'];
          $password =  $user['password'];
          $fname =  $user['fname'];
          $id =  $user['id'];
          $pp =  $user['pp'];
         $status=$user['status'];

          if($username === $uname){
             if(password_verify($pass, $password))
             {
               if($status=='1'){
                 $_SESSION['id'] = $id;
                 $_SESSION['fname'] = $fname;
                 $_SESSION['pp'] = $pp;
                 header("Location: ../user_profile.php");
                 exit;
               }else if($status=='0'){
                  $_SESSION['id'] = $id;
                  $_SESSION['fname'] = $fname;
                  $_SESSION['pp'] = $pp;
                 header("Location: ../home.php");
                 exit;
             }else {
               $em = "Not approved!!!";
               header("Location: ../login.php?error=$em&$data");
               exit;}

            }else {
               $em = "Incorect User name or password";
               header("Location: ../login.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect User name or password";
            header("Location: ../login.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect User name or password";
         header("Location: ../login.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../login.php?error=$em&$data");
	exit;
}
