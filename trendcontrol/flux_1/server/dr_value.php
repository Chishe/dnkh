<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dnkh";

$conn = new mysqli($servername,$username,$password,$dbname);

$sql_KN222310_8750 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_8750'";
$result_KN222310_8750 = $conn->query($sql_KN222310_8750);

$sql_KN233310_1880 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN233310_1880'";
$result_KN233310_1880 = $conn->query($sql_KN233310_1880);

$sql_KN222310_9320 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_9320'";
$result_KN222310_9320 = $conn->query($sql_KN222310_9320);

$sql_KN222310_9350 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_9350'";
$result_KN222310_9350 = $conn->query($sql_KN222310_9350);

$sql_KN222310_9650 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_9650'";
$result_KN222310_9650 = $conn->query($sql_KN222310_9650);

$sql_KN222310_9710 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_9710'";
$result_KN222310_9710 = $conn->query($sql_KN222310_9710);

$sql_KN222310_9110 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_9110'";
$result_KN222310_9110 = $conn->query($sql_KN222310_9110);

$sql_KN233310_5080 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN233310_5080'";
$result_KN233310_5080 = $conn->query($sql_KN233310_5080);

$sql_KN222310_9970 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN222310_9970'";
$result_KN222310_9970 = $conn->query($sql_KN222310_9970);

$sql_KN233310_0090 = "SELECT fix_value,plus_minus FROM qr_setup WHERE part_no = 'KN233310_0090'";
$result_KN233310_0090 = $conn->query($sql_KN233310_0090);

$data = array();

while ($row = $result_KN222310_8750->fetch_assoc()) {
    $data['KN222310_8750'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN233310_1880->fetch_assoc()) {
    $data['KN233310_1880'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN222310_9320->fetch_assoc()) {
    $data['KN222310_9320'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN222310_9350->fetch_assoc()) {
    $data['KN222310_9350'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN222310_9650->fetch_assoc()) {
    $data['KN222310_9650'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN222310_9710->fetch_assoc()) {
    $data['KN222310_9710'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN222310_9110->fetch_assoc()) {
    $data['KN222310_9110'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN233310_5080->fetch_assoc()) {
    $data['KN233310_5080'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN222310_9970->fetch_assoc()) {
    $data['KN222310_9970'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

while ($row = $result_KN233310_0090->fetch_assoc()) {
    $data['KN233310_0090'] = array(
        'fix_value' => $row['fix_value'],
        'plus_minus' => $row['plus_minus'],
    );
}

// echo json_encode($data);

?>

