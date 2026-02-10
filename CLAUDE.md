# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Website for **"ВКЛЮЧИ ИИ" (Switch On AI)** — an AI education and consulting ecosystem by Pavel Leshchenko, targeting Russian entrepreneurs/experts who want to adopt AI tools. Domain: switchonai.ru.

## Architecture

The project has three distinct layers:

1. **`index.html`** — Single-file static prototype that served as the design blueprint. Contains all HTML, CSS, and JS inline. This is the reference design, not the production site.

2. **`wordpress-theme/`** — Custom WordPress theme (production target), a 1:1 translation of `index.html` into WordPress. No page builders (Elementor, etc.), no CSS preprocessors, no JS frameworks — pure vanilla stack.

3. **`Действующий сайт/`** — CSS backup of the currently live site (legacy). This is a separate, older design with different structure (dark navy `#1C1F33` palette, custom `.otf` fonts, 1024px fixed width). Contains a full blog system CSS starting at line ~4913.

### WordPress Theme Structure

- **`functions.php`** — Theme setup, script enqueuing (Google Fonts, `style.css`, `main.js`), WordPress Customizer API (hero text, contact info, social URLs), 3 footer widget areas
- **`front-page.php`** — Homepage: hero section + 8 `get_template_part()` calls to `template-parts/section-*.php`
- **`header.php`** / **`footer.php`** — Site chrome with `wp_nav_menu()` fallbacks and Customizer-driven contact/social data
- **`template-parts/`** — Self-contained sections: problems, services, process, cases, training, testimonials, faq, cta
- **`assets/js/main.js`** — Vanilla JS IIFE: header scroll effect, FAQ accordion, scroll-reveal (`.reveal` → `.active`), smooth scroll, parallax on mouse, mobile menu toggle
- **`style.css`** — All theme CSS + WordPress metadata header. Uses CSS custom properties (`:root` variables). Design: black bg `#000000`, blue accent `#69ace4`, Space Grotesk + Inter fonts, CSS-only 3D effects (rings, orb, dots)

### Key Design Pattern

Scroll animations use `.reveal` CSS class on elements. `main.js` uses IntersectionObserver-like logic to add `.active` class when elements enter viewport, triggering CSS transitions.

## Development Workflow

No build tools, no npm/yarn, no Composer. Development is manual:

1. Edit theme files locally
2. Upload to WordPress server (FTP or ZIP upload via WP Admin > Themes)
3. Activate theme, test in browser

To package the theme: create a ZIP of the `wordpress-theme/` folder.

## Content & Brand Context

- **Language:** All content is in Russian
- **Brand:** ВКЛЮЧИ ИИ / Switch On AI
- **iSite/** contains brand strategy docs (personality, business model, branding guidelines)
- **Документация/** contains technical research (competitor analysis, animation tech research, WP implementation notes)
- Customizer settings drive hero text, phone, email, Telegram, social URLs — avoid hardcoding these values

## Important Notes

- The WordPress theme CSS palette (black/blue/cream from Avtograf Group inspiration) differs from the legacy live site palette (dark navy `#1C1F33` / green `#4cd1a0`)
- `Действующий сайт/main-style.css` is ~5800 lines and includes styles for a WordPress blog system (slider, post cards, sidebar, single article, breadcrumbs, pagination) starting around line 4913
- The live site uses custom `.otf` font families (Bold, Medium, Regular, Light) referenced via relative `fonts/` path
- No `.gitignore` exists — be cautious about committing binary files (PDFs, images, videos in `iSite/05_Медиа/`)
