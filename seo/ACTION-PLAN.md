# switchonai.ru — Детальный план доработок
**Дата:** 2026-03-28
**Платформа:** WordPress 6.9.4 + Yoast SEO v26.9 + nginx
**Приоритет:** Критично → Высокий → Средний → Низкий

---

## 🔴 БЛОК 1: КРИТИЧНО (исправить сегодня)

---

### 1.1 Настроить Google Analytics

**Проблема:**
MonsterInsights установлен, но не аутентифицирован. В коде сайта прямо написано:
```
"MonsterInsights в настоящее время не настроен на этом сайте.
Владелец сайта должен пройти аутентификацию в Google Analytics."
```
Данные не собираются с момента запуска. Весь трафик за всё время — потерян.

**Как исправить:**
1. Войти в WordPress → MonsterInsights → Настройки
2. Нажать "Подключить MonsterInsights"
3. Авторизоваться через Google-аккаунт
4. Выбрать ресурс Google Analytics 4 (или создать новый на analytics.google.com)
5. Проверить что счётчик появился в коде страницы (DevTools → Network → запросы к `google-analytics.com`)

**Альтернатива** (если MonsterInsights не устраивает):
- Удалить MonsterInsights
- Установить плагин "Site Kit by Google" — официальный плагин Google
- Подключает GA4 + Search Console + PageSpeed в одном месте

---

### 1.2 Закрыть xmlrpc.php

**Проблема:**
`xmlrpc.php` открыт и виден через заголовок `X-Pingback`. Используется для brute-force атак на WordPress.

**Как закрыть через nginx:**
Добавить в конфиг сервера (обычно `/etc/nginx/sites-available/switchonai.ru`):
```nginx
location = /xmlrpc.php {
    deny all;
    access_log off;
    log_not_found off;
}
```
Перезапустить nginx: `sudo nginx -s reload`

**Альтернатива через .htaccess** (если Apache):
```apache
<Files xmlrpc.php>
    Order Deny,Allow
    Deny from all
</Files>
```

**Альтернатива через WordPress-плагин:**
Установить "Disable XML-RPC" — закрывает одной кнопкой без доступа к серверу.

---

### 1.3 Добавить security headers в nginx

**Проблема:**
Все 6 ключевых security headers отсутствуют. Сайт уязвим к clickjacking, XSS, MIME-sniffing.

**Добавить в nginx.conf или в конфиг виртуального хоста:**
```nginx
# В блоке server {} или location /
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
add_header Permissions-Policy "camera=(), microphone=(), geolocation=()" always;
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
add_header X-XSS-Protection "1; mode=block" always;
```

После добавления: `sudo nginx -t && sudo nginx -s reload`

**Проверить результат:** https://securityheaders.com/?q=switchonai.ru

---

### 1.4 Скрыть версию PHP и WordPress

**Проблема:**
- `X-Powered-By: PHP/8.3.7` — раскрывает версию PHP атакующим
- `<meta name="generator" content="WordPress 6.9.4">` — раскрывает CMS и версию

**Скрыть PHP версию** (в nginx.conf):
```nginx
fastcgi_hide_header X-Powered-By;
```
Или в php.ini: `expose_php = Off`

**Скрыть WordPress версию** (в functions.php темы):
```php
// Убрать meta generator
remove_action('wp_head', 'wp_generator');

// Убрать версию из стилей и скриптов
function remove_wp_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'remove_wp_version_strings');
add_filter('style_loader_src', 'remove_wp_version_strings');
```

---

### 1.5 Исправить robots.txt

**Проблема:**
`Disallow: *page` блокирует все URL содержащие слово "page":
- Пагинация `/page/2/`, `/page/3/` и т.д. — заблокирована
- Любой URL с "page" в пути

**Текущий проблемный блок:**
```
Disallow: *page
```

**Что сделать:**
Заменить на конкретные правила:
```
Disallow: /page/
```
Это заблокирует только пагинацию (`/page/2/`), но не URL типа `/vnedrenie-ai-v-biznes-na-page/`.

