# Project Audit

- Purpose: Сводный аудит проекта, документации, кода и WordPress-части.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/PROJECT-STRUCTURE.md`, `docs/wordpress/WORDPRESS-AUDIT.md`

## Executive Summary

Проект уже содержит сильную стратегическую и продуктовую базу, но исторически был разорван между несколькими слоями: старый `Документация/`, knowledge base в `ВКЛЮЧИ ИИ/`, структурированная библиотека `iSite/`, legacy prototype в `index.html` и фактическая WordPress-тема в `wordpress-theme/`.

После второго прохода по репозиторию структура стала чище:

- актуальный рабочий контур зафиксирован в `docs/` и `wordpress-theme/`;
- корень перестал быть складом дублей брендовых PDF и media-файлов;
- пустой `site-v2/` убран как шумовой scaffold;
- добавлена корневая навигационная точка входа `README.md`;
- добавлен базовый `.gitignore` для IDE/OS-мусора.

## What Was Confirmed

### Strategy And Product

- Основной оффер v1: `AI-контент-система`.
- Основной CTA сайта: `Экскурсия`.
- Сайт должен продавать через маршрут `боль -> метод -> доказательства -> действие`.

### Design

- Базовое approved direction: `style-previews/style-04-ranked-mix.html`.
- `style-previews/style-05-conversion-blueprint.html` остается candidate.
- Первый осмысленный visual review artifact собран в `style-previews/style-06-v1-visual-probe.html`.

### WordPress

- Репозиторий содержит кастомную classic WordPress theme без page builder.
- Старый слой, где фигурирует `Astra + Elementor`, не соответствует фактическому коду.
- Текущий theme-layer уже начал получать базовое template coverage и более честный v1 copy layer.

## Hygiene Findings

### What Was Good

- Богатая база исходных материалов.
- Явный WordPress target вместо абстрактного frontend-only направления.
- Достаточно контекста для стратегии, sitemap и WordPress-first plan.

### What Was Wrong

- Не было единой точки входа в проект.
- Корень был засорен дублирующими PDF, изображениями и видео, которые уже лежали в `iSite/`.
- Пустой `site-v2/` создавал шум без полезной роли.
- Было несколько competing planning layers без явного SoT.

### What Was Fixed

- Создан рабочий docs-layer.
- Зафиксирован SoT matrix.
- Подтверждено, что `iSite/` — правильное место для брендовых и media-исходников.
- Подтвержденные дубли из корня удалены из верхнего уровня проекта.
- Появился root `README.md` как вход в репозиторий.

## Remaining Constraints

- Нельзя принимать большие архитектурные решения, игнорируя WordPress.
- Нужно учитывать существующий блог на той же WP-платформе.
- Локально все еще нет подтвержденного production plugin stack, admin workflow и VPS deployment reality.

## Audit Conclusion

На текущем этапе проект уже достаточно упорядочен, чтобы дальше двигаться без хаоса:

1. `docs/` — источник актуальных решений.
2. `wordpress-theme/` — основной кодовый слой.
3. `style-previews/style-06-v1-visual-probe.html` — первый визуальный review artifact.
4. `iSite/` и `ВКЛЮЧИ ИИ/` — structured source libraries.
