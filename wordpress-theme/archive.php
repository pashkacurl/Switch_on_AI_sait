<?php
/**
 * The template for displaying archive pages.
 *
 * @package SwitchOnAI
 */

get_header();
?>

<main id="primary" class="site-main content-shell">
    <div class="container">
        <div class="content-layout">
            <header class="archive-header">
                <span class="section-label">Архив</span>
                <?php the_archive_title('<h1>', '</h1>'); ?>
                <?php the_archive_description('<p>', '</p>'); ?>
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
