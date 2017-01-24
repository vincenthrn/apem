<?php
/**
 * Author page template
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
$author_decoration = oxy_get_option('author_decoration');
// get the author name
if( get_query_var('author_name') ) {
    $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
}
else {
    $author = get_userdata( get_query_var( 'author' ) );
}
?>
<section class="section <?php echo oxy_get_option('blog_header_swatch'); ?> text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box-round box-huge box-round flat-shadow">
                    <div class="box-dummy"></div>
                    <figure class="box-inner">
                        <?php echo get_avatar( $author->ID, 300 ); ?>
                    </figure>
                </div>
                <h1>
                    <?php the_author_meta('display_name', $author->ID) ?>
                </h1>
                <p class="lead">
                    <?php the_author_meta('description', $author->ID); ?>
                </p>
            </div>
            
        </div>
    </div>
</section>
<section class="section <?php echo oxy_get_option('author_bio_swatch'); ?> has-top">
    <?php echo oxy_section_decoration( 'top', $author_decoration ); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php get_template_part( 'partials/loop' ); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();
