<?php
$con=mysqli_connect("localhost","root","autoset","fnc");
// Check connection
if (mysqli_connect_errno())
{
   echo "Failed to connect to MySQL";
}

$sql="INSERT INTO manager (name, deptnm, deptnm_d, grade) values ('$_POST[name]','$_POST[deptnm]','$_POST[deptnm_d]','$_POST[grade]')";

if(!mysqli_query($con,$sql))
{
   echo "Error<br/>";
}

$sql="SELECT * FROM manager";
if ($result=mysqli_query($con,$sql))
{
   // Fetch one and one row
   while ($row=mysqli_fetch_row($result))
   {
      printf("%s,%s,%s,%s <br/>\n",$row[0],$row[1],$row[2],$row[3]);
   }
   // Free result set
   mysqli_free_result($result);
}

mysqli_close($con);
?>
<br/>
<input type="button" value="돌아가기" onclick="location.href='/index.php'">