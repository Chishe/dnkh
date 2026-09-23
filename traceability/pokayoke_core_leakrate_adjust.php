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
    const dateInput = document.getElementById('selected_date');
    const searchForm = document.getElementById('adjust-search-form');
    const searchButton = document.getElementById('search');
    const statusMessage = document.getElementById('adjust-status');
    const tableBody = document.querySelector('#pokayoke tbody');

    dateInput.value = new Intl.DateTimeFormat('en-CA', {
        timeZone: 'Asia/Bangkok'
    }).format(new Date());

    function setStatus(message, tone = '') {
        statusMessage.textContent = message;
        statusMessage.dataset.tone = tone;
    }

    function appendCell(row, value) {
        const cell = document.createElement('td');
        cell.textContent = value ?? '';
        row.appendChild(cell);
    }

    function showEmpty(message) {
        tableBody.replaceChildren();
        const row = document.createElement('tr');
        row.className = 'adjust-empty-row';
        const cell = document.createElement('td');
        cell.colSpan = 6;
        cell.textContent = message;
        row.appendChild(cell);
        tableBody.appendChild(row);
    }

    function displayData(data, selectedDate) {
        tableBody.replaceChildren();
        if (!Array.isArray(data) || data.length === 0) {
            showEmpty('No pending records found for this date.');
            setStatus('Search complete — no pending records.', 'success');
            return;
        }

        data.forEach((record) => {
            const row = document.createElement('tr');
            appendCell(row, record.core_code);
            appendCell(row, record.core_part_no);
            appendCell(row, record.assy_code);
            appendCell(row, record.assy_line);
            appendCell(row, record.nb_pd);

            const actionCell = document.createElement('td');
            const passButton = document.createElement('button');
            passButton.type = 'button';
            passButton.className = 'pass-btn';
            passButton.textContent = 'Mark as pass';
            passButton.addEventListener('click', () => updateDatabase(record.core_code, selectedDate, passButton));
            actionCell.appendChild(passButton);
            row.appendChild(actionCell);
            tableBody.appendChild(row);
        });

        setStatus(`${data.length} pending record${data.length === 1 ? '' : 's'} found.`, 'success');
    }

    async function loadRecords() {
        const selectedDate = dateInput.value;
        searchButton.disabled = true;
        searchButton.textContent = 'Searching…';
        setStatus('Loading pending records…');

        try {
            const response = await fetch('../server/helium_adjust.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ date: selectedDate })
            });
            if (!response.ok) throw new Error('Unable to fetch pending records.');
            displayData(await response.json(), selectedDate);
        } catch (error) {
            showEmpty('Records could not be loaded. Please try again.');
            setStatus(error.message, 'error');
        } finally {
            searchButton.disabled = false;
            searchButton.textContent = 'Search pending records';
        }
    }

    async function updateDatabase(coreCode, selectedDate, button) {
        if (!window.confirm(`Mark core ${coreCode} as pass?`)) return;
        button.disabled = true;
        button.textContent = 'Updating…';
        setStatus(`Updating core ${coreCode}…`);

        try {
            const response = await fetch('../server/helium_update.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ core_code: coreCode, date: selectedDate })
            });
            if (!response.ok) throw new Error('The record could not be updated. It may already be processed.');
            setStatus(`Core ${coreCode} was marked as pass.`, 'success');
            await loadRecords();
        } catch (error) {
            button.disabled = false;
            button.textContent = 'Mark as pass';
            setStatus(error.message, 'error');
        }
    }

    searchForm.addEventListener('submit', (event) => {
        event.preventDefault();
        loadRecords();
    });
</script>
