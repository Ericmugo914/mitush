
<?php
session_start();
include("connection.php");
extract($_REQUEST);
if(!isset($_SESSION['admin']))
{
	header("location:admin.php");
	
}
else
{
	$admin_username=$_SESSION['admin'];
}
if(isset($logout))
{
	unset ($_SESSION['admin']);
	setcookie('logout','loggedout successfully',time() +5);
	header("location:admin.php");
}
if(isset($delete))
{
	header("location:deleteclothes.php?id=$delete");
}
if(isset($deleteVendor))
{
	header("location:deleteVendor.php?Vendorid=$deleteVendor");
}
$admin_info=mysqli_query($con,"select * from tbadmin where fld_username='$admin_username'");
$row_admin=mysqli_fetch_array($admin_info);
$user= $row_admin['fld_username'];
$pass= $row_admin['fld_password'];

//update
if(isset($update))
{
if(mysqli_query($con,"update tbadmin set fld_password='$password'"))
{
	//$_SESSION['pas_update_success']="Password Updated Successfully Login with New Password";
    unset ($_SESSION['admin']);
	header("location:admin_info_update.php");
}
else
{
	echo "failed";
}

}
?>
<html>
  <head>
     <title>Admin control panel</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
		 <style>
		ul li{}
		ul li a {color:black;}
		ul li a:hover {color:black; font-weight:bold;}
		ul li {list-style:none;}

ul li a:hover{text-decoration:none;}
#social-fb,#social-tw,#social-gp,#social-em{color:blue;}
#social-fb:hover{color:#4267B2;}
#social-tw:hover{color:#1DA1F2;}
#social-gp:hover{color:#D0463B;}
#social-em:hover{color:#D0463B;}
.form-control{font-size: 15px;
      border-radius: 5px;
      width: 100%;
      padding: 15px 10px;
      border: 0;
      background:#a7b8ab;
    }
	 </style>
	 <script>
			function delRecord(id)
			{
				//alert(id);
				
				var x=confirm("You want to delete this record? All clothes Items Of that Vendor Will Also Be Deleted");
				if(x== true)
				{
					
					//document.getElementById("#result").innerHTML="success";
				  window.location.href='deleteVendor.php?Vendorid=' +id;		
				}
				else
				{
					window.location.href='#';
				}
				
			}
		</script>
  
  </head>
  
    
	<body>

	
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="index.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">Admin</span></a>
    <?php
	if(!empty($admin_username))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user">Mitumba Store</i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home</a>
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
		<?php
		if(isset($_SESSION['admin']))
		{
			?>
			<li class="nav-item">
            <a class="nav-link" href="">
		      <form method="post">
			    <button type="submit" name="logout" class="btn btn-outline-success">Log Out</button>
			  </form>
		    </a>
            </li>
			<?php
		}
		
		?>
		
      </ul>
	  
    </div>
	
</nav>
<!--navbar ends-->
<br><br><br><br>
<!--details section-->
 
