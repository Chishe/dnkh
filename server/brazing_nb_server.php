<?php

// ตรวจสอบว่าผู้ใช้ได้เลือกวันที่หรือยัง
if (isset($_GET['selected_date'])) {
    $selected_date = $_GET['selected_date'];

} else {
    // ถ้ายังไม่ได้เลือกวันที่ให้ใช้วันปัจจุบัน
    $selected_date = date('Y-m-d');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "packing_dnkh";

$conn = new mysqli($servername,$username,$password,$dbname);

$sql = "SELECT * FROM nb_1 WHERE nb_pd = '$selected_date' ORDER BY id ASC";
$result = $conn->query($sql);

?>