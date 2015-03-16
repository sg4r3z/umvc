<?php
	/**
	 * carico tutto il framework
	 */
	include("autoload.inc.php");
	/**
	 * implementazione di acl
	 */
	$registry = Registry::get_instance();
	$sys_user = $registry -> object['sys_user'];

	// recupero la richiesta
	$request = new Request();
	
	$method = $registry -> request['method'];
	$controller = $registry -> request['controller'];
		
	// se sono loggato
	// ruota verso il sistema
	if($sys_user -> checkLogin()){
			
		// array di acl
		// devo evitare l'accessoa questo array se loggatto
		$permitted = array(
							array("controller" => "sys_user", "method" => "do_login"),
							array("controller" => "sys_user", "method" => "login")
						  );

		$is_allowed = $sys_user -> permit($controller,$method,$permitted);
	
		// se non cerco di accedere 
		// a metodo login e do_login 
		// ruota
	    if(!$is_allowed)
			Router::route($request);
		// altrimenti ruota su index
		else
			Router::redirect(SITE_URL);
		
		
	}
	// altrimenti ruota alla pagina di login
	else{
				
		// array_valid 
		$permitted = array(array("controller" => "sys_user", "method" => "do_login"));
				
		// ruota su processore login
		if($sys_user -> permit($controller,$method, $permitted)){
			
			// instrado l'utente verso il metodo
			// do_login di sys_user
			Router::route($request);
		}
		// mostra l'interfaccia di login
		else{
			
			$view = new View("sys_user/form_login");
			$view -> render();
		}

	}

?>
