<?php
 

 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'dbtest');

$con = mysql_connect(DBHOST,DBUSER,DBPASS);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db(DBNAME);
$result = mysql_query("SELECT * FROM scannedgrocery");
echo $result;
while($row = mysql_fetch_array($result))
  {
  echo $row['Id'] . " " . $row['itemName'];
  echo "<br />";
  }
 
?>
