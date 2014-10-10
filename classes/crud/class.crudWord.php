<?php
	class CRUDWord extends absCRUDType{
		
		public static function add($config = array()){
			echo "<pre>";
			print_r($config);
			echo "</pre>";
		}
				
		public static function edit($config = array(),$name){
			echo "edit in crudWords";
		}
		
		public static function delete($config = array(),$name){
			echo "delete in crudWords";
		}
		
		public static function view($config = array(),$name){
			echo "view in crudWords";
		}
		
		public static function show($config = array(),$name){
			echo "show in crudWords";
		}
		
		public static function retrieve($config = array(),$name){
			echo "retrieve in crudWords";
		}
	
	}
?>
