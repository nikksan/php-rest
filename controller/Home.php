<?php 
	class Home extends Controller{
	 public function index(){
	   $data = array('key' => 'Test');
	   
	   $this->load->view('index.html', $data);
	 }
	}