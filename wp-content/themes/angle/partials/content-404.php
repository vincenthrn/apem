<?php
/**
 * Displays a 404 page
 *
 * @package Angle
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */
?>

<div class="section-header">
    <?php echo stripslashes( oxy_get_option( '404_content' ) ); ?>
</div>
<div class="text-center">
    <a href="<?php echo home_url(); ?>" class="btn btn-primary btn-lg btn-icon-right  pull-center">
        <?php _e( 'Home Page', 'angle-admin-td' ); ?>
        <div class="hex-alt hex-alt-big">
            <i class="fa fa-home animated tada" data-animation = "tada"></i>
        </div>
    </a>
</div>

