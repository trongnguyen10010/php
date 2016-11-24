<?php
$hostname = "sql.xxx.edu";
$username = "xxxx" ;
$project = "xxx" ;
$password = "xxxx" ;
($dbh = mysql_connect ($hostname,$username,$password) ) or die ("Unable to connect to MySQL database");
mysql_select_db ($project);

// input: tons of info
$pricetotal = mysql_real_escape_string($_GET["pricetotal"]);
$mobonum = mysql_real_escape_string($_GET["mobonum"]);
$gpunum = mysql_real_escape_string($_GET["gpunum"]);
$psunum = mysql_real_escape_string($_GET["psunum"]);
$fannum = mysql_real_escape_string($_GET["fannum"]);
$csrfname = mysql_real_escape_string($_GET["csrfname"]);
$csrlname = mysql_real_escape_string($_GET["csrlname"]);
$csraddr = mysql_real_escape_string($_GET["csraddr"]);
$csrcity = mysql_real_escape_string($_GET["csrcity"]);
$csrstate = mysql_real_escape_string($_GET["csrstate"]); //get value
$csrzip = mysql_real_escape_string($_GET["csrzip"]);
$csremail = mysql_real_escape_string($_GET["csremail"]);

$statement = INSERT INTO `edc7`.`Customers` (`Cust_FName`, `Cust_LName`, `Cust_Email`, `Cust_AddrStreet`, `Cust_AddrCity`, `Cust_AddrState`, `Cust_AddrZip`) VALUES ('$csrfname', '$csrlname', '$csremail', '$csraddr', '$csrcity', '$csrstate', '$csrzip');
// $query = mysql_query($statement) or die (mysql_error());

print "done";





?>
