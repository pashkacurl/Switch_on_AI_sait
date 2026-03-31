# Универсальный гайд: SEO-автоматизация статей для любой ниши
**Дата:** 2026-03-28
**Автор:** Лидия Родарте-Куайл (SEO-аналитик)

---

## Введение

Этот гайд описывает архитектуру автоматизированного контент-пайплайна, который производит SEO-оптимизированные статьи для любой ниши. Основан на практике switchonai.ru, но применим к любому проекту.

**Принцип:** автоматизация не заменяет стратегию — она масштабирует её. Если стратегия кривая, автоматизация кривую и масштабирует.

---

## ЧАСТЬ 1: Архитектура пайплайна

### Универсальная схема

```
ИСТОЧНИК ДАННЫХ
    ↓
АГЕНТ ТЕМ — генерирует идеи статей
    ↓
АГЕНТ ОБОГАЩЕНИЯ — внешние факты (Perplexity/Google)
    ↓
SEO-АГЕНТ — ключевые слова, категория, метаданные
    ↓
БАЗА ДАННЫХ (Airtable / Google Sheets / Notion)
    ↓
АГЕНТ СТАТЬИ — пишет полноценный SEO-текст
    ↓
АГЕНТ ЗАГОЛОВКА — CTR-оптимизированный заголовок
    ↓
АГЕНТ МЕТА-ОПИСАНИЯ — 155 символов, конверсионный
    ↓
ГЕНЕРАТОР ИЗОБРАЖЕНИЙ (fal.ai / DALL-E / Midjourney)
    ↓
RESOLVER ВНУТРЕННИХ ССЫЛОК
    ↓
CMS (WordPress / Tilda / Ghost / Webflow)
```

### Источники тем (выбери свой)

| Источник | Подходит для | Инструмент |
|----------|-------------|------------|
| YouTube транскрипты | Эксперты с каналом | Whisper API + yt-dlp |
| RSS конкурентов | Новостные ниши | RSS reader node |
| Google Search Console | Уже ранжирующиеся запросы | GSC API |
| Keyword cluster | Любая ниша | Ahrefs/Semrush API |
| Вопросы Reddit/Pikabu | Проблемный контент | Reddit API |
| Telegram канал | Мессенджер-аудитория | Telegram Bot API |
| Podcast транскрипты | Аудио-контент | Assembly AI |

---

## ЧАСТЬ 2: SEO-агент (ядро системы)

Это самый важный агент. Он определяет, будет ли статья ранжироваться.

### Обязательные поля OUTPUT

```json
{
  "primary_keyword": "главный ключ — 1 фраза, 2-4 слова",
  "secondary_keywords": "3-5 фраз через запятую",
  "long_tail_keywords": "3-5 вопросов/длинных запросов",
  "search_intent": "informational | transactional | navigational | commercial",
  "wp_category_id": "ID категории WordPress",
  "schema_type": "Article | HowTo | FAQPage | NewsArticle | Product | Review",
  "meta_title": "до 60 символов, включает primary_keyword",
  "meta_description": "до 155 символов, включает CTA",
  "slug": "url-slug-через-дефис",
  "geo_blocks": {
    "tldr": "1-2 предложения — суть для AI-ответов",
    "definition": "что такое [тема] простым языком",
    "key_facts": ["факт 1", "факт 2", "факт 3"],
    "faq": [
      {"q": "вопрос", "a": "ответ 2-3 предложения"},
      {"q": "вопрос", "a": "ответ 2-3 предложения"}
    ]
  }
}
```

### Промпт SEO-агента (универсальный шаблон)

