'use strict';

const fs = require('node:fs');
const path = require('node:path');
const config = require('../config');
const sourceCache = new Map();
const UI_VERSION = '2026092306';

function escapeHtml(value) {
  return String(value ?? '')
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');
}

function readSource(relativePath) {
  const normalized = relativePath.replaceAll('\\', '/');
  if (!sourceCache.has(normalized)) {
    sourceCache.set(normalized, fs.readFileSync(path.join(config.rootDir, normalized), 'utf8'));
  }
  return sourceCache.get(normalized);
}

function resolveIncludes(source, sourcePath) {
  return source.replace(/<\?php\s+include\s*\(\s*(['"])(.*?)\1\s*\)\s*;?\s*\?>/gi, (_all, _quote, includePath) => {
    if (includePath.replaceAll('\\', '/').includes('/server/')) return '';
    const absolute = path.resolve(config.rootDir, path.dirname(sourcePath), includePath.replaceAll('\\', '/'));
    if (!absolute.startsWith(config.rootDir) || !fs.existsSync(absolute)) return '';
    return fs.readFileSync(absolute, 'utf8');
  });
}

function valueFromExpression(expression, context) {
  const htmlVar = expression.match(/^htmlspecialchars\(\$(\w+)\)$/);
  if (htmlVar) return escapeHtml(context[htmlVar[1]]);
  const selected = expression.match(/^\$(\w+)\s*==\s*['"]([^'"]*)['"]\s*\?\s*['"]selected['"]\s*:\s*['"]['"]$/);
  if (selected) return String(context[selected[1]] ?? '') === selected[2] ? 'selected' : '';
  const variable = expression.match(/^\$(\w+)$/);
  if (variable) return escapeHtml(context[variable[1]]);
  return '';
}

function renderLegacyPage(relativePath, context = {}) {
  let html = resolveIncludes(readSource(relativePath), relativePath);
  html = html.replace(/(href=["'][^"']*style\.css)(["'])/gi, `$1?v=${UI_VERSION}$2`);
  html = html.replace(/<\?=\s*([\s\S]*?)\s*\?>/g, (_all, expression) => valueFromExpression(expression.trim(), context));
  html = html.replace(/<\?php\s+foreach\s*\(\$(\w+)\s+as\s+\$(\w+)\)\s*:\s*\?>\s*<td><\?php\s+echo\s+(?:round\()?\$\w+(?:,\s*2\))?\s*;\s*\?><\/td>\s*<\?php\s+endforeach\s*;\s*\?>/g,
    (_all, listName) => (context[listName] ?? []).map((value) => `<td>${escapeHtml(Number.isFinite(value) ? Math.round(value * 100) / 100 : value)}</td>`).join(''));
  html = html.replace(/<\?php\s+echo\s+json_encode\(\$(\w+)\)\s*;\s*\?>/g, (_all, name) => JSON.stringify(context[name] ?? []));
  html = html.replace(/<\?php\s+echo\s+\$(\w+)\s*;\s*\?>/g, (_all, name) => escapeHtml(context[name]));
  html = html.replace(/<\?php([\s\S]*?)\?>/g, (_all, code) => {
    if (context.rowsHtml && /\$result/.test(code) && /(fetch_assoc|num_rows)/.test(code)) return context.rowsHtml;
    return '';
  });
  return html;
}

function extractRowFields(relativePath) {
  const fields = [];
  const seen = new Set();
  const pattern = /\$row\s*\[\s*['"]([^'"]+)['"]\s*\]/g;
  for (const match of readSource(relativePath).matchAll(pattern)) {
    if (!seen.has(match[1])) {
      seen.add(match[1]);
      fields.push(match[1]);
    }
  }
  return fields;
}

function renderRows(relativePath, rows, explicitFields) {
  const fields = explicitFields || extractRowFields(relativePath);
  return rows.map((row) => {
    const alarm = Object.values(row).some((value) => value === 'Alarm' || value === 'NG');
    const style = alarm ? ' style="color:#CC181F"' : '';
    return `<tr${style}>${fields.map((field) => `<td>${escapeHtml(row[field])}</td>`).join('')}</tr>`;
  }).join('');
}

function today() {
  return new Intl.DateTimeFormat('en-CA', { timeZone: 'Asia/Bangkok' }).format(new Date());
}

module.exports = { escapeHtml, renderLegacyPage, renderRows, today };
