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

//HTML tags
print "<!DOCTYPE html>";
print "<html>";
print "<head>";
print "<style>";
print "table, th, td { border: 1px solid black;}";
print "</style>";
print "</head>";
print "<body>";
print "";
print "";
print "<b><h1>New Century Commerce, Inc.</b></h1>";
print "<b><h2>Admin page</h2></b>";
print "<br><br>";
//print "<form action=\"admin-page.php\" method=\"get\">";
//print "</form>";

// print "<form action=\"new-orders.php\" method=\"get\">";
// print "<b>New order</b>";
// print "<br><input type=\"submit\" value=\"Submit\">";
// print "</form>";



print "<br><br>";

//search and display
print "<form action=\"search-orders.php\" method=\"get\">";
print "<b>Search orders by Customer ID</b>";
print "<br><input type=\"number\" name=\"search_cust_id\" required>";
print "<input type=\"submit\" value=\"Search\">";
print "</form>";

print "<br><br>";


////////////////////////////////////////////////
//////////// Inventory table ///////////////////
///////////////////////////////////////////////
print "<br><b>Inventory</b>";
print "<table>";
	$inv_statement = "SELECT * FROM `Inventory`";
	$inv_query = mysql_query($inv_statement);
	print "<th>Item code</th><th>Item name</th><th>Description</th><th>Quantity</th><th>Price</th>";
	while ( $row = mysql_fetch_array($inv_query) ) {
		print "<tr>";
			$inv_item_code = $row["Item_Code"];
			$inv_item_name = $row["Item_Name"];
			$inv_item_desc = $row["Item_Desc"];
			$inv_quan = $row["Item_Storage"];
			$inv_price = $row["Item_Price"];
		print "<td>$inv_item_code</td><td> $inv_item_name </td><td>$inv_item_desc</td><td> $inv_quan</td><td> $inv_price</td>";
		print "</tr>";
	}
print "</table>";

print "<br>";

//update inventory
print "<form action=\"update-inventory.php\" method=\"get\">";
print "<br><b>Update inventory</b>";
print "<table>";
print "<th>Item code</th><th>Item name</th><th>Description</th><th>Quantity</th><th>Price</th>";
print "<tr>";

print "<td>";
$code_n_name_statement = "SELECT `Item_Code` FROM `Inventory`";
$query_code_n_name = mysql_query($code_n_name_statement);
print "<select name = \"update\" required>";
	print "<option>Select code</option>";
	while ( $row = mysql_fetch_array($query_code_n_name) ) {
		$value = $row["Item_Code"];
		print "<option value";
		print "=\"";
		print $value;
		print "\">";
		print $value;
		print "</option>";
	}
print "</select>";
print "</td>";

print "<td><input type=\"text\" name=\"u_i_name\" required></td><td><input type=\"text\" name=\"u_i_desc\" required></td><td><input type=\"number\" name=\"u_i_quan\" required></td><td><input type=\"number\" name=\"u_i_price\" required></td>";
print "</tr>";
print "</table>";
print "<br>";
print "<input type=\"submit\" value=\"Update item\">";
print "</form>";

print "<br>";

// add to inventory
print "<form action=\"add-inventory.php\" method=\"get\">";  // link to another php - this php will run a sql statemnet to add an item to the db
print "<br><b>Add inventory</b>";
print "<table>";
print "<th>Item code</th><th>Item name</th><th>Description</th><th>Quantity</th><th>Price</th>";
print "<tr>";
print "<td><input type=\"number\" name=\"i_code\" required></td><td><input type=\"text\" name=\"i_name\" required></td><td><input type=\"text\" name=\"i_desc\" required></td><td><input type=\"number\" name=\"i_quan\" required></td><td><input type=\"number\" name=\"i_price\" required></td>";
print "</tr>";
print "</table>";
print "<br>";
print "<input type=\"submit\" value=\"Add item\">";
print "</form>";
print "<br>";

//remove item
print "<form action=\"remove-inventory.php\" method=\"get\">";
print "<br><b>Remove item<br></b>";
$code_n_name_statement = "SELECT `Item_Code`, `Item_Name` FROM `Inventory`";
$query_code_n_name = mysql_query($code_n_name_statement);
print "<select name=\"remove\">";
	print "<option>Select item</option>";
	while ( $row = mysql_fetch_array($query_code_n_name) ) {
		$value = $row["Item_Code"];
		$name = $row["Item_Name"];
		print "<option value";
		print "=\"";
		print $value;
		print "\">";
		print $name;
		print "</option>";
	}
print "</select>";
print "<input type=\"submit\" value=\"Remove item\">";
print "</form>";

// update order status, shipping date, and invoice status
print "<br><br>";
print "<b>Order table</b><br>";


//order table