**Также убрать конфликт с author-sitemap:**
Либо добавить в robots.txt:
```
Allow: /author/
```
Либо отключить author-sitemap в Yoast SEO → Настройки → Sitemap → Авторы.

**Итоговый исправленный блок для GoogleBot:**
```
User-agent: GoogleBot
Allow: */uploads
Allow:/*/*.js
Allow:/*/*.css
Allow: *.css?*
Allow:/wp-*.png
Allow:/wp-*.jpg
Allow:/wp-*.jpeg
Allow:/wp-*.gif
Allow:/wp-admin/admin-ajax.php
Disallow:/cgi-bin
Disallow:/?
Disallow:/wp-
Disallow:/wp/
Disallow:*?s=
Disallow:*&s=
Disallow:/search/
Disallow:/author/
Disallow:/users/
Disallow:/page/
Disallow:*/trackback
Disallow:*/feed
Disallow:*/rss
Disallow:*/embed
Disallow:*/wlwmanifest.xml
Disallow:/xmlrpc.php
```

---

## 🟠 БЛОК 2: ВЫСОКИЙ (в течение 1 недели)

---

### 2.1 Мета-описания для ключевых страниц

**Как заполнить в WordPress + Yoast:**
1. Открыть страницу в редакторе
2. В блоке Yoast SEO внизу → вкладка "SEO"
3. Заполнить поле "Meta description"

**Готовые тексты:**

**Страница /stati/ (Блог):**
- Title: `Блог — AI-автоматизация для бизнеса | Включи ИИ`
- Description: `Практические статьи по AI-автоматизации бизнеса: внедрение, контент-маркетинг, чат-боты, цифровые сотрудники. Опыт реальных внедрений от Павла Лещенко.`

**Страница /price/ (Прайс):**
- Title: `Стоимость AI-автоматизации — Включи ИИ | Павел Лещенко`
- H1: `Стоимость услуг по AI-автоматизации`
- Description: `Цены на внедрение AI-систем, автоматизацию контента и обучение. Бесплатный аудит — разберу вашу ситуацию и покажу, что автоматизировать в первую очередь.`

**Страница /ai-komanda/ (AI Команда):**
- Title: `AI Команда за 1 вечер — Включи ИИ`
- Description: `Соберите команду из AI-ассистентов за один вечер: AI-маркетолог, AI-продюсер, AI-SMM. Готовые инструменты для контента и продаж.`

**Главная страница (улучшить текущее):**
- Текущая: `"Внедряю AI-системы под ключ: контент, продажи и процессы — в одной управляемой системе."`
- Улучшенная: `Павел Лещенко — внедряю AI-системы под ключ для бизнеса и экспертов. Автоматизация контента, продаж и операций без хаоса. Бесплатный аудит.`

---

### 2.2 Добавить H1 на страницу /stati/

**Проблема:**
Страница блога полностью без H1. Google не понимает её тему.

**Как добавить через WordPress:**
1. Перейти: Страницы → Блог (или найти страницу, назначенную как страница блога в Настройки → Чтение)
2. Если страница блога — это архив постов `/stati/`, то нужно редактировать через тему или плагин
3. Через Yoast SEO можно задать title для архивов: SEO → Типы контента → Записи → Архивы

**Вариант через functions.php** (быстрее):
```php
// Добавить H1 на страницу архива постов
add_action('genesis_before_loop', function() {
    if (is_home()) {
        echo '<h1 class="archive-title">AI-автоматизация для бизнеса и экспертов — блог</h1>';
    }
});
```
Или через кастомный шаблон для страницы `/stati/`.

---

### 2.3 Исправить дублирующийся H1 в теме

**Проблема:**
H1 появляется дважды на каждой странице записи — баг темы `webmastercpit`.

**Как найти и исправить:**
1. Открыть тему в редакторе: Внешний вид → Редактор → файл `single.php` или `content.php`
2. Найти место где выводится `<h1>`
3. Удалить одно из двух вхождений (обычно дублируется в header и в основном контенте)

