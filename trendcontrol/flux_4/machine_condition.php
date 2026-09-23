<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.4.0/chartjs-plugin-annotation.min.js"></script>
    <script src="../../js/dist/gauge.min.js"></script>
    <title>Denso | FLUX 4 MACHINE CONDITION</title>
    <link rel="icon" href="../../picture/Denso.png">




    <!-- <script src="../../Chart.js-master"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <?php include('navbar\header_115_d.html') ?>

</head>

<body>
    <script src="mc_chart.js"></script>
    <script src="mc_value.js"></script>
    <div class="container-fluid">
        <div class="row" style="color: palegoldenrod; font-weight: bold; font-size: 2rem; justify-content: center; text-align: center;">
            FLUX 4 MACHINE CONDITION
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div style="color:white; font-size:1.5rem; font-weight: bold; margin-bottom:1vh">History : </div>
                <div class="divScroll">
                    <div id="table-container"></div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <div class="row">
                    <div class="topicName" style="width:8vw">Date</div>
                    <div class="topicName" style="width:8vw">Time</div>
                    <div class="topicName" style="width:10vw">Item</div>
                    <div class="topicName" style="width:28vw">Graph</div>
                    <div class="topicName" style="width:12vw">Actual</div>
                    <div class="topicName" style="width:5vw">Status</div>
                </div>



                <!-- /////////////////////////////////////////////// After cut air blow 1 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="latestDate"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="latestTime"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>After cut air blow 1</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart1" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugeac1"></canvas>
                        <p style="display:flex; justify-content: center;" id="latestValue"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="latestState" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// Twist chut air blow 1 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="datetc1"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timetc1"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Twist chut air blow 1</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart2" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugetc1"></canvas>
                        <p style="display:flex; justify-content: center;" id="valuetc1"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statustc1" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// after cut air blow 2 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="dateac2"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timeac2"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>After cut air blow 2</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart3" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugeac2"></canvas>
                        <p style="display:flex; justify-content: center;" id="valueac2"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statusac2" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// Twist chut air blow 2 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="datetc2"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timetc2"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Twist chut air blow 2</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart4" style="width: 100%;height: 100%"></canvas>
                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugetc2"></canvas>
                        <p style="display:flex; justify-content: center;" id="valuetc2"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statustc2" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// Tension /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="datets"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timets"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Tension pressure</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart5" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugets"></canvas>
                        <p style="display:flex; justify-content: center;" id="valuets"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statusts" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// Tension adjust /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="datetsa"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timetsa"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Tenion adjust press</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart6" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugetsa"></canvas>
                        <p style="display:flex; justify-content: center;" id="valuetsa"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statustsa" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// flow 1 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="dateflow1"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timeflow1"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Flow 1</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart7" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugeflow1"></canvas>
                        <p style="display:flex; justify-content: center;" id="valueflow1"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statusflow1" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// flow 2 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="dateflow2"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timeflow2"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Flow 2</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart8" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugeflow2"></canvas>
                        <p style="display:flex; justify-content: center;" id="valueflow2"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statusflow2" class="fa fa-circle"></p>
                    </div>
                </div>




                <!-- /////////////////////////////////////////////// flow 3 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="dateflow3"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timeflow3"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Flow 3</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart9" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugeflow3"></canvas>
                        <p style="display:flex; justify-content: center;" id="valueflow3"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statusflow3" class="fa fa-circle"></p>
                    </div>
                </div>


                <!-- /////////////////////////////////////////////// flow 4 /////////////////////////////////////////////// -->
                <div class="row">
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="dateflow4"></p>
                    </div>
                    <div class="topicName" style="width:8vw; color:white; font-size:1rem">
                        <p id="timeflow4"></p>
                    </div>
                    <div class="topicName" style="width:10vw; color:white; font-size:1rem">
                        <p>Flow 4</p>
                    </div>
                    <div class="topicName" style="width:28vw; color:white; font-size:1rem">
                        <canvas class="my-4 w-100" id="chart10" style="width: 100%;height: 100%"></canvas>

                    </div>
                    <div class="topicName" style="width:12vw; color:white; font-size:1rem; display:block;">
                        <canvas class="my-4 w-100" id="gaugeflow4"></canvas>
                        <p style="display:flex; justify-content: center;" id="valueflow4"></p>
                    </div>
                    <div class="topicName" style="width:5vw; color:white; font-size:2rem">
                        <p id="statusflow4" class="fa fa-circle"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



