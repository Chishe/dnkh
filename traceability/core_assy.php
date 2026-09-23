<?php include('..\server\core_server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Denso | Daily Rad. Core assembly #1</title>
        <link rel="icon" href="../picture/Denso.png">

        <?php include("..\partial\header.html") ?>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 nav">
                    <?php include("../partial/navbar.html") ?>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="head_page">radiator core assembly #1</div>
                    <hr style="background-color: white; height: 2px;">
                    <div class="search-box">
                        <form action="core_assy.php" method="get">
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $selected_date; ?>">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    <div class="divScroll">
                        <table>
                            <thead>
                                <tr class="first_row">
                                    <th colspan="5">Tube</th>
                                    <th colspan="5">Insert</th>
                                    <th colspan="5">Fin</th>
                                    <th colspan="5">Coreplate</th>
                                    <th colspan="4">Core</th>
                                </tr>
                                <tr class="second_row">
                                    <th>Mat.&nbsp;No.</th>
                                    <th>Mat.&nbsp;Lot</th>
                                    <th>Mat.&nbsp;Date</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>Mat.&nbsp;No.</th>
                                    <th>Mat.&nbsp;Lot</th>
                                    <th>Mat.&nbsp;Date</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>Mat.&nbsp;No.</th>
                                    <th>Mat.&nbsp;Lot</th>
                                    <th>Mat.&nbsp;Date</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>Mat.&nbsp;No.</th>
                                    <th>Mat.&nbsp;Lot</th>
                                    <th>Mat.&nbsp;Date</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>PD&nbsp;Time</th>
                                    <th>Running&nbsp;No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["tube_mat_no"] . "</td>";
                                            echo "<td>" . $row["tube_mat_lot"] . "</td>";
                                            echo "<td>" . $row["tube_mat_date"] . "</td>";
                                            echo "<td>" . $row["tube_part_no"] . "</td>";
                                            echo "<td>" . $row["tube_pd"] . "</td>";
                                            echo "<td>" . $row["insert_mat_no"] . "</td>";
                                            echo "<td>" . $row["insert_mat_lot"] . "</td>";
                                            echo "<td>" . $row["insert_mat_date"] . "</td>";
                                            echo "<td>" . $row["insert_part_no"] . "</td>";
                                            echo "<td>" . $row["insert_pd"] . "</td>";
                                            echo "<td>" . $row["fin_mat_no"] . "</td>";
                                            echo "<td>" . $row["fin_mat_lot"] . "</td>";
                                            echo "<td>" . $row["fin_mat_date"] . "</td>";
                                            echo "<td>" . $row["fin_part_no"] . "</td>";
                                            echo "<td>" . $row["fin_pd"] . "</td>";
                                            echo "<td>" . $row["coreplate_mat_no"] . "</td>";
                                            echo "<td>" . $row["coreplate_mat_lot"] . "</td>";
                                            echo "<td>" . $row["coreplate_mat_date"] . "</td>";
                                            echo "<td>" . $row["coreplate_part_no"] . "</td>";
                                            echo "<td>" . $row["coreplate_pd"] . "</td>";
                                            echo "<td>" . $row["core_part_no"] . "</td>";
                                            echo "<td>" . $row["core_pd_date"] . "</td>";
                                            echo "<td>" . $row["core_pd_time"] . "</td>";
                                            echo "<td>" . $row["core_run_no"] . "</td>";
                                            echo "</tr>";
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
<style>
    
</style>
<script>
    var columnSelect = document.getElementById("columns");
    var message = document.getElementById("insert_box");

    columnSelect.addEventListener("change", function () {
        if (columnSelect.value === "assy_pd") {
            message.placeholder = "YYMMDDHHmm";
        } else {
            message.placeholder = "Insert Data";
        }
    });  
</script>