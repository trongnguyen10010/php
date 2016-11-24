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

$code = $_GET ["i_code"];
$name= $_GET ["i_name"];
$desc = $_GET ["i_desc"];
$quan = $_GET ["i_quan"];
$price = $_GET ["i_price"];

$add_statement = "INSERT INTO `Inventory`(`Item_Code`, `Item_Name`, `Item_Desc`, `Item_Storage`, `Item_Price`) VALUES ('$code','$name','$desc','$quan','$price')";

if ($code != "") {
	if ($name != "") {
		if ($desc != "") {
			if ($quan != "") {
				if ($price != "") {
					$add_query = mysql_query ($add_statement) or die (mysql_error());
				}
			}
		}
	}
}

print "<a href=\"admin-page.php\">Back to the admin page</a>";
print "<br> Code: ";
print $code;
print "<br> Name: ";
print $name;
print "<br> Description: ";
print $desc;
print "<br> Quantity: ";
print $quan;
print "<br> Price: ";
print $price;
print "<br>";
?>