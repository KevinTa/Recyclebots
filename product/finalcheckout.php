<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns = "http://www.w3.org/1999/xhtml">
<head><title> Product Checkout </title></head>
<body>
<?php
session_start();
$con = mysqli_connect("dbserver.engr.scu.edu", "kta", "00000911205", "sdb_kta");
if(mysqli_connect_errno())
{
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
        $mycart=$_SESSION['cart'];
         foreach ($mycart as $key => $value){
                if ($value >0){
                        $sql="UPDATE Products SET instock = instock-$value WHERE code = '$key'";
                        $result = $con->query($sql);
                        if (!$result)
                        {
                                die('Error: ' . mysqli_error($con));

                        }
                }
                }
                unset($_SESSION['cart']);
                echo "Items checked out";
                echo "<form action='showProducts.php'><button type = 'submit'>Go back to catalog</button></form>";
?>
</body>
</html>
