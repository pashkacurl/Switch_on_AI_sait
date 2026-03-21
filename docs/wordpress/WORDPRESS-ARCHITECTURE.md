# WordPress Architecture

- Purpose: Целевая WordPress-архитектура для сайта v1.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/wordpress/CONTENT-MODEL.md`, `docs/wordpress/THEME-STRUCTURE.md`

## Recommended Direction

Сохраняем WordPress и custom classic theme как основу.

Причины:

- уже есть кастомная тема;
- блог и маркетинг должны жить вместе;
- для v1 не нужен другой стек;
- WordPress дает редакторскую управляемость без лишней инфраструктуры.

## Architectural Principle

- presentation lives in theme;
- structured editable content lives in WordPress;
- future business/integration logic при росте можно вынести в lightweight custom plugin, но не раньше реальной необходимости.

## V1 Architecture Layers

### 1. Theme Layer

- layout
- templates
- reusable sections
- CSS/JS
- header/footer/navigation

### 2. Content Layer

- pages
- posts
- menu structures
- global settings / options
- later: cases and taxonomies

### 3. Integration Layer

- forms
- analytics
- SEO plugin
- redirects
- optional notifications

### 4. Ops Layer

- VPS
- backups
- cache
- updates
- rollback

## Recommended Theme Type

Classic custom theme, not full-site editing block theme.

Why:

- текущая codebase already classic;
- FSE migration сейчас даст больше турбулентности, чем пользы;
- для founder-led marketing site with custom reusable sections classic theme practical and stable.

## When To Add A Custom Plugin

Только если появится один из сценариев:

- growing business logic;
- custom integrations;
- cases CPT with custom admin workflows;
- lead routing;
- settings model that уже плохо живет в теме.

До этого theme-first implementation рациональнее.
