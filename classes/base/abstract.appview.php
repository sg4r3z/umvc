<?php	
	/**
	 * AppView
	 * 
	 * classe base per tutte le viste
	 * del framework
	 */
	class AppView{
		
		/**
		 * attributi della classe
		 */
		protected $view,$data;
		
		/**
		 * function __construct
		 * @param string $requestView
		 */
		public function __construct($requestView){
			$this -> view = $requestView;
		}
		
		/**
		 * function __set
		 * @param string $key, chiave da inserire nell'array
		 * @param string $val, valore da inserire nell'array
		 */
		public function __set($key,$val){
			$this -> data[$key] = $val;
		}
		
		/**
		 * function __get
		 * @param string $key, chiave da recuperare
		 * @return value or null
		 */
		public function __get($key){
			if(array_key_exists($key, $this -> data))
				return $this -> data[$key];
			return null;
		}
		
		/**
		 * function render
		 * metodo render per tutte le viste 
		 * mostra la vista impostata nel costruttore
		 * dell'istanza, se non la trova chiama
		 * la vista di errore
		 * e poi esce con un exit();
		 */
		public function render(){
			
			// creo le variabili definite in data 
			// all'interno dello scope della vista
			if(count($this -> data) > 0)
				foreach($this -> data as $key => $value)
					$$key = $value;	
				
			// controllo esistenza view
			if(is_readable(PATH_Views.DS.$this -> view.".php"))
				require_once(PATH_Views.DS.$this -> view.".php");
			
			// se la vista non è stata trovata
			else
				require_once(PATH_Views.DS.ERROR_404);	
			
			// ho commentato l'exit
			// per poter effettuare inclusioni multiple
			// in un file unico
			//exit();
		}
		
		public function assign($data){
			
			// passo data alla view
			if(count($data) > 0)
				foreach($data as $key => $value) 
					$this -> $key = $value;
		}
	}
?>
