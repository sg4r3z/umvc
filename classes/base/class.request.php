<?php
	class Request{
		
		private $_controller;
		private $_method;
		private $_args;
		
		public function __construct($uri = ""){
			
			// default request uri		
			if(trim($uri) == ""){
				$uri = $_SERVER['REQUEST_URI'];
			}
			
			// esplodo uri e filtro
			$elements = explode("/",$uri);
			$elements = array_filter($elements);
			array_shift($elements);
			
			// associo a proprieta	
			$this -> _controller = !(empty($elements[0])) ? $elements[0] : DEFAULT_CONTROLLER;			
			$this -> _method = !empty($elements[1]) ? $elements[1] : "index";
					
			$args = array();
			for($i=2;$i<count($elements);$i++)
				$args[] = $elements[$i];
			
			$this -> _args = $args;		
			
			// salvo i valori intepretati nel registro
			$this -> registry = Registry::get_instance();
			$r = array();
			$r['controller'] = $this -> getController();
			$r['method'] = $this -> getMethod();
			$r['args'] = $this -> getArgs();
			
			// salvo nel registro
			// i dati recuperati dall'uri
			$this -> registry -> request = $r;
			
		}
		
		
		public function getController(){
			return $this -> _controller;
		}
		
		public function getMethod(){
			return $this -> _method;
		}
		
		public function getArgs(){
			return $this -> _args;
		}
	}

?>
