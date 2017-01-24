<?php
/**
 * BBPress actions
 *
 * @package Angle
 * @subpackage BBPress
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

class AngleBBPress extends OxygennaBBPress
{
    public function __construct($options_file)
    {
        parent::__construct($options_file);
    }

    public function global_page_header()
    {
        global $oxy_theme_options;        
        if (isset( $oxy_theme_options['bbpress_header_show_header']) && $oxy_theme_options['bbpress_header_show_header'] === 'show') {
            // use custom title
            $title = $this->get_page_header_title();

            echo oxy_shortcode_section( array(
                // header options
                'title'           => $title,                
                'title_size'      => $oxy_theme_options['bbpress_header_title_size'],
                'title_weight'    => $oxy_theme_options['bbpress_header_title_weight'],
                'title_align'     => $oxy_theme_options['bbpress_header_title_align'],
                'title_underline' => $oxy_theme_options['bbpress_header_title_underline'],
                // section options
                'swatch'          => $oxy_theme_options['bbpress_header_header_swatch'],
                'height'          => $oxy_theme_options['bbpress_header_header_height'],
                // background options
                'background_image'                => $oxy_theme_options['bbpress_header_background_image'],
                'background_video'                => $oxy_theme_options['bbpress_header_background_video'],
                'background_video_webm'           => $oxy_theme_options['bbpress_header_background_video_webm'],
                'background_position_vertical'    => $oxy_theme_options['bbpress_header_background_position_vertical'],
                'overlay_colour'                  => $oxy_theme_options['bbpress_header_overlay_colour'],
                'overlay_opacity'                 => $oxy_theme_options['bbpress_header_overlay_opacity'],
                'overlay_grid'                    => $oxy_theme_options['bbpress_header_overlay_grid'],
                'background_image_size'           => $oxy_theme_options['bbpress_header_background_image_size'],
                'background_image_repeat'         => $oxy_theme_options['bbpress_header_background_image_repeat'],
                'background_image_attachment'     => $oxy_theme_options['bbpress_header_background_image_attachment'],
            ));     
        }
    }
}


// only load all of this if bbpress is active
if( class_exists( 'bbPress' ) ) {
    $oxy_bbpress = new AngleBBPress(OXY_THEME_DIR . 'inc/options/bbpress-options/option-pages.php');
}