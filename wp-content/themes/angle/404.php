<?php
/**
 * Displays the themes 404 page
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
?>
<section class="section section-slim text-center <?php echo oxy_get_option( '404_header_swatch' ); ?>">
	<div class="container">
		<div class="section-header no-underline">
    	<div class="h1 hyper hairline">
    		<?php echo stripslashes( oxy_get_option( '404_title' ) ); ?>
    	</div>
    </div>
    <div class="text-center">
    	<img src="<?php echo oxy_get_option( '404_header_image' ); ?>" alt="Page not found!">
		</div>
  </div>
</section>
<section class="section <?php echo oxy_get_option( '404_swatch' ); ?> has-top">
  <?php echo oxy_section_decoration( 'top', 'triangle' ); ?>
  <div class="container">
    <?php get_template_part('partials/content', '404'); ?>
  </div>
</section>
<?php get_footer();
