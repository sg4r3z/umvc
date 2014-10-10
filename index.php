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
		
	// se sono loggato
	// ruota verso il sistema
	if($sys_user -> checkLogin()){
		
		$method = $registry -> request['method'];
		$controller = $registry -> request['controller'];
	
		// array di acl
		$denied_methods = array("login","do_login");
		$denied_controllers = array("sys_user");
		
		$not_permitted = in_array($method,$denied_methods) && in_array($controller,$denied_controllers);
		
		// se non cerco di accedere 
		// a metodo login e do_login 
		// ruota
	    if(!$not_permitted)
			Router::route($request);
		// altrimenti ruota su index
		else
			Router::redirect(SITE_URL);
		
		
	}
	// altrimenti ruota alla pagina di login
	else{
				
		$method = $registry -> request['method'];
		$controller = $registry -> request['controller'];
	
		// array di acl
		$allow_methods = array("do_login");
		$allow_controllers = array("sys_user");
		
		$permitted = in_array($method,$allow_methods) && in_array($controller,$allow_controllers);

		// ruota su processore login
		if($permitted){
			
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
