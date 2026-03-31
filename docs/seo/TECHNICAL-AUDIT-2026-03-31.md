# Technical SEO Audit: switchonai.ru

- Date: 2026-03-31
- Method: remote (WebFetch, no SSH)
- Source of truth: yes

---

## Score: 52 / 100

| Category | Score | Status |
|----------|-------|--------|
| Crawlability & Indexing | 7/10 | Good |
| Security Headers | 1/10 | CRITICAL |
| On-Page SEO (Homepage) | 6/10 | Needs Work |
| Structured Data | 6/10 | Acceptable |
| Performance & CWV | 4/10 | Poor |
| URL Structure | 8/10 | Good |
| Social Sharing (OG/Twitter) | 3/10 | Poor |
| AI Readiness | 2/10 | Poor |
| Content Quality Signals | 5/10 | Needs Work |
| Mobile & UX | 8/10 | Good |

---

## CRITICAL (fix immediately)

### 1. Zero Security Headers

Server returns only `server: nginx` + `x-powered-by: PHP/8.3.7`.

Missing: HSTS, CSP, X-Frame-Options, X-Content-Type-Options, Referrer-Policy, Permissions-Policy.

**Fix (nginx):**
```nginx
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
add_header Permissions-Policy "camera=(), microphone=(), geolocation=()" always;
# php.ini: expose_php = Off
```

### 2. jQuery 1.7.1 (2011) render-blocking

```html
<!-- Current -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!-- Fix -->
<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
```

### 3. Missing og:image / twitter:image

No preview image on social shares or Telegram. Critical for TG-based marketing.

**Fix:** Upload 1200x630 OG image → set in Yoast SEO → Social → Homepage.

---

## HIGH Priority

### 4. No font preloading / preconnect

### 5. Duplicate title = meta description on key pages

| Page | Title | Description |
|------|-------|-------------|
| /stati/ | "Блог — switchonai.ru" | Same |
| /price/ | "Прайс — switchonai.ru" | Same |
| /ai-komanda/ | "Ai команда за 1 вечер — switchonai.ru" | Same |

**Fix:** Write unique descriptions 120-155 chars each in Yoast.

### 6. 7 images with empty `alt` attributes

### 7. No llms.txt

**Fix:** Create `/llms.txt` for AI crawler discoverability.

### 8. No AI crawler rules in robots.txt

Add rules for GPTBot, ClaudeBot, PerplexityBot.

---

## MEDIUM Priority

### 9. Only 1 category for 170+ posts
### 10. Author sitemap enabled but /author/ blocked in robots.txt
### 11. `Disallow: *page` blocks all URLs containing "page"
### 12. No IndexNow support
### 13. HTML `lang="ru"` vs Schema `inLanguage: "ru-RU"` mismatch
### 14. Missing Organization/Service/LocalBusiness schemas
### 15. TTFB 413ms (target <200ms, needs server caching)
### 16. `meta keywords` still present (deprecated, remove)

---

## What works well

- HTTPS active, HTTP→HTTPS 301 redirect
- www→non-www redirect
- Trailing slash consistency
- Sitemap index present (238 URLs)
- Yoast JSON-LD structured data
- Canonical tags present
- Clean URL structure
- Single H1 per page
- Viewport meta tag present
