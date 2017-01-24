<?php
/**
 * Displays a tag archive
 * @package Angle
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

get_header();
$title = null;
$subtitle = null;
if( is_day() ) {
    $title = get_the_date( 'j M Y' );
    $subtitle = __( 'All posts from', 'angle-td' ) . ' ' . get_the_date( 'j M Y' );
}
elseif( is_month() ) {
    $title = get_the_date( 'F Y' );
    $subtitle = __( 'All posts from', 'angle-td' ) . ' ' . get_the_date( 'F Y' );
}
elseif( is_year() ) {
    $title = get_the_date( 'Y' );
    $subtitle = __( 'All posts from', 'angle-td' ) . ' ' . get_the_date( 'Y' );
}
oxy_blog_header( $title, $subtitle );
$blog_decoration = oxy_get_option('blog_header_decoration');
?>

<section class="section <?php echo oxy_get_option('blog_swatch'); ?>">
    <?php echo oxy_section_decoration( 'top', $blog_decoration ); ?>
    <div class="container">
        <div class="row">
            <?php get_template_part( 'partials/loop' ); ?>
        </div>
    </div>
</section>
<?php get_footer();