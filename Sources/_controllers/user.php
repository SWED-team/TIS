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
    if(file_exists('_models/User_m.php')&&file_exists('_views/User_v.php')) {
      require_once('_models/User_m.php');
      require_once('_views/User_v.php');
    }
    if(file_exists('../_models/User_m.php')&&file_exists('../_views/User_v.php')) {
      require_once('../_models/User_m.php');
      require_once('../_views/User_v.php');
    } 
	}
	/**
	 * Funkcia zabezpečuje zobrazenie POP-UP okna pre prihlásenie
	 */

	public function isLoggedIn()
	{
		if(isset($this->userData["id"]) && $this->userData["id"]>0)
			return true;
		return false;
	}

	public function getUserID(){
		if(isset($this->userData["id"]) && $this->userData["id"]>0) 
			return  $this->userData["id"];
		return 0;
	}

	public function isAdmin()
	{
		if(isset($this->userData["admin"]) && $this->userData["admin"]==1)
			return true;
		return false;
	}

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



		public static function checkValidReg($param)
		{
			
			$errors = array();
			if(!(filter_var($param["login"], FILTER_VALIDATE_EMAIL)))
			{$errors["email"]="Email address is not valid";}

			if(sizeof(User_m::isInDb("email",$param["login"]))>1)
			{$errors["email2"]="Entered email is already in use";}
			

			if(strlen($param["firstName"])<2)
			{$errors["fname"]="First Name have to contains atleast 2 characters";}

			if(strlen($param["lastName"])<2)
			{$errors["lname"]="Last dsName have to contains atleast 2 characters";}


			if(strlen($param["pass"])<5)
			{$errors["lname"]="Password have to contains atleast 5 characters";}

			
			
			return $errors;
			


		}
		public static function checkValidEdit($param)
		{
			
			$errors = array();
			if(!(filter_var($param["login"], FILTER_VALIDATE_EMAIL)))
			{$errors["email"]="Email address is not valid";}

			
			

			if(strlen($param["firstName"])<2)
			{$errors["fname"]="First Name have to contains atleast 2 characters";
	$errors["fname"]="First Name have to contains atleast 2 characters";
$errors["fname"]="First Name have to contains atleast 2 characters";}

			if(strlen($param["lastName"])<2)
			{$errors["lname"]="Last Name have to contains atleast 2 characters";}


			if(strlen($param["pass"])<5)
			{$errors["lname"]="Password have to contains atleast 5 characters";}

			
			
			return $errors;
			


		}


		public function listPages()
		{

			$list = User_m::gePagesFromDb($tihs->userData["id"]);
			foreach ($list as $key => $value) {
				
					echo "toto je valuie".$value;
					}
					
		}




}