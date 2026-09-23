<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Pakayoke Core Export</title>
    <link rel="icon" href="../picture/Denso.png">

    <?php include("..\partial\header.html") ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="head_page">HELIUM LEAK TEST : PAKAYOKE CORE EXPORT</div>
                <hr style="background-color: white; height: 2px;">

                <div class="show-box">
                    <div class="show-item">
                        <label for="part-no">KANBAN</label>
                        <input type="text" id="part-no" name="part-no" class="show-text" readonly>
                    </div>
                    <div class="show-items">
                        <div class="show-item">
                            <label for="run-no">RUNING NO</label>
                            <input type="text" id="run-no" name="run-no" class="show-text" readonly>
                        </div>
                        <div class="show-item">
                            <label for="type">TYPE</label>
                            <input type="text" id="type" name="type" class="show-text" readonly>
                        </div>
                    </div>
                    <div class="show-item">
                        <label for="qr">CORE ID</label>
                        <input type="text" id="scan" name="qr" class="show-text" readonly>
                    </div>
                    <div class="show-items">
                        <div class="show-item">
                            <label for="judge">LEAKRATE (%)</label>
                            <input type="text" id="ratio" name="ratio" class="show-text" readonly>
                        </div>
                        <div class="show-item">
                            <label for="judge">JUDGE</label>
                            <input type="text" id="judge" name="judge" class="show-text" readonly>
                        </div>
                    </div>
                    <div class="show-items">
                        <div class="show-item">
                            <label for="lane">LANE</label>
                            <input type="text" id="lane" name="lane" class="show-text" readonly>
                        </div>
                        <div class="show-item">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="show-item">
                            <label for='clear' style='color:grey'>BUTTON</label>
                            <input type="button" id='clear' class="show-text" value='CLEAR'>
                        </div>
                    </div>
                    <!-- <div class="show-item">
                        <label for="lane">LANE</label>
                        <input type="text" id="lane" name="lane" class="show-text" readonly>
                    </div>
                    <div class="show-item">
                        <label for='clear' style='color:grey'>BUTTON</label>
                        <input type="button" id='clear' class="show-text" value='CLEAR'>
                    </div> -->
                </div>
                <hr style="background-color: white; height: 2px;">
                <div class="tableScroll">
                    <table id="calllane" class="table-stock" style="width: 100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="width: 30%;">Kanban_code</th>
                                <th>Core_id</th>
                                <th>Judge</th>
                                <th>Type</th>
                                <th>LL,TL confirm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr style="background-color: white; height: 2px;">
                <!-- <div class="divScroll-core-export">
                    <table id="pokayoke" style="font-size: 20px">
                        <thead>
                            <tr class="first_row">
                                <th>Nb Date</th>
                                <th>Core Part No</th>
                                <th>Volumn</th>
                                <th>NG</th>
                                <th>Leakrate</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>
