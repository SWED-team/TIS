<?php

	class User_m{

public function __construct(){
	require('../models/Db.php');


}

			public static function getUserDataByLogin($mail,$pass)
			{

					 $result = Db::query("
				      SELECT *
				      FROM user u
				      WHERE u.email = ? and u.password = ?", 
				      array($mail,$pass))->fetch();
				    return $result;

			}
			public static function getUsers()
			{
				$result = Db::query("
				      SELECT *
				      FROM user",
				       
				      array())->fetch();
				    return $result;


			}
		

			public static function checkValidReg($param){
				$result = Db::query("
				      SELECT *
				      FROM user 
				      where email=".$param["email"] ."and 
				      password=".$param["password"]

				     );
				if($results->num_rows === 0){return true;}
				    return false;

			}

			public static function adduserToDb($param){
/*
				$result = Db::query("
				      INSER into
				      user values (".$param[email]).""
				     

				     );*/



			}



	}




?>