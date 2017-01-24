<?php
/**
 * Themes shortcode functions go here
 *
 * @package Angle
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

/****************** VISUAL COMPOSER SHORTCODES *******************************/

/**
 * Creates a simple section shortcode
 *
 * @return Section HTML
 **/
function oxy_shortcode_section($atts , $content = '') {
    extract( shortcode_atts( array(
        //  options
        'title'           => '',
        'subtitle'        => '',
        'title_size'      => 'normal',
        'title_weight'    => 'regular',
        'title_align'     => 'center',
        'title_underline' => 'no-underline',
        // section options
        'swatch'            => 'swatch-white-red',
        'top_decoration'    => 'none',
        'bottom_decoration' => 'none',
        'height'            => 'normal',
        'fullheight'        => 'off',
        'width'             => 'padded',
        'class'             => '',
        'id'                => '',
        'vertical_alignment'=> 'top',
        // background options
        'background_image'               => '',
        'background_video'               => '',
        'background_video_webm'          => '',
        'background_position_vertical'   => '0',
        'overlay_colour'                 => '#FFF',
        'overlay_opacity'                => '0',
        'overlay_grid'                   => 'off',
        'background_image_size'          => 'cover',
        'background_image_repeat'        => 'no-repeat',
        'background_image_attachment'    => 'scroll'
    ), $atts ) );

    global $oxy_is_iphone, $oxy_is_ipad, $oxy_is_android;
    $section_classes = array();
    $section_classes[] = $swatch;
    $has_video = ( !empty( $background_video ) || !empty( $background_video_webm ) ) && ( !$oxy_is_iphone && !$oxy_is_ipad  && !$oxy_is_android || oxy_get_option( 'mobile_videos' ) === 'on' );

    if( !empty( $fullheight ) && $fullheight !== 'off' ) {
        $section_classes[] = 'section-fullheight';
    }
    if( !empty( $height ) ) {
        $section_classes[] = 'section-' . $height;
    }
    if( !empty( $bottom_decoration )  && $bottom_decoration !== 'none' ) {
        $section_classes[] = 'has-bottom';
    }
    if( !empty( $top_decoration ) && $top_decoration !== 'none' ) {
        $section_classes[] = 'has-top';
    }
    $section_classes[] = $class;
    $container_class = $width == 'padded' ? 'container' : 'container-fullwidth';
    $row_class = 'vertical-' . $vertical_alignment;


    $set_id = $id == '' ? '' : 'id="' . $id . '"';
    $output = '<section ' . $set_id . ' class="section ';
    $output .= implode( ' ', $section_classes );
    $output .= '" ';
    $output .= '>';

    $output .= oxy_section_decoration( 'top', $top_decoration );

    // add background div
    $output .= '<div class="background-media"';
    if( !empty( $background_image ) ) {
        if( is_numeric( $background_image ) ) {
             $attachment_image = wp_get_attachment_image_src( $background_image, 'full' );
             $background_image = $attachment_image[0];
        }
        if( !$has_video ) {
            // changing the sign of the offset to behave the same as the video background
            $background_position_vertical = -$background_position_vertical;
            $output .= ' style="';
            $output .= "background-image:url('" . $background_image . "');";
            $output .= 'background-repeat:' . $background_image_repeat . ';';
            $output .= 'background-size:' . $background_image_size . ';';
            $output .= 'background-attachment:' . $background_image_attachment . ';';
            $output .= 'background-position:center '. $background_position_vertical .'%;"';
        }
    }
    $output .= '>';

    if( $has_video ) {
            $output .= '<video style="width: 100%; height: 100%;" poster="'.$background_image.'" loop autoplay class="section-background-video">';
            if( is_numeric( $background_video ) ) {
                $background_video = wp_get_attachment_url( $background_video );
            }
            if( is_numeric( $background_video_webm ) ) {
                $background_video_webm = wp_get_attachment_url( $background_video_webm );
            }
            $output .= !empty($background_video) ? '<source type="video/mp4" src="'.$background_video.'"/>': '';
            $output .= !empty($background_video_webm) ? '<source type="video/webm" src="'.$background_video_webm.'"/>': '';
            $output .= '</video>';
    }
    $output .= '</div>';

    $overlay_styles = array();
    if( $overlay_grid !== 'off' && !empty($overlay_grid) ) {
        $overlay_styles[] = "background-image: url('" . OXY_THEME_URI . "assets/images/grid.png')";
    }
    $overlay_background_colour = oxy_hex2rgba( $overlay_colour, $overlay_opacity );
    if( $overlay_background_colour !== false ) {
        $overlay_styles[] = 'background-color:' . $overlay_background_colour;
    }
    $output .= '<div class="background-overlay" style="' . implode( ';', $overlay_styles ) . '"></div>';

    $output .= '<div class="' . $container_class . '">';
    $output .= oxy_section_header( $atts );
    if( !empty( $content ) ) {
        $output .= '<div class="row '.$row_class.'">';
        $output .= do_shortcode( $content );
        $output .= '</div>';
    }
    $output .= '</div>';

    $output .= oxy_section_decoration( 'bottom', $bottom_decoration );

    $output .= '</section>';
    return $output;
}
add_shortcode( 'vc_row', 'oxy_shortcode_section' );

/**
 * Creates a section header ( used in page header sections and section headers )
 *
 * @return shortcode HTML
 **/
function oxy_section_header( $options ) {
    extract( shortcode_atts( array(
        'title'           => '',
        'subtitle'        => '',
        'title_size'      => '',
        'title_weight'    => 'regular',
        'title_align'     => 'center',
        'title_underline' => 'no-underline',
    ), $options ) );

    $header = '';
    if( !empty( $title ) || !empty( $subtitle ) ) {
        $header .= '<header class="section-header text-' . $title_align . ' ' . $title_underline . '">';
        if( !empty( $title ) ) {
            $header .= '<h1 class="headline ' . $title_size . ' ' . $title_weight . '">';
            $header .= $title;
            $header .= '</h1>';
        }
        if( !empty( $subtitle ) ) {
            $header .= '<p>' . $subtitle . '</p>';
        }
        $header .= '</header>';
    }

    return $header;
}