<style>
    label {
        font-size: 2vh;
    }

    .show-box {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    .show-box2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .show-box label {
        display: block;
        margin-bottom: 5px;
        color: #fff;
        font-weight: bold;
    }

    .show-item input {
        padding: 8px;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        font-size: 16px;
        border-radius: 5px;
        transition: color 0.3s, background-color 0.3s;
    }

    .show-items {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .show-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .show-item:nth-child(1) input,
    .show-item:nth-child(2) input,
    .show-item:nth-child(3) input {
        width: 100%;
    }

    .show-item:nth-child(4) input {
        width: 100%;
    }

    .show-item:nth-child(5) input {
        width: 50%;
    }
    /* .show-item:nth-child(6) input {
        width: 30%;
    } */

    .divScroll-core-export {
        overflow-y: auto;
        height: max;
        /* height: 100%; */
        border: 1px solid white;
    }

    .divScroll-core-export table {
        border-collapse: collapse;
        width: 100%;
    }

    .divScroll-core-export td {
        border: 1px solid white;
        padding: 1vh;
        text-align: center;
        color: white;
        font-weight: bold;
        /* background-color: lightgray; */
    }

    .table-stock {
        text-align: center;
        color: #fff;
        font-size: 16px;
    }

    .ok {
        color: white;
        background-color: green;
    }

    .ng {
        color: white;
        background-color: red;
    }

    .tableScroll {
        overflow-y: auto;
        /* height: 65vh; */
        /* height: 100%; */
        /* border: 1px solid white; */
    }

    .tableScroll table {
        border-collapse: collapse;
        width: 100%;
    }

    .tableScroll td {
        border: 1px solid white;
        padding: 1vh;
        text-align: center;
        font-weight: bold;
        /* background-color: lightgray; */
    }

</style>
<script>
    // function pokayoke() {
    //     const xhttp = new XMLHttpRequest();

    //     xhttp.onload = function() {
    //         if (this.status === 200) {
    //             document.querySelector("#pokayoke tbody").innerHTML = this.responseText;
    //         } else {
    //             console.error("Failed to fetch data. Status: " + this.status);
    //         }
    //     };

    //     xhttp.onerror = function() {
    //         console.error("Error fetching data from helium_percentage.php");
    //     };

    //     xhttp.open("GET", "../server/helium_percentage.php", true);
    //     xhttp.send();
    // }

    // pokayoke();
    // setInterval(pokayoke, 1000);


    function calllane() {
        const xhttp = new XMLHttpRequest();

        xhttp.onload = function() {
            if (this.status === 200) {
                document.querySelector("#calllane tbody").innerHTML = this.responseText;
            } else {
                console.error("Failed to fetch data. Status: " + this.status);
            }
        };

        xhttp.onerror = function() {
            console.error("Error fetching data from helium_lane_stock.php");
        };

        xhttp.open("GET", "../server/helium_lane_stock.php", true);
        xhttp.send();
    }

    calllane();
    setInterval(calllane, 1000);
    

    const socket = new WebSocket("ws://192.168.2.101:1880/ws/pokayoke");
    socket.onopen = function(event) {
        console.log('WebSocket is connected.');
    };

    socket.onmessage = function(event) {
        const res = JSON.parse(event.data);

        var core_id = res.data.core_id;
        var part_no = res.data.part_no;
        var run_no = res.data.run_no;
        var type = res.data.type;
        var ratio = res.data.ratio;
        var judge = res.data.judge;
        var judgeText = res.data.judge;
        var lane = res.data.lane;
        // console.log(res.data);

        document.getElementById('scan').value = core_id;
        document.getElementById('part-no').value = part_no;
        document.getElementById('run-no').value = run_no;
        document.getElementById('type').value = type;
        document.getElementById('ratio').value = ratio;
        document.getElementById('judge').value = judgeText;
        document.getElementById('lane').value = lane;
        var judgeInput = document.getElementById('judge');
        var coreInput = document.getElementById('scan');
        judgeInput.value = judgeText;

        var clear = document.getElementById('clear');
        clear.addEventListener("click",cleardata);

        function cleardata() {
            document.getElementById('scan').value = "";
            document.getElementById('part-no').value = "";
            document.getElementById('run-no').value = "";
            document.getElementById('type').value = "";
            document.getElementById('ratio').value = "";
            document.getElementById('judge').value = "";
            document.getElementById('lane').value = "";
            coreInput.classList.remove('ok');
            coreInput.classList.remove('ng');
            judgeInput.classList.remove('ok');
            judgeInput.classList.remove('ng');
            // console.log("clear");
        }

        if (judgeText === 'OK') {
            judgeInput.classList.remove('ng');
            judgeInput.classList.add('ok');
        }

        if (judgeText === 'NG') {
            judgeInput.classList.remove('ok');
            judgeInput.classList.add('ng');
        }

        if (judgeText === '') {
            judgeInput.classList.remove('ok');
            judgeInput.classList.remove('ng');

        }

        if (part_no.substring(0,6) != "MASTER") {
            if (type != '27D' && core_id != '') {
                if (part_no.substring(0,13) == core_id) {
                    coreInput.classList.add('ok');
                } else {
                    coreInput.classList.add('ng');
                }
            } else if (type = '27D' && core_id != '') {
                if (part_no.substring(9,13) == core_id.substring(9,13)) {
                    coreInput.classList.add('ok');
                } else {
                    coreInput.classList.add('ng');
                }
                // console.log(part_no.substring(9,13))
                // console.log(core_id.substring(9,13))
            } else {
                coreInput.classList.remove('ok');
                coreInput.classList.remove('ng');
            }
        } else {
            coreInput.classList.remove('ok');
            coreInput.classList.remove('ng');
        }
        
    };

    socket.onerror = function(error) {
        console.error('WebSocket Error: ' + error);
    };

    socket.onclose = function(event) {
        console.log('WebSocket is closed now.');
    };
</script>
<script>
    function submitcode(judge, kanban_code,lane) {
        // แสดงกล่องป้อนรหัส
        const password = prompt("Enter Password:");

        // ตรวจสอบว่ามีการป้อนรหัสผ่านหรือไม่
        if (password) {
            // ส่งค่าผ่าน AJAX ไปยังเซิร์ฟเวอร์
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../server/helium_lane_update.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("judge=" + judge + "&kanban_code=" + kanban_code + "&lane=" + lane + "&password=" + encodeURIComponent(password));

            xhttp.onload = function() {
                if (this.status === 200) {
                    alert(this.responseText);
                    // รีเฟรชข้อมูลใหม่ถ้าต้องการ
                } else {
                    alert("Error updating judge");
                }
            };
        } else {
            alert("รหัสผ่านต้องไม่เป็นค่าว่าง");
        }
        console.log("Judge: " + judge);
        console.log("Kanban Code: " + kanban_code);
        console.log("lane: " + lane);
    }

</script>

<script>
        document.getElementById("clear").addEventListener("click", function() {
            var xhr = new XMLHttpRequest();
            var url = "http://192.168.2.101:1880/ws/clear"; // ปรับ URL นี้ให้ตรงกับ Endpoint ใน Node-RED ของคุณ
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");

            // ข้อความที่ต้องการส่งไปยัง Node-RED
            var data = JSON.stringify({
                message: "clear"
            });

            xhr.send(data);

            // xhr.onreadystatechange = function () {
            //     if (xhr.readyState === 4 && xhr.status === 200) {
            //         alert("ข้อความถูกส่งแล้ว!");
            //     }
            // };
        });
    </script>

