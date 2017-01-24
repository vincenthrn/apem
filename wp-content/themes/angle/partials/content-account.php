<?php
/**
 * Shows a woocommerce account page
 *
 * @package Angle
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

global $woocommerce;
$shop_decoration = oxy_get_option('woocom_general_decoration');
?>
<section class="section section-commerce section-short <?php echo apply_filters( 'oxy_woocommerce_shop_classes', 10 );?> has-top">
    <?php echo oxy_section_decoration( 'top', $shop_decoration ); ?>
    <div class="container">
        <?php wc_print_notices(); ?>
        <div class="row">
        <?php if( is_user_logged_in() ) : ?>
            <div class="col-md-3">
                <?php
                if ( has_nav_menu( 'account' ) ) {
                   wp_nav_menu( array( 'theme_location' => 'account', 'menu_class' => 'nav nav-pills nav-stacked', 'depth' => 0 ) );
                }
                else {
                    _e( 'create an account menu in the admin options', 'angle-td' );
                } ?>
            </div>
            <div class="col-md-9">
                <?php the_content(); ?>
            </div>
        <?php else : ?>
            <div class="col-md-12">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>
