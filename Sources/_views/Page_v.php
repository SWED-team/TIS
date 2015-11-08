<?php

class Page_v{
  public static function printPageHead($title){
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title><?php echo $title ?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/fileinput.css" media="all" type="text/css" />
      </head>
      <body data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php
  }
  public static function printPageHeader(){
    ?>
    <header>
      <div id="header-image">


        
      </div>
    </header>
    <nav class="navbar navbar-default" data-spy="affix" data-offset-top="197">
      <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
          </button>
        </div>
        <div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li><a href="">home</a></li>
              <li><a href="">button</a></li>
              <li><a href="">button</a></li>
              <li><a href="">about us</a></li>
              <li><a href="">contact</a></li>

            </ul>          
            <div class="col-md-3 pull-right">
              <form class="navbar-form" role="search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </nav>
    <div class="wrapper">


    <section class="container-fluid">
      <div class="row">
    <?php
  }

}


?>