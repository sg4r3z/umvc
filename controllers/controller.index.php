<?php
	class indexController extends AppController{
			
		public function index(){
			echo "<pre>";
			print_r($this -> registry);
			echo "</pre>";
		}
		
	}
?>
