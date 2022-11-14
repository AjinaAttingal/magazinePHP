<!DOCTYPE html>
<html lang="en">
<?php
    include("../connection/db_conn.php");
    error_reporting(0);
    session_start();
    // Insert record
        if(isset($_POST['submit'])){

            if(empty($_POST['title']))
            {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>field Required!</strong>
                              </div>';
            }
      else
          
            {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <strong>Magazine already exist!</strong>
                                    </div>';
            
                        $fname =  $_FILES["image"]["name"];
                        $temp = $_FILES["image"]["tmp_name"];
                        
                        $fsize = $_FILES['image']['size'];
                        $extension = explode('.',$fname);
                        $extension = strtolower(end($extension));  
                        $fnew = uniqid().'.'.$extension;
                        
                        $store = "img/Text/".$fname;                    
                    if($extension == 'jpg'||$extension == 'png'||$extension == 'gif' )
                    {        
                        if($fsize>=100000000)
                        {
                        $error =  '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Max Image Size is 1024kb!</strong> Try different Image.
                                    </div>';
                        }

                      $title = $_POST['title'];
                      $short_desc = $_POST['short_desc'];
                      $long_desc = $_POST['long_desc'];
                      $edition = $_POST['edition'];
                      $author = $_POST['author'];
                      $publisher = $_POST['publisher'];
                      $isbn = $_POST['isbn'];

                      if($title != ''){

                        mysqli_query($conn, "INSERT INTO contents(title,short_desc,long_desc,image,edition,author,publisher,isbn) VALUES('".$title."','".$short_desc."','".$long_desc."','".$fname."','".$edition."','".$author."','".$publisher."','".$isbn."') ");
                        header('location: text.php');
                        move_uploaded_file($temp,$store);
                      }
                     
                       
                      
                    }
                }
            }

    /*if($_SESSION['uname'] != 'admin'){
          header("location:login.php");
          die();
       }*/
    /*if(isset($_POST['submit'] ))
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
              
            $check_mag= mysqli_query($conn, "SELECT mag_name FROM magazine where mag_name = '".$_POST['mag_name']."' "); 
            if(mysqli_num_rows($check_mag) > 0)
            {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <strong>Magazine already exist!</strong>
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
                        }
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
                                else
                                {
                                $sql = "INSERT INTO magazine(mag_name,mag_img,mag_cat_name,mag_file) VALUES('".$_POST['mag_name']."','".$fname."','".$_POST['category_name']."','".$pname."')";
                                mysqli_query($conn, $sql);
                                move_uploaded_file($temp,$store);
                                move_uploaded_file($ptemp,$pstore);
                                $success =  '<div class="alert alert-success alert-dismissible fade show">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        New Magazine Added Successfully.</br></div>';
                                }
                            }
                            elseif($extension==" ")
                            {
                                $error='<div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Invalid extention!</strong> Try different Pdf.
                                        </div>';
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
    }*/
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
            echo $success; ?>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6" style="width: 100%;">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Add Magazine</h6>
                            <div class="card-body">
                                <!--<form method='post' action=''>
                                   Title : 
                                   <input type="text" name="title" ><br>
                                   <input type="file" name="file"><br>
                                   Short Description: 
                                   <textarea id='short_desc' name='short_desc'>       </textarea><br>

                                   Long Description: 
                                   <textarea id='long_desc' name='long_desc' ></textarea><br>

                                   <input type="submit" name="submit" value="Submit">
                                </form>-->


                                <form method=POST action=""  enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="title" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Short Description</label>
                                                    <input type="text" name="short_desc" class="form-control" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Edition</label>
                                                    <input type="text" name="edition" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" name="image"  id="lastName" class="form-control bg-dark" placeholder="12n">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Author</label>
                                                    <input type="text" name="author" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Publisher</label>
                                                    <input type="text" name="publisher" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">ISBN Number</label>
                                                    <input type="text" name="isbn" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    Long Description: 
                                                    <textarea id='long_desc' name='long_desc' ></textarea>
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
                                        <!--<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Select Category</label>
                                                    <select name="category_name" class="form-control bg-dark" data-placeholder="Choose a Category" tabindex="1">
                                                       <option>--Select Category--</option>-->
                                                       
                                         
                                                      <?php /*$ssql ="select * from category";
                                                        $res=mysqli_query($conn, $ssql); 
                                                        while($row=mysqli_fetch_array($res))  
                                                        {
                                                          echo' <option value="'.$row['cat_name'].'">'.$row['cat_name'].'</option>';;
                                                        }*/  
                                                                               
                                                        ?> 
                                                    <!--</select>
                                                </div>
                                            </div>-->
                                        <!--<div class="col-md-6">
                                                <div class="form-group ">
                                                    <label class="control-label">Upload file</label>
                                                    <input type="file" name="mag_file"  id="lName" class="form-control bg-dark" placeholder="12n">
                                                </div>
                                            </div>
                                        </div>-->
                                    <div class="form-actions" style="margin-left: 95%; margin-top: 20px;">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             <div class="container-fluid pt-4 px-4" >
                <div class="row g-4">
                    
                        
                    <div class="col-sm-12 col-md-6 col-xl-4" style="width: 100%;">

                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Magazine Details</h6>       
                            </div>

                            <div class="table-responsive m-t-40">
                                <div style="border:1px solid green; ">
                            <?php
                            include_once("../connection/db_conn.php");
                            $showRecordPerPage = 10;
                            if(isset($_GET['page']) && !empty($_GET['page'])){
                                $currentPage = $_GET['page'];
                            }else{
                                $currentPage = 1;
                            }
                            $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                            $total = "SELECT * FROM contents where status=0";
                            $allResult = mysqli_query($conn, $total);
                            $totalAll = mysqli_num_rows($allResult);
                            $lastPage = ceil($totalAll/$showRecordPerPage);
                            $firstPage = 1;
                            $nextPage = $currentPage + 1;
                            $previousPage = $currentPage - 1;
                            $query = "SELECT * FROM `contents` where status=0 LIMIT $startFrom, $showRecordPerPage";
                            $Result = mysqli_query($conn, $query);      
                            ?>
                        </div>
                              <table id="myTable" class="table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Short Description</th>
                                    <th>Long Description</th>
                                    <th>Image</th>
                                    <th>Edition</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Isbn Number</th>
                                    <th>Action</th>
                                  </tr>
                               

                                </thead>
                                <tbody>

                                <!--view-->      
                                <?php
                                       
                                    while($rows=mysqli_fetch_assoc($Result))
                                    {
                                   ?>     
                                  <?php   echo ' <tr>
                                            <td>'.$rows['id'].'</td>
                                            <td>'.$rows['title'].'</td>
                                            
                                            <td>'.$rows['short_desc'].'</td>
                                            <td>'.$rows['long_desc'].'</td>
                                            <td><img src="img/Text/'.$rows['image'].'" width="50" height="50"></td>
                                            <td>'.$rows['edition'].'</td>
                                            <td>'.$rows['author'].'</td>
                                            <td>'.$rows['publisher'].'</td>
                                            <td>'.$rows['isbn'].'</td>';
                                     echo   "<td><a  onClick=\"javascript:return confirm('Do you wants to delete this?');\" href='delete_text.php?text_del=".$rows['id']."' class='btn btn-danger btn-flat btn-addon btn-xs m-b-10'><i class='fa fa-trash' style='font-size:16px'></i></a>"; 
                                      echo   '<a href="update_texxt.php?text_upd='.$rows['id'].'" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                            </td></tr>';
                                      } 
                                  
                                  ?>

                                </tbody>
                              </table>
                              <nav aria-label="Page navigation">
                        <ul class="pagination">
                        <?php if($currentPage != $firstPage) { ?>
                            <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
                                <span aria-hidden="true">First</span>           
                            </a>
                            </li>
                            <?php } ?>
                            <?php if($currentPage >= 2) { ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
                            <?php } ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
                            <?php if($currentPage != $lastPage) { ?>
                                <li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
                                <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                                    <span aria-hidden="true">Last</span>
                                </a>
                                </li>
                            <?php } ?>
                        </ul>
                        
                        </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
        
                            <!--<table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                    </tr>
                                </tbody>
                            </table>-->
                        </div>
                    </div>
                    <!--<div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Accented Table</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Hoverable Table</h6>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Color Table</h6>
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Bordered Table</h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Table Without Border</h6>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Responsive Table</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">ZIP</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>jhon@email.com</td>
                                            <td>USA</td>
                                            <td>123</td>
                                            <td>Member</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>mark@email.com</td>
                                            <td>UK</td>
                                            <td>456</td>
                                            <td>Member</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>jacob@email.com</td>
                                            <td>AU</td>
                                            <td>789</td>
                                            <td>Member</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <!-- Table End -->


            <!-- Footer Start -->
            <!--<div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">-->
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <!--Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>-->
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        
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
    <script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <script type="text/javascript">

        // Initialize CKEditor
        

        CKEDITOR.replace('long_desc',{

          width: "500px",
          height: "200px"

        }); 

        </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>