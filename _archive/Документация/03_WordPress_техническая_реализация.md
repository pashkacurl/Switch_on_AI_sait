# WordPress: Техническая реализация

> Дата создания: 23 января 2026
> Проект: Switch On AI / Включи ИИ

---

## Рекомендуемый стек

### Тема
**Astra + Elementor Pro** — лучший баланс гибкости и скорости

| Компонент | Выбор | Цена |
|-----------|-------|------|
| Тема | Astra (бесплатная) | $0 |
| Page Builder | Elementor Pro | $59/год |
| 3D Integration | Nexter Blocks | $0 |
| Animations | Motion.page или GSAP | $69 / $0 |

**Альтернативы:**
- Flavor Theme (премиум) — $59, готовые тёмные демо
- flavor flavor Theme (премиум) — $69, отличные темплейты
- flavor flavor flavor (бесплатная) — для полной кастомизации

---

## Рекомендуемые плагины

### Обязательные

| Плагин | Функция | Цена |
|--------|---------|------|
| **Elementor Pro** | Конструктор страниц | $59/год |
| **Rank Math** | SEO-оптимизация | Бесплатно |
| **WP Rocket** / **LiteSpeed Cache** | Кэширование | $59/год / $0 |
| **ShortPixel** | Сжатие изображений | Бесплатно (100/мес) |

### Для 3D и анимаций

| Плагин | Функция | Цена |
|--------|---------|------|
| **Nexter Blocks** | Spline 3D Embed | Бесплатно |
| **AKDev Spline Animation** | Scroll для Spline | Бесплатно |
| **Motion.page** | Визуальный GSAP | $69 |
| **JetElements** | Анимированные виджеты | $24/год |

### Для форм и интеграций

| Плагин | Функция | Цена |
|--------|---------|------|
| **Elementor Forms** | Формы захвата | В Elementor Pro |
| **FluentCRM** | Email-маркетинг | Бесплатно |
| **WP Webhooks** | Интеграции | Бесплатно |
| **Jetelements Popup Builder** | Попапы | В JetElements |

### Для блога и RSS

| Плагин | Функция | Цена |
|--------|---------|------|
| **flavor flavor flavor flavor flavor flavor** | RSS фиды | Бесплатно |
| **flavor flavor** | RSS агрегация | Бесплатно |
| **flavor flavor** | Auto-posting | $49 |

### Для производительности

| Плагин | Функция | Цена |
|--------|---------|------|
| **Perfmatters** | Отключение ненужного | $25 |
| **Asset CleanUp** | Удаление скриптов | Бесплатно |
| **Autoptimize** | Минификация | Бесплатно |

---

## Структура сайта

```
switchonai.ru/
├── / (Главная)
├── /services/
│   ├── /content-factory/ (Контент-завод)
│   ├── /chatbots/ (Чат-боты)
│   ├── /automation/ (Комплексная автоматизация)
│   └── /training/ (Обучение по AI)
├── /cases/ (Кейсы)
├── /about/ (О компании)
├── /blog/ (Блог)
├── /contacts/ (Контакты)
└── /privacy-policy/ (Политика конфиденциальности)
```

---

## Настройка темы

### Цветовая схема (CSS переменные)

Добавить в `Customizer → Additional CSS` или в файл `style.css`:

