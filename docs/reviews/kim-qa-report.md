# QA-отчёт — Switch on AI / Включи ИИ

- Автор: Ким Уэксслер, ОТК БАНДА
- Дата: 2026-04-03
- Версия: v1.0
- Охват: документы 00–14, MASTER-SITE-SPEC.md, VICTOR-ONE-PAGER.md, CLAUDE.md, START-HERE.md, INDEX.md, docs/design/site-visual-direction.md, docs/engineering/site-implementation-handoff.md

---

## Резюме

Документация проекта содержит несколько слоёв с разными датами и разными авторами. Стратегический пласт (00–14, март 21) написан аккуратно, но существенно расходится с более поздними документами (MASTER-SITE-SPEC, site-visual-direction, site-implementation-handoff — март 29). Между слоями есть прямые противоречия по дизайну, инструментарию и модели воронки. Ряд вопросов, обозначенных как "открытые" ещё 21 марта, остаётся незакрытым к 3 апреля. Часть задач числится выполненными, но фактические блокеры не устранены.

**Итоговый вывод: документация не готова к сборке новой версии страницы без предварительной синхронизации.**

---

## Блок 1. Противоречия между документами

### 🔴 CRITICAL — Конфликт дизайн-направления: dark vs light

**Документ 05-design-principles.md (март 21):**
> "Нельзя возвращаться в January dark-tech как в основной стиль без переутверждения стратегии."
> Основа: `style-previews/style-04-ranked-mix.html` (light-dominant).

**Decision log (март 21, последняя запись):**
> "Visual probe переводим в dark-first направление. Светлый style-06 не попал в ожидаемую атмосферу бренда."
> "style-07-dark-fluid-probe.html использовать как визуальную базу для live front page."

**MASTER-SITE-SPEC.md (март 29), раздел 17:**
> "Не dark-tech, а light-dominant trust-first UI."
> "Нельзя делать: уходить в «январский тёмный техно-футуризм»."

**VICTOR-ONE-PAGER.md (март 29):**
> "Не делать: dark-tech перегруз."
> "Делать: light-first, clean."

**docs/design/site-visual-direction.md (март 29):**
> "Основной режим: light-dominant."

**Итог:** Decision log от 21 марта (последняя запись в файле) зафиксировал решение идти в dark-first, но все документы от 29 марта явно опровергают это решение и снова возвращают light. При этом decision log не обновлён — старая dark-first запись остаётся в нём без аннулирования. Агент Виктор видит конфликт между SoT-документами.

**Что исправить:** добавить в `10-decision-log.md` запись, аннулирующую dark-first решение от 21 марта. Зафиксировать дату и основание возврата к light. Убедиться, что `style-07-dark-fluid-probe.html` помечен как rejected/archived, а не как production base.

---

### 🔴 CRITICAL — Конфликт по инструментарию: Elementor vs vanilla theme

**06-technical-implementation-plan.md (март 21):**
> "custom classic theme in `wordpress-theme/`; vanilla CSS + vanilla JS; no build tooling; no Composer."
> Ни слова об Elementor.

**CLAUDE.md:**
> "Active theme on prod: `webmastercpit` (custom, fully coded, no page builders)"

**VICTOR-ONE-PAGER.md (март 29):**
> "Elementor — layer для маркетинговых страниц."

**docs/engineering/site-implementation-handoff.md (март 29):**
> "editor/building layer: Elementor для редактируемых маркетинговых страниц"

**Итог:** В мартовских handoff-документах появился Elementor как строительный слой. Это прямо противоречит `06-technical-implementation-plan.md` и `CLAUDE.md`, которые явно фиксируют отсутствие page builders. Для Виктора это критический разрыв: разные документы говорят разное о базовой технологии сборки.

**Что исправить:** принять явное решение и зафиксировать его в decision log. Если Elementor добавлен как новое решение от 29 марта — нужна запись в `10-decision-log.md` с обоснованием и датой. Если Elementor не используется — убрать его из handoff-документов или пометить как отклонённый вариант.

---

### 🔴 CRITICAL — Конфликт модели воронки: одна vs две

**02-positioning-and-website-strategy.md (март 21):**
> Primary CTA единственный: `Записаться на Экскурсию`.
> "Не делать: клуб и внедрение как равные точки входа."
> Сайт фокусируется на AI-контент-системе как primary offer.

