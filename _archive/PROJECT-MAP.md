# PROJECT-MAP.md — Карта проекта Switch On AI

**Последнее обновление:** 2026-03-29
**Назначение:** Справочный файл для любого агента или разработчика. Описывает что где лежит и зачем.

---

## Общее

- **Проект:** Сайт и продуктовая экосистема "ВКЛЮЧИ ИИ" (Switch On AI)
- **Владелец:** Павел Лещенко (@Leshenko)
- **Домен:** switchonai.ru
- **Платформа:** WordPress на VPS (кастомная тема, без page builders)
- **Язык контента:** русский
- **GitHub:** `pashkacurl/Switch_on_AI_sait`

---

## Корень репозитория

| Файл/Папка | Что это | Статус |
|---|---|---|
| `CLAUDE.md` | Инструкции для Claude Code — архитектура, контекст, правила работы | Актуален |
| `README.md` | Точка входа, навигация по репо | Актуален |
| `PROJECT-MAP.md` | **Этот файл** — полная карта проекта | Актуален |
| `WORDPRESS_GUIDE.md` | Гайд по WordPress-теме | Актуален |
| `index.html` | Статичный прототип (blueprint дизайна, НЕ прод) | Legacy |
| `.gitignore` | Игнор IDE/OS файлов | — |

---

## `docs/` — Операционная документация (source of truth)

Главный рабочий слой документации. Читать в порядке нумерации.

| Файл | Содержание |
|---|---|
| `START-HERE.md` | **Точка входа** — что подтверждено, что нет, главные риски |
| `INDEX.md` | Карта всей документации |
| `PLANS.md` | Планы и роадмап |
| `PROJECT-STRUCTURE.md` | Описание структуры проекта (внутренний) |
| `DOCUMENTATION-STRUCTURE.md` | Описание структуры документации |
| `00-project-audit.md` | Аудит проекта |
| `01-market-and-competitor-research.md` | Рынок и конкуренты |
| `02-positioning-and-website-strategy.md` | Позиционирование и стратегия сайта |
| `03-sitemap-and-page-briefs.md` | Карта страниц и брифы |
| `04-content-architecture.md` | Архитектура контента |
| `05-design-principles.md` | Принципы дизайна |
| `06-technical-implementation-plan.md` | Технический план реализации |
| `07-seo-analytics-cro-plan.md` | SEO, аналитика, CRO |
| `08-launch-roadmap.md` | Роадмап запуска |
| `09-open-questions.md` | Открытые вопросы |
| `10-decision-log.md` | Лог принятых решений |
| `11-prioritized-backlog.md` | Бэклог задач |
| `12-master-plan.md` | Мастер-план |
| `13-detailed-decomposition.md` | Детальная декомпозиция задач |
| `14-execution-status.md` | Текущий статус исполнения |

### Подпапки `docs/`

| Папка | Содержание |
|---|---|
| `docs/wordpress/` | WordPress-специфичная документация |
| — `WORDPRESS-ARCHITECTURE.md` | Архитектура WP |
| — `WORDPRESS-AUDIT.md` | Аудит текущего WP |
| — `THEME-STRUCTURE.md` | Структура темы |
| — `CONTENT-MODEL.md` | Контент-модель |
| — `BLOG-SEO-STRUCTURE.md` | SEO-структура блога |
| — `PLUGIN-AUDIT.md` | Аудит плагинов |
| — `VPS-DEPLOYMENT-AND-MAINTENANCE.md` | Деплой и обслуживание VPS |
| `docs/seo/` | SEO-документация |
| — `GEO-AND-AI-SEARCH-VISIBILITY.md` | GEO и видимость в AI-поиске |
| `docs/design/` | Дизайн |
| — `VISUAL-PROBE-PLAN.md` | План визуальных проб |
| `docs/analytics/` | Аналитика (README-заглушка) |
| `docs/archive/` | Архивные документы |
| `docs/backlog/` | Бэклог (подробности) |
| `docs/content/` | Контент-стратегия |
| `docs/decisions/` | Принятые решения |
| `docs/engineering/` | Инженерные решения |
| `docs/launch/` | Запуск |
| `docs/project/` | Проектное управление |
| `docs/research/` | Исследования |
| `docs/sitemap/` | Структура сайта |
| `docs/strategy/` | Стратегия |

---

## `wordpress-theme/` — Кастомная WordPress-тема (ПРОД)

Ванильный стек: HTML + CSS + JS. Без фреймворков, без билдеров.

