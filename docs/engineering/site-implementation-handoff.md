# Site Implementation Handoff — WordPress / Elementor v1

- Project: сайт «ВКЛЮЧИ ИИ»
- Audience: Виктор / implementation owner
- Purpose: handoff для сборки v1 без повторного ресёрча и без расползания scope
- Based on: `docs/06-technical-implementation-plan.md`, `docs/wordpress/WORDPRESS-AUDIT.md`, `docs/wordpress/WORDPRESS-ARCHITECTURE.md`, `docs/03-sitemap-and-page-briefs.md`, `docs/research/repo-audit.md`, plus `docs/wordpress/CONTENT-MODEL.md`, `docs/wordpress/THEME-STRUCTURE.md`, `docs/10-decision-log.md`
- Last updated: 2026-03-29

---

## 1. Executive summary

### Что собираем

В v1 собираем **конверсионный WordPress-сайт вокруг одного главного оффера**: **AI-контент-система**.

### На чём собираем

- CMS: **WordPress**
- editor/building layer: **Elementor** для редактируемых маркетинговых страниц
- base code layer: **existing custom classic theme** как системная основа для header/footer/blog templates/helpers
- blog lives in the same WP instance

### Что НЕ делаем в v1

Не пытаемся сразу собирать всю экосистему (`club`, `academy`, `lab`, `tech`) как полноценные продающие направления. Это либо future pages, либо secondary links, либо “скоро”.

### Главный принцип

V1 = **рабочий сайт, не концепт**:
- понятная структура;
- один основной CTA: **Экскурсия**;
- связка marketing pages + blog;
- редактируемый контент;
- без фейковых доказательств и неподтвержденных обещаний.

---

## 2. Implementation assumptions

Ниже — рабочие допущения, чтобы не стопорить сборку.

1. **WordPress остаётся основной платформой.** Это закреплено в docs.
2. **Classic custom theme остаётся базой**, не переезжаем в FSE.
3. **Elementor используется как page-building layer**, а не как новая архитектурная истина.
4. **Блог и маркетинговые страницы живут в одном WP-контуре.**
5. **Главный CTA по сайту — `Экскурсия`.**
6. **Контент должен быть редактируем через админку.** Хардкод допустим только для layout/helpers, не для ключевого copy.
7. **Proof строится через метод, прозрачность и артефакты**, а не через агрессивные цифры, fake testimonials или неподтвержденные кейсы.

---

## 3. Scope v1: какие страницы и шаблоны собирать

## 3.1. Pages to launch in v1

Собираем следующие страницы:

1. **Home**
2. **AI Content System** (`/ai-content-system/` или эквивалентный slug)
3. **How It Works**
4. **Cases / Proof**
5. **About Pavel**
6. **Blog index**
7. **Single blog post template**
8. **FAQ**
9. **Contact / Book Excursion**
10. **Privacy Policy**
11. **Offer / Terms**
12. **Social landing / page-prokladka** — отдельная страница входа из соцсетей

### Не включаем как полноценные v1 продающие страницы

- Club
- AI Sales / Automation
- Solutions by segment
- Industry pages
- Comparison pages
- Resources hub

Их можно оставить в backlog или как soft links, но не как обязательную часть первой сборки.

---

## 3.2. Template set required for v1

Нужен не только front page, а полное минимально рабочее покрытие темы:

### Required WP templates

- `front-page.php` — Home
- `page.php` — default static pages fallback
- `single.php` — single post
- `home.php` — blog index / posts page
- `archive.php` — category/tag/date archives
- `search.php` — search results
- `404.php` — not found
- `header.php`
- `footer.php`

### Preferred Elementor usage

- Home — Elementor page
- Product — Elementor page
- How It Works — Elementor page
- Cases / Proof — Elementor page
- About Pavel — Elementor page
- FAQ — Elementor page
- Contact / Excursion — Elementor page
- Social landing / prokladka — Elementor page

### Theme responsibility

Theme should own:
- global header/footer;
- typography/token layer;
- blog templates;
- utility classes/helpers;
- optional reusable shortcodes/helpers for CTA, proof disclaimer, breadcrumbs;
- performance-safe base styling.

Elementor should own:
- page composition for marketing pages;
- repeatable visual sections on static pages;
- content editing convenience.

