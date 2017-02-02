<?php
namespace theme_support;

/**
 * path manipulation
 * @author yokotak0527 <mail@yokotakenji.me>
 * @version 1.0.1
 */
class Path{
  private static function encode_special_text($path){
    $path = str_replace(':/','{{ptcl_sep}}',$path);
    return $path;
  }
  private static function decode_special_text($path){
    $path = str_replace('{{ptcl_sep}}',':/',$path);
    return $path;
  }
  /**
   * Return joined path.
   * ex.
   * Path->join('a', 'b')               - a/b/
   * Path->join('a', '../b')            - b/
   * Path->join('a', '../../b')         - b/
   * Path->join('a', 'b', 'c//', '//d') - a/b/c/d/
   * Path->join('dir', 'image.jpg')     - /dir
   * 
   * - If you wanna be to begin with "/" path, you can set as follows.
   * Path->join('/b', 'c') - /b/c/
   *
   * - When last slash that isn't necessary, you set last_slash option.
   * Path->join('a', 'b', [last_slash => false]) - a/b
   * 
   * @access public
   * @param  string|array args - path that join, only last args, you can set options array. [ last_slash => boolean ]
   * @return string
   */
  public static function join(){
    $opt  = [
      'last_slash' => 'true'
    ];
    $args = func_get_args();
    if(count($args) == 1 && empty($args[0])) return $args[0];
    // オプション変更
    if(is_array(end($args))) $opt = array_merge($opt,array_pop($args));
    // 「/」は除外
    $args = array_map(function($val){ return $val == '/' ? '' : $val; }, $args);
    // 空の値は削除
    $args = array_values(array_filter($args, function($v){ return !empty($v); }));
    // -------------------------------------------------------------------------
    $path = trim($args[0]);
    // 先頭
    if(preg_match('/^\/{2}/', $path)) $path = preg_replace('/^\/{2}/','//',$path);
    else $path = preg_replace('/^\/+/', '/', $path);
    // 末尾
    if(preg_match('/[a-zA-Z]:\/{2}$/',$path)) $path = preg_replace('/\/+$/','/',$path);
    else $path = preg_replace('/\/+$/','',$path);

    $path = Path::encode_special_text($path);
    $i = 1;
    $l = count($args);
    for(; $i<$l; $i++){
      $base_arr = explode( '/', $path );
      $path_arr = explode( '/', preg_replace('/^\/+|\/+$/', '', trim($args[$i])) );
      $ii = 0;
      $ll = count($path_arr);
      for(; $ii<$ll; $ii++){
        if(preg_match('/^\.{2}$/', $path_arr[$ii])) array_pop($base_arr);
        else if(preg_match('/^\.$/', $path_arr[$ii])) continue;
        else $base_arr[] = $path_arr[$ii];
      }
      $path = implode('/', $base_arr);
    }
    $path = Path::decode_special_text($path);
    // $path = $path == '/' ? '' : $path;
    if($opt['last_slash'] && !preg_match('/\.[a-zA-Z]{2,4}\??[a-zA-Z0-9\-=_\.\[\]\~\+\-\\|\¥\)\(\#\!\'\"\}\{\@\$%&\^`\*\;\:]*$/', $path)){
      $path .= '/';
    }
    return $path;
  }
}
