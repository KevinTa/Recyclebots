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

  $sql="INSERT INTO Products (code, title, price, description) VALUES ('$_POST[code]','$_POST[title]','$_POST[price]','$POST[description]')";

  $result = $con->query($sql);
  if (!$result)
  {
    die('Error: ' . mysqli_error($con));
  }
  echo "1 record added";
  mysqli_close($con);
?>
