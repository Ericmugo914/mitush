<?php
session_start();
?>
<html>
  <head>
     <title>Contact-us</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
    
	 <style>
	 .carousel-item {
  height: 100vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
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
	 
	 
	 
<style>
ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{text-decoration:none;}
</style>
  </head>
  
    
<body>
<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>
<!--navbar start-->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:#272e29;font-family: 'Permanent Marker', cursive;">Mitumba Online Store</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"><?php if(isset($cust_id)) { echo $qqr['fld_name']; }?></i></a>
	<?php
	}
	?>
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
<!--navbar ends-->

<br><br><br>
<div class="container-fluid">
  <img src="img/tc.jpg" width="100%">
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm-8" style="padding:20px; border:1px solid #F0F0F0;">
	    <form method="post">
            <div class="form-group">
                 <input type="text" class="form-control"  placeholder="Name*" name="name" required/>
            </div>
			<div class="form-group">
                 <input type="email" class="form-control"  placeholder="email*" value="<?php if(isset($cust_id)) echo $cust_id; ?>" name="email" required/>
            </div>
			<div class="form-group">
                 <input type="tel" class="form-control"  name="phone" placeholder="Phone(optinal) 9213298761"/>
            </div>
			<div class="form-group">
                <textarea class="form-control"    placeholder="Message*" name="msgtxt" rows="3" col="10" required/></textarea/>
            </div>
			<div class="form-group">
                   <button type="submit" name="message" class="btn btn-primary">Send Message</button>
            </div>
        </form>
	</div>
    <div class="col-sm-4" style="padding:30px;">
	   <div class="form-group">
           <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<b>7503515386</b><br><br>
			<i class="fa fa-home" aria-hidden="true"></i>&nbsp; 23-A ,MERU COUNTY-MERU TOWN Zip Code-2000411<br>(24/7 Days)
	       
	   </div>
	</div>
  </div>
</div>
<br><br>
  <?php
			include("footer.php");
			?>





	</body>
</html>