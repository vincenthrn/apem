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
    'title' => __('Row Options', 'angle-admin-td'),
    'fields' => array(
        array(
            'name'    => __('Swatch', 'angle-admin-td'),
            'desc'    => __('Choose a color swatch for the section', 'angle-admin-td'),
            'id'      => 'swatch',
            'type'    => 'select',
            'default' => 'swatch-white-red',
            'options' => include OXY_THEME_DIR . 'inc/options/shortcodes/shortcode-swatches-options.php',
            'admin_label' => true,
        ),
        array(
            'name'    => __('Top Decoration', 'angle-admin-td'),
            'desc'    => __('Choose a style to use as the top decoration.', 'angle-admin-td'),
            'id'      => 'top_decoration',
            'type'    => 'select',
            'default' => 'none',
            'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
        ),
        array(
            'name'    => __('Bottom Decoration', 'angle-admin-td'),
            'desc'    => __('Choose a style to use as the bottom decoration.', 'angle-admin-td'),
            'id'      => 'bottom_decoration',
            'type'    => 'select',
            'default' => 'none',
            'options' => include OXY_THEME_DIR . 'inc/options/global-options/section-decorations.php',
        ),
        //hidden for now
        array(
            'name'    => '',
            'id'      => 'content',
            'type'    => 'hiddentext',
            'default' => '',
            'desc'    => ''
        ),
        array(
            'name'    => __('Section Padding', 'angle-admin-td'),
            'desc'    => __('Choose the amount of padding added to the height of this section', 'angle-admin-td'),
            'id'      => 'height',
            'type'    => 'select',
            'options' => array(
                'normal'     => __('Normal', 'angle-admin-td'),
                'short'      => __('Short', 'angle-admin-td'),
                'tiny'       => __('Tiny', 'angle-admin-td'),
                'nopadding' => __('No Padding', 'angle-admin-td'),
            ),
            'default' => 'normal',
        ),
        array(
            'name'      =>  __('Section height', 'angle-admin-td'),
            'desc'    => __('Make the section fullheight( have a height at minimum as the screen size )', 'angle-admin-td'),
            'id'        => 'fullheight',
            'type'      => 'select',
            'options'   =>  array(
                'on'  => __('Enabled', 'angle-admin-td'),
                'off' => __('Disabled', 'angle-admin-td'),
            ),
            'default'   => 'off',
        ),
        array(
            'name'    => __('Section Width', 'angle-admin-td'),
            'desc'    => __('Choose between padded-non padded section', 'angle-admin-td'),
            'id'      => 'width',
            'type'    => 'select',
            'options' => array(
                'padded'    => __('Padded', 'angle-admin-td'),
                'no-padded' => __('Full Width', 'angle-admin-td'),
            ),
            'default' => 'padded',
        ),
        array(
            'name'    => __('Optional class', 'angle-admin-td'),
            'id'      => 'class',
            'type'    => 'text',
            'default' => '',
            'desc'    => __('Add an optional class to the section', 'angle-admin-td'),
        ),
        array(
            'name'    => __('Optional id', 'angle-admin-td'),
            'id'      => 'id',
            'type'    => 'text',
            'default' => '',
            'desc'    => __('Add an optional id to the section', 'angle-admin-td'),
        ),
        array(
            'name'    => __('Section Content Vertical Alignment', 'angle-admin-td'),
            'desc'    => __('Align the content of the section vertically', 'angle-admin-td'),
            'id'      => 'vertical_alignment',
            'type'    => 'radio',
            'options' => array(
                'top'       => __('Top', 'angle-admin-td'),
                'middle'    => __('Middle', 'angle-admin-td'),
                'bottom'    => __('Bottom', 'angle-admin-td'),
            ),
            'default' => 'top',
        )
    )
);
