# Detailed Decomposition

- Purpose: Декомпозиция master plan по фазам, workstreams и задачам.
- Status: active
- Last updated: 2026-03-21
- Source of truth: yes
- Related: `docs/12-master-plan.md`, `docs/11-prioritized-backlog.md`

## Phase 1. Discovery And Cleanup

| Workstream | Goal | Status | Dependencies | DoD |
|---|---|---|---|---|
| Repo audit | Понять структуру и артефакты | done | none | audit documented |
| Docs cleanup | Создать новый `docs/` layer | in progress | repo audit | index, start, SoT, plans exist |
| WordPress audit | Понять фактическую тему и gaps | in progress | repo audit | WP audit documented |

## Phase 2. Strategy

| Epic | Goal | Priority | Status | Dependencies | Parallel | DoD |
|---|---|---|---|---|---|---|
| Market research | Подтвердить patterns | high | in progress | docs cleanup | yes | research doc updated |
| Positioning | Свести одну рабочую версию бренда и оффера | high | in progress | brand source review | yes | strategy doc approved |
| Sitemap | Зафиксировать v1 scope | high | in progress | positioning | no | sitemap approved |
| Content architecture | Понять, что есть и чего не хватает | high | in progress | positioning | yes | inventory and gaps documented |

## Phase 3. WordPress Architecture

| Epic | Goal | Priority | Status | Dependencies | Parallel | DoD |
|---|---|---|---|---|---|---|
| Theme coverage | Сделать тему пригодной для всего сайта, не только front page | high | done | WP audit | no | page/single/archive/home exist |
| Content model | Сделать контент управляемым | high | in progress | strategy + WP audit | yes | model documented and ready |
| Blog integration | Связать блог и маркетинг | high | todo | theme coverage | yes | blog routes and linking defined |
| Plugin rationalization | Убрать туман вокруг plugin layer | medium | todo | admin access | yes | confirmed plugin audit |
| GEO baseline | Подготовить crawler/schema/measurement layer | high | in progress | WP audit + SEO plan | yes | GEO doc and implementation path exist |

## Phase 4. Visual Probe

| Epic | Goal | Priority | Status | Dependencies | Parallel | DoD |
|---|---|---|---|---|---|---|
| Probe scope freeze | Зафиксировать, какие страницы входят в пробник | high | todo | strategy + page briefs | no | scope approved |
| High-fidelity probe | Собрать визуальный пробник ключевых страниц | high | todo | content model + design principles | yes | key pages available for visual review |
| Mobile probe | Проверить mobile states для ключевых экранов | high | todo | high-fidelity probe | yes | mobile states reviewed |
| Review and corrections | Собрать обратную связь и зафиксировать изменения | high | todo | probe ready | no | review notes captured |

## Phase 5. Implementation

| Epic | Goal | Priority | Status | Dependencies | Parallel | DoD |
|---|---|---|---|---|---|---|
| Page assembly | Собрать ключевые страницы | high | todo | strategy + content model + probe review | no | pages render correctly |
| Reusable sections | Нормализовать блоки | high | todo | page assembly | yes | sections reusable |
| Forms and lead capture | Подключить Excursion route | high | todo | conversion decisions | yes | lead flow test passed |
| SEO baseline | Подготовить titles/meta/internal links | medium | todo | page assembly | yes | baseline complete |
| Analytics baseline | Мерить ключевые действия | medium | todo | forms and CTA | yes | events verified |

## Phase 6. Launch

| Epic | Goal | Priority | Status | Dependencies | Parallel | DoD |
|---|---|---|---|---|---|---|
| QA | Проверить mobile, links, templates, forms | high | todo | implementation | yes | QA checklist passed |
| Performance pass | Уложиться в safe baseline | high | todo | implementation | yes | no major CWV blockers |
| Soft launch | Выпустить безопасно | high | todo | QA + ops | no | monitored release completed |

## Critical Path

1. Confirm production WP context
2. Finalize v1 strategy and sitemap
3. Confirm content model and proof assets
4. Build and review visual probe
5. Implement pages and reusable sections
6. Connect forms + analytics
7. QA + launch
