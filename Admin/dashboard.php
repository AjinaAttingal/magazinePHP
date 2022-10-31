<!DOCTYPE html>
<html lang="en">
    <?php
    include("../connection/db_conn.php");
    error_reporting(0);
    session_start();        

    if(isset($_POST['submit'] ))
{
    if(empty($_POST['name']))
    {
      $filename = $_FILES["choosefile"]["name"];

      $tempname = $_FILES["choosefile"]["tmp_name"];  
  
          $folder = "img/".$filename;   
          // query to update the submitted data
  
          $sql = "update login set photo='$filename' where id=$_session[id]";
  
          // function to execute above query
  
          mysqli_query($db, $sql);       
  
          // Add the image to the "image" folder"
  
          if (move_uploaded_file($tempname, $folder)) {
  
              $msg = "Image uploaded successfully";
  
          }else{
  
              $msg = "Failed to upload image";
  
      }
  
  $result = mysqli_query($conn, "SELECT * FROM login");
  
  
      $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
    }
  else
  {
  $sql = "update login set name ='$_POST[name]',email='$_POST[email]',phone='$_POST[phone]',dob='$_POST[dob]',gender='$_POST[gender]' where username='$_SESSION[username]'";
  mysqli_query($conn, $sql);
      $success =  '<div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Updated!</strong> Successfully.</br></div>';
  
    
  }

}
elseif(isset($_POST['cancel']))
{
    header("Location:index.html");
}
    ?> 