<div class="container">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#272e29;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" style="color:green;" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Clothes Items</a>
          </li>
          <li class="nav-item">
              <a class="nav-link"  style="color:green;" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:green;"  id="ManageVendors-tab" data-toggle="tab" href="#ManageVendors" role="tab" aria-controls="ManageVendors" aria-selected="false">Manage Vendors</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:green;" id="orderstatus-tab" data-toggle="tab" href="#orderstatus" role="tab" aria-controls="orderstatus" aria-selected="false">Order status</a>
          </li>
		  
		  
		  
		  
       </ul>
	   <br><br>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="viewitem-tab">
                 <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        <th scope="col">Store_Id</th>
                            <th scope="col">Clothe View</th>
                            <th scope="col">Store Descriptions</th>
                            <th scope="col">Store Name</th>
                            <th scope="col">Clothe Id</th>
                            
                            <th scope="col">Remove Vendor</th>
                     </tr>
                 </thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select tblvendor.fldvendor_id,tblvendor.fld_name,tblvendor.fld_email,tbclothes.clothe_id,tbclothes.clothename,tbclothes.descriptions,tbclothes.fldimage from  tblvendor right join tbclothes on tblvendor.fldvendor_id=tbclothes.fldvendor_id");
	    while($row=mysqli_fetch_array($query))
		{
	
	?>			 
                
                    <tr>
                        <th scope="row"><?php echo $row['fldvendor_id'];?></th>
						<td><img src="image/clothes/<?php echo $row['fld_email']."/clotheimages/" .$row['fldimage'];?>" height="50px" width="100px">
						<br><?php echo $row['clothename'];?>
						</td>
						<td><?php echo $row['descriptions'];?></td>
                        <td><?php echo $row['fld_name'];?></td>
                        <td><?php echo $row['clothe_id'];?></td>
                       
                        
                        
                        
						<form method="post">
                        <td><a href=""><button type="submit" value="<?php echo $row['clothe_id']; ?>" name="delete"  class="btn btn-danger">Remove </button></td>
                        </form>
                   </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
		  
		   <span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>
			
		
      	    </div>	 
	  
<!--tab 1 ends-->	   
			
			
			<!--tab 2 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="username" value="<?php if(isset($user)){ echo $user;}?>" class="form-control" name="name" readonly="readonly"/>
                    </div>
					
					
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="password" class="form-control" value="<?php if(isset($pass)){ echo $pass;}?>" id="pwd" required/>
                   </div>
				   
				   
 
                  <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 </form>
			</div>
			<!--tab 2 ends-->
			 
			 <div class="tab-pane fade show" id="ManageVendors" role="tabpanel" aria-labelledby="ManageVendors-tab">
			    <div class="container">
	               <table class="table">
                 <thead>
                    <tr>
                        <th scope="col"></th>
                            <th scope="col">Store Id/vendor Id</th>
                            <th scope="col">Name</th>
                            
                            
                            <th scope="col">Address</th>
                            <th scope="col">Remove Vendor</th>
                     </tr>
                 </thead>
				 <tbody>
	<?php
	$query=mysqli_query($con,"select  * from tblvendor");
	    while($row=mysqli_fetch_array($query))
		{
	
	?>			 
                
                    <tr>
                        
						<td><img src="image/clothes/<?php echo $row['fld_email']."/" .$row['fld_logo'];?>" height="50px" width="100px"></td>
                        <th scope="row"><?php echo $row['fldvendor_id'];?></th>
						<td><?php echo $row['fld_name'];?></td>
						<td><?php echo $row['fld_address'];?></td>
                        
                        
                        
                        
                        
						<form method="post">
                        <td><a href="#"  style="text-decoration:none; color:white;" onclick="delRecord(<?php echo $row['fldvendor_id']; ?>)"><button type="button" class="btn btn-danger">Remove Vendor</a></a></td>
                        </form>
                   </tr>
		<?php
		}
		?>		   
                </tbody>
           </table>
	 
	 </div>   	
			 </div>
			 
			 <!--tab 4-->
			 <div class="tab-pane fade" id="orderstatus" role="tabpanel" aria-labelledby="orderstatus-tab">
               <table class="table">
			   <th>Order Id</th>
			   <th>Clothe Id</th>
			   <th>Customer Email Id</th>
			   <th>order Status</th>
			   <tbody>
			   <?php			   
			   $rr=mysqli_query($con,"select * from tblorder");
			   while($rrr=mysqli_fetch_array($rr))
			   {
				   $stat=$rrr['fldstatus'];
				   $clotheid=$rrr['fld_clothe_id'];
				   $r_f=mysqli_query($con,"select * from tbclothes where clothe_id='$clotheid'");
				   $r_ff=mysqli_fetch_array($r_f);
			   
			   ?>
			   <tr>
			   <td><?php echo $rrr['fld_order_id']; ?></td>
			   <td><a href="searchfood.php?clothe_id=<?php echo $rrr['fld_clothe_id']; ?>"><?php echo $rrr['fld_clothe_id']; ?></td>
			   <td><?php echo $rrr['fld_email_id']; ?></td>
			   <?php
			   if($stat=="cancelled" || $stat=="Out Of Stock")
			   {
			   ?>
			   <td><i style="color:orange;" class="fas fa-exclamation-triangle"></i>&nbsp;<span style="color:red;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   else
				   
			   {
			   ?>
			   <td><span style="color:green;"><?php echo $rrr['fldstatus']; ?></span></td>
			   <?php
			   }
			   ?>
			   
			   </tr>
			   <?php
			   }
			   ?>
			   </tbody>
			   </table>
			</div>
			 
      
	  </div>
	</div>	 
	<br><br><br>
 
		  

</body>
	
</html>	