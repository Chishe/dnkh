<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="core-packing.css?v=2026092401">
    <link rel="icon" href="../picture/Denso.png">
    <title>Denso | Pokayoke Core Packing Line 1</title>
</head>
<body data-packing-line="line-1">
    <?php include("..\partial\header.html") ?>

    <main class="packing-page">
        <header class="packing-heading">
            <div>
                <span class="packing-line">LINE 1</span>
                <h1>HELIUM LEAK TEST : POKAYOKE CORE PACKING</h1>
            </div>
            <span id="api-status" class="api-status" role="status" aria-live="polite">API ready</span>
        </header>

        <form id="scan-form" class="scan-panel" autocomplete="off">
            <label for="scan-input">KANBAN SCAN</label>
            <input id="scan-input" name="kanban" type="text" placeholder="Scan barcode and press Enter" autofocus required>
            <label for="machine-select">MACHINE</label>
            <select id="machine-select" name="mc">
                <option value="1">MC 1</option>
                <option value="2">MC 2</option>
                <option value="3">MC 3</option>
            </select>
            <button id="scan-submit" type="submit">Check</button>
        </form>

        <section class="packing-result" aria-label="Packing result">
            <div class="show-box">
                <div class="show-item">
                    <label for="part-no">PART NO</label>
                    <input type="text" id="part-no" class="show-text" readonly>
                </div>
                <div class="show-item">
                    <label for="judge">JUDGE</label>
                    <input type="text" id="judge" class="show-text" readonly>
                </div>
            </div>

            <div id="message" class="message waiting" role="status" aria-live="assertive">Waiting For Scan..</div>

            <form id="confirm-form" class="confirm-panel" hidden>
                <label for="select-date">PRODUCTION DATE</label>
                <input type="date" id="select-date" required>
                <button id="confirm-submit" type="submit">Confirm</button>
            </form>
        </section>
    </main>

    <script src="core-packing-api.js?v=2026092401" defer></script>
</body>
</html>
