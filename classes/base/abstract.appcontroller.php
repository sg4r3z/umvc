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
		 * index per tutti i controller
		 */
		public function index(){
			$view = new View("index/index");
			$view -> render();
		}
		
		/**
		 * metodo di default
		 * error_404 per tutti i controller
		 */
		public function error_404($data = array()){
			
			$view = new View("general/error_404");
			
			$view -> assign($data);
			$view -> render();
			exit(-1);
		}
		
	}
?>