/**
 * Creates an Inner Row ( rendered when a user adds a nested row )
 *
 * @return shortcode HTML
 **/
function oxy_section_vc_row_inner( $atts, $content ) {
    extract( shortcode_atts( array(
        'extra_classes' => ''
    ), $atts ) );

    $output = '<div class="row ' . $extra_classes . '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'vc_row_inner', 'oxy_section_vc_row_inner' );

/**
 * Handles VC columns
 *
 * @return shortcode HTML
 **/
function oxy_section_vc_column( $atts, $content ) {
    extract( shortcode_atts( array(
        'width'                => '1/1',
        'extra_classes'        => '',
        'align'                => 'default',
        'os_animation_enabled' => 'off',
        'os_animation'         => 'bounce',
        'os_animation_delay'   => '0.1'
    ), $atts ) );

    $fraction = array('whole' => 0);
    preg_match('/^((?P<whole>\d+)(?=\s))?(\s*)?(?P<numerator>\d+)\/(?P<denominator>\d+)$/', $width, $fraction);
    $decimal_width = $fraction['whole'] + $fraction['numerator'] / $fraction['denominator'];

    $column_classes = array();
    $column_attrs = array();
    $column_classes[] = 'col-md-' . floor( $decimal_width * 12 );
    $column_classes[] = $extra_classes;
    $column_classes[] = 'text-' . $align;
    if($os_animation_enabled ==='on'){
        $column_classes[] = 'os-animation';
        $column_attrs[] = 'data-os-animation="'.$os_animation.'"';
        $column_attrs[] = 'data-os-animation-delay="'.$os_animation_delay.'s"';
    }

    $output = '<div class="' . implode( ' ', $column_classes ) . '" ' . implode( ' ', $column_attrs) . '>';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
}
add_shortcode( 'vc_column', 'oxy_section_vc_column' );
add_shortcode( 'vc_column_inner', 'oxy_section_vc_column' );

/**
 * Handles VC column text
 *
 * @return shortcode HTML
 **/
function oxy_section_vc_column_text( $atts, $content ) {
    extract( shortcode_atts( array(
        'extra_classes'        => ''
    ), $atts ) );

    $output = '';
    // removed wrongly placed p tags and insert them again after entering some newlines
    $content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");

    if (!empty($extra_classes)) {
        $output .= '<div class="' . $extra_classes . '">';
    }

    $output .= do_shortcode( $content );

    if (!empty($extra_classes)) {
        $output .= '</div>';
    }
    return $output;
}
add_shortcode( 'vc_column_text', 'oxy_section_vc_column_text' );

/**
 * Handles VC separator
 *
 * @return <hr> HTML
 **/
function oxy_section_vc_separator( $atts, $content ) {
    return '<hr>';
}
add_shortcode( 'vc_separator', 'oxy_section_vc_separator' );


/**
 * Handles VC image shortcode
 *
 * @return shortcode HTML
 **/
function oxy_section_vc_single_image($atts , $content = '') {
    // setup options
    extract( shortcode_atts( array(
        'images'        => null,
        'src'           => '',
        'size'          => 'medium',
        'alt'           => '',
        'align'         => 'none',
        'link'          => '',
        'link_target'   => '_self',
    ), $atts ) );

    $output = '';
    if( null !== $images ) {
        // just a regular image
        $attachment = wp_get_attachment_image_src( $images, $size );
        $src = $attachment[0];
        if( !empty( $link ) ) {
            $output .= '<a href="' . $link . '" target="' .$link_target.'">';
        }
        $output .= '<img alt="' . $alt . '" src="' . $src . '" class="align' . $align . '"/>';
        if( !empty( $link ) ) {
            $output .= '</a>';
        }
    }

    return $output;
}
add_shortcode( 'vc_single_image', 'oxy_section_vc_single_image' );


/**
 * Handles VC shaped image shortcode
 *
 * @return shortcode HTML
 **/
function oxy_section_shapedimage($atts , $content = '') {
    // setup options
    extract( shortcode_atts( array(
        'images'       => null,
        'magnific'     => 'off',
        'alt'          => '',
        'link'         => '',
        'link_target'   => '_self',
        'align'        => 'none',
        'animation'    => 'none',
        'shape'        => 'round',
        'shape_size'   => 'medium',
        'shape_shadow' => 'show',
    ), $atts ) );

    $output = '';
    if( null !== $images ) {
        $image_size = $shape === 'round' ? 'square-image' : $shape . '-image';

        $attachment = wp_get_attachment_image_src( $images, $image_size );
        $src = $attachment[0];

        $extra_class = '';
        if($magnific == 'on'){
            $full = wp_get_attachment_image_src( $images, 'full' );
            $link = $full[0];
            $extra_class = 'class="magnific"';
        }


        $classes = array();
        $classes[] = 'box-' . $shape;
        if( $shape_size != 'none' ) {
            $classes[] = 'box-' . $shape_size;
        }
        if( $shape_shadow != 'hide' ) {
            $classes[] = 'flat-shadow';
        }
        $output .= '<div class="box-wrap align' . $align . '" data-animation="' . $animation . '">';
        $output .= '<div class="' . implode( ' ', $classes ) . '">';
        $output .= '<div class="box-dummy"></div>';
        $output .= '<span class="box-inner">';
        if( !empty( $link ) ) {
            $output .= '<a href="' . $link . '" target="' .$link_target.'" '.$extra_class.'>';
        }
        $output .= '<img alt="' . $alt . '" src="' . $src . '"/>';
        if( !empty( $link ) ) {
            $output .= '</a>';
        }
        $output .= '</span>';
        $output .= '</div>';
        $output .= '</div>';
    }

    return $output;
}
add_shortcode( 'shapedimage', 'oxy_section_shapedimage' );


/**
 * Handles VC tabs shortcode
 *
 * @return shortcode HTML
 **/
function oxy_shortcode_vc_tabs($atts , $content = '' ) {
    extract( shortcode_atts( array(
        'style'        => 'top',
        'el_class'     => '',
    ), $atts ) );

    // grab all tabs inside this tabs pane
    $pattern = get_shortcode_regex();
    $count = preg_match_all( '/'. $pattern .'/s', $content, $matches );
    if( is_array( $matches ) && array_key_exists( 2, $matches ) && in_array( 'vc_tab', $matches[2] ) ) {
        $lis  = array();
        $divs = array();
        $extraclass = ' active in';
        for( $i = 0; $i < $count; $i++ ) {
            // is it a tab?
            if( 'vc_tab' == $matches[2][$i] ) {
                $tab_atts = shortcode_parse_atts( $matches[3][$i] );
                $li = '<li class="' . $extraclass . '">';
                $li .= '<a data-toggle="tab" href="#' . $tab_atts['tab_id'] . '">';
                $li .= $tab_atts['title'] .'</a></li>';
                $lis[] = $li;
                $div = '<div class="tab-pane fade' . $extraclass . '" id="' . $tab_atts['tab_id'] . '">';
                $div .= do_shortcode( $matches[5][$i] ) . '</div>';
                $divs[] = $div;
                $extraclass = '';
            }
        }
    }
    switch ($style) {
        case 'top':
            $position = '';
            break;
        case 'bottom':
            $position = 'tabs-below';
            break;
        case 'left':
            $position = 'tabs-left';
            break;
        case 'right':
            $position = 'tabs-right';
            break;
        default:
            $position = '';
            break;
    }
    if($style == 'bottom'){
        return '<div class="tabbable '.$position.' '.$el_class.'"><div class="tab-content">'.implode( $divs ).'</div><ul class="nav nav-tabs" data-tabs="tabs">' . implode( $lis ) . '</ul></div>';
   }
    else{
        return '<div class="tabbable '.$position.' '.$el_class.'"><ul class="nav nav-tabs" data-tabs="tabs">' . implode( $lis ) . '</ul><div class="tab-content">'.implode( $divs ).'</div></div>';
    }
}
add_shortcode( 'vc_tabs', 'oxy_shortcode_vc_tabs' );

/**
 * Handles VC tab shortcode
 *
 * @return shortcode HTML
 **/
function oxy_shortcode_vc_tab($atts , $content=''){

    return do_shortcode($content);
}
add_shortcode( 'vc_tab' , 'oxy_shortcode_vc_tab');

/**
 * Creates a boostrap accordions
 *
 * @return shortcode HTML
 **/
function oxy_shortcode_vc_accordion($atts , $content = '' ) {
    extract( shortcode_atts( array(
        'el_class'     => '',
    ), $atts ) );
    $id = uniqid( 'accordion_' , false );
    $pattern = get_shortcode_regex();
    $count = preg_match_all( '/'. $pattern .'/s', $content, $matches );

    $lis = array();
    if( is_array( $matches ) && array_key_exists( 2, $matches ) && in_array( 'vc_accordion_tab', $matches[2] ) ) {
        for( $i = 0; $i < $count; $i++ ) {
            $group_id = uniqid( 'group' , false );
            // is it a tab?
            if( 'vc_accordion_tab' == $matches[2][$i] ) {
                $accordion_atts = shortcode_parse_atts( $matches[3][$i] );
                $open_close_class = '';

                if ( isset( $accordion_atts['state'] ) ) {
                    if ($accordion_atts['state'] == 'open') {
                        $open_close_class = ' in';
                    }
                }
                $lis[] = '<div class="panel panel-default">';
                $lis[] .= '<div class="panel-heading">';
                $lis[] .= '<a class="accordion-toggle collapsed" data-parent="#' . $id . '" data-toggle="collapse" href="#' . $group_id . '">';
                $lis[] .= $accordion_atts['title'];
                $lis[] .= '</a>';
                $lis[] .= '</div>';
                $lis[] .= '<div class="panel-collapse collapse' . $open_close_class . '" id="' . $group_id . '">';
                $lis[] .= '<div class="panel-body">';
                $lis[] .= '<p>' . do_shortcode( $matches[5][$i] ) . '</p>';
                $lis[] .= '</div>';
                $lis[] .= '</div>';
                $lis[] .= '</div>';
            }
        }
    }
    $output = '<div class="panel-group '.$el_class.'" id="' . $id . '">';
    $output .= implode( $lis );
    $output .= '</div>';
    return $output;
}
add_shortcode( 'vc_accordion', 'oxy_shortcode_vc_accordion' );

/**
 * Creates a boostrap accordion
 *
 * @return shortcode HTML
 **/
function oxy_shortcode_vc_accordion_tab($atts , $content=''){

    return do_shortcode($content);
}
add_shortcode( 'vc_accordion_tab' , 'oxy_shortcode_vc_accordion_tab');

/**
 * Creates a bootstrap button
 *
 * @return bootstrap button HTML
 **/
function oxy_shortcode_button($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'type'      => 'default',
        'size'      => 'normal',
        'show_icon' => 'no-icon',
        'xclass'    => '',
        'link'      => '',
        'title'     => 'My button',
        'icon'      => 'no-icon',
        'link_open' => '_self'
    ), $atts ) );

    $size = $size == '' ? '' : 'btn-' . $size;

    $output = '<a href="'. $link .'" class="btn btn-' . $type . ' ' . $size . ' ' . $xclass . '" target="' . $link_open . '">';
    $icon_output = '<i class="fa fa-' . $icon . '"></i>';

    switch( $show_icon ) {
        case 'left':
            $output .= $icon_output . ' ' . $title;
        break;
        case 'right';
            $output .= $title . ' ' . $icon_output;
        break;
        default:
            $output .= $title;
        break;
    }
    $output .= '</a>';

    return $output;
}
add_shortcode( 'button', 'oxy_shortcode_button' );

