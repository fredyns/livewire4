import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const SOURCE_URL = 'https://lucide.dev/icons/categories';
const DATA_URL = 'https://lucide.dev/assets/icons_categories.md.CNP_33RY.lean.js';

async function fetchText(url) {
  const res = await fetch(url);
  if (!res.ok) {
    throw new Error(`Failed to fetch ${url}: ${res.status} ${res.statusText}`);
  }
  return await res.text();
}

function extractVitepressJson(leanJs) {
  const startMarker = "const V=JSON.parse('";
  const start = leanJs.indexOf(startMarker);
  if (start < 0) {
    throw new Error('Could not find categories JSON start marker');
  }

  const afterStart = start + startMarker.length;
  const end = leanJs.indexOf("')", afterStart);
  if (end < 0) {
    throw new Error('Could not find categories JSON end marker');
  }

  const jsonStr = leanJs.slice(afterStart, end);
  return JSON.parse(jsonStr);
}

function buildCategoryMap(categories) {
  const byName = new Map();
  for (const c of categories) {
    byName.set(c.name, { title: c.title, icons: [] });
  }
  return byName;
}

function wrapInlineCodeList(icons, maxLineLength = 110) {
  const lines = [];
  let current = '';

  for (const icon of icons) {
    const token = `\`${icon}\`, `;
    if ((current + token).length > maxLineLength) {
      lines.push(current.trim().replace(/,\s*$/, ''));
      current = '';
    }
    current += token;
  }

  if (current.trim()) {
    lines.push(current.trim().replace(/,\s*$/, ''));
  }

  return lines;
}

function buildMarkdown({ categories, iconCategories }) {
  const byCat = buildCategoryMap(categories);

  for (const [icon, cats] of Object.entries(iconCategories)) {
    for (const cat of cats) {
      const entry = byCat.get(cat);
      if (entry) entry.icons.push(icon);
    }
  }

  for (const entry of byCat.values()) {
    entry.icons = Array.from(new Set(entry.icons)).sort((a, b) => a.localeCompare(b));
  }

  let md = '# Lucide Icons\n\n';
  md += `source: ${SOURCE_URL}\n\n`;

  for (const c of categories) {
    const entry = byCat.get(c.name);
    md += `## ${entry.title} (${entry.icons.length})\n\n`;
    for (const line of wrapInlineCodeList(entry.icons)) {
      md += `${line}\n`;
    }
    md += '\n';
  }

  return md;
}

async function main() {
  const repoRoot = path.resolve(__dirname, '..');
  const outputPath = path.join(repoRoot, 'code-samples', 'lucide', 'icons.md');

  const leanJs = await fetchText(DATA_URL);
  const data = extractVitepressJson(leanJs);

  const md = buildMarkdown(data);
  fs.writeFileSync(outputPath, md, 'utf8');
}

main().catch((err) => {
  console.error(err);
  process.exitCode = 1;
});
