<?php
            include("../config.php");
            if(isset($_POST['login']))
            {
               
            $Uname=$_POST['user_name'];
            $Pass=$_POST['password'];

           // $username = mysqli_query($mysqli, "SELECT name FROM login ");
            //$password= mysqli_query($mysqli, "SELECT password FROM login ");
            

            $sql = "SELECT * FROM login WHERE name='$Uname' and password='$Pass'";
			
			$result=mysqli_query($mysqli,$sql);
			if(mysqli_num_rows($result) > 0){
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
				header("Location: demo.html");
			}else{
				echo ("<script LANGUAGE='JavaScript'>
						window.alert('Invalied Login...');
						window.location.href='login.php';
					   </script>");
                 }  
            } 
              ?>   
                       
