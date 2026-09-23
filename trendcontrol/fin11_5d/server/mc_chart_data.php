<?php
    $conn_mc = new mysqli("localhost","root","","dnkh");

    $sql_chart_ac1 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'After cut air blow 1' ORDER BY id DESC LIMIT 10";
    $result_chart_ac1 = $conn_mc->query($sql_chart_ac1);

    $sql_chart_tc1 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Twist chut air blow 1' ORDER BY id DESC LIMIT 10";
    $result_chart_tc1 = $conn_mc->query($sql_chart_tc1);

    $sql_chart_ac2 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'After cut air blow 2' ORDER BY id DESC LIMIT 10";
    $result_chart_ac2 = $conn_mc->query($sql_chart_ac2);

    $sql_chart_tc2 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Twist chut air blow 2' ORDER BY id DESC LIMIT 10";
    $result_chart_tc2 = $conn_mc->query($sql_chart_tc2);

    $sql_chart_ts = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Tension pressure' ORDER BY id DESC LIMIT 10";
    $result_chart_ts = $conn_mc->query($sql_chart_ts);

    $sql_chart_tsa = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Tension adjust press' ORDER BY id DESC LIMIT 10";
    $result_chart_tsa = $conn_mc->query($sql_chart_tsa);

    $sql_chart_flow1 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Flow 1' ORDER BY id DESC LIMIT 10";
    $result_chart_flow1 = $conn_mc->query($sql_chart_flow1);

    $sql_chart_flow2 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Flow 2' ORDER BY id DESC LIMIT 10";
    $result_chart_flow2 = $conn_mc->query($sql_chart_flow2);

    $sql_chart_flow3 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Flow 3' ORDER BY id DESC LIMIT 10";
    $result_chart_flow3 = $conn_mc->query($sql_chart_flow3);

    $sql_chart_flow4 = "SELECT pressure_actual,CONCAT(Date, ' ', Time) AS datetime FROM fin_forming WHERE name_mc = 'Flow 4' ORDER BY id DESC LIMIT 10";
    $result_chart_flow4 = $conn_mc->query($sql_chart_flow4);   

    $sql_setup_ac1 = "SELECT * FROM mc_setup WHERE mc_name = 'After cut air blow 1'";
    $setup_ac1 = $conn_mc->query($sql_setup_ac1);

    $sql_setup_tc1 = "SELECT * FROM mc_setup WHERE mc_name = 'Twist chut air blow 1'";
    $setup_tc1 = $conn_mc->query($sql_setup_tc1);

    $sql_setup_ac2 = "SELECT * FROM mc_setup WHERE mc_name = 'After cut air blow 2'";
    $setup_ac2 = $conn_mc->query($sql_setup_ac2);

    $sql_setup_tc2 = "SELECT * FROM mc_setup WHERE mc_name = 'Twist chut air blow 2'";
    $setup_tc2 = $conn_mc->query($sql_setup_tc2);

    $sql_setup_ts = "SELECT * FROM mc_setup WHERE mc_name = 'Tension pressure'";
    $setup_ts = $conn_mc->query($sql_setup_ts);

    $sql_setup_tsa = "SELECT * FROM mc_setup WHERE mc_name = 'Tension adjust pressure'";
    $setup_tsa = $conn_mc->query($sql_setup_tsa);

    $sql_setup_flow1 = "SELECT * FROM mc_setup WHERE mc_name = 'Flow 1'";
    $setup_flow1 = $conn_mc->query($sql_setup_flow1);

    $sql_setup_flow2 = "SELECT * FROM mc_setup WHERE mc_name = 'Flow 2'";
    $setup_flow2 = $conn_mc->query($sql_setup_flow2);

    $sql_setup_flow3 = "SELECT * FROM mc_setup WHERE mc_name = 'Flow 3'";
    $setup_flow3 = $conn_mc->query($sql_setup_flow3);

    $sql_setup_flow4 = "SELECT * FROM mc_setup WHERE mc_name = 'Flow 4'";
    $setup_flow4 = $conn_mc->query($sql_setup_flow4);


    $dataTable1 = array();
    while ($rowTable1 = $result_chart_ac1->fetch_assoc()) {
        $dataTable1[] = $rowTable1;
    }
    $dataTable1 = array_reverse($dataTable1);

    $dataTable2 = array();
    while ($rowTable2 = $result_chart_tc1->fetch_assoc()) {
        $dataTable2[] = $rowTable2;
    }
    $dataTable2 = array_reverse($dataTable2);

    $dataTable3 = array();
    while ($rowTable3 = $result_chart_ac2->fetch_assoc()) {
        $dataTable3[] = $rowTable3;
    }
    $dataTable3 = array_reverse($dataTable3);

    $dataTable4 = array();
    while ($rowTable4 = $result_chart_tc2->fetch_assoc()) {
        $dataTable4[] = $rowTable4;
    }
    $dataTable4 = array_reverse($dataTable4);

    $dataTable5 = array();
    while ($rowTable5 = $result_chart_ts->fetch_assoc()) {
        $dataTable5[] = $rowTable5;
    }
    $dataTable5 = array_reverse($dataTable5);

    $dataTable6 = array();
    while ($rowTable6 = $result_chart_tsa->fetch_assoc()) {
        $dataTable6[] = $rowTable6;
    }
    $dataTable6 = array_reverse($dataTable6);

    $dataTable7 = array();
    while ($rowTable7 = $result_chart_flow1->fetch_assoc()) {
        $dataTable7[] = $rowTable7;
    }
    $dataTable7 = array_reverse($dataTable7);

    $dataTable8 = array();
    while ($rowTable8 = $result_chart_flow2->fetch_assoc()) {
        $dataTable8[] = $rowTable8;
    }
    $dataTable8 = array_reverse($dataTable8);

    $dataTable9 = array();
    while ($rowTable9 = $result_chart_flow3->fetch_assoc()) {
        $dataTable9[] = $rowTable9;
    }
    $dataTable9 = array_reverse($dataTable9);

    $dataTable10 = array();
    while ($rowTable10 = $result_chart_flow4->fetch_assoc()) {
        $dataTable10[] = $rowTable10;
    }
    $dataTable10 = array_reverse($dataTable10);

    $datasetupac1 = array();
    while ($rowsetupac1 = $setup_ac1->fetch_assoc()) {
        $datasetupac1[] = $rowsetupac1;
    }

    $datasetuptc1 = array();
    while ($rowsetuptc1 = $setup_tc1->fetch_assoc()) {
        $datasetuptc1[] = $rowsetuptc1;
    }

    $datasetupac2 = array();
    while ($rowsetupac2 = $setup_ac2->fetch_assoc()) {
        $datasetupac2[] = $rowsetupac2;
    }

    // $datasetupac1 = array();
    // while ($rowsetupac1 = $setup_ac1->fetch_assoc()) {
    //     $datasetupac1[] = $rowsetupac1;
    // }

    // $datasetupac1 = array();
    // while ($rowsetupac1 = $setup_ac1->fetch_assoc()) {
    //     $datasetupac1[] = $rowsetupac1;
    // }

    // $datasetupac1 = array();
    // while ($rowsetupac1 = $setup_ac1->fetch_assoc()) {
    //     $datasetupac1[] = $rowsetupac1;
    // }

    $conn_mc->close();

    echo json_encode(array('table1' => $dataTable1, 'table2' => $dataTable2, 'table3' => $dataTable3, 'table4' => $dataTable4, 'table5' => $dataTable5, 'table6' => $dataTable6, 'table7' => $dataTable7, 'table8' => $dataTable8, 'table9' => $dataTable9, 'table10' => $dataTable10, 'setupac1' => $datasetupac1));
?>