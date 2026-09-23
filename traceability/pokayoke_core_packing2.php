<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Pokayoke Core Packing</title>
    <link rel="icon" href="../picture/Denso.png">

    <?php include("..\partial\header.html") ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="head_page">HELIUM LEAK TEST : PAKAYOKE CORE PACKING</div>
                <hr style="background-color: white; height: 2px;">
                <div class="ct">
                    <div class="show-box">
                        <div class="show-item">
                            <label for="part-no">PART NO</label>
                            <input type="text" id="part-no" name="part-no" class="show-text" readonly>
                        </div>
                        <!-- <div class="show-items">
                            <div class="show-item">
                                <label for="judge">RATIO</label>
                                <input type="text" id="ratio" name="ratio" class="show-text" readonly>
                            </div>
                            <div class="show-item">
                                <label for="judge">JUDGE</label>
                                <input type="text" id="judge" name="judge" class="show-text" readonly>
                            </div>
                        </div> -->
                        <div class="show-item">
                            <label for="judge">JUDGE</label>
                            <input type="text" id="judge" name="judge" class="show-text" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="background-color: white; height: 2px;">
                <div id="message">waiting for scan..</div>
                <!-- <div class="head_page">TIME COUNT </div>
                <div class="loading-container">
                    <div class="loading-bar" id="loadingBar"></div>
                    <div class="countdown" id="countdown">30:00</div>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>
<style>
    /* .loading-container {
        position: relative;
        width: 100%;
        background-color: #ddd;
        border-radius: 5px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    .loading-bar {
        height: 40px;
        width: 100%;
        border: 2px solid #000;
        background-color: green;
        transition: width 30m linear, background-color 30m linear;
    }

    .countdown {
        position: absolute;
        top: 0;
        left: 50%;
        margin-top: 5px;
        transform: translateX(-50%);
        color: #fff;
        font-weight: bold;
        font-size: 4vh;
        line-height: 30px;
        font-family: Arial, sans-serif;
    } */

    #message {
        color: #000;
        font-size: 20vh;
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

    .show-box2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
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

    .show-item input {
        padding: 8px;
        box-sizing: border-box;
        text-align: center;
        font-size: 16px;
        border-radius: 5px;
        transition: color 0.3s, background-color 0.3s;
    }


    .show-item:nth-child(1) input,
    .show-item:nth-child(2) input {
        width: 100%;
    }

    .show-item:nth-child(3) input,
    .show-item:nth-child(4) input {
        width: 50%;
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
    let socket = null;
    let reconnectTimer = null;
    let reconnectCount = 0;

    const WS_URL = "ws://192.168.2.101:1880/ws/core_packing2";

    function connectWebSocket() {

        // ป้องกัน connection ซ้ำ
        if (
            socket &&
            (
                socket.readyState === WebSocket.OPEN ||
                socket.readyState === WebSocket.CONNECTING
            )
        ) {
            console.log("⚠️ WebSocket already connected/connecting");
            return;
        }

        console.log("====================================");
        console.log("🔄 Connecting WebSocket...");
        console.log("📡 URL:", WS_URL);
        console.log("🕐 Time:", new Date().toLocaleString());
        console.log("====================================");

        socket = new WebSocket(WS_URL);


        // =========================
        // CONNECT SUCCESS
        // =========================
        socket.onopen = function (event) {

            console.log("✅ WebSocket CONNECTED");
            console.log("📡 URL:", WS_URL);
            console.log("🕐 Time:", new Date().toLocaleString());
            console.log("ReadyState:", socket.readyState);

            reconnectCount = 0;

            if (reconnectTimer) {
                clearTimeout(reconnectTimer);
                reconnectTimer = null;
            }
        };


        // =========================
        // RECEIVE MESSAGE
        // =========================
        socket.onmessage = function (event) {

            console.log("📥 WebSocket MESSAGE received");
            console.log("RAW DATA:", event.data);

            try {

                const res = JSON.parse(event.data);

                console.log("JSON DATA:", res);

                const kanban = res.data.kanban;
                const ratio = res.data.ratio;
                const judgeText = res.data.judge;
                const value = res.data.value;

                console.log("Kanban :", kanban);
                console.log("Ratio  :", ratio);
                console.log("Judge  :", judgeText);
                console.log("Value  :", value);

                document.getElementById('part-no').value = kanban;

                // document.getElementById('ratio').value = ratio;

                const judgeInput =
                    document.getElementById('judge');

                const messageElement =
                    document.getElementById('message');

                judgeInput.value = judgeText;


                if (value === 'OK') {

                    judgeInput.classList.remove('ng');
                    judgeInput.classList.add('ok');

                    messageElement.textContent =
                        "READY TO PACK";

                    messageElement.style.backgroundColor =
                        'green';

                    messageElement.className =
                        'green';


                } else if (value === 'bypass') {

                    judgeInput.classList.remove('ng');
                    judgeInput.classList.add('ok');

                    messageElement.textContent =
                        "ASSY SPARE PART";

                    messageElement.style.backgroundColor =
                        'green';

                    messageElement.className =
                        'green';


                } else if (value === 'wrong') {

                    judgeInput.classList.remove('ok');
                    judgeInput.classList.add('ng');

                    messageElement.textContent =
                        "UNKNOWN";

                    messageElement.style.backgroundColor =
                        'red';

                    messageElement.className =
                        'red';


                } else if (value === 'reset') {

                    judgeInput.classList.remove('ng');
                    judgeInput.classList.remove('ok');

                    messageElement.textContent =
                        "Waiting for scan ...";

                    messageElement.style.backgroundColor =
                        'yellow';


                } else {

                    judgeInput.classList.remove('ok');
                    judgeInput.classList.add('ng');

                    messageElement.textContent =
                        "NOT READY TO PACK";

                    messageElement.style.backgroundColor =
                        'red';

                    messageElement.className =
                        'red';
                }

            } catch (error) {

                console.error(
                    "❌ Invalid WebSocket message:",
                    error
                );
            }
        };


        // =========================
        // ERROR
        // =========================
        socket.onerror = function (error) {

            console.error("❌ WebSocket ERROR");
            console.error("URL:", WS_URL);
            console.error(error);
        };


        // =========================
        // CONNECTION CLOSED
        // =========================
        socket.onclose = function (event) {

            console.warn("🔴 WebSocket DISCONNECTED");
            console.warn("Code   :", event.code);
            console.warn("Reason :", event.reason || "No reason");
            console.warn("Clean  :", event.wasClean);
            console.warn("Time   :", new Date().toLocaleString());

            socket = null;

            reconnectCount++;

            console.log(
                `🔄 Reconnect attempt #${reconnectCount} in 3 seconds...`
            );

            if (reconnectTimer) {
                clearTimeout(reconnectTimer);
            }

            reconnectTimer = setTimeout(() => {

                console.log(
                    `🔄 Reconnecting #${reconnectCount}...`
                );

                connectWebSocket();

            }, 3000);
        };
    }


    // =========================
    // FIRST CONNECTION
    // =========================
    connectWebSocket();

</script>