<script>
    // สร้างตัวแปร
    var thisPage = "MACHINE CONDITION";

    // แสดงข้อความใน HTML ตามค่าของตัวแปร
    document.getElementById("message").textContent = thisPage;
</script>
<script>
    setInterval(function() {
        // ใช้ fetch เพื่อดึงข้อมูล JSON จากไฟล์ PHP
        fetch('server/fin_mc_prob_server.php')
            .then(response => response.json())
            .then(data => {
                // สร้าง HTML สำหรับตาราง
                // console.log(data);
                var tableHtml = "<table>";
                tableHtml += "<thead>";
                tableHtml += "<tr class='first_row'>";
                tableHtml += "<th style='width:6vw;'>Date</th>"
                tableHtml += "<th style='width:4vw;'>Time</th>"
                tableHtml += "<th>Item</th>"
                tableHtml += "<th style='width:1vw;'>Status</th>"
                tableHtml += "</tr>"
                for (var i = 0; i < data.length; i++) {
                    tableHtml += "<tr><td>" + data[i].Date + "</td><td>" + data[i].Time + "</td><td>" + data[i].name_mc + "</td><td style='color:red'>&#11044</td></tr>";
                }

                tableHtml += "</table>";
                // นำ HTML ไปแทนที่ข้อมูลเดิมใน element ที่มี id เท่ากับ "table-container"
                document.getElementById("table-container").innerHTML = tableHtml;
            })
            .catch(error => console.error('Error:', error));
    }, 10000);
