<?php

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

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$time_intervals = [
    '07:30-09:30', '09:30-11:30', '11:30-13:30', '13:30-15:30', '15:30-17:30',
    '17:30-19:30', '19:30-21:30', '21:30-23:30', '23:30-01:30', '01:30-03:30',
    '03:30-05:30', '05:30-07:30'
];

$sql = "
    SELECT 
        CASE 
            WHEN TIME(assy_time) >= '07:30:00' AND TIME(assy_time) < '09:30:00' THEN '07:30-09:30'
            WHEN TIME(assy_time) >= '09:30:00' AND TIME(assy_time) < '11:30:00' THEN '09:30-11:30'
            WHEN TIME(assy_time) >= '11:30:00' AND TIME(assy_time) < '13:30:00' THEN '11:30-13:30'
            WHEN TIME(assy_time) >= '13:30:00' AND TIME(assy_time) < '15:30:00' THEN '13:30-15:30'
            WHEN TIME(assy_time) >= '15:30:00' AND TIME(assy_time) < '17:30:00' THEN '15:30-17:30'
            WHEN TIME(assy_time) >= '17:30:00' AND TIME(assy_time) < '19:30:00' THEN '17:30-19:30'
            WHEN TIME(assy_time) >= '19:30:00' AND TIME(assy_time) < '21:30:00' THEN '19:30-21:30'
            WHEN TIME(assy_time) >= '21:30:00' AND TIME(assy_time) < '23:30:00' THEN '21:30-23:30'
            WHEN TIME(assy_time) >= '23:30:00' OR TIME(assy_time) < '01:30:00' THEN '23:30-01:30'
            WHEN TIME(assy_time) >= '01:30:00' AND TIME(assy_time) < '03:30:00' THEN '01:30-03:30'
            WHEN TIME(assy_time) >= '03:30:00' AND TIME(assy_time) < '05:30:00' THEN '03:30-05:30'
            WHEN TIME(assy_time) >= '05:30:00' AND TIME(assy_time) < '07:30:00' THEN '05:30-07:30'
        END AS time_range,
        COUNT(*) AS total_count, 
        SUM(CASE WHEN he_judge != 'OK' THEN 1 ELSE 0 END) AS ng_count
    FROM helium_leak
    WHERE assy_date = '$selected_date'
    GROUP BY time_range
    ORDER BY MIN(assy_time)
";
$result = $conn->query($sql);

$cumulative_total_all = 0; // ยอดรวมสะสมของจำนวนทั้งหมด
$cumulative_total_ng = 0;  // ยอดรวมสะสมของ judge = 'OK'
$ratio_data = [];
$cumulative_all_data = [];
$cumulative_ng_data = [];
$data_map = [];

// จัดเก็บข้อมูลที่มีอยู่ใน array เพื่อสะดวกในการจับคู่ช่วงเวลา
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_map[$row['time_range']] = [
            'total_count' => $row['total_count'],
            'ng_count' => $row['ng_count']
        ];
    }
}

// วนลูปผ่านช่วงเวลาที่ต้องการแสดง และตรวจสอบว่าช่วงไหนไม่มีข้อมูลก็ใส่ 0
foreach ($time_intervals as $interval) {
    if (isset($data_map[$interval])) {
        $cumulative_total_all += $data_map[$interval]['total_count'];
        $cumulative_total_ng += $data_map[$interval]['ng_count'];
    } else {
        // ถ้าไม่มีข้อมูลช่วงนี้ให้ใช้ 0
        $cumulative_total_all += 0;
        $cumulative_total_ng += 0;
    }

    $ratio = $cumulative_total_all > 0 ? ($cumulative_total_ng / $cumulative_total_all)*100 : 0;

    $table_data[] = [
        'time_range' => $interval,
        'total' => $cumulative_total_all,
        'ng_total' => $cumulative_total_ng,
        'ratio' => round($ratio, 2) // แสดง ratio เป็นทศนิยม 2 ตำแหน่ง
    ];

    $cumulative_all_data[] = $cumulative_total_all;
    $cumulative_ng_data[] = $cumulative_total_ng;
    $ratio_data[] = $ratio;
}


// แปลงข้อมูลเป็น JSON เพื่อใช้ใน JavaScript
?>