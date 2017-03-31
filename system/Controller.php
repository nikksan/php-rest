<?php 
	class Controller{
	  protected $db      = null;
	  protected $session = null;
	  
	  public function __construct(){
	     $this->db       = new Db(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);  
	     $this->session  = new Session();
		 $this->load     = new Load();
	  }
	}