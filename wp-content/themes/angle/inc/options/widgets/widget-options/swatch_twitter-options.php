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
            'title'   => __('Twitter', 'angle-admin-td'),
            'header'  => __('Twitter feed options','angle-admin-td'),
            'fields' => array(
                'title' => array(
                    'name' => __('Widget Title', 'angle-admin-td'),
                    'id' => 'title',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),
                'account' => array(
                    'name' => __('Twitter username', 'angle-admin-td'),
                    'id' => 'account',
                    'type' => 'text',
                    'default' => "envato",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),
                'consumer_key' => array(
                    'name' => __('Consumer Key', 'angle-admin-td'),
                    'id' => 'consumer_key',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),
                'consumer_secret' => array(
                    'name' => __('Consumer Secret', 'angle-admin-td'),
                    'id' => 'consumer_secret',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),
                'access_token' => array(
                    'name' => __('Access Token', 'angle-admin-td'),
                    'id' => 'access_token',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),
                'access_token_secret' => array(
                    'name' => __('Access Token Secret', 'angle-admin-td'),
                    'id' => 'access_token_secret',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),

                'show'   => array(
                    'name'       =>  __('Maximum number of tweets to show', 'angle-admin-td'),
                    'id'         => 'show',
                    'type'       => 'select',
                    'options'    =>  array(
                              1  => 1,
                              2  => 2,
                              3  => 3,
                              4  => 4,
                              5  => 5,
                              6  => 6,
                              7  => 7,
                              8  => 8,
                              9  => 9,
                              10 => 10
                    ),
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                    'default'   => 5,
                ),


                'hidereplies' => array(
                    'name'      => __('Hide replies', 'angle-admin-td'),
                    'id'        => 'hidereplies',
                    'type'      => 'radio',
                    'default'   =>  'on',
                    'options' => array(
                        'on'   => __('Hide', 'angle-admin-td'),
                        'off'  => __('Show', 'angle-admin-td'),
                    ),
                ),

                'hidepublicized' => array(
                    'name'      => __('Hide Tweets pushed by Publicize', 'angle-admin-td'),
                    'id'        => 'hidepublicized',
                    'type'      => 'radio',
                    'default'   =>  'on',
                    'options' => array(
                        'on'   => __('Hide', 'angle-admin-td'),
                        'off'  => __('Show', 'angle-admin-td'),
                    ),
                ),

                'includeretweets' => array(
                    'name'      => __('Include retweets', 'angle-admin-td'),
                    'id'        => 'include_retweets',
                    'type'      => 'radio',
                    'default'   =>  'on',
                    'options' => array(
                        'off' => __('No', 'angle-admin-td'),
                        'on'  => __('Yes', 'angle-admin-td'),
                    ),
                ),

                'followbutton' => array(
                    'name'      => __('Display Follow Button', 'angle-admin-td'),
                    'id'        => 'follow_button',
                    'type'      => 'radio',
                    'default'   =>  'on',
                    'options' => array(
                        'off' => __('Hide', 'angle-admin-td'),
                        'on'  => __('Show', 'angle-admin-td'),
                    ),
                ),

                'beforetimesince' => array(
                    'name' => __('Text to display between Tweet and timestamp:', 'angle-admin-td'),
                    'id' => 'beforetimesince',
                    'type' => 'text',
                    'default' => "",
                    'attr'      =>  array(
                        'class'    => 'widefat',
                    ),
                ),

            )//fields
        )//section
    )//sections
);//array
