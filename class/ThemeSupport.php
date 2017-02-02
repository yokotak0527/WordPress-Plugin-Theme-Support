<?php
namespace theme_support;

include_once(THEME_SUPPORT_PATH.'/trait/Singleton.php');
include_once(THEME_SUPPORT_PATH.'/class/Path.php');
include_once(THEME_SUPPORT_PATH.'/class/WPBlog.php');

/**
 * @author yokotak0527
 */
class ThemeSupport{
	use Singleton;
  private $PROTOCOL;
  PRIVATE $HTTP_HOST;
  public function __construct(){
    if(self::has_instance()) return self::get_instance();
    $this->PROTOCOL  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';
    $this->HTTP_HOST = $_SERVER['HTTP_HOST'];
    $this->blog      = new WPBlog();
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
   * @access public
   * @see    Path.join()
   * @param  string|array arguemnts[]
   * @return string
   */
  public function get_join_path(){
    return call_user_func_array('\theme_support\Path::join', func_get_args());
  }
  /**
   * echo joined path.
   * @access public
   */
  public function join_path(){
    echo call_user_func_array([$this, 'get_join_path'], func_get_args());
  }
  /**
   * Redirect to $url
   * @param  string $uri redirect uri
   */
  public static function redirect_to(string $uri){
    header("Location: {$uri}");
  }

	public static function enqueue_style($handle=false, $src=false, $deps=[], $ver=false, $media=false, $size=false){
    
		// if(self::$break_points && $size && isset(self::$break_points[$size])){
		// 	$media = self::$break_points[$size];
		// }else{
		// 	$media = 'all';
		// }
		// wp_enqueue_style($handle, $src, $deps, $ver, $media);
	}
  /**
   * Return order path
   * 
   * @param  string|integer $args['blog']  blog id or pretty_id (default current blog id)
   * @param  string         $args['type']  
   * @param  string         $args['where'] "user", "theme", "webroot" 
   * @param  boolean        $args['uri']   default true
   * @return string
   */
  public function get_src(array $args = []){
    $blog = isset($args['blog']) ? $args['blog'] : false;
    $blog = $this->blog->data($blog);

    $type = isset($args['type']) ? $args['type'] : false;
    if($type){
      $type = isset($blog['dir_names'][$type]) ? $blog['dir_names'][$type] : $type;
    }else{
      $type = '';
    }

    $where = isset($args['where']) ? $args['where'] : 'theme';

    $uri = !isset($args['uri']) ? true : $args['uri'];

    $insert_dir = isset($args['insert_dir']) ? $args['insert_dir'] : '';
    
    $path = '';
    if($where === 'user'){
      if($uri){
        $path .= $this->get_join_path($this->PROTOCOL, $this->HTTP_HOST, $blog['extenal_file_dir']['user'], $insert_dir, $type);
      }else{
        $path .= $this->get_join_path($_SERVER["DOCUMENT_ROOT"], $blog['extenal_file_dir']['user'], $insert_dir, $type);
      }
    }
    if($where === 'theme'){
      if($uri){
        $path .= $this->get_join_path($blog['theme_dir_uri'], $blog['extenal_file_dir']['developer'], $insert_dir, $type);
      }else{
        $path .= $this->get_join_path($blog['theme_dir'], $blog['extenal_file_dir']['developer'], $insert_dir, $type);
      }
    }
    if($where === 'webroot'){
      if($uri){
        $path .= $this->get_join_path($this->PROTOCOL, $this->HTTP_HOST, $insert_dir, $type);
      }else{
        $path .= $this->get_join_path($_SERVER["DOCUMENT_ROOT"], $insert_dir, $type);
      }
    }
    return $path;
  }
  /**
   * echo order path
   * @return void
   */
  public function src(){
    echo call_user_func_array([$this, 'get_src'], func_get_args());
  }
  /**
   * Return image path from $whre in $in
   * @param  string         $where "theme", "user" or "webroot"
   * @param  string|integer $in    blog pretty_id or blog_id
   * @return string
   */
  public function get_page_img_path_from($where, $in = false){
    $in    = $in    ? $in : get_current_blog_id();
    $base_path = $this->get_src([
      'blog'  => $in,
      'where' => $where,
      'type'  => 'img',
      'http'  => true
    ]);
  }
  /**
   * Echo image path from $whre in $in
   * @see get_page_img_path_from
   */
  public function page_img_path_from($where, $in = false){
    echo call_user_func_array([$this, 'get_page_img_path_from'], func_get_args());
  }
  /**
   * include php
   */
  public function include_from(){
    
  }
}
?>