---

## 4. Reusable sections / components required

Ниже — список reusable blocks, которые стоит собрать один раз и использовать на разных страницах.

## 4.1. Global reusable sections

### 1. Hero block
Use on:
- Home
- Product
- How It Works
- About
- Contact
- Social landing

Fields:
- eyebrow
- H1
- lead
- primary CTA
- secondary CTA
- optional trust chips / tags
- optional visual media

### 2. Problem / pain block
Use on:
- Home
- Product
- Social landing

Fields:
- section title
- 3–4 pain cards
- optional short intro

### 3. Audience fit block (`Для кого / не для кого`)
Use on:
- Home
- Product
- Social landing

Fields:
- title
- ideal audience list
- non-fit list

### 4. How it works / process steps
Use on:
- Home
- Product
- How It Works

Fields:
- section title
- 3–5 steps
- each step: number, title, description, optional icon

### 5. Deliverables / what client gets
Use on:
- Product
- Home

Fields:
- title
- cards list
- optional ownership/economics note

### 6. Proof / trust block
Use on:
- Home
- Product
- Cases
- About

Fields:
- title
- proof cards
- artifact image/screenshots
- short caption
- disclaimer text

### 7. Economics / comparison block
Use on:
- Product
- Cases
- FAQ

Fields:
- section title
- 2-column comparison
- optional cost table
- disclaimer/notes

### 8. FAQ accordion
Use on:
- Home
- Product
- FAQ
- Contact

Fields:
- question
- answer
- optional category

### 9. Founder block
Use on:
- Home
- About
- Product

Fields:
- portrait
- short bio
- positioning paragraph
- founder facts / principles
- CTA

### 10. Final CTA block
Use on:
- all money pages

Fields:
- headline
- supporting text
- CTA button
- secondary route (blog / Telegram)
- optional trust note

### 11. Blog teaser block
Use on:
- Home
- Product
- About

Fields:
- title
- selected/latest posts
- CTA to blog

### 12. Legal / disclaimer micro-block
Use on:
- Cases
- Product
- FAQ

Fields:
- proof disclaimer
- offer note
- data freshness note

---

## 4.2. Reusable micro-components

Нужны как отдельные patterns/components:

- primary button (`Экскурсия`)
- secondary button (`Изучить блог`, `Написать в Telegram`)
- chips/tag row
- metric card
- proof artifact card
- quote/founder note card
- comparison row/table
- social icon list
- breadcrumb strip for blog/templates
- related posts cards
- empty state / no posts state
- contact card
- inline CTA card inside blog content

---

## 5. Data model: CPT / ACF / options / forms / integrations

## 5.1. Minimum content model for v1

### Native WP entities

- `page` — all core marketing pages
- `post` — blog
- `category` — blog categories
- `tag` — blog tags

### V1 recommendation on CPT

**Do not introduce CPT unless needed on day one.**

For v1:
- `Cases / Proof` can remain **one structured page** with repeatable proof sections.

### CPT later (not mandatory in v1)

- `case` CPT — only when proof library grows and needs archive/filter/admin workflow.

So for v1:
- **No mandatory custom CPTs**.
- Keep structure simple.

---

## 5.2. ACF recommendation

Для WordPress/Elementor handoff оптимально использовать **ACF for structured data** в двух местах:

### A. Global options page

Нужно вынести в global options:
- primary CTA label
- primary CTA URL
- secondary CTA label
- secondary CTA URL
- Telegram URL / username
- phone
- email
- company legal data
- privacy page link
- offer/terms page link
- global proof disclaimer
- global form success text
- social links

### B. Structured repeaters for high-risk editable content

ACF полезен там, где не хочется полагаться на хаотичный Elementor input:
- FAQ items
- proof cards/artifacts
- founder facts
- contact cards
- reusable CTA settings
- social landing cards

### C. Optional page-level fields

Если Виктору удобнее hybrid-модель, можно добавить page-level ACF:
- hero eyebrow
- hero lead
- hero media
- page-specific proof disclaimer override
- show/hide final CTA

Но не нужно превращать весь сайт в ACF-конструктор. Для большинства page layouts Elementor достаточно.

---

## 5.3. Forms needed

### Main form: Book Excursion

