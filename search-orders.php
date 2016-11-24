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

$cust_id = $_GET ["search_cust_id"];

print "<!DOCTYPE html>";
print "<html>";
print "<head>";
print "<style>";
print "table, th, td { border: 1px solid black;}";
print "</style>";
print "</head>";
print "<body>";

print "<a href=\"admin-page.php\">Back to the admin page</a><br>";

// print $cust_id;
// print "<br>";
// print "search-orders.php";

/////////////////////////////////////////////////////////////////
//print "<table>";
	$status_n_date_s = "SELECT `Ord_Status`, `Ord_Date` FROM `Order` WHERE `Cust_ID` = '$cust_id'";
	$status_n_date_query = mysql_query($status_n_date_s) or die (mysql_error());
	//print "<th>Order ID</th><th>Order Cost</th><th>Status</th><th>Order Date</th><th>Item Name</th><th>Quantity</th><th>Invoice Status</th><th>Ship Date</th>";
	//print "<th>Order ID</th><th>Item Name</th><th>Quantity</th><th>Total Cost</th><th>Order Date</th><th>Order Status</th><th>Invoice Status</th><th>Ship Date</th>";
	while ( $row = mysql_fetch_array($status_n_date_query) ) {
		print "<tr>";
			//$ord_id = $row["Ord_ID"];
			//$ord_cost = $row["Ord_Cost"];
			$ord_status = $row["Ord_Status"];
			$ord_date = $row["Ord_Date"];

		//print "<td>$ord_id</td><td>  </td><td></td><td>$ord_cost</td><td>$ord_date</td><td>$ord_status</td><td> empty</td><td> empty</td>";
		//print "</tr>";
	}
//print "</table>";
////////////////////////////////////////////////////////////////

//query customer name
$name_statement = "SELECT `Cust_FName`, `Cust_LName` FROM `Customers` WHERE `Cust_ID` = '$cust_id'";
$name_statement_query = mysql_query($name_statement) or die (mysql_error());
while ( $row = mysql_fetch_array($name_statement_query) ) {
	$cust_fname = $row["Cust_FName"];
	$cust_lname = $row["Cust_LName"];
	$cust_name = $cust_fname . " " . $cust_lname;
}


print "<br><br>";
print "<b>".$cust_name."</b>";
print "<table>";
	$search_statement = "SELECT `Ord_ID`, `Cust_ID` FROM `Order` WHERE `Cust_ID` = '$cust_id'";
	$search_query = mysql_query($search_statement) or die (mysql_error());
	//print "<th>Order ID</th><th>Order Cost</th><th>Status</th><th>Order Date</th><th>Item Name</th><th>Quantity</th><th>Invoice Status</th><th>Ship Date</th>";
	print "<th>Order ID</th><th>Item Name</th><th>Quantity</th><th>Cost</th><th>Order Date</th><th>Order Status</th><th>Invoice Status</th><th>Ship Date</th>";
	while ( $row = mysql_fetch_array($search_query) ) {
		$ord_id = $row["Ord_ID"];
		$order_details_s = "SELECT `Ord_ID`, `Item_Code`, `Item_Quant` FROM `Order_Details` WHERE `Ord_ID` = '$ord_id'";	
		$order_details_s_query = mysql_query($order_details_s) or die (mysql_error());
		while ( $row = mysql_fetch_array($order_details_s_query) ) {
			$item_code = $row["Item_Code"];
			$item_quan = $row["Item_Quant"];
			$item_name_statement = "SELECT `Item_Code`, `Item_Name`, `Item_Price` FROM `Inventory` WHERE `Item_Code` = '$item_code'";
			$item_name_s_query = mysql_query($item_name_statement) or die (mysql_error());
			while ( $row = mysql_fetch_array($item_name_s_query) ) {
				$item_name = $row["Item_Name"];
				$item_price = $row["Item_Price"];
				$cost = $item_price * $item_quan;
			}
		$invoice_s = "SELECT `Ord_ID`, `Inv_Status` FROM `Invoice` WHERE `Ord_ID` = '$ord_id'";
		$invoce_query = mysql_query($invoice_s) or die (mysql_error());
		while ( $row = mysql_fetch_array($invoce_query) ) {
			$inv_status = $row["Inv_Status"];
		}
		
		$ship_s = "SELECT `Ord_ID`, `Ship_Date` FROM `Shipment` WHERE `Ord_ID` = '$ord_id'";
		$ship_query = mysql_query($ship_s) or die (mysql_error());
		while ( $row = mysql_fetch_array($ship_query) ) {
			$ship_date = $row["Ship_Date"];
		}			
			
			print "<tr>";	
			print "<td>$ord_id</td><td>$item_name</td><td>$item_quan</td><td>$cost</td><td>$ord_date</td><td>$ord_status</td><td>$inv_status</td><td>$ship_date</td>";
			print "</tr>";
		}
	}
print "</table>";


print "</body>";
print "</html>";


















?>