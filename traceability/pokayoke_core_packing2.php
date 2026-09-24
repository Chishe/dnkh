<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Pokayoke Core Export</title>
    <link rel="icon" href="../picture/Denso.png">

    <?php include("..\partial\header.html") ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="head_page">POKAYOKE CORE EXPORT</div>
                <hr style="background-color: white; height: 2px;">
                <div class="ct">
                    <div class="show-box">
                        <div class="show-item">
                            <label for="part-no">PART NO</label>
                            <input type="text" id="part-no" name="part-no" class="show-text" readonly>
                        </div>
                        <div class="show-item">
                            <label for="judge">JUDGE</label>
                            <input type="text" id="judge" name="judge" class="show-text" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="background-color: white; height: 2px;">
                <div id="message">Waiting For Scan..</div>
                <div id="ins_calendar" style="display:flex; justify-content: center; align-items: center; visibility: hidden; font-size: 28px; padding-top: 25px;">
                    <input type="date" id="select_date" style="margin-right: 10px;">
                    <button id="submit">Select</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    #message {
        color: #000;
        font-size: 19vh;
        font-weight: bold;
        text-align: center;
        text-shadow: 3px 3px gray;
        background-color: yellow;
        background-size: 56.57px 56.57px;
        transition: all 1s ease;
        padding: 10px;
    }

    .green {
        text-shadow: 3px 3px #B2BEB5;
    }

    .red {
        text-shadow: 3px 3px #B2BEB5;
    }

    label {
        font-size: 2vh;
    }

    .ct {
        margin-left: 350px;
        margin-right: 350px;
    }

    .show-box {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 150px;
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

    .ok {
        color: white;
        background-color: green;
    }

    .ng {
        color: white;
        background-color: red;
    }
</style>

<script>
    var select_date = document.getElementById("select_date");
    var today = new Date();
    var yyyy = today.getFullYear();
    var mm = today.getMonth() + 1;
    var dd = today.getDate();
    if (mm < 10) {
        mm = '0' + mm;
    }
    if (dd < 10) {
        dd = '0' + dd;
    }

    var currentDate = yyyy + '-' + mm + '-' + dd;
    select_date.value = currentDate;

    const socketCorePacking = new WebSocket("ws://192.168.2.101:1880/ws/core_packing2");
    socketCorePacking.onopen = function(event) {
        console.log('WebSocket is connected.');
    };

    socketCorePacking.onmessage = function(event) {

        const res = JSON.parse(event.data);
        
        if (!res || !res.data) {
            console.error("Invalid WebSocket response:", res);

            const messageElement = document.getElementById("message");
            messageElement.textContent = "System Data Error";
            messageElement.style.backgroundColor = "red";
            return;
        }

        const kanban = res.data.kanban;
        const judgeText = res.data.judge;
        const value = res.data.value;
        const mc = res.data.mc;
        console.log(res);

        document.getElementById('part-no').value = kanban;
        document.getElementById('judge').value = judgeText;

        const judgeInput = document.getElementById('judge');
        var messageElement = document.getElementById('message');
        judgeInput.value = judgeText;

        if (value === 'OK') {
            judgeInput.classList.remove('ng');
            judgeInput.classList.add('ok');
            messageElement.textContent = "Ready to Package";
            messageElement.style.backgroundColor = 'green';
            messageElement.className = 'green';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'bypass') {
            judgeInput.classList.remove('ng');
            judgeInput.classList.add('ok');
            messageElement.textContent = "Ready to Package";
            messageElement.style.backgroundColor = 'green';
            messageElement.className = 'green';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'spare') {
            judgeInput.classList.remove('ng');
            judgeInput.classList.add('ok');
            messageElement.textContent = "Assy Spare Part";
            messageElement.style.backgroundColor = 'green';
            messageElement.className = 'green';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'NG') {
            judgeInput.classList.remove('ok');
            judgeInput.classList.add('ng');
            messageElement.textContent = "Defect Over";
            messageElement.style.backgroundColor = 'red';
            messageElement.className = 'red';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'out-T') {
            judgeInput.classList.remove('ok');
            judgeInput.classList.add('ng');
            messageElement.textContent = "No Helium";
            messageElement.style.backgroundColor = 'red';
            messageElement.className = 'red';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'out-W') {
            judgeInput.classList.remove('ok');
            judgeInput.classList.add('ng');
            messageElement.textContent = "No Data Water Test";
            messageElement.style.backgroundColor = 'red';
            messageElement.className = 'red';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'out-D') {
            judgeInput.classList.remove('ok');
            judgeInput.classList.add('ng');
            messageElement.textContent = "No Record Found";
            messageElement.style.backgroundColor = 'red';
            messageElement.className = 'red';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'reset') {
            judgeInput.classList.remove('ng');
            judgeInput.classList.remove('ok');
            messageElement.textContent = "Waiting For Scan..";
            messageElement.style.backgroundColor = 'yellow';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'load') {
            judgeInput.classList.remove('ng');
            judgeInput.classList.remove('ok');
            messageElement.textContent = "Searching ..";
            messageElement.style.backgroundColor = 'yellow';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        } else if (value === 'water' || value === 'dg') {
            if (value === 'water') {
                messageElement.textContent = "Select NB Date";
            } else {
                messageElement.textContent = "Select Core Date";
            }
            messageElement.style.backgroundColor = 'yellow';
            document.getElementById("ins_calendar").style.visibility = 'visible';
            document.getElementById("submit").addEventListener("click", function() {
                var dataToSend = {
                    kanban: kanban,
                    nb_date: document.getElementById("select_date").value,
                    type: value,
                    mc: mc,
                };

                fetch('http://192.168.2.101:1880/data_confirm2', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(dataToSend) // ส่งข้อมูลในรูปแบบ JSON
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data); // รับข้อมูลที่ Node-RED ส่งกลับ
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        } else {
            judgeInput.classList.remove('ok');
            judgeInput.classList.add('ng');
            messageElement.textContent = "No Record Found";
            messageElement.style.backgroundColor = 'red';
            messageElement.className = 'red';
            document.getElementById("ins_calendar").style.visibility = 'hidden';
        }
    };

    socketCorePacking.onerror = function(error) {
        console.error('WebSocket Error: ' + error);
    };

    socketCorePacking.onclose = function(event) {
        console.log('WebSocket is closed now.');
    };
</script>