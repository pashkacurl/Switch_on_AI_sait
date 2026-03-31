# Changelog: доработки n8n воркфлоу
**Дата:** 2026-03-28
**Автор доработок:** Victor (agent)

---

## Файлы

| Файл | Описание |
|------|----------|
| `workflow-14-upgraded.json` | Воркфлоу #14 (YouTube → Темы → SEO ядро) с доработками |
| `workflow-blog-dzen-vc-pikabu-telegraf-upgraded.json` | Главная автоматизация (статьи → WordPress + площадки) с доработками |

---

## Workflow 14 — что изменено

### 1. Нода "SEO статей" — промпт
- **Добавлена секция ENTITY ANCHORING** (в блоке GEO RULES): теперь AI обязан упоминать "AI-контент-система Павла Лещенко", "распаковка смыслов" и "switchonai.ru" в tldr и definitions. Это усиливает привязку бренда в AI-поисковиках.
- **Добавлена секция 8.5 SCHEMA TYPE SELECTION**: AI определяет тип schema (Article / HowTo / FAQPage) на основе темы. Логика: "Как..." → HowTo, 3+ вопросов в H2 → FAQPage, иначе Article.
- **Добавлены 2 новых поля** в OUTPUT FORMAT:
  - `reading_time` — время чтения ("7 минут")
  - `schema_type` — тип schema разметки
- Формат вывода изменён с 8 на 10 ключей.

### 2. Нода "Code in JavaScript1" — JSON-парсер
- Массив `keys` и `required` расширены на `reading_time` и `schema_type`. Парсер теперь корректно извлекает все 10 полей.

### 3. Нода "Запись метрик Reels4" — Airtable
- Добавлены колонки `reading_time` и `schema_type` в маппинг записи.

---

## Главный воркфлоу (blog-dzen-vc-pikabu-telegraf) — что изменено

### 1. БЛОК 1.1 — Баг мета-описания ИСПРАВЛЕН
- **Нода "Финальные данные"**: добавлено поле `meta_description` (значение: `$('Code in JavaScript').item.json.output`)
- **Нода "Привязка картинки"**: `_yoast_wpseo_metadesc` теперь ссылается на `$('Финальные данные').item.json.meta_description` вместо старого пути. Yoast теперь получит мета-описание.

### 2. БЛОК 1.2 — Категории WordPress
- **Нода "Создание поста"**: добавлен параметр `categories` → берёт `wp_category_id` из переменных.

### 3. БЛОК 2.1 — Внутренние ссылки в промпте "Статья"
- Добавлена секция INTERNAL LINKING CONTEXT. AI вставляет 2-4 плейсхолдера `[INTERNAL_LINK: topic="..." anchor="..."]` которые потом резолвятся в реальные ссылки.

### 4. БЛОК 2.2 — Table of Contents
- В промпт "Статья" добавлены правила генерации оглавления `<div class="toc">` после первого абзаца. Каждый H2 получает `id` атрибут для якорных ссылок.

### 5. БЛОК 2.3 — Keyword coverage в H2
- Добавлены H2 KEYWORD RULES:
  - Первый H2 содержит PRIMARY_KEYWORD
  - Минимум 2 H2 содержат SECONDARY_KEYWORDS
  - Минимум 1 H2 содержит LONG_TAIL_KEYWORDS
  - Формулировки звучат естественно

### 6. БЛОК 2.4 — Авторский блок E-E-A-T
- Добавлен обязательный HTML-блок `<div class="author-note">` перед заключением. 1-2 предложения от первого лица с конкретным опытом Павла Лещенко.

### 7. БЛОК 4.1 — Internal Links Resolver (НОВАЯ НОДА)
- Добавлена Code-нода "Internal Links Resolver" между "GEO теги" и "Загрузка картинки".
- Извлекает плейсхолдеры `[INTERNAL_LINK: ...]` и заменяет на `<a href="switchonai.ru/?s=topic">anchor</a>`.
- Связи обновлены: GEO теги → Internal Links Resolver → Загрузка картинки.

### 8. БЛОК 4.2 — OG/Twitter Image
- **Нода "Привязка картинки"**: добавлены мета-поля:
  - `_yoast_wpseo_opengraph-image`
  - `_yoast_wpseo_twitter-image`
  - Оба ссылаются на `source_url` загруженной картинки.

---

## Что нужно сделать ВРУЧНУЮ

### Критично (до запуска)

1. **Создать 6 категорий в WordPress** (wp-admin → Записи → Рубрики):
   - AI Tools & Reviews
   - Контент и видимость
   - Подход и система
   - Цена и ценность
   - Действуй сейчас
   - Общее

   Запомнить ID каждой категории.

2. **Добавить поля в Airtable** (таблица "Темы для статей"):
   - `wp_category_id` (Single line text) — ID категории WordPress
   - `reading_time` (Single line text) — время чтения
   - `schema_type` (Single line text) — тип schema

3. **Заполнить `wp_category_id`** для существующих записей в Airtable или настроить логику в SEO-агенте.

4. **Добавить поле `wp_category_id` в ноду "Переменные"** главного воркфлоу — оно должно подтягиваться из Airtable записи. Сейчас нода "Переменные" не содержит это поле из Airtable, нужно добавить маппинг:
   ```
   wp_category_id = {{ $('Получение тем').item.json.wp_category_id }}
   ```

### Рекомендовано (после запуска)

5. **Добавить поля в Airtable для трекинга**:
   - `wp_post_id` (Number) — ID поста в WordPress
   - `published_at` (Date) — дата публикации
   - `word_count` (Number) — количество слов
   - `internal_links_count` (Number) — количество внутренних ссылок

6. **Сохранение wp_post_id** — добавить ноду после "Создание поста" которая пишет `$('Создание поста').item.json.id` обратно в Airtable. Это предотвратит дубли при повторном запуске.

7. **Теги WordPress (БЛОК 4.3)** — не реализовано, т.к. требует предварительного создания тегов через WP REST API. Варианты:
   - Создать теги вручную и хранить ID в Airtable
   - Добавить Code-ноду которая создаёт теги через API `POST /wp-json/wp/v2/tags`

8. **Улучшить Internal Links Resolver** — текущая версия использует `/?s=запрос` (страница поиска). Улучшенная версия:
   - Делает GET запрос к `https://switchonai.ru/wp-json/wp/v2/posts?search=ТЕМА&per_page=1`
   - Берёт URL первого результата
   - Если ничего не найдено — убирает плейсхолдер

   Это требует HTTP Request ноды вместо Code ноды, либо n8n Code node с `$http.get()`.

9. **CSS для новых элементов** — добавить в тему WordPress стили для:
   ```css
   .toc { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
   .toc ul { list-style: none; padding-left: 0; }
   .toc li { margin: 8px 0; }
   .toc a { text-decoration: none; color: #1a73e8; }
   .author-note { background: #f0f7ff; padding: 16px 20px; border-left: 4px solid #1a73e8; margin: 24px 0; border-radius: 0 8px 8px 0; }
   ```

---

## Как импортировать

1. В n8n: Settings → Import Workflow
2. Загрузить `workflow-14-upgraded.json` — **заменит** текущий воркфлоу #14
3. Загрузить `workflow-blog-dzen-vc-pikabu-telegraf-upgraded.json` — **заменит** главную автоматизацию
4. Проверить credentials — они сохранены по ID, должны подцепиться автоматически
5. Выполнить ручные шаги из списка выше
6. Тестовый запуск на одной теме

---

*Victor | 2026-03-28*
