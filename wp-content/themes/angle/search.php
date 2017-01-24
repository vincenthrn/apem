<?php
/**
 * Displays a category list
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
$search_result_decoration = oxy_get_option('search_result_decoration');
oxy_blog_header( __('Results for', 'angle-td'), '<small>' . get_search_query()  . '</small>' );
?>
<section class="section <?php echo oxy_get_option('search_result_swatch'); ?> has-top">
    <?php echo oxy_section_decoration( 'top', $search_result_decoration ); ?>
    <div class="container">
        <div class="row">
            <?php get_template_part( 'partials/loop' ); ?>
        </div>
    </div>
</section>
<?php get_footer();