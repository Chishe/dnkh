<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dnkh";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_user = $_POST["yourId"];
$recorder = $_POST["recorder"];
$date_patrol = $_POST["date_patrol"];
$time_start = $_POST["timeStart"];
$time_stop = $_POST["timeStop"];
$round = $_POST["round"];
$shift = $_POST["shift"];
$graph_quality = $_POST["quality1Hidden"];
$history_quality = $_POST["quality2Hidden"];
$recovered_quality = $_POST["dropdownQuality"];
$problem_quality = $_POST["textboxQuality"];
$graph_machine = $_POST["Machine1Hidden"];
$history_machine = $_POST["Machine2Hidden"];
$recovered_machine = $_POST["dropdownMachine"];
$problem_machine = $_POST["textboxMachine"];

$graph_quality_b = $_POST["quality1Hidden_b"];
$history_quality_b = $_POST["quality2Hidden_b"];
$recovered_quality_b = $_POST["dropdownQuality_b"];
$problem_quality_b = $_POST["textboxQuality_b"];
$graph_machine_b = $_POST["Machine1Hidden_b"];
$history_machine_b = $_POST["Machine2Hidden_b"];
$recovered_machine_b = $_POST["dropdownMachine_b"];
$problem_machine_b = $_POST["textboxMachine_b"];

$graph_quality_c = $_POST["quality1Hidden_c"];
$history_quality_c = $_POST["quality2Hidden_c"];
$recovered_quality_c = $_POST["dropdownQuality_c"];
$problem_quality_c = $_POST["textboxQuality_c"];
$graph_machine_c = $_POST["Machine1Hidden_c"];
$history_machine_c = $_POST["Machine2Hidden_c"];
$recovered_machine_c = $_POST["dropdownMachine_c"];
$problem_machine_c = $_POST["textboxMachine_c"];

$graph_quality_d = $_POST["quality1Hidden_d"];
$history_quality_d = $_POST["quality2Hidden_d"];
$recovered_quality_d = $_POST["dropdownQuality_d"];
$problem_quality_d = $_POST["textboxQuality_d"];
$graph_machine_d = $_POST["Machine1Hidden_d"];
$history_machine_d = $_POST["Machine2Hidden_d"];
$recovered_machine_d = $_POST["dropdownMachine_d"];
$problem_machine_d = $_POST["textboxMachine_d"];

$graph_quality_e = $_POST["quality1Hidden_e"];
$history_quality_e = $_POST["quality2Hidden_e"];
$recovered_quality_e = $_POST["dropdownQuality_e"];
$problem_quality_e = $_POST["textboxQuality_e"];
$graph_machine_e = $_POST["Machine1Hidden_e"];
$history_machine_e = $_POST["Machine2Hidden_e"];
$recovered_machine_e = $_POST["dropdownMachine_e"];
$problem_machine_e = $_POST["textboxMachine_e"];


$suggestion = $_POST["suggestion"];

// Use prepared statement to avoid SQL injection
$sql = "INSERT INTO ll_patrol (
    id_user,
    recorder,
    date_patrol,
    time_start,
    time_stop,
    round,
    shift,

    graph_quality,
    history_quality,
    recovered_quality,
    problem_quality,
    graph_machine,
    history_machine,
    recovered_machine,
    problem_machine,

    graph_quality_b,
    history_quality_b,
    recovered_quality_b,
    problem_quality_b,
    graph_machine_b,
    history_machine_b,
    recovered_machine_b,
    problem_machine_b,

    graph_quality_c,
    history_quality_c,
    recovered_quality_c,
    problem_quality_c,
    graph_machine_c,
    history_machine_c,
    recovered_machine_c,
    problem_machine_c,
    
    graph_quality_d,
    history_quality_d,
    recovered_quality_d,
    problem_quality_d,
    graph_machine_d,
    history_machine_d,
    recovered_machine_d,
    problem_machine_d,

    graph_quality_e,
    history_quality_e,
    recovered_quality_e,
    problem_quality_e,
    graph_machine_e,
    history_machine_e,
    recovered_machine_e,
    problem_machine_e,
    suggestion
    )
VALUES (
    ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?
)";

$stmt = mysqli_prepare($conn, $sql);

// Bind parameters with types
mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssssssssssssssssssssssssssssssss",
    $id_user,
    $recorder,
    $date_patrol,
    $time_start,
    $time_stop,
    $round,
    $shift,
    $graph_quality,
    $history_quality,
    $recovered_quality,
    $problem_quality,
    $graph_machine,
    $history_machine,
    $recovered_machine,
    $problem_machine,
    $graph_quality_b,
    $history_quality_b,
    $recovered_quality_b,
    $problem_quality_b,
    $graph_machine_b,
    $history_machine_b,
    $recovered_machine_b,
    $problem_machine_b,
    $graph_quality_c,
    $history_quality_c,
    $recovered_quality_c,
    $problem_quality_c,
    $graph_machine_c,
    $history_machine_c,
    $recovered_machine_c,
    $problem_machine_c,
    $graph_quality_d,
    $history_quality_d,
    $recovered_quality_d,
    $problem_quality_d,
    $graph_machine_d,
    $history_machine_d,
    $recovered_machine_d,
    $problem_machine_d,
    $graph_quality_e,
    $history_quality_e,
    $recovered_quality_e,
    $problem_quality_e,
    $graph_machine_e,
    $history_machine_e,
    $recovered_machine_e,
    $problem_machine_e,
    $suggestion
);

if (mysqli_stmt_execute($stmt)) {
    echo "New record created successfully";

    // Redirect back to the previous page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
