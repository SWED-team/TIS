
<?php

if (isset($_GET['type'])) {
  if(!isset($_SESSION))
    session_start();

  if(file_exists('../_controllers/user.php'))
      require_once('../_controllers/user.php');

      $loggedUser = new User();
      $loggedUser->fillUserDatabySession();

      if($loggedUser->getUserID()!=0){ //overusera 

        $_GET["popup"]          =  1;
        $_GET["type"]           =  $_GET['type'];
        $_GET["field_id"]       =  "newFilePath";
        $_GET["relative_url"]   =  1;
        $_GET["akey"]           =   "189dqwSdq1q32SdFeec6S4486aASdcxQ432s1S3121S1445DED8713ADWEX84321159ASsaasd";
        
        require_once("dialog.php");    

      }
  else {

  echo "<h1>Access denied !</h1>";

}


  # code...
}
