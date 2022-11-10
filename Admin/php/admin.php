<?php
session_start();
include('../connection/db_conn.php');

if(isset($_POST['submit']))
{
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else if(isset($_POST['uname']))
    {
    if(($uname=='admin'))
    {
        $sql = "SELECT * FROM users WHERE username = 'admin'";
        $result=mysqli_query($conn,$sql);
        while($rows=mysqli_fetch_array($result))
        {
            $username =  $rows['username'];
            $password =  $rows['password'];
            $fname =  $rows['fname'];
            $id =  $rows['id'];
            $pp =  $rows['pp'];

            if($username === $uname)
            {
                if(password_verify($pass, $password))
                {
                    $_SESSION['id'] = $id;
                    $_SESSION['fname'] = $fname;
                    $_SESSION['pp'] = $pp;

                    header("Location: ../home.php");
                    exit;
                }
                else {
                    $em = "Incorect User name or password";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                 }
            }
            else {
                $em = "Incorect User name or password";
                header("Location: ../login.php?error=$em&$data");
                exit;
            }
        }
    }
    else
    {
        $sql = "SELECT * FROM users WHERE username = '$uname' and status='1'";
        $rows=mysqli_query($conn,$sql);
        while(mysqli_fetch_array($rows))
        {
            $username =  $rows['username'];
            $password =  $rows['password'];
            $fname =  $rows['fname'];
            $id =  $rows['id'];
            $pp =  $rows['pp'];

            if($username === $uname)
            {
                if(password_verify($pass, $password)){
                    $_SESSION['id'] = $id;
                    $_SESSION['fname'] = $fname;
                    $_SESSION['pp'] = $pp;

                    header("Location: ../user.php");
                    exit;
                }
                else {
                    $em = "Incorect User name or password";
                    header("Location: ../login.php?error=$em&$data");
                    exit;
                 }
            } else {
                $em = "Incorect User name or password";
                header("Location: ../login.php?error=$em&$data");
                exit;
             }
        }
    }
}
}
else
{
    header("Location: ../login.php?error=error");
	exit;
}
?>