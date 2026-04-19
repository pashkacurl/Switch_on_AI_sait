# SEO-аудит главной страницы: switchonai.com / switchonai.ru

- Аудитор: Лидия Родарте-Куайл (SEO-аналитик команды БАНДА)
- Дата: 2026-04-03
- Объект: главная страница + прототип `frontend/index.html`
- Контекст: лендинг AI-контент-системы Павла Лещенко, апрель 2026

---

## Общий вывод

Прототип `index.html` технически грамотен: хорошая структура заголовков, чистый HTML, нет render-blocking ресурсов. Основные проблемы лежат на уровне WordPress-продакшена, а не прототипа. Для нового сайта критично не воспроизвести баги старого: аналитика, security headers, schema, robots.txt должны быть настроены с нуля правильно.

Ниже — детальный разбор по семи блокам.

---

## 1. Что из старых рекомендаций актуально

Следующие рекомендации из предыдущих аудитов (FULL-AUDIT-REPORT.md, TECHNICAL-AUDIT-2026-03-31.md, ACTION-PLAN.md) сохраняют полную актуальность на апрель 2026:

### Технические основы

- Закрыть `xmlrpc.php` через nginx — уязвимость присутствует на проде.
- Добавить security headers (HSTS, X-Frame-Options, X-Content-Type-Options, Referrer-Policy, Permissions-Policy) — их нет до сих пор.
- Убрать `X-Powered-By: PHP/8.3.7` и `<meta name="generator" content="WordPress ...">`.
- Исправить `Disallow: *page` в robots.txt → заменить на `Disallow: /page/`.
- Убрать конфликт author-sitemap vs robots.txt.
- Заменить jQuery 1.7.1 (2011 год) на актуальную версию.

### On-page SEO

- На `/stati/` нет H1 и уникального мета-описания — не исправлено.
- На `/price/` title и description идентичны — не исправлено.
- На всех 170+ статьях мета-описания автогенерированы = title — не исправлено.
- Дублирующийся H1 в теме `webmastercpit` — баг темы, требует правки `single.php`.
- OG image (`og:image`) отсутствует на главной — критично для Telegram-дистрибуции.
- `meta keywords` со значением «Главная страница» — рудиментарный тег, нужно убрать.

### Schema markup

- Person и ProfessionalService schema на главную — не добавлены в прод. В прототипе `schema.json` и `schema-homepage.json` они прописаны корректно и готовы к внедрению.
- Organization schema — есть в `schema.json`, но не подключена в `<head>` `index.html`.

### Каннибализация контента

- 170+ статей в одной категории «Рубрика» — структура не выстроена.
- Группы дублей (ошибки AI, YouTube, Operator AI) требуют 301-редиректов.
- Непоследовательные URL (русский транслит + английские slug) — не стандартизировано.

### GEO / AI-search

- Нет `llms.txt` — файл так и не создан.
- Нет явных `Allow:` правил для GPTBot, ClaudeBot, PerplexityBot в robots.txt.
- Нет IndexNow — быстрая переиндексация для Bing/Copilot не настроена.
- Google Analytics не настроен через MonsterInsights.

---

## 2. Что устарело и нужно обновить (апрель 2026)

### 2.1 Домен: switchonai.ru vs switchonai.com

Все существующие SEO-документы написаны под `switchonai.ru`. Судя по прототипу `index.html` и общему направлению, возможна миграция или запуск под `.com`. Это требует немедленного решения до любого SEO-внедрения:

- Если запускаться на `switchonai.com` — все schema `@id`, canonical URL, robots.txt, sitemap, llms.txt пишутся под `.com`.
- Если `.ru` остаётся основным — прототип должен это отражать явно.
- При миграции: 301-редиректы с `.ru` на `.com` + обновление Search Console + уведомление Яндекс.

### 2.2 FAQPage schema в Google

По состоянию на апрель 2026 Google существенно сократил показ FAQPage rich results в SERP — они больше не дают аккордеон под результатом для большинства сайтов. FAQPage schema остаётся полезной для GEO (AI-цитирования), но ожидать rich snippet в Google Search не стоит. Не нужно приоритизировать FAQ schema ради SERP-эффекта.

