<?php
/**
 * Displays a single portfolio post
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
// get template to use for portfolio
$page_template = get_post_meta( $post->ID, THEME_SHORT.'_template', true );

// load the template
if( $page_template == 'page.php'){
    if ( $overridden_template = locate_template( $page_template ) ) {
        // locate_template() returns path to file
        // if either the child theme or the parent theme have overridden the template
        load_template( $overridden_template );
    }
    else {
        // If neither the child nor parent theme have overridden the template,
        // we load the template from the 'templates' sub-directory of the directory this file is in
        load_template( dirname( __FILE__ ) . '/' . $page_template  );
    }
}
else if($page_template == 'big'){
    get_template_part('partials/content', 'portfolio-single-big');
}
else{
    get_template_part('partials/content', 'portfolio-single-small');
}

get_footer();