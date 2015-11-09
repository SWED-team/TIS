<?php

    	 
 class User{

	 public $userData = array();
	
	public function __construct()
	{

		require_once('/_models/User_m.php');
    	require_once('/_views/User_v.php');

    	 

    	 
	}
	
	 public function login($login,$password)
	 {

	 	
	 	$userData=User_m::getUserDataByLogin($login,$password);
	 	
	 /*	if(User_m!=null){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
	      $this->userData = User_m::getModuleContainer($id); }*/
	      
	    
	    return $userData;
	 }

		public function printRegForm($id){

		 	User_v::showRegForm($userData);

		 }


	  	public function processRegistration($parameters){

	 	User_m::checkValidReg($parameters);
	 	User_m::addUserToDb($parameters);


		 }

		 public function printUpdateForm(){

		 		User_v::showUpdateForm($userData);
		 }


		 public function processUpdate($parameters)
		 {

		 	User_m::updateUserToDb($parameters);
		 }


		 public static function delete($id){

		 	User_m::deleteUserFromDb($id);
		 	__destroy();
		 }
	

		public function showUsersList()
		{
			User::getListOfUsers();
		}

		public function showApproveList()
		{
			User_m::getListOfApprovals();
		}






}