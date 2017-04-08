<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$con = mysqli_connect("dbserver.engr.scu.edu", "atran2", "00000963184", "sdb_atran2");
$ID=$_POST["memid"];
$post=$_POST["fpost"];
$sql="SELECT * FROM Members  WHERE memberID='$ID'";
$result=$con->query($sql);
if(!$result)
{
        echo "You can be a member by clicking here";
}
else
{
        //echo '<script>';
        //echo 'document.getElementById("postbox").style.display="inline"';
        //echo 'document.getElementById("idbox".style.display="none"';
        //echo '</script>';
}
        if($post)
        {
                $con2=mysqli_connect("dbserver.engr.scu.edu", "kta", "00000911205", "sdb_kta");
                $enter="INSERT INTO Forum (memberid, fpost) VALUES ('$ID','$post')";
                $posttoforum=$con2->query($enter);
        }
 header("Location: forum.php");


?>

