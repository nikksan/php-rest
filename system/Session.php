<?php 
	class Session{
		private $data = array();
		
		public function __construct(){
			if (session_status() == PHP_SESSION_NONE) {
				try{
				  session_start();
				}catch(Exception $e){
				  throw $e->getMessage();
				}
			}
	        
			$this->data = $_SESSION;
		}
		
		
		public function set($key, $value){
		  $this->data[$key]  = $value;
		}
		
		public function get($key){
		  return isset($this->data[$key]) ? $this->data[$key] : null;
		}
		
		public function remove($key){
		   unset($this->data[$key]);
		}
		
		
		public function __destruct(){
		  $_SESSION = $this->data;
		}
		
	}	