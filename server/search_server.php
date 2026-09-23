<?php

if (isset($_GET['input_data'])) {
    $input_data = $_GET['input_data'];
} else {
    $input_data = "";
}

if (isset($_GET['columns'])) {
    $search_data = $_GET['columns'];
} else {
    $search_data = "*";
}

if (isset($_GET['insert_box'])) {
    $search_value = $_GET['insert_box'];
} else {
    $search_value = "";
}

if (isset($_GET['columns_2'])) {
    $search_data_2 = $_GET['columns_2'];
} else {
    $search_data_2 = "*";
}

if (isset($_GET['insert_box_2'])) {
    $search_value_2 = $_GET['insert_box_2'];
} else {
    $search_value_2 = "";
}

if (isset($_GET['columns_3'])) {
    $search_data_3 = $_GET['columns_3'];
} else {
    $search_data_3 = "*";
}

if (isset($_GET['insert_box_3'])) {
    $search_value_3 = $_GET['insert_box_3'];
} else {
    $search_value_3 = "";
}

if (isset($_GET['columns_4'])) {
    $search_data_4 = $_GET['columns_4'];
} else {
    $search_data_4 = "*";
}

if (isset($_GET['insert_box_4'])) {
    $search_value_4 = $_GET['insert_box_4'];
} else {
    $search_value_4 = "";
}

if (isset($_GET['columns_5'])) {
    $search_data_5 = $_GET['columns_5'];
} else {
    $search_data_5 = "*";
}

if (isset($_GET['insert_box_5'])) {
    $search_value_5 = $_GET['insert_box_5'];
} else {
    $search_value_5 = "";
}

$string = $input_data;


if (strlen($string) <= 20) {
    $year_substring = substr($string, 0, 1); // inputdata , start bit , bit length
    $month_substring = substr($string, 1, 1);
    $date_substring = substr($string, 2, 1);
    $part_no_substring = substr($string, 9, 4);

    if ($year_substring == 'A') {
        $year_substring = "2023";
    } else if ($year_substring == 'B') {
        $year_substring = "2024";
    } else if ($year_substring == 'C') {
        $year_substring = "2025";
    } else if ($year_substring == 'D') {
        $year_substring = "2026";
    } else if ($year_substring == 'E') {
        $year_substring = "2027";
    } else if ($year_substring == 'F') {
        $year_substring = "2028";
    }

    if ($month_substring == 'A') {
        $month_substring = "01";
    } else if ($month_substring == 'B') {
        $month_substring = "02";
    } else if ($month_substring == 'C') {
        $month_substring = "03";
    } else if ($month_substring == 'D') {
        $month_substring = "04";
    } else if ($month_substring == 'E') {
        $month_substring = "05";
    } else if ($month_substring == 'F') {
        $month_substring = "06";
    } else if ($month_substring == 'G') {
        $month_substring = "07";
    } else if ($month_substring == 'H') {
        $month_substring = "08";
    } else if ($month_substring == 'I') {
        $month_substring = "09";
    } else if ($month_substring == 'J') {
        $month_substring = "10";
    } else if ($month_substring == 'K') {
        $month_substring = "11";
    } else if ($month_substring == 'L') {
        $month_substring = "12";
    }

    if ($date_substring == '1') {
        $date_substring = "01";
    } else if ($date_substring == '2') {
        $date_substring = "02";
    } else if ($date_substring == '3') {
        $date_substring = "03";
    } else if ($date_substring == '4') {
        $date_substring = "04";
    } else if ($date_substring == '5') {
        $date_substring = "05";
    } else if ($date_substring == '6') {
        $date_substring = "06";
    } else if ($date_substring == '7') {
        $date_substring = "07";
    } else if ($date_substring == '8') {
        $date_substring = "08";
    } else if ($date_substring == '9') {
        $date_substring = "09";
    } else if ($date_substring == 'A') {
        $date_substring = "10";
    } else if ($date_substring == 'B') {
        $date_substring = "11";
    } else if ($date_substring == 'C') {
        $date_substring = "12";
    } else if ($date_substring == 'D') {
        $date_substring = "13";
    } else if ($date_substring == 'E') {
        $date_substring = "14";
    } else if ($date_substring == 'F') {
        $date_substring = "15";
    } else if ($date_substring == 'G') {
        $date_substring = "16";
    } else if ($date_substring == 'H') {
        $date_substring = "17";
    } else if ($date_substring == 'I') {
        $date_substring = "18";
    } else if ($date_substring == 'J') {
        $date_substring = "19";
    } else if ($date_substring == 'K') {
        $date_substring = "20";
    } else if ($date_substring == 'L') {
        $date_substring = "21";
    } else if ($date_substring == 'M') {
        $date_substring = "22";
    } else if ($date_substring == 'N') {
        $date_substring = "23";
    } else if ($date_substring == 'O') {
        $date_substring = "24";
    } else if ($date_substring == 'P') {
        $date_substring = "25";
    } else if ($date_substring == 'Q') {
        $date_substring = "26";
    } else if ($date_substring == 'R') {
        $date_substring = "27";
    } else if ($date_substring == 'S') {
        $date_substring = "28";
    } else if ($date_substring == 'T') {
        $date_substring = "29";
    } else if ($date_substring == 'U') {
        $date_substring = "30";
    } else if ($date_substring == 'V') {
        $date_substring = "31";
    }
    $pd = $year_substring . "-" . $month_substring . "-" . $date_substring;
    $run_no_substring = 'C' . substr($string, 3, 1) . $year_substring . $month_substring . $date_substring . substr($string, 4, 4);
}

