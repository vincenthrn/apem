<?php
/**
 * Template Name: Left Sidebar
 *
 * @package Angle
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

get_header();
global $post;
oxy_page_header( $post->ID );
$allow_comments = oxy_get_option( 'site_comments' );
?>
<section class="section <?php echo get_post_meta( $post->ID, THEME_SHORT. '_sidebar_page_swatch', true ); ?>">
    <?php echo oxy_section_decoration( 'top', get_post_meta( $post->ID, THEME_SHORT. '_sidebar_page_decoration', true ) ); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'partials/content', 'page' ); ?>

                <?php if( $allow_comments == 'pages' || $allow_comments == 'all' ) comments_template( '', true ); ?>

                <?php endwhile; ?>
            </div>
            <div class="col-md-3 col-md-pull-9 sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();