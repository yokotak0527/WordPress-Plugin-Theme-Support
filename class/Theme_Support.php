<?php
namespace theme_support;

include_once(THEME_SUPPORT_PATH.'/trait/Singleton.php');
include_once(THEME_SUPPORT_PATH.'/class/Path.php');
include_once(THEME_SUPPORT_PATH.'/class/WP_Blog.php');

/**
 * @author yokotak0527
 */
class Theme_Support{
  use Singleton;
  private $PROTOCOL;
  private $HTTP_HOST;
  private function __construct($args){
    $this->PROTOCOL  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';
    $this->HTTP_HOST = $_SERVER['HTTP_HOST'];
    $this->blog      = WP_Blog::get_instance();
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
