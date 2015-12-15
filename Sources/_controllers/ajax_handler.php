<?php

    session_start();

include ("User.php");
include('../_models/User_m.php');
//$user= new User();
  include('../_models/Db.php');
Db::connect("127.0.0.1:3307", "root", "usbw", "tis");
  
  /*echo "kravaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
  echo $_POST['json']['function'];
  echo sizeof($_POST['json']['arg']);*/

  //$ob=  unserialize($_SESSION["user"]);
  
  
    $aResult = array();

    if( !isset($_POST['json']['function']) ) { $aResult['error'] = 'No function name!';echo "aj toto"; }

    if( !isset($_POST['json']['arg']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['json']['function']) {
            case 'logUser':
              
           $res= $ob->login($_POST['json']['arg']['login'],$_POST['json']['arg']['pass']);
           $_SESSION["data"]=$res;
           $_SESSION["user"]=serialize($ob);
            //echo $ob->userData["first_name"]; 

           case 'RegUser':

            if(sizeof(User::checkValidReg($_POST['json']['arg']))<1)
           {
            User_m::AddUserToDb($_POST['json']['arg']);
         //   echo "ok";
            }

            else {
              echo json_encode(User::checkValidReg($_POST['json']['arg']));
            }

           case 'EditUser':

           if(sizeof(User::checkValidEdit($_POST['json']['arg']))<1)
           {
            User_m::EditUserToDb($_POST['json']['arg']);
          //  echo "ok";
            }

            else {
              echo json_encode(User::checkValidEdit($_POST['json']['arg']));
            }

               break;

            default:
              // $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }

    }
  // echo "Vysledok:".$res;
   // echo var_dump($aResult);





?>