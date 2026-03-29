# Гайд для агента-разработчика: switchonai.ru (новый сайт)
**Автор:** Лидия Родарте-Куайл (SEO-аудит)
**Дата:** 2026-03-29
**Для:** агента, который кодирует новый сайт

---

## 0. КОНТЕКСТ ПРОЕКТА

| Параметр | Значение |
|----------|----------|
| Домен | switchonai.ru |
| Владелец | Павел Лещенко, ИП, Санкт-Петербург |
| Тип | Персональный бренд / AI-автоматизация |
| CMS | WordPress |
| SEO-плагин | Yoast SEO (обязательно) |
| Сервер | nginx |
| Аудитория | RU |

---

## 1. СТРУКТУРА САЙТА (URL-архитектура)

### Обязательные страницы и их URL:

```
switchonai.ru/                    — главная (лендинг)
switchonai.ru/stati/              — блог (архив постов)
switchonai.ru/price/              — прайс/услуги
switchonai.ru/ai-komanda/         — продукт "AI Команда"
switchonai.ru/o-avtore/           — об авторе (НОВАЯ, критична для E-E-A-T)
switchonai.ru/category/[slug]/    — категории блога
switchonai.ru/oferta/             — оферта
switchonai.ru/privacy/            — политика конфиденциальности
switchonai.ru/soglasie/           — согласие на обработку данных
```

### Категории блога (6 штук, НЕ одна "Рубрика"):

| Slug | Название | Тема |
|------|----------|------|
| `/category/vnedrenie-ai/` | Внедрение AI | Внедрение AI в бизнес |
| `/category/avtomatizaciya-kontenta/` | Автоматизация контента | Контент-маркетинг |
| `/category/ai-instrumenty/` | AI-инструменты | ChatGPT, Claude, Make, боты |
| `/category/prodazhi/` | Продажи | AI в продажах, воронки |
| `/category/trafik/` | Трафик | YouTube, Pinterest, SEO |
| `/category/obuchenie/` | Обучение | Кейсы, гайды, обучение |

### URL-паттерн для статей:
- **Только русский транслит**, нижний регистр, дефисы
- Без цифр в конце (`-2`, `-3`) — дубли не допускаются
- Пример: `/vnedrenie-ai-v-malyj-biznes/`

---

## 2. ON-PAGE SEO — ТРЕБОВАНИЯ К КАЖДОЙ СТРАНИЦЕ

### Обязательные теги на КАЖДОЙ странице:

```html
<title>[Ключевое слово] — [Бренд/Контекст] | Включи ИИ</title>
<meta name="description" content="[120-160 символов, конкретная польза]">
<link rel="canonical" href="[полный URL страницы]">
<meta property="og:title" content="[то же что title]">
<meta property="og:description" content="[то же что description]">
<meta property="og:image" content="https://switchonai.ru/wp-content/uploads/og-image.jpg">
<meta property="og:url" content="[URL страницы]">
<meta property="og:type" content="website"> <!-- или article для постов -->
<meta name="twitter:card" content="summary_large_image">
```

### Title паттерны по типам страниц:

| Тип | Паттерн | Пример |
|-----|---------|--------|
| Главная | `[Бренд] — [Оффер]` | `Включи ИИ — AI-автоматизация для бизнеса` |
| Блог | `Блог об AI-автоматизации — Включи ИИ` | — |
| Статья | `[Тема статьи] — Включи ИИ` | `Внедрение AI в малый бизнес — Включи ИИ` |
| Прайс | `Стоимость AI-автоматизации — Включи ИИ` | — |
| Категория | `[Название категории]: статьи — Включи ИИ` | — |

### H1-H6 структура:
- **H1 — ровно ОДИН на странице**, всегда
- H1 ≠ Title (разные тексты, разные акценты)
- H2 — основные разделы контента
- H3 — подразделы внутри H2
- НЕ пропускать уровни (H1 → H3 без H2 — запрещено)
- **КРИТИЧНО:** H1 выводится только в ONE месте в теме (не в хедере И в контенте)

### OG Image:
- Размер: **1200×630 px** (обязательно)
- Формат: JPG или WebP
- Текст на изображении: название страницы + логотип
- Одно изображение по умолчанию для всего сайта + уникальные для ключевых страниц

---

## 3. ТЕХНИЧЕСКОЕ SEO — ТРЕБОВАНИЯ

### 3.1 nginx — обязательная конфигурация

В файл `/etc/nginx/sites-available/switchonai.ru` добавить:

