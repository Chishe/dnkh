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
const selectDate = document.getElementById("selected_date");
const form = document.getElementById("adjust-search-form");
const statusText = document.getElementById("adjust-status");

console.log("[INIT] Page loaded");
console.log("[INIT] selectDate:", selectDate);
console.log("[INIT] form:", form);
console.log("[INIT] statusText:", statusText);


// ========================================
// Set today
// ========================================

const today = new Date();

const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, "0");
const dd = String(today.getDate()).padStart(2, "0");

selectDate.value = `${yyyy}-${mm}-${dd}`;

console.log("[INIT] Default date:", selectDate.value);


// ========================================
// Search
// ========================================

form.addEventListener("submit", function (event) {

    event.preventDefault();

    const selectedDate = selectDate.value;

    console.log("--------------------------------");
    console.log("[SEARCH] Submit");
    console.log("[SEARCH] Selected date:", selectedDate);

    if (!selectedDate) {

        console.warn("[SEARCH] No date selected");

        statusText.textContent = "Please select a date.";

        return;
    }

    loadData(selectedDate);
});


// ========================================
// Load data
// ========================================

function loadData(selectedDate) {

    console.log("[LOAD] Start");
    console.log("[LOAD] Date:", selectedDate);

    statusText.textContent = "Searching...";

    const xhr = new XMLHttpRequest();

    const url = "../server/helium_adjust.php";

    console.log("[LOAD] POST:", url);

    xhr.open(
        "POST",
        url,
        true
    );

    xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );


    // Request started
    xhr.onloadstart = function () {
        console.log("[LOAD] Request started");
    };


    // Response
    xhr.onload = function () {

        console.log("[LOAD] Response received");
        console.log("[LOAD] HTTP Status:", xhr.status);
        console.log("[LOAD] Raw response:", xhr.responseText);

        if (xhr.status !== 200) {

            console.error(
                "[LOAD] HTTP Error:",
                xhr.status
            );

            console.error(
                "[LOAD] Response:",
                xhr.responseText
            );

            statusText.textContent =
                "Error fetching data.";

            return;
        }

        try {

            const response =
                JSON.parse(xhr.responseText);

            console.log(
                "[LOAD] Parsed JSON:",
                response
            );

            console.log(
                "[LOAD] Is array:",
                Array.isArray(response)
            );

            if (!Array.isArray(response)) {

                console.error(
                    "[LOAD] Invalid response format:",
                    response
                );

                statusText.textContent =
                    "Invalid server response.";

                return;
            }

            console.log(
                "[LOAD] Records:",
                response.length
            );

            if (response.length > 0) {

                console.table(response);

            } else {

                console.warn(
                    "[LOAD] No pending records"
                );
            }


            displayData(
                response,
                selectedDate
            );


            statusText.textContent =
                `${response.length} pending record(s) found.`;

        } catch (error) {

            console.error(
                "[LOAD] JSON parse error:",
                error
            );

            console.error(
                "[LOAD] Raw server response:",
                xhr.responseText
            );

            statusText.textContent =
                "Invalid response from server.";
        }
    };


    // Network error
    xhr.onerror = function () {

        console.error(
            "[LOAD] Network error"
        );

        statusText.textContent =
            "Cannot connect to server.";
    };


    // Request finished
    xhr.onloadend = function () {

        console.log(
            "[LOAD] Request finished"
        );

    };


    const requestData =
        "date=" + encodeURIComponent(selectedDate);

    console.log(
        "[LOAD] Sending:",
        requestData
    );

    xhr.send(requestData);
}


// ========================================
// Display table
// ========================================

