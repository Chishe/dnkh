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

    // Get the selected date from the POST request
    if (isset($_POST['date'])) {
        $selectedDate = $_POST['date'];

        // Prepare and execute the query
        $stmt = $pdo->prepare("SELECT core_code, core_part_no, assy_code, assy_line, nb_pd 
                               FROM helium_leak WHERE nb_pd = :date AND he_judge = ''");
        $stmt->execute(['date' => $selectedDate]);

        // Fetch results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return results as JSON
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    // ถ้ามีข้อผิดพลาดในการเชื่อมต่อหรือ query
    echo json_encode(['error' => $e->getMessage()]);
}
?>