```
You are an expert SEO strategist for [НИША].

TARGET AUDIENCE: [описание ЦА — кто, зачем читает]
SITE BRAND: [название сайта / домен]
SITE AUTHOR: [имя автора / экспертность]

INPUT:
- Topic: {{ $json.topic }}
- Description: {{ $json.description }}
- External facts: {{ $json.perplexity_facts }}

TASK:
Analyze the topic and generate complete SEO metadata.

PRIMARY KEYWORD RULES:
- 1 exact phrase, 2-4 words
- Matches how [ЦА] actually searches
- Monthly search volume should be realistic (not too high/niche)

INTENT CLASSIFICATION:
- informational: как, что такое, почему, объяснение
- transactional: купить, заказать, цена, скачать
- commercial: лучший, сравнение, обзор, топ
- navigational: конкретный бренд/сайт/инструмент

CATEGORY ASSIGNMENT:
Choose ONE category ID from this list:
[ТВОИ КАТЕГОРИИ И ИХ ID]

SCHEMA TYPE:
- HowTo: если тема "как сделать X" с шагами
- FAQPage: если тема — ответ на частый вопрос
- NewsArticle: если это новость/анонс
- Article: всё остальное

GEO OPTIMIZATION:
tldr must be 1-2 sentences that directly answer what [ЦА] is looking for.
definition must explain the concept clearly for AI assistants.
faq must contain real questions people ask.

OUTPUT FORMAT (JSON only, no markdown):
{
  "primary_keyword": "...",
  "secondary_keywords": "..., ..., ...",
  "long_tail_keywords": "..., ..., ...",
  "search_intent": "...",
  "wp_category_id": "...",
  "schema_type": "...",
  "meta_title": "...",
  "meta_description": "...",
  "slug": "...",
  "geo_blocks": {
    "tldr": "...",
    "definition": "...",
    "key_facts": ["...", "...", "..."],
    "faq": [
      {"q": "...", "a": "..."},
      {"q": "...", "a": "..."}
    ]
  }
}
```

---

## ЧАСТЬ 3: Агент статьи (Article Writer)

### Промпт (универсальный шаблон)

```
You are an expert content writer for [НИША].

AUTHOR PERSONA:
Name: [Имя автора]
Expertise: [Область экспертизы]
Writing style: [профессиональный / разговорный / академический / дружелюбный]
Language: Russian

INPUT DATA:
--------------------------------------------------
Primary keyword: {{ primary_keyword }}
Secondary keywords: {{ secondary_keywords }}
Long-tail keywords: {{ long_tail_keywords }}
Search intent: {{ search_intent }}
Schema type: {{ schema_type }}
Topic: {{ topic }}
Description: {{ description }}
External facts: {{ perplexity_facts }}
GEO tldr: {{ geo_blocks.tldr }}
GEO definition: {{ geo_blocks.definition }}
GEO key_facts: {{ geo_blocks.key_facts }}
GEO faq: {{ geo_blocks.faq }}
--------------------------------------------------

ARTICLE REQUIREMENTS:
- Word count: [1200-2000 слов для информационных, 800-1200 для коммерческих]
- Language: Russian
- Output: HTML only (no markdown)

STRUCTURE RULES:
1. Opening paragraph (100-150 words): hook + primary_keyword in first 100 chars
2. Table of Contents (before first H2)
3. 4-6 H2 sections with matching IDs for ToC
4. Closing FAQ section (from geo_blocks.faq)
5. Author note (before conclusion)
6. Conclusion

TABLE OF CONTENTS FORMAT:
<div class="toc">
<p><strong>Содержание статьи</strong></p>
<ul>
<li><a href="#section-1">Заголовок H2</a></li>
</ul>
</div>

H2 FORMAT (always with ID):
<h2 id="section-1">Текст заголовка</h2>

H2 KEYWORD RULES:
- First H2 must contain primary_keyword or close variation
- At least 2 H2s must use words from secondary_keywords
- At least 1 H2 must include a long_tail phrase
- Sound natural, no keyword stuffing

KEYWORD INTEGRATION:
- Primary keyword: in H1 (title), first paragraph, 1-2 H2s, conclusion
- Secondary keywords: distributed across sections
- Density: 1-2% for primary keyword

INTERNAL LINKING:
Insert 2-3 placeholders where related topics are mentioned:
[INTERNAL_LINK: topic="ключевая фраза" anchor="текст ссылки"]
Do NOT invent URLs.

AUTHOR NOTE (mandatory, before conclusion):
<div class="author-note">
<p><strong>От автора:</strong> [1-2 personal sentences about hands-on experience with this topic. First person. Specific observation or result. No CTA.]</p>
</div>

FAQ SECTION (mandatory, last section before conclusion):
Use geo_blocks.faq data.
Format:
<h2 id="faq">Часто задаваемые вопросы</h2>
[Question as H3, Answer as P]

E-E-A-T SIGNALS:
- Mention specific numbers, dates, case studies
- Reference real tools/platforms by name
- Include author's perspective (first person)
- Cite external facts from perplexity_facts

GEO OPTIMIZATION:
- First paragraph = paraphrase of geo_blocks.tldr
- Include geo_blocks.definition naturally in first H2 section
- Weave geo_blocks.key_facts into relevant sections

OUTPUT: Return only HTML content. No JSON wrapper. No markdown.
```

