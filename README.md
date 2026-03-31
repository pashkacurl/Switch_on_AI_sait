# Switch On AI / ВКЛЮЧИ ИИ

AI-контент-системы для предпринимателей и экспертов.
Сайт: https://switchonai.ru

## Quick Start

- Документация: [`docs/START-HERE.md`](docs/START-HERE.md)
- Карта документов: [`docs/INDEX.md`](docs/INDEX.md)
- Статус: [`docs/14-execution-status.md`](docs/14-execution-status.md)

## Structure

| Папка | Назначение |
|-------|-----------|
| `frontend/` | HTML-прототип главной (актуальный, светлый дизайн) |
| `wordpress-theme/` | Кастомная WP-тема (требует обновления под новый дизайн) |
| `docs/` | Вся актуальная документация (source of truth) |
| `n8n/` | Воркфлоу автоматизации контента |
| `iSite/` | Бренд-библиотека: стратегия, брендбук, медиа |
| `ВКЛЮЧИ ИИ/` | Маркетинговый knowledge base |
| `_archive/` | Архив: январский прототип, старые доки, style-previews |

## Tech Stack

- WordPress 6.9.4 on VPS
- Custom classic theme (vanilla CSS/JS)
- n8n → Airtable → WP REST API (content pipeline)
- Yoast SEO

## Design Direction

Light-first, conversion-focused, trust-building.
Palette: `#F5F6FA` / `#4BD392` / `#2F80ED`.
Fonts: Manrope + Inter.