### 2.3 HowTo schema

Аналогично — HowTo rich results также ограничены Google. Полезно для структуры, но не как основной инструмент роста CTR.

### 2.4 «AI.txt» и специальные GEO-файлы

Рекомендация создать `AI.txt` — устаревшая и не подкреплённая официальными источниками. Google прямо подтверждает: для AI Overviews и AI Mode никаких специальных файлов или разметки не требуется. `llms.txt` — разумный шаг для Perplexity и ChatGPT-экосистемы, но не как магический GEO-инструмент.

### 2.5 Bing AI Performance

С февраля 2026 Bing Webmaster Tools запустил public preview раздела «AI Performance» — показывает citations, grounding queries, cited pages. Это новый измеримый сигнал, которого не было в предыдущих аудитах. Нужно верифицировать сайт в Bing Webmaster Tools и подключить мониторинг.

### 2.6 Google AI Mode (весна 2026)

Google AI Mode расширяется — страницы теперь могут попадать в grounding links в AI Mode, не только в AI Overviews. Базовые требования те же: индексируемость, snippet-eligible, хороший контент. Никакой отдельной разметки не требуется.

### 2.7 Core Web Vitals: INP вместо FID

С марта 2024 Google окончательно заменил FID (First Input Delay) на INP (Interaction to Next Paint) как метрику отзывчивости. Все старые рекомендации, упоминающие FID, технически устарели. Актуальные три метрики CWV: LCP, CLS, INP.

---

## 3. Обновлённые требования: meta tags, schema, heading hierarchy

### 3.1 Meta tags для главной страницы

**Текущее состояние в `index.html`:**

```html
<title>ВКЛЮЧИ ИИ — AI-контент-системы для бизнеса | Павел Лещенко</title>
<meta name="description" content="Строим AI-контент-системы для предпринимателей и экспертов. Система вместо хаоса в контенте. Распаковка смыслов → стратегия → автоматизация → запуск.">
```

**Оценка title:** хороший. 60 символов, содержит бренд + ключевое словосочетание + имя автора. Не дублирует H1 (H1 = «Система вместо хаоса в контенте» — другой угол).

**Оценка description:** приемлемо, но можно усилить. Не содержит явный призыв к действию и не упоминает конкретный результат.

**Рекомендуемый вариант description:**
```
Павел Лещенко строит AI-контент-системы для предпринимателей и экспертов. Распаковка смыслов → стратегия → автоматизация. Запишитесь на бесплатную Экскурсию.
```
155 символов, содержит имя автора, ключевую фразу, последовательность и CTA.

**Что критически отсутствует в `<head>` index.html:**

```html
<!-- Open Graph — обязательно для Telegram и соцсетей -->
<meta property="og:type" content="website">
<meta property="og:title" content="ВКЛЮЧИ ИИ — AI-контент-системы для бизнеса | Павел Лещенко">
<meta property="og:description" content="Павел Лещенко строит AI-контент-системы для предпринимателей и экспертов. Распаковка смыслов → стратегия → автоматизация. Запишитесь на бесплатную Экскурсию.">
<meta property="og:image" content="https://switchonai.ru/wp-content/uploads/og-homepage.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="https://switchonai.ru/">
<meta property="og:locale" content="ru_RU">
<meta property="og:site_name" content="ВКЛЮЧИ ИИ">

<!-- Twitter/X Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="ВКЛЮЧИ ИИ — AI-контент-системы для бизнеса">
<meta name="twitter:description" content="Строим AI-контент-системы для предпринимателей и экспертов. Система вместо хаоса в контенте.">
<meta name="twitter:image" content="https://switchonai.ru/wp-content/uploads/og-homepage.jpg">

<!-- Canonical -->
<link rel="canonical" href="https://switchonai.ru/">

<!-- Robots -->
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
```

