<?php
  namespace theme_support;

  $t_domain = THEME_SUPPORT_TEXTDOMAIN;
  if(is_admin()){
    
    add_action('admin_init', function(){
      // -----------------------------------------------------------------------
      // section
      // 
      add_settings_section(
          'theme-support-setting',  // セクション名
          __('Setting', $t_domain), // タイトル
          function(){               // コールバック
            display_setting_page_cnt();
          },
          'theme-support-group' // このセクションを表示するページ名。do_settings_sectionsで設定
      );
      // -----------------------------------------------------------------------
      // registration
      // register_setting( グループ名, オプション名 (name属性), 入力値をサニタイズする関数 )
      // 
      // Use page CSS / JS -> Developer
      register_setting('theme-support-group', '_ts_use-page-files--dev');
      // Use page CSS / JS -> User
      register_setting('theme-support-group', '_ts_use-page-files--usr');
      // External files dir. -> Developer
      register_setting('theme-support-group', '_ts_external-file-dir--dev');
      // External files dir. -> User
      register_setting('theme-support-group', '_ts_external-file-dir--usr');
      // Dir. names -> Image
      register_setting('theme-support-group', '_ts_dir-names--img');
      // Dir. names -> JavaScript
      register_setting('theme-support-group', '_ts_dir-names--js');
      // Dir. names -> CSS
      register_setting('theme-support-group', '_ts_dir-names--css');
      // CSS Break Points -> 0 -> name
      register_setting('theme-support-group', '_ts_bp-0-name');
      // CSS Break Points -> 0 -> max size
      register_setting('theme-support-group', '_ts_bp-0-num');
      // CSS Break Points -> 1 -> name
      register_setting('theme-support-group', '_ts_bp-1-name');
      // CSS Break Points -> 1 -> max size
      register_setting('theme-support-group', '_ts_bp-1-num');
      // CSS Break Points -> 2 -> name
      register_setting('theme-support-group', '_ts_bp-2-name');
      // CSS Break Points -> 2 -> max size
      register_setting('theme-support-group', '_ts_bp-2-num');
      // Display Warning -> Comment accept
      register_setting('theme-support-group', '_ts_warning--comment');
      // Display Warning -> Pinback accept
      register_setting('theme-support-group', '_ts_warning--pinback');
      // Display Warning -> Able to access to author page
      register_setting('theme-support-group', '_ts_warning--author-page');
      // Display Warning -> Display PHP error
      register_setting('theme-support-group', '_ts_warning--php-error');
    }, 25);
    // -------------------------------------------------------------------------
    // error
    // 
    // External files dir. -> Developer
  }
