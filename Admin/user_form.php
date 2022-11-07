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
      if(empty($_POST['fname']))
        {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
                              header("Location: user_form.php?error=$error");
                             // echo $error;

        }
        else if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
         
            $img_name = $_FILES['pp']['name'];
            $tmp_name = $_FILES['pp']['tmp_name'];
            $error = $_FILES['pp']['error'];
            
            if($error === 0)
            {
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
               $img_ex_to_lc = strtolower($img_ex);
   
               $allowed_exs = array('jpg', 'jpeg', 'png');
               if(in_array($img_ex_to_lc, $allowed_exs))
               {
                  $new_img_name = uniqid($uname, true).'.'.$img_ex_to_lc;
                  $img_upload_path = 'upload/'.$new_img_name;
                  move_uploaded_file($tmp_name, $img_upload_path);
   
                  // Insert into Database
                  $sql = "Insert into users(fname,username,password,pp) values('".$_POST['fname']."','".$_POST['uname']."','".$_POST['pass']."','".$new_img_name."')";
                
                  //$stmt = $conn->prepare($sql);
                 // $stmt->execute([$fname, $uname, $pass, $new_img_name]);
   
                  header("Location: login.php?success=Your account has been registered successfully");
                  //echo "<script> alert('Your account has been edited successfully...!'); window.location.href='home.php';</script>";

                   exit;
               }else 
                {
                  $em = "You can't upload files of this type";
                  header("Location: user_form.php?error=$em&$data");
                 // echo "<script> alert('You can't upload files of this type...!'); window.location.href='home.php';</script>";

                  exit;
                 }
            }else 
            {
               $em = "unknown error occurred!";
               header("Location: user_form.php?error=$em&$data");
//echo "<script> alert('unknown error occurred...!'); window.location.href='home.php';</script>";
               exit;
            }
   
           
         }else {
            $sql = "Insert into users(fname,username,password) values('".$_POST['fname']."','".$_POST['uname']."','".$_POST['pass']."')";
            // $stmt = $conn->prepare($sql);
             // $stmt->execute([$fname, $uname, $pass]);
              mysqli_query($conn, $sql);
              header("Location: login.php?success=Your account has been registered successfully");
             // echo "<script> alert('Updated Successfully...!'); window.location.href='home.php';</script>";
              exit;
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
    <link href="style/css/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="style/css/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/css/css/styles.css">
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
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Magazine</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="upload/default-pp.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"></h6>
                        <span>USER</span>
                    </div>
                </div>

                <!--<div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="category.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Category</a>
                    <a href="magazine.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Magazine</a>
                    <a href="feedback.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Feedback</a>
                    <a href="ads.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Ads</a>
                </div>-->
            </nav>
        </div>
        <!-- Sidebar End -->


                <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
              <!--  <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>-->
                <div class="navbar-nav align-items-center ms-auto">

                <div class="nav-item dropdown">
                       <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"></span>
                        </a>-->
                 <!--       <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                           <a href="profile1.html" class="dropdown-item">My Profile</a>--> 
                           <!-- <a href="#" class="dropdown-item">Settings</a> 
                            <a href="logout.php" class="dropdown-item">Log Out</a>
                        </div>-->
                    </div>
                </div>
            </nav>

            
            <center>
                <form class="shadow w-450 p-3" action="" method="post" enctype="multipart/form-data">
                    <div style="margin-top: 60px;">
                        <h4 class="display-4  fs-1">Create Profile</h4><br>
                        already have an account !<a href="login.php" style="color: white;">Login</a></button><br><br>
                        <?php if(isset($_GET['error'])){ ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $_GET['error']; ?>
                        </div>
                        <?php } ?>

                        <?php if(isset($_GET['success'])){ ?>
                        <div class="alert alert-success" role="alert">
                          <?php echo $_GET['success']; ?>
                        </div>
                        <?php } ?>
                        <input type="file" name="pp" id="file" accept="image/*">
                        <label for="file">Upload pic </label><br><br>
                        <input type="text" class="form-control" placeholder="First Name" name="fname" value="<?php echo $_GET['fname'];?> ">
                        <input type="text" class="form-control" placeholder="User Name" name="uname" value="<?php //echo $_GET['name_upd'];?>">
                        <input type="text" class="form-control" placeholder="Password" name="pass">

                        <!--<input type="text" name="" placeholder="Date of Birth">
                        <input type="text" name="" placeholder="Gender">-->
                       
                        <button id="btn1" type="submit" name="submit">Confirm</button>
                    </div>
                </form>
            </center>
            
           
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