<?php
/*
Copyright 2010 utahta (email : labs.ninxit@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * default option
 */
function wp_social_bookmarking_light_default_options()
{
    return array( "services" => "hatena, hatena_users, facebook, google_buzz, yahoo, livedoor, friendfeed, tweetmeme",
                  "position" => "top",
                  "single_page" => true,
                  "is_page" => true,
                  'style' => array('padding_top' => '0',
                                    'padding_bottom' => '0'),
                  "mixi" => array('check_key' => '',
                                   'check_robots' => 'noimage',
                                   'button' => 'button-3'),
                  "twitter" => array('via' => "",
                                      'lang' => "en",
                                      'count' => 'horizontal',
                                      'width' => '130',
                                      'height' => '20'),
                  "hatena_button" => array('layout' => 'standard'),
                  'facebook' => array('locale' => 'en_US'),
                  'facebook_like' => array('version' => 'xfbml',
                                            'action' => 'like',
                                            'colorscheme' => 'light',
                                            'send' => false,
                                            'width' => '100',
                                            'font' => '',
                                            'locale' => ''),
                  'facebook_send' => array('colorscheme' => 'light',
                                             'font' => '',
                                             'locale' => ''),
                  'gree' => array('button_type' => '4',
                                    'button_size' => '16'),
                  'evernote' => array('button_type' => 'article-clipper'),
                  'tumblr' => array('button_type' => '1'),
                  'atode' => array('button_type' => 'iconsja'),
    );
}

/**
 * option
 */
function wp_social_bookmarking_light_options()
{
    $options = get_option("wp_social_bookmarking_light_options", array());
    
    // array merge recursive overwrite (1 depth)
    $default_options = wp_social_bookmarking_light_default_options();
    foreach( $default_options as $key => $val ){
        if(is_array($default_options[$key])){
            if(!array_key_exists($key, $options) || !is_array($options[$key])){
                $options[$key] = array();
            }
            $options[$key] = array_merge($default_options[$key], $options[$key]);
        }
    }
    return array_merge( wp_social_bookmarking_light_default_options(), $options );
}

/**
 * save options
 * 
 * @param array $data ($_POST)
 */
function wp_social_bookmarking_light_save_options($data)
{
    $options = array("services" => $data["services"],
                      "position" => $data["position"],
                      "single_page" => $data["single_page"] == 'true',
                      "is_page" => $data["is_page"] == 'true',
                      'style' => array('padding_top' => $data["style_padding_top"],
                                    	'padding_bottom' => $data["style_padding_bottom"]),
    				  "mixi" => array('check_key' => $data["mixi_check_key"],
                                       'check_robots' => $data["mixi_check_robots"],
                                       'button' => $data['mixi_button']),
                      "twitter" => array('via' => $data['twitter_via'],
                                          'lang' => $data['twitter_lang'],
                                          'count' => $data['twitter_count'],
                                          'width' => $data['twitter_width'],
                                          'height' => $data['twitter_height']),
                      'hatena_button' => array('layout' => $data['hatena_button_layout']),
                      'facebook' => array('locale' => trim($data['facebook_locale'])),
                      'facebook_like' => array('version' => $data['facebook_like_version'],
                                                'action' => $data['facebook_like_action'],
                                                'colorscheme' => $data['facebook_like_colorscheme'],
                                                'send' => $data['facebook_like_send'] == 'true',
                                                'width' => $data['facebook_like_width'],
                                                'font' => $data['facebook_like_font']),
                      'facebook_send' => array('colorscheme' => $data['facebook_send_colorscheme'],
                                                'font' => $data['facebook_send_font']),
                      'gree' => array('button_type' => $data['gree_button_type'],
                                        'button_size' => $data['gree_button_size']),
                      'evernote' => array('button_type' => $data['evernote_button_type']),
                      'tumblr' => array('button_type' => $data['tumblr_button_type']),
                      'atode' => array('button_type' => $data['atode_button_type']),
    );
    update_option( 'wp_social_bookmarking_light_options', $options );
    return $options;
}

/**
 * restore default options
 */
function wp_social_bookmarking_light_restore_default_options()
{
    $options = wp_social_bookmarking_light_default_options();
    update_option( 'wp_social_bookmarking_light_options', $options );
    return $options;
}
