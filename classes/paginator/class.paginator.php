<?php
	
	class Paginator{

			private $tableName;
			private $method;
			private $wherecondition;
			
			private $currentpage; 
			private $showrecs;
			private $totrecs;
						
			private $model;
						
			
			public function __construct($model,$method,$wherecondition = "id > 0",$showrecs = SHOWRECS){
				
				$this -> tableName = $model -> _tableName;
				$this -> method = $method;
				$this -> model = $model;
				$this -> wherecondition = $wherecondition;
				$this -> showrecs = $showrecs;
				
				$this -> currentpage = $this::get_page();
				$this -> totrecs = $this -> count();
			
			}
			
			public function limit(){
				
				$tablename = $this -> tableName;
				$wherecondition = $this -> wherecondition;
				$currentpage = $this -> currentpage;
				$showrecs = $this -> showrecs;
				
				$totale_pagine = $this -> get_number_page();
				
				// controllo l'indice di pagina
				if(intval($currentpage) == 0 || intval($currentpage) < 0){
					$last_id = 0;			
				}
				// pagina diversa dalla prima
				else{
					// tutte le altre
					if($totale_pagine >= $currentpage+1)
						$last_id = $currentpage*$showrecs;	
						
					// reimposta la prima pagina
					else 
						$last_id = 0;
				}
				
				// preparo la wherecondition e la ritorno
				$wherecondition = $wherecondition." LIMIT {$last_id},{$showrecs}";
								
				return $wherecondition;		
				
			}
			
			public static function get_page(){
				
				$registry = Registry::get_instance();
				
				// ritorna il primo elemento, che considero 
				// l'indice di paginazione
				if(count($registry -> request['args']) > 0)
					return intval($registry -> request['args'][0]);
						
				return 0;
			}
			
			/*
			 * render del modulo di paginazione
			 * nella view richiedente
			 * @params $destView, view di destinazione della paginazione
			 * @params $paginatorView, uri della view di paginazione nel sistema
			 * @params $currentpage, pagina corrente 
			 * @params $showrecs, numero di record per pagina
			 * @return 
			 */
			public function prepare($uriView = "general/paginator"){
			
				$view = new View($uriView);
								
				$tablename = $this -> tableName;
				$method = $this -> method;

				
				// disattivo tutti i 
				// blocchi della view
				$on_current_page = false;
				$on_previous_page = false;
				$on_forward_page = false;

				
				$quante_pagine = $this -> get_number_page();

				// se la pagina richiesta è minore di 0 
				// vai alla prima pagina
				if($this -> currentpage < 0)
					$this -> currentpage = 0;
				
				// se la pagina richiesta è maggiore dell'ultima
				if($this -> currentpage >= $quante_pagine)
					$this -> currentpage = $quante_pagine-1;
				
				// prima pagina
				if($this -> currentpage == 0){
										
					// mostra blocco pagina
					// successiva
					if($this -> totrecs > $this -> showrecs)
						$on_forward_page = true;
					
					// mostra blocco pagina
					// corrente
					$on_current_page = true;
				
				}
				// altre pagine
				else{
										
					// pagina intermedia
					// mostri tutti i blocchi
					if($quante_pagine > $this -> currentpage+1)
						$on_forward_page = true;
					
					$on_current_page = true;
					$on_previous_page = true;
				}
				
				// praparo l'array di configurazione
				// del comportamento della view di pagination
				
				$url = SITE_URL.US."%s".US."%s".US."%d";
							
				$conf = array();
				$conf['previous']['enabled'] = $on_previous_page;
				$conf['previous']['label'] = "<";
				$conf['previous']['link'] = sprintf($url,$tablename,$method,($this -> currentpage)-1);
				$conf['current']['enabled'] = $on_current_page;
				$conf['current']['label'] = "Pagina ".($this -> currentpage+1);
				$conf['current']['link'] = sprintf($url,$tablename,$method,($this -> currentpage));
				$conf['forward']['enabled'] = $on_forward_page;
				$conf['forward']['label'] = ">";
				$conf['forward']['link'] = sprintf($url,$tablename,$method,($this -> currentpage)+1);
				
				return $conf;
				
			}
			
			public function count(){
			
				$tableName = $this -> tableName;
				$wherecondition = $this -> wherecondition;
				$model = $this -> model;
				
				$query = sprintf("SELECT count(id) as counted FROM %s WHERE %s",$tableName,$wherecondition);
				$items = $model -> run($query);
				
				return $items[0]['counted'];
			}
			
			/**
			 * ritorna il numero di pagine
			 * in base ai record presenti in tabella
			 */
			public function get_number_page(){
			
				$quante_pagine = intval($this -> totrecs/$this -> showrecs);
				
				// se restano record
				if(($this -> totrecs % $this -> showrecs) > 0)
					$quante_pagine = $quante_pagine + 1;
				
				return $quante_pagine;
			}

	}
?>
