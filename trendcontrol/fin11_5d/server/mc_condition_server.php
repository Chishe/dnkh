<?php

$conn_mc = new mysqli("localhost","root","","dnkh");

$sql_mc_ac1 = "SELECT pressure_actual, Date, Time, status_state FROM fin_forming WHERE name_mc = 'After cut air blow 1'  ORDER BY id DESC LIMIT 1";
$result_mc_ac1 = $conn_mc->query($sql_mc_ac1);

$sql_mc_tc1 = "SELECT * FROM fin_forming WHERE name_mc = 'Twist chut air blow 1'  ORDER BY id DESC LIMIT 1";
$result_mc_tc1 = $conn_mc->query($sql_mc_tc1);

$sql_mc_ac2 = "SELECT * FROM fin_forming WHERE name_mc = 'After cut air blow 2'  ORDER BY id DESC LIMIT 1";
$result_mc_ac2 = $conn_mc->query($sql_mc_ac2);

$sql_mc_tc2 = "SELECT * FROM fin_forming WHERE name_mc = 'Twist chut air blow 2'  ORDER BY id DESC LIMIT 1";
$result_mc_tc2 = $conn_mc->query($sql_mc_tc2);

$sql_mc_ts = "SELECT * FROM fin_forming WHERE name_mc = 'Tension pressure'  ORDER BY id DESC LIMIT 1";
$result_mc_ts = $conn_mc->query($sql_mc_ts);

$sql_mc_tsa = "SELECT * FROM fin_forming WHERE name_mc = 'Tension adjust press'  ORDER BY id DESC LIMIT 1";
$result_mc_tsa = $conn_mc->query($sql_mc_tsa);

$sql_mc_flow1 = "SELECT * FROM fin_forming WHERE name_mc = 'Flow 1'  ORDER BY id DESC LIMIT 1";
$result_mc_flow1 = $conn_mc->query($sql_mc_flow1);

$sql_mc_flow2 = "SELECT * FROM fin_forming WHERE name_mc = 'Flow 2'  ORDER BY id DESC LIMIT 1";
$result_mc_flow2 = $conn_mc->query($sql_mc_flow2);

$sql_mc_flow3 = "SELECT * FROM fin_forming WHERE name_mc = 'Flow 3'  ORDER BY id DESC LIMIT 1";
$result_mc_flow3 = $conn_mc->query($sql_mc_flow3);

$sql_mc_flow4 = "SELECT * FROM fin_forming WHERE name_mc = 'Flow 4'  ORDER BY id DESC LIMIT 1";
$result_mc_flow4 = $conn_mc->query($sql_mc_flow4);

$sql_setup_ac1 = "SELECT * FROM mc_setup WHERE mc_name = 'After cut air blow 1'";
$setup_ac1 = $conn_mc->query($sql_setup_ac1);

$data = array();

// เพิ่มข้อมูลจากทุก SQL query เข้าไปใน $data
while ($row = $result_mc_ac1->fetch_assoc()) {
    $data['AfterCutAirBlow1'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_tc1->fetch_assoc()) {
    $data['TwistChutAirBlow1'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_ac2->fetch_assoc()) {
    $data['AfterCutAirBlow2'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_tc2->fetch_assoc()) {
    $data['TwistChutAirBlow2'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_ts->fetch_assoc()) {
    $data['TensionPressure'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_tsa->fetch_assoc()) {
    $data['TensionAdjustPress'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_flow1->fetch_assoc()) {
    $data['Flow1'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_flow2->fetch_assoc()) {
    $data['Flow2'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_flow3->fetch_assoc()) {
    $data['Flow3'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $result_mc_flow4->fetch_assoc()) {
    $data['Flow4'] = array(
        'date' => $row['Date'],
        'time' => $row['Time'],
        'value' => $row['pressure_actual'],
        'status' => $row['status_state'],
    );
}

while ($row = $setup_ac1->fetch_assoc()) {
    $data['SetupAC1'] = array(
        'alarm_max' => $row['alarm_max'],
        'alarm_min' => $row['alarm_min'],
        'chart_max' => $row['chart_max'],
        'chart_min' => $row['chart_min'],
        'chart_color' => $row['chart_color'],
        'gauge_max' => $row['gauge_max'],
        'gauge_min' => $row['gauge_min'],
        'gauge_color' => $row['gauge_color'],
    );
}

// เพิ่มข้อมูลจาก SQL query อื่น ๆ ได้ตามลำดับ

// ส่งข้อมูลไปยัง JavaScript
echo json_encode($data);

$conn_mc->close();
?>  