<?php
// Connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "packing_dnkh";

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับค่าจาก POST
    if (isset($_POST['core_code'])) {
        $coreCode = $_POST['core_code'];

        // เตรียมคำสั่ง SQL สำหรับอัพเดตฐานข้อมูล
        $stmt = $pdo->prepare("UPDATE helium_leak SET he_judge = 'OK', he_date = 'config' WHERE core_code = :core_code");
        $stmt->execute(['core_code' => $coreCode]);

        // ส่งผลลัพธ์ว่าอัพเดตสำเร็จ
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Core code not provided']);
    }
} catch (PDOException $e) {
    // ถ้ามีข้อผิดพลาดในการเชื่อมต่อหรืออัพเดต
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