if (strlen($string) > 20) {
    $run_no_substring = substr($string, 26, 4);
    $part_no_substring = substr($string, 0, 8) . "-" . substr($string, 8, 4);
    $pd = "20" . substr($string, 14, 2) . "-" . substr($string, 16, 2) . "-" . substr($string, 18, 2);
}


// echo $selected_substring;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "packing_dnkh";

$conn = new mysqli($servername, $username, $password, $dbname);

// echo $input_data;


// $data = json_decode(file_get_contents("php://input"), true);
if ($input_data == "" && $search_value != "" && $search_value_2 == "" && $search_value_3 == "" && $search_value_4 == "" && $search_value_5 == "") {
    $sql = "SELECT * FROM traceability WHERE $search_data = '$search_value'  ORDER BY core_run_no ASC";
} else if ($search_value != "" && $search_value_2 != "" && $search_value_3 == "" && $search_value_4 == "" && $search_value_5 == "") {
    $sql = "SELECT * FROM traceability WHERE $search_data = '$search_value' AND $search_data_2 = '$search_value_2' ORDER BY assy_run_no DESC";
} else if ($search_value != "" && $search_value_2 != "" && $search_value_3 != "" && $search_value_4 == "" && $search_value_5 == "") {
    $sql = "SELECT * FROM traceability WHERE $search_data = '$search_value' AND $search_data_2 = '$search_value_2' AND $search_data_3 = '$search_value_3' ORDER BY assy_run_no ASC";
} else if ($search_value != "" && $search_value_2 != "" && $search_value_3 != "" && $search_value_4 != "" && $search_value_5 == "") {
    $sql = "SELECT * FROM traceability WHERE $search_data = '$search_value' AND $search_data_2 = '$search_value_2' AND $search_data_3 = '$search_value_3' AND $search_data_4 = '$search_value_4' ORDER BY assy_run_no ASC";
} else if ($search_value != "" && $search_value_2 != "" && $search_value_3 != "" && $search_value_4 != "" && $search_value_5 != "") {
    $sql = "SELECT * FROM traceability WHERE $search_data = '$search_value' AND $search_data_2 = '$search_value_2' AND $search_data_3 = '$search_value_3' AND $search_data_4 = '$search_value_4' AND $search_data_5 = '$search_value_5' ORDER BY assy_run_no ASC";
} else {
    if (strlen($string) <= 20) {
        $sql = "SELECT * FROM traceability WHERE core_part_no = '$part_no_substring' && core_pd_date = '$pd' && core_run_no = '$run_no_substring'  ORDER BY core_run_no ASC";
    }
    if (strlen($string) > 20) {
        $sql = "SELECT * FROM traceability WHERE assy_part_no = '$part_no_substring' && assy_pd_date = '$pd' && assy_run_no = '$run_no_substring'  ORDER BY assy_run_no ASC";
        // echo "assy";
    }
    if ($string == "all") {
        $sql = "SELECT * FROM traceability WHERE 1 ORDER BY id DESC LIMIT 100";
    }



    //     SELECT * FROM traceability
    // WHERE CONCAT(core_pd_date, ' ', core_pd_time) BETWEEN '2023-11-21 11:42' AND '2023-11-21 12:42';

}
if (isset($_GET['column'], $_GET['startDate'], $_GET['endDate'])) {
     $column = htmlspecialchars($_GET['column']);
     $startDate = htmlspecialchars($_GET['startDate']);
    //  echo($startDate);
     $endDate = htmlspecialchars($_GET['endDate']);
    if ($column == 'nb' || $column == 'flux') {
        $dateColumn = $column . '_pd';
    }
    else {
        $dateColumn = $column . '_pd_date';
    }
    $timeColumn = $column . '_pd_time';
    $sql = "SELECT * FROM traceability WHERE CONCAT($dateColumn, 'T', $timeColumn) BETWEEN '$startDate' AND '$endDate'";
}
$result = $conn->query($sql);
