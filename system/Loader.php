<?php 
	class Load{
	 
	 /* View loader */
	 public function view($template, $data, $return = false){
	     if(!file_exists(DIR_VIEW . $template)){
		    echo DIR_VIEW . $template . " doesnt exist!";
			exit(1);
		 }else{
		    extract($data);
			unset($data);
			
			if($return){
			    ob_start();
				require_once DIR_VIEW . $template;
				$output = ob_get_contents();
				ob_end_clean();
				return $output;
			}else{
			  require_once DIR_VIEW . $template;
			}
		    
		 }
	 }
	}