<?php
session_start();
include("connection.php");
extract($_REQUEST);
    if(isset($_SESSION['id']))
{
	header("location:clothes.php");
}

	if(isset($register))
     {
	$sql=mysqli_query($con,"select * from tblvendor where fld_email='$email'");
    if(mysqli_num_rows($sql))
	{
	  $email_error="This Email Id is aready registered with us";
	}
	else
	{
	$logo=$_FILES['logo']['name'];
	$sql=mysqli_query($con,"insert into tblvendor 
	(fld_name	,fld_email,fld_password,fld_mob,fld_phone,fld_address,fld_logo)
       	values('$r_name','$email','$pswd','$mob','$phone','$address','$logo')");
	
    if($sql)
	{
	mkdir("image/clothes");
	mkdir("image/clothes/$email");
	
	move_uploaded_file($_FILES['logo']['tmp_name'],"image/clothes/$email/".$_FILES['logo']['name']);
	}
	$_SESSION['id']=$email;
	
	header("location:clothes.php");
	
	}
  }
	
	
  
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <title>Mitumba Registration Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
		<style>
		ul li{list-style:none;}
		ul li a {color:black;text-decoration:none; }
    ul li a{color:black; font-weight:bold;}

		ul li a:hover {color:black; text-decoration:none;}


    .form-control{font-size: 15px;
      border-radius: 5px;
      width: 100%;
      padding: 15px 10px;
      border: 0;
      background:#a7b8ab;
    }
		</style>
</head>
<body>

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
<br><br><br>

   <section class="vh-200"  style="background-image: url(img/reg.jpg);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 2rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

	       <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="home-tab">
			    <div class="footer" style="color:red;"><?php if(isset($loginmsg)){ echo $loginmsg;}?></div>

			    <form action="" method="post" enctype="multipart/form-data">
            <h3>register</h3>
            <hr>
                      <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" id="name" value="<?php if(isset($r_name)) { echo $r_name;}?>" placeholder="Enter Store Name" name="r_name" required/>
                      </div>
	                  <div class="form-group">
                          <label for="name">Email Id:</label>
                          <input type="email" class="form-control" id="email" value="<?php if(isset($email)) { echo $email;}?>" placeholder="Enter Email" name="email" required/>
                          <span style="color:red;"><?php if(isset($email_error)){ echo $email_error;} ?></span>
	                  </div>
	                 <div class="form-group">
                         <label for="pswd">Password:</label>
                         <input type="password" class="form-control" id="pswd" placeholder="Enter Password" name="pswd" required/>
                     </div>
                     <div class="form-group">
                         <label for="mob">Mobile:</label>
                         <input type="tel" class="form-control" value="<?php if(isset($mob)) { echo $mob;}?>"id="mob" placeholder="Enter Mobile Number" name="mob" required/>
                     </div>
	                 <div class="form-group">
                          <label for="phone">Phone:</label>
                          <input type="tel" class="form-control"  id="phone" value="<?php if(isset($phone)) { echo $phone;}?>" placeholder="+254-" name="phone" required>
                     </div>
	                 <div class="form-group">
                          <label for="add">Address:</label>
                          <input type="text" class="form-control" id="add" placeholder="Enter Address" value="<?php if(isset($address)) { echo $address;}?>" name="address" required>
                     </div>
	                 <div class="form-group">
                          <input type="file"  name="logo" required>Upload Logo 
                     </div>
                     <button type="submit" id="register" name="register"  style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Register</button>
                     
      </form>
    </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
			   
			</div>
	   </div>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br>
	 <?php
			include("footer2.php");
			?>
	 
	   
</body>
</html>