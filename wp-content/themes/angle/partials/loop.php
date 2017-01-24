<?php
/**
 * Main Blog loop
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.4
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license **LICENSE**
 * @version 1.12.2
 */
?>

<?php if( oxy_get_option('blog_layout') == 'sidebar-left' ): ?>
<aside class="col-md-3 sidebar">
    <?php get_sidebar(); ?>
</aside>
<?php endif; ?>

<div class="<?php echo oxy_get_option('blog_layout') == 'full-width' ? 'col-md-12':'col-md-9' ; ?>">
    <?php if( have_posts() ) : ?>
    <?php
        $post_count = 1;
        while( have_posts() ) {
            the_post();
            if( is_search() || is_author() ) {
                include( locate_template( 'partials/content-search.php' ) );
            }
            else {
                get_template_part( 'partials/content', get_post_format() );
            }
            $post_count++;
        }
    ?>

    <?php oxy_pagination($wp_query->max_num_pages); ?>
    <?php else: ?>
        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found', 'angle-td' ); ?></h1>
            </header>

            <div class="entry-content">
            <?php
                if( is_category() ) {
                    $message = __('Sorry, no posts were found for this category.', 'angle-td');
                }
                else if( is_date() ) {
                    $message = __('Sorry, no posts found in that timeframe', 'angle-td');
                }
                else if( is_author() ) {
                    $message = __('Sorry, no posts from that author were found', 'angle-td');
                }
                else if( is_tag() ) {
                    $message = sprintf( __('Sorry, no posts were tagged with  "%1$s"', 'angle-td'), single_tag_title( '', false ) );
                }
                else if( is_search() ) {
                    $message = sprintf( __('Sorry, no search results were found for  "%1$s"', 'angle-td'), get_search_query() );
                }
                else {
                    $message = __( 'Sorry, nothing found', 'angle-td' );
                }
            ?>
                <p><?php echo $message; ?></p>
            </div>
        </article>
    <?php endif; ?>
</div>

<?php if( oxy_get_option('blog_layout') == 'sidebar-right' ): ?>
<aside class="col-md-3 sidebar">
    <?php get_sidebar(); ?>
</aside>
<?php endif;