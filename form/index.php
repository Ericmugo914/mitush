<?php
session_start();
include("../connection.php");
extract($_REQUEST);
if(isset($_GET['product']))
{
	$product_id= $_GET['product'];
}
else
{
	$product_id= "";
}
if(isset($_GET['msg']))
{
	$loginmsg=$_GET['msg'];
}
else
{
	$loginmsg="";
}
if(isset($login))
{
	$query=mysqli_query($con,"select * from tblcustomer where fld_email='$email' && password='$password'");
    if($row=mysqli_fetch_array($query))
	{
		$customer_email =$row['fld_email'];
		$_SESSION['cust_id']=$customer_email;
		if(!empty($customer_email && $product_id))
		{
			 //$_SESSION['product']=$product_id;
			echo $_SESSION['cust_id']=$customer_email;
			
			 header("location:cart.php?product=$product_id");
			
		}
		else
		{
		header("location:../index.php");
		 $_SESSION['product']=$product_id;
		 $_SESSION['cust_id'];
		}
		 
	}
	else
	{
		$ermsg="invalid Details";
	}
}

if(isset($register))
{
	$query=mysqli_query($con,"select * from tblcustomer where fld_email='$email'");
	$row=mysqli_num_rows($query);
	if($row)
	{
		$ermsg2="Email alredy registered with us";
		
	}
	else
	{
		if(mysqli_query($con,"insert into tblcustomer (fld_name,fld_email,password,fld_mobile) values('$name','$email','$password','$mobile')"))
    {
		$_SESSION['cust_id']=$email;
		if(!empty($customer_email && $product_id))
		{
			$_SESSION['cust_id']=$customer_email;
			header("location:cart.php?product='$product_id'");
			
		}
		else
		{
			$_SESSION['cust_id']=$email;
			header("location:../index.php");
		}
		
		
	}
	else
	{
		echo "fail";
		echo $name;
		echo $email;
		echo $password;
		echo $mobile;
	}
	}
	
}
 
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <title>Material Login Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
		<style>
		ul li{list-style:none;}
		ul li a {color:black;font-weight:bold;text-decoration:none; }
		ul li a:hover {color:black;text-decoration:none;}
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
  
    <a class="navbar-brand" href="../index.php"><span style="color:#272e29;font-family: 'Permanent Marker', cursive;">Mitumba Store</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../index.php">Home
                
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../aboutus.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contact</a>
        </li>
		
		
      </ul>
	  
    </div>
	
</nav>
<br><br><br>

			<!--new account Section-- starts-->
           
            
      </div>
	  </div>
	  <section class="vh-100" style="background-image: url(./reg.jpg);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 2rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <!--login Section-- starts-->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
			    <div class="footer" style="color:red;"><?php if(isset($loginmsg)){ echo $loginmsg;}?></div>
			  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="email">Email address:</label>
                      <input type="email" class="form-control" name="email" id="email" required/>
                    </div>
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" id="pwd" required/>
                   </div>
 
                  <button type="submit" name="login" style="background:#blue; border:0px solid #ED2553;" class="btn btn-primary">Login In</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 </form>
			</div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="reg.php" style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
	  <br><br> <br><br> <br><br>
<?php
include("footer.php");
?>
	   
</body>
