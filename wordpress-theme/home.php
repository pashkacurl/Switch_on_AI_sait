<?php
/**
 * The blog posts index template.
 *
 * @package SwitchOnAI
 */

get_header();
?>

<main id="primary" class="site-main content-shell">
    <div class="container">
        <div class="content-layout">
            <header class="archive-header">
                <span class="section-label">Блог</span>
                <h1><?php echo esc_html(get_the_title(get_option('page_for_posts')) ?: 'Материалы и статьи'); ?></h1>
                <p>Статьи, разборы и заметки об AI-контент-системах, стратегии и управляемом росте без лишнего шума.</p>
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
