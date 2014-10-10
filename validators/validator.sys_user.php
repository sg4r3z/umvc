<?php
/**
 * SYS_USER
 * VALIDATOR generated: 03/10/2014 14:13:32
 * GENERATOR version: 1.0
 */

	 class sys_userValidator extends Validator{

		 protected $_validator = array(
										'username' => array('type' => "VARCHAR",'pattern' => "/^.{1,150}$/", 'createnew' => 0,'modify' => 0),
										'lastvisit' => array('type' => "DATETIME",'pattern' => "/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", 'createnew' => 0,'modify' => 0),
										'bloccato_ck' => array('type' => "INT",'pattern' => "/^\d{1}$/", 'createnew' => 0,'modify' => 0),
										'nome' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'activationcode' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'numero_collegamenti' => array('type' => "DECIMAL",'pattern' => "/^\d{10}\.\d{10}$/", 'createnew' => 1,'modify' => 0),
										'id' => array('type' => "INT",'pattern' => "/^\d{1,11}$/", 'createnew' => 0,'modify' => 0),
										'registerdate' => array('type' => "DATETIME",'pattern' => "/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", 'createnew' => 0,'modify' => 0),
										'sendemail_ck' => array('type' => "INT",'pattern' => "/^\d{1}$/", 'createnew' => 0,'modify' => 0),
										'sys_userrole_fk' => array('type' => "INT",'pattern' => "/^\d+$/", 'createnew' => 0,'modify' => 0),
										'password' => array('type' => "VARCHAR",'pattern' => "/^.{1,150}$/", 'createnew' => 0,'modify' => 0),
										'email' => array('type' => "VARCHAR",'pattern' => "/^.{1,150}$/", 'createnew' => 0,'modify' => 0)
								);
 
	}
?>