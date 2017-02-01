<?php

  namespace theme_support;
  trait Singleton{
    private static $instance = [];
    public static function get_instance(){
      $class_name = get_class();
      if(!self::$instance[$class_name]) return false;
      else return self::$instance[$class_name];
    }
    public static function set_instance($class){
      $class_name = get_class();
      self::$instance[$class_name] = $class;
    }
    public static function has_instance(){
      $class_name = get_class();
      return self::$instance[$class_name] ? true : false;
    }
  }
