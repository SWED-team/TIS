<?php
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');
/**
 * User_m je model triedy User
 * ktorá obsahuje funkcie na získavanie, ukladanie a mazanie dát triedy User
 *
 * 
 * @version 1.0
 * @author KRASNAN
 * @package Models
 */
class User_m{

	public function __construct(){
		
	}
		/**
			 * funkcia vykoná editáciu používateľa v DB
			 * @param  [type] $param [zmenené údaje]
			 *
			 */
			public static function editUserToDb($param, $id)
			{
				$result = Db::query(
					"UPDATE `user` 
					SET `first_name`=?,
				     `last_name`=?, 
				     `bio`=?
				  WHERE `id`=?",array(
				      						$param['firstName'],
				      						$param['lastName'],
				      						$param['bio'],
				      						$id
				      					)
				  );
				return $result;

			}

			public static function editUserPassword($password, $id){
				$result = Db::query(
					"UPDATE `user` 
					SET `password`=?
					WHERE `id`=?",array(
				      						hash( 'sha256',$password),
				      						$id
				      					)
				  );
				return $result;
			}

			public static function getUserDataByLogin($mail,$pass)
			{

					 $result = Db::query("
				      SELECT *
				      FROM user u
				      WHERE u.email = ? and u.password = ? and u.deactivated = 0",
				      array($mail, hash( 'sha256', $pass)))->fetch();
				    return $result;

			}
			public static function hasRights($pageID,$userID)
			{

					 $result = Db::query("
				      SELECT *
				      FROM edit_rights u
				      WHERE u.page_id= ? and u.user_id= ?",
				      array($pageID,$userID))->fetch();
					 return !$result==null;
				    

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
				      password=".hash( 'sha256',$param["password"])

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


				$values = array(
						      	$param['login'],
						      	$param['firstName'],
						      	$param['lastName'],
						      	$param['bio'],
						      	hash( 'sha256',$param['pass'])
				      		);
				$result = Db::insert(
					"INSERT INTO `user` (`email`, `first_name`, `last_name`, `admin`,`bio`, `password`)
				   VALUES (?,?,?,0,?,?)",$values);
				return $result;
			}

			public static function getAllUsers($order)
			{

				$result = Db::query("
				      SELECT *
				      FROM user order by ".$order."
				      "
				      )->fetchAll();
				    return $result;
			}

			public static function getPagesFromDb($id,$order)
			{

				$result = Db::query("
				      SELECT *
				      FROM page where created_by=".$id."
						order by ".$order."
				      "
				      )->fetchAll();
				return $result;
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




			public static function getPagesSearch($term)
			{
				$result = Db::query("
				      SELECT *
				      FROM page where title LIKE '%".$term."%'

				      "
				      )->fetchAll();
				return $result;
			}
			public static function addPageToDb($id,$title)
			{

				$result = Db::query("
				INSERT into
				      page ( created_by,title)
				      values (?,?)",
				      array($id,$title));
				return $result;
			}

			public static function changeDeactiveToDb($value,$id)
			{
				$result = Db::query("
				UPDATE
				      user set deactivated= ? where id =?",
				      array($value,$id));
				return $result;

			}
			public static function changeAdminToDb($value,$id)
			{
				$result = Db::query("
				UPDATE
				      user set admin= ? where id =?",
				      array($value,$id));
				return $result;

			}
			public static function changeTitleToDb($value,$id)
			{
				$result = Db::query("
				UPDATE
				      page set title= ? where id =?",
				      array($value,$id));
				return $result;

			}
	}




?>