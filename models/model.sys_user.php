<?php

	/**
	 * SYS_USER
	 * MODEL generated: 25/07/2014 09:41:28
	 * GENERATOR version: 1.0
	 */

	 class sys_user extends AppModel{

		 protected $_db;
		 public $_tableName = "sys_user";
		 protected $_validator = array(
										'username' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 1,'modify' => 0),
										'lastvisit' => array('type' => "DATETIME",'pattern' => "/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", 'createnew' => 0,'modify' => 0),
										'blocked' => array('type' => "INT",'pattern' => "/^\d{1}$/", 'createnew' => 0,'modify' => 0),
										'nome' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'activationcode' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'id' => array('type' => "INT",'pattern' => "/^\d{1,11}$/", 'createnew' => 0,'modify' => 0),
										'registerdate' => array('type' => "DATETIME",'pattern' => "/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", 'createnew' => 0,'modify' => 0),
										'sendemail' => array('type' => "INT",'pattern' => "/^\d{1}$/", 'createnew' => 0,'modify' => 0),
										'sys_userrole_fk' => array('type' => "INT",'pattern' => "/^\d+$/", 'createnew' => 1,'modify' => 0),
										'password' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 1,'modify' => 0),
										'email' => array('type' => "VARCHAR",'pattern' => "/^.{1,150}$/", 'createnew' => 0,'modify' => 0)
								);


		 public function __construct($db){ $this -> _db = $db; }
		 
		 /*
		  * controlla lo stato della sessione
		  * @param null
		  * @return true or false
		  */
		 public function checkLogin(){
			
			$s_id = false;
			$s_userrole_fk = false;
			
			isset($_SESSION['id']) ? $s_id = true : $s_id= false;
			isset($_SESSION['userrole_fk']) ? $s_userrole_fk = true : $s_userrole_fk = false;
			
			return $s_id && $s_userrole_fk;
		}
		
		public function listing($wherecondition = "id > 0"){
		
			$items = parent::listing($wherecondition);
			$items_r = array();
			
			for($i=0;$i<count($items);$i++)
				$items_r[] = $this -> get($items[$i] -> id);
			
			return $items_r;
		}
		
		public function get($id){
			
			$item = parent::get($id);
			$sys_userrole = new Sys_userrole($this -> _db);

			$item_role = $sys_userrole -> get($item-> sys_userrole_fk);

			$item -> role_label = $item_role -> name;
			$item -> role_desc = $item_role -> description;
			
			intval($item -> blocked) == 0 ? $item -> blocked_label = "No" : $item -> blocked_label = "Si";
			intval($item -> sendemail) == 0 ? $item -> sendemail_label = "No" : $item -> sendemail_label = "Si";
			
			$date = DateTime::createFromFormat("Y-m-d H:i:s", $item -> registerdate);
			$item -> registerdate = $date -> format("d/m/Y");
			
			return $item;
		
		}
		 

		 
	}
?>
