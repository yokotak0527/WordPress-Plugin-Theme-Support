<?php
  namespace theme_support;

  if(is_admin()){

    add_action('admin_init', function(){
      $t_domain = THEME_SUPPORT_TEXTDOMAIN;
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
      register_setting('theme-support-group', '_ts_use-page-files--dev', 'intval');
      // Use page CSS / JS -> User
      register_setting('theme-support-group', '_ts_use-page-files--usr', 'intval');
      // External files dir. -> Developer
      register_setting('theme-support-group', '_ts_external-file-dir--dev', 'sanitize_text_field');
      // External files dir. -> User
      register_setting('theme-support-group', '_ts_external-file-dir--usr', 'sanitize_text_field');
      // Dir. names -> Image
      register_setting('theme-support-group', '_ts_dir-names--img', 'sanitize_text_field');
      // Dir. names -> JavaScript
      register_setting('theme-support-group', '_ts_dir-names--js', 'sanitize_text_field');
      // Dir. names -> CSS
      register_setting('theme-support-group', '_ts_dir-names--css', 'sanitize_text_field');
      // Disable -> Attache file page
      register_setting('theme-support-group', '_ts_disable--attache-file-page', 'intval');
      // Disable -> Author page
      register_setting('theme-support-group', '_ts_disable--author-page', 'intval');
      // Disable -> Visual Editor on Page
      register_setting('theme-support-group', '_ts_disable--visual-editor', 'intval');
      // Disable -> Emoji
      register_setting('theme-support-group', '_ts_disable--emoji', 'intval');
      // Disable -> Emoji
      register_setting('theme-support-group', '_ts_disable--rest', 'intval');
      // Display Warning -> warning
      register_setting('theme-support-group', '_ts_warning--comment', 'intval');
      // Disable -> Pinback
      register_setting('theme-support-group', '_ts_warning--pinback', 'intval');
    }, 20);
  }
?>
<?php
  // ===========================================================================
  // page container template
  // ===========================================================================
  function display_setting_page(){
    $t_domain = THEME_SUPPORT_TEXTDOMAIN;
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
    $t_domain = THEME_SUPPORT_TEXTDOMAIN;
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
  <dt><?php _e('Disable', $t_domain); ?></dt>
  <dd>
    <ul class="disable">
      <li><label><input type="checkbox" name="_ts_disable--attache-file-page" id="_ts_disable--attache-file-page" value="1" <?php checked(1, get_option('_ts_disable--attache-file-page')); ?>><span><?php _e('Attache files page', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_disable--author-page"       id="_ts_disable--author-page"       value="1" <?php checked(1, get_option('_ts_disable--author-page')); ?>><span><?php _e('Author page', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_disable--visual-editor"     id="_ts_disable--visual-editor"     value="1" <?php checked(1, get_option('_ts_disable--visual-editor')); ?>><span><?php _e('Visual Editor on Page', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_disable--emoji"             id="_ts_disable--emoji"             value="1" <?php checked(1, get_option('_ts_disable--emoji')); ?>><span><?php _e('Emoji', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_disable--rest"              id="_ts_disable--rest"              value="1" <?php checked(1, get_option('_ts_disable--rest')); ?>><span><?php _e('WP REST API ("wp/vxxx" end point only.)', $t_domain); ?></span></label></li>
    </ul>
  </dd>
  <dt><?php _e('Display Warning', $t_domain); ?></dt>
  <dd>
    <ul class="warning">
      <li><label><input type="checkbox" name="_ts_warning--comment" id="_ts_warning--comment"         value="1" <?php checked(1, get_option('_ts_warning--comment')); ?>><span><?php _e('Accept comment', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_warning--pinback" id="_ts_warning--pinback"         value="1" <?php checked(1, get_option('_ts_warning--pinback')); ?>><span><?php _e('Accept pinback', $t_domain); ?></span></label></li>
      <li><label><input type="checkbox" name="_ts_warning--pinback" id="_ts_warning--display-php-err" value="1" <?php checked(1, get_option('_ts_warning--display-php-err')); ?>><span><?php _e('Display PHP error', $t_domain); ?></span></label></li>
    </ul>
  </dd>
</dl>
<?php };
