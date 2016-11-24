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

print "<a href=\"admin-page.php\">Back to the admin page</a><br>";
$item_code = $_GET ["update"];
$item_name = $_GET ["u_i_name"];
$item_desc = $_GET ["u_i_desc"];
$item_quan = $_GET ["u_i_quan"];
$item_price = $_GET ["u_i_price"];


$update_statement = "UPDATE `Inventory` SET `Item_Name`='$item_name',`Item_Desc`='$item_desc',`Item_Storage`='$item_quan',`Item_Price`='$item_price' WHERE `Item_Code`= '$item_code'";
if ($item_code != "") {
	$update_query = mysql_query ($update_statement) or die (mysql_error());
}
print "Updated item code: ".$item_code;

print "<br> Name: ";
print $item_name;
print "<br> Description: ";
print $item_desc;
print "<br> Quantity: ";
print $item_quan;
print "<br> Price: ";
print $item_price;
print "<br>";
?>