**MASTER-SITE-SPEC.md (март 29):**
> "один бренд, две воронки: внедрение и клуб."
> Клуб — полноценная отдельная страница с ценой (1990 ₽/мес), отдельным CTA "Вступить в клуб", отдельной логикой.
> Страница `/start` обязательна для разделения сегментов.

**Итог:** Документ 02 запрещает делать клуб равным входом. MASTER-SITE-SPEC и VICTOR-ONE-PAGER делают клуб полноценной второй воронкой с отдельной страницей, ценой и CTA. Это не уточнение, а смена стратегической модели. Старые документы 00–14 не обновлены под новую двух-воронковую логику.

**Что исправить:** обновить `02-positioning-and-website-strategy.md` и `09-open-questions.md` под новую двух-воронковую модель. Закрыть в decision log открытый вопрос #2 ("Выводим ли Клуб на витрину сразу").

---

### 🟡 IMPORTANT — Конфликт в навигации: наличие/отсутствие "Клуб" в header

**03-sitemap-and-page-briefs.md (март 21), Header:**
> Product / How It Works / Cases / Blog / About / FAQ / CTA

Клуба в header нет.

**MASTER-SITE-SPEC.md (март 29), Header:**
> Система / Как это работает / Кейсы / **Клуб** / Блог / О Павле / FAQ / CTA

Клуб добавлен в навигацию.

**Что исправить:** синхронизировать `03-sitemap-and-page-briefs.md` с MASTER-SITE-SPEC. Зафиксировать финальный header в одном каноническом месте.

---

### 🟡 IMPORTANT — Конфликт в V1 sitemap: наличие Club и /start

**03-sitemap-and-page-briefs.md, V1 Sitemap:**
Club не включён в V1. `/start` не включён.

**MASTER-SITE-SPEC.md и VICTOR-ONE-PAGER.md:**
Club и `/start` — обязательные страницы v1.

**Что исправить:** обновить `03-sitemap-and-page-briefs.md` как актуальный SoT по sitemap, либо явно объявить MASTER-SITE-SPEC единственным source of truth для sitemap и снять статус SoT с документа 03.

---

### 🟡 IMPORTANT — Конфликт по дизайн-референсу: style-04 vs style-07

**INDEX.md, строка "Design system direction":**
> SoT = `style-previews/style-04-ranked-mix.html` + `docs/05-design-principles.md`

**START-HERE.md:**
> "Принять, что style-04 остается утвержденной базой."

**Decision log (март 21, последняя запись):**
> "style-07-dark-fluid-probe.html использовать как визуальную базу для live front page."

**Итог:** INDEX.md и START-HERE.md указывают на style-04 как SoT. Decision log заменяет его на style-07. MASTER-SITE-SPEC и site-visual-direction возвращают light-dominant без прямой ссылки на конкретный файл. Ни один из файлов не обновлён под финальный консенсус.

**Что исправить:** обновить таблицу SoT в INDEX.md и строку "принять что style-04" в START-HERE.md — указать актуальный design SoT после аннулирования dark-first решения.

---

### 🟢 NICE-TO-HAVE — Расхождение в positioning statement

**02-positioning-and-website-strategy.md:**
> "Строю AI-контент-системы для предпринимателей и экспертов..."

**MASTER-SITE-SPEC.md:**
> "Строю AI-контент-системы **и автоматизации** для предпринимателей и экспертов..."

Незначительное, но в документах разные версии ключевого positioning statement.

**Что исправить:** зафиксировать финальную версию в одном месте. Обновить остальные документы.

---

## Блок 2. Устаревшая информация

### 🔴 CRITICAL — Все документы 00–14 датированы 21 марта, не обновлялись 13 дней

Все 15 основных документов (`00` — `14`, `START-HERE.md`, `INDEX.md`) имеют `Last updated: 2026-03-21`. За этот период (21 марта — 3 апреля):
- добавлен MASTER-SITE-SPEC.md (март 29);
- добавлен VICTOR-ONE-PAGER.md;
- добавлен docs/design/site-visual-direction.md;
- добавлен docs/engineering/site-implementation-handoff.md.

Ни один из документов 00–14 не был обновлён, чтобы отразить изменения из мартовского handoff-слоя. Это создаёт ситуацию, когда оба слоя формально числятся как `source of truth: yes`, но содержат прямые противоречия.

