<?php

class Page_v{
  public static function pageHead($title){
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

        <script src="./js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="./js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/fileinput.js" type="text/javascript"></script>
        <script src="./js/fileinput_locale_cz.js" type="text/javascript"></script>
        <script src="./js/fileinput_locale_sk.js" type="text/javascript"></script>
      </head>
      <body data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php
  }




  public static function pageHeader(){
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



    <?php
  }



    public static function footer(){
      return '
        </section>
        </div>
        <div class="push"></div>
        <footer class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center">
              <p>Copyright (c) 2015 SWED Team</p>
            </div>
          </div>
        </footer>';
  }



  /* 
  Funkcia vypíše view pre tlačídlo na pridávanie modulov
  */
  public static function addModuleButton(){
    return '
    <div class="module-container col-sm-3 ">
      <div class="module module-add text-center" data-toggle="modal" data-target="#module-editor" >
        +
      </div>
    </div>
  </div>';
  }






  /*
  Funkcia zobrazí view pre sekciu na pridávanie modulov
  */
  /*public static function mdulesEditSection($content){
    return '
    <section class="modal fade" id="module-editor" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button " class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Insert new module</h4>
          </div>
          <div class="modal-body row">
          '.$content.'
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
  </section>';

  }*/
  public static function moduleEditor($modules)
  {
      $buttons = "";
      $editors = "";
      foreach ($modules as $type => $m) {
        $buttons = $buttons .'
          <div class="row">
            <button type="button" class="btn btn-info" onclick="showModuleForm($(\'#'.$type.'_form\'))">
              '.$m->getModuleTypeName().'
            </button>
          </div>';
        $editors = $editors . '
          <form id="'.$type.'_form"  class="form-horizontal hiddenSection" role="form" enctype="multipart/form-data">
            <input type="text" class="hiddenSection" name="type" value="'.$type.'">
            <!---- Image Title ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="title">Title:</label>
              <div class="col-sm-10"> 
                <input type="text" class="form-control" name="title" >
              </div>
            </div>

            <!---- Image size ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="cols">Width:</label>
              <div class="col-sm-3">          
                <select class="form-control" id="edit-module-width" name="cols">
                  <option value="1">1 column</option>
                  <option value="2">2 columns</option>
                  <option value="3">3 columns</option>
                  <option value="4">4 columns</option>
                </select>
              </div>
              <label class="control-label col-sm-2" for="rows">Height:</label>
              <div class="col-sm-3">          
                <select class="form-control col-sm-2" id="edit-module-height" name="rows">
                  <option value="1">1 row</option>
                  <option value="2">2 rows</option>
                  <option value="3">3 rows</option>
                  <option value="4">4 rows</option>
                  <option value="0">auto</option>
                </select>
              </div>
            </div> 

            '.
              $m->editor()
            .'
            <button type="submit" class="btn btn-success col-sm-12">Submit</button>
          </form>
        ';
      }

    return '
    <section class="modal fade" id="module-editor" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button " class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Insert new module</h4>
          </div>
          <div class="modal-body row">
            <div class="col-md-3">
            '.
              $buttons
            .'
            </div>
            <div id="module-forms" class="col-md-9">
            '.
              $editors
            .'
            </div> 
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </section>
    <script>
    
    function checkInsertFileMethod(methodParent){
      var methodVal = methodParent.find("input[type=\"radio\"]:checked").val();
        if(methodVal == 0){
          methodParent.parent().find("#file-uploader").removeClass("hiddenSection");
          methodParent.parent().find("#file-selector").addClass("hiddenSection");
        }
        else if(methodVal == 1){
          methodParent.parent().find("#file-selector").removeClass("hiddenSection");
          methodParent.parent().find("#file-uploader").addClass("hiddenSection");
        }
        else{
          methodParent.parent().find("#file-selector").addClass("hiddenSection");
          methodParent.parent().find("#file-uploader").addClass("hiddenSection");
        }
    }
    $(document).on("ready", function(){
      $(".file-insert-method").each(function(){
        $(this).on("change", function(){
          checkInsertFileMethod($(this));
        });
      });
    });
    function hideModuleForms(moduleFormsParent){
      moduleFormsParent.find("form").each(function(){
        $(this).addClass("hiddenSection");
      });
    }
    function showModuleForm(moduleForm){
      hideModuleForms(moduleForm.parent());
      moduleForm.removeClass("hiddenSection");

      checkInsertFileMethod(moduleForm.find(".file-insert-method"));

    }
    </script>






    ';
  }











}


?>