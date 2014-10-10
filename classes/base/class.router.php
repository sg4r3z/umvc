<?php
	/**
	 * Router
	 * classe che si occupa
	 * della redirezione delle 
	 * richieste sui controller 
	 */
	class Router{
		
		/**
		 * function route
		 * @param Registry instance 
		 */
		public static function route(Request $r){
			
			// recupero tutti i parametri dalla richiesta
			$controller = $r -> getController();
			$method = $r -> getMethod();
			$args = $r -> getArgs();
									
			// se il controller è leggibile
			$controller_path = PATH_Controllers.DS."controller.$controller.php";
			if(is_readable($controller_path)){
				
				// includo e istanzio il controller
				require_once($controller_path);
				$controller_n = $controller."Controller";
				$controller = new $controller_n();
				
				// controllo istanza del metodo
				if($controller instanceof AppController){
					
					// cerco il metodo
					if(method_exists($controller, $method)){
						if(!empty($args)){
							call_user_func_array(array($controller,$method),$args);
						}
						else
							call_user_func(array($controller,$method));
					}	
					// il metodo non esiste
					else
						call_user_func(array($controller,"error_404"));			
				}
				else
					throw new Exception("Impossibile lavorare con oggetti di classi diverse da AppController");
				
			}
			// non hai trovato il controller
			// chiama il metodo error del 
			// controller di default
			else{
				$controller_path = PATH_Controllers.DS."controller.".DEFAULT_CONTROLLER.".php";
				require_once($controller_path);
				$controller_n = DEFAULT_CONTROLLER."Controller";
				$controller = new $controller_n();
				call_user_func(array($controller,"error_404"));
			}
		}

		// funzione per il redirect interno
		public static function redirect($url){
			header("Location:".$url);
		}
		
	}
?>