<?php

 	/**
	 * includo tutti le costanti
	 * del setting.inc.php
	 */
	session_start();
	include("setting.inc.php");
	
	/**
	 * controllo il RUN_MODE
	 * per la stampa degli errori
	 */
	if(RUN_MODE == "debug"){	
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}
	
	/**
	 * includo tutte le classi 
	 * del framework
	 */
	include(PATH_Framework.DS."base".DS."class.db.php");
	include(PATH_Framework.DS."base".DS."abstract.appview.php");	
	include(PATH_Framework.DS."base".DS."class.view.php");
	include(PATH_Framework.DS."base".DS."abstract.appmodel.php");
	include(PATH_Framework.DS."base".DS."interface.appcontroller.php");	
	include(PATH_Framework.DS."base".DS."abstract.appcontroller.php");	
	include(PATH_Framework.DS."base".DS."class.registry.php");
	include(PATH_Framework.DS."base".DS."class.router.php");
	include(PATH_Framework.DS."base".DS."class.request.php");
	include(PATH_Framework.DS."base".DS."class.loader.php");
	include(PATH_Framework.DS."base".DS."abstract.validator.php");

		
	/**
	 * includo il modulo crud 
	 */
	include(PATH_Framework.DS."crud".DS."class.crud.php");
			
	/**
	 * inizializzo la connessione al DB
	 */
	$db = new db(DB_Type.":host=".DB_Hostname.";port=".DB_Port.";dbname=".DB_Name, DB_Username, DB_Password);
	
	/**
	 * chiamo il loader per istanziare 
	 * e caricare tutti i modelli nel registro
	 */
	Loader::load($db);
		
?>
