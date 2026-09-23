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


// $servername_113 = "192.168.1.113";
// $username_113 = "root_112";
// $password_113 = "";
// $dbname_113 = "tsk";

// $conn_113 = new mysqli($servername_113,$username_113,$password_113,$dbname_113);
// if(!$conn) {
//     die("connection failed".mysqli_connect_error());
// } else {
//     echo "connected!!!";
// }

$sql = "SELECT * FROM core_1 WHERE core_pd_date = '$selected_date' ORDER BY id ASC";
$result = $conn->query($sql);

// $sql_113 = "SELECT date,time,status FROM tsk_status ORDER BY id DESC";
// $result_113 = $conn_113->query($sql_113);


?>