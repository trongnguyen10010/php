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

$name= $_GET ["o_cust_name"];
$order_status = $_GET ["o_order_status"];
$ship_date = $_GET ["o_ship_date"];
$inv_status = $_GET ["o_inv_status"];
$order_id = $_GET ["update-order"];

$inv_statemet = "UPDATE `Invoice` SET `Inv_Status`='$inv_status' WHERE `Ord_ID` = '$order_id'";
$inv_query = mysql_query ($inv_statemet) or die (mysql_error());

$ship_statement = "UPDATE `Shipment` SET `Ship_Date`= '$ship_date' WHERE `Ord_ID` = '$order_id'";
$ship_query = mysql_query ($ship_statement) or die (mysql_error());

$o_status_s = "UPDATE `Order` SET `Ord_Status`= '$order_status' WHERE `Ord_ID` = '$order_id'";
$o_status_query = mysql_query ($o_status_s) or die (mysql_error());

print "<a href=\"admin-page.php\">Back to the admin page</a><br>";
print "Updated order status";

// print "update-order.php";
// print "<br>";
// print $order_id;
// print "<br>";
// print $name;
// print "<br>";
// print $order_status;
// print "<br>";
// print $ship_date;
// print "<br>";
// print $inv_status;



?>