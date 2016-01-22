<?php
  session_start();

  mb_internal_encoding("UTF-8");

  require('_models/Db.php');
  require('_models/Module_m.php');
	require('_controllers/ModuleAttachement.php');
  /*var_dump( Module_m::getOrderValue(1,1));
  var_dump( Module_m::getOrderValue(1,5));
	var_dump( Module_m::getOrderValue(1,99999));
*/
	$ma = new ModuleAttachement();
	var_dump( $ma->getNewOrderValue(1,1,40));
	var_dump( $ma->getNewOrderValue(1,5,40));
	var_dump( $ma->getNewOrderValue(1,2,40));
	var_dump( $ma->getNewOrderValue(1,999,40));
?>