**OG image требования:** 1200×630 px, JPG, < 200 KB. Рекомендуется: портрет Павла + логотип + короткий слоган на светлом фоне в фирменной палитре (#F5F6FA + #4BD392).

### 3.2 Schema markup (JSON-LD) для главной

**Текущее состояние:** `schema.json` и `schema-homepage.json` содержат хорошо проработанные схемы. Проблема — они не подключены в `index.html`.

**Что нужно подключить в `<head>` прототипа:**

Объединить все типы в единый `@graph`. Итоговая schema для главной страницы:

```json
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "https://switchonai.ru/#website",
      "name": "ВКЛЮЧИ ИИ",
      "alternateName": "Switch On AI",
      "url": "https://switchonai.ru/",
      "description": "AI-контент-системы для предпринимателей и экспертов",
      "publisher": { "@id": "https://switchonai.ru/#person" },
      "inLanguage": "ru-RU",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "https://switchonai.ru/?s={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://switchonai.ru/#webpage",
      "url": "https://switchonai.ru/",
      "name": "ВКЛЮЧИ ИИ — AI-контент-системы для бизнеса | Павел Лещенко",
      "description": "Павел Лещенко строит AI-контент-системы для предпринимателей и экспертов.",
      "isPartOf": { "@id": "https://switchonai.ru/#website" },
      "inLanguage": "ru-RU",
      "breadcrumb": { "@id": "https://switchonai.ru/#breadcrumb" }
    },
    {
      "@type": "BreadcrumbList",
      "@id": "https://switchonai.ru/#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная",
          "item": "https://switchonai.ru/"
        }
      ]
    },
    {
      "@type": "Person",
      "@id": "https://switchonai.ru/#person",
      "name": "Павел Лещенко",
      "givenName": "Павел",
      "familyName": "Лещенко",
      "jobTitle": "Основатель, эксперт по AI-контент-системам",
      "description": "Строю AI-контент-системы для предпринимателей и экспертов. Принцип: сначала смыслы и стратегия, потом автоматизация.",
      "url": "https://switchonai.ru/",
      "image": {
        "@type": "ImageObject",
        "url": "https://switchonai.ru/wp-content/uploads/pavel-leshenko.jpg",
        "width": 400,
        "height": 400
      },
      "sameAs": [
        "https://t.me/Leshenko",
        "https://t.me/Switch_On_AI"
      ],
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Санкт-Петербург",
        "addressCountry": "RU"
      },
      "knowsAbout": [
        "AI-контент-системы",
        "Автоматизация контент-маркетинга",
        "ChatGPT",
        "Claude AI",
        "n8n",
        "Make.com",
        "Telegram-боты",
        "YouTube продвижение"
      ]
    },
    {
      "@type": "Organization",
      "@id": "https://switchonai.ru/#organization",
      "name": "ВКЛЮЧИ ИИ",
      "alternateName": "Switch On AI",
      "url": "https://switchonai.ru/",
      "founder": { "@id": "https://switchonai.ru/#person" },
      "description": "AI-контент-системы для предпринимателей и экспертов.",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Санкт-Петербург",
        "addressCountry": "RU"
      },
      "sameAs": [
        "https://t.me/Switch_On_AI",
        "https://t.me/Leshenko"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service",
        "url": "https://t.me/Leshenko",
        "availableLanguage": "Russian"
      }
    },
    {
      "@type": "ProfessionalService",
      "@id": "https://switchonai.ru/#service",
      "name": "ВКЛЮЧИ ИИ — AI-контент-системы",
      "description": "Полное внедрение AI-контент-системы: распаковка смыслов, стратегия, сборка автоматизации, запуск публикации.",
      "url": "https://switchonai.ru/",
      "provider": { "@id": "https://switchonai.ru/#person" },
      "areaServed": { "@type": "Country", "name": "Россия" },
      "serviceType": "AI-контент-системы",
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Услуги",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Внедрение AI-контент-системы",
              "description": "Полный цикл: распаковка → стратегия → сборка системы → запуск"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Экскурсия — бесплатная консультация",
              "description": "30-минутная демонстрация AI-контент-системы. Разбираем вашу ситуацию."
            },
            "price": "0",
            "priceCurrency": "RUB"
          }
        ]
      }
    }
  ]
}
```

**Важно:** не добавлять FAQPage schema на главную ради rich results — Google ограничил их показ. Если FAQ на главной нужен для GEO-цитирования, можно включить, но без расчёта на SERP-эффект.

**Расхождения между schema.json и schema-homepage.json, которые нужно устранить:**

| Поле | schema.json | schema-homepage.json | Рекомендация |
|------|-------------|---------------------|--------------|
| `Person.url` | `https://t.me/Leshenko` | `https://switchonai.ru/` | Использовать `switchonai.ru/` — это URL сущности на сайте |
| `Person.jobTitle` | «Основатель» | «AI-автоматизатор, эксперт по автоматизации бизнеса» | schema-homepage вариант точнее |
| `WebSite.inLanguage` | `"ru"` | `"ru-RU"` | `"ru-RU"` — согласует с `lang="ru"` в HTML |
| `Organization` | есть | отсутствует | Добавить в итоговую schema |

### 3.3 Heading hierarchy в прототипе

**Текущая структура в `index.html`:**

```
H1: «Система вместо хаоса в контенте» (hero)
  H2: «Для тех, у кого продукт есть, а системы контента — нет»
  H2: «AI не решает хаос. Он его ускоряет.»
    H3: «❌ Хаос» / «✅ Система» (comparison)
  H2: «Сначала смыслы и стратегия. Потом автоматизация.»
  H2: «Что вы получите»
  H2: «Для кого это — и для кого нет»
  H2: «Доказательства»
  H2: «Часто задаваемые вопросы»
  H2: «Готовы разобраться?» (final CTA)
```

**Оценка:** иерархия логичная. H1 — один, корректный. H2 — по секциям, не перегружены. H3 — для внутренней структуры секций.

**Замечания:**

1. H1 «Система вместо хаоса в контенте» — хорошо для конверсии, но слабо для SEO. Не содержит ключевого словосочетания «AI-контент-система» или «AI-автоматизация». Рекомендация: добавить ключевую фразу в `eyebrow`-метку над H1 (она уже есть: «AI-контент-системы») — это правильный подход, оставить как есть.

2. H2 с эмодзи в comparison («❌ Хаос», «✅ Система») — технически H3 в коде. Эмодзи в заголовках — нейтральный сигнал для SEO, не вредит.

3. Финальный H2 «Готовы разобраться?» — слабый с SEO-точки зрения, но для лендинга это CTA-блок, не индексируемый приоритет. Оставить как есть.

4. Добавить `id` атрибуты к H2 для anchor-навигации и лучшей crawlability (частично уже сделано через `id` на секциях, но сами заголовки без `id`).

---

## 4. GEO-оптимизация: AI-search visibility

### 4.1 Что работает в апреле 2026

**Google AI Overviews / AI Mode:**
- Никакой специальной разметки не требуется. Страница должна быть проиндексирована и иметь право показывать snippet в обычном Google Search.
- `max-snippet:-1` в robots meta — обязательно (уже указано в рекомендациях выше).
- Качество контента, структурированность, E-E-A-T сигналы — основной рычаг.

**ChatGPT Search (OAI-SearchBot):**
- Разрешить `OAI-SearchBot` в robots.txt явным `Allow: /`.
- Убедиться, что хостинг/CDN не блокирует OpenAI IP ranges.
- Отслеживать трафик через `utm_source=chatgpt.com`.

**Perplexity:**
- Разрешить `PerplexityBot` в robots.txt.
- Контент с прямыми ответами, определениями и структурированными фактами цитируется лучше.

**Bing AI Performance (новый, с февраля 2026):**
- Верифицировать сайт в Bing Webmaster Tools.
- Подключить IndexNow для быстрой переиндексации.
- Следить за разделом AI Performance — он показывает, какие страницы цитирует Copilot.

### 4.2 Entity Layer — приоритет номер один

Для AI-citation важнее всего чёткость entity: кто, что, для кого, чем отличается.

**Что нужно закрепить на главной странице (видимый текст, не только schema):**

- Кто: Павел Лещенко, Санкт-Петербург
- Что: AI-контент-система — не агентство, не курс, не ChatGPT-промпты
- Для кого: предприниматели и эксперты с продуктом, без системы контента
- Чем отличается: строится один раз и остаётся у клиента; контент звучит как автор, не как копирайтер; AI усиливает стратегию, не заменяет её

**В прототипе это частично отражено.** Нужно усилить: добавить конкретные числа (4 недели, 2-3 часа участия клиента), убедиться что имя Павел Лещенко встречается в видимом тексте выше fold.

### 4.3 llms.txt

Создать файл по адресу `https://switchonai.ru/llms.txt`:

```
# ВКЛЮЧИ ИИ — switchonai.ru

> AI-контент-системы для предпринимателей и экспертов.
> Автор: Павел Лещенко, Санкт-Петербург.

## Об авторе

Павел Лещенко — строю AI-контент-системы для бизнеса и экспертов.
Принцип: сначала распаковка смыслов и стратегия, потом автоматизация.
Система остаётся у клиента. Контент звучит как сам автор, не как копирайтер.

## Что такое AI-контент-система

Управляемая инфраструктура создания и публикации контента на базе AI.
Включает: банк смыслов, контент-стратегию, автоматизированный пайплайн, систему управления.
Запускается за 4 недели.

## Услуги

- Внедрение AI-контент-системы под ключ: https://switchonai.ru/
- Бесплатная Экскурсия (30 мин демонстрация системы): https://switchonai.ru/#excursion
- AI Команда за 1 вечер: https://switchonai.ru/ai-komanda/

## Контакты

- Telegram: https://t.me/Leshenko
- Канал: https://t.me/Switch_On_AI

## Блог (практические материалы по AI-автоматизации)

https://switchonai.ru/stati/

## Ключевые темы

- AI-контент-системы для бизнеса
- Автоматизация контент-маркетинга
- ChatGPT, Claude, n8n, Make.com
- Цифровые сотрудники и AI-ассистенты
- Распаковка смыслов и экспертности
```

### 4.4 Robots.txt: блок для AI-кроулеров

Добавить в начало robots.txt (до правил GoogleBot):

```
User-agent: GPTBot
Allow: /

User-agent: OAI-SearchBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Amazonbot
Allow: /

User-agent: Applebot
Allow: /

Llms-txt: https://switchonai.ru/llms.txt
```

### 4.5 Answer-first контент-паттерны на главной

Для GEO-цитируемости добавить на страницу (можно в FAQ-секцию или отдельный блок):

- Прямой ответ на «что такое AI-контент-система» в 2-3 предложениях
- Чёткое «для кого / не для кого» с конкретными признаками
- Конкретные числа: срок запуска, время участия клиента, что остаётся у клиента
- Сравнение «AI-контент-система vs SMM-агентство vs самостоятельно» — в таблице или структурированном списке

**В прототипе comparison-блок «Хаос vs Система» частично закрывает это.** Но нет прямого ответа на «что такое AI-контент-система» в первых экранах — только в eyebrow-метке.

---

## 5. Core Web Vitals требования для 2026

### 5.1 Актуальные метрики и пороги

| Метрика | Хорошо | Требует улучшения | Плохо |
|---------|--------|-------------------|-------|
| LCP (Largest Contentful Paint) | ≤ 2.5 сек | 2.5–4.0 сек | > 4.0 сек |
| INP (Interaction to Next Paint) | ≤ 200 мс | 200–500 мс | > 500 мс |
| CLS (Cumulative Layout Shift) | ≤ 0.1 | 0.1–0.25 | > 0.25 |

**Примечание:** FID (First Input Delay) окончательно заменён на INP с марта 2024. Все рекомендации в предыдущих аудитах, упоминающие FID, технически устарели.

### 5.2 Что влияет на CWV в прототипе

**LCP-риски:**
- Портрет Павла (hero__portrait) — сейчас placeholder. Когда появится реальное изображение, оно будет LCP-элементом. Требования:
  - Добавить `loading="eager"` (или не добавлять `lazy`) для hero-изображения
  - Добавить `fetchpriority="high"` на `<img>` портрета
  - Формат: WebP или AVIF, размер < 80 KB для mobile
- Шрифты Google Fonts — `preconnect` уже добавлен в прототипе (хорошо). Но шрифты загружаются с внешнего CDN, что добавляет latency. Если критично — self-host шрифты.

**INP-риски:**
- JavaScript для мобильного меню (burger) и FAQ аккордеона — должен быть легковесным. В прототипе это нативный JS без библиотек — хорошо.
- Анимации `transform: translateY` на кнопках — аппаратно ускорены, не влияют на INP.

**CLS-риски:**
- Google Fonts могут вызвать layout shift при загрузке. Решение: `font-display: swap` (должно быть в CSS) + задать `width` и `height` для изображений.
- `hero__portrait-wrapper` имеет фиксированный размер — хорошо, layout shift минимален.

### 5.3 Что нужно сделать для WordPress-версии

- Подключить кеширование (WP Rocket, LiteSpeed Cache или W3 Total Cache) — TTFB на проде 413 мс при цели < 200 мс.
- Включить WebP через плагин (ShortPixel, Smush) или nginx-модуль.
- Настроить lazy loading для изображений ниже fold: атрибут `loading="lazy"` на всех `<img>` кроме hero.
- Включить Gzip/Brotli сжатие на nginx.
- Preload hero-изображения:
  ```html
  <link rel="preload" as="image" href="/wp-content/uploads/pavel-leshenko.webp" fetchpriority="high">
  ```

---

## 6. Internal linking стратегия

### 6.1 Принципы (из 07-seo-analytics-cro-plan.md, актуальны)

- Каждый стратегический пост блога → ссылка на product/FAQ страницу
- Proof/case статьи → ссылка на Экскурсию
- Методологические статьи → ссылка на proof и product
- Pillar pages ↔ supporting posts (двунаправленно)
- About page → Product и Contact

### 6.2 Структура ссылок для главной страницы

Главная — верхний уровень воронки. От неё должны вести ссылки:

| Откуда | Куда | Тип ссылки |
|--------|------|------------|
| Hero CTA | `#excursion` (anchor на странице) | Основная конверсия |
| «Как это работает» кнопка | `#approach` (anchor) | Secondary |
| Навигация «Блог» | `/stati/` | Контентная воронка |
| Навигация «Прайс» | `/price/` | Коммерческая страница |
| Footer | `/oferta/`, `/privacy/` | Юридические |
| Footer | `https://t.me/Leshenko` | Контакт |

**Что добавить в прототип:**
- Ссылку на `/ai-komanda/` — это отдельный продукт, должен быть доступен с главной
- Ссылку на блог `/stati/` в навигации (сейчас в `header__nav` её нет — только anchor-ссылки внутри страницы)
- Блок «Из блога» (3-5 постов) — подтягивает авторитет блога на главную и создаёт пути к контенту

### 6.3 Internal linking для блога

Ключевая проблема: 170+ постов практически без внутренних ссылок. Решение из AUTOMATION-SEO-UPGRADE.md актуально:

- Internal Links Resolver нода в n8n — автоматически вставляет ссылки по плейсхолдерам
- Каждая новая статья должна получать 2-4 внутренних ссылки на релевантные материалы
- Приоритет: ссылки с постов → на страницы `/price/` и `/ai-komanda/`

### 6.4 Anchor text guidelines

- Первичный ключевой запрос страницы = точный анкор один раз
- Вариации ключевого запроса — для других ссылок
- Не использовать «здесь», «подробнее», «читайте тут» — информативный анкор обязателен
- Для ссылок на Экскурсию: анкор должен отражать действие («записаться на Экскурсию», «посмотреть как работает система»)

---

## 7. Конкретные рекомендации для index.html

### 7.1 Критично — добавить немедленно

**1. Open Graph и Twitter Card теги в `<head>`**

Их нет вообще. При шаринге в Telegram, ВКонтакте, других каналах ссылка выглядит как голый текст. Это критично для Telegram-ориентированного маркетинга.

Добавить сразу после `<meta name="description">`:
```html
<meta property="og:type" content="website">
<meta property="og:title" content="ВКЛЮЧИ ИИ — AI-контент-системы для бизнеса | Павел Лещенко">
<meta property="og:description" content="Павел Лещенко строит AI-контент-системы для предпринимателей и экспертов. Распаковка смыслов → стратегия → автоматизация. Запишитесь на бесплатную Экскурсию.">
<meta property="og:image" content="https://switchonai.ru/wp-content/uploads/og-homepage.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="https://switchonai.ru/">
<meta property="og:locale" content="ru_RU">
<meta property="og:site_name" content="ВКЛЮЧИ ИИ">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="ВКЛЮЧИ ИИ — AI-контент-системы для бизнеса">
<meta name="twitter:description" content="Строим AI-контент-системы для предпринимателей и экспертов. Система вместо хаоса в контенте.">
<meta name="twitter:image" content="https://switchonai.ru/wp-content/uploads/og-homepage.jpg">
```

**2. Canonical URL**

```html
<link rel="canonical" href="https://switchonai.ru/">
```

**3. Robots meta с разрешением snippet**

```html
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
```

**4. JSON-LD Schema в `<head>`**

Добавить итоговый `@graph` из раздела 3.2 в `<script type="application/ld+json">`. Не использовать несколько `@context` — один `@graph` содержит все типы.

**5. `lang` атрибут проверить**

В прототипе: `<html lang="ru">` — корректно. Убедиться что в Schema используется `"ru-RU"` (ISO стандарт).

### 7.2 Высокий приоритет — добавить при переносе в WordPress

**6. Ссылка на блог в навигации**

Текущая навигация: «Для кого», «Подход», «Доказательства», «FAQ» — все anchor-ссылки внутри страницы. Нет ни одной ссылки на внутренние страницы сайта. Добавить:
```html
<a href="/stati/">Блог</a>
```

**7. `fetchpriority="high"` для hero-изображения**

Когда портрет Павла будет заменён реальным `<img>`:
```html
<img src="..." alt="Павел Лещенко — AI-контент-системы"
     width="400" height="440"
     fetchpriority="high"
     decoding="async">
```

**8. `loading="lazy"` для изображений ниже fold**

Все `<img>` ниже hero-секции должны иметь `loading="lazy"`.

**9. Добавить `width` и `height` ко всем `<img>`**

Предотвращает CLS — браузер резервирует место до загрузки изображения.

**10. Имя автора в видимом тексте hero**

В прототипе: «Павел Лещенко строит AI-контент-системы...» — уже есть в subtitle. Хорошо. Но портрет Павла — placeholder. При замене на реальное фото добавить `alt="Павел Лещенко"`.

### 7.3 Средний приоритет — улучшения контента

**11. Добавить конкретные числа в hero**

Сейчас: «за 4 недели» есть в секции Подход, но не в hero. Рекомендация: добавить одно-два конкретных числа в hero-bullets:

```html
<li>Запуск системы за 4 недели</li>
<li>2–3 часа вашего времени на входе</li>
<li>Система остаётся у вас навсегда</li>
```

**12. Добавить «Из блога» секцию**

Блок с 3 последними или лучшими постами блога:
- Подтягивает авторитет блога на главную
- Создаёт internal links от главной к контенту
- Сигнал для Google о наличии регулярного обновляемого контента

**13. Проверить что FAQ-контент в видимом тексте дублирует FAQ schema**

Сейчас FAQ-секция в прототипе содержит вопросы как видимый текст с JavaScript-аккордеоном. При открытом состоянии (или при JS-fail) ответы должны быть доступны в HTML. Убедиться что `max-height: 0` CSS не прячет контент полностью от Google — Google читает содержимое скрытых элементов, но это лучше проверить через Google Search Console → URL Inspection.

**14. Добавить structured NAP в footer**

Name, Address, Phone — даже без телефона: имя + город + email/Telegram — сигнал для Local SEO и entity clarity:

```html
<address>
  Павел Лещенко — ВКЛЮЧИ ИИ<br>
  Санкт-Петербург, Россия<br>
  <a href="https://t.me/Leshenko">Telegram: @Leshenko</a>
</address>
```

### 7.4 Что в прототипе сделано правильно — не трогать

- `lang="ru"` на `<html>` — корректно
- `<meta charset="UTF-8">` — есть
- `<meta name="viewport" content="width=device-width, initial-scale=1.0">` — есть
- `preconnect` к Google Fonts — добавлен
- Один H1 на странице — соблюдено
- Логичная иерархия заголовков H1→H2→H3 — соблюдена
- Responsive дизайн с `@media` breakpoints — реализован
- Anchor-ссылки на секции в навигации — корректны
- JavaScript без внешних зависимостей (no jQuery) — отлично для CWV
- CSS custom properties (переменные) — чистая архитектура
- `scroll-behavior: smooth` — пользовательский UX
- `-webkit-font-smoothing: antialiased` — визуальное качество

---

## Приоритизированный чеклист действий

### Немедленно (до публикации прототипа)

- [ ] Добавить OG/Twitter meta теги в `<head>` index.html
- [ ] Добавить `<link rel="canonical">` в `<head>` index.html
- [ ] Добавить `<meta name="robots" content="index, follow, max-snippet:-1, ...">` в index.html
- [ ] Добавить JSON-LD schema (`@graph`) в `<script type="application/ld+json">` в `<head>`
- [ ] Создать OG-изображение 1200×630 px (портрет Павла + логотип + слоган)
- [ ] Принять решение: `switchonai.ru` или `switchonai.com` — всё SEO зависит от этого

### При переносе в WordPress (приоритет 1)

- [ ] Настроить Google Analytics 4 (через Site Kit by Google или MonsterInsights)
- [ ] Закрыть `xmlrpc.php` (nginx или плагин Disable XML-RPC)
- [ ] Добавить security headers в nginx (HSTS, X-Frame-Options, X-Content-Type-Options, Referrer-Policy)
- [ ] Скрыть `X-Powered-By` и WordPress meta generator
- [ ] Исправить `Disallow: *page` → `Disallow: /page/` в robots.txt
- [ ] Добавить AI-кроулеров (GPTBot, OAI-SearchBot, ClaudeBot, PerplexityBot) в robots.txt
- [ ] Добавить ссылку на блог `/stati/` в навигацию
- [ ] Добавить `fetchpriority="high"` на hero-изображение
- [ ] Добавить `loading="lazy"` на изображения ниже fold
- [ ] Добавить `width` и `height` атрибуты ко всем `<img>`

### При переносе в WordPress (приоритет 2)

- [ ] Создать `llms.txt` в корне сайта (текст выше в разделе 4.3)
- [ ] Написать уникальные мета-описания для `/stati/`, `/price/`, `/ai-komanda/`
- [ ] Добавить H1 на страницу `/stati/`
- [ ] Исправить дублирующийся H1 в теме (баг `single.php`)
- [ ] Добавить og:image через Yoast на ключевые страницы
- [ ] Убрать `meta keywords` («Главная страница»)
- [ ] Верифицировать сайт в Bing Webmaster Tools
- [ ] Отключить author-sitemap или разблокировать `/author/` в robots.txt

### В течение месяца

- [ ] Создать структуру категорий блога (5-7 категорий вместо «Рубрика»)
- [ ] Настроить 301-редиректы для дублей статей (группы из раздела 3.3 ACTION-PLAN)
- [ ] Подключить IndexNow для быстрой переиндексации в Bing/Copilot
- [ ] Установить кеширование (WP Rocket или LiteSpeed Cache) — TTFB 413 мс → цель < 200 мс
- [ ] Настроить конвертацию изображений в WebP (ShortPixel)
- [ ] Добавить секцию «Из блога» на главную (3 последних / лучших поста)
- [ ] Настроить отслеживание `utm_source=chatgpt.com` в GA4
- [ ] Мониторинг Bing AI Performance после верификации в BWT

---

*Аудит подготовлен: 2026-04-03 | switchonai.ru | Лидия Родарте-Куайл, SEO-аудитор команды БАНДА*
