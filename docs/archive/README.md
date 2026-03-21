# Archive README

- Purpose: Объяснить политику архивации проекта.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes

## What Counts As Archive

- устаревшие planning docs;
- отвергнутые design directions;
- неиспользуемые scaffolds;
- reference materials, которые не должны вести новые решения.

## What Is Already A Logical Archive

- `Документация/00_README.md`
- `Документация/01_Исследование_дизайна_сайтов.md`
- `Документация/02_3D_визуалы_и_анимации.md`
- `Документация/03_WordPress_техническая_реализация.md`
- `style-previews/style-01-dark-system.html`
- `style-previews/style-02-light-intelligence.html`
- `style-previews/style-03-hybrid-pulse.html`
- удаленный пустой `site-v2/` как noise scaffold

## Physical Migration Policy

Мы не делаем массовую физическую миграцию legacy-слоев без необходимости. Сначала новый `docs/` слой становится рабочим SoT, затем при необходимости выполняется точечная link-aware cleanup/migration.
