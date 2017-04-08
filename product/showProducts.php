<?php
        session_start();// Start the session before you write your HTML page
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title> Product Catalog </title></head>
<body>
<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$db_host = "dbserver.engr.scu.edu";
$db_user = "kta";
$db_pass = "00000911205";
$db_name = "sdb_kta";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql="SELECT * FROM Products";

  $result = $con->query($sql);
  if (!$result)
  {
    die('Error: ' . mysqli_error($con));
  }

echo "<table border='1'>
<tr>
<th>#</th>
<th>Item</th>
<th>Price</th>
<th>Description</th>
<th>In Stock</th>
<th></th>
</tr>";

while($row = mysqli_fetch_assoc($result))
  $sql="SELECT * FROM Products";

  $result = $con->query($sql);
  if (!$result)
  {
    die('Error: ' . mysqli_error($con));
  }

echo "<table border='1'>
<tr>
<th>#</th>
<th>Item</th>
<th>Price</th>
<th>Description</th>
<th>In Stock</th>
<th></th>
</tr>";

while($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
$key=$row['code'];
echo "<td>" . $row['code'] . "</td>";
echo "<td>" . $row['title'] . "</td>";
echo "<td>" . $row['price'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['instock'] . "</td>";
echo "<td> <a href='cart.php?add=$key'>Add to cart</a> </td>";
echo "</tr>";
}
echo "</table>";
?>
  <p>
    <a href="cart.php?show">View Shopping Cart</a>
    <br/> <br/>
        <a href="cart.php?checkout">Checkout</a>
    <br/> <br/>
    <a href="cart.php?clear">Clear Shopping Cart</a>
   </p>

  </body>
</html>