**Или через CSS** (быстрый фикс, не идеальный):
```css
/* Скрыть дублирующийся H1 в контенте */
.entry-content h1:first-child {
    display: none;
}
```
Но лучше исправить в PHP-шаблоне.

---

### 2.4 Добавить Schema разметку на главную

**Добавить через Yoast SEO → Настройки → Общее → Панель знаний:**
- Тип сайта: Физическое лицо
- Имя: Павел Лещенко
- Должность: AI-автоматизатор

**Дополнительно добавить через хук в functions.php или плагин "Schema & Structured Data for WP":**

```json
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Person",
      "@id": "https://switchonai.ru/#person",
      "name": "Павел Лещенко",
      "jobTitle": "AI-автоматизатор, эксперт по автоматизации бизнеса",
      "description": "Внедряю AI-системы под ключ для бизнеса и экспертов. Специализация: автоматизация контента, продаж и операционных процессов.",
      "url": "https://switchonai.ru/",
      "email": "SwitchOnAI@yandex.ru",
      "sameAs": [
        "https://t.me/Leshenko"
      ],
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Санкт-Петербург",
        "addressCountry": "RU"
      },
      "knowsAbout": [
        "AI-автоматизация",
        "ChatGPT",
        "Автоматизация контент-маркетинга",
        "Цифровые сотрудники",
        "Make.com",
        "Telegram-боты"
      ]
    },
    {
      "@type": "ProfessionalService",
      "@id": "https://switchonai.ru/#service",
      "name": "Включи ИИ — AI-автоматизация для бизнеса",
      "provider": {"@id": "https://switchonai.ru/#person"},
      "url": "https://switchonai.ru/",
      "description": "Внедрение AI-систем под ключ: автоматизация контента, продаж и бизнес-процессов",
      "areaServed": "RU",
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Услуги AI-автоматизации",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Внедрение автоматизации под ключ"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Автоматизация контент-маркетинга"
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Обучение AI-ассистентам"
            }
          }
        ]
      }
    }
  ]
}
```

**Как добавить в WordPress:**
Установить плагин "WPCode" (бесплатный) → добавить сниппет в `<head>` главной страницы.

---

### 2.5 Добавить og:image (Open Graph изображение)

**Проблема:**
При репосте в соцсети и мессенджеры — нет превью-картинки. Ссылки выглядят голыми.

**Как добавить через Yoast:**
1. Yoast SEO → Настройки → Общее → Панель знаний
2. Загрузить логотип организации

**Для главной страницы:**
1. Страницы → Главная → редактировать
2. Yoast SEO → Social → Facebook → загрузить изображение (1200×630 px)

**Рекомендуемое изображение:**
- Размер: 1200×630 px
- Текст на изображении: "Включи ИИ — AI-автоматизация для бизнеса"
- Фото Павла + логотип бренда

---

### 2.6 Заменить jQuery 1.7.1

**Проблема:**
Тема подключает `jquery-1.7.1.min.js` с внешнего CDN `ajax.googleapis.com`.
Версия 2011 года — устарела на 15 лет, содержит известные уязвимости.

**Как исправить:**
WordPress по умолчанию идёт со своей версией jQuery. Скорее всего тема принудительно подключает старую.

**Найти и убрать в functions.php темы:**
```php
// Найти что-то похожее на это и удалить:
wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
```

**Или заменить на встроенный WordPress jQuery:**
```php
// Убрать внешний jQuery и использовать встроенный WP
function replace_old_jquery() {
    if (!is_admin()) {
        wp_dequeue_script('jquery-old');
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'replace_old_jquery');
```

---

## 🟡 БЛОК 3: СРЕДНИЙ (в течение месяца)

---

### 3.1 Создать llms.txt

**Зачем:**
AI-поисковики (Perplexity, ChatGPT Search, Claude) сканируют llms.txt для понимания структуры сайта. Это прямо влияет на цитируемость бренда в AI-ответах.

