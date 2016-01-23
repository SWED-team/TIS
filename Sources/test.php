<?php
  session_start();

  mb_internal_encoding("UTF-8");
  require('_controllers/File.php');
  require('_models/Db.php');
  require('_models/Module_m.php');
	require('_controllers/ModuleAttachement.php');
  /*var_dump( Module_m::getOrderValue(1,1));
  var_dump( Module_m::getOrderValue(1,5));
	var_dump( Module_m::getOrderValue(1,99999));
*/
	/*$ma = new ModuleAttachement();
	var_dump( $ma->getNewOrderValue(1,1,40));
	var_dump( $ma->getNewOrderValue(1,5,40));
	var_dump( $ma->getNewOrderValue(1,2,40));
	var_dump( $ma->getNewOrderValue(1,999,40));
*/

	function test($expression){
		print_r($expression);
		echo "<br>";
	}
	function isTrue($expression){
		if($expression == true)
			echo " ok; \t";
		else 
			echo " error; \t";
		echo " expected: true; given: ";
		print_r($expression);
		echo "<br>";
	}
	function isFalse($expression){
		if($expression == false)
			echo " ok; \t";
		else 
			echo " error; \t";
		echo " expected: false; given: ";
		print_r($expression);
		echo "<br>";
	}
	function testExp($expression, $expected){
		if($expression == $expected)
			echo " ok; \t";
		else 
			echo " error; \t";
		echo " expected: ". $expected ."; given: ";
		print_r($expression);
		echo "<br>";
	}

  testExp( File::getPathType("_models/db.php"), "file"   );
  testExp( File::getPathType("_models")       , "dir"    );
  testExp( File::getPathType("asdfasdf")      ,"unknown" );

  test(File::getFilesFromDir("_models/", array("php")));
  test(File::getFilesFromDir("_models", array("php")));
  test(File::getFilesFromDir("_modeasdfasdls", array("php")));

?>