/****************** TYPOGRAPHY SHORTCODES *******************************/

/**
 * Code shortcode - for showing code!
 *
 * @return Code html
 **/
function oxy_shortcode_code( $atts, $content = null) {
    return '<pre>' . htmlentities( $content ) . '</pre>';
}
add_shortcode( 'code', 'oxy_shortcode_code' );


/**
 * Featured Icon shortcode - for showing a big icon in a shape
 *
 * @return Icon html
 **/
function oxy_shortcode_icon( $atts, $content = null) {
    extract( shortcode_atts( array(
        'size'       => '16',
    ), $atts ) );

    $output = '<i class="fa fa-' . $content . '"';
    if( $size !== 0 ) {
        $output .= ' style="font-size:' . $size . 'px"';
    }
    $output .= '></i>';
    return $output;
}
add_shortcode( 'icon', 'oxy_shortcode_icon' );

/**
 * Lead Paragraph shortcode
 *
 * @return Lead Paragraph HTML
 **/
function oxy_shortcode_lead( $atts, $content ) {
    extract( shortcode_atts( array(
        'align'  => 'center'
    ), $atts ) );
    return '<p class="lead text-' . $align . '">' . do_shortcode($content) . '</p>';
}
add_shortcode( 'lead', 'oxy_shortcode_lead' );

