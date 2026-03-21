# Docs Index

- Purpose: Главная карта документации проекта `Switch On AI`.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/START-HERE.md`, `docs/12-master-plan.md`, `docs/wordpress/WORDPRESS-AUDIT.md`

## 1. Start Here

- `docs/START-HERE.md` — быстрый вход в проект, текущий статус и ближайший next step.
- `docs/14-execution-status.md` — живой статус выполнения.
- `docs/10-decision-log.md` — журнал принятых решений.
- `docs/11-prioritized-backlog.md` — приоритизированный backlog.
- `docs/12-master-plan.md` — master plan проекта.
- `docs/13-detailed-decomposition.md` — детальная декомпозиция исполнения.

## 2. Audit And Strategy

- `docs/00-project-audit.md` — аудит проекта, кода, docs и гигиены.
- `docs/01-market-and-competitor-research.md` — исследование рынка, конкурентов и референсов.
- `docs/02-positioning-and-website-strategy.md` — позиционирование, message hierarchy, CTA hierarchy.
- `docs/03-sitemap-and-page-briefs.md` — sitemap, page briefs, navigation model.
- `docs/04-content-architecture.md` — content architecture и inventory.
- `docs/05-design-principles.md` — дизайн-принципы и системные правила.

## 3. Delivery And Ops

- `docs/06-technical-implementation-plan.md` — общий техплан.
- `docs/07-seo-analytics-cro-plan.md` — SEO, analytics, CRO и GEO.
- `docs/08-launch-roadmap.md` — roadmap запуска.
- `docs/09-open-questions.md` — список критичных открытых вопросов.
- `docs/PLANS.md` — сводка по планам и рабочим потокам.

## 4. Design Deliverables

- `docs/design/VISUAL-PROBE-PLAN.md` — как и в каком формате будет собран визуальный пробник сайта перед полной реализацией.

## 5. WordPress

- `docs/wordpress/WORDPRESS-AUDIT.md` — фактический аудит текущей WordPress-части.
- `docs/wordpress/WORDPRESS-ARCHITECTURE.md` — целевая WordPress-архитектура.
- `docs/wordpress/CONTENT-MODEL.md` — модель контента для WP.
- `docs/wordpress/THEME-STRUCTURE.md` — структура темы и правила развития.
- `docs/wordpress/PLUGIN-AUDIT.md` — что известно о плагинах, что надо подтвердить.
- `docs/wordpress/BLOG-SEO-STRUCTURE.md` — как блог должен работать в общей воронке.
- `docs/wordpress/VPS-DEPLOYMENT-AND-MAINTENANCE.md` — безопасный rollout и поддержка на VPS.

## 6. SEO And GEO

- `docs/seo/GEO-AND-AI-SEARCH-VISIBILITY.md` — отдельный рабочий план по AI-search visibility и GEO.

## 7. Reference Layers

- `iSite/` — библиотека исходных стратегических и брендовых материалов.
- `ВКЛЮЧИ ИИ/` — основной продуктовый, маркетинговый и контентный knowledge base.
- `wordpress-theme/` — фактическая текущая кастомная WP-тема.
- `style-previews/` — визуальные направления.
- `index.html` — legacy static prototype, не текущий source of truth по стратегии.
- `Документация/` — legacy planning layer; использовать только как reference, не как primary SoT.

## 8. Current Source Of Truth Matrix

| Layer | Current SoT |
|---|---|
| Business/brand synthesis | `docs/02-positioning-and-website-strategy.md` |
| Website structure | `docs/03-sitemap-and-page-briefs.md` |
| Design system direction | `style-previews/style-04-ranked-mix.html` + `docs/05-design-principles.md` |
| Visual approval layer | `docs/design/VISUAL-PROBE-PLAN.md` |
| Implementation plan | `docs/06-technical-implementation-plan.md` |
| SEO / GEO | `docs/07-seo-analytics-cro-plan.md` + `docs/seo/GEO-AND-AI-SEARCH-VISIBILITY.md` |
| WordPress architecture | `docs/wordpress/WORDPRESS-ARCHITECTURE.md` |
| Delivery status | `docs/14-execution-status.md` |

## 9. Legacy And Archive Policy

- `Документация/00_README.md` и `Документация/03_WordPress_техническая_реализация.md` считать deprecated.
- `Документация/01_Исследование_дизайна_сайтов.md` и `Документация/02_3D_визуалы_и_анимации.md` считать reference-only.
- `style-previews/style-01-dark-system.html`, `style-02-light-intelligence.html`, `style-03-hybrid-pulse.html` считать rejected explorations.
- Физическую миграцию legacy-слоя выполнять только после отдельной проверки ссылок и безопасного окна изменений.