```nginx
server {
    # Security headers — ВСЕ ОБЯЗАТЕЛЬНЫ
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Permissions-Policy "camera=(), microphone=(), geolocation=()" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Скрыть версию PHP
    fastcgi_hide_header X-Powered-By;

    # Закрыть xmlrpc.php
    location = /xmlrpc.php {
        deny all;
        access_log off;
        log_not_found off;
    }

    # Кэширование статики
    location ~* \.(jpg|jpeg|png|gif|webp|avif|ico|css|js|woff|woff2)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

### 3.2 WordPress — functions.php (Child Theme)

```php
<?php
// 1. Скрыть версию WordPress из meta
remove_action('wp_head', 'wp_generator');

// 2. Скрыть версию из URL стилей и скриптов
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

// 3. Убрать внешний старый jQuery (если тема тянет)
function fix_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery-old');
    }
}
add_action('wp_enqueue_scripts', 'fix_jquery', 100);

// 4. Убрать meta keywords (Yoast иногда оставляет пустые)
function remove_meta_keywords() {
    remove_action('wp_head', array($GLOBALS['wpseo_front'], 'head'), 1);
}

// 5. Правильный canonical для пагинации
function fix_pagination_canonical() {
    if (is_paged()) {
        $canonical = get_pagenum_link(get_query_var('paged'));
        echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";
    }
}

