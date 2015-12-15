<?php

	class User_m extends User{

public function __construct(){
	require('../models/Db.php');


}
			/**
			 * funkcia vykoná editáciu používateľa v DB
			 * @param  [type] $param [zmenené údaje]
			 * 
			 */
			public static function editUserToDb($param)
			{
				$result = Db::query("
				     UPDATE user set email= ? ,first_name=? ,
				     last_name=?,admin=?, reg_date=?,bio=?,password=? 
				     where id=? ",
				      array($param['login'],$param['firstName'],
				      	$param['lastName'],
				      	0,'2014-01-01',
				      	
				      	$param['bio'],
				      $param['pass'],
				      $param['id']))->fetch();
				    return $result;

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
			public static function getUserDataById($id)
			{

					 $result = Db::query("
				      SELECT *
				      FROM user u
				      WHERE u.id=?", 
				      array($id))->fetch();
				    return $result;

			}
			/**
			 * funckia vráti všetkých používateľov v DB
			 * @return [list] [zoznam používateľov]
			 */
			public static function getUsers()
			{
				$result = Db::query("
				      SELECT *
				      FROM user",
				       
				      array())->fetch();
				    return $result;


			}
		
			/**
			 * funckia kontroluje či sa v databáze nachádza používateľ so
			 * zadaným emailom a heslom
			 * @param  [type] $param [email a heslo]
			 * @return [boolean]        [vrati true/false,podľa toho či nájde taký záznam]
			 */
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

			/**
			 * funckia pridá nový záznam používateľa do DB
			 * @param  [type] $param [údaje]
			 * 
			 */
			public static function adduserToDb($param){

				$result = Db::query("
				      INSERT into
				      user (email,first_name,last_name,admin,
				      	reg_date,bio,password)
				      values (?,?,?,?,?,?,?)",
				      array($param['login'],$param['firstName'],
				      	$param['lastName'],
				      	0,'2014-01-01',
				      	$param['pass'],
				      	$param['bio']));
			

			}

			public static function isInDb($what,$value)
			{

				 $result = Db::query("
				      SELECT *
				      FROM user u
				      WHERE u.email=?", 
				      array($value))->fetch();
				    return $result;




			}
	}




?>