```css
:root {
  /* Фоны */
  --bg-primary: #0a0c1c;
  --bg-secondary: #1a1a2e;
  --bg-card: #0f1129;
  --bg-card-hover: #151833;

  /* Текст */
  --text-primary: #ffffff;
  --text-secondary: #9a9a9a;
  --text-muted: #6a6a7a;

  /* Акценты */
  --accent-blue: #5568f5;
  --accent-blue-light: #7a8af7;
  --accent-purple: #a234fd;
  --accent-yellow: #ffd669;
  --accent-green: #18E896;
  --accent-red: #ff4757;

  /* Градиенты */
  --gradient-primary: linear-gradient(135deg, #5568f5, #a234fd);
  --gradient-secondary: linear-gradient(135deg, #1a1a2e, #0a0c1c);

  /* Тени */
  --shadow-card: 0 4px 20px rgba(0, 0, 0, 0.3);
  --shadow-glow: 0 0 30px rgba(85, 104, 245, 0.3);

  /* Границы */
  --border-subtle: 1px solid rgba(85, 104, 245, 0.2);
  --border-radius-sm: 8px;
  --border-radius-md: 16px;
  --border-radius-lg: 24px;
  --border-radius-full: 40px;

  /* Переходы */
  --transition-fast: 0.2s ease;
  --transition-normal: 0.3s ease;
  --transition-slow: 0.5s ease;
}

/* Базовые стили */
body {
  background-color: var(--bg-primary);
  color: var(--text-primary);
  font-family: 'Inter', sans-serif;
  font-size: 16px;
  line-height: 1.6;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  color: var(--text-primary);
}

a {
  color: var(--accent-blue);
  text-decoration: none;
  transition: var(--transition-fast);
}

a:hover {
  color: var(--accent-blue-light);
}
```

### Типографика

Добавить в `functions.php`:

```php
function enqueue_google_fonts() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');
```

CSS для типографики:

```css
/* Заголовки */
h1 {
  font-size: clamp(36px, 5vw, 72px);
  line-height: 1.1;
  letter-spacing: -0.02em;
}

h2 {
  font-size: clamp(28px, 4vw, 48px);
  line-height: 1.2;
}

h3 {
  font-size: clamp(22px, 3vw, 32px);
  line-height: 1.3;
}

/* Параграфы */
p {
  font-size: clamp(16px, 1.2vw, 18px);
  line-height: 1.7;
  color: var(--text-secondary);
}

/* Большой текст */
.text-large {
  font-size: clamp(18px, 1.5vw, 22px);
}

/* Малый текст */
.text-small {
  font-size: 14px;
  color: var(--text-muted);
}
```

---

## Компоненты UI

### Кнопки

```css
/* Primary Button */
.btn-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 16px 32px;
  background: var(--gradient-primary);
  color: var(--text-primary);
  font-family: 'Montserrat', sans-serif;
  font-weight: 600;
  font-size: 16px;
  border: none;
  border-radius: var(--border-radius-full);
  cursor: pointer;
  transition: var(--transition-normal);
  text-decoration: none;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-glow);
}

.btn-primary:active {
  transform: translateY(0);
}

/* Secondary Button */
.btn-secondary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 14px 30px;
  background: transparent;
  color: var(--accent-blue);
  font-family: 'Montserrat', sans-serif;
  font-weight: 600;
  font-size: 16px;
  border: 2px solid var(--accent-blue);
  border-radius: var(--border-radius-full);
  cursor: pointer;
  transition: var(--transition-normal);
  text-decoration: none;
}

.btn-secondary:hover {
  background: var(--accent-blue);
  color: var(--text-primary);
}

/* Ghost Button */
.btn-ghost {
  padding: 14px 30px;
  background: rgba(85, 104, 245, 0.1);
  color: var(--accent-blue);
  border: none;
  border-radius: var(--border-radius-full);
  transition: var(--transition-normal);
}

.btn-ghost:hover {
  background: rgba(85, 104, 245, 0.2);
}
```

### Карточки

```css
/* Service Card */
.service-card {
  background: var(--bg-card);
  border: var(--border-subtle);
  border-radius: var(--border-radius-lg);
  padding: 32px;
  transition: var(--transition-normal);
  cursor: pointer;
}

.service-card:hover {
  background: var(--bg-card-hover);
  border-color: var(--accent-blue);
  transform: translateY(-4px);
  box-shadow: var(--shadow-glow);
}

.service-card__icon {
  width: 64px;
  height: 64px;
  background: var(--gradient-primary);
  border-radius: var(--border-radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  font-size: 28px;
}

.service-card__title {
  font-size: 24px;
  margin-bottom: 12px;
}

.service-card__description {
  color: var(--text-secondary);
  margin-bottom: 20px;
}

.service-card__link {
  color: var(--accent-blue);
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.service-card__link:hover {
  gap: 12px;
}

/* Glass Card */
.glass-card {
  background: rgba(26, 26, 46, 0.6);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: var(--border-radius-lg);
  padding: 32px;
}
```