/**
 * Blockquote Shortcode
 *
 * @return Icon Item HTML
 **/
function oxy_shortcode_blockquote( $atts, $content ) {
    extract( shortcode_atts( array(
        'who'   => '',
        'cite'  => '',
        'align'  => 'left',
    ), $atts ) );

    $output = '<blockquote ';
    if($align == 'right') {
        $output .= 'class = "pull-right"';
    }
    $output .= '><p>' . do_shortcode($content) .'</p>';
    if( !empty( $who ) ) {
        $output .= '<small>' . $who;
        if( !empty( $cite ) ) {
            $output .= ' <cite title="source title">' . $cite . '</cite>';
        }
        $output .= '</small>';
    }
    $output .= '</blockquote>';

    return $output;
}
add_shortcode( 'blockquote', 'oxy_shortcode_blockquote' );

/****************** THEME SHORTCODES *******************************/

/**
 * Feature Shortcode - to show a feature with icon
 *
 * @return Feature Item
 **/
function oxy_shortcode_feature( $atts, $content = null) {
    extract( shortcode_atts( array(
        'show_icon' => 'true',
        'icon'      => '',
        'shape'     => 'round',
        'animation' => 'none',
        'title'     => ''
    ), $atts ) );

    ob_start();
    include( locate_template( 'partials/shortcodes/feature/feature.php' ) );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'feature', 'oxy_shortcode_feature' );


/**
 * Icon shortcode - for showing an icon
 *
 * @return Icon html
 **/
function oxy_shortcode_featuredicon( $atts, $content = null) {
    // setup options
    extract( shortcode_atts( array(
        'icon'         => 'glass',
        'shape'        => 'round',
        'shape_size'   => 'medium',
        'shape_shadow' => 'show',
        'animation'    => '',
    ), $atts ) );

    $output = '';
    if( $shape !== '' ) {
        $classes = array();
        $classes[] = 'box-' . $shape;
        if( $shape_size != 'none' ) {
            $classes[] = 'box-' . $shape_size;
        }
        if( $shape_shadow != 'hide' ) {
            $classes[] = 'flat-shadow';
        }
        $output .= '<div class="box-wrap">';
        $output .= '<div class="' . implode( ' ', $classes ) . '">';
        $output .= '<div class="box-dummy"></div>';
        $output .= '<span class="box-inner">';
        $output .= '<i class="fa fa-' . $icon . '" data-animation="' . $animation . '"></i>';
        $output .= '</span>';
        $output .= '</div>';
        $output .= '</div>';
    }

    return $output;
}
add_shortcode( 'featuredicon', 'oxy_shortcode_featuredicon' );

/**
 * Creates a fancy button
 *
 * @return fancy button HTML
 **/
function oxy_shortcode_button_fancy($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'type'          => 'default',
        'animation'     => '',
        'size'          => '',
        'xclass'        => '',
        'link'          => '',
        'label'         => 'My button',
        'align'         => 'center',
        'icon'          => '',
        'icon_position' => 'left',
        'link_open'     => '_self'
    ), $atts ) );

    $size = $size == '' ? '' : 'btn-' . $size;
    $fancy_class = $icon_position == 'left' ? 'btn-icon-left' : 'btn-icon-right';

    $output = '<div class="text-' . $align . '">';
    $output .= '<a href="'. $link .'" class="btn btn-' . $type . ' ' . $size . ' ' . $xclass . ' ' . $fancy_class . '" target="' . $link_open . '">';
    $animation = ( $animation != '') ? ' data-animation="' . $animation . '"' : '';
    $icon_output = '<span class="hex-alt"><i class="fa fa-' . $icon . '" ' . $animation . '></i></span>';
    $output .= $label . ' ' . $icon_output;
    $output .= '</a>';
    $output .= '</div>';
    return $output;
}
add_shortcode( 'fancybutton', 'oxy_shortcode_button_fancy' );



