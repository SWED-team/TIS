<?php

    	 /**
    	  * Classa používateľa
    	  */
 class User{

	 public $userData = array();
	
	/**
	 * Konštruktor triedy USER , konštruktor iba načíta súbory podtried
	 */
	public function __construct()
	{

		require_once('/_models/User_m.php');
    	require_once('/_views/User_v.php');

    	 

    	 
	}
	/**
	 * Funkcia zabezpečuje zobrazenie POP-UP okna pre prihlásenie
	 */

	public function printLogPop()
	{

		echo User_v::showLogPop();
	}

	/**
	 * funckia kontroluje či prebehlo odhlásenie a následne 
	 * zruší SESSION premennú obsahujúcu ID užívateľa
	 * 
	 */
	public function checkIfLogoff(){
		
		

	if(isset($_POST["submitLogoff"])){
				
				unset($_SESSION["userId"]);

				}
		
	}
	/**
	 * funckia kontroluje či prebehlo prihlásenie a následne 
	 * nastaví SESSION premennú obsahujúcu ID užívateľa
	 * 
	 */ 
	public function checkIfLogin()
	{
		if(isset($_POST["submitLog"])){
				if(isset($_POST["login"]) && isset($_POST["pass"]))
				{
				
					$this->login($_POST["login"],$_POST["pass"]);

				}
		}
	}

///funckia ,zisti ,ci prebehla editacia profilu a nasledne vola funckia ktore zmenu vykona/
///


	
	/**
	 * funkcia zabezpečí login na základe emailu a hesla a naplnenie údajov z databázy
	 * @param  [type] $login    [email používateľa]
	 * @param  [type] $password [heslo]
	 * @return [type]           [údaje používateľa získane z DB]
	 */
	 public function login($login,$password)
	 {

	 	
	 	$this->userData=User_m::getUserDataByLogin($login,$password);
	 	$_SESSION["userId"]=$this->userData["id"];

	 	
	    
	    return $this->userData;
	 }

	 /**
	  * funckia naplní údaje o používateľévi z DB na základe ID
	  * @param  [type] $id [ID používateľa]
	  */
	 public function fillUserDataById($id)
	 {
	 	$this->userData=User_m::getUserDataById($id);

	 }
	 public function fillUserDatabySession()
	 {
	 	if(isset($_SESSION["userId"])){
	 	$this->userData=User_m::getUserDataById($_SESSION["userId"]);
	 	}
	 	else {echo "neni prihlaseny user";}
	 }

	

	 /**
	  * funckia zobrazí formulár na registráciu
	  */

	 public function printUserSectionReg()
	 {
	 	return User_v::showRegForm();
	 }

	 /**
	  * funkcia zobrazí sekciu na správu používateľského konta používateľa
	  * @return [type] [description]
	  */
	 public function printUserSection()
	 {
	 	
	 	return User_v::showUserSection($this->userData);

	 }

	 
	

		 /**
		  * funcia na spracovanie registrácie po kontrole validity
		  * 
		  */
	  	public function processRegistration($parameters){

	 	User_m::checkValidReg($parameters);
	 	User_m::addUserToDb($parameters);


		 }
/*
		 public function printUpdateForm(){

		 		User_v::showUpdateForm($userData);
		 }*/

 

		 /**
		  * funkcia na zmazenie používateľa
		  * @param  [type] $id [ID používateľa]
		  * 
		  */
		 public static function delete($id){

		 	User_m::deleteUserFromDb($id);
		 	__destroy();
		 }
	
		 /**
		  * funckia zobrazí zoznam všetkých používateľov
		  * 
		  */
		public function showUsersList()
		{
			User::getListOfUsers();
		}
		/**
		 * funkcia zobrazí zoznam žiadostí o schválenie
		 * 
		 */
		public function showApproveList()
		{
			User_m::getListOfApprovals();
		}






}
