<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="..\..\style.css">
        <title>Denso | FIN 11.5D QUALITY RESULT</title>
        <link rel="icon" href="../../picture/Denso.png">

        <?php include("navbar/header_115_d.html") ?>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="divScroll">
                        
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    // สร้างตัวแปร
    var myVariable = "QUALITY RESULT";

    // แสดงข้อความใน HTML ตามค่าของตัวแปร
    document.getElementById("message").textContent = myVariable;
</script>
<script>
    setInterval(function () {
        // ใช้ fetch เพื่อดึงข้อมูล JSON จากไฟล์ PHP
        fetch('server/fin_qr_prob_server.php')
            .then(response => response.json())
            .then(data => {
                // สร้าง HTML สำหรับตาราง
                // console.log(data);
                var tableHtml = "<table>";
                tableHtml += "<thead>";
                tableHtml += "<tr class='first_row'>";
                tableHtml += "<th style='width:6vw;'>Date</th>"
                tableHtml += "<th style='width:4vw;'>Time</th>"
                tableHtml += "<th>Part</th>"
                tableHtml += "<th style='width:1vw;'>Status</th>"
                tableHtml += "</tr>"
                for (var i = 0; i < data.length; i++) {
                    tableHtml += "<tr><td>" + data[i].date + "</td><td>" + data[i].time + "</td><td>" + data[i].part_no + "</td><td style='color:red'>&#11044</td></tr>";
                }
                
                tableHtml += "</table>";
                // นำ HTML ไปแทนที่ข้อมูลเดิมใน element ที่มี id เท่ากับ "table-container"
                document.getElementById("table-container").innerHTML = tableHtml;
            })
            .catch(error => console.error('Error:', error));
    }, 10000);
</script>