/* Services Section */
function oxy_shortcode_services( $atts, $content = '') {
    extract( shortcode_atts( array(
        'category'       => '',
        'count'          => '3',
        'style'          => 'horizontal',
        'columns'        => '3',

        'image_shape'    => 'round',
        'image_size'     => 'big',
        'image_shadow'   => 'hide',
        'connected'      => 'show',

        'show_titles'    => 'show',
        'link_titles'    => 'on',
        'show_images'    => 'show',
        'link_images'    => 'on',

        'show_excerpts'  => 'show',
        'align_excerpts' => 'center',
        'show_readmores' => 'show',
        'readmore_text'  => 'Read more',
        'orderby'        => 'none',
        'order'          => 'ASC',
    ), $atts ) );

    // calculate column span
    $columns = $columns > 0 ? floor( 12 / $columns ) : 12;

    // are we showing connected lines
    $connected = 'show' === $connected ? $style . '-icon-border' : '';

    $query = array(
        'post_type'        => 'oxy_service',
        'posts_per_page'   => $count === '0' ? -1 : $count,
        'orderby'          => $orderby,
        'order'            => $order,
        'suppress_filters' => 0
    );

    if( !empty( $category ) ) {
        $query['tax_query'] = array(
            array(
                'taxonomy' => 'oxy_service_category',
                'field'    => 'slug',
                'terms'    => $category
            )
        );
    }

    // get the services
    global $post;
    $query = new WP_Query($query);
    $services = $query->get_posts();

    ob_start();
    include( locate_template( 'partials/shortcodes/services/' . $style . '.php' ) );
    $output = ob_get_contents();
    ob_end_clean();

    // reset post data because we are all done here
    wp_reset_postdata();

    return $output;
}
add_shortcode( 'services', 'oxy_shortcode_services' );

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * images on a post.
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 * @since 1.2
 */
function oxy_gallery_shortcode($attr) {
    $post = get_post();

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => '3',
        'size'       => 'rect-image',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby, 'posts_per_page' => -1) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $columns = intval($columns);
    $span_width = $columns > 0 ? floor( 12 / $columns ) : 12;
    $data_links = array();

    foreach ( $attachments as $id => $attachment ) {
        $full = wp_get_attachment_image_src( $id, 'full' );
        $data_links[$id] = $full[0];
    }

    $output = '<div class="row">';
    foreach ( $attachments as $id => $attachment ) {
        $thumb = wp_get_attachment_image_src( $id, $size );
        $full = wp_get_attachment_image_src( $id, 'full' );
        // add the item clicked first in the gallery
        foreach ($data_links as $key => $value) {
            if ($value === $full[0]) {
                 $idx = $key;
                 $add_to_front = $value;
            }
        }
        unset($data_links[$idx]);
        array_unshift($data_links, $add_to_front);
        $str_data_links = implode(",", $data_links);
        $output .= '<div class="col-md-' . $span_width . '">';
        $output .= '<a class="thumbnail magnific-gallery" href="' . $full[0]  . '" data-links=" '. $str_data_links .' ">';
        $output .= '<img src="' . $thumb[0] . '">';
        $output .= '</a>';
        $output .= '</div>';
    }

    $output .= '</div>';
    return $output;
}
add_shortcode( 'gallery', 'oxy_gallery_shortcode' );

/* ---------- TESTIMONIALS SHORTCODE ---------- */

function oxy_shortcode_testimonials( $atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'count'       => '3',
        'group'       => '',
        'show_image'  => 'show',
        'slideshow'   => 'on',
        'speed'       => '7000',
        'randomize'   => 'off',
    ), $atts ) );

    $order_by = $randomize === 'off' ? 'menu_order' : 'rand';

    $query_options = array(
        'post_type'        => 'oxy_testimonial',
        'posts_per_page'   => $count === '0' ? -1 : $count,
        'order'            => 'ASC',
        'orderby'          => $order_by,
        'suppress_filters' => 0
    );

    if( !empty( $group ) ) {
        $query_options['tax_query'] = array(
            array(
                'taxonomy' => 'oxy_testimonial_group',
                'field' => 'slug',
                'terms' => $group
            )
        );
    }
    // fetch posts
    $query = new WP_Query($query_options);
    $items = $query->get_posts();
    $items_count = count( $items );
    $layout = $show_image == 'show'? 'image':'no-image';
    $output = '';
    if( $items_count > 0):
        ob_start();
        include( locate_template( 'partials/shortcodes/testimonials/'.$layout.'.php' ) );
        $output = ob_get_contents();
        ob_end_clean();
    endif;

    // reset post data because we are all done here
    wp_reset_postdata();

    return $output;
}


add_shortcode( 'testimonials', 'oxy_shortcode_testimonials' );


/* Staff List */
function oxy_shortcode_staff_list($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'department'       => '',
        'count'            => '3',
        'columns'          => '3',

        'image_shape'      => 'round',
        'image_size'       => 'big',
        'image_shadow'     => 'hide',

        'link_name'        => 'on',
        'show_position'    => 'show',
        'show_excerpts'    => 'show',
        'align_excerpts'   => 'center',

        'show_social'      => 'show',
        'link_target'      => '_self',
        'orderby'          => 'none',
        'order'            => 'ASC',
    ), $atts ) );

    $query_options = array(
        'post_type'      => 'oxy_staff',
        'posts_per_page'   => $count === '0' ? -1 : $count,
        'orderby'        => $orderby,
        'order'          => $order,
        'suppress_filters' => 0
    );

    if( !empty( $department ) ) {
        $query_options['tax_query'] = array(
            array(
                'taxonomy' => 'oxy_staff_department',
                'field' => 'slug',
                'terms' => $department
            )
        );
    }

    $columns = $columns > 0 ? floor( 12 / $columns ) : 12;
    // fetch posts
    $query = new WP_Query($query_options);
    $members = $query->get_posts();

    ob_start();
    include( locate_template( 'partials/shortcodes/staff/list.php' ) );
    $output = ob_get_contents();
    ob_end_clean();

    // reset post data because we are all done here
    wp_reset_postdata();

    return $output;
}
add_shortcode( 'staff_list', 'oxy_shortcode_staff_list' );



/* ---------------- FEATURED STAFF MEMBER SHORTCODE --------------- */

