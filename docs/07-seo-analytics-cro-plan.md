# SEO Analytics CRO Plan

- Purpose: Базовый план измеримости, органического роста и AI-search visibility.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/06-technical-implementation-plan.md`, `docs/03-sitemap-and-page-briefs.md`, `docs/seo/GEO-AND-AI-SEARCH-VISIBILITY.md`

## SEO Foundations

- clear page purpose per URL
- unique title and meta description
- semantic heading hierarchy
- strong internal links from blog to product pages
- structured snippets only where they add value
- indexable, crawlable, snippet-eligible pages
- important content available in visible text, not only in UI effects or images

## Search Strategy

### Primary SEO Roles

- Blog captures intent and long-tail educational traffic.
- Product and methodology pages capture warm commercial and branded intent.
- Future comparison / segment pages capture middle and bottom-funnel demand.
- Founder/proof pages strengthen entity understanding, trust and citation readiness for AI search.

## GEO / AI Search Visibility

### What matters

- For Google AI features, classic SEO fundamentals still remain the base layer. Google states there are no extra technical requirements or special AI markup for AI Overviews / AI Mode.
- To appear as supporting links in AI features, pages must be indexed and eligible to show with snippets in regular Google Search.
- Business details, official site signals, Organization / LocalBusiness data and up-to-date public identity matter more, not less.
- Clear structure, explicit answers, first-hand expertise, evidence and consistency across pages improve citation readiness.
- For ChatGPT search, the site should allow `OAI-SearchBot` and the host/CDN should allow traffic from OpenAI’s published IPs.
- For Bing / Copilot visibility, fast refresh and change discovery matter; IndexNow should be part of the rollout.

### GEO priorities for this project

1. Build an explicit entity layer around Pavel / brand / product / methodology.
2. Turn key pages into citation-friendly sources, not only conversion pages.
3. Publish answer-first content blocks: definitions, comparisons, workflows, objections, checklists, costs, outcomes.
4. Keep proof concrete and auditable: examples, screenshots, process artifacts, before/after logic, operating constraints.
5. Maintain cross-surface consistency: site copy, metadata, schema, profiles, social bios, business details.

### GEO content patterns

- short direct answer near the top of the page
- clear subheads matching user question language
- tables / comparison grids where useful
- FAQ used selectively, not as spam filler
- founder-first expertise signals on pages that make claims
- timestamps / update logic for evolving topics
- concrete terms instead of vague “AI revolution” wording

## Internal Linking

- every strategic blog post should route to product or FAQ
- proof/case articles should route to Excursion
- About page should reinforce Product and Contact
- methodology articles should link to proof and product pages
- pillar pages should link to supporting posts and back

## Analytics Event Map

- `view_home`
- `click_primary_cta`
- `click_secondary_cta`
- `view_product_page`
- `form_start_excursion`
- `form_submit_excursion`
- `click_blog_to_product`
- `scroll_depth_50`
- `scroll_depth_90`
- `view_founder_page`
- `view_proof_page`
- `click_chatgpt_referral_cta`
- `click_ai_search_referral_to_excursion`

## GEO Measurement Layer

- Search Console `Web` performance for AI-feature-included traffic
- branded vs non-branded query split
- page groups: home / product / methodology / proof / founder / blog
- GA4 source/medium monitoring with `utm_source=chatgpt.com`
- referral segments for `chatgpt.com`, `copilot.microsoft.com`, `bing.com`
- Bing Webmaster AI Performance report, once the property is verified and the feature is available in the account
- annotations in reporting for major template/content changes

## KPI Map

- primary: excursion conversion rate
- secondary: blog -> product clickthrough
- secondary: form completion rate
- secondary: qualified lead rate
- secondary: return visits and engaged sessions
- secondary: non-branded impressions to core commercial pages
- secondary: citations / cited pages in Bing AI Performance
- secondary: AI-referral assisted conversions

## CRO Priorities

1. Hero clarity in first 5 seconds
2. CTA wording and placement
3. trust sequence before ask
4. form friction reduction
5. proof ordering
6. answer-first clarity on high-intent pages

## Post-Launch Experiments

- hero angle A/B
- CTA copy test
- proof block order
- long vs short methodology summary
- founder-first vs system-first mid-page section
- comparison-table vs narrative explanation on methodology/product pages
- concise answer box vs no answer box on informational posts

## Important GEO Notes

- Не делать `AI.txt` или другие неофициальные “спец-файлы” как ставку стратегии. По текущим официальным рекомендациям Google для AI features они не нужны.
- Не блокировать snippets, если хотим участвовать в AI features и citation-based выдаче.
- Не плодить thin AI-generated pages ради охвата.
- Не использовать schema, которая не соответствует видимому контенту страницы.
- Не превращать FAQ в мусорный SEO-блок; Google давно сократил rich result coverage для FAQ/HowTo.

## WordPress Execution Notes

- robots.txt, snippet controls and crawler access must be checked at WordPress + server/CDN level
- schema should be implemented either through the current SEO plugin stack or lightweight custom JSON-LD in theme/plugin code
- founder page, organization details, contact data and proof pages should be structured as stable editable entities
- blog templates should support strong internal linking and visible update metadata

