<?php 
	class Db{
		private $link;
		
		public function __construct($servername, $username, $password , $database, $port = '3306'){
			if (!$this->link = mysql_connect($servername . ':' . $port, $username, $password)) {
				trigger_error('Error: Could not make a database link using ' . $username . '@' . $servername);
				exit();
			}
			
			if (!mysql_select_db($database, $this->link)) {
				trigger_error('Error: Could not connect to database ' . $database);
				exit();
			}
			
			mysql_query("SET NAMES 'utf8'", $this->link);
			mysql_query("SET CHARACTER SET utf8", $this->link);
			mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->link);
			mysql_query("SET SQL_MODE = ''", $this->link);
		}
		
		public function query($sql) {
			if ($this->link) {
				$resource = mysql_query($sql, $this->link);
				
				if ($resource) {
					if (is_resource($resource)) {
						$i = 0;
						
						$data = array();
						
						while ($result = mysql_fetch_assoc($resource)) {
							$data[$i] = $result;
							
							$i++;
						}
						
						mysql_free_result($resource);
						
						$query = new \stdClass();
						$query->row = isset($data[0]) ? $data[0] : array();
						$query->rows = $data;
						$query->num_rows = $i;
						
						unset($data);
						
						return $query;
					} else {
						return true;
					}
				} else {
					$trace = debug_backtrace();
					
					trigger_error('Error: ' . mysql_error($this->link) . '<br />Error No: ' . mysql_errno($this->link) . '<br /> Error in: <b>' . $trace[1]['file'] . '</b> line <b>' . $trace[1]['line'] . '</b><br />' . $sql);
				}
			}
		}
		
		
		
	}	