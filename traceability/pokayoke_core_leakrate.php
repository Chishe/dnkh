<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width:device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Pakayoke Core Leakrate</title>
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
                <div class="head_page">HELIUM LEAK TEST : PAKAYOKE CORE LEAKRATE</div>
                <hr style="background-color: white; height: 2px;">

                <div class="divScroll-core-export">
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


</style>
<script>
    function pokayoke() {
        const xhttp = new XMLHttpRequest();

        xhttp.onload = function() {
            if (this.status === 200) {
                document.querySelector("#pokayoke tbody").innerHTML = this.responseText;
            } else {
                console.error("Failed to fetch data. Status: " + this.status);
            }
        };

        xhttp.onerror = function() {
            console.error("Error fetching data from helium_percentage.php");
        };

        xhttp.open("GET", "../server/helium_percentage.php", true);
        xhttp.send();
    }

    pokayoke();
    setInterval(pokayoke, 1000);


</script>
