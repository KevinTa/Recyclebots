<?php
session_start();        // Start the session before you write your HTML page
?>
<?php
// This function displays the contents of the shopping cart
function show_cart() {
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

        if (isset($_SESSION['cart'])){
                echo "Your Shopping Cart has the following items so far:<br/>";
                $mycart = $_SESSION['cart'];
                foreach ($mycart as $key => $value){
                if ($value >0){
                        $sql="SELECT * FROM Products where code = '$key'";
                        $result = $con->query($sql);
                        if (!$result)
                        {
                                die('Error: ' . mysqli_error($con));
                        }
                        $row = mysqli_fetch_assoc($result);
                    // get the full widget name from the widgets array;
                        $fullname = $row['title'];
                        print("$fullname = $value"."<a href="."cart.php?drop=$key".
                        ">    Remove</a><br/>");
                        }
                }
        }
        else {
                echo "No items in the cart";

        }
}
// This function removes an item from the shopping cart
function drop() {
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

         if (isset($_GET['drop'])){
                $dropItemId = $_GET['drop'];
                if (isset($_SESSION['cart'])){
                        $mycart = $_SESSION['cart'];
                        if($mycart[$dropItemId]==1)
                        {
                                unset ($mycart[$dropItemId]);

                        }
                        else
                        {
                                $mycart[$dropItemId]=$mycart[$dropItemId]-1;
                        }
                        //$sql = "UPDATE Products SET instock=instock+1 WHERE code='$dropItemId'";
                        //$result=$con->query($sql);
                        //if(!$result)
                        //{
                                //die('Error: ' . mysqli_error($con));
                        //}
                        $_SESSION['cart'] = $mycart;
                }
        }
}
// Adds an item to the shopping cart
function addToCart(){
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
  $addItemId = $_GET['add'];
  $sql="SELECT * FROM Products WHERE code= '$addItemId'";
  $result = $con->query($sql);
  if (!$result)
  {
    die('Error: ' . mysqli_error($con));
  }
  $row = mysqli_fetch_assoc($result);

        if (isset($_SESSION['cart'])){
                $mycart = $_SESSION['cart'];
                $itemname= $row['title'];
                // if the item already exists, increment the coun
                        if (isset($mycart[$addItemId])){

                                if($row['instock']>$mycart[$addItemId])
                                {
                                        $mycart[$addItemId]+= 1;
                                        $_SESSION['cart'] = $mycart;
                                        echo "$itemname added to cart <br/>";
                                }
                                else
                                {
                                        echo "Insufficient stock";
                                }

                        }
                        // if the item does not exist, add it to the cart
                        else{
                                if($row['instock']>0)
                                {
                                        $mycart[$addItemId] = 1;
                                        $_SESSION['cart']=$mycart;
                                        echo "$itemname added to cart <br/>";
                                }
                                else
                                {
                                        echo "Insufficient stock";
                                }

                        }
                        //$sql2="UPDATE Products SET instock=instock-1 WHERE code = '$addItemId'";
                        //$result2=$con->query($sql2);
                }

        else{
                // cart does not exist, create one
                if($row['instock']>0)
                {
                        $itemname = $row['title'];
                        $mycart = array();
                        $mycart[$addItemId] = 1;
                        //$sql2 = "UPDATE Products SET instock=instock-1 WHERE code = '$addItemId'";
                        //$result2=$con->query($sql2);
                        $_SESSION['cart'] = $mycart;
                        echo "$itemname added to cart <br/>";

                }
                else
                {
                        echo "Insufficient stock";
                }
        }
}
function clearCart(){
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
        if (isset($_GET['clear'])){
                if (isset($_SESSION['cart'])){
                $mycart = $_SESSION['cart'];
                //foreach ($mycart as $key => $value){
                //if ($value >0){
                        //$sql="UPDATE Products SET instock = instock+$value WHERE code = '$key'";
                        //$result = $con->query($sql);
                        //if (!$result)
                        //{
                                //die('Error: ' . mysqli_error($con));

                        //}
                //}
                //}
                unset($_SESSION['cart']);
                echo "Shopping Cart Cleared ";
        }
}
}
function checkout()
{
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

                if(isset($_SESSION['cart'])){
                $total = 0;
                echo "Items in cart:<br/>";
                $mycheckout = $_SESSION['cart'];
                foreach ($mycheckout as $key => $value){
                $sql = "SELECT * FROM Products WHERE code='$key'";
                $result = $con->query($sql);
                if(!$result)
                {
                        die('Error: ' . mysqli_error($con));
                }
                $row = mysqli_fetch_assoc($result);
                if ($value >0)
                    // get the full widget name from the widgets array;
                        $fullname = $row['title'];
                        $itemco=$row['code'];
                        $itemqu=$mycheckout[$key];
                        $subtotal = $row['price'] * $itemqu;
                        $total+=$subtotal;
                        print("$fullname Item#:$itemco quantity:$itemqu subtotal:" .' $'. "$subtotal<br>");

                }
                print("total:" . ' $'."$total");
                echo "<form action='finalcheckout.php'><button type='submit'> check out cart</button></form>";
                }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title>ViewCart</title></head>
<body>
<?php
        // if user has chosen "add"
        if ( isset($_GET['add'])) {
                addToCart();
                unset($_GET['add']);
        }
        // if user has chosen "show cart"
        elseif (isset($_GET['show'])){

                show_cart();
                unset($_GET['show']);
        }
        // if user has chosen "clear cart"
        elseif (isset($_GET['clear'])){
                clearCart();
                unset($_GET['clear']);
        }
        // if user has chosen "remove item from cart"
        elseif (isset($_GET['drop'])){
                drop();
                unset($_GET['drop']);
        }// if user has chosen "remove item from cart"
        elseif (isset($_GET['checkout'])){
                checkout();
                unset($_GET['checkout']);
        }
?>
<p>
    <a href="showProducts.php?">Back to the Catalog</a>
</p>
 </body>
</html>

