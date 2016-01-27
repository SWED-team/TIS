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

  $page->header("TIS");


  $page_admin = true;
  $page->pageContent($page_admin);
  //$page->pageListWhere("column", "value", "orderBy");
  //$page->pageListAdminWhere(1,1,"title");
  //$page->pageListUserWhere(1,1,"title");


  if($_user->_init_check())
   {

    error_reporting(1);

  //$page->pageContent(true); // argument nastavuje ci sa stranka zobrazi v rezime administracie alebo zobrazenia
  }



  $page->footer();
  $_user->printLogPop();
?>

<script type="text/javascript" src="js/scripts.js"></script>
