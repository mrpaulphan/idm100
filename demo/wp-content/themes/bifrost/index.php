<?php 
/**
 * Index Page
 */
get_header();

if (get_theme_mod('blog_title') || get_theme_mod('blog_content')) :
?>
   <div class="container">
        <div class="h-large-top-padding">
            <h2 class="a-page-title"><?php echo esc_attr(get_theme_mod('blog_title')) ?></h2>
            <?php echo wpautop(wp_kses_post(get_theme_mod('blog_content'))) ?>
        </div>
   </div>
<?php
endif;

get_template_part('templates/blog/base');

get_footer();