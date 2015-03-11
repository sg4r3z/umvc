<?php

	class sys_userController extends AppController{
		
		public function index(){
			$this -> listing();
		}

		public function savePwd(){

			$registry = Registry::get_instance();
			$sys_user = $registry -> object['sys_user'];

			isset($_POST['id']) ? $id = intval($_POST['id']) : $id = -1;
			isset($_POST['vecchia_password']) ? $vecchia_password = trim($_POST['vecchia_password']) : $vecchia_password = "";
			isset($_POST['nuova_password']) ? $nuova_password = trim($_POST['nuova_password']) : $nuova_password = "";

			if($id < 0){
				$ar = array();
				$ar['error_string'] = "Impossibile procedere, utente non valido";
				$this -> error_404($ar);
			}

			if(trim($vecchia_password) == ""){
				$ar = array();
				$ar['error_string'] = "Impossibile procedere, vecchia password vuota";
				$this -> error_404($ar);
			}

			if(trim($nuova_password) == ""){
				$ar = array();
				$ar['error_string'] = "Impossibile procedere, nuova password vuota";
				$this -> error_404($ar);
			}

			// controlla che esista il sys_user e che sia di squadra
			$item_sys = $sys_user -> get($id);

			// controlla che la vecchia password
			// corrisponda all'md5 o alla password in chiaro
			if(trim($item_sys -> password) == md5($vecchia_password) || trim($item_sys -> password) == $vecchia_password){

				$ar_sys = array();
				$ar_sys['password'] = md5($nuova_password);
				$ar_sys['id'] = $id;
				$sys_user -> modify($ar_sys);

				Router::redirect(SITE_URL);

			}
			else{
				$ar = array();
				$ar['error_string'] = "Impossibile modificare, vecchia password errata";
				$this -> error_404($ar);
			}
			
		}

		public function editPwd(){

			$registry = Registry::get_instance();
			$squadra = $registry -> object['squadra'];
			$sys_user = $registry -> object['sys_user'];

			$role_fk = intval($_SESSION['userrole_fk']);
			$user_id = intval($_SESSION['id']);

			if($role_fk == 2){

				$item_squadra = $squadra -> listing("id > 0 AND sys_user_fk = {$user_id}");

				if(count($item_squadra) == 0){
					$ar = array();
					$ar['error_string'] = "Impossibile procedere, utente non associato a nessuna squadra";
					$this -> error_404($ar);
				}

				$item_squadra = $item_squadra[0];

				
				$view = new View("sys_user/edit_pwd");
				
				$view -> sys_user_id = $user_id;
				$view -> title = "Modifica Password";
				$view -> link_modifica_pwd = SITE_URL.US."sys_user".US."editPwd";
				$view -> link_save_pwd = SITE_URL.US."sys_user".US."savePwd";
				$view -> item_squadra = $item_squadra;
				
				$view -> render();
			}
			
			else{
				$ar = array();
				$ar['error_string'] = "Impossibile accedere alla pagina richiesta";
				$this -> error_404($ar);
			}
		}
		
		public function do_logout(){
			
			$logged = array();
			$logged['user_fk'] = $_SESSION['id'];
			$logged['sessionid'] = session_id();
			$logged['source'] = "internal";
			$logged['timestamp'] = date("Y-m-d H:i:s");
			$logged['task'] = "LOGOUT";
			$logged['result'] = "true";
			$logged['resource'] = $_SERVER['REMOTE_ADDR'];

			// loggo l'operazione
			$this -> log($logged);
			
			unset($_SESSION['id']);
			unset($_SESSION['userrole_fk']);
			
			Router::redirect(SITE_URL);
			
		}
	
		public function do_login(){
		
			isset($_POST['username']) ? $username = trim($_POST['username']) : $username = false;
			isset($_POST['password']) ? $password = trim($_POST['password']) : $password = false;
						
			if($username && $password){
				
				$registry = Registry::get_instance();
				$sys_user = $registry -> object['sys_user'];
				
				$wherecondition = "username = :username AND (password = :password OR password = :md5pass) AND blocked = 0";
				$fields = "id,sys_userrole_fk";
				$bind = array(
								":username" => $username,
								":password" => $password,
								":md5pass" => md5($password)
							  );
							  				
				$items = $sys_user -> select("sys_user",$wherecondition,$bind,$fields);
				
				// preparo l'array di log
				$logged = array();
				$logged['source'] = "external";
				$logged['timestamp'] = date("Y-m-d H:i:s");
				$logged['task'] = "LOGIN";
				$logged['resource'] = $_SERVER['REMOTE_ADDR'];

				
				// se ho trovato un solo record
				// è possibile che abbia trovato
				// l'utente in db
				if(count($items) == 1){
					
					$item = $items[0];
					
					$_SESSION['id'] = $item['id'];
					$_SESSION['userrole_fk'] = $item['sys_userrole_fk'];
					
					$logged['user_fk'] = $item['id'];
					$logged['sessionid'] = session_id();
					$logged['result'] = "true";
					
					// loggo l'operazione
					$this -> log($logged);
					
					Router::redirect(SITE_URL);
					
				}
				// altrimenti torna alla schermata
				// di login con errore
				else{
					
					$logged['user_fk'] = 0;
					$logged['result'] = "false";
					$logged['details'] = "username=$username;password=$password";

					// loggo l'operazione
					$this -> log($logged);
					
					
					$data = array();
					$data['error_string'] = "Nome utente o Password errata";
					$this -> login($data);
				}

			}
			else{
				
				$logged = array();
				$logged['user_fk'] = 0;
				$logged['timestamp'] = date("Y-m-d H:i:s");
				$logged['task'] = "LOGIN";
				$logged['source'] = "external";
				$logged['result'] = "false";
				$logged['details'] = "username=$username;password=$password";
				$logged['resource'] = $_SERVER['REMOTE_ADDR'];

				// loggo l'operazione
				$this -> log($logged);
					
				
				$data = array();
				$data['error_string'] = "Devi inserire le credenziali per accedere";
				$this -> login($data);
			}
 		
		}
	
		public function login($data = array()){
			
			$view = new View("sys_user/form_login");
			$view -> assign($data);
			$view -> render();
			return;
		}
		
		public function listing(){
						
			// carico le classi esterne
			Loader::load_external(PATH_Framework.DS."paginator".DS."class.paginator.php");
			
			$registry = Registry::get_instance();
			$sys_user = $registry -> object['sys_user'];
			
			$wherecondition = "id > 0 ORDER BY sys_userrole_fk DESC";
			
			// con modello wherecondition e numero di record da visualizzare		
			$paginator = new Paginator($sys_user,"listing",$wherecondition);
			
			// limito la wherecondition
			$limited = $paginator -> limit();
			
			// recupero i dati		
			$items = $sys_user -> listing($limited);	
			
			// configuro le opzioni per la vista   
			$options = array(
								"title" => "Utenti di Sistema",
								"paginator" => $paginator -> prepare()
							 );
			
			$fields_header = array(
									"username" => "Username", 
								    "blocked_label" => "Bloccato?",
								    "sendemail_label" => "Email inviata?",
								    "registerdate" => "Data Registrazione",
								    "role_label" => "Ruolo"
								   );
						
			// mostro la list di sys_user
			$view = new View("sys_user/show");
			$view -> fields_header = $fields_header;
			$view -> title = TITLE;
			$view -> link_add = SITE_URL.US."sys_user".US."add";
			$view -> assign($options);
			$view -> rows = $items;
			$view -> text_noresult = "Nessun risultato trovato";
			$view -> link_view = SITE_URL.US."sys_user".US."view".US;
			$view -> link_edit= SITE_URL.US."sys_user".US."edit".US;
			$view -> link_delete = SITE_URL.US."sys_user".US."delete".US;
			
			$view -> render();
		}
		
		public function log($logged){
		
			$registry = Registry::get_instance();
			$sys_userlog = $registry -> object['sys_userlog'];
			
			$sys_userlog -> createnew($logged);
		
		}
	
		public function add(){
		
			$registry = Registry::get_instance();
			$sys_userrole = $registry -> object['sys_userrole'];
			
			$items_role = $sys_userrole -> listing("id > 0");
		
			$view = new View("sys_user/add");
			$view -> items_role = $items_role;
			$view -> title = "Nuovo Utente";
			$view -> render();
		}
	
		public function save(){
		
			if(count($_POST) > 0){
			
				$sys_user = $this -> registry -> object['sys_user'];
				
				try{
					
					// imposto le date
					$_POST['registerdate'] = date("Y-m-d H:i:s");
					$_POST['lastvisit'] = "0000-00-00 00:00:00";
					
					$xid = $sys_user -> createnew($_POST);
					
					// ritorno alla lista
					Router::redirect(SITE_URL.US."sys_user".US."listing");
				
				}
				catch(Exception $e){
					
					$data = array();
					$data['error_string'] = "Impossibile salvare l'utente";
					$data['debug_string'] = print_r($e,true);
					
					$this -> error_404($data);
					
				}
				
			}
			else{
			
				$data = array();
				$data['error_string'] = "Errore impossobile salvare, nessun dato in input";
				
				$this -> error_404($data);
	
			}
		
		
		}

		public function edit(){
			
			// recupero i dati dal registro
			$registry = Registry::get_instance();
			$id = $registry -> request['args'][0];	
			
			$sys_user = $registry -> object['sys_user'];
			$sys_userrole = $registry -> object['sys_userrole'];
			
			if(intval($id) > 0){
				
				try{
					
					$item_sys_user = $sys_user -> get($id);
					$items_role = $sys_userrole -> listing();
					
					$view = new View("sys_user/edit");
					$view -> title = "Modifica utente";
					$view -> row = $item_sys_user;
					$view -> items_role = $items_role;
					$view -> render();
				
				}
				catch(Exception $e){
				
					$data = array();
					$data['error_string'] = "Documento non trovato";
					$data['debug_string'] = print_r($e,true);
					
					$this -> error_404($data);
				}
			}
			// id non è un'intero
			else{
				
				$data = array();
				$data['error_string'] = "L'identificativo passato non è intero"; 
				
				$this -> error_404($data);
			}	
			
	
		
		}
	
		public function modify(){
		
			if(count($_POST) > 0 && isset($_POST['id'])){
				
				$sys_user = $this -> registry -> object['sys_user'];
				$id = intval($_POST['id']);
				
				$item_sys_user = $sys_user -> get($id);
				if($item_sys_user != null){
					
					try{
						
						$sys_user -> modify($_POST);
						Router::redirect(SITE_URL.US."sys_user".US."listing");
						
					}
					catch(Exception $e){
						
						$data = array();
						$data['error_string'] = "Problema durante la modifica del documento";
						$data['debug_string'] = print_r($e,true);
						
						$this -> error_404($data);
					}
				}
				else{
					$data = array();
					$data['error_string'] = "Errore impossibile salvare, documento inesistente";
					
					$this -> error_404($data);
				}
				
			}
			else{
				$data = array();
				$data['error_string'] = "Errore impossibile salvare, nessuna dato in edit";
					
				$this -> error_404($data);
			}
				
		
		}
	
		public function view(){
			
			// recupero i dati dal registro
			$registry = Registry::get_instance();
			$id = $registry -> request['args'][0];			

			if($id > 0){
				
				$sys_user = $this -> registry -> object['sys_user'];
				$sys_userrole = $this -> registry -> object['sys_userrole'];
			
				// mostro la view del documento
				try{
					$item = $sys_user -> get($id);
					$item_role = $sys_userrole -> get($item -> sys_userrole_fk);
					$view = new View("sys_user/view");
					$view -> title = "Dettaglio Utente";	   
					$view -> row = $item;
					$view -> item_role = $item_role;
					$view -> link_edit = SITE_URL.US."sys_user".US."edit".US;
					$view -> render();
					
				}
				
				// documento non trovato
				catch(Exception $e){
					
					$data = array();
					$data['error_string'] = "Utente non trovato";
					$data['debug_string'] = print_r($e,true);
					
					$this -> error_404($data);
					
				}
			}
			// id non è un'intero
			else{
				
				$data = array();
				$data['error_string'] = "L'identificativo passato non è intero"; 
				
				$this -> error_404($data);
			}
		
		}
	}
?>