---

## ЧАСТЬ 4: Категории WordPress — как проектировать

### Принципы

1. **3-8 категорий максимум** — больше не нужно, создаёт путаницу
2. **Категория = поисковый кластер** — не тема, а запросный кластер
3. **Без вложенности** — плоская структура лучше для SEO
4. **Slug = ключевое слово** — `/category/avtomatizaciya/`, не `/category/cat-2/`

### Пример для разных ниш

**Маркетинг/AI (как switchonai.ru):**
```
автоматизация    → /category/avtomatizaciya/
нейросети        → /category/nejroseti/
контент-маркетинг → /category/kontent-marketing/
инструменты      → /category/instrumenty/
кейсы            → /category/kejsy/
```

**Интернет-магазин:**
```
обзоры           → /category/obzory/
сравнения        → /category/sravneniya/
руководства      → /category/rukovodstva/
новости          → /category/novosti/
```

**Образование:**
```
уроки            → /category/uroki/
теория           → /category/teoriya/
практика         → /category/praktika/
инструменты      → /category/instrumenty/
```

### Как определить категорию автоматически

В промпт SEO-агента вставить таблицу:

```
CATEGORY MAPPING:
If topic is about: automation, n8n, make.com, zapier → category_id: 5
If topic is about: AI models, GPT, Claude, Gemini → category_id: 3
If topic is about: content creation, copywriting → category_id: 4
If topic is about: specific tool review → category_id: 6
If topic is about: real case study → category_id: 7
Default → category_id: 2
```

---

## ЧАСТЬ 5: Schema markup — что генерировать автоматически

### Выбор schema по типу

| schema_type | Когда | Что включить |
|-------------|-------|-------------|
| Article | Большинство статей | author, datePublished, headline, image |
| HowTo | "Как сделать X" | steps с именем и описанием |
| FAQPage | Вопрос-ответ контент | mainEntity с Question/Answer |
| NewsArticle | Новости, анонсы | datePublished (актуальная дата) |
| Review | Обзоры продуктов | reviewRating, itemReviewed |
| HowTo | Туториалы | steps[] |

### Универсальный JSON-LD для статьи

```json
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "{{ schema_type }}",
      "@id": "{{ post_url }}#article",
      "headline": "{{ title }}",
      "description": "{{ meta_description }}",
      "image": "{{ featured_image_url }}",
      "datePublished": "{{ publish_date }}",
      "dateModified": "{{ publish_date }}",
      "author": {
        "@type": "Person",
        "name": "{{ author_name }}",
        "url": "{{ author_url }}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "{{ site_name }}",
        "url": "{{ site_url }}"
      },
      "mainEntityOfPage": "{{ post_url }}"
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Главная",
          "item": "{{ site_url }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "{{ category_name }}",
          "item": "{{ category_url }}"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "{{ title }}",
          "item": "{{ post_url }}"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {{ faq_pairs_as_schema }}
      ]
    }
  ]
}
```

---

## ЧАСТЬ 6: GEO/AEO — оптимизация под AI-поиск

AI-поисковики (Perplexity, ChatGPT Search, Google AI Overview) отвечают на вопросы, цитируя сайты. Чтобы тебя цитировали — нужно быть "цитируемым".

### 5 правил GEO

**1. Прямой ответ в первом абзаце**
Пользователь спрашивает — первый абзац отвечает прямо, без "Сегодня мы рассмотрим..."

**2. Определения с entity anchoring**
```
[Термин] — это [определение]. По опыту [Имя автора], [практическое наблюдение].
```

**3. Структурированные факты**
Списки, таблицы, конкретные цифры — AI легче их извлекает.

**4. Авторская идентичность**
Упоминать автора и сайт по имени в тексте:
```
"AI-система [Имя автора] на [домен] показала, что..."
```