| Файл | Назначение |
|---|---|
| `style.css` | Все стили + WP metadata. CSS-переменные в `:root`. Палитра: чёрный `#000`, синий акцент `#69ace4`, шрифты Space Grotesk + Inter |
| `functions.php` | Настройка темы, enqueue скриптов, Customizer API (hero, контакты, соцсети), 3 widget areas в footer |
| `front-page.php` | Главная: hero + 8 секций через `get_template_part()` |
| `header.php` | Шапка: навигация, `wp_nav_menu()`, мобильное меню |
| `footer.php` | Подвал: виджеты, контакты из Customizer |
| `home.php` | Страница блога |
| `single.php` | Шаблон одиночной записи |
| `page.php` | Шаблон страницы |
| `archive.php` | Архив записей |
| `search.php` | Страница поиска |
| `searchform.php` | Форма поиска |
| `404.php` | Страница 404 |
| `index.php` | Фоллбэк-шаблон |
| `assets/js/main.js` | Vanilla JS: scroll-reveal (`.reveal` → `.active`), FAQ аккордеон, параллакс, мобильное меню |

### `wordpress-theme/template-parts/` — Секции главной страницы

| Файл | Секция |
|---|---|
| `section-problems.php` | Проблемы (боли ЦА) |
| `section-services.php` | Услуги |
| `section-process.php` | Процесс работы |
| `section-cases.php` | Кейсы |
| `section-training.php` | Обучение |
| `section-testimonials.php` | Отзывы |
| `section-faq.php` | FAQ |
| `section-cta.php` | Призыв к действию |
| `content.php` | Шаблон контента (общий) |
| `content-post.php` | Шаблон поста |
| `content-page.php` | Шаблон страницы |
| `content-none.php` | Ничего не найдено |

---

## `seo/` — SEO-документация и n8n воркфлоу

Перенесено из репо `switchonai-seo`.

| Файл | Содержание |
|---|---|
| `ACTION-PLAN.md` | SEO экшн-план |
| `AUTOMATION-SEO-UPGRADE.md` | ТЗ на доработку n8n воркфлоу (6 блоков) |
| `FULL-AUDIT-REPORT.md` | Полный SEO-аудит сайта |
| `UNIVERSAL-SEO-ARTICLE-GUIDE.md` | Гайд по написанию SEO-статей |
| `My_workflow_14_PATCHED.json` | Патченный воркфлоу #14 (категории) |

### `seo/workflows/` — Оригинальные n8n воркфлоу

| Файл | Что делает |
|---|---|
| `workflow-14.json` | YouTube → Темы → Perplexity → SEO-ядро → Airtable |
| `workflow-blog-dzen-vc-pikabu-telegraf.json` | Airtable → Статья → WordPress + Дзен + VC + Pikabu + Telegraph + Threads |

### `seo/upgraded/` — Доработанные воркфлоу (Victor, 2026-03-28)

| Файл | Что изменено |
|---|---|
| `workflow-14-upgraded.json` | +reading_time, +schema_type, +entity anchoring, +schema selection |
| `workflow-blog-dzen-vc-pikabu-telegraf-upgraded.json` | +фикс meta description, +категории, +ToC, +H2 keywords, +E-E-A-T блок, +Internal Links Resolver, +OG/Twitter image |
| `CHANGELOG.md` | Подробный лог изменений + список ручных TODO |

---

## `new-site-skeleton/` — Шаблоны для WordPress-настройки

| Файл | Назначение |
|---|---|
| `DEV-AGENT-GUIDE.md` | Гайд для AI-агентов по разработке |
| `functions-snippets.php` | PHP-сниппеты для `functions.php` |
| `llms.txt` | Файл для AI-краулеров (GPTBot, ClaudeBot и т.д.) |
| `nginx-security.conf` | Конфиг безопасности nginx |
| `robots.txt` | Шаблон robots.txt |
| `schema-homepage.json` | Schema.org разметка главной страницы |
| `yoast-settings-checklist.md` | Чеклист настройки Yoast SEO |

---

## `style-previews/` — Визуальные пробы дизайна

| Файл | Направление |
|---|---|
| `index.html` | Навигация по превью |
| `style-01-dark-system.html` | Тёмная система |
| `style-02-light-intelligence.html` | Светлый интеллект |
| `style-03-hybrid-pulse.html` | Гибридный пульс |
| `style-04-ranked-mix.html` | Ранжированный микс (утверждённая база) |
| `style-05-conversion-blueprint.html` | Конверсионный blueprint (кандидат) |
| `style-06-v1-visual-probe.html` | Визуальная проба v1 |
| `style-07-dark-fluid-probe.html` | Dark fluid проба |

---

