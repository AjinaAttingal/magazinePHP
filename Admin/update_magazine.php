<!DOCTYPE html>
<html lang="en">
<?php
    include("../connection/db_conn.php");
    error_reporting(0);
    session_start();
    /*if($_SESSION['uname'] != 'admin'){
          header("location:login.php");
          die();
       }*/
    if(isset($_POST['submit'] ))
    {
      if(empty($_POST['mag_name']))
          {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
        }
       
        else
            {
                        $fname =  $_FILES["mag_image"]["name"];
                        $temp = $_FILES["mag_image"]["tmp_name"];
                        
                        $fsize = $_FILES['mag_image']['size'];
                        $extension = explode('.',$fname);
                        $extension = strtolower(end($extension));  
                        $fnew = uniqid().'.'.$extension;
                        
                        $store = "img/Magazine/".$fname;                    
                    if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' )
                    {        
                        if($fsize>=100000000)
                        {
                        $error =  '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Max Image Size is 1024kb!</strong> Try different Image.
                                    </div>';
                        }/*
                        else
                        {*/
                                    $pname =  $_FILES["mag_file"]["name"];
                                    $ptemp = $_FILES["mag_file"]["tmp_name"];
                                    
                                    $psize = $_FILES['mag_file']['size'];
                                    $extension = explode('.',$pname);
                                    $extension = strtolower(end($extension));  
                                    $pnew = uniqid().'.'.$extension;
                                    
                                    $pstore = "img/Files/".$pname;                    
                            if($extension == 'pdf')
                            {        
                                if($fsize>=100000000)
                                {
                                $error =  '<div class="alert alert-danger alert-dismissible fade show">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <strong>Max Pdf Size is 1024kb!</strong> Try different Image.
                                            </div>';
                                 }
           

        else{
            $sql = "update magazine set mag_name ='$_POST[mag_name]',mag_img='$fname',mag_cat_name='$_POST[category_name]',mag_file='$pname'  where mag_id='$_GET[mag_upd]'";
             mysqli_query($conn, $sql);
             move_uploaded_file($temp,$store);
            move_uploaded_file($ptemp,$pstore);
             $success =  '<div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Updated!</strong> Successfully.</br></div>';
                               //echo $success;
                               //echo '<script>alert("Messege")</script>';
                              // header("location:magazine.php");
                              //redirect('magazine.php');
                              echo "<script> alert('Updated Successfully...!'); window.location.href='magazine.php';</script>";
  
          }
        }
          elseif($extension==" ")
          {
              $error='<div class="alert alert-danger alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Invalid extention!</strong> Try different Pdf.
                      </div>';
                      echo "<script> alert('Updation failed...!Try different Pdf'); window.location.href='magazine.php';</script>";
  
          }
            elseif($extension==" ")
            {
            $error='<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid extention!</strong> Try different Image.
                    </div>';
                    echo "<script> alert('Updation failed...!Try different Image.'); window.location.href='magazine.php';</script>";
  
            }
                    }
                    }
      }
     ?>
<head>
    <meta charset="utf-8">
    <title>Magazine - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Magazine</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="home.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            
                    <a href="category.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Category</a>
                    <a href="magazine.php" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Magazine</a>
                    <a href="feedback.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Feedback</a>
                    <a href="ads.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Ads</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">

                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="home.php" class="dropdown-item">My Profile</a>
                            <!-- <a href="#" class="dropdown-item">Settings</a> -->  
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <?php  
             echo $error;
            //echo $success; ?>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6" style="width: 100%;">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Edit Magazine</h6>

                            <?php
                                    $sql="SELECT * FROM magazine where mag_id='$_GET[mag_upd]'";
                                    $query=mysqli_query($conn,$sql);
                                    $rows=mysqli_fetch_array($query);?>

                            <div class="card-body">
                                <form method=POST action=""  enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="mag_name" class="form-control" value="<?php echo $rows['mag_name']?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="mag_image"  id="lastName" class="form-control bg-dark" placeholder="12n" value="<?php echo 'img/Magazine/'.$rows['mag_img']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Category Name</label>
                                                    <input type="text" name="sub_category_name" class="form-control" >
                                                </div>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Select Category</label>
                                                    <select name="category_name" class="form-control bg-dark"  data-placeholder="Choose a Category" tabindex="1">
                                                       <option><?php echo $rows['mag_cat_name']?></option>
                                                       
                                         
                                                      <?php $ssql ="select * from category";
                                                        $res=mysqli_query($conn, $ssql); 
                                                        while($row=mysqli_fetch_array($res))  
                                                        {
                                                          echo' <option value="'.$row['cat_name'].'">'.$row['cat_name'].'</option>';;
                                                        }  
                                                                               
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="control-label">Upload file</label>
                                                    <input type="file" name="mag_file"  id="lName" class="form-control bg-dark" placeholder="12n" value="<?php echo 'img/Files/'.$rows['mag_file']?>">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-actions" style="margin-left: 85%; margin-top: 20px;">
                                    <button class="btn btn-primary" name="submit">Update</button> 
                                    <a href="magazine.php" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Magazine</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="magazinePHP/Admin/index.html">php code</a>
                            <br>Distributed By: <a href="https://www.essbeeinfotech.com/" target="_blank">ESSBEE INFOTECH</a>
                        </div>
                    </div>
                </div>
            </div>
                 <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>