Primary conversion form should live on:
- Home
- Product
- Contact / Excursion
- possibly social landing

Fields:
- Name
- Contact method (phone / Telegram / email)
- Business / niche
- Current situation / content challenge
- Optional checkbox: “Хочу показать текущий сайт/канал”
- Consent checkbox

### Optional short form

For warm/social traffic:
- Name
- Telegram / phone
- Short question
- Consent checkbox

### Form plugin options

Prefer one of:
- Elementor Form
- Fluent Forms
- Gravity Forms
- Contact Form 7 only if already active and unavoidable

Recommendation:
- **Prefer Elementor Form or Fluent Forms** for clean v1.
- Avoid adding multiple competing forms plugins.

---

## 5.4. Form actions / lead routing

At minimum after submit:
- store submission;
- email notification to owner;
- Telegram notification to ops channel / Pavel;
- thank-you message or redirect to thank-you state;
- analytics events fire.

### Required events

- `form_start`
- `form_submit`
- `click_excursion`
- `click_secondary_cta`
- optional `click_telegram`
- optional `view_social_landing`

---

## 5.5. Integrations needed in v1

### Required

1. **Analytics**
   - GA4 and/or Яндекс.Метрика
   - preferably via GTM or centralized injection layer

2. **Lead notifications**
   - email
   - Telegram notification

3. **SEO plugin**
   - Yoast or Rank Math
   - one plugin only

4. **Caching / performance plugin**
   - one lightweight cache layer

### Optional but useful

- anti-spam for forms
- SMTP plugin
- redirect manager
- cookie consent if legally needed

### Not required in v1

- CRM deep integration
- advanced lead scoring
- bot routing logic inside WP
- heavy personalization

---

## 6. How to implement the social landing / page-prokladka

Речь про страницу входа из Telegram/соцсетей, где трафик приходит “не в лоб на сайт”, а в короткую прокладку.

## 6.1. Role of the page

Страница-прокладка нужна как **bridge page**:
- для тёплого social traffic;
- для людей, которые знают Павла по Telegram / выступлениям / коротким видео;
- для быстрого выбора следующего маршрута.

Это **не мини-клон главной** и не link-in-bio свалка.

## 6.2. Primary goal

Дать человеку за 10–20 секунд выбрать один понятный путь:
- записаться на Экскурсию;
- посмотреть, как работает система;
- изучить блог;
- написать в Telegram.

## 6.3. Recommended structure

### Block 1. Compact hero
- short headline
- one-paragraph context
- founder visual or simple graphic
- primary CTA: `Экскурсия`

### Block 2. “С чего начать” choices
3–4 cards max:
- Хочу понять продукт
- Хочу посмотреть, как это работает
- Хочу сначала почитать статьи
- Хочу написать напрямую

### Block 3. Trust strip
- short facts
- no vanity metrics
- e.g. “показываю систему изнутри”, “без магии и black box”, “сайт + блог + контент как одна система”

### Block 4. Mini proof
- 1–2 artifact screenshots / proof cards
- short caption

### Block 5. Final CTA
- `Записаться на экскурсию`
- secondary: Telegram

## 6.4. Implementation notes

- Build as separate WP page, likely Elementor template.
- Keep it lightweight and shorter than Home.
- Add UTM-aware analytics capture.
- If link-in-bio style is needed, do it with **curated cards**, not generic link list.
- For social traffic, above-the-fold must fit mobile first.

## 6.5. URLs

Possible slugs:
- `/start/`
- `/go/`
- `/from-telegram/`
- `/hello/`

Recommendation: use one neutral slug, e.g. `/start/`.

---

## 7. What to take from current `wordpress-theme`, and what not to take

## 7.1. What to keep / reuse

Из текущей темы стоит брать:

### A. Platform base
- classic theme basis
- `functions.php` logic as starting point
- menu registration
- theme supports
- basic helper approach

### B. Global layout shell
- `header.php`
- `footer.php`
- container/grid/layout patterns
- blog query logic patterns from front page (as reference only)

### C. Dark-first visual direction
Берём направление, не literal copy:
- dark-first atmosphere;
- fluid system feel;
- AI-tech accent language;
- calmer high-trust aesthetic vs noisy “AI neon circus”.