**Что исправить:** провести синхронизацию. Минимум — обновить `14-execution-status.md` и `10-decision-log.md` с записями о решениях от 29 марта. Обновить `Last updated` там, где содержание реально изменилось.

---

### 🟡 IMPORTANT — 09-open-questions.md не обновлялся, часть вопросов фактически закрыта

Вопросы, которые в документе числятся открытыми, но фактически закрыты в handoff-документах от 29 марта:

- Вопрос #1 ("Что является public front-door v1"): закрыт в MASTER-SITE-SPEC (две воронки).
- Вопрос #2 ("Выводим ли Клуб на витрину сразу"): закрыт — клуб выводится как вторая воронка.
- Вопрос #3 ("Какой CTA финально канонический"): частично закрыт — Экскурсия для внедрения, Клуб для второго сегмента.

Вопросы #7–12 (WordPress, VPS) остаются открытыми.

**Что исправить:** обновить `09-open-questions.md`. Закрытые вопросы перенести в decision log с датой и решением. Оставить только реально открытые.

---

### 🟡 IMPORTANT — 14-execution-status.md не отражает работу за март 22 – апрель 3

Статус зафиксирован на 21 марта. За прошедшие 13 дней созданы 4 крупных документа (MASTER-SITE-SPEC, VICTOR-ONE-PAGER, site-visual-direction, site-implementation-handoff), но `14-execution-status.md` не обновлён. Раздел "In Progress" и "Next Best Step" выглядят неактуально.

**Что исправить:** обновить статус. Добавить секцию по актуальным handoff-документам как отдельной фазе работы.

---

### 🟢 NICE-TO-HAVE — CLAUDE.md содержит "WordPress 6.9.4" без даты верификации

`CLAUDE.md` фиксирует версию WordPress как `6.9.4`. Нет отметки, когда это было подтверждено. Учитывая, что прямого доступа к продовой админке нет, эта информация может быть устаревшей.

---

## Блок 3. Пробелы — заявлено, но не раскрыто

### 🔴 CRITICAL — Proof library не собрана, но упоминается как решённая проблема

В `11-prioritized-backlog.md` (раздел "Closed This Cycle"):
> "Replace fake proof blocks with honest trust framing."

Это закрыто. Но при этом в `04-content-architecture.md` (раздел "Missing For Website V1") proof assets по-прежнему числятся как отсутствующие:
- верифицированные внешние кейсы;
- реальные и разрешённые к публикации отзывы;
- точные цифры, которые можно публиковать без риска;
- скриншоты pipeline, отобранные для сайта.

Убрать fake proof — это не то же самое, что собрать реальный proof. Фактически, сайт сейчас может быть без proof вообще.

**Что исправить:** явно зафиксировать текущее состояние proof library. Какие артефакты реально существуют и готовы к публикации? Это блокер для страниц Cases/Proof и Home.

---

### 🔴 CRITICAL — Форма записи на экскурсию: технология не определена

В `06-technical-implementation-plan.md`:
> "Required fields: name, contact, business context, current content challenge"
> "Post-submit: thank-you state + routing into manual or bot-assisted follow-up"

В `09-open-questions.md`:
> "Вопрос #4: Какая форма записи является целевой: обычная форма, Telegram, календарь, бот или гибрид?"

Вопрос открыт с 21 марта, не закрыт ни в одном последующем документе. MASTER-SITE-SPEC перечисляет поля формы (раздел 15), но не указывает технологию приёма.

**Что исправить:** принять решение по технологии формы до сборки страницы Contact/Excursion. Без этого нельзя строить lead flow.

---

### 🔴 CRITICAL — Legal copy отсутствует и нигде не назначена ответственность за её подготовку

В `04-content-architecture.md` ("Missing For Website V1"):
> "legal copy"

В `11-prioritized-backlog.md` (P1):
> "Подготовить legal pages."

В `08-launch-roadmap.md`:
> "legal copy prep" как параллельный поток.

Ни в одном документе не указано: кто пишет, что конкретно нужно (политика конфиденциальности, публичная оферта, cookie-уведомление?), каков дедлайн. Legal pages включены в V1 scope (MASTER-SITE-SPEC, VICTOR-ONE-PAGER), но без содержания.

**Что исправить:** назначить ответственного, зафиксировать минимальный состав юридических документов для V1, установить дедлайн.

---

### 🟡 IMPORTANT — Страница-прокладка /start: нет финального copy и лид-магнита