function oxy_shortcode_staff_featured($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'member'         => '',
        'image_shape'    => 'round',
        'image_size'     => 'big',
        'image_shadow'   => 'hide',
        'show_position'  => 'show',
        'show_content'   => 'show',
        'content_size'   => 'big',
        'align_content'  => 'center',
        'show_social'    => 'show',
        'link_target'    => '_self'
    ), $atts ) );

    $output = "";
    if($member !== '') {
        global $post;
        $post = get_post( $member );
        setup_postdata( $post );

        ob_start();
        include( locate_template( 'partials/shortcodes/staff/featured.php' ) );
        $output = ob_get_contents();
        ob_end_clean();

        wp_reset_postdata();
    }

    return $output;
}
add_shortcode( 'staff_featured', 'oxy_shortcode_staff_featured' );

/* --------------------- PORTFOLIO SHORTCODES --------------------- */

function oxy_shortcode_portfolio( $atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'categories'        => '',
        'count'             => '3',
        'columns'           => '3',
        'pagination'        => 'off',

        'shape'             => 'round',
        'show_shadow'       => 'show',
        'show_title'        => 'show',
        'show_excerpt'      => 'show',
        'show_overlay'      => 'show',
        'show_magnific'     => 'show',
        'magnific_link_type'=> 'show',
        'magnific_caption'  => 'post_title_caption',
        'show_filters'      => 'show',
        'orderby'           => 'none',
        'order'             => 'ASC',
    ), $atts ) );

    $query_options = array(
        'post_type'   => 'oxy_portfolio_image',
        'orderby'     => $orderby,
        'order'       => $order,
        'suppress_filters' => 0,
        'posts_per_page' => $count === '0' ? -1 : $count
    );

    global $paged;
    if ($pagination !== 'off') {
        // if pagination, count sets posts per page
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $query_options['paged'] = $paged;
        $query_options['posts_per_page'] = $count;
    }
    $image_size = $shape === 'round' ? 'square-image' : $shape . '-image';
    $filters = get_terms( 'oxy_portfolio_categories', array( 'hide_empty' => 1 ) );

    if( !empty( $categories ) ) {
        $selected_portfolios = explode( ',', $categories );
        $query_options['tax_query'][] = array(
            'taxonomy' => 'oxy_portfolio_categories',
            'field' => 'slug',
            'terms' => $selected_portfolios
        );
        // remove categories that arent selected from the category filter
        foreach ($filters as $index => $filter) {
            if (!in_array($filter->slug, $selected_portfolios)) {
                unset($filters[$index]);
            }
        }
    }
    else {
        // use all portfolios in the filters
        $selected_portfolios = array();
        foreach( $filters as $filter ) {
            $selected_portfolios[] = $filter->slug;
        }
    }

    $container_class = array();
    if($magnific_link_type === 'magnific-all') {
        $container_class[] = 'magnific-all';
    }
    // fetch posts
    $posts = query_posts( $query_options );
    $output = '';
    if( $count > 0 ) {

        if($pagination == 'infinite'){
            $container_class[] = 'isotope-infinite';
        }
        // Show filters for navigation
        if($show_filters == 'show'):
            ob_start();
            include( locate_template( 'partials/shortcodes/portfolio/filters.php' ) );
            $output .= ob_get_contents();
            ob_end_clean();
        endif;

        ob_start();
        include( locate_template( 'partials/shortcodes/portfolio/items.php' ) );
        $output .= ob_get_contents();
        ob_end_clean();
    }

    wp_reset_query();
    wp_reset_postdata();
    return $output;

}
add_shortcode( 'portfolio', 'oxy_shortcode_portfolio' );


/* ---------------------- PIE CHART SHORTCODE -----------------  */

function oxy_shortcode_pie( $atts , $content = '' ){
    // setup options
    extract( shortcode_atts( array(
        'icon'          => '',
        'icon_animation'=> 'none',
        'bar_colour'    => '',
        'track_colour'  => '',
        'line_width'    => '20',
        'size'          => '200',
        'percentage'    => '50',
    ), $atts ) );

    $icon_animation = $icon_animation != 'none' ? ' data-animation="'.$icon_animation.'"':"";
    $output = '<div class="chart easyPieChart" data-track-color="'.$track_colour.'" data-bar-color="'.$bar_colour.'" data-line-width="'.$line_width.'" data-percent="'.$percentage.'" data-size="'.$size.'">';
    $output.= '<span>'.$percentage.'</span>';
    $output.= '<i class="fa fa-'.$icon.'"'.$icon_animation.'></i></div>';

    return $output;
}

add_shortcode( 'pie', 'oxy_shortcode_pie' );


/* ---------------------- CIRCULAR COUNTER SHORTCODE -----------------  */

function oxy_shortcode_counter( $atts , $content = '' ){
    // setup options
    extract( shortcode_atts( array(
        'value'          => '0',
        'counter_size'   => 'normal',
        'counter_weight' => 'regular',
        'underline'      => 'underline'
    ), $atts ) );

    $output  = '<div class="counter ' . $underline . '" data-count="' . $value . '">';
    $output .= '<span class="value odometer '. $counter_size . ' ' . $counter_weight .'">0</span>';
    $output .= '</div>';

    return $output;
}

add_shortcode( 'counter', 'oxy_shortcode_counter' );

/* ---------------------- COUNTDOWN TIMER SHORTCODE -----------------  */

function oxy_shortcode_countdown( $atts , $content = '' ){
    // setup options
    extract( shortcode_atts( array(
        'date'             => '',
        'number_size'      => 'super',
        'number_weight'    => 'regular',
        'number_underline' => 'underline'
    ), $atts ) );

    $classes = array();
    $classes[] = $number_size;
    $classes[] = $number_weight;
    $classes[] = $number_underline;

    ob_start();
    include( locate_template( 'partials/shortcodes/countdown/countdown.php' ) );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'countdown', 'oxy_shortcode_countdown' );


/* --------------------- PRICING SHORTCODE ---------------------- */

