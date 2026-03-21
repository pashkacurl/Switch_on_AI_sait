# Master Plan

- Purpose: Единый master plan по проекту сайта и WordPress-реализации.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/13-detailed-decomposition.md`, `docs/11-prioritized-backlog.md`, `docs/seo/GEO-AND-AI-SEARCH-VISIBILITY.md`, `docs/design/VISUAL-PROBE-PLAN.md`

## Context

Проект — это сайт и будущая продуктовая экосистема `Switch On AI` на WordPress/VPS, где уже существует блог и должен появиться связанный маркетинговый контур с сильной конверсионной логикой.

## Goals

1. Собрать целостный сайт под бренд и текущий продукт.
2. Усилить доверие, ясность оффера и конверсию.
3. Связать сайт, блог и будущие продуктовые слои в одну систему.
4. Сохранить поддерживаемость WordPress-окружения.
5. Подготовить сайт не только к классическому SEO, но и к AI-search visibility / GEO.
6. До полной реализации собрать визуальный probe, чтобы можно было оценить направление глазами.

## Constraints

- WordPress остается базовой платформой.
- Блог и сайт должны жить как единая экосистема.
- Нет прямого доступа к продовой админке и VPS-конфигу в текущем репозитории.
- Нельзя принимать большие архитектурные решения, игнорируя editor workflow.

## V1 Scope

- Home
- Product / AI-контент-система
- How it works / methodology
- Cases / proof
- About / founder
- FAQ
- Blog integration layer
- Contact / Экскурсия flow
- Legal essentials
- GEO-ready entity + content layer for AI search visibility
- Visual probe of key pages before full production rollout

## Explicitly Out Of V1

- полнофункциональный личный кабинет;
- полноценный marketplace;
- широкий multi-offer homepage;
- сложный platform app outside WordPress.

## Key Hypotheses

- Основной сегмент v1 лучше конвертится через один главный оффер, а не через экосистему из 4-5 направлений.
- Более clean, rational visual direction даст больше доверия, чем heavy dark-tech.
- WordPress custom theme + lightweight structured content model достаточно для v1 без page builder bloat.
- GEO visibility будет расти не от “секретной AI-оптимизации”, а от сильного entity layer, answer-first content и честного proof.
- Visual probe before full build снизит риск неверного визуального направления и сократит количество дорогих переделок.

## Open Questions

- Какая продовая тема реально активна.
- Какие плагины реально используются.
- Какая аналитика уже настроена.
- Как выглядит фактический workflow редактора/владельца сайта.
- Есть ли уже Google Business Profile / Bing Webmaster / Search Console ownership and access.

## Quality Criteria

- ясный SoT;
- сайт строится вокруг воронки, а не вокруг хаотичных блоков;
- WordPress content model масштабируем;
- blog integration предусмотрена сразу;
- есть безопасный rollout plan для VPS;
- есть отдельный GEO/AI-search layer, встроенный в контент, технику и измеримость;
- есть визуальный probe, по которому можно оценить направление до полной сборки.

## Readiness Criteria

- утверждена структура v1;
- готовы page briefs и content requirements;
- определена WP architecture;
- понятны analytics/SEO/GEO/performance baselines;
- собран visual probe ключевых страниц;
- есть rollout checklist и QA checklist.

## Phases

1. Discovery and audit
2. Documentation cleanup
3. Market and competitor research
4. Strategy and sitemap
5. WordPress architecture and content model
6. GEO / entity / AI-search visibility planning
7. Visual probe / prototype review
8. Implementation planning
9. Page/component implementation
10. SEO/analytics/performance pass
11. Soft launch
12. Post-launch iteration
