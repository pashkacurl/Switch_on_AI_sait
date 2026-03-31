# Доработка автоматизации: полноценные SEO-статьи
**Дата:** 2026-03-28
**Контекст:** n8n воркфлоу — YouTube → Airtable → WordPress (switchonai.ru)

---

## Текущее состояние пайплайна

```
YouTube транскрипт
    ↓
AI Agent темы статей → Тема + Описание → Airtable (Статус: Новый)
    ↓
Perplexity sonar-pro → внешние факты
    ↓
SEO статей (Agent #2a) → 8 SEO-полей → Airtable (Статус: Написать)
    ↓
Главная автоматизация:
  Заголовок → Дискрипшен → Статья → Alt/SEO title/Slug → Картинка
    ↓
WordPress (title + content + slug + featured_media)
  + Yoast: seo_title, metadesc (БАГ), focuskw
  + Airtable: Статус → Опубликовано
```

**Что уже хорошо:**
- GEO-оптимизация встроена в промпт статьи
- FAQ schema генерируется автоматически
- Perplexity enrichment с реальными фактами и источниками
- Alt-текст, slug, excerpt — всё есть
- Separate SEO title vs Дзен headline

**Что не работает или отсутствует:**
- Мета-описание не пишется в Yoast (баг)
- Категория не проставляется (все статьи в "Рубрике")
- Нет внутренних ссылок
- Нет таблицы содержания (ToC)
- H2 структура не проверяется на keyword coverage
- Нет тега категории на изображении
- Нет OpenGraph image отдельно от featured image

---

## БЛОК 1: Критичные фиксы (уже описаны в патче)

### 1.1 Баг: мета-описание не пишется

**В ноде "Финальные данные":**
Переименовать поле `output` → `meta_description`

**В ноде "Привязка картинки":**
```json
"_yoast_wpseo_metadesc": "{{ $('Финальные данные').item.json.meta_description }}"
```

### 1.2 Категории (патч уже в файле My_workflow_14_PATCHED.json)

В ноде "Создание поста" добавить:
```json
"categories": ["={{ $('Переменные').item.json.wp_category_id }}"]
```

---

## БЛОК 2: Улучшения промпта "Статья"

### 2.1 Добавить секцию про внутренние ссылки

Вставить в промпт "Статья" новую секцию после INPUT DATA:

```
--------------------------------------------------
INTERNAL LINKING CONTEXT
--------------------------------------------------

When writing the article, naturally mention related topics from the author's blog.
Use anchor text that matches how these topics are searched.
Insert 2-4 internal link placeholders in format:
[INTERNAL_LINK: topic="ключевая фраза" anchor="текст анкора"]

Example:
[INTERNAL_LINK: topic="автоматизация контента" anchor="автоматизацию контент-маркетинга"]

These placeholders will be replaced with real URLs by the pipeline.
Do NOT invent URLs. Only use placeholders.
```

**Дополнительно:** создать отдельную ноду после "Статья" которая:
1. Извлекает `[INTERNAL_LINK: ...]` плейсхолдеры
2. Ищет в WordPress REST API статьи по ключевой фразе
3. Заменяет плейсхолдеры на реальные `<a href="...">...</a>`

### 2.2 Добавить Table of Contents

В промпт "Статья" добавить в секцию OUTPUT RULES:

```
TABLE OF CONTENTS:
After the opening paragraph (before first H2), insert a ToC block:
<div class="toc">
<p><strong>Содержание статьи</strong></p>
<ul>
<li><a href="#section-1">Заголовок первого H2</a></li>
<li><a href="#section-2">Заголовок второго H2</a></li>
...
</ul>
</div>

Each H2 must have a matching id attribute:
<h2 id="section-1">Текст H2</h2>
```

### 2.3 Усилить keyword coverage в H2

Добавить в промпт "Статья" в секцию KEYWORD INTEGRATION:

```
H2 KEYWORD RULES:
- First H2 must contain PRIMARY_KEYWORD or close variation
- At least 2 H2s must contain words from SECONDARY_KEYWORDS
- At least 1 H2 must contain a phrase from LONG_TAIL_KEYWORDS
- H2 phrasing must sound natural, NOT stuffed
```

### 2.4 Добавить авторскую подпись (E-E-A-T)

В промпт "Статья" добавить обязательный блок перед заключением:

```
AUTHOR BLOCK (mandatory, before conclusion):
Insert this HTML block before the last section:
<div class="author-note">
<p><strong>От автора:</strong> [1-2 предложения личного опыта по теме статьи,
от первого лица. Конкретный факт или наблюдение из практики Павла Лещенко.
Без CTА.]</p>
</div>
```

---

## БЛОК 3: Улучшения SEO-агента (Agent #2a)

### 3.1 Добавить поле `reading_time`

В OUTPUT FORMAT добавить 10-й ключ:
```json
"reading_time": "7 минут"
```

Использовать в WordPress через кастомное поле или в начале статьи.

### 3.2 Улучшить geo_blocks — добавить entity anchors

В секции GEO RULES добавить:

```
ENTITY ANCHORING:
In tldr and definitions, mention at least once:
- Author's concept: "AI-контент-система Павла Лещенко" or "распаковка смыслов"
- Site brand: "switchonai.ru"
This helps AI assistants anchor facts to the author's identity.
```

