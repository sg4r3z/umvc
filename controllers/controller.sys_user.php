<?php
	class sys_userController extends AppController{
		
		public function index(){
			$this -> listing();
		}
		
		public function listing(){
			
			$sys_user = $this -> registry -> object['sys_user'];
			
			echo "<pre>";
			print_r($sys_user -> _validator);
			echo "</pre>";
			
		
			
			exit(-1);
		
		}
		
		
		/*
		public function show(){
						
			// carico i controller
			if(is_readable(PATH_Controllers.DS."controller.crud.php"))
				require(PATH_Controllers.DS."controller.crud.php");
			
			// configuro header tabella
			$fields_header = array(
									"id" => "Identificativo",
									"password" => "Password",
									"username" => "Username", 
								    "bloccato_ck" => "Bloccato?",
								    "sendemail_ck" => "Email inviata?",
								 
								    "sys_userrole_fk" => "Ruolo",
								       "registerdate" => "Data Registrazione",
								   );
			
			// mostro la list di crud
			CRUD::show("sys_user","id > 0",$fields_header);
			
			CRUDWord::add();
		}
		*/
	}
?>