MASTER-SITE-SPEC детально описывает структуру `/start` (раздел 6), включая карточку "Хочу сначала что-то бесплатное" → "Забрать материал". Но не указано:
- какой конкретно материал;
- где он хранится;
- как происходит выдача (форма? прямая ссылка? Telegram?).

**Что исправить:** определить лид-магнит для третьей карточки `/start` или убрать эту карточку из V1 scope до готовности материала.

---

### 🟡 IMPORTANT — Согласованный founder story short version не готов

В `04-content-architecture.md` ("Missing For Website V1"):
> "согласованный founder story short version"

Нигде не зафиксировано, что этот контент был подготовлен после 21 марта. Страница "О Павле" и блок hero на главной требуют этот текст.

**Что исправить:** подготовить согласованный short founder story и зафиксировать его в `docs/content/` или `ВКЛЮЧИ ИИ/`.

---

### 🟡 IMPORTANT — Финальный form copy и CTA copy не утверждены

В `04-content-architecture.md` ("Missing For Website V1"):
> "финальные form copy и CTA copy"

MASTER-SITE-SPEC даёт шаблоны заголовков CTA, но финальные одобренные тексты кнопок, плейсхолдеров форм и thank-you messages нигде не зафиксированы.

**Что исправить:** подготовить и утвердить CTA copy sheet до сборки.

---

### 🟡 IMPORTANT — GEO baseline: entity layer не собран

В `14-execution-status.md` ("In Progress"):
> "Подготовка GEO baseline: entity layer, crawler/snippet controls, schema plan, AI-referral measurement."

В `11-prioritized-backlog.md` (P0):
> "Подготовить GEO baseline."

В `07-seo-analytics-cro-plan.md` описана стратегия, но нет артефакта — конкретного entity layer документа с именами, URL, описаниями, schema-разметкой. `docs/seo/GEO-AND-AI-SEARCH-VISIBILITY.md` упоминается в нескольких документах, но статус его готовности нигде не зафиксирован.

**Что исправить:** зафиксировать реальный статус GEO baseline. Если документ готов — обновить статус в `14-execution-status.md`. Если нет — добавить в приоритетный backlog как блокер перед сборкой.

---

### 🟢 NICE-TO-HAVE — Ценовая информация для клуба есть только в MASTER-SITE-SPEC

Цена клуба (1990 ₽/мес) указана только в разделе 12 MASTER-SITE-SPEC. Нигде больше не зафиксирована как утверждённая. Нет источника ("решение принято Павлом, дата").

---

## Блок 4. Missing content из 04-content-architecture.md — что всё ещё не закрыто

Оригинальный список из раздела "Missing For Website V1" (по состоянию на 3 апреля 2026):

| Пункт | Статус | Примечание |
|---|---|---|
| Верифицированные внешние кейсы | НЕ ЗАКРЫТ | Нет подтверждения ни в одном документе |
| Реальные и разрешённые к публикации отзывы | НЕ ЗАКРЫТ | Нет подтверждения |
| Точные цифры, которые можно публиковать без риска | НЕ ЗАКРЫТ | Нет подтверждения |
| Скриншоты pipeline, отобранные для сайта | НЕ ЗАКРЫТ | Упоминаются как "будущее" в MASTER-SITE-SPEC |
| Согласованный founder story short version | НЕ ЗАКРЫТ | Нет артефакта |
| Финальные form copy и CTA copy | НЕ ЗАКРЫТ | Есть шаблоны в MASTER-SITE-SPEC, нет утверждённого copy |
| Legal copy | НЕ ЗАКРЫТ | Нет артефакта, нет ответственного |

**Все 7 пунктов из "Missing For Website V1" остаются незакрытыми.**

---

## Блок 5. Несоответствия в дизайн-направлении

### 🔴 CRITICAL — Цветовой акцент: синий vs зелёный как primary CTA

**05-design-principles.md:**
> "Основа: светлый фон, тёмный текст, **холодный синий акцент**."

**docs/design/site-visual-direction.md:**
> "Primary CTA: зелёный `#4BD392`."
> "Interactive / links / info accents: синий `#2F80ED`."

Между документами разные роли для синего. В `05-design-principles` синий — главный акцент. В `site-visual-direction` главный CTA зелёный, синий — для links и info. Это влияет на визуальную иерархию кнопок.

**Что исправить:** `site-visual-direction.md` является более детальным и более поздним документом. Обновить `05-design-principles.md`, уточнив роли цветов в соответствии с финальной палитрой.