### Секции

```css
/* Section Base */
.section {
  padding: 100px 0;
  position: relative;
  overflow: hidden;
}

.section--dark {
  background: var(--bg-primary);
}

.section--gradient {
  background: var(--gradient-secondary);
}

/* Section Header */
.section__header {
  text-align: center;
  max-width: 700px;
  margin: 0 auto 60px;
}

.section__subtitle {
  color: var(--accent-blue);
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 16px;
}

.section__title {
  margin-bottom: 20px;
}

.section__description {
  color: var(--text-secondary);
  font-size: 18px;
}

/* Container */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.container--narrow {
  max-width: 900px;
}

.container--wide {
  max-width: 1400px;
}
```

---

## Подключение GSAP

### В functions.php:

```php
<?php
/**
 * Подключение GSAP и ScrollTrigger
 */
function enqueue_gsap_scripts() {
    // GSAP Core
    wp_enqueue_script(
        'gsap-core',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );

    // ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array('gsap-core'),
        '3.12.5',
        true
    );

    // Кастомные анимации
    wp_enqueue_script(
        'site-animations',
        get_stylesheet_directory_uri() . '/assets/js/animations.js',
        array('gsap-core', 'gsap-scrolltrigger'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_gsap_scripts');
```

### Файл animations.js:

Создать файл `wp-content/themes/flavor-flavor-flavor/assets/js/animations.js`:

