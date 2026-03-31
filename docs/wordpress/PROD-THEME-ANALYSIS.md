# Production Theme Analysis: webmastercpit

- Status: active
- Last updated: 2026-03-31
- Method: remote analysis (WebFetch of live site, no SSH)
- Source of truth: yes

---

## Technology Stack

| Component | Value |
|-----------|-------|
| CMS | WordPress 6.9.4 |
| Theme | `webmastercpit` (custom) |
| SEO Plugin | Yoast SEO |
| JS Framework | None — vanilla JS, inline |
| CSS Framework | None — custom CSS Grid + Flexbox |
| Fonts | Custom @font-face: Bold, Medium, Regular, Light (.otf from `fonts/` dir) |
| jQuery | Not detected |
| Page Builder | None |

## Theme Files (reconstructed)

```
wp-content/themes/webmastercpit/
├── style.css              # Main stylesheet
├── functions.php          # Theme setup
├── template-info.php      # Custom template for /price/, /rassylka/, /oferta/
└── fonts/
    ├── Medium.otf
    ├── Regular.otf
    └── Light.otf
```

No external JS files detected — all JavaScript is inline.

## Active Plugins

| Plugin | Status |
|--------|--------|
| Yoast SEO | Confirmed (sitemap, schema, meta) |
| Others | None detected — very lightweight |

## Homepage Sections

1. **Header** — Logo + nav (Главная, Блог)
2. **Hero (screen1-wrap)** — Author photo, description, CTA buttons
3. **Service Cards (screen2–8)** — 3 cards with popup modals:
   - Внедрение автоматизации (icon-vnedrenie.jpg)
   - Автоматизация контента (icon-avtomatizaciya.jpg)
   - Обучение / AI-команда (icon-obuchenie.jpg)
4. **Popup Modals** — `.popup`, `.popup-inner`, `.popup-close`
5. **Testimonials/Video**
6. **About Author**
7. **CTA Footer**
8. **Footer** — ИП Лещенко, ИНН: 673201737190, СПб

## CSS Architecture

- Screen-based: `.screen1-wrap` через `.screen8-wrap`
- Blog: `.blog-page-wrap`, `.blog-post-card`
- AI sections: `.ai-carousel*`, `.ai-person*`, `.ai-audit*`
- Dark palette: `#1C1F33` bg, `#2d98da` blue, `#56c964` green
- Animations: gradient (15s), hoverWave, shake
- Breakpoints: 2050, 1051, 1024, 940, 885, 860, 806, 768, 720, 695, 650, 600, 500, 480, 450, 390

## Blog (/stati/)

- Category archive (slug: `rubrika`)
- Full-width, no sidebar, no pagination (continuous feed)
- 170+ posts, all in single category "Статьи"
- Post card: featured image + author + date + category badge + excerpt + "Читать далее"
- Single post: breadcrumb, featured image, content with section anchors, author box, related posts, FAQ schema

## Pages

| Page | URL | Template |
|------|-----|----------|
| Homepage | `/` | Custom (screen sections) |
| Blog | `/stati/` | Category archive |
| Price | `/price/` | template-info.php |
| AI Komanda | `/ai-komanda/` | Default page (Gutenberg blocks) |
| Oferta | `/oferta/` | template-info.php |
| Newsletter | `/rassylka/` | template-info.php |
| Privacy | `/privacy/` | Unknown |
| Consent | `/soglasie/` | Unknown |

Total: 7 pages + 121+ posts

## Key Assets on Server

- Logo: `/wp-content/uploads/chatgpt-image-18-sent.-2025-g.-09_48_32.png`
- Author photo: `/wp-content/uploads/photo_2026-02-05_18-58-34.jpg`
- Author photo 2: `/wp-content/uploads/photo_2026-02-05_19-15-28.jpg`
- Service icons: `icon-vnedrenie.jpg`, `icon-avtomatizaciya.jpg`, `icon-obuchenie.jpg`

## External Integrations

- Telegram bot: `t.me/Pavel_Leshenko_bot`
- Telegram channel: `t.me/Switch_On_AI`
- Email: SwitchOnAI@yandex.ru
- Social: WhatsApp, Telegram, Viber, VKontakte

## No Custom Post Types

Only WordPress defaults. No ACF, no CPT, no custom taxonomies.

---

## Implications for Rebuild

1. **Theme is simple** — no complex plugin dependencies, no page builder, no CPT
2. **Homepage is fully hardcoded** — just screen sections with popup JS
3. **Blog works** — category archive + single post template are functional
4. **Safe to replace** — new theme just needs to replicate blog templates + add new homepage
5. **Key risk** — inline CSS/JS means we can't just swap `style.css`, must rebuild the whole theme
6. **Assets exist on server** — author photos, logos already uploaded to `wp-content/uploads/`
