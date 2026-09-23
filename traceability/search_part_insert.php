<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Denso | Sub-Part Searching</title>
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
                    <div class="head_page">search : sub-part (insert)</div>
                    <hr style="background-color: white; height: 2px;">
                    <div class="search_page_box">
                        <a href="search_part.php">
                            <input class="page_button" type="button" value="TUBE PART">
                        </a>
                        <a href="search_part_ptank.php">
                            <input class="page_button" type="button" value="P-TANK PART">
                        </a>

                            <input class="page_button" style="background-color: lightcoral;" type="button" value="INSERT PART">
                        
                    </div>
                    <div class="search-box">
                        <label for="columns" style="color: white; font-size: 20px; font-weight: bold;">select column of table for search:</label>
                        <select id="columns" name="columns">
                            <option value="">-- select --</option>
                            <option value="insert_mat_date">Insert Mat. Date</option>
                            <option value="insert_mat_lot">Insert Mat. Lot</option>
                            <option value="insert_mat_no">Insert Mat. No.</option>
                            <option value="insert_part_no">Insert Part No.</option>
                            <option value="insert_pd">Insert PD Date</option>
                            <option value="packing_casemark">Packing Casemark</option>
                            <option value="packing_expire">Packing Expire Date</option>
                            <option value="packing_pd">Packing PD Date</option>
                            <option value="packing_run_no">Packing Running No.</option>
                            <option value="packing_ship">Packing Ship Location</option>
                            <option value="packing_lane">Packing Stock Lane</option>
                            
                        </select>
                        <span style="color: white; font-size: 20px; font-weight: bold;"> &nbsp;&nbsp;Insert your data : </span>
                        <input id="insert_box" type="text" name="data_value" placeholder="Insert data">
                        <button id="seacrh_box" style="justify-content: end;">search</button>
                    </div>
                    <div class="divScroll" style="height: 65vh;">
                        <table>
                            <thead>
                                <tr class="first_row">
                                    <th colspan="5">Insert</th>
                                    <th colspan="6">Packing</th>
                                </tr>
                                <tr class="second_row">
                                    <th>Mat.&nbsp;No.</th>
                                    <th>Mat.&nbsp;Lot</th>
                                    <th>Mat.&nbsp;Date</th>
                                    <th>Part&nbsp;No.</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>PD&nbsp;Date</th>
                                    <th>Expire&nbsp;Date</th>
                                    <th>Running&nbsp;No.</th>
                                    <th>Ship&nbsp;Location</th>
                                    <th>Casemark</th>
                                    <th>Packing&nbsp;Lane</th>
                                </tr>
                            </thead>
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
        if (columnSelect.value === "packing_pd") {
            message.placeholder = "YYMMDDHHmm";
        } else {
            message.placeholder = "Insert Data";
        }
    });
</script>