### D. Existing section logic as references
Use as references for:
- hero rhythm
- proof section intent
- founder section intent
- blog teaser intent
- CTA section intent

### E. Helper extraction direction
По docs правильно двигаться к:
- `inc/setup.php`
- `inc/helpers.php`
- `inc/customizer.php` or settings layer

---

## 7.2. What NOT to reuse directly

### A. Do not reuse hardcoded copy from current front page
Current `front-page.php` is clearly a **visual probe / concept layer**, not production copy. It contains meta-language like:
- “Dark-first live front page”
- “темная сценография системы”
- references to design intent rather than real user messaging

This should not go live as final website copy.

### B. Do not reuse unverified proof / generic placeholders
Per docs and decision log:
- remove vanity metrics;
- remove fake testimonials;
- remove placeholder anchors/links;
- remove generic “proof layer” copy that doesn’t map to real artifacts.

### C. Do not keep key marketing copy in PHP templates
All high-value content must move out of hardcoded section files into editable content.

### D. Do not inherit front-page-only architecture
Current theme is too front-page-centric. Do not build v1 as “one pretty landing + broken rest of WordPress”.

### E. Do not copy old README assumptions blindly
Theme README mentions old design system and legacy sections that conflict with the current docs-layer.

---

## 8. Recommended build architecture for Viktor

## 8.1. Hybrid model

Best practical implementation:

### Theme layer
Owns:
- technical skeleton;
- templates;
- header/footer;
- blog templates;
- helper functions;
- performance-safe CSS foundation;
- optional custom post hooks/helpers.

### Elementor layer
Owns:
- marketing page composition;
- reusable page sections;
- mobile layouts for sales pages;
- editor-friendly page updates.

### ACF/options layer
Owns:
- global settings;
- structured repeatable content where admin predictability matters.

This gives flexibility without rebuilding the site into pure custom code or pure Elementor chaos.

---

## 8.2. Suggested theme folder end-state

Target structure:

```text
wordpress-theme/
  assets/
    css/
    js/
    images/
  inc/
    setup.php
    helpers.php
    options.php
    analytics.php
  template-parts/
    content/
    blog/
    partials/
  page-templates/
  front-page.php
  page.php
  single.php
  home.php
  archive.php
  search.php
  404.php
  header.php
  footer.php
  functions.php
  style.css
```

No big-bang reorg required on day one, but Viktor should not deepen the current flat/hardcoded structure.

---

## 9. Build order / implementation sequence

## Phase 0. Foundation and cleanup

1. Confirm active theme strategy.
2. Install/confirm required plugins:
   - Elementor
   - ACF
   - SEO plugin
   - forms plugin if needed
   - cache plugin
   - SMTP/notification if needed
3. Remove ambiguity around duplicate solutions.
4. Set menus, permalinks, reading settings, blog page.
5. Prepare global options.

### Output
Working WP foundation without architectural contradictions.

---

## Phase 1. Base theme coverage

1. Complete template coverage:
   - `page.php`
   - `single.php`
   - `home.php`
   - `archive.php`
   - `search.php`
   - `404.php`
2. Clean header/footer/nav logic.
3. Add baseline blog styles and content rendering.
4. Add breadcrumb / related posts / inline CTA support if planned.

### Output
WordPress no longer breaks outside front page.

---

## Phase 2. Global data and reusable systems

1. Create ACF options page.
2. Add global fields.
3. Create FAQ/proof repeaters if chosen.
4. Create Elementor reusable sections/templates.
5. Define button styles, CTA patterns, cards, accordions.

### Output
Reusable system for consistent page assembly.

---

## Phase 3. Marketing pages assembly

Build in this order:

1. **Home**
2. **AI Content System**
3. **How It Works**
4. **Contact / Excursion**
5. **Cases / Proof**
6. **About Pavel**
7. **FAQ**
8. **Social landing / prokladka**
9. **Privacy Policy**
10. **Offer / Terms**

### Why this order
- Home + Product + Contact create the shortest conversion path.
- How It Works removes skepticism.
- Cases/About/FAQ strengthen trust.
- Social landing is high-value but derivative once the core system exists.

---

## Phase 4. Blog integration

1. Configure posts page.
2. Ensure categories/tags/archives work.
3. Add inline CTA block in single posts.
4. Add related posts.
5. Connect blog teasers on Home/Product/About.

