<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(isset($_SESSION['id']))
{
 $id=$_SESSION['id'];
 $vq=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
 $vr=mysqli_fetch_array($vq);
 $vrid=$vr['fldvendor_id'];
}

if(!isset($_SESSION['id']))
{
	header("location:vendor_login.php?msg=Please Login To continue");
}
else
{
$query=mysqli_query($con,"select * from tblvendor   where fld_email='$id'");
if(mysqli_num_rows($query))
{   if(!file_exists("image/clothes/".$id."/clotheimages"))
	{
		$dir=mkdir("image/clothes/".$id."/clotheimages");
	}
	$row=mysqli_fetch_array($query);
    $v_id=$row['fldvendor_id'];
}
else
{
	
	header("location:index.php");
	
	
}
}


if(isset($add))
{   if(isset($_SESSION['id']))
	{
    $img_name=$_FILES['clothe_pic']['name'];
    if(!empty($chk)) 
	{
	$paymentmode=implode(",",$chk);
	if(mysqli_query($con,"insert into tbclothes(fldvendor_id,clothename,cost,descriptions,paymentmode,fldimage) values
	
	('$v_id','$clothe_name','$cost','$descriptions','$paymentmode','$img_name')"))
	{
		move_uploaded_file($_FILES['clothe_pic']['tmp_name'],"image/clothes/$id/clotheimages/".$_FILES['clothe_pic']['name']);
	}
	else{
		echo "failed";
	}
  }
  else 
  {
	  $paymessage="please select a payment mode";
  }
	}
	else
	{
		header("location:vendor_login.php");
	}
}

if(isset($logout))
{
	session_destroy();
	header("location:index.php");
}
if(isset($upd_account))
				{
					
					//echo $fn;
					//echo $emm;
					//echo $add;
					if(mysqlI_query($con,"update tblvendor set fld_name='$fn',fld_email='$emm',fld_address='$add',fld_mob='$mob',fld_password='$pwsd' where fld_email='$id'"))
				   {
						 header("location:infoUpdate.php");
					}
			  }
			  if(isset($upd_logo))
			  {
				  if(isset($_SESSION['id']))
				  {
				  $log_img=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
                  $log_img_row=mysqli_fetch_array($log_img);
				  $old_logo=$log_img_row['fld_logo'];
				  $new_img_name=$_FILES['logo_pic']['name'];
				  
				  if(mysqli_query($con,"update tblvendor set fld_logo='$new_img_name' where fld_email='$id'"))
				  {
					  unlink("image/clothes/$id/$old_logo");
					  move_uploaded_file($_FILES['logo_pic']['tmp_name'],"image/clothes/$id/".$_FILES['logo_pic']['name']);
				      
					  header("location:update_clothes.php");
					  
				  }
			  }
			  else
			  {
				  header("location:vendor_login.php?msg=Please Login To continue");
			  }
			  }
			  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="css/font.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	 <style>
		ul li a{color:black; font-weight:bold;}

		ul li a {color:white;padding:40px; }
		ul li a:hover {color:white;}
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
  
    <a class="navbar-brand" href="index.php"><span style="color:#272e29;font-family: 'Permanent Marker', cursive;">Mitumba store</span></a>
    <?php
	if(!empty($id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoration:none;"><i class="far fa-user"><?php if(isset($id)) { echo $vr['fld_name']; }?></i></a>
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
		<li class="nav-item">
		  <form method="post">
          <?php
			if(empty($_SESSION['id']))
			{
			?>
		   <button class="btn btn-outline-danger my-2 my-sm-0" name="login">Log In</button>&nbsp;&nbsp;&nbsp;
            <?php
			}
			else
			{
			?>
			
			<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			</form>
        </li>
		
		
      </ul>
	  
    </div>
	
</nav>

<!--navbar ends-->


<br><br>
<div class="middle" style=" padding:40px; border:1px solid #ED2553;  width:100%;">
       <!--tab heading-->
	  <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#272e29;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active"  style="color:green;" id="home-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="home" aria-selected="true">Manage Products</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" style="color:green;" id="profile-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="profile" aria-selected="false">Add Products</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:green;" id="accountsettings-tab" data-toggle="tab" href="#accountsettings" role="tab" aria-controls="accountsettings" aria-selected="false">Account Settings</a>
          </li>
		  
		  <li class="nav-item">
              <a class="nav-link" style="color:green;" id="logo-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="logo" aria-selected="false">Update Logo</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:green;"id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Order Status</a>
          </li>
		  
       </ul>
	   <br><br>
	   <span style="color:green;"><?php if(isset($msgs)) { echo $msgs; }?></span>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
                 <div class="container"> 
			 <table border="1" bordercolor="#F0F0F0" cellpadding="20px">
			 <th>clothe Image</th>
			 <th>cloth  name</th>
			 <th>Price</th>
			 <th>Descriptions </th>
			 <th>Payment Mode  </th>
			 <th>Delete Item   </th>
			 <th>Update item Details </th>
			   <?php
					  if($query=mysqli_query($con,"select tblvendor.fldvendor_id,tblvendor.fld_email,tbclothes.clothe_id,tbclothes.clothename,tbclothes.cost,tbclothes.paymentmode,tbclothes.descriptions,tbclothes.fldimage,tblvendor.fld_name from tblvendor inner join tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id where tblvendor.fld_email='$id'"))
					  {
						  if(mysqli_num_rows($query))
						  {
						 while($row=mysqli_fetch_array($query))
						 {
							 
							 ?>
			     <tr>
				 				 
				<td><img src="<?php echo 'image/clothes/'.$id.'/clotheimages/'.$row['fldimage'];?>" height="100px" width="150px"></td>
				<td style="width:150px;"><?php  echo $row['clothename']."<br>";?></td>
				<td align="center" style="width:150px;"><?php  echo $row['cost']."<br>";?></td>
				<td  align="center" style="width:150px;"><?php  echo $row['descriptions']."<br>";?></td>
				<td align="center" style="width:150px;"><?php  echo $row['paymentmode']."<br>";?></td>
				
				<td align="center" style="width:150px;">
				
				<a href="vendor_delete_clothes.php?clothe_id=<?php echo $row['clothe_id'];?>"><button type="button" class="btn btn-warning">Delete </button></a>
				
				</td>
				<td align="center" style="width:150px;">
				
				<a href="update.php?clothe_id=<?php echo $row['clothe_id'];?>"><button type="button" class="btn btn-danger">Update </button></a>
				
				</td>
				</tr>
				
				<?php 
					
                    $clothename="";
                    $descriptions="";
                    $cost="";					
						 }
					  }
					  else 
						  
						  {
							   $msg="please add some Items";
						  }
					  }
					  else 
					  {
						  echo "failed";
					  }
					  
					  ?>
			 </table>
			 </div>    	 
	        </div>
<!--tab 1 ends-->	   
			
			
			<!--tab 2 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="profile-tab">
			         <!--add Product-->
                        <form action="" method="post" enctype="multipart/form-data">
                                     <div class="form-group"><!--_name-->
                                     <label for="clothe_name">Clothe Name:</label>
                                            <input type="text" class="form-control" id="clothe_name" value="<?php if(isset($clothe_name)) { echo $clothe_name;}?>" placeholder="Enter Clothe Name" name="clothe_name" required>
                                     </div>
									 
									 
                                     <div class="form-group"><!--cost-->
                                            <label for="cost">Cost :</label>
                                            <input type="number" class="form-control" id="cost"  value="<?php if(isset($cost)) { echo $cost;}?>" placeholder="10000" name="cost" required>
                                     </div>
									 
									 
	                                 <div class="form-group"><!--cuisines-->
                                            <label for="Descriptions">Descriptions :</label>
                                            <input type="text" class="form-control" id="descriptions" value="<?php if(isset($descriptions)) { echo $descriptions;}?>" placeholder="Enter Descriptions" name="descriptions" required>
                                    </div>
							        
							        <div class="form-group"><!--payment_mode-->
                                         <input type="checkbox" name="chk[]" value="COD"/>Cash On Delivery
			                             <input type="checkbox" name="chk[]" value="Online Payment"/>Online Payment
								         <br>
								        <span style="color:red;"><?php if(isset($paymessage)){ echo $paymessage;}?></span>
			      			        </div>
							   
	                                <div class="form-group">
                                         <input type="file" accept="image/*" name="clothe_pic" required/>Images
                                    </div>
   
                                    <button type="submit" name="add" class="btn btn-primary">ADD Item</button>
									<br>
									<span style="color:red;"><?php if (isset($msg)){ echo $msg;}?></span>
                               </form>
				   
			</div>
			<!--tab 2 ends-->
			
			
			 <!--tab 3-- starts-->
			 <div class="tab-pane fade" id="accountsettings" role="tabpanel" aria-labelledby="accountsettings-tab">
			    <form method="post" enctype="multipart/form-data">
				<?php
			    $upd_info=mysqli_query($con,"select * from tblvendor where fld_email='$id'");
				$upd_info_row=mysqlI_fetch_array($upd_info);
				 $nm=$upd_info_row['fld_name'];
				 $emm=$upd_info_row['fld_email'];
				 $log=$upd_info_row['fld_logo'];
				$ad=$upd_info_row['fld_address'];
				$mb=$upd_info_row['fld_mob'];
				$psd=$upd_info_row['fld_password'];
				
				?>
				
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="username" value="<?php if(isset($nm)){ echo $nm;}?>" class="form-control" name="fn" />
                    </div>
					<div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" id="email" value="<?php if(isset($emm)){ echo $emm;}?>" class="form-control" name="emm" readonly="readonly"/>
                    </div>
					<div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" id="address" value="<?php if(isset($ad)){ echo $ad;}?>" class="form-control" name="add" required/>
                    </div>
					<div class="form-group">
                      <label for="mobile">Address</label>
                      <input type="text" id="mobile" pattern="+254712345678" value="<?php if(isset($mb)){ echo $mb;}?>" class="form-control" name="mob" required/>
                    </div>
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="pwsd" class="form-control" value="<?php if(isset($psd)){ echo $psd;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="upd_account" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  
			 </form>
			</div>
			<div class="tab-pane fade" id="logo" role="tabpanel" aria-labelledby="logo-tab">
                <div class="container">
				    <form class="form" method="post" enctype="multipart/form-data">
				       <input type="file" name="logo_pic" accept="image/*" required/>
					   <button type="submit" name="upd_logo" class="btn btn-outline-primary">Update Logo</button>
			        </form>
				</div>
			</div>
			 <div class="tab-pane fade " id="status" role="tabpanel" aria-labelledby="status-tab">
	            <table class="table">
				<tbody>
				<th>Order Id</th>
				<th>Customer Email</th>
				<th>Clothe Id</th>
				<th>Order Status</th>
				<th>Update Status</th>
				<?php
				$orderquery=mysqli_query($con,"select * from tblorder where fldvendor_id='$vrid'");
				if(mysqli_num_rows($orderquery))
				{
					while($orderrow=mysqli_fetch_array($orderquery))
					{
						$stat=$orderrow['fldstatus'];
						?>
						<tr>
						<td><?php echo $orderrow['fld_order_id']; ?></td>
						<td><?php echo $orderrow['fld_email_id']; ?></td>
						<td><?php echo $orderrow['fld_clothe_id']; ?></td>
						<?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $orderrow['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $orderrow['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
						<form method="post">
						<td><a href="changestatus.php?order_id=<?php echo $orderrow['fld_order_id']; ?>"><button type="button" name="changestatus">Update Status</button></a></td>
						</form>
						<tr>
						<?php
					}
				}
				?>
				</tbody>
				</table>
			 </div>
	  </div>
	</div>  
	
</body>
</html>