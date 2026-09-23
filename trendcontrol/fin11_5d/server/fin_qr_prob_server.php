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
$dbname = "dnkh";

$conn = new mysqli($servername,$username,$password,$dbname);

$sql = "SELECT * FROM qr_fin_forming WHERE status_part = 0 && Date = '$selected_date' ORDER BY _id DESC";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

?>