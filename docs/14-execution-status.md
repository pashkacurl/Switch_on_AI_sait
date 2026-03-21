# Execution Status

- Purpose: Живой статус проекта.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/12-master-plan.md`, `docs/10-decision-log.md`

## Current Phase

`Initial execution: WordPress theme stabilization + template coverage + GEO baseline planning + first visual probe`

## Done

- Проведен первый аудит структуры репозитория.
- Найдены и прочитаны основные инструкции, docs и WordPress-файлы.
- Выявлен конфликт между legacy docs и фактическим WordPress codebase.
- Создан новый `docs/` layer.
- Зафиксирован базовый SoT matrix.
- Сформирован первичный strategy synthesis.
- Проведено исследование рынка, конкурентов и референсов с учетом WordPress-реалистичности.
- Theme copy aligned with the approved v1 offer: `AI-контент-система` + single CTA `Экскурсия`.
- Из активной темы убраны неподтвержденные claims, placeholder stats и fake-style trust blocks.
- Добавлено базовое template coverage для `page`, `single`, `home`, `archive`, `search` и `404`.
- Улучшена фронтенд-устойчивость через safer anchor handling в `assets/js/main.js`.
- GEO/AI-search visibility вынесен в отдельный docs and planning layer.
- Собран первый visual probe как отдельный preview artifact для review.
- Корень репозитория очищен от дублирующихся PDF/media и пустого scaffold-слоя.
- Добавлены явные точки входа `README.md` и `.gitignore`, чтобы рабочая система проекта была навигационно понятной.
- Тематические подпапки `docs/` закреплены как часть постоянной структуры документации.
- На основе review собран новый dark-first visual probe как более точный кандидат по атмосфере и пластике.
- Новый dark-first visual probe перенесен в живую WordPress front page как первый production-facing вариант главной.

## In Progress

- Подтверждение production WordPress context: active theme, plugin stack, admin workflow и VPS deployment reality.
- Проектирование WordPress content model для переиспользуемых маркетинговых страниц и proof assets.
- Подготовка следующего implementation slice: `home / product / how-it-works / proof / about / contact`.
- Подготовка GEO baseline: entity layer, crawler/snippet controls, schema plan, AI-referral measurement.

## Blocked / Unknown

- Нет подтвержденного списка продовых плагинов.
- Нет доступа к фактической админке WordPress.
- Нет подтвержденного VPS deploy/backup workflow.
- Нет подтверждения, активна ли текущая кастомная тема на проде.
- Нет подтвержденного доступа к Search Console / Bing Webmaster / Google Business Profile.

## Next Best Step

Закрыть оставшиеся WordPress-context gaps, собрать feedback по visual probe и перейти к reusable content model плюс GEO-ready entity layer для v1 landing и proof pages.