**5. llms.txt**
Создать файл `https://yourdomain.com/llms.txt`:
```
# [Название сайта]
> [1-2 предложения о сайте]

## О сайте
[Описание]

## Автор
[Имя, экспертиза]

## Ключевые темы
- [тема 1]
- [тема 2]

## Важные страницы
- [URL]: [описание]
```

---

## ЧАСТЬ 7: Технический чеклист для нового пайплайна

### Перед запуском

- [ ] Создать категории в WordPress с SEO-слагами
- [ ] Записать category_id в Airtable/промпт
- [ ] Подключить Yoast/RankMath к REST API
- [ ] Настроить поле `_yoast_wpseo_metadesc` в HTTP node
- [ ] Создать тестовую статью вручную — проверить что все поля пишутся
- [ ] Проверить robots.txt — категории не заблокированы
- [ ] Добавить sitemap в Google Search Console

### После каждых 10 статей

- [ ] Проверить Search Console — нет ли ошибок индексации
- [ ] Проверить что meta description отображается в Yoast
- [ ] Проверить что категории правильные
- [ ] Проверить что slug не дублируется
- [ ] Проверить Schema через Rich Results Test (search.google.com/test/rich-results)

---

## ЧАСТЬ 8: n8n — структура нод

### Минимальный рабочий пайплайн

```
Trigger (Schedule / Webhook / Manual)
  ↓
HTTP Request: получить тему из базы (Airtable GET)
  ↓
HTTP Request: Perplexity sonar-pro (обогащение фактами)
  ↓
AI Agent: SEO-агент → JSON с 10 полями
  ↓
Code Node: парсер JSON + валидация полей
  ↓
HTTP Request: Airtable PATCH (обновить статус + SEO-поля)
  ↓
AI Agent: генерация заголовка
  ↓
AI Agent: генерация мета-описания
  ↓
AI Agent: написание статьи (HTML)
  ↓
Code Node: Internal Links Resolver
  ↓
Code Node: Schema JSON-LD генератор
  ↓
HTTP Request: загрузка изображения в WordPress Media
  ↓
HTTP Request: создание поста в WordPress
  ↓
HTTP Request: Yoast meta (PATCH на пост)
  ↓
HTTP Request: Airtable PATCH (статус → Опубликовано + wp_post_id)
```

### Code Node: JSON парсер (универсальный)

```javascript
// Универсальный парсер ответа AI-агента
const raw = $input.first().json.output || $input.first().json.text || '';

let parsed = {};

// Попытка 1: прямой JSON
try {
  parsed = JSON.parse(raw);
} catch(e) {
  // Попытка 2: извлечь из ```json ... ```
  const match = raw.match(/```json\s*([\s\S]*?)\s*```/);
  if (match) {
    try { parsed = JSON.parse(match[1]); } catch(e2) {}
  }

  // Попытка 3: найти первый { ... }
  if (!Object.keys(parsed).length) {
    const jsonMatch = raw.match(/\{[\s\S]*\}/);
    if (jsonMatch) {
      try { parsed = JSON.parse(jsonMatch[0]); } catch(e3) {}
    }
  }
}

// Обязательные поля с дефолтами
const required_fields = {
  primary_keyword: 'контент маркетинг',
  secondary_keywords: '',
  long_tail_keywords: '',
  search_intent: 'informational',
  wp_category_id: '2',
  schema_type: 'Article',
  meta_title: $input.first().json.topic || 'Статья',
  meta_description: '',
  slug: '',
  geo_blocks: {}
};

for (const [key, defaultVal] of Object.entries(required_fields)) {
  if (!parsed[key]) parsed[key] = defaultVal;
}

// Генерация slug если пустой
if (!parsed.slug) {
  parsed.slug = parsed.primary_keyword
    .toLowerCase()
    .replace(/[^а-яёa-z0-9\s]/g, '')
    .replace(/\s+/g, '-')
    .substring(0, 60);
}

return [{ json: parsed }];
```

### Code Node: Schema JSON-LD генератор

