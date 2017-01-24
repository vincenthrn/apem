<?php
/**
 * Test Options Page
 *
 * @package Angle
 * @subpackage options-pages
 * @since 1.0
 *
 * @copyright (c) 2014 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.12.2
 */

return array(
    'sections'   => array(
        'twitter-section' => array(
            'fields' => array(
                array(
                    'name' => __('Show language as', 'angle-admin-td'),
                    'id' => 'display',
                    'type' => 'select',
                    'default' => 'name',
                    'options' => array(
                        'name'     => __('Name', 'angle-admin-td'),
                        'code'     => __('Country Code', 'angle-admin-td'),
                        'flag'     => __('Flag', 'angle-admin-td'),
                        'nameflag' => __('Name & Flag', 'angle-admin-td')
                    )
                ),
                array(
                    'name' => __('Order languages by', 'angle-admin-td'),
                    'id' => 'order',
                    'type' => 'select',
                    'default' => 'id',
                    'options' => array(
                        'id'   => __('ID', 'angle-admin-td'),
                        'code' => __('Code', 'angle-admin-td'),
                        'name' => __('Name', 'angle-admin-td')
                    ),
                ),
                array(
                    'name' => __('Order direction', 'angle-admin-td'),
                    'id' => 'orderby',
                    'type' => 'select',
                    'default' => 'id',
                    'options' => array(
                        'asc'   => __('Ascending', 'angle-admin-td'),
                        'desc' => __('Decending', 'angle-admin-td'),
                    ),
                ),
                array(
                    'name' => __('Skip Missing Languages', 'angle-admin-td'),
                    'id' => 'skip_missing',
                    'type' => 'select',
                    'default' => '1',
                    'options' => array(
                        '1' => __('Skip', 'angle-admin-td'),
                        '0' => __('Dont Skip', 'angle-admin-td'),
                    ),
                    'desc' => __('Skip languages with no translations.', 'angle-admin-td')
                ),
            )//fields
        )//section
    )//sections
);//array
