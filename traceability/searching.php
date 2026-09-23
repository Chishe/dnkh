<?php include('..\server\search_server.php') ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Rad. Searching</title>
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
                <div class="head_page">search : radiator</div>
                <hr style="background-color: white; height: 2px;">
                <form action="searching.php" method="get">
                    <span class="text"> Scan QR code : </span>
                    <input type="text" id="input_data" name="input_data" value="<?= htmlspecialchars($input_data) ?>">
                    <input type="submit" value="Search">
                    <?php
                    $input_data = isset($_GET['input_data']) ? htmlspecialchars($_GET['input_data']) : '';

                    $columns = isset($_GET['columns']) ? htmlspecialchars($_GET['columns']) : '';
                    $columns_2 = isset($_GET['columns_2']) ? htmlspecialchars($_GET['columns_2']) : '';
                    $columns_3 = isset($_GET['columns_3']) ? htmlspecialchars($_GET['columns_3']) : '';
                    $columns_4 = isset($_GET['columns_4']) ? htmlspecialchars($_GET['columns_4']) : '';
                    $columns_5 = isset($_GET['columns_5']) ? htmlspecialchars($_GET['columns_5']) : '';

                    $insert_box = isset($_GET['insert_box']) ? htmlspecialchars($_GET['insert_box']) : '';
                    $insert_box_2 = isset($_GET['insert_box_2']) ? htmlspecialchars($_GET['insert_box_2']) : '';
                    $insert_box_3 = isset($_GET['insert_box_3']) ? htmlspecialchars($_GET['insert_box_3']) : '';
                    $insert_box_4 = isset($_GET['insert_box_4']) ? htmlspecialchars($_GET['insert_box_4']) : '';
                    $insert_box_5 = isset($_GET['insert_box_5']) ? htmlspecialchars($_GET['insert_box_5']) : '';
                    ?>
                    <div class="search-box">
                        <div>
                            <label for="columns" class="text">select column of table for search:</label>
                            <select id="columns" name="columns">
                                <option value="" <?= $columns == '' ? 'selected' : '' ?>>-- select --</option>
                                <option value="assy_part_no" <?= $columns == 'assy_part_no' ? 'selected' : '' ?>>ASSY Part No.</option>
                                <option value="assy_pd_date" <?= $columns == 'assy_pd_date' ? 'selected' : '' ?>>ASSY PD Date</option>
                                <option value="assy_run_no" <?= $columns == 'assy_run_no' ? 'selected' : '' ?>>ASSY Running No.</option>
                                <option value="assy_packing_part_no" <?= $columns == 'assy_packing_part_no' ? 'selected' : '' ?>>Assy Packing Part No.</option>
                                <option value="assy_packing_pd_date" <?= $columns == 'assy_packing_pd_date' ? 'selected' : '' ?>>Assy Packing PD Date</option>
                                <option value="assy_packing_run_no" <?= $columns == 'assy_packing_run_no' ? 'selected' : '' ?>>Assy Packing Running No.</option>
                                <option value="core_part_no" <?= $columns == 'core_part_no' ? 'selected' : '' ?>>Core Part No.</option>
                                <option value="core_pd_date" <?= $columns == 'core_pd_date' ? 'selected' : '' ?>>Core PD Date</option>
                                <option value="core_run_no" <?= $columns == 'core_run_no' ? 'selected' : '' ?>>Core Running No.</option>
                                <option value="coreplate_mat_date" <?= $columns == 'coreplate_mat_date' ? 'selected' : '' ?>>Coreplate Mat. Date</option>
                                <option value="coreplate_mat_lot" <?= $columns == 'coreplate_mat_lot' ? 'selected' : '' ?>>Coreplate Mat. Lot</option>
                                <option value="coreplate_mat_no" <?= $columns == 'coreplate_mat_no' ? 'selected' : '' ?>>Coreplate Mat. No.</option>
                                <option value="coreplate_part_no" <?= $columns == 'coreplate_part_no' ? 'selected' : '' ?>>Coreplate Part No.</option>
                                <option value="coreplate_pd" <?= $columns == 'coreplate_pd' ? 'selected' : '' ?>>Coreplate PD Date</option>
                                <option value="fin_mat_date" <?= $columns == 'fin_mat_date' ? 'selected' : '' ?>>Fin Mat. Date</option>
                                <option value="fin_mat_lot" <?= $columns == 'fin_mat_lot' ? 'selected' : '' ?>>Fin Mat. Lot</option>
                                <option value="fin_mat_no " <?= $columns == 'fin_mat_no' ? 'selected' : '' ?>>Fin Mat. No.</option>
                                <option value="fin_part_no" <?= $columns == 'fin_part_no' ? 'selected' : '' ?>>Fin Part No.</option>
                                <option value="fin_pd" <?= $columns == 'fin_pd' ? 'selected' : '' ?>>Fin PD Date</option>
                                <option value="flux_pd" <?= $columns == 'flux_pd' ? 'selected' : '' ?>>Flux PD Date</option>
                                <option value="insert_mat_date" <?= $columns == 'insert_mat_date' ? 'selected' : '' ?>>Insert Mat. Date</option>
                                <option value="insert_mat_lot" <?= $columns == 'insert_mat_lot' ? 'selected' : '' ?>>Insert Mat. Lot</option>
                                <option value="insert_mat_no" <?= $columns == 'insert_mat_no' ? 'selected' : '' ?>>Insert Mat. No.</option>
                                <option value="insert_part_no" <?= $columns == 'insert_part_no' ? 'selected' : '' ?>>Insert Part No.</option>
                                <option value="insert_pd" <?= $columns == 'insert_pd' ? 'selected' : '' ?>>Insert PD Date</option>
                                <option value="nb_pd" <?= $columns == 'nb_pd' ? 'selected' : '' ?>>NB PD Date</option>
                                <option value="PTank_lwr_mat_date" <?= $columns == 'PTank_lwr_mat_date' ? 'selected' : '' ?>>P-Tank LWR Mat. Date</option>
                                <option value="PTank_lwr_mat_lot" <?= $columns == 'PTank_lwr_mat_lot' ? 'selected' : '' ?>>P-Tank LWR Mat. Lot</option>
                                <option value="PTank_lwr_mat_no" <?= $columns == 'PTank_lwr_mat_no' ? 'selected' : '' ?>>P-Tank LWR Mat. No.</option>
                                <option value="PTank_lwr_part_no" <?= $columns == 'PTank_lwr_part_no' ? 'selected' : '' ?>>P-Tank LWR Part No.</option>
                                <option value="PTank_lwr_pd_date" <?= $columns == 'PTank_lwr_pd_date' ? 'selected' : '' ?>>P-Tank LWR PD Date</option>
                                <option value="PTank_upr_mat_date" <?= $columns == 'PTank_upr_mat_date' ? 'selected' : '' ?>>P-Tank UPR Mat. Date</option>
                                <option value="PTank_upr_mat_lot" <?= $columns == 'PTank_upr_mat_lot' ? 'selected' : '' ?>>P-Tank UPR Mat. Lot</option>
                                <option value="PTank_upr_mat_no" <?= $columns == 'PTank_upr_mat_no' ? 'selected' : '' ?>>P-Tank UPR Mat. No.</option>
                                <option value="PTank_upr_part_no" <?= $columns == 'PTank_upr_part_no' ? 'selected' : '' ?>>P-Tank UPR Part No.</option>
                                <option value="PTank_upr_pd_date" <?= $columns == 'PTank_upr_pd_date' ? 'selected' : '' ?>>P-Tank UPR PD Date</option>
                                <option value="staging_casemark" <?= $columns == 'staging_casemark' ? 'selected' : '' ?>>Staging Casemark</option>
                                <option value="stacking_packing_lane" <?= $columns == 'stacking_packing_lane' ? 'selected' : '' ?>>Staging Packing Lane</option>
                                <option value="staging_ship_location" <?= $columns == 'staging_ship_location' ? 'selected' : '' ?>>Staging Ship Location</option>
                                <option value="tube_mat_date" <?= $columns == 'tube_mat_date' ? 'selected' : '' ?>>Tube Mat. Date</option>
                                <option value="tube_mat_lot" <?= $columns == 'tube_mat_lot' ? 'selected' : '' ?>>Tube Mat. Lot</option>
                                <option value="tube_mat_no" <?= $columns == 'tube_mat_no' ? 'selected' : '' ?>>Tube Mat. No.</option>
                                <option value="tube_part_no" <?= $columns == 'tube_part_no' ? 'selected' : '' ?>>Tube Part No.</option>
                                <option value="tube_pd" <?= $columns == 'tube_pd' ? 'selected' : '' ?>>Tube PD Date</option>
                            </select>
                            <span class="text"> &nbsp;&nbsp;Insert your data : </span>
                            <input type="text" id="insert_box" name="insert_box" value="<?= htmlspecialchars($insert_box) ?>">
                            <!-- <input type="submit" value="Search"> -->
                        </div>
                        <div>
                            <label for="columns_2" class="text">select column of table for search:</label>
                            <select id="columns_2" name="columns_2">
                                <option value="" <?= $columns_2 == '' ? 'selected' : '' ?>>-- select --</option>
                                <option value="assy_part_no" <?= $columns_2 == 'assy_part_no' ? 'selected' : '' ?>>ASSY Part No.</option>
                                <option value="assy_pd_date" <?= $columns_2 == 'assy_pd_date' ? 'selected' : '' ?>>ASSY PD Date</option>
                                <option value="assy_run_no" <?= $columns_2 == 'assy_run_no' ? 'selected' : '' ?>>ASSY Running No.</option>
                                <option value="assy_packing_part_no" <?= $columns_2 == 'assy_packing_part_no' ? 'selected' : '' ?>>Assy Packing Part No.</option>
                                <option value="assy_packing_pd_date" <?= $columns_2 == 'assy_packing_pd_date' ? 'selected' : '' ?>>Assy Packing PD Date</option>
                                <option value="assy_packing_run_no" <?= $columns_2 == 'assy_packing_run_no' ? 'selected' : '' ?>>Assy Packing Running No.</option>
                                <option value="core_part_no" <?= $columns_2 == 'core_part_no' ? 'selected' : '' ?>>Core Part No.</option>
                                <option value="core_pd_date" <?= $columns_2 == 'core_pd_date' ? 'selected' : '' ?>>Core PD Date</option>
                                <option value="core_run_no" <?= $columns_2 == 'core_run_no' ? 'selected' : '' ?>>Core Running No.</option>
                                <option value="coreplate_mat_date" <?= $columns_2 == 'coreplate_mat_date' ? 'selected' : '' ?>>Coreplate Mat. Date</option>
                                <option value="coreplate_mat_lot" <?= $columns_2 == 'coreplate_mat_lot' ? 'selected' : '' ?>>Coreplate Mat. Lot</option>
                                <option value="coreplate_mat_no" <?= $columns_2 == 'coreplate_mat_no' ? 'selected' : '' ?>>Coreplate Mat. No.</option>
                                <option value="coreplate_part_no" <?= $columns_2 == 'coreplate_part_no' ? 'selected' : '' ?>>Coreplate Part No.</option>
                                <option value="coreplate_pd" <?= $columns_2 == 'coreplate_pd' ? 'selected' : '' ?>>Coreplate PD Date</option>
                                <option value="fin_mat_date" <?= $columns_2 == 'fin_mat_date' ? 'selected' : '' ?>>Fin Mat. Date</option>
                                <option value="fin_mat_lot" <?= $columns_2 == 'fin_mat_lot' ? 'selected' : '' ?>>Fin Mat. Lot</option>
                                <option value="fin_mat_no " <?= $columns_2 == 'fin_mat_no' ? 'selected' : '' ?>>Fin Mat. No.</option>
                                <option value="fin_part_no" <?= $columns_2 == 'fin_part_no' ? 'selected' : '' ?>>Fin Part No.</option>
                                <option value="fin_pd" <?= $columns_2 == 'fin_pd' ? 'selected' : '' ?>>Fin PD Date</option>
                                <option value="flux_pd" <?= $columns_2 == 'flux_pd' ? 'selected' : '' ?>>Flux PD Date</option>
                                <option value="insert_mat_date" <?= $columns_2 == 'insert_mat_date' ? 'selected' : '' ?>>Insert Mat. Date</option>
                                <option value="insert_mat_lot" <?= $columns_2 == 'insert_mat_lot' ? 'selected' : '' ?>>Insert Mat. Lot</option>
                                <option value="insert_mat_no" <?= $columns_2 == 'insert_mat_no' ? 'selected' : '' ?>>Insert Mat. No.</option>
                                <option value="insert_part_no" <?= $columns_2 == 'insert_part_no' ? 'selected' : '' ?>>Insert Part No.</option>
                                <option value="insert_pd" <?= $columns_2 == 'insert_pd' ? 'selected' : '' ?>>Insert PD Date</option>
                                <option value="nb_pd" <?= $columns_2 == 'nb_pd' ? 'selected' : '' ?>>NB PD Date</option>
                                <option value="PTank_lwr_mat_date" <?= $columns_2 == 'PTank_lwr_mat_date' ? 'selected' : '' ?>>P-Tank LWR Mat. Date</option>
                                <option value="PTank_lwr_mat_lot" <?= $columns_2 == 'PTank_lwr_mat_lot' ? 'selected' : '' ?>>P-Tank LWR Mat. Lot</option>
                                <option value="PTank_lwr_mat_no" <?= $columns_2 == 'PTank_lwr_mat_no' ? 'selected' : '' ?>>P-Tank LWR Mat. No.</option>
                                <option value="PTank_lwr_part_no" <?= $columns_2 == 'PTank_lwr_part_no' ? 'selected' : '' ?>>P-Tank LWR Part No.</option>
                                <option value="PTank_lwr_pd_date" <?= $columns_2 == 'PTank_lwr_pd_date' ? 'selected' : '' ?>>P-Tank LWR PD Date</option>
                                <option value="PTank_upr_mat_date" <?= $columns_2 == 'PTank_upr_mat_date' ? 'selected' : '' ?>>P-Tank UPR Mat. Date</option>
                                <option value="PTank_upr_mat_lot" <?= $columns_2 == 'PTank_upr_mat_lot' ? 'selected' : '' ?>>P-Tank UPR Mat. Lot</option>
                                <option value="PTank_upr_mat_no" <?= $columns_2 == 'PTank_upr_mat_no' ? 'selected' : '' ?>>P-Tank UPR Mat. No.</option>
                                <option value="PTank_upr_part_no" <?= $columns_2 == 'PTank_upr_part_no' ? 'selected' : '' ?>>P-Tank UPR Part No.</option>
                                <option value="PTank_upr_pd_date" <?= $columns_2 == 'PTank_upr_pd_date' ? 'selected' : '' ?>>P-Tank UPR PD Date</option>
                                <option value="staging_casemark" <?= $columns_2 == 'staging_casemark' ? 'selected' : '' ?>>Staging Casemark</option>
                                <option value="stacking_packing_lane" <?= $columns_2 == 'stacking_packing_lane' ? 'selected' : '' ?>>Staging Packing Lane</option>
                                <option value="staging_ship_location" <?= $columns_2 == 'staging_ship_location' ? 'selected' : '' ?>>Staging Ship Location</option>
                                <option value="tube_mat_date" <?= $columns_2 == 'tube_mat_date' ? 'selected' : '' ?>>Tube Mat. Date</option>
                                <option value="tube_mat_lot" <?= $columns_2 == 'tube_mat_lot' ? 'selected' : '' ?>>Tube Mat. Lot</option>
                                <option value="tube_mat_no" <?= $columns_2 == 'tube_mat_no' ? 'selected' : '' ?>>Tube Mat. No.</option>
                                <option value="tube_part_no" <?= $columns_2 == 'tube_part_no' ? 'selected' : '' ?>>Tube Part No.</option>
                                <option value="tube_pd" <?= $columns_2 == 'tube_pd' ? 'selected' : '' ?>>Tube PD Date</option>
                            </select>
                            <span class="text"> &nbsp;&nbsp;Insert your data : </span>
                            <input type="text" id="insert_box_2" name="insert_box_2" value="<?= htmlspecialchars($insert_box_2) ?>">
                            <!-- <input type="submit" value="Search"> -->
                        </div>
                        <div>
                            <label for="columns_3" class="text">select column of table for search:</label>
                            <select id="columns_3" name="columns_3">
                                <option value="" <?= $columns_3 == '' ? 'selected' : '' ?>>-- select --</option>
                                <option value="assy_part_no" <?= $columns_3 == 'assy_part_no' ? 'selected' : '' ?>>ASSY Part No.</option>
                                <option value="assy_pd_date" <?= $columns_3 == 'assy_pd_date' ? 'selected' : '' ?>>ASSY PD Date</option>
                                <option value="assy_run_no" <?= $columns_3 == 'assy_run_no' ? 'selected' : '' ?>>ASSY Running No.</option>
                                <option value="assy_packing_part_no" <?= $columns_3 == 'assy_packing_part_no' ? 'selected' : '' ?>>Assy Packing Part No.</option>
                                <option value="assy_packing_pd_date" <?= $columns_3 == 'assy_packing_pd_date' ? 'selected' : '' ?>>Assy Packing PD Date</option>
                                <option value="assy_packing_run_no" <?= $columns_3 == 'assy_packing_run_no' ? 'selected' : '' ?>>Assy Packing Running No.</option>
                                <option value="core_part_no" <?= $columns_3 == 'core_part_no' ? 'selected' : '' ?>>Core Part No.</option>
                                <option value="core_pd_date" <?= $columns_3 == 'core_pd_date' ? 'selected' : '' ?>>Core PD Date</option>
                                <option value="core_run_no" <?= $columns_3 == 'core_run_no' ? 'selected' : '' ?>>Core Running No.</option>
                                <option value="coreplate_mat_date" <?= $columns_3 == 'coreplate_mat_date' ? 'selected' : '' ?>>Coreplate Mat. Date</option>
                                <option value="coreplate_mat_lot" <?= $columns_3 == 'coreplate_mat_lot' ? 'selected' : '' ?>>Coreplate Mat. Lot</option>
                                <option value="coreplate_mat_no" <?= $columns_3 == 'coreplate_mat_no' ? 'selected' : '' ?>>Coreplate Mat. No.</option>
                                <option value="coreplate_part_no" <?= $columns_3 == 'coreplate_part_no' ? 'selected' : '' ?>>Coreplate Part No.</option>
                                <option value="coreplate_pd" <?= $columns_3 == 'coreplate_pd' ? 'selected' : '' ?>>Coreplate PD Date</option>
                                <option value="fin_mat_date" <?= $columns_3 == 'fin_mat_date' ? 'selected' : '' ?>>Fin Mat. Date</option>
                                <option value="fin_mat_lot" <?= $columns_3 == 'fin_mat_lot' ? 'selected' : '' ?>>Fin Mat. Lot</option>
                                <option value="fin_mat_no " <?= $columns_3 == 'fin_mat_no' ? 'selected' : '' ?>>Fin Mat. No.</option>
                                <option value="fin_part_no" <?= $columns_3 == 'fin_part_no' ? 'selected' : '' ?>>Fin Part No.</option>
                                <option value="fin_pd" <?= $columns_3 == 'fin_pd' ? 'selected' : '' ?>>Fin PD Date</option>
                                <option value="flux_pd" <?= $columns_3 == 'flux_pd' ? 'selected' : '' ?>>Flux PD Date</option>
                                <option value="insert_mat_date" <?= $columns_3 == 'insert_mat_date' ? 'selected' : '' ?>>Insert Mat. Date</option>
                                <option value="insert_mat_lot" <?= $columns_3 == 'insert_mat_lot' ? 'selected' : '' ?>>Insert Mat. Lot</option>
                                <option value="insert_mat_no" <?= $columns_3 == 'insert_mat_no' ? 'selected' : '' ?>>Insert Mat. No.</option>
                                <option value="insert_part_no" <?= $columns_3 == 'insert_part_no' ? 'selected' : '' ?>>Insert Part No.</option>
                                <option value="insert_pd" <?= $columns_3 == 'insert_pd' ? 'selected' : '' ?>>Insert PD Date</option>
                                <option value="nb_pd" <?= $columns_3 == 'nb_pd' ? 'selected' : '' ?>>NB PD Date</option>
                                <option value="PTank_lwr_mat_date" <?= $columns_3 == 'PTank_lwr_mat_date' ? 'selected' : '' ?>>P-Tank LWR Mat. Date</option>
                                <option value="PTank_lwr_mat_lot" <?= $columns_3 == 'PTank_lwr_mat_lot' ? 'selected' : '' ?>>P-Tank LWR Mat. Lot</option>
                                <option value="PTank_lwr_mat_no" <?= $columns_3 == 'PTank_lwr_mat_no' ? 'selected' : '' ?>>P-Tank LWR Mat. No.</option>
                                <option value="PTank_lwr_part_no" <?= $columns_3 == 'PTank_lwr_part_no' ? 'selected' : '' ?>>P-Tank LWR Part No.</option>
                                <option value="PTank_lwr_pd_date" <?= $columns_3 == 'PTank_lwr_pd_date' ? 'selected' : '' ?>>P-Tank LWR PD Date</option>
                                <option value="PTank_upr_mat_date" <?= $columns_3 == 'PTank_upr_mat_date' ? 'selected' : '' ?>>P-Tank UPR Mat. Date</option>
                                <option value="PTank_upr_mat_lot" <?= $columns_3 == 'PTank_upr_mat_lot' ? 'selected' : '' ?>>P-Tank UPR Mat. Lot</option>
                                <option value="PTank_upr_mat_no" <?= $columns_3 == 'PTank_upr_mat_no' ? 'selected' : '' ?>>P-Tank UPR Mat. No.</option>
                                <option value="PTank_upr_part_no" <?= $columns_3 == 'PTank_upr_part_no' ? 'selected' : '' ?>>P-Tank UPR Part No.</option>
                                <option value="PTank_upr_pd_date" <?= $columns_3 == 'PTank_upr_pd_date' ? 'selected' : '' ?>>P-Tank UPR PD Date</option>
                                <option value="staging_casemark" <?= $columns_3 == 'staging_casemark' ? 'selected' : '' ?>>Staging Casemark</option>
                                <option value="stacking_packing_lane" <?= $columns_3 == 'stacking_packing_lane' ? 'selected' : '' ?>>Staging Packing Lane</option>
                                <option value="staging_ship_location" <?= $columns_3 == 'staging_ship_location' ? 'selected' : '' ?>>Staging Ship Location</option>
                                <option value="tube_mat_date" <?= $columns_3 == 'tube_mat_date' ? 'selected' : '' ?>>Tube Mat. Date</option>
                                <option value="tube_mat_lot" <?= $columns_3 == 'tube_mat_lot' ? 'selected' : '' ?>>Tube Mat. Lot</option>
                                <option value="tube_mat_no" <?= $columns_3 == 'tube_mat_no' ? 'selected' : '' ?>>Tube Mat. No.</option>
                                <option value="tube_part_no" <?= $columns_3 == 'tube_part_no' ? 'selected' : '' ?>>Tube Part No.</option>
                                <option value="tube_pd" <?= $columns_3 == 'tube_pd' ? 'selected' : '' ?>>Tube PD Date</option>
                            </select>
                            <span class="text"> &nbsp;&nbsp;Insert your data : </span>
                            <input type="text" id="insert_box_3" name="insert_box_3" value="<?= htmlspecialchars($insert_box_3) ?>">
                            <!-- <input type="submit" value="Search"> -->
                        </div>
                        <div>
                            <label for="columns_4" class="text">select column of table for search:</label>
                            <select id="columns_4" name="columns_4">
                                <option value="" <?= $columns_4 == '' ? 'selected' : '' ?>>-- select --</option>
                                <option value="assy_part_no" <?= $columns_4 == 'assy_part_no' ? 'selected' : '' ?>>ASSY Part No.</option>
                                <option value="assy_pd_date" <?= $columns_4 == 'assy_pd_date' ? 'selected' : '' ?>>ASSY PD Date</option>
                                <option value="assy_run_no" <?= $columns_4 == 'assy_run_no' ? 'selected' : '' ?>>ASSY Running No.</option>
                                <option value="assy_packing_part_no" <?= $columns_4 == 'assy_packing_part_no' ? 'selected' : '' ?>>Assy Packing Part No.</option>
                                <option value="assy_packing_pd_date" <?= $columns_4 == 'assy_packing_pd_date' ? 'selected' : '' ?>>Assy Packing PD Date</option>
                                <option value="assy_packing_run_no" <?= $columns_4 == 'assy_packing_run_no' ? 'selected' : '' ?>>Assy Packing Running No.</option>
                                <option value="core_part_no" <?= $columns_4 == 'core_part_no' ? 'selected' : '' ?>>Core Part No.</option>
                                <option value="core_pd_date" <?= $columns_4 == 'core_pd_date' ? 'selected' : '' ?>>Core PD Date</option>
                                <option value="core_run_no" <?= $columns_4 == 'core_run_no' ? 'selected' : '' ?>>Core Running No.</option>
                                <option value="coreplate_mat_date" <?= $columns_4 == 'coreplate_mat_date' ? 'selected' : '' ?>>Coreplate Mat. Date</option>
                                <option value="coreplate_mat_lot" <?= $columns_4 == 'coreplate_mat_lot' ? 'selected' : '' ?>>Coreplate Mat. Lot</option>
                                <option value="coreplate_mat_no" <?= $columns_4 == 'coreplate_mat_no' ? 'selected' : '' ?>>Coreplate Mat. No.</option>
                                <option value="coreplate_part_no" <?= $columns_4 == 'coreplate_part_no' ? 'selected' : '' ?>>Coreplate Part No.</option>
                                <option value="coreplate_pd" <?= $columns_4 == 'coreplate_pd' ? 'selected' : '' ?>>Coreplate PD Date</option>
                                <option value="fin_mat_date" <?= $columns_4 == 'fin_mat_date' ? 'selected' : '' ?>>Fin Mat. Date</option>
                                <option value="fin_mat_lot" <?= $columns_4 == 'fin_mat_lot' ? 'selected' : '' ?>>Fin Mat. Lot</option>
                                <option value="fin_mat_no " <?= $columns_4 == 'fin_mat_no' ? 'selected' : '' ?>>Fin Mat. No.</option>
                                <option value="fin_part_no" <?= $columns_4 == 'fin_part_no' ? 'selected' : '' ?>>Fin Part No.</option>
                                <option value="fin_pd" <?= $columns_4 == 'fin_pd' ? 'selected' : '' ?>>Fin PD Date</option>
                                <option value="flux_pd" <?= $columns_4 == 'flux_pd' ? 'selected' : '' ?>>Flux PD Date</option>
                                <option value="insert_mat_date" <?= $columns_4 == 'insert_mat_date' ? 'selected' : '' ?>>Insert Mat. Date</option>
                                <option value="insert_mat_lot" <?= $columns_4 == 'insert_mat_lot' ? 'selected' : '' ?>>Insert Mat. Lot</option>
                                <option value="insert_mat_no" <?= $columns_4 == 'insert_mat_no' ? 'selected' : '' ?>>Insert Mat. No.</option>
                                <option value="insert_part_no" <?= $columns_4 == 'insert_part_no' ? 'selected' : '' ?>>Insert Part No.</option>
                                <option value="insert_pd" <?= $columns_4 == 'insert_pd' ? 'selected' : '' ?>>Insert PD Date</option>
                                <option value="nb_pd" <?= $columns_4 == 'nb_pd' ? 'selected' : '' ?>>NB PD Date</option>
                                <option value="PTank_lwr_mat_date" <?= $columns_4 == 'PTank_lwr_mat_date' ? 'selected' : '' ?>>P-Tank LWR Mat. Date</option>
                                <option value="PTank_lwr_mat_lot" <?= $columns_4 == 'PTank_lwr_mat_lot' ? 'selected' : '' ?>>P-Tank LWR Mat. Lot</option>
                                <option value="PTank_lwr_mat_no" <?= $columns_4 == 'PTank_lwr_mat_no' ? 'selected' : '' ?>>P-Tank LWR Mat. No.</option>
                                <option value="PTank_lwr_part_no" <?= $columns_4 == 'PTank_lwr_part_no' ? 'selected' : '' ?>>P-Tank LWR Part No.</option>
                                <option value="PTank_lwr_pd_date" <?= $columns_4 == 'PTank_lwr_pd_date' ? 'selected' : '' ?>>P-Tank LWR PD Date</option>
                                <option value="PTank_upr_mat_date" <?= $columns_4 == 'PTank_upr_mat_date' ? 'selected' : '' ?>>P-Tank UPR Mat. Date</option>
                                <option value="PTank_upr_mat_lot" <?= $columns_4 == 'PTank_upr_mat_lot' ? 'selected' : '' ?>>P-Tank UPR Mat. Lot</option>
                                <option value="PTank_upr_mat_no" <?= $columns_4 == 'PTank_upr_mat_no' ? 'selected' : '' ?>>P-Tank UPR Mat. No.</option>
                                <option value="PTank_upr_part_no" <?= $columns_4 == 'PTank_upr_part_no' ? 'selected' : '' ?>>P-Tank UPR Part No.</option>
                                <option value="PTank_upr_pd_date" <?= $columns_4 == 'PTank_upr_pd_date' ? 'selected' : '' ?>>P-Tank UPR PD Date</option>
                                <option value="staging_casemark" <?= $columns_4 == 'staging_casemark' ? 'selected' : '' ?>>Staging Casemark</option>
                                <option value="stacking_packing_lane" <?= $columns_4 == 'stacking_packing_lane' ? 'selected' : '' ?>>Staging Packing Lane</option>
                                <option value="staging_ship_location" <?= $columns_4 == 'staging_ship_location' ? 'selected' : '' ?>>Staging Ship Location</option>
                                <option value="tube_mat_date" <?= $columns_4 == 'tube_mat_date' ? 'selected' : '' ?>>Tube Mat. Date</option>
                                <option value="tube_mat_lot" <?= $columns_4 == 'tube_mat_lot' ? 'selected' : '' ?>>Tube Mat. Lot</option>
                                <option value="tube_mat_no" <?= $columns_4 == 'tube_mat_no' ? 'selected' : '' ?>>Tube Mat. No.</option>
                                <option value="tube_part_no" <?= $columns_4 == 'tube_part_no' ? 'selected' : '' ?>>Tube Part No.</option>
                                <option value="tube_pd" <?= $columns_4 == 'tube_pd' ? 'selected' : '' ?>>Tube PD Date</option>
                            </select>
                            <span class="text"> &nbsp;&nbsp;Insert your data : </span>
                            <input type="text" id="insert_box_4" name="insert_box_4" value="<?= htmlspecialchars($insert_box_4) ?>">
                            <!-- <input type="submit" value="Search"> -->
                        </div>
                        <div>
                            <label for="columns_5" class="text">select column of table for search:</label>
                            <select id="columns_5" name="columns_5">
                                <option value="" <?= $columns_5 == '' ? 'selected' : '' ?>>-- select --</option>
                                <option value="assy_part_no" <?= $columns_5 == 'assy_part_no' ? 'selected' : '' ?>>ASSY Part No.</option>
                                <option value="assy_pd_date" <?= $columns_5 == 'assy_pd_date' ? 'selected' : '' ?>>ASSY PD Date</option>
                                <option value="assy_run_no" <?= $columns_5 == 'assy_run_no' ? 'selected' : '' ?>>ASSY Running No.</option>
                                <option value="assy_packing_part_no" <?= $columns_5 == 'assy_packing_part_no' ? 'selected' : '' ?>>Assy Packing Part No.</option>
                                <option value="assy_packing_pd_date" <?= $columns_5 == 'assy_packing_pd_date' ? 'selected' : '' ?>>Assy Packing PD Date</option>
                                <option value="assy_packing_run_no" <?= $columns_5 == 'assy_packing_run_no' ? 'selected' : '' ?>>Assy Packing Running No.</option>
                                <option value="core_part_no" <?= $columns_5 == 'core_part_no' ? 'selected' : '' ?>>Core Part No.</option>
                                <option value="core_pd_date" <?= $columns_5 == 'core_pd_date' ? 'selected' : '' ?>>Core PD Date</option>
                                <option value="core_run_no" <?= $columns_5 == 'core_run_no' ? 'selected' : '' ?>>Core Running No.</option>
                                <option value="coreplate_mat_date" <?= $columns_5 == 'coreplate_mat_date' ? 'selected' : '' ?>>Coreplate Mat. Date</option>
                                <option value="coreplate_mat_lot" <?= $columns_5 == 'coreplate_mat_lot' ? 'selected' : '' ?>>Coreplate Mat. Lot</option>
                                <option value="coreplate_mat_no" <?= $columns_5 == 'coreplate_mat_no' ? 'selected' : '' ?>>Coreplate Mat. No.</option>
                                <option value="coreplate_part_no" <?= $columns_5 == 'coreplate_part_no' ? 'selected' : '' ?>>Coreplate Part No.</option>
                                <option value="coreplate_pd" <?= $columns_5 == 'coreplate_pd' ? 'selected' : '' ?>>Coreplate PD Date</option>
                                <option value="fin_mat_date" <?= $columns_5 == 'fin_mat_date' ? 'selected' : '' ?>>Fin Mat. Date</option>
                                <option value="fin_mat_lot" <?= $columns_5 == 'fin_mat_lot' ? 'selected' : '' ?>>Fin Mat. Lot</option>
                                <option value="fin_mat_no " <?= $columns_5 == 'fin_mat_no' ? 'selected' : '' ?>>Fin Mat. No.</option>
                                <option value="fin_part_no" <?= $columns_5 == 'fin_part_no' ? 'selected' : '' ?>>Fin Part No.</option>
                                <option value="fin_pd" <?= $columns_5 == 'fin_pd' ? 'selected' : '' ?>>Fin PD Date</option>
                                <option value="flux_pd" <?= $columns_5 == 'flux_pd' ? 'selected' : '' ?>>Flux PD Date</option>
                                <option value="insert_mat_date" <?= $columns_5 == 'insert_mat_date' ? 'selected' : '' ?>>Insert Mat. Date</option>
                                <option value="insert_mat_lot" <?= $columns_5 == 'insert_mat_lot' ? 'selected' : '' ?>>Insert Mat. Lot</option>
                                <option value="insert_mat_no" <?= $columns_5 == 'insert_mat_no' ? 'selected' : '' ?>>Insert Mat. No.</option>
                                <option value="insert_part_no" <?= $columns_5 == 'insert_part_no' ? 'selected' : '' ?>>Insert Part No.</option>
                                <option value="insert_pd" <?= $columns_5 == 'insert_pd' ? 'selected' : '' ?>>Insert PD Date</option>
                                <option value="nb_pd" <?= $columns_5 == 'nb_pd' ? 'selected' : '' ?>>NB PD Date</option>
                                <option value="PTank_lwr_mat_date" <?= $columns_5 == 'PTank_lwr_mat_date' ? 'selected' : '' ?>>P-Tank LWR Mat. Date</option>
                                <option value="PTank_lwr_mat_lot" <?= $columns_5 == 'PTank_lwr_mat_lot' ? 'selected' : '' ?>>P-Tank LWR Mat. Lot</option>
                                <option value="PTank_lwr_mat_no" <?= $columns_5 == 'PTank_lwr_mat_no' ? 'selected' : '' ?>>P-Tank LWR Mat. No.</option>
                                <option value="PTank_lwr_part_no" <?= $columns_5 == 'PTank_lwr_part_no' ? 'selected' : '' ?>>P-Tank LWR Part No.</option>
                                <option value="PTank_lwr_pd_date" <?= $columns_5 == 'PTank_lwr_pd_date' ? 'selected' : '' ?>>P-Tank LWR PD Date</option>
                                <option value="PTank_upr_mat_date" <?= $columns_5 == 'PTank_upr_mat_date' ? 'selected' : '' ?>>P-Tank UPR Mat. Date</option>
                                <option value="PTank_upr_mat_lot" <?= $columns_5 == 'PTank_upr_mat_lot' ? 'selected' : '' ?>>P-Tank UPR Mat. Lot</option>
                                <option value="PTank_upr_mat_no" <?= $columns_5 == 'PTank_upr_mat_no' ? 'selected' : '' ?>>P-Tank UPR Mat. No.</option>
                                <option value="PTank_upr_part_no" <?= $columns_5 == 'PTank_upr_part_no' ? 'selected' : '' ?>>P-Tank UPR Part No.</option>
                                <option value="PTank_upr_pd_date" <?= $columns_5 == 'PTank_upr_pd_date' ? 'selected' : '' ?>>P-Tank UPR PD Date</option>
                                <option value="staging_casemark" <?= $columns_5 == 'staging_casemark' ? 'selected' : '' ?>>Staging Casemark</option>
                                <option value="stacking_packing_lane" <?= $columns_5 == 'stacking_packing_lane' ? 'selected' : '' ?>>Staging Packing Lane</option>
                                <option value="staging_ship_location" <?= $columns_5 == 'staging_ship_location' ? 'selected' : '' ?>>Staging Ship Location</option>
                                <option value="tube_mat_date" <?= $columns_5 == 'tube_mat_date' ? 'selected' : '' ?>>Tube Mat. Date</option>
                                <option value="tube_mat_lot" <?= $columns_5 == 'tube_mat_lot' ? 'selected' : '' ?>>Tube Mat. Lot</option>
                                <option value="tube_mat_no" <?= $columns_5 == 'tube_mat_no' ? 'selected' : '' ?>>Tube Mat. No.</option>
                                <option value="tube_part_no" <?= $columns_5 == 'tube_part_no' ? 'selected' : '' ?>>Tube Part No.</option>
                                <option value="tube_pd" <?= $columns_5 == 'tube_pd' ? 'selected' : '' ?>>Tube PD Date</option>
                            </select>
                            <span class="text"> &nbsp;&nbsp;Insert your data : </span>
                            <input type="text" id="insert_box_5" name="insert_box_5" value="<?= htmlspecialchars($insert_box_5) ?>">
                            <!-- <input type="submit" value="Search"> -->
                        </div>

                    </div>
                </form>
                <?php
                // ตรวจสอบว่ามีค่าส่งมาใน $_GET หรือไม่

                $column = isset($_GET['column']) ? htmlspecialchars($_GET['column']) : '';
                $startDate = isset($_GET['startDate']) ? htmlspecialchars($_GET['startDate']) : '';
                $endDate = isset($_GET['endDate']) ? htmlspecialchars($_GET['endDate']) : '';


                ?>
                <form action="searching.php" method="get" class="date-range-form">
                    <label for="column" class="text">Select Column :</label>
                    <select id="column" name="column" required>
                        <option value="" <?= $column == '' ? 'selected' : '' ?>>- select -</option>
                        <option value="core" <?= $column == 'core' ? 'selected' : '' ?>>core</option>
                        <option value="flux" <?= $column == 'flux' ? 'selected' : '' ?>>flux</option>
                        <option value="nb" <?= $column == 'nb' ? 'selected' : '' ?>>nb</option>
                        <option value="assy" <?= $column == 'assy' ? 'selected' : '' ?>>assy</option>
                    </select>

                    <label for="startDate" class="text">Start Date and Time :</label>
                    <input type="datetime-local" id="startDate" name="startDate" value="<?= $startDate ?>" required>

                    <label for="endDate" class="text">End Date and Time :</label>
                    <input type="datetime-local" id="endDate" name="endDate" value="<?= $endDate ?>" required>

                    <input type="submit" value="Search">
                </form>
            <div class="divScroll">
                <table id="searching" class="display">
                    <thead>
                        <tr class="first_row">
                            <th colspan="5">Tube</th>
                            <th colspan="5">Insert</th>
                            <th colspan="5">Fin</th>
                            <th colspan="5">Coreplate</th>
                            <th colspan="5">Core</th>
                            <th colspan="3">Flux</th>
                            <th colspan="2">NB</th>
                            <th colspan="5">P-Tank UPR</th>
                            <th colspan="5">P-Tank LWR</th>
                            <th colspan="5">Assy</th>
                            <th colspan="4">Assy line Packing </th>
                            <th colspan="3">Staging</th>
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
                            <th>line</th>
                            <th>Part&nbsp;No.</th>
                            <th>PD&nbsp;Date</th>
                            <th>PD&nbsp;Time</th>
                            <th>Running&nbsp;No.</th>
                            <th>line</th>
                            <th>PD&nbsp;Date</th>
                            <th>PD&nbsp;Time</th>
                            <th>PD&nbsp;Date</th>
                            <th>PD&nbsp;Time</th>
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
                            <th>line</th>
                            <th>Part&nbsp;No.</th>
                            <th>PD&nbsp;Date</th>
                            <th>PD&nbsp;Time</th>
                            <th>Running&nbsp;No.</th>
                            <th>Part&nbsp;No.</th>
                            <th>PD&nbsp;Date</th>
                            <th>PD&nbsp;Time</th>
                            <th>Running&nbsp;No.</th>
                            <th>Ship&nbsp;Location</th>
                            <th>Casemark</th>
                            <th>Packing&nbsp;Lane</th>
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
                                echo "<td>" . $row["core_line"] . "</td>";
                                echo "<td>" . $row["core_part_no"] . "</td>";
                                echo "<td>" . $row["core_pd_date"] . "</td>";
                                echo "<td>" . $row["core_pd_time"] . "</td>";
                                echo "<td>" . $row["core_run_no"] . "</td>";
                                echo "<td>" . $row["flux_line"] . "</td>";
                                echo "<td><a href='/trendcontrol/flux_1/history_mc.php?flux_pd=" . $row['flux_pd'] . "&flux_line=" . urlencode($row['flux_line']) . "' style='color: white; text-decoration: none;'>" . $row['flux_pd'] . "</a></td>";
                                echo "<td>" . $row["flux_pd_time"] . "</td>";
                                echo "<td>" . $row["nb_pd"] . "</td>";
                                echo "<td>" . $row["nb_pd_time"] . "</td>";
                                echo "<td>" . $row["PTank_upr_mat_no"] . "</td>";
                                echo "<td>" . $row["PTank_upr_mat_lot"] . "</td>";
                                echo "<td>" . $row["PTank_upr_mat_date"] . "</td>";
                                echo "<td>" . $row["PTank_upr_part_no"] . "</td>";
                                echo "<td>" . $row["PTank_upr_pd_date"] . "</td>";
                                echo "<td>" . $row["PTank_lwr_mat_no"] . "</td>";
                                echo "<td>" . $row["PTank_lwr_mat_lot"] . "</td>";
                                echo "<td>" . $row["PTank_lwr_mat_date"] . "</td>";
                                echo "<td>" . $row["PTank_lwr_part_no"] . "</td>";
                                echo "<td>" . $row["PTank_lwr_pd_date"] . "</td>";
                                echo "<td>" . $row["assy_line"] . "</td>";
                                echo "<td>" . $row["assy_part_no"] . "</td>";
                                echo "<td>" . $row["assy_pd_date"] . "</td>";
                                echo "<td>" . $row["assy_pd_time"] . "</td>";
                                echo "<td>" . $row["assy_run_no"] . "</td>";
                                echo "<td>" . $row["assy_packing_part_no"] . "</td>";
                                echo "<td>" . $row["assy_packing_pd_date"] . "</td>";
                                echo "<td>" . $row["assy_packing_pd_time"] . "</td>";
                                echo "<td>" . $row["assy_packing_run_no"] . "</td>";
                                echo "<td>" . $row["staging_ship_location"] . "</td>";
                                echo "<td>" . $row["staging_casemark"] . "</td>";
                                echo "<td>" . $row["stacking_packing_lane"] . "</td>";
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
    .text {
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>
<!-- <script>
    var columnSelect = document.getElementById("columns");
    var message = document.getElementById("insert_box");

    columnSelect.addEventListener("change", function () {
        if (columnSelect.value === "assy_pd") {
            message.placeholder = "YYMMDDHHmm";
        } else {
            message.placeholder = "Insert Data";
        }
    });

    
</script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- <script>
    $(document).ready(function() {
        $('#searching').DataTable({
            searching: false
        });
    });
</script> -->
