<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "packing_dnkh";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจาก POST request
    $judge = $_POST['judge'];
    $kanban_code = $_POST['kanban_code'];
    $lane = $_POST['lane'];
    $input_password = $_POST['password'];

    // ตรวจสอบรหัสผ่าน (เปลี่ยนเป็นรหัสผ่านที่ถูกต้องของคุณ)
    $correct_password = getenv('LANE_PASSWORD') ?: '';
    // echo $correct_password;
    // echo $input_password;

    if ($input_password === $correct_password) {
        // Prepare and bind
        $stmt = $conn->prepare("UPDATE core_export SET judge = ? WHERE kanban_code = ? AND lane = ?");
        $stmt->bind_param("sss", $judge, $kanban_code, $lane);

        if ($stmt->execute()) {
            echo "Record updated successfully";
            $data = array(
                'kanban_code' => $kanban_code,
                'judge' => $judge,
                'lane' => $lane
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://192.168.2.101:1880/ws/openlane");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);

            $response = curl_exec($ch);
            curl_close($ch);
            // echo "Record updated successfully and data sent to WebSocket";
            
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "รหัสผ่านไม่ถูกต้อง";
    }

}

$conn->close();
?>

