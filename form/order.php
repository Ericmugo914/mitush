<?php
include("../connection.php");
echo $cust_id=$_GET['cust_id'];

$query=mysqli_query($con,"select tbclothes.clothe_id,tbclothes.clothename,tbclothes.fldvendor_id,tbclothes.cost,tbclothes.descriptions,tbclothes.fldimage,tblcart.fld_cart_id,tblcart.fld_product_id,tblcart.fld_customer_id from tbclothes inner  join tblcart on tbclothes.clothe_id=tblcart.fld_product_id where tblcart.fld_customer_id='$cust_id'");
$re=mysqli_num_rows($query);
while($row=mysqli_fetch_array($query))
{
	echo "<br>";
	echo "cart id is".$cart_id=$row['fld_cart_id'];
	echo "vendor id is".$ven_id=$row['fldvendor_id'];
	echo "clothe_id is".$clothe_id=$row['clothe_id'];
	echo "cost is".$cost=$row['cost'];
	//$em_id=$row['fld_email'];
	echo 'payment status is'.$paid="In Process";
	
	if(mysqli_query($con,"insert into tblorder
	(fld_cart_id,fldvendor_id,fld_clothe_id,fld_email_id,fld_payment,fldstatus) values
	('$cart_id','$ven_id','$clothe_id','$cust_id','$cost','$paid')"))
	{
		if(mysqli_query($con,"delete from tblcart where fld_cart_id='$cart_id'"))
		{
			header("location:customerupdate.php");
		}
	}
	else
	{
		echo "failed";
	}
	//$row['food_id']."<br>";
}
?>