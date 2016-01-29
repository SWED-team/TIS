<?php

session_start();
include_once ("User.php");
include_once('../_models/User_m.php');
include_once('../_models/Db.php');

    $aResult = array();
    error_reporting(0);
    if( !isset($_POST['json']['function']) ) { $aResult['error'] = 'No function name!';echo "aj toto"; }

    if( !isset($_POST['json']['arg']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

		
    switch($_POST['json']['function']) {
      case 'Login':

				 $user= new User();
				 echo ($user->login($_POST['json']['arg']['loginEmail'],$_POST['json']['arg']['loginPass']));
				 break;

      case 'RegUser':

				if(sizeof(User::checkValidReg($_POST['json']['arg']))<1)
				{
					if(User_m::AddUserToDb($_POST['json']['arg'])>0)
						echo "ok";
					else "error";
				}
				else
				{echo json_encode(User::checkValidReg($_POST['json']['arg']));}
				break;

      case 'EditUser':

				if(sizeof(User::checkValidEdit($_POST['json']['arg']))<1)
				{
					$user=new User();
			   	$user->fillUserDatabySession();

					$res = User_m::EditUserToDb($_POST['json']['arg'], $user->getUserID()); 
					if($res)
						echo "ok";
					else
						echo "error";
				}
				else
				{
					echo json_encode(User::checkValidEdit($_POST['json']['arg'])); }
				break;

		   case 'SwithUserMenu1':

			   $user=new User();
			   $user->fillUserDatabySession();
			   User_v::showEditForm($user->userData);
			   break;

		   case 'SwithUserMenu2':

			   $user=new User();
			   $user->fillUserDatabySession();

			   echo $user->listPagesUser($user->userData["id"],($_POST['json']['arg']['par2']));
			 //  echo User_v::showListPages($user->userData);
			   break;
		   case 'listAdminUserPages':

			   $user=new User();
			   $user->fillUserDatabySession();

			   echo $user->listPagesUser($_POST['json']['arg']['par1'],($_POST['json']['arg']['par2']));
			   //  echo User_v::showListPages($user->userData);
			   break;

		  case 'SwithUserMenu3':

			   $user=new User();
			   $user->fillUserDatabySession();
			   echo $user->listUsers($_POST['json']['arg']['par2']);
			   break;
		  case 'SwithUserMenu4':

			  $user=new User();
			  $user->fillUserDatabySession();
			  echo $user->addPageForm($user->userData["id"]);
			  break;

		  case 'AddPage':

			  $user=new User();
			  $user->fillUserDatabySession();
			 // echo $user->addPageForm($user->userData["id"]);
			  echo "idemddddd".$user->userData["id"].$_POST['json']['arg']['par2'];
			  User_m::addPageToDb($user->userData["id"],$_POST['json']['arg']['par2']);
			  echo "idem";
			  break;

		  case 'Deactivate':

			  $user=new User();
			  $user->fillUserDatabySession();

			  User_m::changeDeactiveToDb($_POST['json']['arg']['par1'],$_POST['json']['arg']['par2']);
			  break;
		  case 'Admin':

			  $user=new User();
			  $user->fillUserDatabySession();
			  User_m::changeAdminToDb($_POST['json']['arg']['par1'],$_POST['json']['arg']['par2']);

			  break;
		  case 'search':

		  	  echo $_user->search($_POST['json']['arg']['par2']);
		  	  break;
		  case 'Logoff':
		  	  unset($_SESSION["userId"]);
		  	  break;
		  case 'changeTitle':

			  $user=new User();
			  $user->fillUserDatabySession();
			  echo "ide";
			  User_m::changeTitleToDb($_POST['json']['arg']['par1'],$_POST['json']['arg']['par2']);
			  echo "presiel";
			  break;

		   default:

               break;
        }

    }




?>