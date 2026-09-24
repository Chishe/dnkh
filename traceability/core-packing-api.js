'use strict';

(() => {
    const line = document.body.dataset.packingLine;
    if (!['line-1', 'line-2'].includes(line)) return;

    const endpoints = {
        check: `/api/core-packing/${line}/check`,
        confirm: `/api/core-packing/${line}/confirm`
    };
    const elements = {
        scanForm: document.getElementById('scan-form'),
        scanInput: document.getElementById('scan-input'),
        machine: document.getElementById('machine-select'),
        scanButton: document.getElementById('scan-submit'),
        confirmForm: document.getElementById('confirm-form'),
        confirmButton: document.getElementById('confirm-submit'),
        date: document.getElementById('select-date'),
        partNo: document.getElementById('part-no'),
        judge: document.getElementById('judge'),
        message: document.getElementById('message'),
        apiStatus: document.getElementById('api-status')
    };
    let pendingConfirmation = null;
    let resetTimer = null;

    elements.date.value = new Intl.DateTimeFormat('en-CA').format(new Date());
    const machineFromUrl = new URLSearchParams(window.location.search).get('mc');
    if (['1', '2', '3'].includes(machineFromUrl)) elements.machine.value = machineFromUrl;

    function setState(text, state, statusText = '') {
        elements.message.textContent = text;
        elements.message.className = `message ${state}`;
        elements.apiStatus.textContent = statusText || `${line.toUpperCase()} · ${text}`;
    }

    function resetDisplay() {
        window.clearTimeout(resetTimer);
        pendingConfirmation = null;
        elements.partNo.value = '';
        elements.judge.value = '';
        elements.judge.classList.remove('ok', 'ng');
        elements.confirmForm.hidden = true;
        setState('Waiting For Scan..', 'waiting', `${line.toUpperCase()} · API ready`);
        elements.scanInput.focus();
    }

    function scheduleReset(delay) {
        window.clearTimeout(resetTimer);
        resetTimer = window.setTimeout(resetDisplay, Number(delay) || 10_000);
    }

    async function postJson(url, body) {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(body)
        });
        const payload = await response.json().catch(() => ({}));
        if (!response.ok) throw new Error(payload.error || `API returned ${response.status}`);
        return payload;
    }

    function renderResult(response) {
        if (!response?.data) throw new Error('API response has no data');
        const { kanban, judge, value, mc } = response.data;
        elements.partNo.value = kanban || '';
        elements.judge.value = judge || '';
        elements.judge.classList.toggle('ok', judge === 'OK');
        elements.judge.classList.toggle('ng', judge === 'NG');
        elements.confirmForm.hidden = true;
        pendingConfirmation = null;

        if (value === 'OK' || value === 'bypass') {
            setState('Ready to Package', 'success');
        } else if (value === 'spare') {
            setState('Assy Spare Part', 'success');
        } else if (value === 'NG') {
            setState('Defect Over', 'error');
        } else if (value === 'out-T') {
            setState('No Helium', 'error');
        } else if (value === 'out-W') {
            setState('No Data Water Test', 'error');
        } else if (value === 'out-D') {
            setState('No Record Found', 'error');
        } else if (value === 'water' || value === 'dg') {
            pendingConfirmation = { kanban, mc, type: value };
            elements.confirmForm.hidden = false;
            setState(value === 'water' ? 'Select NB Date' : 'Select Core Date', 'action');
            elements.date.focus();
            return;
        } else {
            setState('No Record Found', 'error');
        }
        scheduleReset(response.resetAfterMs);
        elements.scanInput.focus();
    }

    async function handleRequest(action) {
        window.clearTimeout(resetTimer);
        elements.scanButton.disabled = true;
        elements.confirmButton.disabled = true;
        setState('Searching ..', 'loading', `${line.toUpperCase()} · Requesting API`);
        try {
            const response = await action();
            renderResult(response);
        } catch (error) {
            elements.judge.value = 'ERROR';
            elements.judge.classList.remove('ok');
            elements.judge.classList.add('ng');
            elements.confirmForm.hidden = true;
            setState(error.message || 'System Data Error', 'error', `${line.toUpperCase()} · API error`);
            scheduleReset(10_000);
        } finally {
            elements.scanButton.disabled = false;
            elements.confirmButton.disabled = false;
            elements.scanInput.value = '';
        }
    }

    elements.scanForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const kanban = elements.scanInput.value.trim();
        if (!kanban) return elements.scanInput.focus();
        handleRequest(() => postJson(endpoints.check, {
            kanban,
            mc: Number(elements.machine.value)
        }));
    });

    elements.confirmForm.addEventListener('submit', (event) => {
        event.preventDefault();
        if (!pendingConfirmation) return;
        const request = { ...pendingConfirmation, nb_date: elements.date.value };
        handleRequest(() => postJson(endpoints.confirm, request));
    });

    resetDisplay();
})();
