<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "packing_dnkh";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$gdate = date("Y/m/d");

$sql = "SELECT * FROM assy_6 WHERE assy_pd_date = '$gdate' ORDER BY id ASC";
$result = $conn->query($sql);
?>