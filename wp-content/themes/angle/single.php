<?php
/**
 * Displays a single post
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
oxy_blog_header();
$allow_comments = oxy_get_option( 'site_comments' );
$blog_decoration = oxy_get_option('blog_header_decoration');
?>
<section class="section <?php echo oxy_get_option('blog_swatch'); ?>">
    <?php echo oxy_section_decoration( 'top', $blog_decoration ); ?>
    <div class="container">
        <div class="row">
            <?php if( oxy_get_option('blog_layout') == 'sidebar-left' ): ?>
            <aside class="col-md-3 sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <?php endif; ?>
            <div class="<?php echo oxy_get_option('blog_layout') == 'full-width' ? 'col-md-12':'col-md-9' ; ?>">
                <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'partials/content', get_post_format() ); ?>

                <nav id="nav-below" class="post-navigation padded">
                    <ul class="pager">
                        <?php if( get_previous_post() ) : ?>
                            <li class="previous">
                                <a class="btn btn-primary btn-icon btn-icon-left" rel="prev" href="<?php echo get_permalink(get_adjacent_post(false, '', true)); ?>">
                                    <div class="hex-alt">
                                        <i class="fa fa-angle-left"></i>
                                    </div>
                                    <?php _e( 'Previous', 'angle-td' ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if( get_next_post() ) : ?>
                            <li class="next">
                                <a class="btn btn-primary btn-icon btn-icon-right" rel="next" href="<?php echo get_permalink(get_adjacent_post(false, '', false)); ?>">
                                    <?php _e( 'Next', 'angle-td' ); ?>
                                    <div class="hex-alt">
                                        <i class="fa fa-angle-right"></i>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav><!-- nav-below -->

                <?php if( $allow_comments == 'posts' || $allow_comments == 'all' ) comments_template( '', true ); ?>

                <?php endwhile; ?>
            </div>
            <?php if( oxy_get_option('blog_layout') == 'sidebar-right' ): ?>
            <aside class="col-md-3 sidebar">
                <?php get_sidebar(); ?>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if( oxy_get_option('related_posts') == 'on')  get_template_part( 'partials/post-related'); ?>
<?php get_footer();