**Создать файл** `/wp-content/uploads/llms.txt` или в корне сайта через FTP:

```
# switchonai.ru — Включи ИИ

> Экосистема AI-автоматизации для бизнеса и экспертов.
> Автор: Павел Лещенко, Санкт-Петербург.

## Об авторе
Павел Лещенко — практикующий AI-автоматизатор. Внедряю AI-системы
в реальные бизнес-процессы: контент, продажи, операционную работу.
Все решения тестирую на собственных проектах перед внедрением клиентам.

## Услуги
- Внедрение AI-автоматизации под ключ: https://switchonai.ru/
- Автоматизация контент-маркетинга: https://switchonai.ru/
- Обучение AI-командам: https://switchonai.ru/ai-komanda/
- Бесплатный аудит: https://switchonai.ru/

## Контакты
- Telegram: https://t.me/Leshenko
- Email: SwitchOnAI@yandex.ru

## Блог (практические материалы)
https://switchonai.ru/stati/

## Ключевые темы блога
- Внедрение AI в бизнес
- Автоматизация контента
- Цифровые сотрудники и AI-ассистенты
- ChatGPT, Claude, Make.com, Telegram-боты
- Автоматизация продаж
```

**Добавить в robots.txt ссылку:**
```
Llms-txt: https://switchonai.ru/llms.txt
```

---

### 3.2 Добавить AI-кроулеры в robots.txt

**Добавить в начало robots.txt:**
```
User-agent: GPTBot
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Amazonbot
Allow: /

User-agent: Applebot
Allow: /
```

---

### 3.3 Устранить каннибализацию статей

**Выявленные дубли:**

**Группа 1 — "Ошибки внедрения AI":**
- `/oshibki-vnedreniya-ai-v-biznes/`
- `/oshibki-vnedreniya-ai-v-biznes-2/`
- `/oshibki-vnedreniya-ii-v-biznese/`

**Действие:** Оставить одну лучшую статью (самую полную), остальные перенаправить через 301:
```
/oshibki-vnedreniya-ai-v-biznes-2/ → 301 → /oshibki-vnedreniya-ai-v-biznes/
/oshibki-vnedreniya-ii-v-biznese/ → 301 → /oshibki-vnedreniya-ai-v-biznes/
```

**Группа 2 — "Органическое продвижение YouTube":**
- `/organicheskoe-prodvizhenie-video-youtube/`
- `/organicheskoe-prodvizhenie-video-youtube-2/`
- `/organicheskoe-prodvizhenie-video-youtube-3/`

**Действие:** Объединить в одну полную статью. Остальные → 301.

**Группа 3 — "Operator AI":**
- `/operator-ai-v-biznese/`
- `/operator-ai-v-biznese-2/`

**Действие:** Объединить → 301.

**Группа 4 — Опечатка в slug:**
- `/avtomatizaciya-rutinnyh-zadach-s-pomoshchyu-ii/`
- `/avtomatizatsiya-rutinnyh-zadach-s-pomoschyu-ii/` (опечатка)

**Действие:** Второй URL → 301 → первый.

**Как настроить 301 в WordPress:**
Установить плагин "Redirection" (бесплатный) → добавить редиректы через интерфейс.

---

### 3.4 Создать структуру категорий

**Проблема:**
170+ статей в одной категории "Рубрика" — поисковик не понимает структуру сайта.

**Предлагаемые категории:**

| Категория | Slug | Примерные статьи |
|-----------|------|-----------------|
| Внедрение AI | `/category/vnedrenie-ai/` | Статьи про внедрение AI в бизнес |
| Автоматизация контента | `/category/avtomatizaciya-kontenta/` | Контент-маркетинг, публикации |
| AI-инструменты | `/category/ai-instrumenty/` | ChatGPT, Claude, Make, боты |
| Продажи и лидогенерация | `/category/prodazhi/` | AI в продажах, лиды, воронки |
| Pinterest и YouTube | `/category/trafik/` | Продвижение видео, Pinterest |
| Обучение и развитие | `/category/obuchenie/` | Обучение, кейсы, истории |

