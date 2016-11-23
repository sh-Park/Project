<?php
$con=mysqli_connect("localhost","root","autoset","fnc");
// Check connection
if (mysqli_connect_errno())
{
   echo "Failed to connect to MySQL";
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
<html>
<body>
<br/>
<form action="insert.php" method="post">
name: <input type="text" name="name"/><br/>
deptnm: <input type="text" name="deptnm"/><br/>
deptnm_d: <input type="text" name="deptnm_d"/><br/>
grade: <input type="text" name="grade"/><br/>
<input type="submit"/>
</form>
</body>
</html>