### 3.3 Добавить поле `schema_type`

Для корректного выбора schema на уровне статьи:

```json
"schema_type": "Article"
```

Варианты: `Article`, `HowTo`, `FAQPage`, `NewsArticle`

Логика выбора:
- Если тема начинается с "Как" → `HowTo`
- Если есть 3+ вопроса в H2 → `FAQPage`
- Иначе → `Article`

---

## БЛОК 4: Новые ноды в главной автоматизации

### 4.1 Нода: Internal Links Resolver

Добавить после "GEO теги" перед "Создание поста":

```javascript
// Code node: Internal Links Resolver
const content = $input.first().json.final_content;
const baseUrl = 'https://switchonai.ru';

// Extract placeholders
const placeholders = [...content.matchAll(/\[INTERNAL_LINK: topic="([^"]+)" anchor="([^"]+)"\]/g)];

let resolved = content;

for (const match of placeholders) {
  const [full, topic, anchor] = match;
  // Search WP REST API for related post
  // Replace with <a href="...">anchor</a> or remove placeholder if not found
  resolved = resolved.replace(full, `<a href="${baseUrl}/?s=${encodeURIComponent(topic)}">${anchor}</a>`);
}

return [{ json: { ...($input.first().json), final_content: resolved } }];
```

> Улучшенная версия: делать реальный GET запрос к `https://switchonai.ru/wp-json/wp/v2/posts?search=ТЕМА&per_page=1` и брать первый результат.

### 4.2 Нода: OG Image Meta

В "Привязка картинки" добавить в JSON body:

```json
"meta": {
  "_yoast_wpseo_title": "{{ $('Финальные данные').item.json.output.seo_title }}",
  "_yoast_wpseo_metadesc": "{{ $('Финальные данные').item.json.meta_description }}",
  "_yoast_wpseo_focuskw": "{{ $('Переменные').item.json.primary_keywords }}",
  "_yoast_wpseo_opengraph-image": "{{ $('Загрузка картинки').item.json.source_url }}",
  "_yoast_wpseo_twitter-image": "{{ $('Загрузка картинки').item.json.source_url }}"
}
```

### 4.3 Нода: Post Tags

Добавить в "Создание поста" или отдельным HTTP PATCH:

```json
"tags": ["={{ $('Переменные').item.json.secondary_keywords.split(',').slice(0,3).join(',') }}"]
```

> Нужно предварительно создать теги через WP REST API и хранить их ID в Airtable или генерировать динамически.

---

## БЛОК 5: Airtable — добавить поля для трекинга

Добавить в таблицу `Темы для статей`:

| Поле | Тип | Для чего |
|------|-----|---------|
| `wp_category_id` | Single line text | Категория WordPress |
| `wp_post_id` | Number | ID поста для апдейтов |
| `published_at` | Date | Дата публикации |
| `word_count` | Number | Количество слов |
| `internal_links_count` | Number | Внутренних ссылок |

`wp_post_id` — сохранять из ответа ноды "Создание поста":
```
wp_post_id = {{ $('Создание поста').item.json.id }}
```

Это позволит обновлять статьи при повторном запуске вместо создания дублей.

---

## БЛОК 6: Приоритет внедрения

### Неделя 1 (критично)
- [ ] Применить патч `My_workflow_14_PATCHED.json` — категории
- [ ] Исправить баг `_yoast_wpseo_metadesc` в главной автоматизации
- [ ] Добавить `wp_category_id` в Airtable
- [ ] Создать 6 категорий в WordPress

### Неделя 2 (качество)
- [ ] Добавить keyword coverage rules в промпт "Статья"
- [ ] Добавить авторский блок (E-E-A-T) в промпт "Статья"
- [ ] Добавить OG/Twitter image в "Привязка картинки"
- [ ] Добавить ToC в промпт "Статья"

### Месяц 2 (масштаб)
- [ ] Internal Links Resolver нода
- [ ] Tags автоматизация
- [ ] `wp_post_id` трекинг
- [ ] `schema_type` поле для HowTo/FAQ динамической разметки

---

## Итоговая схема после доработок

```
YouTube транскрипт
    ↓
AI Agent темы статей → Тема + Описание → Airtable
    ↓
Perplexity → внешние факты + источники
    ↓
SEO статей → keywords + geo_blocks + wp_category_id + schema_type
    ↓
Airtable (Статус: Написать + все SEO поля)
    ↓
Главная автоматизация:
  Заголовок (CTR оптимизированный)
  → Дискрипшен (meta description)
  → Статья (SEO + GEO + ToC + author block + internal link placeholders)
  → Alt/SEO title/Slug/Excerpt
  → Internal Links Resolver
  → GEO теги (FAQ schema)
  → Картинка (fal.ai)
  → WordPress:
      title, content, slug, categories, tags, status
      featured_media, excerpt
      Yoast: seo_title, metadesc, focuskw, og-image, twitter-image
  → Airtable: Статус → Опубликовано + wp_post_id
```

---

*Документ подготовлен: 2026-03-28 | switchonai.ru | Lydia Rodarte-Quayle*
