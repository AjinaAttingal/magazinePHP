
<?php
include("../cofig.php");
error_reporting(0);
session_start();


if(isset($_POST['submit'] ))
{
    if(empty($_POST['category_name']))
    {
      $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
    }
  else
  {
    
  
  
  
       
  
  $sql = "update category set category_name ='$_POST[category_name]' where category_id='$_GET[cat_upd]'";
  mysqli_query($conn, $sql);
      $success =  '<div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Updated!</strong> Successfully.</br></div>';
  
    
  }

}


?>