## `iSite/` — Брендовая и бизнес-библиотека

Структурированное хранилище материалов бренда "ВКЛЮЧИ ИИ".

| Папка | Содержание |
|---|---|
| `01_Стратегия/` | Распаковка, брифинг 360, стратегическая сессия (PDF) |
| `02_Бизнес/` | Описание бизнеса (PDF) |
| `03_Брендинг/` | Брендбук (PDF) |
| `04_Операционные_цели/` | Чек-листы компании |
| `05_Медиа/` | Медиа-ассеты (см. ниже) |

### `iSite/05_Медиа/` — Медиафайлы

| Подпапка | Содержание |
|---|---|
| `Видео/` | Промо-видео |
| `Логотипы/` | Логотипы бренда (PNG) |
| `Обложки/` | Обложки для Telegram и др. |
| `Портреты/` | Фото/аватары Павла Лещенко |
| `Фоны/` | Фоновые изображения для сайта |

---

## `ВКЛЮЧИ ИИ/` — Продуктовый и контентный knowledge base

| Папка | Содержание |
|---|---|
| `Бот консультант/` | ТЗ на создание бота-консультанта |
| `Выступления/` | Материалы выступлений (ФБС 16 марта, нейросети для школьников) |
| `Конетнт/` | Контент-план, стили каруселей, промпты для статей, Threads, выгрузки TG |
| `Маркетинг/` | Позиционирование, оффер, контент-стратегия, ДНК клиента, JTBD, конкуренты |
| `Скиллы и инструкции/` | AI-скиллы (.skill), промпты, инструкции для TG-постов |
| `Статистика по контент заводу.md` | Метрики контент-завода |
| `Я/` | Личная распаковка Павла (бизнес + личность) |

### Ключевые файлы контента

| Файл | Зачем |
|---|---|
| `Конетнт/Статьи/Промпты для статей/` | Все промпты для n8n воркфлоу (статьи, SEO, картинки, адаптации) |
| `Конетнт/THREADS/` | Промпты для генерации Threads (CTA на TG и блог) |
| `Маркетинг/ОФФЕР v6.0.md` | Актуальный оффер |
| `Маркетинг/Позиционирование.md` | Позиционирование бренда |
| `Маркетинг/Контент-стратегия.md` | Контент-стратегия |
| `Маркетинг/ДНК КЛИЕНТА МАРТ.md` | Портрет клиента (март 2026) |
| `Маркетинг/Консультация с маркетологом/` | Транскрипции и разборы консультации (7 частей) |

---

## `Документация/` — Старый слой планирования (legacy/reference)

| Файл | Содержание |
|---|---|
| `00_README.md` | Навигация по старой документации |
| `01_Исследование_дизайна_сайтов.md` | Исследование дизайна |
| `02_3D_визуалы_и_анимации.md` | 3D и анимации |
| `03_WordPress_техническая_реализация.md` | Техническая реализация WP |
| `04_Этап_проектирования.md` | Проектирование |
| `05_Рабочий_документ_проекта.md` | Рабочий документ |
| `06_Структура_проекта.md` | Структура |
| `07_Исследование_конверсионной_модели_сайта_и_платформы.md` | Конверсионная модель |

> ⚠️ Это legacy-слой. Актуальная документация — в `docs/`.

---

## `Действующий сайт/` — Legacy CSS backup

| Файл | Что это |
|---|---|
| `main-style.css` | CSS действующего сайта (~5800 строк). Палитра: тёмный navy `#1C1F33`, зелёный `#4cd1a0`. Включает стили блога (с строки ~4913) |

> ⚠️ Палитра отличается от текущей WordPress-темы (чёрный/синий).

---

## Быстрая навигация для агентов

| Задача | Куда смотреть |
|---|---|
| Понять проект | `README.md` → `docs/START-HERE.md` → `CLAUDE.md` |
| Разрабатывать тему WP | `wordpress-theme/` + `WORDPRESS_GUIDE.md` + `docs/wordpress/` |
| SEO и автоматизация | `seo/` (аудиты, воркфлоу, CHANGELOG) |
| Настройка нового WP | `new-site-skeleton/` |
| Дизайн и стиль | `style-previews/` + `docs/design/` |
| Контент и промпты | `ВКЛЮЧИ ИИ/Конетнт/` |
| Маркетинг и стратегия | `ВКЛЮЧИ ИИ/Маркетинг/` + `docs/02-positioning-and-website-strategy.md` |
| Бренд и медиа | `iSite/` |
| Статус и бэклог | `docs/14-execution-status.md` + `docs/11-prioritized-backlog.md` |
