# Project Structure

- Purpose: Зафиксировать текущую структуру репозитория и роль каждого слоя.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/DOCUMENTATION-STRUCTURE.md`, `docs/00-project-audit.md`, `/README.md`

## Current Top-Level Structure

| Path | Role | Status |
|---|---|---|
| `README.md` | Корневая навигационная точка входа | active |
| `docs/` | Актуальный operating docs-layer проекта | active |
| `wordpress-theme/` | Кастомная WordPress-тема | active |
| `style-previews/` | Визуальные направления и visual probe artifacts | active reference |
| `iSite/` | Стратегия, бренд, бизнес-контекст и media library | source library |
| `ВКЛЮЧИ ИИ/` | Продуктовый, маркетинговый и контентный knowledge base | source library |
| `index.html` | Legacy static prototype | legacy reference |
| `Документация/` | Старый planning layer | legacy reference |
| `Действующий сайт/` | CSS backup legacy live-site слоя | legacy implementation reference |
| `CLAUDE.md` | Repo-level guidance | active reference |
| `WORDPRESS_GUIDE.md` | WordPress-specific reference guide | active reference |

## What Counts As Code

- `wordpress-theme/`
- `index.html`
- `style-previews/*.html`
- `Действующий сайт/main-style.css`

## What Counts As Current Working System

- `docs/`
- `wordpress-theme/`
- `style-previews/style-06-v1-visual-probe.html`

## What Counts As Knowledge Base

- `iSite/`
- `ВКЛЮЧИ ИИ/`
- `CLAUDE.md`
- `WORDPRESS_GUIDE.md`

## Root Hygiene Rules

- Корень репозитория не должен использоваться как склад для PDF, изображений и разовых артефактов.
- Брендовые PDF, бизнес-документы и медиа хранятся в `iSite/` по тематическим подпапкам.
- Новые рабочие документы создаются в `docs/`, а не в корне.
- Новые кодовые изменения живут в `wordpress-theme/` или в явном preview/reference слое.

## Legacy Policy

- `index.html` не считать текущим design SoT.
- `Документация/00_README.md` и `Документация/03_WordPress_техническая_реализация.md` не считать актуальным описанием стека.
- `style-previews/style-01-dark-system.html`, `style-02-light-intelligence.html`, `style-03-hybrid-pulse.html` считать early explorations.

## Structure Development Rule

- Сначала переводить знания и решения в `docs/`.
- Затем переносить реализацию в `wordpress-theme/`.
- Legacy-слои сохранять как reference, но не использовать как источник новых решений.
