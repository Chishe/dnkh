<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width:device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href="..\..\style.css">
        <title>Denso | FIN 11.5D DOCUMENT RECORD</title>
        <link rel="icon" href="../../picture/Denso.png">

        <?php include("navbar/header_115_d.html") ?>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row" style="color: palegoldenrod; font-weight: bold; font-size: 2rem; justify-content: center; text-align: center;">
                FIN FORMING 11.5D No.6
            </div>
                
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="document_record.php" method="post" style="display:flex;">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="dataType" style="color:gold; font-weight:bold; font-size:1.5rem">PART NO.&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select name="dataType" id="dataType" style="font-size:1.5rem" required>
                                <option value="">--- select part no ---</option>
                                <option value="KN222310_8750">KN222310-8750</option>
                                <option value="KN233310_1880">KN233310-1880</option>
                                <option value="KN222310_9320">KN222310-9320</option>
                                <option value="KN222310_9350">KN222310-9350</option>
                                <option value="KN222310_9650">KN222310-9650</option>
                                <option value="KN222310_9710">KN222310-9710</option>
                                <option value="KN222310_9110">KN222310-9110</option>
                                <option value="KN233310_5080">KN233310-5080</option>
                                <option value="KN222310_9970">KN222310-9970</option>
                                <option value="KN233310_0090">KN233310-0090</option>
                            </select>
                            <div style="border: 0.1rem solid red">
                                <p style="color:white; font-size: 1.5rem; font-weight:bold">&nbsp;&nbsp;Instrument : </p>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="width:50%"><img src="\..\..\picture\digital_micrometer.png" style="width:100%"></td>
                                            <td style="width:50%; text-align:center"><p style="color:white; font-size: 1.2rem; font-weight:bold">Digital micrometer</p></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%"><img src="\..\..\picture\jig.jpg" style="width:100%"></td>
                                            <td style="width:50%; text-align:center"><p style="color:white; font-size: 1.2rem; font-weight:bold">Jig</p></td>
                                        </tr>
                                        <tr>
                                            <td style="width:50%"><img src="\..\..\picture\tablet.png" style="width:100%"></td>
                                            <td style="width:50%; text-align:center"><p style="color:white; font-size: 1.2rem; font-weight:bold">Tablet</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="display:flex;">
                            <label for="data">ข้อมูล:</label>
                            <input type="text" name="data" id="data" required>

                            <button type="submit">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    // สร้างตัวแปร
    var myVariable = "DOCUMENT RECORD";

    // แสดงข้อความใน HTML ตามค่าของตัวแปร
    document.getElementById("message").textContent = myVariable;

    // document.addEventListener('DOMContentLoaded', function () {
    //     // โค้ด JavaScript ที่ต้องการให้ทำงานหลังจาก DOM โหลดเสร็จสมบูรณ์
    //     search_value();
    // });
    // function search_value(data) {
    //     const latestDataAC1 = data.KN222310_8750;
    //     // if ()
    // }
</script>