<?php
	/**
	 * classe Registro
	 * la classe registro permette 
	 * di disporre nell'applicativo 
	 * uno strumento generale per
	 * condividere oggetti,dati,variabili
	 * in tutti i livelli del framework
	 */
	class Registry{
		
		private $data;
		private static $instance = null;
		
		/**
		 * function __construct
		 * inizializza l'attributo data
		 * della classe 
		 */
		private function __construct(){
			$this -> data = array();
		}
		
		/**
		 * function get_instance
		 * @return Registry instance
		 */
		public static function get_instance(){
			
			if(!self::$instance instanceof self)
				self::$instance = new Registry;
			
			return self::$instance;
		}
		
		/**
		 * function __set
		 * @param string $key,chiave dell'array
		 * @param string $value,chiave dell'array
		 */
		public function __set($key,$val){
			$this -> data[$key] = $val;
		}
		
		/**
		 * function __get
		 * @param string $key,chaive dell'array
		 * @return string or exception
		 */
		public function __get($key){
			if(array_key_exists($key, $this -> data))
				return $this -> data[$key];
			throw new ErrorException("Chiave non trovata nel registro");
		}
		
		
	}
?>