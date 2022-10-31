<?php
            include("connection/db_conn.php");
            if(isset($_POST['login']))
            {
               
            $Uname=$_POST['name'];
            $Pass=$_POST['password'];

           // $username = mysqli_query($mysqli, "SELECT name FROM login ");
            //$password= mysqli_query($mysqli, "SELECT password FROM login ");
            

            $sql = "SELECT * FROM login WHERE username='$Uname' and password='$Pass'";
			
			$result=mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;
       $_POST['id']=$id;
				header("Location: Admin/index.html");
       

			}else{
				echo ("<script LANGUAGE='JavaScript'>
						window.alert('Invalied Login...');
						window.location.href='login.php';
					   </script>");
                 }  
            } 
              ?>   
                       

