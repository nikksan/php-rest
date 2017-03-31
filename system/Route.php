<?php
class Route{
	 private static $GET = array();
	 private static $POST = array();
	 
	 public static function get($route, $action){
	    self::$GET[$route] = $action;
	 }
	 
	 public static function post($route, $action){
	    self::$POST[$route] = $action;
	 }
	 
	 public static function dispatch(){
	   $action = isset( self::${$_SERVER['REQUEST_METHOD']}[$_SERVER['REQUEST_URI']] ) ? self::${$_SERVER['REQUEST_METHOD']}[$_SERVER['REQUEST_URI']] : false;
	   if(!$action){
		 echo "No action found this route!";
		 exit(1);
	   }else{
	      $parts = explode('@', $action); 
		  $controller = $parts[0];
		  $method     = isset($parts[1]) ? $parts[1] : 'index';
		  $file       = DIR_CONTROLLER . $controller . '.php';
		  if(!file_exists($file)){
		    echo "File ( ".$file." ) does not exist!";
		    exit(1); 
		  }else{
		    require_once $file;
		    if(!class_exists($controller)){
			  echo "Class (".$controller.")does not exist!";
		      exit(1);
			}else{
			  $obj  = new $controller();
			  if(!method_exists($obj, $method)){
			    echo "Method (".$method.") does not exist!";
		        exit(1);
			  }else{
			    $obj->$method();
			  }
			}
		  }
	   }
	 }
	}