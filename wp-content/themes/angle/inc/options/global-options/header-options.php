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
        'name'        => __('Header', 'angle-admin-td'),
        'id'          => 'header',
        'type'        => 'text',
        'default'     => '',
        'desc'        => __('Header text', 'angle-admin-td'),
        'admin_label' => true,
    ),
    array(
        'name'    => __('Header Type', 'angle-admin-td'),
        'desc'    => __('Choose the type of header you want to use', 'angle-admin-td'),
        'id'      => 'header_type',
        'type'    => 'select',
        'options' => array(
            'h1'      => __('h1', 'angle-admin-td'),
            'h2'      => __('h2', 'angle-admin-td'),
            'h3'      => __('h3', 'angle-admin-td'),
            'h4'      => __('h4', 'angle-admin-td'),
            'h5'      => __('h5', 'angle-admin-td'),
            'h6'      => __('h6', 'angle-admin-td')
        ),
        'default' => 'h1',
    ),
    array(
        'name'    => __('Header Font Size', 'angle-admin-td'),
        'desc'    => __('Choose size of the font to use in your header', 'angle-admin-td'),
        'id'      => 'header_size',
        'type'    => 'select',
        'options' => array(
            'normal' => __('Normal', 'angle-admin-td'),
            'super'  => __('Super (60px)', 'angle-admin-td'),
            'hyper'  => __('Hyper (96px)', 'angle-admin-td'),
        ),
        'default' => 'normal',
    ),
    array(
        'name'    => __('Header Font Weight', 'angle-admin-td'),
        'desc'    => __('Choose weight of the font to use in the header', 'angle-admin-td'),
        'id'      => 'header_weight',
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
        'name' => __('Header Alignment', 'angle-admin-td'),
        'desc' => __('Align the text shown in the header left, right or center.', 'angle-admin-td'),
        'id'   => 'header_align',
        'type' => 'select',
        'default' => 'center',
        'options' => array(
            'center' => __('Center', 'angle-admin-td'),
            'left'   => __('Left', 'angle-admin-td'),
            'right'  => __('Right', 'angle-admin-td'),
            'justify'  => __('Justify', 'angle-admin-td')
        )
    ),
    array(
        'name'    => __('Header Underline', 'angle-admin-td'),
        'desc'    => __('Adds an underline effect below the header.', 'angle-admin-td'),
        'id'      => 'header_underline',
        'default' => 'bordered-header',
        'type' => 'radio',
        'options' => array(
            'bordered-header' => __('Show', 'angle-admin-td'),
            'no-bordered-header' => __('Hide', 'angle-admin-td'),
        )
    )
);