---

### 🟡 IMPORTANT — JetBrains Mono не упомянут в 05-design-principles.md

**CLAUDE.md:**
> Fonts: Manrope, Inter, Space Grotesk, JetBrains Mono

**docs/design/site-visual-direction.md:**
> Mono / code / prompts / схемы: JetBrains Mono

**05-design-principles.md:**
Упоминает только Manrope и Space Grotesk. JetBrains Mono отсутствует.

**Что исправить:** добавить JetBrains Mono в `05-design-principles.md` с описанием его роли (mono/code/схемы).

---

### 🟡 IMPORTANT — Montserrat: брендбук vs дизайн-документы

**site-visual-direction.md:**
> "Почему не Montserrat как базу из брендбука: для сайта она тяжелее и более шаблонная. Montserrat можно оставить только как fallback/reference."

Это решение обосновано, но нигде не зафиксировано в decision log как принятое. Если Монтсеррат исторически использовался в бренде — это расхождение с брендбуком требует формального решения.

**Что исправить:** добавить в `10-decision-log.md` запись об отказе от Montserrat как основного шрифта для сайта.

---

### 🟢 NICE-TO-HAVE — "Аккуратный wow" не операционализирован

В MASTER-SITE-SPEC (раздел 17):
> "Где нужен wow: hero главной, proof / visualized process, страница-прокладка..."

Нет конкретных критериев "аккуратного wow" — что допустимо (лёгкий gradient overlay, анимация появления?), а что нет (parallax, WebGL?). `05-design-principles.md` даёт Motion Principles, но они не синхронизированы с MASTER-SITE-SPEC.

---

## Блок 6. Статусы задач — "active" но фактически не реализовано

### 🔴 CRITICAL — Все P0-задачи из backlog помечены как незакрытые, но Execution Status показывает активную работу

Backlog (P0, 5 из 6 пунктов) остаются открытыми:
1. Подтвердить продовый WordPress-контекст — **BLOCKED** (нет доступа к админке).
2. Сформировать WP content model — **In Progress** (не завершено).
3. Собрать `home / product / how-it-works / proof / about / contact` scope — **In Progress** (не завершено).
4. Подтвердить proof stack — **BLOCKED** (реальный proof не собран).
5. Зафиксировать production-safe rollout path — **BLOCKED** (нет VPS workflow).

P0-задача #6 (GEO baseline) в прогрессе, статус неясен.

Это означает: **ни одна из P0-задач не закрыта**. Проект фактически заблокирован на уровне prerequisites перед сборкой.

---

### 🔴 CRITICAL — Задачи Phase 4 (Visual Probe) полностью в статусе "todo"

В `13-detailed-decomposition.md`, Phase 4:
- Probe scope freeze: **todo**
- High-fidelity probe: **todo**
- Mobile probe: **todo**
- Review and corrections: **todo**

При этом `14-execution-status.md` говорит:
> "На основе review собран новый dark-first visual probe"
> "Новый dark-first visual probe перенесен в живую WordPress front page"

Расхождение: decomposition говорит "todo", execution status говорит "done". Это не одно и то же: probe был создан и перенесён на прод, но scope заморожен не был, mobile probe не проверен, review и corrections не зафиксированы.

Дополнительный вопрос: этот probe был dark-first, а текущая стратегия — light. Перенесён ли на прод дизайн, который теперь противоречит официальному направлению?

**Что исправить:** прояснить статус фронтальной страницы на production прямо сейчас. Если там dark-first probe — это несоответствие официальному дизайн-решению от 29 марта.

---

### 🟡 IMPORTANT — Phase 3 WordPress Architecture: 3 из 5 задач в "todo" или "in progress" без прогресса

В `13-detailed-decomposition.md`, Phase 3:
- Blog integration: **todo**
- Plugin rationalization: **todo** (заблокирован отсутствием admin access)
- Content model: **in progress** (без конкретной DoD)

Это блокирует Phase 5 (Implementation). Критический путь не разблокирован.

---

### 🟡 IMPORTANT — "Closed This Cycle" в backlog содержит задачи, которые могут быть не закрыты

В `11-prioritized-backlog.md` ("Closed This Cycle"):
> "Fix JS anchor handling."
> "Add missing WP templates."
> "Normalize footer/header links."

