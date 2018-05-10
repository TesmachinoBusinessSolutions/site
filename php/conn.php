<?php
$servername = "mysql.hostinger.in";
$database = "u796769252_tesm";
$username = "u796769252_tesm";
$password = "S7kWGtOA1HEL";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}
//echo "Connected successfully";

?>
<!--/*//designed with help of https://www.sitepoint.com/publishing-mysql-data-web/*/-->
