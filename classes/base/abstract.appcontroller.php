<?php
	/**
	 * AppController
	 * 
	 * classe astratta per implementare le 
	 * funzionalità di base per i controller
	 * del framework
	 */
	class AppController implements InterfaceAppController{
		
		protected $registry;
		
		/**
		 * function __construct
		 * @param Registry instance
		 */
		public function __construct(){
			$this -> registry = Registry::get_instance();
		}
			
		/**
		 * metodo di default
		 * error_404 per tutti i controller
		 */
		public function error_404($data = array()){
			
			$view = new View("general/error_404");
			
			if(is_string($data))
				$view -> error_string = $data;
		
			else if(is_array($data) && count($data) > 0)
				$view -> assign($data);
			
			$view -> render();
			exit(-1);
		}
		
		public function error_500($data = array()){
		
			$view = new View("general/error_500");
			
			if(is_string($data))
				$view -> error_string = $data;
		
			else if(is_array($data) && count($data) > 0)
				$view -> assign($data);
		
			$view -> render();
			exit(-1);
		}
		
		/* funzione per recuperare item da get id */
		protected function retrieveItem(AppModel $object,
								      $parameter_not_found = MESSAGE_PARAMETER_NOT_FOUND,
									  $parameter_not_valid = MESSAGE_PARAMETER_NOT_VALID,
									  $record_not_found = MESSAGE_RECORD_NOT_FOUND){
					
			if(count($this -> registry -> request['args']) <= 0){
				$this -> error_500(array("error_string" => $parameter_not_found));
			}
			
			$id = intval($this -> registry -> request['args']['0']);
			if($id == 0){
				$this -> error_500(array("error_string" => $parameter_not_valid));
			}
			
			$item = $object -> get($id);
			if($item == null){
				$this -> error_500(array("error_string" => $record_not_found));
			}
			
			return $item;
		}
		
	}
?>