### Output
SEO/GEO content engine connected to conversion pages.

---

## Phase 5. Tracking, forms, QA

1. Add analytics events.
2. Wire form notifications.
3. QA mobile.
4. QA page speed.
5. QA basic technical SEO.
6. QA fallback/error states.

### Output
Launchable v1.

---

## 10. Risks and how to handle them

## Risk 1. Elementor sprawl

### Problem
If every page is built ad hoc in Elementor, v1 will become inconsistent and hard to maintain.

### Mitigation
- create reusable sections/templates first;
- define typography/buttons/cards once;
- keep layout tokens in theme/global settings.

---

## Risk 2. Hardcoded copy sneaks back in

### Problem
Current theme already has hardcoded marketing content. This makes future editing painful.

### Mitigation
- move key content to pages/options/ACF;
- PHP should render structure, not own the messaging.

---

## Risk 3. Front-page-first trap

### Problem
Beautiful home page, broken rest of site.

### Mitigation
- template coverage before deep page polish;
- blog templates treated as first-class deliverable.

---

## Risk 4. Scope creep from ecosystem ambitions

### Problem
Trying to publish all directions at once will dilute v1 and stall launch.

### Mitigation
- keep v1 focused on AI Content System;
- future directions marked as secondary/upcoming, not primary offer pages.

---

## Risk 5. Proof mismatch

### Problem
Overpromising with claims that are not yet operationally proven.

### Mitigation
- publish only verified artifacts;
- use disclaimers where needed;
- emphasize transparency, process and ownership.

---

## Risk 6. Plugin bloat

### Problem
Too many plugins will hurt performance and maintainability.

### Mitigation
- one SEO plugin;
- one forms plugin;
- one cache plugin;
- minimal utility plugins only.

---

## Risk 7. Blog disconnected from funnel

### Problem
Blog becomes standalone WordPress tail, not part of the trust/conversion system.

### Mitigation
- blog index and single template must link back to Product / FAQ / Excursion;
- inline CTA inside posts;
- related posts and breadcrumbs.

---

## Risk 8. Social landing becomes a link dump

### Problem
Page-prokladka can degrade into generic bio-links page.

### Mitigation
- keep one primary CTA;
- 3–4 curated routes max;
- mobile-first, short, branded.

---

## 11. Concrete implementation checklist for Viktor

## Must have before launch

- [ ] Complete WP template coverage
- [ ] Header/footer/navigation wired
- [ ] Home page built
- [ ] Product page built
- [ ] How It Works page built
- [ ] Contact / Excursion page built
- [ ] Cases / Proof page built
- [ ] About Pavel page built
- [ ] FAQ page built
- [ ] Blog index works
- [ ] Single post works
- [ ] Social landing page built
- [ ] Privacy Policy page published
- [ ] Offer / Terms page published
- [ ] Global options configured
- [ ] Main form works
- [ ] Form notifications work
- [ ] Analytics events added
- [ ] Mobile QA passed
- [ ] Placeholder/fake proof removed

## Nice to have, not blocking v1

- [ ] case CPT
- [ ] advanced filters on blog/cases
- [ ] deep CRM integration
- [ ] rich automation inside WP
- [ ] comparison pages
- [ ] industry pages

---

## 12. Final recommendation

Для Виктора правильная стратегия — **не переписывать проект и не спорить с уже принятыми решениями**, а собрать стабильный hybrid-v1:

- WordPress as platform;
- custom classic theme as system base;
- Elementor for editable marketing pages;
- ACF/options for structured global data;
- blog fully integrated into the same funnel;
- one main conversion route: **Экскурсия**.

If this is done cleanly, v1 will be:
- launchable;
- editable;
- trustworthy;
- extendable into cases/CPT/segment pages later without replatforming.

---

## 13. Bottom line for build owner

### Build now
- core pages
- full WP template coverage
- reusable sections
- forms + analytics
- social landing
- blog integration

### Delay
- extra product directions
- complex CPT architecture
- heavy integrations
- wow features that slow down launch

### Do not do
- ship hardcoded concept-copy from current front page
- ship fake proof
- ship a site where only the homepage works
- turn Elementor into uncontrolled layout soup
