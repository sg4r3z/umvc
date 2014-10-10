<?php
/**
 * SYS_USERROLE
 * VALIDATOR generated: 03/10/2014 14:13:32
 * GENERATOR version: 1.0
 */

	 class sys_userroleValidator extends Validator{

		 protected $_validator = array(
										'id' => array('type' => "INT",'pattern' => "/^\d{1,11}$/", 'createnew' => 0,'modify' => 0),
										'descrizione' => array('type' => "TEXT",'pattern' => "/./", 'createnew' => 0,'modify' => 0),
										'nome' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0)
								);
 
	}
?>