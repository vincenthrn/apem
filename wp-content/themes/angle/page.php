<?php
/**
 * Default page template
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
while( have_posts() ) {
    the_post();
    get_template_part('partials/content', 'page');
}

$allow_comments = oxy_get_option( 'site_comments' );
?>
<?php if( $allow_comments == 'pages' || $allow_comments == 'all' ) : ?>
<section class="section <?php echo oxy_get_option('footer_swatch'); ?>">
    <div class="container">
        <div class="row">
            <?php comments_template( '', true ); ?>
        </div>
    </div>
</section>
<?php
endif;
get_footer();