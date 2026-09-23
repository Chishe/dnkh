<?php include('server/qr_history_server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="..\..\style.css">
        <title>Denso | FIN 11.5D QUALITY HISTORY</title>
        <link rel="icon" href="../../picture/Denso.png">

        <?php include("navbar/header_115_d.html") ?>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="search-box">
                        <form action="history_qr.php" method="get">
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $selected_date; ?>">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    <div class="divScroll">
                        <table>
                            <thead>
                                <tr class="first_row">
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Part No.</th>
                                    <th>Operator side</th>
                                    <th>Machine side</th>
                                    <th>Status</th>
                                    <th>After cut 1</th>
                                    <th>Twist chut 1</th>
                                    <th>After cut 2</th>
                                    <th>Twist chut 2</th>
                                    <th>Tension</th>
                                    <th>Tension adjust</th>
                                    <th>Weight A</th>
                                    <th>Weight B</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            
                                            if ($row["status_state"] == "Alarm") {
                                                echo "<tr>";
                                                echo "<td style='color:#CC181F'>" . $row["date"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["time"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["part_no"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["op_side"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["mc_side"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["status_state"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["after_cut_1"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["twist_chut_1"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["after_cut_2"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["twist_chut_2"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["tension"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["tension_adjust"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["weight_a"] . "</td>";
                                                echo "<td style='color:#CC181F'>" . $row["weight_b"] . "</td>";
                                                echo "</tr>";
                                            }
                                            else {
                                                echo "<tr>";
                                                echo "<td>" . $row["date"] . "</td>";
                                                echo "<td>" . $row["time"] . "</td>";
                                                echo "<td>" . $row["part_no"] . "</td>";
                                                echo "<td>" . $row["op_side"] . "</td>";
                                                echo "<td>" . $row["mc_side"] . "</td>";
                                                echo "<td>" . $row["status_state"] . "</td>";
                                                echo "<td>" . $row["after_cut_1"] . "</td>";
                                                echo "<td>" . $row["twist_chut_1"] . "</td>";
                                                echo "<td>" . $row["after_cut_2"] . "</td>";
                                                echo "<td>" . $row["twist_chut_2"] . "</td>";
                                                echo "<td>" . $row["tension"] . "</td>";
                                                echo "<td>" . $row["tension_adjust"] . "</td>";
                                                echo "<td>" . $row["weight_a"] . "</td>";
                                                echo "<td>" . $row["weight_b"] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    // สร้างตัวแปร
    var myVariable = "QUALITY PROBLEM";

    // แสดงข้อความใน HTML ตามค่าของตัวแปร
    document.getElementById("message").textContent = myVariable;
</script>
<style>
    td {
        border: 1px solid white;
        padding: 1vh;
        text-align: center;
        color: white;
        font-weight: bold;
        /* background-color: lightgray; */
    }

    tr.alarm {
        color: red; /* สีตัวอักษรแดงสำหรับคอลัมน์ "status" เป็น "alarm" */
    }
</style>