Это технические изменения в `wordpress-theme/`. Но нет верификации, что они реально работают на продовом сайте. Нет доступа к prodovой среде, нет QA-отчёта. "Закрытая" задача — это закрытая задача в репозитории, а не в продакшне.

---

## Блок 7. Структурные наблюдения

### 🟡 IMPORTANT — Два конкурирующих SoT-слоя без явной иерархии

Документы 00–14 имеют статус `source of truth: yes`. MASTER-SITE-SPEC также является "master document". Это формально создаёт два источника истины.

MASTER-SITE-SPEC в разделе 20 декларирует:
> "Если есть конфликт между старым контуром и новой логикой, источник истины = docs/ + этот master document."

Но "docs/" — это как раз документы 00–14, которые не обновлены под MASTER-SITE-SPEC. Указание "docs/ + этот документ" не разрешает конфликт между ними.

**Что исправить:** явно понизить статус документов 00–14 с `source of truth: yes` до `reference: archived` там, где они перекрыты более поздними документами. Или провести синхронизацию содержания.

---

### 🟢 NICE-TO-HAVE — Документы в папке docs/wordpress/ не охвачены этим аудитом

Несколько документов упоминаются в INDEX.md как часть структуры:
- `docs/wordpress/WORDPRESS-AUDIT.md`
- `docs/wordpress/WORDPRESS-ARCHITECTURE.md`
- `docs/wordpress/CONTENT-MODEL.md`
- `docs/wordpress/THEME-STRUCTURE.md`
- `docs/wordpress/PLUGIN-AUDIT.md`
- `docs/wordpress/BLOG-SEO-STRUCTURE.md`
- `docs/wordpress/VPS-DEPLOYMENT-AND-MAINTENANCE.md`

Их статус и дата обновления не проверены в этом QA-прогоне. Рекомендуется отдельная проверка этого слоя.

---

## Итоговые рекомендации — что исправить до сборки новой версии страницы

### Нельзя начинать сборку без этого (CRITICAL blockers)

1. **Аннулировать dark-first решение в decision log.** Добавить запись от 29+ марта, которая явно закрывает запись от 21 марта о `style-07`. Иначе исполнитель работает с прямым противоречием в официальных документах.

2. **Принять решение по Elementor и зафиксировать его.** Vanilla theme или Elementor — один ответ в decision log. Обновить `06-technical-implementation-plan.md` и handoff-документы под это решение.

3. **Обновить `02-positioning-and-website-strategy.md` под двух-воронковую модель.** Или официально объявить MASTER-SITE-SPEC superseding документом и снять статус SoT с документа 02.

4. **Синхронизировать V1 sitemap.** Привести `03-sitemap-and-page-briefs.md` в соответствие с MASTER-SITE-SPEC (добавить Club и /start как обязательные V1 страницы).

5. **Зафиксировать статус proof library.** Что реально есть для публикации прямо сейчас? Пустой proof — это блокер для страниц Cases и Home.

6. **Прояснить статус production front page.** Если там сейчас стоит dark-first probe — это несоответствие утверждённому направлению. Нужна ясность перед сборкой.

7. **Принять решение по форме записи на экскурсию** (технология: нативная форма, Telegram, Calendly, бот). Без этого нельзя собрать Contact/Excursion страницу.

### Делать параллельно со сборкой (IMPORTANT)

8. Обновить `10-decision-log.md` — добавить все решения от 29 марта (Elementor, Club как V1, /start, отказ от Montserrat, light-dominant final confirmation).

9. Обновить `09-open-questions.md` — закрыть вопросы #1, #2, #3, отметить #7–12 как заблокированные.

10. Обновить `14-execution-status.md` с актуальным статусом на 3 апреля.

11. Привести цветовые роли в `05-design-principles.md` в соответствие с `site-visual-direction.md` (зелёный = primary CTA, синий = links/info).

12. Подготовить founder story short version и CTA copy sheet.

13. Назначить ответственного за legal copy и установить дедлайн.

14. Определить лид-магнит для третьей карточки `/start`.

### После запуска (NICE-TO-HAVE)

15. Провести QA документов в папке `docs/wordpress/`.
16. Добавить в decision log запись по ценовой модели клуба (1990 ₽/мес как утверждённое).
17. Операционализировать критерии "аккуратного wow" в design principles.

---

*QA-отчёт подготовлен: Ким Уэксслер, ОТК БАНДА. Дата: 2026-04-03.*
