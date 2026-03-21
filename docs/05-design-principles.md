# Design Principles

- Purpose: Зафиксировать дизайн-системное направление сайта.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/02-positioning-and-website-strategy.md`, `style-previews/style-04-ranked-mix.html`

## Design Direction

Рабочая база: `style-previews/style-04-ranked-mix.html`.

Почему:

- документально это текущий approved direction;
- он лучше согласован с мартовской conversion-first стратегией;
- он достаточно чистый для доверия и достаточно современный для AI-категории.

`style-previews/style-05-conversion-blueprint.html` считать candidate для локальных заимствований по контрасту, CTA и hierarchy, но не новым approved base без отдельного подтверждения.

## Layout Principles

- Светлая или light-dominant основа для доверия.
- Четкий visual rhythm без тяжелого техно-шума.
- Hero должен объяснять ценность быстрее, чем впечатлять эффектами.
- Каждая секция должна вести к следующему смысловому шагу.

## Typography

- Primary direction: `Manrope` или близкая современная humanist sans.
- Accent heading option: `Space Grotesk` точечно, не как перегруженный футуризм.
- Заголовки крупные, но не кричащие.
- Body copy спокойно читаемый на мобильных.

## Color Logic

- Основа: светлый фон, тёмный текст, холодный синий акцент.
- Допустимы мягкие mint/amber highlights как вспомогательные.
- Нельзя возвращаться в January dark-tech как в основной стиль без переутверждения стратегии.

## Section Rhythm

- Hero
- JTBD / For whom
- Method / process
- What client gets
- Proof
- FAQ
- Final CTA

Каждая секция должна либо снимать тревогу, либо усиливать понимание, либо вести к действию.

## CTA Rules

- Один визуально доминирующий CTA на экран.
- Secondary CTA не должен спорить с primary.
- CTA copy максимально конкретный: не “оставить заявку”, а “записаться на экскурсию”.

## Trust Blocks

- числа только там, где они объяснимы;
- отзывы только с понятным контекстом роли;
- “как это работает” обязателен;
- founder presence нужен, но без культового самолюбования.

## Motion Principles

- Легкие reveal и stagger animations допустимы.
- Большой 3D и тяжелые сценические эффекты для v1 не приоритет.
- Motion должен помогать ритму, а не ухудшать LCP/INP.

## Mobile Priorities

- CTA виден без охоты.
- Шапка не должна быть перегружена.
- Cards и proof blocks не должны разваливаться в “портянку”.
- Блоки должны собираться в вертикальный narrative.

## Design Debt To Avoid

- лишняя dark-tech драматизация;
- generic SaaS шаблонность;
- многоуровневые CTA;
- анимации тяжелее смысла;
- декоративные секции без роли в воронке.