print "<table>";
	//$inv_statement = "SELECT * FROM `Inventory`";
	//$inv_query = mysql_query($inv_statement);
	$u_order_id = "SELECT `Ord_ID` FROM `Order`";
	$u_order_id_query = mysql_query($u_order_id);
	print "<th>Order ID</th><th>Customer Name</th><th>Order Status</th><th>Ship Date</th><th>Invoice Status</th>";
	while ( $row = mysql_fetch_array($u_order_id_query) ) {
		$u_order_id = $row["Ord_ID"];
		$u_o_status = "SELECT `Ord_Status` FROM `Order` WHERE `Ord_ID` = '$u_order_id'";	
		$u_o_status_query = mysql_query($u_o_status);
		while ( $row = mysql_fetch_array($u_o_status_query) ) {
			$u_order_status = $row["Ord_Status"];
		}
		$u_o_ship = "SELECT `Ship_Date` FROM `Shipment` WHERE `Ord_ID` = '$u_order_id'";	
		$u_o_ship_query = mysql_query($u_o_ship);
		while ( $row = mysql_fetch_array($u_o_ship_query) ) {
			$u_order_ship = $row["Ship_Date"];
		}
		$u_o_inv = "SELECT `Inv_Status` FROM `Invoice` WHERE `Ord_ID` = '$u_order_id'";	
		$u_o_inv_query = mysql_query($u_o_inv);
		while ( $row = mysql_fetch_array($u_o_inv_query) ) {
			$u_order_inv = $row["Inv_Status"];
		}		
		$u_o_name = "SELECT `Cust_ID` FROM `Order` WHERE `Ord_ID` = '$u_order_id'";	
		$u_o_name_query = mysql_query($u_o_name);
		while ( $row = mysql_fetch_array($u_o_name_query) ) {
			$cust_id = $row["Cust_ID"];
		}			
		//query customer name
		$name_statement = "SELECT `Cust_FName`, `Cust_LName` FROM `Customers` WHERE `Cust_ID` = '$cust_id'";
		$name_statement_query = mysql_query($name_statement) or die (mysql_error());
		while ( $row = mysql_fetch_array($name_statement_query) ) {
			$cust_fname = $row["Cust_FName"];
			$cust_lname = $row["Cust_LName"];
			$cust_name = $cust_fname . " " . $cust_lname;
		}		
		print "<tr>";
		print "<td>$u_order_id</td><td>$cust_name</td><td>$u_order_status</td><td>$u_order_ship</td><td>$u_order_inv</td>";
		print "</tr>";
	}
print "</table>";





//update order
print "<form action=\"update-order.php\" method=\"get\">";
print "<br><b>Update order</b>";
print "<table>";
print "<th>Order ID</th><th>Order Status</th><th>Ship Date</th><th>Invoice Status</th>";
print "<tr>";

print "<td>";
$u_order = "SELECT `Ord_ID` FROM `Order`";
$u_order_query = mysql_query($u_order);
print "<select name = \"update-order\" required>";
	print "<option>Select ID</option>";
	while ( $row = mysql_fetch_array($u_order_query) ) {
		$value = $row["Ord_ID"];
		print "<option value";
		print "=\"";
		print $value;
		print "\">";
		print $value;
		print "</option>";
	}
print "</select>";
print "</td>";

print "<td><input type=\"number\" name=\"o_order_status\" required></td><td><input type=\"text\" name=\"o_ship_date\" required></td><td><input type=\"text\" name=\"o_inv_status\" required></td>";
print "</tr>";
print "</table>";
print "<br>";
print "<input type=\"submit\" value=\"Update order\">";
print "</form>";











////////////////////////////////////////////////////
////////////////////////////////////////////////////
//////////////		begin test//////////////////////
////////////////////////////////////////////////////
// print "<br><br>";
// print "<br><br>";
// print "<br><br>";

// print "<b>TEST SECTION</b>";

// //query list of orders

// $order_id_statement = "SELECT `Ord_ID`, `Item_Quant`, `Item_Code` FROM `Order_Details`";
// $order_id_query = mysql_query($order_id_statement);

// print "<table>";
	// print "<th>Order number</th> <th>Name</th> <th>Item name</th> <th>Price</th> <th>Quantity</th> <th>TOTAL</th>";
	// while ( $sql_data = mysql_fetch_array($order_id_query) ) {		
			// $order_number = $sql_data['Ord_ID'];
			// $quantity = $sql_data['Item_Quant'];
			// $item_code = $sql_data['Item_Code'];

			// $find_cust_id = "SELECT `Ord_ID`, `Cust_ID` FROM `Order` WHERE `Ord_ID` = '$order_number'";
			// $f_cust_q = mysql_query($find_cust_id);
			// while ( $qwe = mysql_fetch_array($f_cust_q) ) {
				// $cust_id = $qwe['Cust_ID'];
				// $s1 = "SELECT `Cust_FName`, `Cust_LName` FROM `Customers` WHERE `Cust_ID` = '$cust_id'";
				// $q1 = mysql_query($s1);
				// while ( $q1 = mysql_fetch_array($q1) ) {
					// $fname = $q1['Cust_FName'];	
					// $lname = $q1['Cust_LName'];	
					// $name = $fname." ".$lname;				
				// }
			// }

			// $f_item_name = "SELECT `Item_Code`, `Item_Name`, `Item_Price` FROM `Inventory` WHERE `Item_Code` = '$item_code'";
			// $item_name_q = mysql_query($f_item_name);
			// while ( $item_name_data = mysql_fetch_array($item_name_q) ) {
				// $temp = $item_name_data['Item_Code'];

				// $item_name = $item_name_data['Item_Name'];

				// $price = $item_name_data['Item_Price'];
			// }

			// $total = $price * $quantity;	
		// print "<tr>";
		// print "<td>$order_number</td> <td>$name</td> <td>$item_name</td> <td>$price</td> <td>$quantity</td> <td>$total</td>";
		// print "</tr>";
	// }
	
// print "</table>";
// print "<br><button onclick=\"update_price()\">Update table</button>";
// print "<br><br>";
// print "<input type=\"submit\" value=\"Update database\">";
// print "<br><br>";

// $statement1 = "SELECT `Cust_Email` FROM `Customers`";
// $query1 = mysql_query($statement1);
// $query_data1 = mysql_fetch_array($query1);
// $ans1 = $query_data1['Cust_Email'];
// print "<br>TEST: $ans1<br>";

////////////////////////////////////////////////////
////////////////////////////////////////////////////
//////////////		end test	//////////////////////
////////////////////////////////////////////////////



print "</body>";
print "</html>";
?>

