<?php include('..\server\flux_server.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Denso | Daily Flux #4</title>
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
                    <div class="head_page">radiator flux #4</div>
                    <hr style="background-color: white; height: 2px;">
                    <div class="search-box">
                        <form action="flux.php" method="get">
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $selected_date; ?>">
                            <input type="submit" value="Search">

                        </form>
                    </div>
                    <div class="divScroll">
                        <table>
                            <thead>
                                <tr class="first_row">
                                    <th colspan="4">Core</th>
                                    <th colspan="2">Flux</th>
                                </tr>
                                <tr class="second_row">
                                    <th>Core&nbsp;Line</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>Running&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>PD&nbsp;Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["core_line"] . "</td>";
                                            echo "<td>" . $row["core_part_no"] . "</td>";
                                            echo "<td>" . $row["core_pd_date"] . "</td>";
                                            echo "<td>" . $row["core_run_no"] . "</td>";
                                            echo "<td>" . $row["flux_pd"] . "</td>";
                                            echo "<td>" . $row["flux_pd_time"] . "</td>";
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
