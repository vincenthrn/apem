<?php
/**
 * Child Theme functions loads the main theme class and extra options
 *
 * @package Angle Child
 * @subpackage Child
 * @since 1.3
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.0
 */

function oxy_load_child_scripts() {
    wp_enqueue_style( THEME_SHORT . '-child-theme' , get_stylesheet_directory_uri() . '/style.css', array( THEME_SHORT . '-theme' ), false, 'all' );
}
add_action( 'wp_enqueue_scripts', 'oxy_load_child_scripts');
