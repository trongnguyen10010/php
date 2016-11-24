<?php
/////////////////////
// admin-page.php  //
// IT490 group 2   //
// Trong Nguyen    //
/////////////////////

//connect to phpMyAdmin
include ("account-490.php");
($dbh = mysql_connect ($hostname,$username,$password) ) or die ("Unable to connect to MySQL database");
mysql_select_db ($project);

$item_code = $_GET ["remove"];
print "<a href=\"admin-page.php\">Back to the admin page</a><br>";
$inv_remove_statement = "DELETE FROM `Inventory` WHERE `Item_Code` = '$item_code'";
if ($item_code != "") {
	$remove_query = mysql_query ($inv_remove_statement) or die (mysql_error());
}
print "Removed item code: ".$item_code;
?>