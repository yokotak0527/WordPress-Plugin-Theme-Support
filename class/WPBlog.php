<?php
  namespace theme_support;
  include_once($plugin_dir.'/trait/Singleton.php');

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

        // var_dump(self::$MULTISITE);
        $this->MULTISITE = defined('MULTISITE') ? MULTISITE : false;
        
        // =====================================================================
        // Blog data setting
        // =====================================================================
        // ---------------------------------------------------------------------
        // MULTI SITE
        // 
        if($this->MULTISITE){
          $blogs = $wpdb->get_results( "SELECT blog_id FROM ".$wpdb->base_prefix."blogs ORDER BY blog_id" );
          $i = 0; $l = count($blogs);
          
          for(; $i<$l; $i++){
            $blog_id = (int) $blogs[$i]->blog_id;
            switch_to_blog($blog_id);
            
            // -----------------------------------------------------------------
            // sub-directory type multi site
            // 
            if(defined('SUBDOMAIN_INSTALL') || !SUBDOMAIN_INSTALL){
              $pretty_id     = preg_replace('/^https?:\/\//', '', home_url());
              $rtv_site_path = str_replace(home_url(), '', site_url());
              $pretty_id     = str_replace(DOMAIN_CURRENT_SITE, '', $pretty_id);
              $pretty_id     = str_replace($rtv_site_path, '', $pretty_id);
              $pretty_id     = basename($pretty_id);
            }
            // -----------------------------------------------------------------
            // sub-domain type multi site
            // 
            else{
              $pretty_id = preg_replace('/^https?:\/\//', '', home_url());
              $pretty_id = str_replace('.'.DOMAIN_CURRENT_SITE, '', $pretty_id);
            }
            // -----------------------------------------------------------------
            // common
            // 
            if(BLOG_ID_CURRENT_SITE === $blog_id) $pretty_id = 'root';
            $blog_data[$pretty_id] = [
              'blog_id'    => $blog_id,
              'dir_name'   => $pretty_id,
              'site_url'   => site_url(), // WordPress address
              'home_url'   => home_url(), // Blog address
              'theme_dir'  => get_stylesheet_directory_uri(),
              'theme_name' => basename(get_stylesheet_directory_uri())
            ];
            $blog_id_2_pretty_id[$blog_id] = $pretty_id;
            restore_current_blog();
          }
        }
        // ---------------------------------------------------------------------
        // SINGLE SITE
        // 
        else{
          $pretty_id = 'root';
          $blog_data[$pretty_id] = [
            'blog_id'    => $blog_id,
            'dir_name'   => $pretty_id,
            'site_url'   => site_url(), // WordPress address
            'home_url'   => home_url(), // Blog address
            'theme_dir'  => get_stylesheet_directory_uri(),
            'theme_name' => basename(get_stylesheet_directory_uri())
          ];
          $blog_id_2_pretty_id[$blog_id] = $pretty_id;
        } 
      
        self::set_instance($this);
    }
  }
