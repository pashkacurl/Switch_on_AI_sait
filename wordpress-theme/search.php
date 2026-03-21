<?php
/**
 * The template for displaying search results pages.
 *
 * @package SwitchOnAI
 */

get_header();
?>

<main id="primary" class="site-main content-shell">
    <div class="container">
        <div class="content-layout">
            <header class="archive-header">
                <span class="section-label">Поиск</span>
                <h1>
                    <?php
                    printf(
                        'Результаты по запросу: <span class="text-accent">%s</span>',
                        esc_html(get_search_query())
                    );
                    ?>
                </h1>
            </header>

            <div class="posts-grid">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', get_post_type());
                    endwhile;

                    the_posts_pagination(array(
                        'mid_size'  => 1,
                        'prev_text' => 'Назад',
                        'next_text' => 'Вперед',
                    ));
                else :
                    get_template_part('template-parts/content', 'none');
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
?>
