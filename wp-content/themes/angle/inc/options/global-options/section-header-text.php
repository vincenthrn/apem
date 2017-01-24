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
        'name'        => __('Title', 'angle-admin-td'),
        'id'          => 'title',
        'type'        => 'text',
        'default'     => '',
        'desc'        => __('Main Title text', 'angle-admin-td'),
        'admin_label' => true,
    ),
    array(
        'name'    => __('Subtitle', 'angle-admin-td'),
        'desc'    => __('Smaller subtitle to be shown under the main title text.', 'angle-admin-td'),
        'id'      => 'subtitle',
        'default' => '',
        'type' => 'text',
        'admin_label' => true,
    ),
    array(
        'name'    => __('Title Font Size', 'angle-admin-td'),
        'desc'    => __('Choose size of the font to use in your header', 'angle-admin-td'),
        'id'      => 'title_size',
        'type'    => 'select',
        'options' => array(
            'normal'      => __('Normal', 'angle-admin-td'),
            'super' => __('Super (60px)', 'angle-admin-td'),
            'hyper' => __('Hyper (96px)', 'angle-admin-td'),
        ),
        'default' => 'normal',
    ),
    array(
        'name'    => __('Title Font Weight', 'angle-admin-td'),
        'desc'    => __('Choose weight of the font to use in the title', 'angle-admin-td'),
        'id'      => 'title_weight',
        'type'    => 'select',
        'options' => array(
            'regular'  => __('Regular', 'angle-admin-td'),
            'black'    => __('Black', 'angle-admin-td'),
            'bold'     => __('Bold', 'angle-admin-td'),
            'light'    => __('Light', 'angle-admin-td'),
            'hairline' => __('Hairline', 'angle-admin-td'),
        ),
        'default' => 'regular',
    ),
    array(
        'name' => __('Title Alignment', 'angle-admin-td'),
        'desc' => __('Align the text shown in the header left, right or center.', 'angle-admin-td'),
        'id'   => 'title_align',
        'type' => 'select',
        'default' => 'center',
        'options' => array(
            'center' => __('Center', 'angle-admin-td'),
            'left'   => __('Left', 'angle-admin-td'),
            'right'  => __('Right', 'angle-admin-td'),
            'justify'  => __('Justify', 'angle-admin-td')
        ),
    ),
    array(
        'name'    => __('Title Underline', 'angle-admin-td'),
        'desc'    => __('Adds an underline effect below the title & subtitle.', 'angle-admin-td'),
        'id'      => 'title_underline',
        'default' => 'no-underline',
        'type' => 'select',
        'options' => array(
            'underline'    => __('Show', 'angle-admin-td'),
            'no-underline' => __('Hide', 'angle-admin-td'),
        ),
    ),
);