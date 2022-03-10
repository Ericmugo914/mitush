<?php
session_start();


include("connection.php");
extract($_REQUEST);
$arr=array();
if(isset($_GET['msg']))
{
	$loginmsg=$_GET['msg'];
}
else
{
	$loginmsg="";
}
if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
	 $cquery=mysqli_query($con,"select * from tblcustomer where fld_email='$cust_id'");
	 $cresult=mysqli_fetch_array($cquery);
}
else
{
	$cust_id="";
}
 





$query=mysqli_query($con,"select  tblvendor.fld_name,tblvendor.fldvendor_id,tblvendor.fld_email,
tblvendor.fld_mob,tblvendor.fld_address,tblvendor.fld_logo,tbclothes.clothe_id,tbclothes.clothename,tbclothes.cost,
tbclothes.descriptions,tbclothes.paymentmode 
from tblvendor inner join tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id;");
while($row=mysqli_fetch_array($query))
{
	$arr[]=$row['clothe_id'];
	shuffle($arr);
}

//print_r($arr);

 if(isset($addtocart))
 {
	 
	if(!empty($_SESSION['cust_id']))
	{
		 
		header("location:form/cart.php?product=$addtocart");
	}
	else
	{
		header("location:form/?product=$addtocart");
	}
 }
 
 if(isset($login))
 {
	 header("location:form/index.php");
 }
 if(isset($logout))
 {
	 session_destroy();
	 header("location:index.php");
 }
 $query=mysqli_query($con,"select tbclothes.clothename,tbclothes.fldvendor_id,tbclothes.cost,tbclothes.descriptions,tbclothes.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbclothes inner  join tblcart on tbclothes.clothe_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
if(isset($message))
 {
	 
	 if(mysqli_query($con,"insert into tblmessage(fld_name,fld_email,fld_phone,fld_msg) values ('$nm','$em','$ph','$txt')"))
     {
		 echo "<script> alert('We will be Connecting You shortly')</script>";
	 }
	 else
	 {
		 echo "failed";
	 }
 }

?>
<html>
  <head>
     <title>Home</title>
	 <!--bootstrap files-->
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <!--bootstrap files-->
	 
	 <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
     
	 
	 
	 
	 <script>
	 //search product function
            $(document).ready(function(){
	
	             $("#search_text").keypress(function()
	                      {
	                       load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch2.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#result').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_text').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         $('#result').html(data);			
		                              }
	                                });
	                              });
	                            });
								
								//store search
								$(document).ready(function(){
	
	                            $("#search_store").keypress(function()
	                         {
	                         load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#resultstore').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_store').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         load_data();			
		                              }
	                                });
	                              });
	                            });
</script>
<style>
//body{
     background-image:url("img/bg5.jpg");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
}
ul li {list-style:none;}
ul li a{color:black; font-weight:bold;}
ul li a:hover{text-decoration:none;}


</style>
  </head>
  
    
	<body>