```javascript
/**
 * GSAP Animations for Switch On AI
 */

// Ждём загрузку DOM
document.addEventListener('DOMContentLoaded', function() {

  // Регистрируем ScrollTrigger
  gsap.registerPlugin(ScrollTrigger);

  // ===== FADE-IN АНИМАЦИИ =====
  // Все элементы с классом .fade-in появляются при скролле
  gsap.utils.toArray('.fade-in').forEach(elem => {
    gsap.from(elem, {
      scrollTrigger: {
        trigger: elem,
        start: "top 85%",
        toggleActions: "play none none none"
      },
      opacity: 0,
      y: 40,
      duration: 0.8,
      ease: "power2.out"
    });
  });

  // ===== FADE-IN СЛЕВА =====
  gsap.utils.toArray('.fade-in-left').forEach(elem => {
    gsap.from(elem, {
      scrollTrigger: {
        trigger: elem,
        start: "top 85%"
      },
      opacity: 0,
      x: -50,
      duration: 0.8,
      ease: "power2.out"
    });
  });

  // ===== FADE-IN СПРАВА =====
  gsap.utils.toArray('.fade-in-right').forEach(elem => {
    gsap.from(elem, {
      scrollTrigger: {
        trigger: elem,
        start: "top 85%"
      },
      opacity: 0,
      x: 50,
      duration: 0.8,
      ease: "power2.out"
    });
  });

  // ===== STAGGER ДЛЯ КАРТОЧЕК =====
  // Карточки появляются последовательно
  const cardContainers = gsap.utils.toArray('.cards-stagger');
  cardContainers.forEach(container => {
    const cards = container.querySelectorAll('.service-card, .card');
    gsap.from(cards, {
      scrollTrigger: {
        trigger: container,
        start: "top 75%"
      },
      opacity: 0,
      y: 50,
      stagger: 0.15,
      duration: 0.6,
      ease: "power2.out"
    });
  });

  // ===== HERO СЕКЦИЯ =====
  const heroTimeline = gsap.timeline({ delay: 0.3 });

  if (document.querySelector('.hero')) {
    heroTimeline
      .from('.hero__title', {
        opacity: 0,
        y: 30,
        duration: 0.8,
        ease: "power2.out"
      })
      .from('.hero__subtitle', {
        opacity: 0,
        y: 20,
        duration: 0.6,
        ease: "power2.out"
      }, "-=0.4")
      .from('.hero__cta', {
        opacity: 0,
        scale: 0.9,
        duration: 0.5,
        ease: "back.out(1.7)"
      }, "-=0.3")
      .from('.hero__3d', {
        opacity: 0,
        scale: 0.8,
        duration: 1,
        ease: "power2.out"
      }, "-=0.6");
  }

  // ===== ПАРАЛЛАКС ЭФФЕКТ =====
  gsap.utils.toArray('.parallax-bg').forEach(bg => {
    gsap.to(bg, {
      scrollTrigger: {
        trigger: bg,
        start: "top bottom",
        end: "bottom top",
        scrub: 1
      },
      y: -80,
      ease: "none"
    });
  });

  // ===== СЧЁТЧИКИ (ANIMATING NUMBERS) =====
  gsap.utils.toArray('.counter').forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target'));

    gsap.to(counter, {
      scrollTrigger: {
        trigger: counter,
        start: "top 80%",
        toggleActions: "play none none none"
      },
      innerHTML: target,
      duration: 2,
      snap: { innerHTML: 1 },
      ease: "power1.out"
    });
  });

  // ===== ПРОГРЕСС-БАР ПРИ СКРОЛЛЕ =====
  if (document.querySelector('.progress-bar')) {
    gsap.to('.progress-bar', {
      scrollTrigger: {
        trigger: document.body,
        start: "top top",
        end: "bottom bottom",
        scrub: true
      },
      scaleX: 1,
      transformOrigin: "left center",
      ease: "none"
    });
  }

  // ===== HEADER SCROLL EFFECT =====
  const header = document.querySelector('.site-header');
  if (header) {
    ScrollTrigger.create({
      start: "top -80",
      onUpdate: (self) => {
        if (self.direction === 1) {
          header.classList.add('header--scrolled');
        } else if (self.scroll() < 100) {
          header.classList.remove('header--scrolled');
        }
      }
    });
  }

  // ===== REVEAL TEXT (МАСКА) =====
  gsap.utils.toArray('.reveal-text').forEach(text => {
    gsap.from(text, {
      scrollTrigger: {
        trigger: text,
        start: "top 80%"
      },
      clipPath: "inset(0 100% 0 0)",
      duration: 1,
      ease: "power2.inOut"
    });
  });

  // ===== REFRESH SCROLLTRIGGER =====
  // После загрузки всех изображений
  window.addEventListener('load', () => {
    ScrollTrigger.refresh();
  });

});
```

---

## Интеграция Spline 3D

### Через HTML виджет в Elementor:

```html
<!-- Spline 3D Viewer -->
<div class="spline-wrapper">
  <script type="module" src="https://unpkg.com/@splinetool/viewer@1.0.54/build/spline-viewer.js"></script>
  <spline-viewer
    url="https://prod.spline.design/YOUR-SCENE-ID/scene.splinecode"
    loading="lazy"
    events-target="global">
  </spline-viewer>
</div>

<style>
.spline-wrapper {
  width: 100%;
  height: 500px;
  position: relative;
}

.spline-wrapper spline-viewer {
  width: 100%;
  height: 100%;
}

/* Mobile fallback */
@media (max-width: 768px) {
  .spline-wrapper {
    display: none;
  }
  .spline-fallback {
    display: block;
  }
}
</style>
```

### CSS для Spline в Hero:

```css
.hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  overflow: hidden;
}

.hero__content {
  position: relative;
  z-index: 2;
  max-width: 600px;
}

.hero__3d {
  position: absolute;
  top: 50%;
  right: 5%;
  transform: translateY(-50%);
  width: 45%;
  height: 80%;
  z-index: 1;
}

@media (max-width: 1024px) {
  .hero__3d {
    position: relative;
    width: 100%;
    height: 400px;
    right: auto;
    transform: none;
    margin-top: 40px;
  }

  .hero {
    flex-direction: column;
    text-align: center;
    padding-top: 120px;
  }
}
```

