<?php
	interface intCRUDType{
		
		public static function add($config = array());
		public static function edit($config = array(),$name);
		public static function view($config = array(),$name);
		public static function delete($config = array(),$name);
		public static function show($config = array(),$name);
		
		// in form processor
		public static function retrieve($config = array(),$name);
		
	}
?>
