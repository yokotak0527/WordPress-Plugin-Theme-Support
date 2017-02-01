<?php
  namespace theme_support;
  include_once('page/index.php');
  include_once('page/setting.php');

  // ===========================================================================
  // PAGE REGISTRATION
  // ===========================================================================
  add_action('admin_menu', function(){
    $t_domain = THEME_SUPPORT_TEXTDOMAIN;
    // -------------------------------------------------------------------------
    // index
    // 
    add_menu_page(
      __('theme_support', $t_domain), // メニューページのタイトル
      __('Theme Support', $t_domain), // メニュー名
      'administrator',                // サブメニューの権限(権限名)
      'theme-support',                // メニューのスラッグ
      function(){                     // コールバック
        wp_enqueue_style('theme-support', plugins_url('src/css/format.css', __FILE__ ));
        display_index_page();
      }
    );
    // -------------------------------------------------------------------------
    // setting
    // 
    add_submenu_page(
      'theme-support',                         // 親メニューのスラッグ
      __('Theme Support setting', $t_domain),  // サブメニューページのタイトル
      __('Setting', $t_domain),                // プルダウンに表示されるメニュー名
      'administrator',                         // サブメニューの権限(権限名)
      'theme-support-setting',                 // サブメニューのスラッグ
      function(){                              // コールバック
        wp_enqueue_style('theme-support', plugins_url('src/css/format.css', __FILE__ ));
        display_setting_page();
      }
    );
  });

?>