function oxy_shortcode_pricing($atts , $content=''){
    extract( shortcode_atts( array(
        'heading'         => '',
        'featured'        => 'false',
        'show_price'      => 'true',
        'price'           =>  '10',
        'currency'        => '&#36;',
        'custom_currency' => '',
        'per'             => '',
        'list'            => '',
        'show_button'     => 'true',
        'button_text'     => '',
        'button_link'     => ''
    ), $atts ) );

    $classes = array();
    $classes[] = 'pricing-col';
    if( $featured === 'true' ) {
        $classes[] = 'pricing-featured';
    }

    $list = explode( ',', $list );

    ob_start();
    include( locate_template( 'partials/shortcodes/pricing/pricing.php'  ) );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
add_shortcode( 'pricing' , 'oxy_shortcode_pricing');

/**
 * Creates a heading shortcode
 *
 * @return heading HTML
 **/
function oxy_shortcode_heading($atts , $content = '') {
    extract( shortcode_atts( array(
        'header_type'      => 'h1',
        'header_size'      => 'normal',
        'header_weight'    => 'regular',
        'header_align'     => 'center',
        'header_underline' => 'bordered-header'
    ), $atts ) );

    $final_header = '';
    if( !empty( $content ) ) {
        $final_header .= '<' . $header_type . ' class="text-' . $header_align . ' ' . $header_size . ' ' . $header_weight . ' ' . $header_underline . '">';
        $final_header .= $content;
        $final_header .= '</' . $header_type . '>';
    }
    return $final_header;
}
add_shortcode( 'heading', 'oxy_shortcode_heading' );

/*----------------- RECENT NEWS SECTION SHORTCODE AND HELPER FUNCTIONS --------------------*/

function oxy_get_recent_posts( $count, $categories, $authors = null , $post_formats = null ) {
    $query = array();
    // set post count
    global $paged;
    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    }
    elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
    }
    else {
        $paged = 1;
    }
    $query['paged'] = $paged;
    $query['posts_per_page'] = $count;
    // set category if selected
    if( !empty( $categories ) ) {
        $query['category_name'] = $categories;
    }
    // set author if selected
    if( !empty( $authors ) ) {
        $query['author'] = implode( ',', $authors );
    }
    // set post format if selected
    if( !empty( $post_formats ) ) {
        foreach( $post_formats as $key => $value ) {
            $post_formats[$key] = 'post-format-' . $value;
        }
        $query['tax_query'] = array();
        $query['tax_query'][] = array(
            'taxonomy' => 'post_format',
            'field'    => 'slug',
            'terms'    => $post_formats
        );
    }
    // fetch posts
    return query_posts( $query );
}


function oxy_shortcode_recent($atts , $content = '' ) {
    // setup options
    extract( shortcode_atts( array(
        'layout'          => 'simple',
        'pagination'      => 'on',
        'count'           => '3',
        'cat'             => '',
        'post_swatch'     => 'swatch-red-white',
        'columns'         => '3',
        'infinite_scroll' => 'on'
    ), $atts ) );

    $posts = oxy_get_recent_posts( $count, $cat );

    if( '' !== $cat ) {
        $cat = explode( ',', $cat );
        foreach( $cat as $key => $single_cat ) {
            $cat[$key] = get_category_by_slug($single_cat);
        }
    }

    $container_class = '';
    $output = '';
    if( !empty( $posts ) ):

        if($infinite_scroll == 'on' && $layout == 'masonry'){
            $container_class = 'isotope-infinite';
        }

        $span = $columns == false? 'col-md-12':'col-md-'.(12/$columns);
        global $post;

        ob_start();
        include( locate_template( 'partials/shortcodes/posts/'.$layout.'.php' ) );
        $output .= ob_get_contents();
        ob_end_clean();

    endif;

    // reset post data
    wp_reset_postdata();
    wp_reset_query();

    return $output;
}

add_shortcode( 'recent_posts', 'oxy_shortcode_recent' );


/*------------------------ SLIDESHOW SHORTCODE -----------------------*/

function oxy_shortcode_slideshow($atts , $content = '' ){
    $params = shortcode_atts( array(
        'flexslider'         => '',
        'animation'          => 'slide',
        'direction'          => 'horizontal',
        'speed'              => '7000',
        'duration'           => '600',
        'directionnav'       => 'hide',
        'directionnavtype'   => 'simple',
        'itemwidth'          => '',
        'showcontrols'       => 'show',
        'controlsposition'   => 'inside',
        'controlsalign'      => 'center',
        'reverse'            => 'false',
        'animationloop'      => 'true',
        'captions'           => 'show',
        'captions_vertical'  => 'bottom',
        'captions_horizontal'=> 'left',
        'autostart'          => 'true',
        'tooltip'            => 'hide'
    ), $atts );

    return oxy_create_flexslider($params['flexslider'], $params , false);
}

add_shortcode( 'slideshow', 'oxy_shortcode_slideshow');


// just register the link shortcode
function oxy_shortcode_donothing() {
    return '';
}
add_shortcode( 'link', 'oxy_shortcode_donothing' );

function oxy_shortcode_audio($atts, $content) {
    extract( shortcode_atts( array(
        'src'       => '',
        'loop'      => 'off',
        'autoplay'  => 'off',
        'preload'  => 'none'
    ), $atts ) );

    $output = '<div class="post-media overlay">';
    $output .= '<audio controls="controls" preload="' . $preload . '" autoplay="' . $autoplay . '" loop="' . $loop . '">';
    $output .= '<source src="' . $src . '">';
    $output .= '</audio>';
    $output .= '</div>';
    return $output;
}
add_shortcode( 'audio', 'oxy_shortcode_audio' );

/**
 * Icon Item Shortcode - for use inside an iconlist shortcode
 *
 * @return Icon Item HTML
 **/
