<!DOCTYPE html>
<html>

<?php
    include("../connection/db_conn.php");
    error_reporting(0);
    session_start();        

     if(isset($_POST['submit'] ))
    {
      if(empty($_POST['p_name']))
            {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
            }
     
			$fname =  $_FILES['ad_image']['name'];
			$temp = $_FILES['ad_image']['tmp_name'];
			$fsize = $_FILES['ad_image']['size'];
			$extension = explode('.',$fname);
			$extension = strtolower(end($extension));  
			$fnew = uniqid().'.'.$extension;
			$store = "../Upload/ads/".basename($fnew);                    
		if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' )
		{        
			if($fsize>=100000000)
			{
			$error =  '<div class="alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Max Image Size is 1024kb!</strong> Try different Image.
						</div>';
			}}
   
      	else  {
            $sql = "INSERT INTO dashboard(dash_image,dash_name,dash_email,dash_password) VALUES('".$fnew."','".$_POST['p_name']."','".$_POST['p_email']."','".$_POST['p_pass']."')";
            mysqli_query($conn, $sql);
            $success =  '<div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    New Admin Added Successfully.</br></div>';
             }
			
    }
	elseif(isset($_POST['cancel']))
	{
	
	}
    ?> 

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Advanced CSS Effected</title>
	<link rel="stylesheet" type="text/css" href="css/css/profilestyles.css">
</head>
<body>
	<center>
	<?php echo $error;
			//echo $success;
			?>

	<form method="post" action="">
			<div class="box">
				<img src="aljo.jpg">
				<input type="file" name="p_img" id="file" accept="image/*">
				<label for="file">Upload Profile</label>
				<input type="text" name="p_name" placeholder="User Name">
				<input type="email" name="p_email" placeholder="Email ID">
				<input type="text" name="p_pass" placeholder="Password">
			<!--	<input type="text" name="" placeholder="Date of Birth">
				<input type="text" name="" placeholder="Gender">-->
				<button id="btn" name="cancel">Cancel</button>
				<button id="btn1" name="submit">Done</button>
			</div>
		
		</form>
	</center>
	
</body>
</html>