?>
<?php
  // ===========================================================================
  // page container template
  // ===========================================================================
  function display_setting_page(){
?>
<div class="wrap">
  <div class="theme-support-root">
    <form method="post" action="options.php">
      <h1>Theme Support</h1>
      <?php
        do_settings_sections('theme-support-group');
        settings_fields('theme-support-group');
      ?>
      <?php submit_button(); ?>
    </form>
  </div>
</div>
<?php }; ?>
<?php
  // ===========================================================================
  // form content template
  // ===========================================================================
  function display_setting_page_cnt(){
?>
<dl class="p__setting-list">
  <dt><?php _e('Use page CSS / JS', $t_domain); ?></dt>
  <dd>
    <ul class="use-page-files">
      <li><label><input type="checkbox" name="_ts_use-page-files--dev" id="_ts_use-page-files--dev" value="1" <?php checked(1, get_option('_ts_use-page-files--dev')); ?>><span><?php _e('Developer', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_use-page-files--usr" id="_ts_use-page-files--usr" value="1" <?php checked(1, get_option('_ts_use-page-files--usr')); ?>><span><?php _e('User', $t_domain); ?></span></label></li>
    </ul>
  </dd>
  <dt><?php _e('External files dir.', $t_domain); ?></dt>
  <dd>
    <table class="external-file-dir">
      <tbody>
        <tr>
          <th><?php _e('Developer', $t_domain); ?></th>
          <td>
            <input type="text" name="_ts_external-file-dir--dev" id="_ts_external-file-dir--dev" value="<?php echo get_option('_ts_external-file-dir--dev'); ?>">
            <p><?php _e('From theme dir.', $t_domain); ?></p>
          </td>
        </tr>
        <tr>
          <th><?php _e('User', $t_domain); ?></th>
          <td>
            <input type="text" name="_ts_external-file-dir--usr" id="_ts_external-file-dir--usr" value="<?php echo get_option('_ts_external-file-dir--usr'); ?>">
            <p><?php _e('From web root.', $t_domain); ?></p>
          </td>
        </tr>
      </tbody>
    </table>
  </dd>
  <dt><?php _e('Dir. names', $t_domain); ?></dt>
  <dd>
    <table class="dir-names">
      <tbody>
        <tr>
          <th><?php _e('Image', $t_domain); ?></th>
          <td>
            <input type="text" name="_ts_dir-names--img" id="_ts_dir-names--img" value="<?php echo get_option('_ts_dir-names--img'); ?>">
          </td>
        </tr>
        <tr>
          <th><?php _e('JavaScript', $t_domain); ?></th>
          <td>
            <input type="text" name="_ts_dir-names--js" id="_ts_dir-names--js" value="<?php echo get_option('_ts_dir-names--js'); ?>">
          </td>
        </tr>
        <tr>
          <th><?php _e('CSS', $t_domain); ?></th>
          <td>
            <input type="text" name="_ts_dir-names--css" id="_ts_dir-names--css" value="<?php echo get_option('_ts_dir-names--css'); ?>">
          </td>
        </tr>
      </tbody>
    </table>
  </dd>
  <dt><?php _e('CSS Break Points', $t_domain); ?></dt>
  <dd>
    <div class="introduction">
      <p><? _e('If you set Break Points, when you must use "custom_enqueue_style" function. (defined THEME SUPPORT)'); ?></p>
    </div>
    <table class="break-points">
      <tbody>
        <tr>
          <td class="name"><span><?php _e('Name', $t_domain); ?></span><input    type="text"   name="_ts_bp-0-name" id="_ts_bp-0-name" value="<?php echo get_option('_ts_bp-0-name'); ?>"></td>
          <td class="num"><span><?php _e('Max size', $t_domain); ?></span><input type="number" name="_ts_bp-0-num"  id="_ts_bp-0-num"  value="<?php echo get_option('_ts_bp-0-num'); ?>"><span>px</span></td>
        </tr>
        <tr>
          <td class="name"><span><?php _e('Name', $t_domain); ?></span><input    type="text"   name="_ts_bp-1-name" id="_ts_bp-1-name" value="<?php echo get_option('_ts_bp-1-name'); ?>"></td>
          <td class="num"><span><?php _e('Max size', $t_domain); ?></span><input type="number" name="_ts_bp-1-num"  id="_ts_bp-1-num"  value="<?php echo get_option('_ts_bp-1-num'); ?>"><span>px</span></td>
        </tr>
        <tr>
          <td class="name"><span><?php _e('Name', $t_domain); ?></span><input    type="text"   name="_ts_bp-2-name" id="_ts_bp-2-name" value="<?php echo get_option('_ts_bp-2-name'); ?>"></td>
          <td class="num"><span><?php _e('Max size', $t_domain); ?></span><input type="number" name="_ts_bp-2-num"  id="_ts_bp-2-num"  value="<?php echo get_option('_ts_bp-2-num'); ?>"><span>px</span></td>
        </tr>
      </tbody>
    </table>
  </dd>
  <dt><?php _e('Display Warning', $t_domain); ?></dt>
  <dd>
    <ul class="warning">
      <li><label><input type="checkbox" name="_ts_warning--comment"     id="_ts_warning--comment"     value="1" <?php checked(1, get_option('_ts_warning--comment')); ?>><span><?php _e('Comment accept', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_warning--pinback"     id="_ts_warning--pinback"     value="1" <?php checked(1, get_option('_ts_warning--pinback')); ?>><span><?php _e('Pinback accept', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_warning--author-page" id="_ts_warning--author-page" value="1" <?php checked(1, get_option('_ts_warning--author-page')); ?>><span><?php _e('Able to access to author page', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_warning--php-error"   id="_ts_warning--php-error"   value="1" <?php checked(1, get_option('_ts_warning--php-error')); ?>><span><?php _e('Display PHP errors', $t_domain); ?></span></label></li>
    </ul>
  </dd>
</dl>
<?php };
