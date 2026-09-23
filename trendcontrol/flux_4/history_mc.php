<?php include("server/mc_history_server.php") ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="..\..\style.css">
    <title>Denso | FIN 11.5D MACHINE HISTORY</title>
    <link rel="icon" href="../../picture/Denso.png">

    <?php include("navbar/header_115_d.html") ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                $selected_date = isset($_GET['flux_pd']) ? $_GET['flux_pd'] : null;
                $flux_pd = isset($_GET['flux_pd']) ? htmlspecialchars($_GET['flux_pd']) : '';
                $selected_date = isset($_GET['selected_date']) ? $_GET['selected_date'] : null;
                $sql = "SELECT * FROM fin_forming WHERE Date = '$selected_date' ORDER BY id ASC";
                $result = $conn->query($sql);
                ?>
                <div class="search-box">
                    <form action="history_mc.php" method="get">
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
                                <th>Item</th>
                                <th>Max</th>
                                <th>Min</th>
                                <th>Actual</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row["status_state"] == "Alarm") {
                                        echo "<tr>";
                                        echo "<td style='color:#CC181F'>" . $row["Date"] . "</td>";
                                        echo "<td style='color:#CC181F'>" . $row["Time"] . "</td>";
                                        echo "<td style='color:#CC181F'>" . $row["name_mc"] . "</td>";
                                        echo "<td style='color:#CC181F'>" . $row["pressure_max"] . "</td>";
                                        echo "<td style='color:#CC181F'>" . $row["pressure_min"] . "</td>";
                                        echo "<td style='color:#CC181F'>" . $row["pressure_actual"] . "</td>";
                                        echo "<td style='color:#CC181F'>" . $row["status_state"] . "</td>";
                                        echo "</tr>";
                                    } else {
                                        echo "</tr>";
                                        echo "<td>" . $row["Date"] . "</td>";
                                        echo "<td>" . $row["Time"] . "</td>";
                                        echo "<td>" . $row["name_mc"] . "</td>";
                                        echo "<td>" . $row["pressure_max"] . "</td>";
                                        echo "<td>" . $row["pressure_min"] . "</td>";
                                        echo "<td>" . $row["pressure_actual"] . "</td>";
                                        echo "<td>" . $row["status_state"] . "</td>";
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
    var myVariable = "MACHINE HISTORY";

    // แสดงข้อความใน HTML ตามค่าของตัวแปร
    document.getElementById("message").textContent = myVariable;
</script>