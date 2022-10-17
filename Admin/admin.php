

            <?php
            include("../config.php");
            if(isset($_POST['login']))
            {
               
            $Uname=$_POST['username'];
            $Pass=$_POST['password'];

            $username = mysqli_query($mysqli, "SELECT name FROM login ");
            $password= mysqli_query($mysqli, "SELECT password FROM login ");
            

             
                if(($Uname= $username)&&($Pass=$password))
                 {
                    header("Location:profile.html");
                 } 
                 else
                 {
                    echo "incorrect id or password";
                 }  
            } 
              ?>   
                       
          