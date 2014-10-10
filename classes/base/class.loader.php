<?php
	class Loader{
		
		private static $registry = null;

		public static function load(){
			
			/**
			 * inizializzo la connessione al DB
			 */
			$db = new db(CONNECTION_STRING, DB_Username, DB_Password);
	
			// inizializzo il registro
			self::$registry = Registry::get_instance();
			
			// carico tutte le classi di validazione
			self::__load_validators();
						
			// carico tutti i modelli
			self::__load_models($db);
		}
		
		private static function __load_validators(){
			
			$validators = array();
			$cartella = opendir(PATH_Validators);
			while ($file = readdir($cartella)) {
				
				if($file != ".." && $file != "."){
					$class_ar = explode(".",$file);
					$class = $class_ar[count($class_ar)-2];
					
					// includo singolarmente ogni validator			
					if(is_readable(PATH_Validators.DS."validator.{$class}.php"))
						require_once(PATH_Validators.DS."validator.{$class}.php");
					
				}
			}
					
		}
		
		/*
		 * funzione per caricare tutti i modelli in registro
		 */
		private static function __load_models($db){
			
			$registry = self::$registry;
				
			$models = array();
			$cartella = opendir(PATH_Models);
			while ($file = readdir($cartella)) {
				
				if($file != ".." && $file != "."){
					
					$class_ar = explode(".",$file);
					$model = $class_ar[count($class_ar)-2];
					$models[$model] = new $model($db);
				}
			}
			
			// carico i modelli istanziati nel registro
			self::$registry -> object = $models;
		}
		
		/**
		 * funzione per caricare classi esterne 
		 * @param path_file, uri completo della classe
		 * @return true or exception 
		 */
		public static function load_external($path_file){
						
			if(is_readable($path_file)){
				
				require_once($path_file);
				return true;
			}
			
			throw new Exception("Classe richiesta non trovata");
		}
		
	
	}
	
	// funzione per effettuare l'autoload dei
	// modelli in php
	function __autoload($class){
		if(is_readable(PATH_Models.DS."model.".$class.".php"))
			require_once(PATH_Models.DS."model.".$class.".php");
	}
	
?>
