<?php
	
	class CRUDText extends CRUDWord{
		
		public static function add($config = array()){
			echo "add in crudText";
		}
			
		public static function edit($config = array(),$name){
			echo "edit in crudText";
		}
		
		public static function delete($config = array(),$name){
			echo "delete in crudText";
		}
		
		public static function view($config = array(),$name){
			echo "view in crudText";
		}
		
		public static function show($config = array(),$name){
			echo "show in crudText";
		}
		
		public static function retrieve($config = array(),$name){
			echo "retrieve in crudText";
		}
	}
?>
