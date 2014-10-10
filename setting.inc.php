<?php

	 ## ROOT CONFIGURATION
	 define('ROOT_DIR', dirname(__FILE__));
	 
	 ##
	 define('DS', DIRECTORY_SEPARATOR); 
	 define('US', '/');
	 
	 ## DEFAULT LANGUAGE
	 define('DEFAULT_LANGUAGE', 'it-IT');
	 
	 ## RUN MODE
	 define('RUN_MODE', 'debug');
	 	 
	 switch(RUN_MODE){
	
	  # Run_Mode PRODUCTION
	  case 'production':
	    
	  	# Database setting
	  	define('DB_Type', 'mysql');
		define('DB_Hostname', '');
		define('DB_Username', '');
		define('DB_Password', '');
		define('DB_Name', '');
	  	define('DB_Port', '3306');

	  	define("SITE_NAME","");
		define("APP_NAME","");
		define('SITE_URL',''.US.APP_NAME);

		 ## definisco una costante path per gli allegati
		define("UPLOADED_DIR","");
		define("UPLOADED_URL","");
		
		## 
			
		break;
	  
	  # Run_mode debug
	  default:
	  
	  	# Database setting
  	 	define('DB_Type', 'mysql');
		define('DB_Hostname', 'localhost');
		define('DB_Username', 'root');
		define('DB_Password', 'root');
		define('DB_Name', 'umvc');
	  	define('DB_Port', '3306');

		define("SITE_NAME","");
		define("APP_NAME","2014");
		define('SITE_URL','http://localhost'.US.APP_NAME);

		 ## definisco una costante path per gli allegati
		define("UPLOADED_DIR","uploaded".US."temp");
		define("UPLOADED_URL",SITE_URL.US."uploaded".US."temp");

		##
		
		break;
	 }
	 
	 define("CONNECTION_STRING",DB_Type.":host=".DB_Hostname.";port=".DB_Port.";dbname=".DB_Name);

	 define('SITE_DIR',ROOT_DIR);
	 
	 ## DIRNAME CONFIGURATION
 	 define('FRAMEWORK_dirname', "classes");
 	 define('MODELS_dirname', "models");
 	 define('VIEWS_dirname', "views");
 	 define('CONTROLLER_dirname', "controllers");
 	 define('VALIDATOR_dirname', "validators");
 	 
	 ## PATH CONFIGURATION
	 define('PATH_Framework', ROOT_DIR.DS.FRAMEWORK_dirname);
 	 define('PATH_Models', ROOT_DIR.DS.MODELS_dirname);
 	 define('PATH_Views', ROOT_DIR.DS.VIEWS_dirname);
 	 define('PATH_Controllers', ROOT_DIR.DS.CONTROLLER_dirname);
 	 define('PATH_Validators', ROOT_DIR.DS.VALIDATOR_dirname);
 	 
	 ## DEFAULT VIEW
	 define("DEFAULT_CONTROLLER","index");
	 define("DEFAULT_METHOD","index");
	 
	 define("ERROR_404","general/error_404.php");
	 
	 // numero di record mostrati nelle liste
	 define("SHOWRECS",10);
	  
	
?>
