<?php
/**
 * Themes shortcode options go here
 *
 * @package Angle
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */


return array(
    array(
        'name'    => __('Background Image', 'angle-admin-td'),
        'id'      => 'background_image',
        'store'   => 'url',
        'type'    => 'upload',
        'default' => '',
        'desc'    => __('Choose an image to use for this rows background.', 'angle-admin-td'),
    ),
    array(
        'name'    => __('Background Video mp4', 'angle-admin-td'),
        'id'      => 'background_video',
        'type'    => 'text',
        'default' => '',
        'desc'    => __('Enter url of a h.264 (mp4) video to use for this rows background.', 'angle-admin-td'),
    ),
    array(
        'name'    => __('Background Video webm', 'angle-admin-td'),
        'id'      => 'background_video_webm',
        'type'    => 'text',
        'default' => '',
        'desc'    => __('Enter url of a webm video to use for this rows background.', 'angle-admin-td'),
    ),
    array(
        'name'      => __('Background Position Vertical', 'angle-admin-td'),
        'desc'      => __('Set the vertical position of background image. 0 value represents the top horizontal edge of the section. Positive values will push the background down.', 'angle-admin-td'),
        'id'        => 'background_position_vertical',
        'type'      => 'slider',
        'default'   => '0',
        'attr'      => array(
            'max'       => 100,
            'min'       => -100,
            'step'      => 1,
        )
    ),
    array(
        'name'      => __('Overlay Colour', 'angle-admin-td'),
        'desc'      => __('Set the colour of the video & image overlay', 'angle-admin-td'),
        'id'        => 'overlay_colour',
        'type'      => 'colour',
        'default'   => '#000000',
        'attr'      => array(
            'max'       => 1,
            'min'       => 0.1,
            'step'      => 0,
        )
    ),
    array(
        'name'      => __('Overlay Opacity', 'angle-admin-td'),
        'desc'      => __('Set the opacity of the video & image overlay', 'angle-admin-td'),
        'id'        => 'overlay_opacity',
        'type'      => 'slider',
        'default'   => '0',
        'attr'      => array(
            'max'       => 1,
            'min'       => 0,
            'step'      => 0.1,
        )
    ),
    array(
        'name'      => __('Overlay Grid', 'angle-admin-td'),
        'desc'      => __('Adds an overlay pattern image', 'angle-admin-td'),
        'id'        => 'overlay_grid',
        'type'    => 'select',
        'options' => array(
            'off'  => __('Off', 'angle-admin-td'),
            'on' => __('On', 'angle-admin-td')
        ),
        'default' => 'off',
    ),
    array(
        'name'    => __('Image Background Size', 'angle-admin-td'),
        'desc'    => __('Set how the image will fit into the section', 'angle-admin-td'),
        'id'      => 'background_image_size',
        'type'    => 'select',
        'options' => array(
            'cover' => __('Full Width', 'angle-admin-td'),
            'auto'  => __('Actual Size', 'angle-admin-td'),
        ),
        'default' => 'cover',
    ),
    array(
        'name'    => __('Image Background Repeat', 'angle-admin-td'),
        'id'      => 'background_image_repeat',
        'type'    => 'select',
        'default' => 'no-repeat',
        'options' => array(
            'no-repeat' => __('No repeat', 'angle-admin-td'),
            'repeat-x'  => __('Repeat horizontally', 'angle-admin-td'),
            'repeat-y'  => __('Repeat vertically', 'angle-admin-td'),
            'repeat'    => __('Repeat horizontally and vertically', 'angle-admin-td')
        ),
        'desc'    => __('Set how the image will be repeated', 'angle-admin-td'),
    ),

    array(
        'name'    => __('Image Background Parallax', 'angle-admin-td'),
        'id'      => 'background_image_attachment',
        'type'    => 'select',
        'default' => 'scroll',
        'options' => array(
            'scroll' => __('Scroll', 'angle-admin-td'),
            'fixed'  => __('Fixed', 'angle-admin-td'),
        ),
        'desc'    => __('Set the way the background scrolls with the page. Scroll = normal Fixed = Parallax effect.', 'angle-admin-td'),
    ),
);