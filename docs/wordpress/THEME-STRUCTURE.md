# Theme Structure

- Purpose: Зафиксировать текущую и целевую структуру темы.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/wordpress/WORDPRESS-AUDIT.md`

## Current Structure

```
wordpress-theme/
  assets/js/main.js
  footer.php
  front-page.php
  functions.php
  header.php
  index.php
  style.css
  template-parts/section-*.php
```

## Current Strengths

- простая;
- быстро читается;
- мало слоев и абстракций;
- низкая техническая сложность.

## Current Weaknesses

- almost front-page only;
- no blog/page template coverage;
- no `template-parts/content/` layer;
- `functions.php` already mixes setup + customizer + helpers;
- hardcoded marketing data in sections.

## Recommended Target Structure

```
wordpress-theme/
  assets/
    css/
    js/
    images/
  inc/
    setup.php
    customizer.php
    helpers.php
  template-parts/
    sections/
    content/
    blog/
  page-templates/
  front-page.php
  page.php
  single.php
  home.php
  archive.php
  search.php
  404.php
  header.php
  footer.php
  functions.php
  style.css
```

## Rules

- global setup and helper logic move into `inc/`.
- section templates live in `template-parts/sections/`.
- post/page/archive rendering lives in `template-parts/content/` and `template-parts/blog/`.
- `functions.php` becomes a lightweight loader.

## Migration Principle

Не делать big-bang reorg.  
Сначала закрыть functional gaps, затем переносить в cleaner structure.
