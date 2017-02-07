<?php

  namespace theme_support;
  trait Singleton{
    /**
     *
     */
    private static $instance = [];
    /**
     *
     */
    private function __construct(){}
    /**
     *
     */
    final function __clone(){}
    /**
     *
     */
    public static function get_instance(array $args = []){
      $class = get_class();
      if(!isset(self::$instance[$class])) self::$instance[$class] = new $class($args);
      return self::$instance[$class];
    }
  }
