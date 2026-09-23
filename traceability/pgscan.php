<?php include('..\server\assy_4h_server.php') ?>
<?php
$status = "OK";
$color = ($status == "OK") ? "green" : "red";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Daily Rad. assembly #4</title>
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
                <div class="head_page">SCAN</div>
                <hr style="background-color: white; height: 2px;">
                <div class="ct">
                    <div class="card">
                        <div class="card-header">Part No.</div>
                        <div class="card-body">
                            <p>XXXX-XXXX-XXXX</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">LEAK(%)</div>
                        <div class="card-body">
                            <p style="font-weight:bold;font-size: 20vh;">97%</p>
                        </div>
                    </div>
                </div>
                <div class="ct">
                    <div class="card">
                        <div class="card-header">JUDGE</div>
                        <div class="card-body">
                            <p style="font-weight:bold; font-size: 20vh; color: <?php echo $color; ?>;">
                                <?php echo $status; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<style>
    .ct {
        display: flex;
        justify-content: center;
    }

    .card {
        border: 1px solid #303030;
        background-color: #303030;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 10px;
        width: 1500px;
        height: 350px;
    }

    .card-header {
        background-color: #ef233c;
        padding: 5px;
        color: #edf2f4;
        font-size: 2.5vh;
        font-weight: bold;
    }

    .card-body {
        padding: 10px;
        font-size: 10vh;
    }

    p {
        color: #edf2f4;
        text-align: center;
    }
</style>