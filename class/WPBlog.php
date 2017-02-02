<?php
  namespace theme_support;
  include_once(THEME_SUPPORT_PATH.'/trait/Singleton.php');

  /**
   * Blogデータの扱いを簡単にする
   *
   * @author yokotak0527 <mail@yokotakenji.me>
   */

  class WPBlog{
    use Singleton;
  	private $blog_data           = [];
    private $blog_id_2_pretty_id = [];
    private $MULTISITE;
    /**
     * 
     */
    public function __construct(){
      global $wpdb;
      if(self::has_instance()) return self::get_instance();

      $this->MULTISITE = defined('MULTISITE') ? MULTISITE : false;
      
      // =======================================================================
      // Blog data setting
      // =======================================================================
      // MULTI SITE
      if($this->MULTISITE){
        $blogs = $wpdb->get_results( "SELECT blog_id FROM ".$wpdb->base_prefix."blogs ORDER BY blog_id" );
      }
      // SINGLE SITE
      else{
        $blogs   = [];
        $blogs[] = (object) ['blog_id' => get_current_blog_id()];
      }
      $i = 0; $l = count($blogs);

      for(; $i<$l; $i++){
        $blog_id = (int) $blogs[$i]->blog_id;
        switch_to_blog($blog_id);

        // ---------------------------------------------------------------------
        // sub-directory type multi-site
        // 
        if(defined('SUBDOMAIN_INSTALL') || !SUBDOMAIN_INSTALL){
          $rtv_site_path = str_replace(home_url(), '', site_url());
          $rtv_site_path = preg_replace('/(^\/)(.*)(\/$)/', '$2', $rtv_site_path);

          $pretty_id     = preg_replace('/^https?:\/\//', '', home_url());
          $pretty_id     = str_replace(DOMAIN_CURRENT_SITE, '', $pretty_id);
          $pretty_id     = str_replace($rtv_site_path, '', $pretty_id);
          $pretty_id     = preg_replace('/(^\/)(.*)(\/$)/', '$2', $pretty_id);
          $pretty_id     = basename($pretty_id);
        }
        // ---------------------------------------------------------------------
        // sub-domain type multi-site
        // 
        if(defined('SUBDOMAIN_INSTALL') || SUBDOMAIN_INSTALL){
          $pretty_id = preg_replace('/^https?:\/\//', '', home_url());
          $pretty_id = str_replace('.'.DOMAIN_CURRENT_SITE, '', $pretty_id);
        }
        // ---------------------------------------------------------------------
        // common
        // 
        if(BLOG_ID_CURRENT_SITE === $blog_id) $pretty_id = 'root';
        $this->blog_data[$pretty_id] = [
          'blog_id'          => $blog_id,
          'dir_name'         => $pretty_id,
          'site_url'         => site_url(), // WordPress address
          'home_url'         => home_url(), // Blog address
          'theme_dir'        => get_stylesheet_directory(),
          'theme_dir_uri'    => get_stylesheet_directory_uri(),
          'theme_name'       => get_stylesheet(),
          'extenal_file_dir' => [
            'developer' => get_option('_ts_external-file-dir--dev') ? get_option('_ts_external-file-dir--dev') : '',
            'user'      => get_option('_ts_external-file-dir--usr') ? get_option('_ts_external-file-dir--usr') : ''
          ],
          'dir_names' => [
            'img' => get_option('_ts_dir-names--img') ? get_option('_ts_dir-names--img') : 'img',
            'js'  => get_option('_ts_dir-names--js')  ? get_option('_ts_dir-names--js')  : 'js',
            'css' => get_option('_ts_dir-names--css') ? get_option('_ts_dir-names--css') : 'css'
          ]
        ];
        $this->blog_id_2_pretty_id[$blog_id] = $pretty_id;
        restore_current_blog();
      }
    
      self::set_instance($this);
    }
    /**
     * 
     * @return boolean
     */
  	public function is_multisite(){
  		return $this->MULTISITE;
  	}
    /**
     * Return Blog data
     * @param  string|int $key
     * @return array|boolean
     */
  	public function data($key = false){
      if($key === false){
        $key = $this->blog_id_2_pretty_id[get_current_blog_id()];
      }
      if(gettype($key) === 'integer'){
        if(isset($this->blog_id_2_pretty_id[$key])){
          $key = $this->blog_id_2_pretty_id[$key];
        }else{
          return false;
        }
      }
      if(!isset($this->blog_data[$key])) return false;
      return $this->blog_data[$key];
  	}
    /**
     * [get_root_blog_data description]
     * @return [type] [description]
     */
  	public function root_data(){
  		return $this->get_blog_data('root');
  	}
  }
