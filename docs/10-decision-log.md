# Decision Log

- Purpose: Фиксация ключевых решений проекта.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/12-master-plan.md`, `docs/14-execution-status.md`

| Date | Decision | Why | Status |
|---|---|---|---|
| 2026-03-20 | Не использовать текущий live design как основной референс | Он не соответствует новой стратегии | approved |
| 2026-03-20 | Главный визуальный ориентир: Codearia-first structure, затем Avtograf energy | Нужен cleaner conversion-first direction | approved |
| 2026-03-20 | Для сайта использовать один основной CTA: `Экскурсия` | Снижаем перегруз и усиливаем конверсионную логику | approved |
| 2026-03-20 | `Разбор` оставить как отдельный social/link-hub сценарий | Это другой маршрут входа | approved |
| 2026-03-21 | Новый operating docs-layer создается в `docs/` | Нужен единый current source of truth | approved |
| 2026-03-21 | `wordpress-theme/` считать фактической кодовой базой WordPress, а не `Astra + Elementor` | Это подтверждается локальным кодом и `CLAUDE.md` | approved |
| 2026-03-21 | `style-04-ranked-mix.html` оставить базовым design SoT | Он уже закреплен в актуальном мартовском слое | approved |
| 2026-03-21 | `style-05-conversion-blueprint.html` считать candidate, а не approved | Он новее, но не формализован как выбранный | approved |
| 2026-03-21 | V1 сайта фокусируется на `AI-контент-системе` как primary offer | Экосистема слишком широка для главного входа | approved |
| 2026-03-21 | Крупную физическую миграцию legacy docs отложить до отдельного безопасного шага | Сначала нужен новый навигационный слой и link audit | approved |
| 2026-03-21 | Active theme copy must avoid unverified proof, vanity metrics and fake testimonials | Текущий proof base еще собирается, поэтому доверие строим через метод, прозрачность и реалистичные ожидания | approved |
| 2026-03-21 | Base WordPress template coverage should be completed before deeper page architecture work | Без `page/single/home/archive/search/404` покрытие темы остается хрупким и блокирует интеграцию блога и контента | approved |
| 2026-03-21 | Корень репозитория держать навигационным, а не файловой свалкой | Дубликаты PDF и media уже нормализованы в `iSite/`, поэтому в корне остаются только код, docs и явные reference layers | approved |
| 2026-03-21 | Visual probe переводим в dark-first направление | Светлый `style-06` не попал в ожидаемую атмосферу бренда; нужен более выразительный темный язык с плавными формами и меньшей “квадратностью” | approved |
| 2026-03-21 | `style-07-dark-fluid-probe.html` использовать как визуальную базу для live front page | Пользователь подтвердил, что этот dark-first язык уже попадает в нужное ощущение бренда, поэтому переносим его в `wordpress-theme/front-page.php` | approved |
