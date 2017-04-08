<!DOCTYPE html>

<html lang="en">

<head>

        <meta charset="utf-8"/>

<title> Forum </title>

<body>
<?php
ini_set('display_errors','On');
error_reporting(E_ALL);
$dcon = mysqli_connect("dbserver.engr.scu.edu", "kta", "00000911205", "sdb_kta");
$gfp="SELECT * FROM Forum";
$posts=$dcon->query($gfp);
if($posts)
{
        echo "<table>";
        while($row = mysqli_fetch_assoc($posts))
        {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['memberid'] . "</td>";
        echo "<td>" . $row['fpost'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
}
?>
<div id ="idbox">
<form action="forumpost.php" method="post">
Please Enter member ID: <input type="text" name="memid" />
</div>
<div id ="postbox">
Enter Post: <input type="text" id="forumbox" name="fpost" />
<input type="submit" />
</form>
</div>

</body>
</html>

