<?php 
	session_start();// Start the session before you write your HTML page
?>
 <?php 
    include ("inventory.php"); 	
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title> Product Catalog </title></head>
<body>
<?php
	echo "<table border='1'>
	<tr>
	<th>Name</th>
	<th>Code</th>
	<th>Price</th>
	<th></th>
	</tr>";

foreach($titles as $key => $value)
{
	echo "<tr>";
	echo "<td>$titles[$key]</td>";
	echo "<td>$codes[$key]</td>";
	echo "<td>$prices[$key]</td>";
	echo "<td> <a href='cart.php?add=$key'>Add to cart</a> </td>";
	echo "</tr>";
}
	echo "</table>";
 ?>
  <p> 
    <a href="viewCart.php?show">View Shopping Cart</a> 
    <br/> <br/>
	<a href="viewCart.php?checkout">Checkout</a> 
    <br/> <br/>
    <a href="viewCart.php?clear">Clear Shopping Cart</a> 
   </p> 

  </body>
</html>