<?php
/**
 * SYS_USERLOG
 * VALIDATOR generated: 03/10/2014 14:13:32
 * GENERATOR version: 1.0
 */

	 class sys_userlogValidator extends Validator{

		 protected $_validator = array(
										'task' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'resource' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'timestamp' => array('type' => "DATETIME",'pattern' => "/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", 'createnew' => 0,'modify' => 0),
										'user_fk' => array('type' => "INT",'pattern' => "/^\d{1,11}$/", 'createnew' => 0,'modify' => 0),
										'source' => array('type' => "VARCHAR",'pattern' => "/^.{1,150}$/", 'createnew' => 0,'modify' => 0),
										'sessionid' => array('type' => "VARCHAR",'pattern' => "/^.{1,150}$/", 'createnew' => 0,'modify' => 0),
										'details' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0),
										'id' => array('type' => "INT",'pattern' => "/^\d{1,11}$/", 'createnew' => 0,'modify' => 0),
										'result' => array('type' => "VARCHAR",'pattern' => "/^.+$/", 'createnew' => 0,'modify' => 0)
								);
 
	}
?>