function oxy_shortcode_social_icon( $atts, $content = null) {
    extract( shortcode_atts( array(
        'url'       => '',
        'icon'      => '',
        'target'    => '_blank',
    ), $atts ) );

    $target = ( $target == '_blank')?'target="_blank"':'';
    $output = '<li>';
    $output .= '<a data-iconcolor="'.oxy_get_icon_color( $icon ).'" href="'.$url.'" '.$target.'>';
    $output .= '<i class="' . $icon . '"></i></a></li>';
    return $output;
}
add_shortcode( 'socialicon', 'oxy_shortcode_social_icon' );


/**
 * Google Map Shortocde
 *
 * @return Map HTML
 **/
function oxy_shortcode_google_map( $atts, $content = null) {
    extract( shortcode_atts( array(
        'map_type'   => 'ROADMAP',
        'map_zoom'   => '15',
        'map_scroll' => 'off',
        'map_draggable' => 'off',
        'map_style'  => 'flat',
        'marker'     => 'show',
        'lat'        => '51.5171',
        'lng'        => '0.1062',
        'address'    => '',
        'label'      => '',
        'height'     => '500',
    ), $atts ) );

    $map_data = array(
        'mapType'   => $map_type,
        'mapZoom'   => $map_zoom,
        'mapStyle'  => $map_style,
        'mapScroll' => $map_scroll === 'on' ? true:false,
        'mapDraggable' => $map_draggable === 'on' ? true:false,
        'marker'    => $marker,
        'lat'       => $lat,
        'lng'       => $lng,
        'markerURL' => OXY_THEME_URI . 'assets/images/marker.png'
    );
    if( !empty( $atts ) ) {
        $map_data = array_merge( $map_data, $atts );
    }

    $map_id = uniqid( 'map_' , false );

    wp_enqueue_script( THEME_SHORT.'-google-map-api', 'https://maps.googleapis.com/maps/api/js?v=3&sensor=false' );
    wp_enqueue_script( THEME_SHORT.'-google-map', OXY_THEME_URI . 'assets/js/map.min.js', array( 'jquery', THEME_SHORT.'-google-map-api' ) );
    wp_localize_script( THEME_SHORT.'-google-map', $map_id, $map_data );

    $output = '<div id="' . $map_id . '" class="google-map" style="height:' . $height . 'px"></div>';

    return $output;
}
add_shortcode( 'map', 'oxy_shortcode_google_map' );


/* ---------- LEAD SHORTCODE ---------- */


/* ------------------ COLUMNS SHORTCODES ------------------- */

function oxy_shortcode_row( $atts, $content = null, $code ) {
    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'row', 'oxy_shortcode_row' );

function oxy_shortcode_span( $atts, $content = null, $code ) {
    $atts['md'] = substr( $code, -1 );
    $classes = array();
    foreach( $atts as $screen_size => $col ) {
        $classes[] = 'col-' . $screen_size . '-' . $col;
    }
    return '<div class="' . implode(' ', $classes) . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'span1', 'oxy_shortcode_span' );
add_shortcode( 'span2', 'oxy_shortcode_span' );
add_shortcode( 'span3', 'oxy_shortcode_span' );
add_shortcode( 'span4', 'oxy_shortcode_span' );
add_shortcode( 'span5', 'oxy_shortcode_span' );
add_shortcode( 'span6', 'oxy_shortcode_span' );
add_shortcode( 'span7', 'oxy_shortcode_span' );
add_shortcode( 'span8', 'oxy_shortcode_span' );
add_shortcode( 'span9', 'oxy_shortcode_span' );
add_shortcode( 'span10', 'oxy_shortcode_span' );
add_shortcode( 'span11', 'oxy_shortcode_span' );
add_shortcode( 'span12', 'oxy_shortcode_span' );


/* ---- BOOTSTRAP ALERT SHORTCODE ----- */

function oxy_shortcode_alert($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'color'       => 'success',
        'title'       => 'Watch Out!',
        'dismissable' => 'false'
    ), $atts ) );

    $dismissable_class = $dismissable == 'true' ? 'alert-dismissable' : '';

    $output = '<div class="alert ' . $color . ' ' . $dismissable_class . '">';
    if( $dismissable == 'true' ) {
        $output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    }
    if( !empty( $title ) ) {
        $output .= '<strong>' . $title . '</strong> ';
    }
    $output .= $content;
    $output .= '</div>';
    return $output;
}


add_shortcode( 'vc_message', 'oxy_shortcode_alert' );

/* ----------------- BOOTSTRAP ACCORDION SHORTCODES ---------------*/


/**
 * Bootstrap Panel Shortcode
 *
 * @return Panel html
 **/
function oxy_shortcode_panel($atts , $content = '' ) {
    extract( shortcode_atts( array(
        'title'        => '',
    ), $atts ) );
    return '<div class="panel panel-default"><div class="panel-heading"><h3 class="panel-title">'.$title.'</h3></div><div class="panel-body">' . do_shortcode( $content ) . '</div></div>';
}

add_shortcode( 'panel' , 'oxy_shortcode_panel');

/* ------------------ PROGRESS BAR SHORTCODE -------------------- */

function oxy_shortcode_progress_bar($atts , $content = '' ) {
     // setup options
    extract( shortcode_atts( array(
        'percentage'  =>  '50',
        'type'        => 'progress',
        'style'       => 'progress-bar-info',

    ), $atts ) );

    return '<div class="'. $type .'"><div class="progress-bar '.$style.'" style="width: '.$percentage.'%"></div></div>';
}


add_shortcode( 'progress', 'oxy_shortcode_progress_bar' );


function oxy_shortcode_sharing($atts, $content = '') {
    extract( shortcode_atts( array(
        'fb_show'         => 'show',
        'twitter_show'    => 'show',
        'google_show'     => 'show',
        'pinterest_show'  => 'show',
        'linkedin_show'   => 'show',
    ), $atts ) );

    ob_start();
    include( locate_template( 'partials/shortcodes/social/social-links.php' ) );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode( 'sharing', 'oxy_shortcode_sharing' );