**Как создать:**
1. WordPress → Записи → Категории → добавить 6 новых
2. Пройтись по статьям и расставить по категориям (можно через "Быстрое редактирование")
3. Удалить или оставить "Рубрика" как базовую, перенаправив `/category/rubrika/` → `/stati/`

---

### 3.5 Убрать meta keywords

**Сейчас на главной:**
```html
<meta name="keywords" content="Главная страница" />
```

Мета-тег keywords Google игнорирует с 2009 года. Но "Главная страница" — это индикатор незаполненного шаблона.

**Как убрать:**
Через Yoast SEO → настройки отдельной страницы → удалить содержимое поля Keywords.
Или отключить вывод keywords полностью в настройках темы.

---

### 3.6 Отключить author-sitemap

**Если не планируете разблокировать страницы авторов:**

В Yoast SEO:
1. Yoast SEO → Настройки → Типы контента
2. Найти "Авторы" / "Страницы авторов"
3. Отключить индексацию и включение в sitemap

---

### 3.7 Исправить inconsistency URL

**Проблема:**
Большинство URL — русский транслит, некоторые — английские:
```
Русский: /vnedrenie-ai-biznes-avtomatizaciya-rutiny/
Английский: /scalable-content-system-constructor-principle/
```

**Решение:**
Определиться с одним стандартом. Рекомендую: **русский транслит** (аудитория русскоязычная).

Для переименования URL старых статей:
1. Изменить slug в WordPress (редактор статьи → Permalink)
2. Добавить 301 redirect со старого URL на новый (плагин Redirection)
3. Обновить внутренние ссылки

> ⚠️ Не переименовывать массово без настройки 301 — потеряете ссылочный вес и трафик.

---

## 🟢 БЛОК 4: НИЗКИЙ (бэклог)

---

### 4.1 Уникальные мета-описания для 170+ статей

**Масштаб задачи:** Большой. Не делать вручную — потратить время на шаблон.

**Подход:**
1. Выгрузить все URL и заголовки статей (через Yoast → Export или плагин "WP All Export")
2. Написать шаблон промпта для AI: `"Напиши мета-описание 120-160 символов для статьи о [тема]"`
3. Сгенерировать описания пакетом
4. Загрузить обратно через WP All Import

**Формат описания для статей:**
```
[Конкретный результат или польза] — [как этого достичь]. Практический опыт Павла Лещенко.
```

Пример:
```
Внедряете AI в бизнес и боитесь ошибиться? Разбираю 7 типичных ошибок
внедрения с реальными примерами и способами их избежать.
```

---

### 4.2 FAQ Schema для статей

Статьи с вопросами в заголовках H2 — кандидаты на FAQ schema.
Это даёт расширенные сниппеты в Google (аккордеон под результатом).

**Плагин для автоматизации:** "Rank Math SEO" (имеет встроенную FAQ schema)
Или добавлять вручную в конец каждой статьи через Yoast SEO → Schema → FAQ.

---

### 4.3 HowTo Schema для инструкционных статей

Статьи типа "Как сделать X" — добавить HowTo schema.
Даёт rich results со шагами прямо в выдаче.

Подходящие статьи:
- `/kak-sozdat-kombinirovannuyu-rol-dlya-chatgpt/`
- `/kak-naznachat-roli-v-chatgpt/`
- `/kak-obedinit-ai-pomoshhnikov-v-komandu/`

---

### 4.4 Перевести изображения в WebP/AVIF

**Плагин:** "Smush" или "ShortPixel Image Optimizer"
- Автоматически конвертируют JPG/PNG → WebP при загрузке
- Пересжимают существующие изображения
- Влияет на LCP (Largest Contentful Paint)

---

### 4.5 Google Business Profile

**Зачем:** Появление в Google Maps + локальный поиск "AI автоматизация Санкт-Петербург"

