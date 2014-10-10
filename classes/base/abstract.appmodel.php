<?php
	/**
	 * AppModel
	 *
	 * classe astratta per gestire i modelli
	 * nel framework umvc
	 *
	 */
	abstract class AppModel{
		
		/**
		 * dichiaro il costruttore
		 * per farlo utilizzare alle
		 * sottoclassi
		 * 
		 * function __construct
		 * @param PDO $db object
		 * @return null
		 */
		public function __construct($db,$validator){
			$this -> _db = $db;
			$this -> _validator = $validator;
		}
		
		/**
		 * function get_fields
		 * return fields of table
		 * @param null
		 * @return array
		 */
		public function get_fields(){
			return array_keys($this -> _validator);
		}
		
		/**
		 * function createnew
		 * @param array $item, item to insert
		 * @return true or exception
		 */
		public function createnew($item){
			if($this -> validate($item,"createnew"))
				return $this -> _db -> insert($this -> _tableName,$item);
		}
		
		/**
		 * function modify
		 * @param array $item
		 * @return true or exception
		 */
		public function modify($item){
			if($this -> validate($item,"modify"))
				return $this -> _db -> update($this -> _tableName,$item,"id = {$item['id']}");
		}
		
		/**
		 * function delete
		 * @param table,wherecondition,bind
		 * @return true or exception
		 */
		public function delete($table,$wherecondition,$bind = ""){
			$this -> _db -> delete($table,$wherecondition,$bind);
		}
		
		/**
		 * function select
		 * @param table
		 * @param where
		 * @param bind
		 * @param fields
		 * @return items
		 */
		public function select($table,$where,$bind = "",$fields = "*"){
			return $this -> _db -> select($table,$where,$bind,$fields);
		}
		
		/**
		 * function run 
		 * @param sql
		 * @return items
		 */
		public function run($sql,$bind = ""){
			return $this -> _db -> run($sql,$bind);
		}
		
	   /**	
	    * function get
		* @param int $id id della tupla da recuperare 
		* @return stdClass o null tupla del db
		*/
		public function get($id){
			
			if(intval($id) > 0){
				$item = $this -> _db -> select($this -> _tableName,"id = $id");
				if(count($item) > 0)
					return (object) $item[0];
				
					
			}
			return null;
		}
		
		/**
		 * function listing
		 * @param string $wherecondition 
		 * @return array or null
		 */
		public function listing($wherecondition = "id > 0"){
			$data = array();
			$items = $this -> _db -> select($this -> _tableName,$wherecondition);
			
			if(count($items) > 0){
					
				foreach($items as $item){
					$data[] = $this -> get($item['id']);
					//$data[] = (object) $item;
				}
				
				return $data;
			}
			
			return null;
		}
		
		/**
		 * function last_insert_id
		 * return last_insert_id 
		 */
		public function last_insert_id(){
			return $this -> _db -> lastInsertId();
		}
		
		/**
		 * function validate
		 * @param array $item, item to validate
		 * @param string $requiresMethod, name of method to validate
		 * @return true or exception
		 */
		public function validate($items,$requiredMethod){
			
			foreach($this -> _validator as $fieldName => $vld_options){
				
				// se required controlla la presenza del campo nell'array
				// validalo
				if(intval($vld_options[$requiredMethod])){
					if(array_key_exists($fieldName, $items)){
						if(!preg_match($vld_options['pattern'], $items[$fieldName]))
							throw new PDOException("Campo: $fieldName - non corrisponde a {$vld_options['pattern']}");
					}
					else{
						throw new PDOException("Campo: $fieldName - Obbligatorio in $requiredMethod");
					}
				}
				
				else{
					// se non è required ed è presente validalo con il suo pattern
					if(array_key_exists($fieldName, $items) && trim($items[$fieldName]) != ""){
						if(!preg_match($vld_options['pattern'], $items[$fieldName]))
							throw new PDOException("Campo: $fieldName - non corrisponde a {$vld_options['pattern']}");
					}
				}
			    
			}
			
			return true;
		}
		
	}
?>
