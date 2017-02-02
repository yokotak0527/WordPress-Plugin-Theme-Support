<?php
  namespace theme_support;


  function page_ex_file_box($args){
    $t_domain = THEME_SUPPORT_TEXTDOMAIN;
?>
<div class="ts__meta-box_page-ex-files">
<?php if(get_option('_ts_use-page-files--dev')) : ?>
<table>
  <thead>
    <tr>
      <th colspan="2"><?php _e('Developer', $t_domain); ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label><input type="checkbox"><span>CSS</span></label></td>
      <td><label><input type="checkbox"><span>JS</span></label></td>
    </tr>
  </tbody>
</table>
<?php endif; ?>
<?php if(get_option('_ts_use-page-files--usr')) : ?>
<table class="ts__page-ex-files">
  <thead>
    <tr>
      <th colspan="2"><?php _e('User', $t_domain); ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label><input type="checkbox"><span>CSS</span></label></td>
      <td><label><input type="checkbox"><span>JS</span></label></td>
    </tr>
  </tbody>
</table>
<?php endif; ?>
</div>
<?php 
  }

  // include_once(THEME_SUPPORT_PATH.'/widgets/PageExFileWidget.php');
  add_action('add_meta_boxes', function(){
    $t_domain = THEME_SUPPORT_TEXTDOMAIN;
    if(get_option('_ts_use-page-files--dev') || get_option('_ts_use-page-files--usr')){
      add_meta_box(
        'ts_page-ex-file-widgets',        // meta box ID
        __('Page CSS / JS', $t_domain),   // title
        'theme_support\page_ex_file_box', // template function
        'page',                           // display page type
        'side',                           // left-right pos.
        'default'                         // top-bottom pos.
      );
    }
  });
?>
