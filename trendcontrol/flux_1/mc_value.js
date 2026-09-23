document.addEventListener('DOMContentLoaded', function () {
    // โค้ด JavaScript ที่ต้องการให้ทำงานหลังจาก DOM โหลดเสร็จสมบูรณ์
    fetchDataAndPlot();
    setInterval(fetchDataAndPlot, 10000);

});

function fetchDataAndPlot() {
    fetch('server/mc_condition_server.php')
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            updateLatestData(data);
        })
        .catch(error => console.error('Error fetching data:', error));
}



function updateLatestData(data) {
    // ตรวจสอบว่า element ที่ต้องการมีอยู่ใน DOM หรือไม่
    const dateac1 = document.getElementById('latestDate');
    const timeac1 = document.getElementById('latestTime');
    const valueac1 = document.getElementById('latestValue');
    const statusac1 = document.getElementById('latestState');

    const datetc1 = document.getElementById('datetc1');
    const timetc1 = document.getElementById('timetc1');
    const valuetc1 = document.getElementById('valuetc1');
    const statustc1 = document.getElementById('statustc1');

    const dateac2 = document.getElementById('dateac2');
    const timeac2 = document.getElementById('timeac2');
    const valueac2 = document.getElementById('valueac2');
    const statusac2 = document.getElementById('statusac2');

    const datetc2 = document.getElementById('datetc2');
    const timetc2 = document.getElementById('timetc2');
    const valuetc2 = document.getElementById('valuetc2');
    const statustc2 = document.getElementById('statustc2');

    const datets = document.getElementById('datets');
    const timets = document.getElementById('timets');
    const valuets = document.getElementById('valuets');
    const statusts = document.getElementById('statusts');

    const datetsa = document.getElementById('datetsa');
    const timetsa = document.getElementById('timetsa');
    const valuetsa = document.getElementById('valuetsa');
    const statustsa = document.getElementById('statustsa');

    const dateflow1 = document.getElementById('dateflow1');
    const timeflow1 = document.getElementById('timeflow1');
    const valueflow1 = document.getElementById('valueflow1');
    const statusflow1 = document.getElementById('statusflow1');

    const dateflow2 = document.getElementById('dateflow2');
    const timeflow2 = document.getElementById('timeflow2');
    const valueflow2 = document.getElementById('valueflow2');
    const statusflow2 = document.getElementById('statusflow2');

    const dateflow3 = document.getElementById('dateflow3');
    const timeflow3 = document.getElementById('timeflow3');
    const valueflow3 = document.getElementById('valueflow3');
    const statusflow3 = document.getElementById('statusflow3');

    const dateflow4 = document.getElementById('dateflow4');
    const timeflow4 = document.getElementById('timeflow4');
    const valueflow4 = document.getElementById('valueflow4');
    const statusflow4 = document.getElementById('statusflow4');

    
    // if (dateac1 && timeac1 && valueac1 && statusac1 &&
    //     datetc1 && timetc1 && valuetc1 && statustc1 &&
    //     dateac2 && timeac2 && valueac2 && statusac2 &&
    //     datetc2 && timetc2 && valuetc2 && statustc2) {
        // ถ้ามี element ทั้ง 8 ใน DOM
        const latestDataAC1 = data.AfterCutAirBlow1;
        dateac1.innerText = latestDataAC1.date;
        valueac1.innerText = latestDataAC1.value;
        timeac1.innerText = latestDataAC1.time;
        // valueac1.innerText = latestDataAC1.value;
        if(latestDataAC1.status == "Alarm") {
            statusac1.style.color = "red";
        }
        if (latestDataAC1.status == "Normal"){
            statusac1.style.color = "green";
        }
        // const SetupAC1 = data.SetupAC1;
        // console.log(SetupAC1.gauge_min);
        // var opts = {
        //     angle: 0, // The span of the gauge arc
        //     lineWidth: 0.5, // The line thickness
        //     radiusScale: 1, // Relative radius
        //     pointer: {
        //         length: 0.52, // // Relative to gauge radius
        //         strokeWidth: 0.035, // The thickness
        //         color: 'white' // Fill color
        //     },
        //     limitMax: true,     // If false, max value increases automatically if value > maxValue
        //     limitMin: true,     // If true, the min value of the gauge will be fixed
        //     colorStart: '#6FADCF',   // Colors
        //     colorStop: '#8FC0DA',    // just experiment with them
        //     strokeColor: '#E0E0E0',  // to see which ones work best for you
        //     generateGradient: true,
        //     highDpiSupport: true,     // High resolution support
        //     staticZones: [
        //         {strokeStyle: "dimgrey", min: SetupAC1.gauge_min, max: SetupAC1.alarm_min}, // Green
        //         {strokeStyle: SetupAC1.gauge_color, min: SetupAC1.alarm_min, max: SetupAC1.alarm_max}, // Yellow
        //         {strokeStyle: "dimgrey", min: SetupAC1.alarm_max, max: SetupAC1.gauge_max}  // Red
        //     ],
        //     staticLabels: {
        //         font: "1rem sans-serif",  // Specifies font
        //         labels: [1*(SetupAC1.gauge_min), 
        //                 1*(SetupAC1.gauge_max)/5, 
        //                 2*(SetupAC1.gauge_max)/5, 
        //                 3*(SetupAC1.gauge_max)/5, 
        //                 4*(SetupAC1.gauge_max)/5, 
        //                 1*(SetupAC1.gauge_max)],  // Print labels at these values
        //         color: "white",  // Optional: Label text color
        //         fractionDigits: 1  // Optional: Numerical precision. 0=round off.
        //     },
        //     // renderTicks is Optional
        //     renderTicks: {
        //         divisions: 5,
        //         divWidth: 1.1,
        //         divLength: 0.5,
        //         divColor: '#000000',
        //         subDivisions: 6,
        //         subLength: 0.3,
        //         subWidth: 0.6,
        //         subColor: 'black'
        //     }
        // };
        // var target = document.getElementById('gaugeac1'); // your canvas element
        // var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
        // gauge.maxValue = SetupAC1.gauge_max; // set max gauge value
        // gauge.minValue = SetupAC1.gauge_min;
        // gauge.animationSpeed = 32; // set animation speed (32 is default value)
        // gauge.set(latestDataAC1.value); // set actual value
        

        const DataTC1 = data.TwistChutAirBlow1;
        datetc1.innerText = DataTC1.date;
        timetc1.innerText = DataTC1.time;
        valuetc1.innerText = DataTC1.value;
        if(DataTC1.status == "Alarm") {
            statustc1.style.color = "red";
        }
        if (DataTC1.status == "Normal"){
            statustc1.style.color = "green";
        }

        const DataAC2 = data.AfterCutAirBlow2;
        dateac2.innerText = DataAC2.date;
        timeac2.innerText = DataAC2.time;
        valueac2.innerText = DataAC2.value;
        if(DataAC2.status == "Alarm") {
            statusac2.style.color = "red";
        }
        if (DataAC2.status == "Normal"){
            statusac2.style.color = "green";
        }

        const DataTC2 = data.TwistChutAirBlow2;
        datetc2.innerText = DataTC2.date;
        timetc2.innerText = DataTC2.time;
        valuetc2.innerText = DataTC2.value;
        if(DataTC2.status == "Alarm") {
            statustc2.style.color = "red";
        }
        if (DataTC2.status == "Normal"){
            statustc2.style.color = "green";
        }

        const DataTS = data.TensionPressure;
        datets.innerText = DataTS.date;
        timets.innerText = DataTS.time;
        valuets.innerText = DataTS.value;
        if(DataTS.status == "Alarm") {
            statusts.style.color = "red";
        }
        if (DataTS.status == "Normal"){
            statusts.style.color = "green";
        }

        const DataTSA = data.TensionAdjustPress;
        datetsa.innerText = DataTSA.date;
        timetsa.innerText = DataTSA.time;
        valuetsa.innerText = DataTSA.value;
        if(DataTSA.status == "Alarm") {
            statustsa.style.color = "red";
        }
        if (DataTSA.status == "Normal"){
            statustsa.style.color = "green";
        }

        const Dataflow1 = data.Flow1;
        dateflow1.innerText = Dataflow1.date;
        timeflow1.innerText = Dataflow1.time;
        valueflow1.innerText = Dataflow1.value;
        if(Dataflow1.status == "Alarm") {
            statusflow1.style.color = "red";
        }
        if (Dataflow1.status == "Normal"){
            statusflow1.style.color = "green";
        }

        const Dataflow2 = data.Flow2;
        dateflow2.innerText = Dataflow2.date;
        timeflow2.innerText = Dataflow2.time;
        valueflow2.innerText = Dataflow2.value;
        if(Dataflow2.status == "Alarm") {
            statusflow2.style.color = "red";
        }
        if (Dataflow2.status == "Normal"){
            statusflow2.style.color = "green";
        }

        const Dataflow3 = data.Flow3;
        dateflow3.innerText = Dataflow3.date;
        timeflow3.innerText = Dataflow3.time;
        valueflow3.innerText = Dataflow3.value;
        if(Dataflow3.status == "Alarm") {
            statusflow3.style.color = "red";
        }
        if (Dataflow3.status == "Normal"){
            statusflow3.style.color = "green";
        }

        const Dataflow4 = data.Flow4;
        dateflow4.innerText = Dataflow4.date;
        timeflow4.innerText = Dataflow4.time;
        valueflow4.innerText = Dataflow4.value;
        if(Dataflow4.status == "Alarm") {
            statusflow4.style.color = "red";
        }
        if (Dataflow4.status == "Normal"){
            statusflow4.style.color = "green";
        }

        


    // } else {
    //     console.error('One or more elements not found in DOM.');
    // }
}
