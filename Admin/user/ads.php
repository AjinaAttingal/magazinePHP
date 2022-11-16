<!DOCTYPE html>
<html lang="en">
    <?php
    include("../../connection/db_conn.php");
    error_reporting(0);
    session_start();
    /*if($_SESSION['uname'] != 'admin'){
          header("location:login.php");
          die();
       }*/
    if(isset($_POST['submit'] ))
    {
      if(empty($_POST['ad_name']))
            {
              $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
            }
      else
          {
              
            $check_mag= mysqli_query($conn, "SELECT ad_name FROM ads where ad_name = '".$_POST['ad_name']."' "); 
            if(mysqli_num_rows($check_mag) > 0)
                {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <strong>Magazine already exist!</strong>
                                    </div>';
                }
            else
                {
                    /*$filename=$_FILES["choosefile"]["name"];
                    $tempname=$_FILES["choosefile"]["tmp_name"];
                    $folder="Upload/".$filename;*/
              
                    $fname = $_FILES["ad_image"]["name"];
                    $temp = $_FILES["ad_image"]["tmp_name"];
                  
                    $fsize = $_FILES['ad_image']['size'];
                    $extension = explode('.',$fname);
                    $extension = strtolower(end($extension));
                    $fnew = uniqid().'.'.$extension;
                    
                    $store = "../img/Ads/".$fname;                    
                    if($extension== 'jpg'||$extension == 'png'||$extension == 'gif' )
                    {        
                        if($fsize>=100000000)
                        {
                        $error =  '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Max Image Size is 1024kb!</strong> Try different Image.
                                    </div>';
                        }
                    else
                    {
                        $sql = "INSERT INTO ads(ad_name,ad_img,ad_address,ad_description,ad_contact) VALUES('".$_POST['ad_name']."','".$fname."','".$_POST['ad_address']."','".$_POST['ad_description']."','".$_POST['ad_contact']."')";
                        mysqli_query($conn, $sql);
                        move_uploaded_file($temp,$store);
                        $success =  '<div class="alert alert-success alert-dismissible fade show">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                New Ads Added Successfully.</br></div>';
                    }
                
                }
                elseif($extension==" ")
                {
                    $error='<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Invalid extention!</strong> Try different Image.
                            </div>';
                }
            }
         }
        }
                        
    ?> 
<head>
    <meta charset="utf-8">
    <title>MAgazine - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
   
          <!--  <script type="text/javascript">
             function confirmationDelete(x){
                var conf = confirm("Are you sure you want to delete this?");
            if(conf == true){
                alert("OK... you chose to proceed with deletion of "+x);
            }
        }
        </script>-->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
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
                <a href="user_form.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Magazine</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../upload/<?=$_SESSION['pp']?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?=$_SESSION['fname']?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="user_profile.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            
                    <a href="category.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Category</a>
                    <a href="magazine.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Magazine</a>
                    <a href="feedback.php" class="nav-item nav-link "><i class="fa fa-keyboard me-2"></i>Feedback</a>
                    <a href="ads.php" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Ads</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="user_form.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <!--<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>-->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../upload/<?=$_SESSION['pp']?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?=$_SESSION['fname']?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="user_profile.php" class="dropdown-item">My Profile</a>
                            <!--<a href="#" class="dropdown-item">Settings</a>-->
                            <a href="../logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <?php  
              echo $error;
              echo $success; ?>

            <!-- Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6" style="width: 100%;">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Ads Department</h6>
                            <form method=POST action="#" enctype="multipart/form-data">
                                <div class="d-flex align-items-center" style="margin-top: 50px;">
                                    <!--<img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">-->
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="control-label">Name</label>&nbsp
                                            <input type="text" name="ad_name" class="form-control" style="margin-left: 40px;">
                                            <!--<h6 class="mb-0">Jhon Doe</h6>
                                            <small>15 minutes ago</small>-->
                                        </div>
                                    </div>
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="control-label">Address</label>&nbsp
                                            <input type="text" name="ad_address" class="form-control" >
                                            <!--<h6 class="mb-0">Jhon Doe</h6>
                                            <small>15 minutes ago</small>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center" style="margin-top: 50px;">
                                    <!--<img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">-->
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="control-label">Description</label>&nbsp
                                            <input type="text" name="ad_description" class="form-control" >
                                            <!--<h6 class="mb-0">Jhon Doe</h6>
                                            <small>15 minutes ago</small>-->
                                        </div>
                                    </div>
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="control-label">Contact</label>&nbsp
                                            <input type="text" name="ad_contact" class="form-control" >
                                            <!--<h6 class="mb-0">Jhon Doe</h6>
                                            <small>15 minutes ago</small>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center" style="margin-top: 50px;">
                                    <!--<img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">-->
                                    <div class="w-100 ms-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <label class="control-label">Image</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                            <input type="file" name="ad_image" class="form-control bg-dark" >
                                            <!--<h6 class="mb-0">Jhon Doe</h6>
                                            <small>15 minutes ago</small>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions" style="margin-left: 85%; margin-top: 20px;">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save"> 
                                    <!--<a href="ads.php" class="btn btn-inverse">Cancel</a>-->
                                </div>
                            </form>
                        </div>
                    </div>
                    
<!--view-->
                    <div class="container-fluid pt-4 px-4" >
                        <div class="row g-4">
                            <div class="col-sm-12 col-md-6 col-xl-4" style="width: 100%;">
                                <div class="h-100 bg-secondary rounded p-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0">Ads</h6>
                                        
                                    </div>
                                    <div class="table-responsive m-t-40">
                                      <table id="myTable" class="table table-bordered table-hover table-striped">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th>Ads id</th>
                                            <th>Ads Name</th>
                                            <th>Image</th>
                                            <th>Ads Address</th>
                                            <th>Ads Description</th>
                                            <th>Contact No.</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          
        <!--view-->      
                                 <?php
                                    $sql="SELECT * FROM ads order by ad_id desc";
                                $query=mysqli_query($conn,$sql);
                                if(!mysqli_num_rows($query) > 0 )
                                  {
                                    echo '<td colspan="7"><center>No Ads-Data!</center></td>';
                                  }
                                else
                                  {       
                                    while($rows=mysqli_fetch_array($query))
                                    {
                                        
                                     echo ' <tr><td>'.$rows['ad_id'].'</td>
                                            <td>'.$rows['ad_name'].'</td>
                                   
                                            <td><img src="../img/Ads/'.$rows['ad_img'].'" height="50" width="50"></td>
                                            <td>'.$rows['ad_address'].'</td>
                                            <td>'.$rows['ad_description'].'</td>
                                            <td>'.$rows['ad_contact'].'</td>';
                                            
                                         echo   "<td><a  onClick=\"javascript:return confirm('Do you wants to delete this?');\"href='delete_ads.php?ads_del=".$rows['ad_id'].  "class='btn btn-danger btn-flat btn-addon btn-xs m-b-10' ><i class='fa fa-trash' style='font-size:25px'></i></a>"; 
                                         echo  ' <a href="update_ads.php?ads_upd='.$rows['ad_id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                            </td></tr>';
                                      } 
                                  }
                                  ?>

        
        
        
        
        
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
        
                </div>
            </div>
            <!-- Chart End -->


            <!-- Footer Start -->
            
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>