**Шаги:**
1. Перейти на business.google.com
2. Добавить бизнес: "Включи ИИ / Павел Лещенко"
3. Категория: "Консультант по информационным технологиям"
4. Адрес: Санкт-Петербург (или SAB — без физической точки)
5. Добавить: описание, фото, ссылку на сайт, часы работы

---

### 4.6 Страница "Об авторе" / Разблокировать author page

**Сейчас:** `/author/` заблокирован в robots.txt — страница автора не индексируется.

**Что сделать:**
1. Разблокировать `/author/` в robots.txt
2. Заполнить профиль автора в WordPress: Пользователи → Ваш профиль → Биография
3. Добавить ссылки на соцсети
4. Это усиливает E-E-A-T (Google видит реального автора с биографией)

---

### 4.7 Кейсы клиентов

**Зачем:** Главный недостаток E-E-A-T — нет доказательств результатов.

**Что сделать:**
- Создать раздел `/kejsy/` или добавить кейсы на главную
- Формат: клиент (анонимно) → задача → решение → результат в цифрах
- Пример: "Производственная компания, 5 сотрудников — автоматизировали контент-отдел → -40 часов в месяц на ручной работе"

---

## 📋 ЧЕКЛИСТ ВНЕДРЕНИЯ

### День 1 (критично, ~2-3 часа)
- [ ] Настроить Google Analytics через MonsterInsights или Site Kit
- [ ] Закрыть xmlrpc.php (плагин "Disable XML-RPC" — 5 минут)
- [ ] Добавить security headers в nginx (код выше)
- [ ] Скрыть PHP версию (`fastcgi_hide_header X-Powered-By`)
- [ ] Убрать WordPress meta generator (код в functions.php выше)
- [ ] Исправить `Disallow: *page` → `Disallow: /page/` в robots.txt

### Неделя 1 (высокий приоритет, ~8-10 часов)
- [ ] Прописать мета-описания для /stati/, /price/, /ai-komanda/ (готовые тексты выше)
- [ ] Добавить H1 на /stati/
- [ ] Исправить дублирующийся H1 в теме
- [ ] Добавить Person + Service schema на главную (готовый JSON-LD выше)
- [ ] Добавить og:image на главную (1200×630 px)
- [ ] Заменить jQuery 1.7.1 на встроенный WP jQuery
- [ ] Отключить author-sitemap в Yoast

### Неделя 2–3 (средний приоритет, ~6-8 часов)
- [ ] Создать llms.txt (готовый текст выше)
- [ ] Добавить AI-кроулеры в robots.txt (готовый код выше)
- [ ] Настроить 301 для дублей статей (плагин Redirection)
- [ ] Создать 6 категорий и расставить статьи
- [ ] Убрать meta keywords с главной
- [ ] Исправить title /price/ и /ai-komanda/

### Месяц 2 (рост, приоритет по времени)
- [ ] Мета-описания для 170+ статей (пакетная генерация через AI)
- [ ] FAQ schema для 10-20 подходящих статей
- [ ] HowTo schema для инструкционных статей
- [ ] Установить Smush/ShortPixel — перевести изображения в WebP
- [ ] Создать Google Business Profile
- [ ] Разблокировать /author/ и заполнить профиль автора
- [ ] Написать 3-5 кейсов

---

## 🔧 РЕКОМЕНДУЕМЫЕ ПЛАГИНЫ WordPress

| Плагин | Для чего | Цена |
|--------|----------|------|
| WPCode | Вставка кода (JSON-LD schema) без правки файлов | Бесплатный |
| Redirection | Управление 301-редиректами | Бесплатный |
| Disable XML-RPC | Закрыть xmlrpc.php | Бесплатный |
| Site Kit by Google | GA4 + Search Console официально | Бесплатный |
| ShortPixel | Конвертация изображений в WebP | Бесплатный/платный |
| WP All Export | Выгрузка статей для пакетной обработки | Бесплатный |

---

*Документ подготовлен: 2026-03-28 | switchonai.ru | Lydia Rodarte-Quayle*
