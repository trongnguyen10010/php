<?php
include ("account-490.php");
($dbh = mysql_connect ($hostname,$username,$password) ) or die ("Unable to connect to MySQL database");
mysql_select_db ($project);

// input: customer number
$custnum = mysql_real_escape_string($_GET["custnum"]);


$statement = //sql statement
$query = mysql_query($statement) or die (mysql_error());



?>