```javascript
const data = $input.first().json;
const postUrl = data.post_url || '';
const siteUrl = 'https://yourdomain.com';

// FAQ из geo_blocks
let faqEntities = '';
if (data.geo_blocks && data.geo_blocks.faq) {
  faqEntities = data.geo_blocks.faq.map(item => JSON.stringify({
    "@type": "Question",
    "name": item.q,
    "acceptedAnswer": { "@type": "Answer", "text": item.a }
  })).join(',\n');
}

const schema = {
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": data.schema_type || "Article",
      "headline": data.title,
      "description": data.meta_description,
      "datePublished": new Date().toISOString(),
      "author": {
        "@type": "Person",
        "name": "Павел Лещенко",
        "url": siteUrl + "/about"
      },
      "publisher": {
        "@type": "Organization",
        "name": "SwitchOnAI",
        "url": siteUrl
      }
    }
  ]
};

// Добавить FAQ если есть
if (faqEntities) {
  schema["@graph"].push({
    "@type": "FAQPage",
    "mainEntity": data.geo_blocks.faq.map(item => ({
      "@type": "Question",
      "name": item.q,
      "acceptedAnswer": { "@type": "Answer", "text": item.a }
    }))
  });
}

const schemaBlock = `<script type="application/ld+json">\n${JSON.stringify(schema, null, 2)}\n</script>`;

return [{ json: { ...data, schema_block: schemaBlock } }];
```

---

## ЧАСТЬ 9: Адаптация под нишу

### Чеклист перед запуском нового пайплайна

**1. Определи ЦА**
- Кто читает?
- Какой уровень экспертизы?
- Какой поисковый интент преобладает?

**2. Определи категории (3-8)**
- Какие кластеры тем?
- Создай в WordPress + запиши ID

**3. Настрой SEO-агент**
- Впиши категории и их ID в промпт
- Настрой entity anchoring (бренд + автор)
- Определи основные long-tail паттерны для ниши

**4. Настрой агент статьи**
- Тон голоса (conversational / professional / academic)
- Длина статьи под интент (1200-2000 для info, 800-1200 для commercial)
- Специфичные секции для ниши (рецепты, шаги, цены, сравнения)

**5. Тестирование (первые 3 статьи вручную)**
- Проверь что JSON парсится корректно
- Проверь что категория проставляется
- Проверь Schema через Rich Results Test
- Проверь мета-описание в Yoast
- Проверь ToC + H2 IDs

**6. Мониторинг (первый месяц)**
- Google Search Console — impressions/clicks через 2-3 недели
- Индексация — site:yourdomain.com в Google
- Core Web Vitals — PageSpeed Insights

---

## ЧАСТЬ 10: Типичные ошибки и как их избежать

| Ошибка | Почему плохо | Решение |
|--------|-------------|---------|
| Все статьи в одной категории | Размывает тематический авторитет | Правильные category_id в агенте |
| Meta description не пишется | Не отображается в SERP, CTR падает | Проверить поле в Yoast HTTP node |
| Slug с кириллицей | Некорректные URL, проблемы с индексацией | Code node конвертирует в транслит |
| Нет H1 или H1 = Title | Google не понимает структуру страницы | WordPress title → H1 автоматически |
| Дублированный контент | Фильтр Google Panda | Уникальный angle + personal experience |
| Нет internal links | Juice не распределяется | Internal Links Resolver нода |
| Schema не валидируется | Rich snippets не показываются | Тест через search.google.com/test/rich-results |
| Изображение без alt | Доступность + missed SEO сигнал | Alt = primary_keyword + описание сцены |
| Статьи без ToC | Пользователь уходит, bounce rate растёт | ToC в промпте статьи |
| Нет авторских данных | Слабый E-E-A-T | Author block + About page |

---

## Итоговый минимальный стек

| Компонент | Бесплатно | Платно |
|-----------|-----------|--------|
| CMS | WordPress.org | — |
| SEO plugin | Yoast (free) | Yoast Premium |
| Автоматизация | n8n (self-hosted) | n8n Cloud |
| База данных | Airtable (free tier) | Airtable Pro |
| AI агенты | OpenRouter (pay-per-use) | — |
| Факты | Perplexity API | $20/мес |
| Изображения | — | fal.ai / Replicate |
| Аналитика | Google Analytics 4 | — |
| Мониторинг | Google Search Console | — |

---

*Документ подготовлен: 2026-03-28 | Лидия Родарте-Куайл для switchonai.ru*