</script>
<script>
    // สร้าง WebSocket object
    const socket = new WebSocket('ws://192.168.2.101:1880/ws/mc_ac1');

    // เมื่อมีการเชื่อมต่อ WebSocket
    socket.addEventListener('open', (event) => {
        console.log('Connected to WebSocket');
    });

    // เมื่อมีข้อมูลถูกส่งมาจาก WebSocket
    socket.addEventListener('message', (event) => {
        const receivedData = JSON.parse(event.data);
        // ปรับปรุงหน้า HTML ด้วยข้อมูลที่ได้รับ
        console.log(receivedData);
        // updateHTML(receivedData);

        var opts = {
            angle: 0, // The span of the gauge arc
            lineWidth: 0.5, // The line thickness
            radiusScale: 1, // Relative radius
            pointer: {
                length: 0.52, // // Relative to gauge radius
                strokeWidth: 0.035, // The thickness
                color: 'white' // Fill color
            },
            limitMax: true, // If false, max value increases automatically if value > maxValue
            limitMin: true, // If true, the min value of the gauge will be fixed
            colorStart: '#6FADCF', // Colors
            colorStop: '#8FC0DA', // just experiment with them
            strokeColor: '#E0E0E0', // to see which ones work best for you
            generateGradient: true,
            highDpiSupport: true, // High resolution support
            staticZones: [{
                    strokeStyle: "dimgrey",
                    min: 0,
                    max: 0.1
                }, // Green
                {
                    strokeStyle: "#4bc0c0",
                    min: 0.1,
                    max: 0.9
                }, // Yellow
                {
                    strokeStyle: "dimgrey",
                    min: 0.9,
                    max: 1
                } // Red
            ],
            staticLabels: {
                font: "1rem sans-serif", // Specifies font
                labels: [1 * (0),
                    1 * (1) / 5,
                    2 * (1) / 5,
                    3 * (1) / 5,
                    4 * (1) / 5,
                    1 * (1)
                ], // Print labels at these values
                color: "white", // Optional: Label text color
                fractionDigits: 1 // Optional: Numerical precision. 0=round off.
            },
            // renderTicks is Optional
            renderTicks: {
                divisions: 5,
                divWidth: 1.1,
                divLength: 0.5,
                divColor: '#000000',
                subDivisions: 6,
                subLength: 0.3,
                subWidth: 0.6,
                subColor: 'black'
            }
        };
        var target = document.getElementById('gaugeac1'); // your canvas element
        var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        gauge.maxValue = 1; // set max gauge value
        gauge.minValue = 0;
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(receivedData.data.ac_1); // set actual value
        var target2 = document.getElementById('gaugeac2'); // your canvas element
        var gauge2 = new Gauge(target2).setOptions(opts); // create sexy gauge!
        gauge2.maxValue = 1; // set max gauge value
        gauge2.minValue = 0;
        gauge2.animationSpeed = 32; // set animation speed (32 is default value)
        gauge2.set(receivedData.data.ac_2); // set actual value
        var target3 = document.getElementById('gaugetc1'); // your canvas element
        var gauge3 = new Gauge(target3).setOptions(opts); // create sexy gauge!
        gauge3.maxValue = 1; // set max gauge value
        gauge3.minValue = 0;
        gauge3.animationSpeed = 32; // set animation speed (32 is default value)
        gauge3.set(receivedData.data.tc_1); // set actual value
        var target4 = document.getElementById('gaugetc2'); // your canvas element
        var gauge4 = new Gauge(target4).setOptions(opts); // create sexy gauge!
        gauge4.maxValue = 1; // set max gauge value
        gauge4.minValue = 0;
        gauge4.animationSpeed = 32; // set animation speed (32 is default value)
        gauge4.set(receivedData.data.tc_2); // set actual value
        var target5 = document.getElementById('gaugets'); // your canvas element
        var gauge5 = new Gauge(target5).setOptions(opts); // create sexy gauge!
        gauge5.maxValue = 1; // set max gauge value
        gauge5.minValue = 0;
        gauge5.animationSpeed = 32; // set animation speed (32 is default value)
        gauge5.set(receivedData.data.ts); // set actual value
        var target6 = document.getElementById('gaugetsa'); // your canvas element
        var gauge6 = new Gauge(target6).setOptions(opts); // create sexy gauge!
        gauge6.maxValue = 1; // set max gauge value
        gauge6.minValue = 0;
        gauge6.animationSpeed = 32; // set animation speed (32 is default value)
        gauge6.set(receivedData.data.tsa); // set actual value
        var target7 = document.getElementById('gaugeflow1'); // your canvas element
        var gauge7 = new Gauge(target7).setOptions(opts); // create sexy gauge!
        gauge7.maxValue = 1; // set max gauge value
        gauge7.minValue = 0;
        gauge7.animationSpeed = 32; // set animation speed (32 is default value)
        gauge7.set(receivedData.data.flow_1); // set actual value
        var target8 = document.getElementById('gaugeflow2'); // your canvas element
        var gauge8 = new Gauge(target8).setOptions(opts); // create sexy gauge!
        gauge8.maxValue = 1; // set max gauge value
        gauge8.minValue = 0;
        gauge8.animationSpeed = 32; // set animation speed (32 is default value)
        gauge8.set(receivedData.data.flow_2); // set actual value
        var target9 = document.getElementById('gaugeflow3'); // your canvas element
        var gauge9 = new Gauge(target9).setOptions(opts); // create sexy gauge!
        gauge9.maxValue = 1; // set max gauge value
        gauge9.minValue = 0;
        gauge9.animationSpeed = 32; // set animation speed (32 is default value)
        gauge9.set(receivedData.data.flow_3); // set actual value
        var target10 = document.getElementById('gaugeflow4'); // your canvas element
        var gauge10 = new Gauge(target10).setOptions(opts); // create sexy gauge!
        gauge10.maxValue = 1; // set max gauge value
        gauge10.minValue = 0;
        gauge10.animationSpeed = 32; // set animation speed (32 is default value)
        gauge10.set(receivedData.data.flow_4); // set actual value
    });
</script>