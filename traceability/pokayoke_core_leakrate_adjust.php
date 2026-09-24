<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Denso | Pokayoke Core Leakrate Adjust</title>
    <link rel="icon" href="../picture/Denso.png">

    <?php include("..\partial\header.html") ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 nav">
                <?php include("../partial/navbar.html") ?>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 adjust-page">
                <div class="head_page">HELIUM LEAK TEST : POKAYOKE CORE LEAKRATE ADJUST</div>
                <hr style="background-color: white; height: 2px;">
                <form class="adjust-toolbar" id="adjust-search-form">
                    <label for="selected_date">NB production date</label>
                    <input type="date" id="selected_date" name="selected_date" value="" required>
                    <button type="submit" id="search">Search pending records</button>
                    <p class="adjust-status" id="adjust-status" role="status" aria-live="polite"></p>
                </form>

                <div class="divScroll adjust-table-scroll">
                    <table id="pokayoke" class="adjust-table">
                        <thead>
                            <tr class="first_row">
                                <th>Core Code</th>
                                <th>Core Part No</th>
                                <th>Assy Code</th>
                                <th>Assy line</th>
                                <th>NB PD</th>
                                <th>Judge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="adjust-empty-row">
                                <td colspan="6">Select a date, then search for pending records.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    var select_date = document.getElementById("selected_date");
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

    select_date.addEventListener("change", function() {
        // console.log(select_date.value);
    });

    document.getElementById("search").addEventListener("click", function() {
        var selectedDate = select_date.value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../server/helium_adjust.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                displayData(response, selectedDate); 
            } else {
                alert("Error fetching data.");
            }
        };

        xhr.send("date=" + selectedDate);
    });

    function displayData(data, selectedDate) {
        var tableBody = document.querySelector("#pokayoke tbody");
        tableBody.innerHTML = "";

        data.forEach(function(row) {
            var tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${row.core_code}</td>
                <td>${row.core_part_no}</td>
                <td>${row.assy_code}</td>
                <td>${row.assy_line}</td>
                <td>${row.nb_pd}</td>
                <td>
                    <button class="pass-btn" data-core-code="${row.core_code}">pass</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });

        document.querySelectorAll(".pass-btn").forEach(button => {
            button.addEventListener("click", function() {
                var coreCode = this.getAttribute("data-core-code");

                updateDatabase(coreCode, selectedDate);
            });
        });
    }

    function updateDatabase(coreCode, selectedDate) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../server/helium_update.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Status updated successfully.");
                var xhrRefresh = new XMLHttpRequest();
                xhrRefresh.open("POST", "../server/helium_adjust.php", true);
                xhrRefresh.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhrRefresh.onload = function() {
                    if (xhrRefresh.status == 200) {
                        var response = JSON.parse(xhrRefresh.responseText);
                        displayData(response, selectedDate); 
                    } else {
                        alert("Error fetching updated data.");
                    }
                };

                xhrRefresh.send("date=" + selectedDate);
            } else {
                alert("Error updating status.");
            }
        };

        xhr.send("core_code=" + coreCode);
    }
</script>
