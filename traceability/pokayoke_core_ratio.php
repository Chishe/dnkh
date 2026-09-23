<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.4.0/chartjs-plugin-annotation.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../style.css">
        <title>Denso | Pokayoke Core Leak Ratio</title>
        <link rel="icon" href="../picture/Denso.png">

        <?php include("..\partial\header.html") ?>
        <?php include("..\server\helium_graph_ratio.php") ?>

    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 nav">
                    <?php include("../partial/navbar.html") ?>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="head_page">HELIUM LEAK TEST : POKAYOKE CORE LEAK RATIO</div>
                    <hr style="background-color: white; height: 2px;">
                    <div class="search-box">
                        <form action="pokayoke_core_ratio.php" method="get">
                            <input type="date" id="selected_date" name="selected_date" value="<?php echo $selected_date; ?>">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    <div class="graph-ratio">
                        <canvas id="myChart" style="width: 250vh; height: 100vh"></canvas>
                    </div>
                    <hr style="background-color: white; height: 2px;">
                    
                    <div class="divScroll-leak-ratio">
                        <table id="pokayoke" style="font-size: 16px">
                        <tbody>
                            
                            <tr>
                                <td>Qty. (Pcs)</td>
                                <?php foreach ($cumulative_all_data as $total): ?>
                                    <td><?php echo $total; ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>NG (Pcs)</td>
                                <?php foreach ($cumulative_ng_data as $ng_total): ?>
                                    <td><?php echo $ng_total; ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Leak Ratio (%)</td>
                                <?php foreach ($ratio_data as $ratio): ?>
                                    <td><?php echo round($ratio, 2); ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <?php foreach ($time_intervals as $interval): ?>
                                    <td><?php echo $interval; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>

</html>
<style>
    label {
        font-size: 2vh;
    }

    .divScroll-leak-ratio {
        overflow-y: auto;
        height: max;
        /* height: 100%; */
        border: 1px solid white;
    }

    .divScroll-leak-ratio table {
        border-collapse: collapse;
        width: 100%;
    }

    .divScroll-leak-ratio td {
        border: 1px solid white;
        padding: 1vh;
        text-align: center;
        color: white;
        font-weight: bold;
        /* background-color: lightgray; */
    }


</style>
<script>
    const timeRanges = <?php echo json_encode($time_intervals); ?>;
    const array_total = <?php echo json_encode($cumulative_all_data); ?>;
    const array_ng = <?php echo json_encode($cumulative_ng_data); ?>;
    const ratioData = <?php echo json_encode($ratio_data); ?>;
    console.log(ratioData);

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line', // หรือ 'line' สำหรับกราฟเส้น
            data: {
                labels: timeRanges,
                datasets: [{
                    label: 'Leakrate Ratio',
                    data: ratioData,
                    backgroundColor: 'rgba(25, 50, 192, 0.2)',
                    borderColor: 'rgba(25, 50, 192, 1)',
                    color: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Percent (%)',
                            color: '#fff',
                        },
                        beginAtZero: true,
                        max: 10,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.5)', 
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 1)', 
                        }
                    },
                    x:{
                        title: {
                            display: true,
                            text: 'Time',
                            color: '#fff',
                        },
                        max: 60,
                        grid: {
                            color: 'rgba(255, 255, 255, 0)',
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 1)', 
                            
                        },
                    },
                },
                plugins: {
                  legend: {
                     display: true,
                     position: 'top',
                     align: 'center',
                     labels: {
                        color: '#fff',
                        font: {
                           weight: 'bold'
                        },
                     }
                  },
                  annotation: {
                        annotations: [
                            {
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y',
                                value: 0.5,
                                borderColor: 'red',
                                borderWidth: 1,
                                label: {
                                    enabled: true,
                                    content: 'Target 0.5%',
                                    position: 'end'
                                },
                            },
                    ]
                    }
               }
            }
        });
    ;
</script>