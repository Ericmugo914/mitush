<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(isset($_SESSION['id']))
{
  header("location:clothes.php");
}
  if(isset($login))
  {
  $sql=mysqli_query($con,"select * from tblvendor where fld_email='$username' && fld_password='$pswd' ");
    if(mysqli_num_rows($sql))
  {
   $_SESSION['id']=$username;
  header('location:clothes.php');  
  }
  else
  {
  $admin_login_error="Invalid Username or Password";  
  }
  }
   
?>
<html>
<head>
  <meta charset="UTF-8">
    <title>Hotel Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <style>
    ul li{}
    ul li a {color:white;padding:40px; }
    ul li a{color:black; font-weight:bold;}
ul li a{color:black; font-weight:bold;}

    ul li a:hover {color:white;}
     .form-group{width: 350px;
      top: 50%;
      }
    .form-control{font-size: 15px;
      border-radius: 5px;
      width: 100%;
      padding: 15px 10px;
      border: 0;
      background:#a7b8ab;
    }
    </style>
</head>
<body bgcolor="grey">

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:#272e29;font-family: 'Permanent Marker', cursive;">Mitumba Store Vendors</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
  
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home
                
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
    
    
      </ul>
    
    </div>
  
</nav>
<br><b></b>
 <section class="vh-100"  style="background-image: url(img/reg.jpg);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

     <!--login Section-- starts-->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
          <div class="footer" style="color:blue;"><?php if(isset($admin_login_error)){ echo $admin_login_error;}?></div>
        <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           <label for="Email">Email name:</label>
                           <input type="text" class="form-control" id="username" placeholder="Enter Email Address" name="username" bor required/>
                        </div>
                        <div class="form-group">
                             <label for="pwd">Password:</label>
                             <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required/>
                        </div>
                        
                          <button type="submit" name="login" class="btn btn-primary">Submit</button><br>
                         
                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="vendor-new.php" style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a><br>
                 </form>
      </div>
      <!--login Section-- ends-->
      
      
            
      </div>
    </div>
  </div></div></div></div></div></section>

     <?php
include("footer2.php");
?>
</body>
</html>