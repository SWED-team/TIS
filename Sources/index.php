<?php
  session_start();

  mb_internal_encoding("UTF-8");

  require('_models/Db.php');
  require('_controllers/module.php');
  require('_controllers/page.php');
  include('_controllers/user.php');
  //$_SESSION["pages_list"]=array();
  
  $page = new Page();
  $_user=new User();
  $_user->fillUserDatabySession();

  $page->header("TIS", $_user);
  
  //overenie obsahu stranky .. ak neprejde funkciami (nieje zadany ziaden vyhovujuci parameter) vypise 404
  if( !($page->pageContent($_user) || $_user->_init_check()) ){
    include '404.html';
  }





  $page->footer();
  $_user->loginForm();
?>

<script type="text/javascript" src="js/scripts.js"></script>
