<?php
/**
 * The template for displaying all pages.
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
                get_template_part('template-parts/content', 'page');
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>
