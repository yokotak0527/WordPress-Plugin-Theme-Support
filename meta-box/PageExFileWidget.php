<?php
  namespace theme_support;

  class PageExFileWidget extends \WP_Widget{
    function __construct(){
      $t_domain = THEME_SUPPORT_TEXTDOMAIN;
      parent::__construct(
        'page_ex_file_widget',
        __('Page CSS / JS', $t_domain)
      );
    }
    /**
     */
    public function form( $instance ){
        $email = $instance['email'];
        $email_name = $this->get_field_name('email');
        $email_id = $this->get_field_id('email');
        ?>
        <p>
            <label for="<?php echo $email_id; ?>">Email:</label>
            <input class="widefat" id="<?php echo $email_id; ?>" name="<?php echo $email_name; ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
        </p>
        <?php
    }
    /** 新しい設定データが適切なデータかどうかをチェックする。
     * 必ず$instanceを返す。さもなければ設定データは保存（更新）されない。
     *
     * @param array $new_instance  form()から入力された新しい設定データ
     * @param array $old_instance  前回の設定データ
     * @return array               保存（更新）する設定データ。falseを返すと更新しない。
     */
    function update($new_instance, $old_instance) {
        if(!filter_var($new_instance['email'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return $new_instance;
    }
  }
  add_action('widget_init', function(){
    register_widget('PageExFileWidget');
  });
?>
