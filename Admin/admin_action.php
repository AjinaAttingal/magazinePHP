<?php
    include("../connection/db_conn.php");
    error_reporting(0);
    session_start();
   
	if(isset($_POST['submit']))
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
			$sql = "SELECT * FROM `login` WHERE username='$username' and password='$password'";
			
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				header("Location: index.php");
			}else{
				echo ("<script LANGUAGE='JavaScript'>
						window.alert('Invalied Login...');
						window.location.href='index.php';
					   </script>");
			}
		}
		
?>
	