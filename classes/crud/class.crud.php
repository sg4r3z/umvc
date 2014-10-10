<?php

	require_once(PATH_Framework.DS."crud".DS."interface.crudType.php");
	require_once(PATH_Framework.DS."crud".DS."abstract.crudType.php");
	require_once(PATH_Framework.DS."crud".DS."class.crudWord.php");
	require_once(PATH_Framework.DS."crud".DS."class.crudText.php");

	class CRUD{
		
		/**
		 * function show
		 * @param tablename,wherecondition,header of table
		 * @return null, rendering a view with data
		 * default view _crud/show
		 */
		public static function show($tablename,$items,$fields_header,$options = array()){
			
			$number_objects = 20;
			
			$request = new Request();
			$args = $request -> getArgs();
			
			$view = new View("_crud/show");
			
			isset($options['title']) ? $view -> title = $options['title'] : $view -> title = "";
			
			// implemento le variabili per la vista	   
			$view -> tableName = $tablename;
			$view -> fields_header = $fields_header;
			$view -> rows = $items;
			$view -> text_noresult = "nessun dato trovato";
			$view -> link_edit = CRUD::getLink($tablename,"edit");
			$view -> link_delete = CRUD::getLink($tablename,"delete");
			$view -> link_add = CRUD::getLink($tablename,"add");
			$view -> link_view = CRUD::getLink($tablename,"view");
			
			// tutte le componenti di options
			// diventano variabili della vista
			if(is_array($options) && count($options) > 0){
				foreach($options as $key => $value){
					$view -> $key = $value;
				}
			}
			
			/*
			 * $message_text e message_type devono essere modificabili dal
			 * controller di sys_user per un'eventuale informazione dopo un'azione
			 */
			
			// renderizzo la view			
			$view -> render();
		}
		
		public static function view($tablename,$item,$fields_header,$options = array()){
	
			$view = new View("_crud/detail");
			$view -> title = "Dettaglio Cliente";
			
			$view -> tableName = $tablename;
			$view -> link_add = CRUD::getLink("cliente","add");
			$view -> link_edit = CRUD::getLink("cliente","edit");
			$view -> fields_header = $fields_header;
			$view -> row = $item;
			
			// tutte le componenti di options
			// diventano variabili della vista
			if(is_array($options) && count($options) > 0){
				foreach($options as $key => $value){
					$view -> $key = $value;
				}
			}
			// mostro la view di crud
			$view -> render();
		}
		
		public static function getLink($model,$method){
			if(trim($model) != "" && trim($method) != "")
				return SITE_URL.US.$model.US.$method.US;
			else
				throw new Exception("Impossibile creare il link, controllare parametri d'ingresso");
		}	
		
		
	}
?>