<div id="result" style="position:fixed;top:300; right:500;z-index: 3000;width:350px;background:black;"></div>
<div id="resultstore" style=" margin:0px auto; position:fixed; top:150px;right:750px; background:black;  z-index: 3000;"></div>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:#272e29;font-family: 'Permanent Marker', cursive;">Mitumba Store</span></a>
    
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        
		<li class="nav-item"><!--hotel search-->
		     <a href="#" class="nav-link">Search<br><form method="post"><input type="text" name="search_store" id="search_store" placeholder="Vendors " class="form-control " /></form></a>
		  </li>
         
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
		<li class="nav-item">
		  <form method="post">
          <?php
			if(empty($cust_id))
			{
			?>
			<a href="form/index.php?msg=you must be login first"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart"  class="badge badge-light">0</span></i></span></a>
			
			&nbsp;&nbsp;&nbsp;
			<button class="btn btn-outline-danger my-2 my-sm-0" name="login" type="submit">Customer Log in</button>&nbsp;&nbsp;&nbsp;
            <?php
			}
			else
			{
			?>
			<a href="form/cart.php"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-bag" aria-hidden="true"><span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></a>
			<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			</form>
        </li>
		
      </ul>
	  
    </div>
	
</nav>
<!--menu ends-->
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/bg.jpg" alt="Los Angeles" class="d-block w-100">
      <div class="carousel-caption">
        <h3><font color="black">Meru</font></h3>
        <p>Come shope with us</p>
      </div>   
    </div>
    <div class="carousel-item">
       <img src="img/bg5.jpg" alt="Los Angeles" class="d-block w-100">
      <div class="carousel-caption">
        <h3>Kenya</h3>
        <p><h2>Thank you, Kenya</h2></p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/sk.jpg" alt="Los Angeles" class="d-block w-100">
      <div class="carousel-caption">
        <h3>Northern</h3>
        <p>We Are United!</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>



<!--slider ends-->



<br><br>
<!--container  starts-->
<div class="container-fluid">
     <div class="row"><!--main row-->
          <div class="col-sm-6"><!--main row 2 left-->
	           <br>
	            <div class="container-fluid rounded" style="border:solid 1px #F0F0F0;"><!--product container-->
	                  <?php
	                        $clothe_id=$arr[0];
	                        $query=mysqli_query($con,"select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	                        tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fld_logo,tbclothes.clothe_id,tbclothes.clothename,tbclothes.cost,
	                        tbclothes.descriptions,tbclothes.paymentmode,tbclothes.fldimage from tblvendor inner join
	                        tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id where tbclothes.clothe_id='$clothe_id'");
	                             while($res=mysqli_fetch_assoc($query))
	                                  {
		                                 $store_logo= "image/clothes/".$res['fld_email']."/".$res['fld_logo'];
		                                 $clothe_pic= "image/clothes/".$res['fld_email']."/clotheimages/".$res['fldimage'];
	                                   ?>
	                                      <div class="container-fluid">
	                                          <div class="container-fluid"><!--product row container 1-->
	                                               <div class="row" style="padding:10px; ">
		                            <!--hotel logo-->  <div class="col-sm-2"><img src="<?php echo $store_logo; ?>" class="rounded-circle" height="50px" width="50px" alt="Cinque Terre"></div>
		                                               <div class="col-sm-5">
		                            <!--hotelname-->        <span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;"><?php echo $res['fld_name']; ?></span>
                                                       </div>
		          <!--ruppee-->      <div class="col-sm-3"><i  style="font-size:20px;" class="fas fa-dollar-sign"></i>&nbsp;<span style="color:green; font-size:25px;"><?php echo $res['cost']; ?></span></div>
									                   <form method="post">
		                         <!--add to cart-->    <div class="col-sm-2" style="text-align:left;padding:10px; font-size:25px;"><button type="submit"  name="addtocart" value="<?php echo $res['clothe_id'];?>"><span style="color:green;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></button></div>
		                                               </form>
													</div>
		 
	                                           </div>
	                                           <div class="container-fluid"><!--product row container 2-->
	                                                <div class="row" style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;">
		                           <!--food Image-->     <div class="col-sm-12"><img src="<?php echo $clothe_pic; ?>" class="rounded" height="250px" width="100%" alt="Cinque Terre"></div>
		 		                                    </div>
	                                            </div>
	                                            <div class="container-fluid"><!--product row container 3-->
	                                                 <div class="row" style="padding:10px; ">
		                                                 <div class="col-sm-6">
		                               <!--cuisine-->          <span><li><?php echo $res['descriptions']; ?></li></span>
		                                <!--cost-->            <span><li><?php echo "Ksh".$res['cost']; ?>&nbsp;for 1</li></span>
		                                <!--deliverytime-->    <span><li>Up To 60 Minutes</li></span>
		                                                 </div>
		                            <!--deliverytime-->  <div class="col-sm-6" style="padding:20px;"><h3><?php echo"(" .$res['clothename'].")"?></h3></div>
		                                               </div>
		 
	                                             </div>
	
	
	                                   <?php
	                                     }
	                                    ?>
	                                        </div>
		        </div> 
	   </div>
	  
	   
	   <!--main row 2 left right starts-->
	   <div class="col-sm-6">
	        <div class="container-fluid">
	             
	        </div>
	        <div class="container">
	        <!--paragraph content--> 
	             <div class="container-fluid rounded" style="border:solid 1px #F0F0F0;"><!--product container-->
	                  <?php
	                        $clothe_id=$arr[2];
	                        $query=mysqli_query($con,"select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	                        tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fld_logo,tbclothes.clothe_id,tbclothes.clothename,tbclothes.cost,
	                        tbclothes.descriptions,tbclothes.paymentmode,tbclothes.fldimage from tblvendor inner join
	                        tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id where tbclothes.clothe_id='$clothe_id'");
	                             while($res=mysqli_fetch_assoc($query))
	                                  {
		                                 $store_logo= "image/clothes/".$res['fld_email']."/".$res['fld_logo'];
		                                 $clothe_pic= "image/clothes/".$res['fld_email']."/clotheimages/".$res['fldimage'];
	                                   ?>
	                                      <div class="container-fluid">
	                                          <div class="container-fluid"><!--product row container 1-->
	                                               <div class="row" style="padding:10px; ">
		                            <!--hotel logo-->  <div class="col-sm-2"><img src="<?php echo $store_logo; ?>" class="rounded-circle" height="50px" width="50px" alt="Cinque Terre"></div>
		                                               <div class="col-sm-5">
		                            <!--hotelname-->        <span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;"><?php echo $res['fld_name']; ?></span>
                                                       </div>
		          <!--ruppee-->      <div class="col-sm-3"><i  style="font-size:20px;" class="fas fa-dollar-sign"></i>&nbsp;<span style="color:green; font-size:25px;"><?php echo $res['cost']; ?></span></div>
									                   <form method="post">
		                         <!--add to cart-->    <div class="col-sm-2" style="text-align:left;padding:10px; font-size:25px;"><button type="submit"  name="addtocart" value="<?php echo $res['clothe_id'];?>"><span style="color:green;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></button></div>
		                                               </form>
													</div>
		 
	                                           </div>
	                                           <div class="container-fluid"><!--product row container 2-->
	                                                <div class="row" style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;">
		                           <!--food Image-->     <div class="col-sm-12"><img src="<?php echo $clothe_pic; ?>" class="rounded" height="250px" width="100%" alt="Cinque Terre"></div>
		 		                                    </div>
	                                            </div>
	                                            <div class="container-fluid"><!--product row container 3-->
	                                                 <div class="row" style="padding:10px; ">
		                                                 <div class="col-sm-6">
		                               <!--descriptions-->          <span><li><?php echo $res['descriptions']; ?></li></span>
		                                <!--cost-->            <span><li><?php echo "Ksh".$res['cost']; ?>&nbsp;for 1</li></span>
		                                <!--deliverytime-->    <span><li>Up To 60 Minutes</li></span>
		                                                 </div>
		                            <!--deliverytime-->  <div class="col-sm-6" style="padding:20px;"><h3><?php echo"(" .$res['clothename'].")"?></h3></div>
		                                               </div>
		 
	                                             </div>
	
	
	                                   <?php
	                                     }
	                                    ?>
	                                        </div>
	  </div>
	   <!--main row 2 left right ends-->
    
  </div><!--main row 2 ends-->
</div>

<!--container 2 ends-->


<!--container  starts-->
<br><br><br>
<div class="container-fluid">
     <div class="row"><!--main row-->
          <div class="col-sm-6"><!--main row 2 left-->
	           <br>
	            <div class="container-fluid rounded" style="border:solid 1px #F0F0F0;"><!--product container-->
	                  <?php
	                        $clothe_id=$arr[1];
	                        $query=mysqli_query($con,"select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	                        tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fld_logo,tbclothes.clothe_id,tbclothes.clothename,tbclothes.cost,
	                        tbclothes.descriptions,tbclothes.paymentmode,tbclothes.fldimage from tblvendor inner join
	                        tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id where tbclothes.clothe_id='$clothe_id'");
	                             while($res=mysqli_fetch_assoc($query))
	                                  {
		                                 $store_logo= "image/clothes/".$res['fld_email']."/".$res['fld_logo'];
		                                 $clothe_pic= "image/clothes/".$res['fld_email']."/clotheimages/".$res['fldimage'];
	                                   ?>
	                                      <div class="container-fluid">
	                                          <div class="container-fluid"><!--product row container 1-->
	                                               <div class="row" style="padding:10px; ">
		                            <!--hotel logo-->  <div class="col-sm-2"><img src="<?php echo $store_logo; ?>" class="rounded-circle" height="50px" width="50px" alt="Cinque Terre"></div>
		                                               <div class="col-sm-5">
		                            <!--hotelname-->        <span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;"><?php echo $res['fld_name']; ?></span>
                                                       </div>
		          <!--ruppee-->      <div class="col-sm-3"><i  style="font-size:20px;" class="fas fa-dollar-sign"></i>&nbsp;<span style="color:green; font-size:25px;"><?php echo $res['cost']; ?></span></div>
									                   <form method="post">
		                         <!--add to cart-->    <div class="col-sm-2" style="text-align:left;padding:10px; font-size:25px;"><button type="submit"  name="addtocart" value="<?php echo $res['clothe_id'];?>"><span style="color:green;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></button></div>
		                                               </form>
													</div>
		 
	                                           </div>
	                                           <div class="container-fluid"><!--product row container 2-->
	                                                <div class="row" style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;">
		                           <!--food Image-->     <div class="col-sm-12"><img src="<?php echo $clothe_pic; ?>" class="rounded" height="250px" width="100%" alt="Cinque Terre"></div>
		 		                                    </div>
	                                            </div>
	                                            <div class="container-fluid"><!--product row container 3-->
	                                                 <div class="row" style="padding:10px; ">
		                                                 <div class="col-sm-6">
		                               <!--cuisine-->          <span><li><?php echo $res['descriptions']; ?></li></span>
		                                <!--cost-->            <span><li><?php echo "Ksh".$res['cost']; ?>&nbsp;for 1</li></span>
		                                <!--deliverytime-->    <span><li>Up To 60 Minutes</li></span>
		                                                 </div>
		                            <!--deliverytime-->  <div class="col-sm-6" style="padding:20px;"><h3><?php echo"(" .$res['clothename'].")"?></h3></div>
		                                               </div>
		 
	                                             </div>
	
	
	                                   <?php
	                                     }
	                                    ?>
	                                        </div>
		        </div> 
	   </div>
	  
	   <br><br>
	   <!--main row 2 left right starts-->
	   <div class="col-sm-6">
	        <div class="container-fluid">
	             
	        </div>
	        <div class="container">
	        <!--paragraph content--> 
	             <div class="container-fluid rounded" style="border:solid 1px #F0F0F0;"><!--product container-->
	                  <?php
	                        $clothe_id=$arr[0];
	                        $query=mysqli_query($con,"select tblvendor.fld_email,tblvendor.fld_name,tblvendor.fld_mob,
	                        tblvendor.fld_phone,tblvendor.fld_address,tblvendor.fld_logo,tbclothes.clothe_id,tbclothes.clothename,tbclothes.cost,
	                        tbclothes.descriptions,tbclothes.paymentmode,tbclothes.fldimage from tblvendor inner join
	                        tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id where tbclothes.clothe_id='$clothe_id'");
	                             while($res=mysqli_fetch_assoc($query))
	                                  {
		                                 $store_logo= "image/clothes/".$res['fld_email']."/".$res['fld_logo'];
		                                 $clothe_pic= "image/clothes/".$res['fld_email']."/clotheimages/".$res['fldimage'];
	                                   ?>
	                                      <div class="container-fluid">
	                                          <div class="container-fluid"><!--product row container 1-->
	                                               <div class="row" style="padding:10px; ">
		                            <!--hotel logo-->  <div class="col-sm-2"><img src="<?php echo $store_logo; ?>" class="rounded-circle" height="50px" width="50px" alt="Cinque Terre"></div>
		                                               <div class="col-sm-5">
		                            <!--hotelname-->        <span style="font-family: 'Miriam Libre', sans-serif; font-size:28px;color:#CB202D;"><?php echo $res['fld_name']; ?></span>
                                                       </div>
		          <!--ruppee-->      <div class="col-sm-3"><i  style="font-size:20px;" class="fas fa-dollar-sign"></i>&nbsp;<span style="color:green; font-size:25px;"><?php echo $res['cost']; ?></span></div>
									                   <form method="post">
		                         <!--add to cart-->    <div class="col-sm-2" style="text-align:left;padding:10px; font-size:25px;"><button type="submit"  name="addtocart" value="<?php echo $res['clothe_id'];?>"><span style="color:green;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span></button></div>
		                                               </form>
													</div>
		 
	                                           </div>
	                                           <div class="container-fluid"><!--product row container 2-->
	                                                <div class="row" style="padding:10px;padding-top:0px;padding-right:0px; padding-left:0px;">
		                           <!--food Image-->     <div class="col-sm-12"><img src="<?php echo $clothe_pic; ?>" class="rounded" height="250px" width="100%" alt="Cinque Terre"></div>
		 		                                    </div>
	                                            </div>
	                                            <div class="container-fluid"><!--product row container 3-->
	                                                 <div class="row" style="padding:10px; ">
		                                                 <div class="col-sm-6">
		                               <!--cuisine-->          <span><li><?php echo $res['descriptions']; ?></li></span>
		                                <!--cost-->            <span><li><?php echo "Ksh".$res['cost']; ?>&nbsp;for 1</li></span>
		                                <!--deliverytime-->    <span><li>Up To 60 Minutes</li></span>
		                                                 </div>
		                            <!--deliverytime-->  <div class="col-sm-6" style="padding:20px;"><h3><?php echo"(" .$res['clothename'].")"?></h3></div>
		                                               </div>
		 
	                                             </div>
	
	
	                                   <?php
	                                     }
	                                    ?>
	                                        </div>
	  </div>
	   <!--main row 2 left right ends-->
    
  </div><!--main row 2 ends-->
</div>
<br><br>


<!--footer primary-->
	     
		    <?php
			include("footer.php");
			?>
			 			 
		  
          

	</body>
</html>