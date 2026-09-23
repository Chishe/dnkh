<?php include('..\server\stock.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Denso | Daily Stock(Export)</title>
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
                    <div class="head_page">Store</div>
                    <hr style="background-color: white; height: 2px;">
                    <div class="search-box">
                        <form action="stock.php" method="get">
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $selected_date; ?>">
                            <input type="submit" value="Search">

                        </form>
                    </div>
                    <div class="divScroll">
                        <table>
                            <thead>
                                <tr class="first_row">
                                    <th>Packing&nbsp;No.</th>
                                    <th>Ship&nbsp;Location</th>
                                    <th>Casemark</th>
                                    <th>Packing&nbsp;Lane</th>
                                    <th>Staging&nbsp;PD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["packing_no"] . "</td>";
                                            echo "<td>" . $row["staging_ship_location"] . "</td>";
                                            echo "<td>" . $row["staging_casemark"] . "</td>";
                                            echo "<td>" . $row["stacking_packing_lane"] . "</td>";
                                            echo "<td>" . $row["staging_date"] . "</td>";
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