// 6. WebP поддержка в загрузчике
function add_webp_support($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('mime_types', 'add_webp_support');
add_filter('upload_mimes', 'add_webp_support');
```

### 3.3 Производительность — обязательные требования:

- **НЕ подключать jQuery с внешних CDN** — использовать встроенный WordPress jQuery
- Все изображения в **WebP или AVIF** (плагин ShortPixel или Imagify)
- **Lazy loading** для всех изображений: `loading="lazy"` атрибут
- Критичный CSS инлайном в `<head>`, остальное — defer/async
- Шрифты: `font-display: swap`
- Минификация JS/CSS: плагин LiteSpeed Cache или WP Rocket

### 3.4 Мобильность:
- Viewport meta обязателен: `<meta name="viewport" content="width=device-width, initial-scale=1">`
- Нет горизонтального скролла
- Touch targets ≥ 48×48px
- Размер шрифта ≥ 16px на мобильном

---

## 4. SCHEMA MARKUP — ЧТО И ГДЕ

### Главная страница — обязательные схемы:
- `Person` (Павел Лещенко)
- `ProfessionalService`
- `WebSite` + `SearchAction` (Yoast добавит автоматически)

### Страница /price/:
- `Service` с `hasOfferCatalog`
- `PriceSpecification`

### Страница /o-avtore/:
- `Person` (расширенная версия)
- `ProfilePage`

### Статьи блога (Yoast добавит автоматически):
- `Article` — ✅ Yoast
- `BreadcrumbList` — ✅ Yoast
- `FAQPage` — добавлять вручную для статей с FAQ-разделом
- `HowTo` — для инструкционных статей ("Как сделать X")

### JSON-LD для главной (добавить через WPCode плагин):
Смотри файл `schema-homepage.json` в этой папке.

---

## 5. ROBOTS.TXT — ФИНАЛЬНЫЙ

Смотри файл `robots.txt` в этой папке. Основные принципы:
- `Disallow: /page/` (только пагинация, НЕ `*page`)
- Заблокированы: `/wp-admin/`, `/wp-login.php`, `/xmlrpc.php`, `/search/`
- AI-кроулеры (GPTBot, ClaudeBot, PerplexityBot) — явно разрешены
- `author-sitemap.xml` — отключить в Yoast если `/author/` заблокирован

---

## 6. SITEMAP — ТРЕБОВАНИЯ

Настроить через Yoast SEO → Настройки → XML Sitemap:

| Sitemap | Включать | Исключать |
|---------|----------|-----------|
| post-sitemap.xml | Статьи блога | Черновики, приватные |
| page-sitemap.xml | Главная, /price/, /ai-komanda/, /o-avtore/ | /oferta/, /privacy/, /soglasie/ |
| category-sitemap.xml | 6 новых категорий | "Рубрика" |
| author-sitemap.xml | ОТКЛЮЧИТЬ | — |

**Не допускать:**
- Дублирование URL в разных sitemap
- Страниц с `noindex` в sitemap
- URL с параметрами (`?s=`, `?p=`)

---

## 7. GEO/AI ОПТИМИЗАЦИЯ

### llms.txt:
Создать файл по адресу `https://switchonai.ru/llms.txt`
Смотри готовый файл `llms.txt` в этой папке.

### robots.txt — AI-кроулеры:
В начало robots.txt добавить блоки для GPTBot, ClaudeBot, PerplexityBot.
Смотри файл `robots.txt`.

### Контент для AI-цитирования:
- FAQ-блоки в статьях (вопрос + чёткий ответ)
- Определения терминов в начале статей
- Структурированные списки (не монолитные абзацы)
- Автор + дата видны в разметке (для E-E-A-T)

---

## 8. WORDPRESS ПЛАГИНЫ — ОБЯЗАТЕЛЬНЫЙ НАБОР

| Плагин | Зачем | Приоритет |
|--------|-------|-----------|
| **Yoast SEO** | Все мета-теги, sitemap, breadcrumbs | 🔴 Критично |
| **WPCode** | Вставка JSON-LD schema без правки файлов | 🔴 Критично |
| **Redirection** | Управление 301-редиректами | 🔴 Критично |
| **Disable XML-RPC** | Безопасность | 🔴 Критично |
| **Site Kit by Google** | GA4 + Search Console | 🔴 Критично |
| **ShortPixel / Imagify** | WebP-конвертация изображений | 🟠 Высокий |
| **LiteSpeed Cache / WP Rocket** | Производительность | 🟠 Высокий |
| **WP All Export** | Экспорт статей для пакетной обработки | 🟡 Средний |

**НЕ устанавливать:**
- MonsterInsights (заменён на Site Kit)
- Несколько кэш-плагинов одновременно
- Плагины без обновлений > 1 года

---

## 9. НАСТРОЙКА YOAST SEO (сразу после установки)

1. **Общее → Панель знаний:**
   - Тип: Физическое лицо
   - Имя: Павел Лещенко
   - Должность: AI-автоматизатор, эксперт по автоматизации бизнеса
   - Логотип/фото: загрузить

2. **Типы контента:**
   - Записи: индексировать ✅
   - Страницы: индексировать ✅
   - Авторы: ОТКЛЮЧИТЬ (noindex)
   - Вложения/медиа: ОТКЛЮЧИТЬ (noindex)

3. **Таксономии:**
   - Категории: индексировать ✅
   - Теги: ОТКЛЮЧИТЬ (noindex, слишком много дублей)

4. **Breadcrumbs:** включить ✅

5. **XML Sitemap:**
   - author-sitemap: ОТКЛЮЧИТЬ
   - Добавить sitemap в Search Console после публикации

---

## 10. АНАЛИТИКА — ОБЯЗАТЕЛЬНО ДО ЗАПУСКА

1. Создать ресурс GA4 на analytics.google.com
2. Установить Site Kit by Google
3. Подключить: GA4 + Search Console + PageSpeed
4. Проверить: данные собираются (DevTools → Network → gtag)
5. Настроить событие: `contact_form_submit` (форма обратной связи)

---

## 11. КОНТРОЛЬНЫЙ СПИСОК ПЕРЕД ЗАПУСКОМ

### Техническое:
- [ ] HTTPS работает, редирект с HTTP
- [ ] robots.txt доступен и корректен
- [ ] sitemap_index.xml доступен
- [ ] llms.txt доступен
- [ ] Security headers настроены (проверить: securityheaders.com)
- [ ] xmlrpc.php закрыт
- [ ] PHP версия скрыта
- [ ] WordPress версия скрыта
- [ ] GA4 собирает данные
- [ ] Search Console подключена, sitemap отправлен

### On-Page:
- [ ] Каждая страница имеет уникальный title
- [ ] Каждая страница имеет уникальное meta description
- [ ] На каждой странице ровно один H1
- [ ] H1 и Title — разные тексты
- [ ] OG image установлен (1200×630)
- [ ] Canonical теги на всех страницах
- [ ] Нет страниц с `noindex` в sitemap

### Schema:
- [ ] Person schema на главной (проверить: search.google.com/test/rich-results)
- [ ] Service schema на главной
- [ ] Article schema на статьях (Yoast)
- [ ] BreadcrumbList работает

### Контент:
- [ ] Страница /o-avtore/ создана и заполнена
- [ ] 6 категорий созданы
- [ ] Нет статей в "Рубрике"
- [ ] Мета-описания заполнены для всех ключевых страниц

---

## 12. РАСПРОСТРАНЁННЫЕ ОШИБКИ — НЕ ПОВТОРЯТЬ

1. ❌ `Disallow: *page` в robots.txt → блокирует пагинацию
2. ❌ jQuery с внешнего CDN (ajax.googleapis.com)
3. ❌ H1 выводится дважды в теме
4. ❌ Title = H1 (должны различаться)
5. ❌ Meta description = Title (автогенерация Yoast)
6. ❌ Все статьи в одной категории
7. ❌ Статьи-дубли с суффиксами `-2`, `-3` в slug
8. ❌ author-sitemap.xml при заблокированном /author/
9. ❌ MonsterInsights без аутентификации
10. ❌ OG image отсутствует

---

*Документ подготовлен: 2026-03-29 | Lydia Rodarte-Quayle*
