<?php
/**
 * Themes shortcode image options go here
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
        'title' => __('Image options', 'angle-admin-td'),
        'fields' => array(
            array(
                'name'    => __('Image Shape', 'angle-admin-td'),
                'desc'    => __('Choose the shape of the image', 'angle-admin-td'),
                'id'      => 'image_shape',
                'type'    => 'select',
                'options' => array(
                    'box-round'    => __('Round', 'angle-admin-td'),
                    'box-rect'     => __('Rectangle', 'angle-admin-td'),
                    'box-square'   => __('Square', 'angle-admin-td'),
                ),
                'default' => 'box-round',
            ),
            array(
                'name'    => __('Image Size', 'angle-admin-td'),
                'desc'    => __('Choose the size of the image', 'angle-admin-td'),
                'id'      => 'image_size',
                'type'    => 'select',
                'options' => array(
                    'box-mini'    => __('Mini', 'angle-admin-td'),
                    'no-small'    => __('Small', 'angle-admin-td'),
                    'box-medium'  => __('Medium', 'angle-admin-td'),
                    'box-big'     => __('Big', 'angle-admin-td'),
                    'box-huge'    => __('Huge', 'angle-admin-td'),
                ),
                'default' => 'box-medium',
            ),
        )
);