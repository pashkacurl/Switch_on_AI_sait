# GEO And AI Search Visibility

- Purpose: Отдельный рабочий документ по `GEO` (`Generative Engine Optimization`) и видимости сайта в AI-поиске.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/07-seo-analytics-cro-plan.md`, `docs/02-positioning-and-website-strategy.md`, `docs/wordpress/WORDPRESS-ARCHITECTURE.md`

## Working Definition

В этом проекте `GEO` означает не географическое SEO, а `Generative Engine Optimization`: как сайт попадает в AI-generated answers, цитаты, supporting links и grounding layers в Google AI features, ChatGPT search, Bing / Copilot и смежных AI-search surfaces.

## What Is Actually Confirmed By Official Sources

### Google

- Google прямо пишет, что для AI Overviews и AI Mode не требуется отдельная “AI-оптимизация” или специальная schema.
- Для участия в AI features страница должна быть проиндексирована и иметь право показываться со snippet в обычном Google Search.
- Технические основы все те же: crawlability, internal links, visible text content, page experience, корректная structured data.
- Google отдельно рекомендует держать в актуальном состоянии `Business Profile`, business details и official site signals.
- Ограничения на использование контента в AI features регулируются не “магией GEO”, а стандартными controls вроде `nosnippet`, `max-snippet`, `data-nosnippet`, `noindex` и связанными crawler controls.

### OpenAI / ChatGPT Search

- OpenAI указывает, что для доступности сайта в ChatGPT search важно не блокировать `OAI-SearchBot`.
- Также хостинг/CDN должен пропускать трафик с опубликованных OpenAI IP addresses.
- Referrals from ChatGPT search можно отслеживать через `utm_source=chatgpt.com`.
- Top placement не гарантируется; важны reliability, relevance и crawl access.

### Bing / Copilot

- По состоянию на `February 10, 2026`, Bing Webmaster Tools запустил public preview `AI Performance`, где видны citations, cited pages и grounding queries.
- Microsoft прямо связывает это с emerging `GEO` practice.
- Bing также подчеркивает важность clarity, structure, evidence, freshness and reduced ambiguity.
- Для более быстрого обновления контента в search/AI surfaces надо использовать `IndexNow`.

## Current Repo-Level Gap

По быстрому локальному аудиту именно в `wordpress-theme/` сейчас не видно явного слоя для:

- JSON-LD / schema markup;
- snippet / robots controls;
- GA4 / GTM integration;
- `IndexNow`;
- crawler-specific checks для `OAI-SearchBot`.

Это не доказывает, что этих механизмов нет на проде: они могут жить в SEO-плагине, mu-plugin, серверной конфигурации или внешнем tag manager. Но для GEO это означает, что текущий продовый стек надо подтвердить до внедрения дублирующей логики.

## What This Means For Our Project

### GEO is not a separate layer from SEO

Для нас GEO не заменяет SEO. Это надстройка над:

- сильной индексацией;
- entity clarity;
- структурированным контентом;
- прозрачными доказательствами;
- хорошей внутренней перелинковкой;
- стабильной WordPress-технической базой.

### GEO rewards citation-worthiness

Наша задача не просто “ранжироваться”, а стать удобным источником для цитирования и grounding.

Это особенно хорошо совпадает с текущей стратегией сайта:

- один четкий оффер;
- прозрачный метод;
- честная proof-логика;
- founder expertise;
- blog как knowledge engine.

## GEO Priorities For Switch On AI

## 1. Entity Layer

Нужно явно и последовательно описать:

- кто такой Павел Лещенко;
- что такое `ВКЛЮЧИ ИИ / Switch On AI`;
- что такое `AI-контент-система`;
- для кого она создана;
- чем отличается от “ведения контента”, “SMM”, “просто ChatGPT-промптов” и “агентства под ключ”.

## 2. Citation-Ready Core Pages

Ключевые страницы должны отвечать не только за конверсию, но и за цитируемость:

- `Home`
- `AI-контент-система`
- `Как это работает`
- `Cases / Proof`
- `About Pavel`
- ключевые статейные pillar pages

## 3. Answer-First Content

Нужны материалы, которые удобно цитировать:

- что такое AI-контент-система;
- кому она подходит / не подходит;
- из чего состоит;
- сколько стоит запуск и поддержка;
- чем отличается от найма SMM / маркетолога / агентства;
- какие ограничения и риски у AI-контента;
- как устроен workflow публикации;
- как измерять результат.

## 4. Proof Architecture

Для AI visibility особенно важны проверяемые claims:

- скриншоты процесса;
- схемы;
- примеры контент-цепочек;
- before/after по workflow;
- реальные числа с пояснением контекста;
- founder notes с first-hand experience.

## 5. Freshness And Update Rhythm

AI surfaces ценят не только “вечнозеленость”, но и актуальность. Поэтому нам нужен управляемый update loop:

- обновление money pages;
- обновление pillar posts;
- фиксирование last reviewed / last updated там, где это уместно;
- быстрая переиндексация после важных изменений.

## GEO Content Rules

- Давать короткий прямой ответ в верхней части страницы.
- Разбивать длинные темы на четкие question-shaped секции.
- Использовать списки, таблицы и сравнения там, где это реально упрощает извлечение смысла.
- Избегать пустых абстракций и hype language.
- Каждый важный claim по возможности подкреплять примером, цифрой или ограничением.
- Писать так, чтобы текст был полезен и человеку, и retriever/grounding system.

## GEO Technical Rules For WordPress

- Не блокировать важные страницы в robots.txt.
- Не ставить `nosnippet`/`max-snippet:0` на money pages, если хотим AI visibility.
- Проверить, что критичный контент доступен в HTML, а не спрятан только в JS-effects.
- Держать sitemap, canonical, indexation и internal links в чистоте.
- Включить `Organization` / при необходимости `LocalBusiness` schema.
- Добавить единообразные author/founder signals.
- Подготовить `IndexNow`.
- Проверить доступность `OAI-SearchBot` и отсутствие CDN/server blocks.

## GEO Analytics Rules

- Отдельно отслеживать AI referrals.
- Помечать изменения на страницах аннотациями в отчетности.
- Разделять brand / non-brand growth.
- Отдельно мерить visibility и conversion:
  - citations / appearances;
  - visits;
  - engaged visits;
  - assisted conversions;
  - direct excursion conversions.

## Immediate Tasks

1. Проверить crawler policy для `OAI-SearchBot`.
2. Проверить, не мешают ли robots/snippet rules участию в AI features.
3. Собрать entity consistency layer: site name, founder, organization, contact, social profiles.
4. Подготовить schema plan для `Organization`, `Person`, `Article`, `Breadcrumb`, при необходимости `LocalBusiness`.
5. Выделить 5-8 GEO-priority pages and posts.
6. Добавить answer-first blocks в key pages.
7. Настроить tracking для `utm_source=chatgpt.com`.
8. Подготовить `IndexNow` rollout path.
9. После подключения Bing Webmaster Tools включить monitoring по AI Performance.

## Anti-Patterns

- “Специальный GEO-текст” без пользы пользователю.
- Массовая генерация weak pages.
- Ложные proof claims.
- Schema spam.
- Несогласованность между страницами, метаданными и публичными профилями.
- Ставка только на traffic без measurement of qualified conversion.

## Recommended Position For This Project

Для `Switch On AI` сильнейшая GEO-стратегия — не “обмануть выдачу нейросетей”, а стать:

- четко определенной сущностью;
- прозрачным экспертом;
- источником структурированного, доказательного и свежего контента;
- удобной для цитирования knowledge base вокруг `AI-контент-систем`.

Это хорошо масштабируется в WordPress и не требует ломать текущую архитектуру.