function displayData(
    data,
    selectedDate
) {

    console.log("--------------------------------");
    console.log("[DISPLAY] Start");
    console.log("[DISPLAY] Date:", selectedDate);
    console.log("[DISPLAY] Data:", data);
    console.log("[DISPLAY] Rows:", data.length);

    const tableBody =
        document.querySelector("#pokayoke tbody");

    if (!tableBody) {

        console.error(
            "[DISPLAY] #pokayoke tbody NOT FOUND"
        );

        return;
    }

    tableBody.innerHTML = "";


    // No data
    if (data.length === 0) {

        console.warn(
            "[DISPLAY] No data"
        );

        const tr =
            document.createElement("tr");

        tr.className =
            "adjust-empty-row";

        tr.innerHTML = `
            <td colspan="6">
                No pending records found.
            </td>
        `;

        tableBody.appendChild(tr);

        return;
    }


    // Display rows
    data.forEach(function (row, index) {

        console.log(
            `[DISPLAY] Row ${index + 1}:`,
            row
        );

        const tr =
            document.createElement("tr");

        tr.innerHTML = `
            <td>${row.core_code ?? ""}</td>
            <td>${row.core_part_no ?? ""}</td>
            <td>${row.assy_code ?? ""}</td>
            <td>${row.assy_line ?? ""}</td>
            <td>${row.nb_pd ?? ""}</td>

            <td>
                <button
                    type="button"
                    class="pass-btn"
                    data-core-code="${row.core_code}">
                    Pass
                </button>
            </td>
        `;

        tableBody.appendChild(tr);
    });


    console.log(
        "[DISPLAY] Table rendered"
    );


    // ========================================
    // Pass buttons
    // ========================================

    const buttons =
        document.querySelectorAll(".pass-btn");

    console.log(
        "[DISPLAY] Pass buttons:",
        buttons.length
    );


    buttons.forEach(function (button) {

        button.addEventListener(
            "click",
            function () {

                const coreCode =
                    this.getAttribute(
                        "data-core-code"
                    );

                console.log("--------------------------------");
                console.log("[PASS] Button clicked");
                console.log("[PASS] Core code:", coreCode);
                console.log("[PASS] Date:", selectedDate);

                updateDatabase(
                    coreCode,
                    selectedDate,
                    this
                );
            }
        );
    });
}


// ========================================
// Update database
// ========================================

function updateDatabase(
    coreCode,
    selectedDate,
    button
) {

    console.log("[UPDATE] Start");
    console.log("[UPDATE] Core code:", coreCode);

    button.disabled = true;
    button.textContent = "Updating...";

    const xhr =
        new XMLHttpRequest();

    const url =
        "../server/helium_update.php";

    console.log(
        "[UPDATE] POST:",
        url
    );


    xhr.open(
        "POST",
        url,
        true
    );


    xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );


    xhr.onloadstart = function () {

        console.log(
            "[UPDATE] Request started"
        );

    };


    xhr.onload = function () {

        console.log(
            "[UPDATE] Response received"
        );

        console.log(
            "[UPDATE] HTTP Status:",
            xhr.status
        );

        console.log(
            "[UPDATE] Raw response:",
            xhr.responseText
        );


        if (xhr.status === 200) {

            console.log(
                "[UPDATE] SUCCESS"
            );

            statusText.textContent =
                `Core ${coreCode} updated successfully.`;


            console.log(
                "[UPDATE] Reloading table..."
            );

            loadData(selectedDate);

        } else {

            console.error(
                "[UPDATE] FAILED"
            );

            console.error(
                "[UPDATE] Response:",
                xhr.responseText
            );

            statusText.textContent =
                "Error updating status.";

            button.disabled = false;

            button.textContent =
                "Pass";
        }
    };


    xhr.onerror = function () {

        console.error(
            "[UPDATE] Network error"
        );

        statusText.textContent =
            "Cannot connect to server.";

        button.disabled = false;

        button.textContent =
            "Pass";
    };


    xhr.onloadend = function () {

        console.log(
            "[UPDATE] Request finished"
        );

    };


const requestData =
    "core_code=" + encodeURIComponent(coreCode) +
    "&date=" + encodeURIComponent(selectedDate);

    console.log(
        "[UPDATE] Sending:",
        requestData
    );


    xhr.send(requestData);
}
</script>