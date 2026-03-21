<?php
/**
 * The front page template file
 *
 * @package SwitchOnAI
 */

$posts_page_id = (int) get_option('page_for_posts');
$blog_url      = $posts_page_id ? get_permalink($posts_page_id) : home_url('/');
$email         = switchonai_get_option('contact_email', 'hello@switchonai.ru');
$phone         = switchonai_get_option('contact_phone', '+7 (900) 123-45-67');
$phone_href    = preg_replace('/[^0-9+]/', '', $phone);
$telegram      = switchonai_get_option('telegram_username', '@switchonai');
$telegram_url  = 'https://t.me/' . ltrim($telegram, '@');

$latest_posts = new WP_Query(
    array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => true,
    )
);

get_header();
?>

<main class="df-main">
    <section class="df-hero df-section" id="home">
        <div class="container">
            <div class="df-hero-shell">
                <div class="df-hero-grid">
                    <div class="df-copy">
                        <span class="df-eyebrow">Dark-first live front page</span>

                        <h1 class="df-title">
                            Не просто сайт про AI, а
                            <span class="df-title-accent">темная сценография системы</span>,
                            в которую хочется зайти
                        </h1>

                        <p class="df-lead">
                            AI-контент-система для бизнеса, который хочет владеть своим вниманием,
                            а не гоняться за контентом. Сначала смысл и архитектура, затем AI,
                            публикация и управляемый маршрут доверия.
                        </p>

                        <div class="df-actions">
                            <a href="#contact" class="btn btn-primary">Записаться на экскурсию</a>
                            <a href="#method" class="btn btn-outline">Посмотреть маршрут</a>
                        </div>

                        <div class="df-chip-row">
                            <span class="df-chip">Темный базовый режим</span>
                            <span class="df-chip">Меньше квадратов</span>
                            <span class="df-chip">Больше пластики и ритма</span>
                        </div>
                    </div>

                    <aside class="df-hero-art" aria-hidden="true">
                        <span class="df-orbit df-orbit-large"></span>
                        <span class="df-orbit df-orbit-small"></span>
                        <span class="df-line df-line-1"></span>
                        <span class="df-line df-line-2"></span>
                        <span class="df-line df-line-3"></span>
                        <span class="df-node df-node-1"></span>
                        <span class="df-node df-node-2"></span>
                        <span class="df-node df-node-3"></span>
                        <span class="df-node df-node-4"></span>

                        <div class="df-floating-note df-note-a">
                            <strong>Главная мысль</strong>
                            <p>Контент как система, а не поток случайных публикаций.</p>
                        </div>

                        <div class="df-floating-note df-note-b">
                            <strong>Маршрут</strong>
                            <p>Смысл → структура → AI-ядро → публикация → доверие.</p>
                        </div>

                        <div class="df-floating-note df-note-c">
                            <strong>Proof</strong>
                            <p>Артефакты, сценарии, ownership model, а не fake цифры.</p>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <section class="df-band-section">
        <div class="container">
            <div class="df-band">
                Ощущение должно быть таким: ты заходишь не на “очередной лендинг про нейросети”,
                а в собранную темную систему с характером, глубиной и своим визуальным кодом.
            </div>
        </div>
    </section>

    <section class="df-section">
        <div class="container">
            <div class="df-section-head">
                <div class="df-copy-wrap">
                    <span class="df-tag">Home</span>
                    <h2>Главная как вход в плотную, но понятную систему</h2>
                    <p class="df-copy">
                        Первый экран должен сообщать не только оффер, но и атмосферу:
                        серьезная работа, технологичная эстетика, маршрут доверия,
                        а не легкий SaaS-шаблон.
                    </p>
                </div>
            </div>

            <div class="df-shell">
                <div class="df-home-grid">
                    <div class="df-curve-card">
                        <span class="df-mini">Главный оффер</span>
                        <h3>AI-контент-система для бизнеса, который хочет владеть своим вниманием, а не гоняться за контентом</h3>
                        <p class="df-copy">
                            Тут дизайн должен поддерживать идею системы: не стерильная B2B-подача,
                            а уверенный темный интерфейс, где чувствуется архитектура, глубина
                            и ручная настройка под конкретный метод.
                        </p>

                        <div class="df-cloud">
                            <span>Не еще один подрядчик</span>
                            <span>Не автоматизация ради автоматизации</span>
                            <span>Не поток одинаковых постов</span>
                            <span>Свой актив, а не зависимость</span>
                        </div>
                    </div>

                    <div class="df-stack">
                        <article class="df-panel">
                            <span class="df-mini">Для кого</span>
                            <p>
                                Эксперты, предприниматели, агентства и B2B-команды,
                                которым нужен контроль над смыслом, темпом и качеством контента.
                            </p>
                        </article>

                        <article class="df-panel">
                            <span class="df-mini">В чем боль</span>
                            <p>
                                Контент живет рывками, AI ускоряет шум, а сайт, блог и оффер
                                не работают как единая система доверия.
                            </p>
                        </article>

                        <article class="df-panel">
                            <span class="df-mini">Куда ведем</span>
                            <p>
                                К экскурсии по системе, где человек понимает модель, ограничения,
                                маршрут внедрения и следующий осмысленный шаг.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="df-section" id="method">
        <div class="container">
            <div class="df-section-head">
                <div class="df-copy-wrap">
                    <span class="df-tag">How It Works</span>
                    <h2>Метод не в квадратах-таблицах, а в живом маршруте</h2>
                    <p class="df-copy">
                        Здесь ритм должен ощущаться как движение: шаги смещаются, композиция дышит,
                        и визуально видно, что это путь, а не набор одинаковых блоков “про продукт”.
                    </p>
                </div>
            </div>

            <div class="df-steps">
                <article class="df-step">
                    <div class="df-step-number">01</div>
                    <div>
                        <span class="df-mini">Распаковка</span>
                        <h3>Собираем смыслы, аудиторию и реальные точки ценности</h3>
                        <p>
                            Без этого любой AI будет просто ускорять хаос. Поэтому маршрут начинается
                            не с технологии, а с упаковки метода, продукта и логики внимания.
                        </p>
                    </div>
                </article>

                <article class="df-step">
                    <div class="df-step-number">02</div>
                    <div>
                        <span class="df-mini">Архитектура</span>
                        <h3>Строим систему страниц, блога, сценариев и CTA</h3>
                        <p>
                            Сайт перестает быть набором экранов и становится рабочей маркетинговой
                            инфраструктурой, где каждая страница знает свою роль.
                        </p>
                    </div>
                </article>

                <article class="df-step">
                    <div class="df-step-number">03</div>
                    <div>
                        <span class="df-mini">AI-ядро</span>
                        <h3>Подключаем ассистентов и контуры публикации</h3>
                        <p>
                            Не “волшебная кнопка”, а набор понятных ролей: генерация, редактура,
                            адаптация под каналы, GEO-ready материалы и proof-артефакты.
                        </p>
                    </div>
                </article>

                <article class="df-step">
                    <div class="df-step-number">04</div>
                    <div>
                        <span class="df-mini">Запуск</span>
                        <h3>Собираем управляемую систему, которую можно поддерживать</h3>
                        <p>
                            На выходе остается не просто красивый сайт и не просто набор промптов,
                            а понятная модель, которой владеешь ты, а не внешний исполнитель.
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="df-section" id="proof">
        <div class="container">
            <div class="df-section-head">
                <div class="df-copy-wrap">
                    <span class="df-tag">Proof</span>
                    <h2>Доверие собирается через глубину и фактуру</h2>
                    <p class="df-copy">
                        Здесь дизайн должен быть дорогим и уверенным, но не крикливым. Вместо случайных
                        отзывов и липовых цифр показываем то, что реально цитируется, пересказывается
                        и выглядит правдоподобно.
                    </p>
                </div>
            </div>

            <div class="df-proof-grid">
                <article class="df-proof-card df-proof-card-alt">
                    <span class="df-mini">Proof layer 1</span>
                    <h3>Скриншоты, контуры и фрагменты рабочих систем</h3>
                    <p>
                        Гораздо сильнее работают маршрут идеи, контентное ядро, логика канала
                        и связка с блогом, чем десяток случайных цифр без контекста.
                    </p>

                    <div class="df-metrics">
                        <div><span>Что публикуем</span><strong>только подтверждаемое</strong></div>
                        <div><span>Что усиливаем</span><strong>метод и прозрачность</strong></div>
                        <div><span>Что избегаем</span><strong>fake proof и vanity metrics</strong></div>
                    </div>
                </article>

                <article class="df-proof-card">
                    <span class="df-mini">Proof layer 2</span>
                    <h3>Экономика, ownership model и честные ограничения</h3>
                    <p>
                        Темный стиль тут работает на ощущение серьезной технологичной среды.
                        Но доверие рождается из ясной модели: что делает AI, что делает команда
                        и что остается в активе у клиента.
                    </p>

                    <div class="df-metrics">
                        <div><span>Человек понимает</span><strong>как это внедряется</strong></div>
                        <div><span>Человек чувствует</span><strong>контроль вместо магии</strong></div>
                        <div><span>Человек запоминает</span><strong>это не очередной SMM-сервис</strong></div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="df-section" id="about">
        <div class="container">
            <div class="df-section-head">
                <div class="df-copy-wrap">
                    <span class="df-tag">About / Entity</span>
                    <h2>Личный слой нужен не для биографии, а для веса</h2>
                    <p class="df-copy">
                        Founder-страница должна усиливать не “посмотрите, какой я”, а происхождение
                        подхода, практику и авторский контур системы.
                    </p>
                </div>
            </div>

            <div class="df-story-grid">
                <div class="df-portrait">
                    <span>Павел</span>
                </div>

                <article class="df-story-card">
                    <span class="df-mini">Entity layer</span>
                    <h3>Павел как архитектор систем, а не просто человек “про нейросети”</h3>
                    <p>
                        Такой экран должен быть спокойным, почти кинематографичным, где чувствуется
                        интеллект, дисциплина и опыт, а не просто “дружелюбный эксперт на фоне градиента”.
                    </p>

                    <div class="df-facts">
                        <div>Практика сначала проверяется на собственных контурах, а потом масштабируется на клиентов.</div>
                        <div>Фокус не на “нейросетях ради нейросетей”, а на внимании, структуре, контентной экономике и владении активом.</div>
                        <div>Для GEO это еще и entity-узел: экспертность, first-hand materials, согласованность бренда и блога.</div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="df-section" id="blog">
        <div class="container">
            <div class="df-section-head">
                <div class="df-copy-wrap">
                    <span class="df-tag">Blog / GEO Layer</span>
                    <h2>Блог как часть одной вселенной, а не как WordPress-хвост</h2>
                    <p class="df-copy">
                        Блог должен жить внутри общей темной системы: объяснять термины,
                        снимать возражения, усиливать entity layer и возвращать человека
                        обратно к продукту и экскурсии.
                    </p>
                </div>

                <a class="btn btn-outline df-blog-link" href="<?php echo esc_url($blog_url); ?>">Открыть блог</a>
            </div>

            <div class="df-blog-grid">
                <?php if ($latest_posts->have_posts()) : ?>
                    <?php
                    while ($latest_posts->have_posts()) :
                        $latest_posts->the_post();
                        $summary = get_the_excerpt();

                        if (!$summary) {
                            $summary = wp_trim_words(wp_strip_all_tags(get_the_content()), 24);
                        }
                        ?>
                        <article class="df-article-card">
                            <strong>Из блога</strong>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo esc_html($summary); ?></p>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <article class="df-article-card">
                        <strong>Pillar post</strong>
                        <h3>Что такое AI-контент-система и почему это не просто “пишем через ChatGPT”</h3>
                        <p>Статья, на которую можно ссылаться из главной, product-страницы и proof-блоков.</p>
                    </article>

                    <article class="df-article-card">
                        <strong>Comparison</strong>
                        <h3>AI-система против подрядчика на контент: что контролируешь ты</h3>
                        <p>Формат, который работает и на SEO, и на GEO: реальный вопрос и прямой структурный ответ без воды.</p>
                    </article>

                    <article class="df-article-card">
                        <strong>Proof article</strong>
                        <h3>Из чего состоит рабочий контур публикации, который не разваливается</h3>
                        <p>Материал, где можно показать свою систему и одновременно мягко довести человека до экскурсии.</p>
                    </article>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <section class="df-section" id="contact">
        <div class="container">
            <div class="df-cta-shell">
                <div class="df-cta-grid">
                    <div>
                        <span class="df-eyebrow">Экскурсия</span>
                        <h2>Вход в воронку должен ощущаться дорогим, спокойным и желанным</h2>
                        <p class="df-lead">
                            Не “оставьте заявку и мы вам перезвоним”, а приглашение посмотреть
                            систему изнутри: как она устроена, где ее границы, кому она подходит
                            и что именно можно собрать под твой контур.
                        </p>

                        <div class="df-actions">
                            <a class="btn btn-primary" href="<?php echo esc_url($telegram_url); ?>" target="_blank" rel="noopener noreferrer">Написать в Telegram</a>
                            <a class="btn btn-outline" href="<?php echo esc_url($blog_url); ?>">Сначала изучить блог</a>
                        </div>
                    </div>

                    <div class="df-contact-stack">
                        <article class="df-side-card">
                            <h3>Что человек должен почувствовать</h3>
                            <p>
                                Что перед ним не “услуга на коленке”, а хорошо собранная среда,
                                в которую можно безопасно зайти.
                            </p>
                        </article>

                        <article class="df-side-card">
                            <h3>Контакты</h3>
                            <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                            <p><a href="tel:<?php echo esc_attr($phone_href); ?>"><?php echo esc_html($phone); ?></a></p>
                            <p><a href="<?php echo esc_url($telegram_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($telegram); ?></a></p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
