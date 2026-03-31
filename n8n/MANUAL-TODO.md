# Ручные доработки n8n воркфлоу

Всё что нужно сделать руками в WordPress, Airtable и n8n перед запуском обновлённых воркфлоу.

---

## 🔴 ДО ЗАПУСКА (критично)

### 1. Создать категории в WordPress

wp-admin → Записи → Рубрики. Создать:

| Название | Slug (предложение) |
|---|---|
| AI Tools & Reviews | ai-tools-reviews |
| Контент и видимость | content-visibility |
| Подход и система | approach-system |
| Цена и ценность | price-value |
| Действуй сейчас | act-now |
| Общее | general |

**После создания — запиши ID каждой рубрики** (виден в URL при наведении на рубрику: `tag_ID=XX`).

---

### 2. Исправить баг с категориями в ноде "Создание поста"

Ошибка: `categories[0] не принадлежит к типу integer`

WordPress REST API требует массив чисел, а нода передаёт строку.

**В ноде "Создание поста"** замени значение параметра `categories` на:

```
={{ [parseInt($('Переменные').item.json.wp_category_id) || 1] }}
```

Это:
- Конвертирует строку в число
- Если пусто — ставит `1` (дефолтная рубрика "Uncategorized")

**Альтернатива** — если знаешь ID нужной категории, захардкодь временно:
```
={{ [5] }}
```
(где `5` = ID нужной рубрики)

---

### 3. Добавить поля в Airtable

Таблица: **"Темы для статей"**

| Поле | Тип | Для чего |
|---|---|---|
| `wp_category_id` | Single line text | ID категории WordPress (число) |
| `reading_time` | Single line text | Время чтения ("7 минут") |
| `schema_type` | Single line text | Тип schema (Article / HowTo / FAQPage) |

---

### 4. Добавить маппинг в ноду "Переменные"

В главном воркфлоу, нода **"Переменные"** (Set node) — добавить новое поле:

| Имя поля | Значение |
|---|---|
| `wp_category_id` | `{{ $('Получение тем').item.json.wp_category_id }}` |

Без этого нода "Создание поста" не получит ID категории из Airtable.

---

### 5. Заполнить wp_category_id в Airtable

Для каждой темы в таблице "Темы для статей" проставь ID категории WordPress в поле `wp_category_id`.

Можно массово: если все статьи идут в одну категорию, заполни одним числом.

---

## 🟡 ПОСЛЕ ЗАПУСКА (важно)

### 6. Добавить CSS для новых элементов

В тему WordPress (или через Customizer → Дополнительный CSS) добавить:

```css
/* Table of Contents */
.toc {
  background: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  margin: 20px 0;
}
.toc ul {
  list-style: none;
  padding-left: 0;
}
.toc li {
  margin: 8px 0;
}
.toc a {
  text-decoration: none;
  color: #1a73e8;
}
.toc a:hover {
  text-decoration: underline;
}

/* Author Note (E-E-A-T) */
.author-note {
  background: #f0f7ff;
  padding: 16px 20px;
  border-left: 4px solid #1a73e8;
  margin: 24px 0;
  border-radius: 0 8px 8px 0;
}
.author-note p {
  margin: 0;
}
```

---

## 🟢 БЭКЛОГ (по мере необходимости)

### 7. Теги WordPress

Сейчас теги не проставляются автоматически. Два пути:

**Путь А — вручную:**
1. Создай 10-15 основных тегов в wp-admin
2. Запиши их ID
3. В ноде "Создание поста" добавь `tags` как массив ID

**Путь Б — автоматически:**
1. Добавь Code-ноду перед "Создание поста"
2. Она берёт `secondary_keywords`, делает POST к `/wp-json/wp/v2/tags` для каждого
3. Получает ID, передаёт в "Создание поста"

---

### 8. wp_post_id трекинг (защита от дублей)

Добавить ноду **после** "Привязка картинки" → Airtable Update:

| Поле Airtable | Значение |
|---|---|
| `wp_post_id` | `{{ $('Создание поста').item.json.id }}` |

Потом можно проверять: если `wp_post_id` есть — обновлять пост вместо создания нового.

Для этого в ноде "Создание поста" нужна ветвь:
- Если `wp_post_id` пусто → POST (создание)
- Если `wp_post_id` есть → PUT (обновление)

---

### 9. Улучшить Internal Links Resolver

Текущая версия ведёт на `/?s=запрос` (страница поиска). Лучше:

```javascript
// Улучшенная версия с реальным поиском по WP REST API
const content = $input.first().json.final_content;
const baseUrl = 'https://switchonai.ru';

const placeholders = [...content.matchAll(/\[INTERNAL_LINK: topic="([^"]+)" anchor="([^"]+)"\]/g)];

let resolved = content;

for (const match of placeholders) {
  const [full, topic, anchor] = match;

  try {
    const response = await this.helpers.httpRequest({
      method: 'GET',
      url: `${baseUrl}/wp-json/wp/v2/posts?search=${encodeURIComponent(topic)}&per_page=1`,
      json: true
    });

    if (response.length > 0) {
      resolved = resolved.replace(full, `<a href="${response[0].link}">${anchor}</a>`);
    } else {
      // Убираем плейсхолдер если ничего не найдено
      resolved = resolved.replace(full, anchor);
    }
  } catch (e) {
    resolved = resolved.replace(full, anchor);
  }
}

return [{
  json: { ...($input.first().json), final_content: resolved },
  binary: $input.first().binary
}];
```

---

### 10. Дополнительные поля Airtable для трекинга

| Поле | Тип | Для чего |
|---|---|---|
| `wp_post_id` | Number | ID поста в WP (для обновлений) |
| `published_at` | Date | Дата публикации |
| `word_count` | Number | Количество слов в статье |
| `internal_links_count` | Number | Сколько внутренних ссылок вставлено |

---

### 11. Динамическая schema разметка

Сейчас "GEO теги" всегда генерирует FAQPage schema. Можно расширить:

- Если `schema_type` = `HowTo` → генерировать HowTo schema
- Если `schema_type` = `FAQPage` → как сейчас
- Если `schema_type` = `Article` → Article schema

Это потребует доработки Code-ноды "GEO теги".