---

## Настройка блога и RSS

### Кастомизация блога:

```css
/* Blog Cards */
.blog-card {
  background: var(--bg-card);
  border-radius: var(--border-radius-lg);
  overflow: hidden;
  transition: var(--transition-normal);
}

.blog-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-card);
}

.blog-card__image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.blog-card__content {
  padding: 24px;
}

.blog-card__category {
  color: var(--accent-blue);
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 12px;
}

.blog-card__title {
  font-size: 20px;
  margin-bottom: 12px;
  line-height: 1.3;
}

.blog-card__excerpt {
  color: var(--text-secondary);
  font-size: 14px;
  margin-bottom: 16px;
}

.blog-card__meta {
  display: flex;
  align-items: center;
  gap: 16px;
  font-size: 13px;
  color: var(--text-muted);
}
```

### RSS настройки в functions.php:

```php
<?php
/**
 * Кастомизация RSS
 */

// Добавить изображения в RSS
function add_featured_image_to_rss($content) {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '<p>' . get_the_post_thumbnail($post->ID, 'medium') . '</p>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'add_featured_image_to_rss');
add_filter('the_content_feed', 'add_featured_image_to_rss');

// Количество записей в RSS
function change_rss_post_limit($query) {
    if ($query->is_feed) {
        $query->set('posts_per_rss', 20);
    }
    return $query;
}
add_filter('pre_get_posts', 'change_rss_post_limit');
```

---

## Оптимизация производительности

### Отложенная загрузка скриптов:

```php
<?php
/**
 * Defer/Async для скриптов
 */
function add_defer_async_attributes($tag, $handle) {
    $scripts_to_defer = array('gsap-core', 'gsap-scrolltrigger', 'site-animations');
    $scripts_to_async = array();

    if (in_array($handle, $scripts_to_defer)) {
        return str_replace(' src', ' defer src', $tag);
    }

    if (in_array($handle, $scripts_to_async)) {
        return str_replace(' src', ' async src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_defer_async_attributes', 10, 2);
```

### Preload для критичных ресурсов:

```php
<?php
/**
 * Preload шрифтов
 */
function add_preload_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@600;700;800&display=swap" as="style">';
}
add_action('wp_head', 'add_preload_fonts', 1);
```

### Critical CSS (inline):

Добавить в `<head>` критичные стили для первого экрана:

```php
<?php
/**
 * Inline Critical CSS
 */
function add_critical_css() {
    ?>
    <style id="critical-css">
      :root{--bg-primary:#0a0c1c;--text-primary:#fff;--accent-blue:#5568f5}
      body{background:var(--bg-primary);color:var(--text-primary);margin:0;font-family:Inter,sans-serif}
      .hero{min-height:100vh;display:flex;align-items:center}
      .container{max-width:1200px;margin:0 auto;padding:0 20px}
    </style>
    <?php
}
add_action('wp_head', 'add_critical_css', 1);
```

---

## Чеклист запуска

### Перед запуском:

- [ ] Установить и настроить тему Astra
- [ ] Установить Elementor Pro
- [ ] Установить все необходимые плагины
- [ ] Создать child-theme для кастомизаций
- [ ] Добавить CSS переменные
- [ ] Подключить Google Fonts
- [ ] Подключить GSAP + ScrollTrigger
- [ ] Настроить цвета в Customizer
- [ ] Создать все страницы
- [ ] Настроить меню
- [ ] Создать формы
- [ ] Настроить SEO (Rank Math)
- [ ] Настроить кэширование
- [ ] Оптимизировать изображения
- [ ] Проверить мобильную версию
- [ ] Проверить скорость (PageSpeed)
- [ ] Настроить SSL
- [ ] Настроить бэкапы
- [ ] Тестирование форм
- [ ] Проверить все ссылки
