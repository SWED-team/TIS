<?php
session_start();
require_once('_controllers/Module.php');
if(isset($_GET['type'])){
  $m = null;
  if($_GET['type'] == "module_embeded"){
  	require_once('_controllers/ModuleEmbeded.php'); 
  	$m = new ModuleEmbeded();
  	echo "module embeded";
  }

  if($m!=null){
  	if($m->getFormData()){
  		if($m->insert()){
  			//echo ok
  		}
  		else{
  			//echo chyba insertu
  		}
  	}
  	else{
  		//echo chyba getnutia z postu
  	}
  }
  else{
  	//echo chyba zly modul
  }

}
?>
