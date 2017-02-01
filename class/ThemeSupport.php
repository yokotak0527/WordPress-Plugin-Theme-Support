<?php
namespace theme_support;

include_once($pluginDir.'/trait/Singleton.php');
include_once($pluginDir.'/class/Path.php');
include_once($pluginDir.'/class/WPBlog.php');

class ThemeSupport{
	// self::$PROTOCOL = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';
	use Singleton;
  public function __construct(){
    if(self::has_instance()) return self::get_instance();

    $this->blog = new WPBlog();
    self::set_instance($this);
    // var_dump(__CLASS__);
      // $this->wpBlog = WPBlog::init();
      // $this->MULTISITE = defined('MULTISITE') ? MULTISITE : false;
      // =======================================================================
      // Blog data setting
      // =======================================================================
      // 
      // MULTI SITE
      // if($this->MULTISITE){
      //   
      // }
      // // SINGLE SITE
      // else{
        // 	$blogs_data['root'] = [
        // 		'blog_id'    => get_current_blog_id(),
        // 		'theme_name' => basename(get_stylesheet_directory_uri()),
        // 		'url'        => get_bloginfo('url')
        // 	];
      // }
  		// global $wpdb;
  		// self::$multisite = defined('MULTISITE') ? MULTISITE : false;
  		// // ---------------------------------------------------------------------
  		// // ブログデータの設定
  		// // ---------------------------------------------------------------------
  		// $blogs_data = [];
  		// // マルチサイト
  		// if(self::$multisite){
  		// 	$blogs = $wpdb->get_results( "SELECT blog_id FROM ".$wpdb->base_prefix."blogs ORDER BY blog_id" );
  		// 	// array_unshift($blogs,$blogs[0]);
  		// 	$i = 0; $l = count($blogs);
  		// 	for(; $i<$l; $i++){
  		// 		$blog_id = (int) $blogs[$i]->blog_id;
  		// 		switch_to_blog($blog_id);
  		// 		$theme_name = basename(get_stylesheet_directory_uri());
  		// 		// $theme_name = $i == 0 ? 'root' : basename(get_stylesheet_directory_uri());
  		// 		$blogs_data[$theme_name] = [
  		// 			'blog_id'    => $blog_id,
  		// 			'theme_name' => basename(get_stylesheet_directory_uri()),
  		// 			// 'site_url' => get_blog_option($blog_id,'siteurl'),
  		// 			'url'        => get_blog_option($blog_id,'home')
  		// 		];
  		// 		restore_current_blog();
  		// 	}
  		// 	// ルートの設定
  		// 	switch_to_blog($root_id);
  		// 	$blogs_data['root'] = [
  		// 		'blog_id'    => $root_id,
  		// 		'theme_name' => basename(get_stylesheet_directory_uri()),
  		// 		// 'site_url' => get_blog_option($blog_id,'siteurl'),
  		// 		'url'        => get_blog_option($blog_id, 'home')
  		// 	];
  		// 	restore_current_blog();
  		// }
  		// // シングルサイト
  		// else{
  		// 	$blogs_data['root'] = [
  		// 		'blog_id'    => get_current_blog_id(),
  		// 		'theme_name' => basename(get_stylesheet_directory_uri()),
  		// 		'url'        => get_bloginfo('url')
  		// 	];
  		// }
  		// define('ROOT_BLOG_THEME',$blogs_data['root']['theme_name']);
  		// self::$blogs = $blogs_data;
    
    // $this->dirs = [
    //   'img' => this->get_join_path(, get_option('_ts_dir-names--img'))
    // ];
    // var_dump($this->test);
    
  	// private static $IMAGE_DIR_NAME        = 'img';  // 画像ディレクトリ名
  	// private static $JS_DIR_NAME           = 'js';   // JSディレクトリ名
  	// private static $CSS_DIR_NAME          = 'css';  // CSSディレクトリ名
  	// private static $PHP_DIR_NAME          = 'php';  // PHPディレクトリ名
  	// private static $FONT_DIR_NAME         = 'font'; // フォントディレクトリ名
    // var_dump($this->test);
    // $this->
  }
  /**
   * Return joined path.
   * ex.
   * ThemeSupport->get_join_path('a', 'b')               - a/b/
   * ThemeSupport->get_join_path('a', '../b')            - b/
   * ThemeSupport->get_join_path('a', '../../b')         - b/
   * ThemeSupport->get_join_path('a', 'b', 'c//', '//d') - a/b/c/d/
   * ThemeSupport->get_join_path('dir', 'image.jpg')     - /dir
   * 
   * - If you wanna be to begin with "/" path, you can set as follows.
   * ThemeSupport->get_join_path('/b', 'c') - /b/c/
   *
   * - When last slash that isn't necessary, you set last_slash option.
   * ThemeSupport->get_join_path('a', 'b', [last_slash => false]) - a/b
   * 
   * @param  string|array arguemnts[] 
   * @return string
   */
  public function get_join_path(){
    return call_user_func_array('\theme_support\Path::join', func_get_args());
  }
  /**
   * echo joined path.
   */
  public function join_path(){
    echo call_user_func_array([$this, 'get_join_path'], func_get_args());
  }
  // public get_dir($type, $where){
  //   
  // }
  // public get_img_dir(){
  //   return $this->get_dir();
  // }

}
?>
