# Visual Probe Plan

- Purpose: Зафиксировать формат и роль визуального `пробника` сайта перед полноценной сборкой.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/05-design-principles.md`, `docs/03-sitemap-and-page-briefs.md`, `docs/12-master-plan.md`

## What This Deliverable Is

После завершения исследования, стратегии, sitemap, content architecture и key page briefs должен быть собран отдельный визуальный `пробник` сайта.

Это не просто референс и не финальный продовый релиз. Это промежуточный, но уже осмысленный артефакт, который позволяет:

- визуально оценить направление сайта;
- проверить, как стратегия выглядит на реальных экранах;
- увидеть ритм страниц, иерархию и CTA-логику;
- скорректировать дизайн до полной WordPress-реализации;
- избежать дорогих переделок уже после глубокой сборки.

## Recommended Format

Рекомендуемый формат:

- high-fidelity interactive prototype;
- несколько ключевых страниц или длинных page flows;
- реальный текстовый каркас, а не lorem ipsum;
- визуально близко к будущему сайту, но без требования полной production readiness.

Для этого проекта базовый вариант такой:

1. отдельный preview layer для визуальной оценки;
2. минимум `Home`, `Product`, `How It Works`, `Proof`, `About`, `Contact / Excursion`;
3. общий header/footer/navigation rhythm;
4. mobile and desktop states для ключевых экранов.

## What The Probe Must Show

- hero and first-screen offer clarity;
- information hierarchy;
- section rhythm;
- proof and trust sequence;
- CTA hierarchy;
- typography and spacing system in action;
- founder/entity layer;
- GEO-ready answer-first blocks на ключевых страницах;
- связь маркетингового сайта с блогом.

## What The Probe Must Not Be

- просто красивая landing page без системной логики;
- generic AI SaaS template;
- pixel-perfect финальная разработка, если стратегия еще не утверждена;
- декоративный концепт без учета WordPress-реалистичности.

## Acceptance Criteria

- можно визуально понять, каким будет сайт;
- видно, как работает воронка;
- видно, где строится доверие;
- видно, как будет выглядеть основной CTA `Экскурсия`;
- видно, как блог и knowledge layer стыкуются с маркетинговыми страницами;
- есть минимум одна mobile-проверка;
- есть список замечаний после review и следующий iteration step.

## Delivery Sequence

1. Закрываем стратегию, sitemap и content model.
2. Собираем visual probe.
3. Проводим review.
4. Фиксируем corrections.
5. Только после этого масштабируем в полную WordPress-реализацию.

## Recommended Implementation Path

Предпочтительный путь для этого репозитория:

- сначала собрать визуальный probe в отдельном preview-слое;
- после согласования перенести решения в WordPress theme / reusable sections;
- не пытаться делать первый visual approval сразу через продовую сборку.

## Initial Scope

- `Home`
- `AI-контент-система`
- `Как это работает`
- `Proof / Cases`
- `About Pavel`
- `Экскурсия / Contact`

