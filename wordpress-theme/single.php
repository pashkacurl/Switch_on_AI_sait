<?php
/**
 * The template for displaying single posts.
 *
 * @package SwitchOnAI
 */

get_header();
?>

<main id="primary" class="site-main content-shell">
    <div class="container">
        <div class="content-layout">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());

                the_post_navigation(array(
                    'prev_text' => '<span>Предыдущий материал</span> <strong>%title</strong>',
                    'next_text' => '<span>Следующий материал</span> <strong>%title</strong>',
                ));
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>
