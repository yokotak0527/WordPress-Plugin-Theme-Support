<?php
/*
Plugin Name: Theme Support
Description: テーマ作成に便利な関数群
Version: 0.0.1
Author: yokotak0527
Author URI: http://yokotakenji.me/log
License: GPL2

// =============================================================================
  Copyright 2017 yokotak0527 (email : mail@yokotakenji.me)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php

  namespace theme_support;

  // ===========================================================================
  // PLUGIN DATAS
  //
  $plugin_data = get_file_data(__FILE__, [
    'name'    => 'Plugin Name',
    'version' => 'Version'
  ]);
  // ===========================================================================
  // PLUGIN CONSTS
  //
  define('THEME_SUPPORT_TEXTDOMAIN', 'theme-support');
  define('THEME_SUPPORT',            $plugin_data['version']);
  define('THEME_SUPPORT_PATH',       __DIR__);

  // include plugin class & short-code
  include_once('class/Theme_Support.php');

  global $ts;
  $ts = Theme_Support::get_instance();

  // ===========================================================================
  // SETTING PLUGIN
  //
  add_action('plugins_loaded', function(){
    include_once('page-setting.php');     // admin page
    include_once('meta-box-setting.php'); // widgets
  });

  // ===========================================================================
  // 設定適用
  $param = [];
  $param['disable'] = [
    'emoji' => get_option('_ts_disable--emoji'),
    'rest'  => get_option('_ts_disable--rest')
  ];
  // if($param['disable']['emoji'])
  // ---------------------------------------------------------------------------
  // Emoji
  // if
  // var_dump($param);
  //
  // add_action('after_setup_theme', function(){
  //   $disable = [
  //     'emoji' => get_option('_ts_disable--emoji')
  //   ];
  //   // Disable emoji
  //   if(isset($disable['emoji']) && $disable['emoji']){
  //     remove_action('wp_head', 'print_emoji_detection_script', 7);
  //     remove_action('wp_print_styles', 'print_emoji_styles');
  //     remove_action('admin_print_scripts', 'print_emoji_detection_script');
  //     remove_action('admin_print_styles', 'print_emoji_styles');
  //     remove_filter('the_content_feed', 'wp_staticize_emoji');
  //     remove_filter('comment_text_rss', 'wp_staticize_emoji');
  //     remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  //   };
  // });
