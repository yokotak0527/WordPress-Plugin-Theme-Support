<?php
/*
Plugin Name: Theme Support
Description: テーマ作成に便利な関数群
Version: 1.0.0
Author: WITHPROJECTS inc.
Author URI: http://withprojects.co.jp
License: GPL2

// =============================================================================
  Copyright 2017 WITHPROJECTS inc. (email : project@withprojects.co.jp)
 
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
  $pluginDir  = __DIR__;
  $pluginData = get_file_data(__FILE__, [
    'name'    => 'Plugin Name',
    'version' => 'Version'
  ]);
  // ===========================================================================
  // PLUGIN CONSTS
  // 
  define('THEME_SUPPORT_TEXTDOMAIN', 'theme-support');
  define('THEME_SUPPORT',            $pluginData['version']);
  
  
  // include plugin class & short-code
  include_once('class/ThemeSupport.php');
  
  global $ts;
  $ts = new ThemeSupport();
  // ===========================================================================
  // SETTING PLUGIN
  // 
  add_action('plugins_loaded', function(){
    // admin page
    include_once('page-setting.php');
  });
