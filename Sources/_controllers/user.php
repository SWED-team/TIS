<?php
if(!isset($_SESSION))
    session_start();
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');

/**
 * User Kontroler
 *
 * Trieda na pracu s viewom a modelom modulu : User
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
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


	public function _init_check()
	{
		//ak je v adrese profile zobrazi sa profil pouzivatela
		if(isset($_GET["profile"]))
		{
			return $this->profile();
		}
		
		if(isset($_GET["pages"])){
			return $this->pages();
		}
		
		else if(isset($_GET["registration"])){
			if(!$this->isLoggedIn()){
				return $this->printUserSectionReg();
			}
			return false;
		}
		else if(isset($_GET["pages_administration"])){
			return $this->pagesAdministration();
		}
		else if(isset($_GET["users_administration"])){
			return $this->usersAdministration();
		}
		else if(isset($_GET["q"])){
			$this->search($_GET["q"]);
		}
		else if(isset($_GET["category_administration"])){
			return $this->categoryAdministration();
		}

		//return $show_page;*/
	}

	public function profile(){
		if(isset($_GET["user"])){
			if($this->isLoggedIn() && $_GET["user"]==$this->getUserID()){
				if($this->isAdmin()){
					User_v::adminAdministrationTabs("profile",$this->getUserID());
				}
				else{
					User_v::userAdministrationTabs("profile",$this->getUserID());
				}
				User_v::profile($this->userData);
				return true;
			}
			$u=new User();
			if($u->fillUserDataById($_GET["user"])!=0){
				User_v::userAdministrationTabs("profile",$_GET["user"]);
				User_v::profile($u->userData);
				return true;
			}
			return false;
		}
		return false;
	}

	public function pages(){
		if(isset($_GET["user"])){
			if($this->isLoggedIn() && $_GET["user"]==$this->getUserID()){
				if($this->isAdmin()){
					User_v::adminAdministrationTabs("pages",$this->getUserID());
					$page = new Page();
					$page->pageListAdminWhere('created_by', $this->getUserID(), "title");
				}
				else{
					User_v::userAdministrationTabs("pages",$this->getUserID());
					$page = new Page();
					$page->pageListUserWhere('created_by', $this->getUserID(), "title");
				}
				return true;
			}
			$u=new User();
			if($u->fillUserDataById($_GET["user"])!=0){
					User_v::userAdministrationTabs("pages",$_GET["user"]);
					$page = new Page();
					$page->previewAllWhere("created_by",$u->getUserID(),"edited",1,$this->isAdmin());
				return true;
			}
			return false;
		}
		return false;
	}
	public function pagesAdministration(){
		if($this->isLoggedIn() && $this->isAdmin()){
			User_v::adminAdministrationTabs("pages_administration",$this->getUserID());
			$page = new Page();
			$page->pageListAdminWhere(1, 1, "title");
			return true;
		}
		return false;
	}
	public function usersAdministration($order="id")
	{
		if($this->isLoggedIn() && $this->isAdmin()){
			User_v::adminAdministrationTabs("users_administration",$this->getUserID());
			$list = User_m::getAllUsers($order);
			return User_v::showListUsers($list);
			return true;
		}
		return false;
	}

	public function categoryAdministration(){
		if($this->isLoggedIn() && $this->isAdmin()){
			User_v::adminAdministrationTabs("category_administration",$this->getUserID());
			$c = new Category();
			$c->previewList();
		}
	}

	public function search($term)
	{
			$listP =User_m::getPagesSearch($term);
			$res='<div id="infoSectionUser2" style="width:80%;margin-left:10%;">
			<span>Pages</span>
			';
			foreach ($listP as $key => $value) {
				$p = new Page($value["id"]);
				$p->preview(false,1);}
			$res=$res.'
			</div>';
			return $res;
	}


	

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

	public function hasEditRights($page)
	{
		if($this->isLoggedIn()){
			if($page['created_by']==$this->userData["id"])return true;
			if(User_m::hasRights($page["id"],$this->userData["id"]))return true;
		}
		return false;
	}


	public function loginForm()
	{
		User_v::loginForm();
	}

	/**
	 * funckia kontroluje či prebehlo odhlásenie a následne
	 * zruší SESSION premennú obsahujúcu ID užívateľa
	 *
	 */
	/*public function checkIfLogoff(){



	if(isset($_POST["submitLogoff"])){

				unset($_SESSION["userId"]);
				header("Refresh:0; url=");

				}

	}
	/**
	 * funckia kontroluje či prebehlo prihlásenie a následne
	 * nastaví SESSION premennú obsahujúcu ID užívateľa
	 *
	 */
/*	public function checkIfLogin()
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
	 //	echo User_m::getUserDataByLogin($login,$password);
	 	$_SESSION["userId"]=$this->userData["id"];
	 //	echo $this->userData["id"];


	  //  return "Fsdfsdfsd"+$this->userData["email"];
	  return $this->userData["id"];
	 }

	 /**
	  * funckia naplní údaje o používateľévi z DB na základe ID
	  * @param  [type] $id [ID používateľa]
	  */
	 public function fillUserDataById($id)
	 {
	 		$this->userData=User_m::getUserDataById($id);
	 		return $this->getUserID();
	 }
	 public function fillUserDatabySession()
	 {
	 	if(isset($_SESSION["userId"])){
	 		$this->userData=User_m::getUserDataById($_SESSION["userId"]);
	 		return $this->getUserID();
	 	}
	 	else {
	 		return 0;
	 	}
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

	 	return User_v::showUserSection($this->userData,$_GET["profile"]);


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
			{$errors["lname"]="Last Name have to contains atleast 2 characters";}


			if(strlen($param["pass"])<5)
			{$errors["pass"]="Password have to contains atleast 5 characters";}


			if($param["pass"]!=$param["pass2"])
			{$errors["pass2"]="Passwords dont match";}

			return ($errors);



		}
		public static function checkValidEdit($param)
		{

			$errors = array();
			if(!(filter_var($param["login"], FILTER_VALIDATE_EMAIL)))
			{$errors["email"]="Email address is not valid";}




			if(strlen($param["firstName"])<2)
			{$errors["fname"]="First Name have to contains atleast 2 characters";}

			if(strlen($param["lastName"])<2)
			{$errors["lname"]="Last Name have to contains atleast 2 characters";}


			if(strlen($param["pass"])<5)
			{$errors["pass"]="Password have to contains atleast 5 characters";}


			if($param["pass"]!=$param["pass2"])
			{$errors["pass2"]="Passwords dont match";}



			return $errors;



		}


		public function listPagesUser($id,$order)
		{


			$list = User_m::getPagesFromDb($id,$order);

			return User_v::showListPages($list);

		}



		public function addPageForm($id)
		{
			echo User_v::showAddPage();
		}



}