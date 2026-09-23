'use strict';

const test = require('node:test');
const assert = require('node:assert/strict');
const { escapeHtml, renderLegacyPage, renderRows } = require('../src/lib/html');

test('escapeHtml encodes user-controlled markup and quotes', () => {
  assert.equal(
    escapeHtml('<script>alert("x")</script> & \'quoted\''),
    '&lt;script&gt;alert(&quot;x&quot;)&lt;/script&gt; &amp; &#039;quoted&#039;'
  );
});

test('legacy form values are escaped before being placed into HTML', () => {
  const payload = '\"><img src=x onerror=alert(1)>';
  const html = renderLegacyPage('traceability/searching.php', { input_data: payload });
  assert.doesNotMatch(html, /<img src=x/);
  assert.match(html, /&lt;img src=x onerror=alert\(1\)&gt;/);
  assert.doesNotMatch(html, /<\?(?:php|=)/i);
});

test('legacy pages use a versioned shared stylesheet so deployed UI updates bypass stale browser caches', () => {
  const html = renderLegacyPage('traceability/searching.php');
  assert.match(html, /href=["']\.\.\/style\.css\?v=\d+["']/);
});

test('renderRows preserves alarm highlighting and escapes database values', () => {
  const html = renderRows(
    'trendcontrol/fin11_5d/history_mc.php',
    [{ Date: '2026-09-23', Time: '08:00:00', name_mc: '<b>unsafe</b>', pressure_max: 5, pressure_min: 1, pressure_actual: 7, status_state: 'Alarm' }],
    ['Date', 'Time', 'name_mc', 'pressure_actual', 'status_state']
  );
  assert.match(html, /color:#CC181F/);
  assert.match(html, /&lt;b&gt;unsafe&lt;\/b&gt;/);
  assert.doesNotMatch(html, /<b>unsafe<\/b>/);
});
