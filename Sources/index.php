<?php
  session_start();

  mb_internal_encoding("UTF-8");

  require('_models/Db.php');
  require('_controllers/Module.php');
  require('_controllers/Page.php');
  include('_controllers/User.php');
  //$_SESSION["pages_list"]=array();
  
  $page = new Page();
  $_user=new User();
  $_user->fillUserDatabySession();

  $page->header("TIS", $_user);
  $page->pageContent($_user);

  //$page->pageListWhere("column", "value", "orderBy");
  //$page->pageListAdminWhere(1,1,"title");
  //$page->pageListUserWhere(1,1,"title");


  $_user->_init_check();




  $page->footer();
  $_user->loginForm();
?>

<script type="text/javascript" src="js/scripts.js"></script>
