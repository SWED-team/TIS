<?php
class Page_v{
    public static function pageHead( $title ){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="./js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/format.css">
    <link rel="stylesheet" href="css/user.css">
    <link href="css/bootstrap-combobox.css" rel="stylesheet">


    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/Module.js"></script>
    <script type="text/javascript" src="js/Page.js"></script>
    <script type="text/javascript" src="js/bootstrap-combobox.js"></script>


</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <?php
    }
    public static function pageHeader( $category, $home, $navbarPages){
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
                        <?php 
                        if(isset($home) && sizeof($home) > 0)
                            echo '<li><a href="./">'.$home["title"].'</a></li>';
                        ?>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                          <?php
                            foreach ($category as $key => $c) {
                                echo '<li><a href="?category='.$c["id"].'">'.$c["title"].'</a></li>';
                            }
                          ?>
                          </ul>
                        </li>
                        <?php
                            foreach ($navbarPages as $key => $n) {
                                echo '<li><a href="?page='.$n["id"].'">'.$n["title"].'</a></li>';
                            }
                        ?>
                        <li class="widthLi first">
                            <div class="input-group" id="searchBar">

                                <div id="searchBarHide">
                                    <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>

                                </div>
                                <div id="userBarHide">
                                    <form method="POST">
                                        <?php
 if(isset($_SESSION["userId"])){
                              echo '<input type="submit" value="Logoff" name="submitLogoff"class="btn btn-danger" data-dismiss="modal"data-toggle="modal" >';
                              echo '<input type="submit" value="Profile" name="submitProf" class="btn btn-info" data-dismiss="modal">';
                              echo '</form>';
                          }
                          else {
                              echo '<button type="button" class="btn btn-success" data-dismiss="modal"><div data-toggle="modal" data-target="#LoginPop"  >login</div></button>';
                              echo '<input type="submit" name="submitReg" value="Registration"class="btn btn-info" data-dismiss="modal"data-toggle="modal" ></button>';
                          }
                                        ?>
                                </div>


                            </div>
                        </li>


                        <li class="widthLi">

                            <div id="userBarIcon">
                                <span class="glyphicon glyphicon-user" data-dismiss="modal"></span>
                            </div>

                            <div id="searchBarIcon">
                                <span class="glyphicon glyphicon-search" data-dismiss="modal"></span>
                            </div>

                        </li>





                    </ul>

                </div>

            </div>
        </div>
    </nav>
    <div class="wrapper">
    <section class="container-fluid">
        <div class="row">



        <?php
    }
    public static function footer(){ ?>
            </div>
        </section>


        <section id="modal-box" class="modal fade" role="dialog">
          <div  class="modal-dialog modal-lg">
            <div  class="modal-content">
              <div id="modal-box-header" class="modal-header">
                <button type="button " class="close" data-dismiss="modal">&times;</button>
              </div>
              <div id="modal-box-content" class="modal-body row">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </section>
        </div>
        <div class="push"></div>
        <footer class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center">
              <p>Copyright (c) 2015 SWED Team</p>
            </div>
          </div>
        </footer>
        <?php
    }
    /*
    Funkcia vypíše view pre tlačídlo na pridávanie modulov
     */
    public static function addModuleButton(){?>
        <div class="module-container col-sm-12 ">
          <div class="module module-add text-center" data-toggle="modal" data-target="#module-editor" >
            +
          </div>
        </div>
    <?php
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
        foreach ($modules as $type => $m) {
            $editorUrl = "_controllers/".get_class($m).".php?show_editor=true".((isset($_GET["page"]) && $_GET["page"]>0)?"&page_id=".$_GET["page"]:"");
            $buttons = $buttons .'
          <div class="row">
            <button type="button" class="btn btn-info" onclick="showModuleInsertForm(\''.$editorUrl.'\')">
              '.$m->getModuleTypeName().'
            </button>
          </div>';
        }
        ?>
        <section class="modal fade" id="module-editor" role="dialog" tabindex="-1" aria-hidden="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Insert new module</h4>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-3">
                            <?php echo $buttons;?>
                        </div>
                        <div id="module-forms" class="col-md-9">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function showModuleInsertForm(url) {
                $.ajax({
                    url: url,
                    type: "post",
                    success: function (result) {
                        $("#module-forms").html(result);
                    }
                });

            }
        </script>
        <?php
    } 
    public static function pageInfo($subsection=array(), $page=null, $editable=false){?>
        <div class="page-info">
            <ol class="breadcrumb">
                <li><a href="./">Home</a></li>
                <?php
                foreach ($subsection as $title => $href) {
                   echo '<li><a href="'.$href.'">'. $title.'</a></li>';
                }
                if($editable && $page != null){ ?>
                    <span class="pull-right">
                        <a onclick="addPage()"><i class="fa fa-plus-square"></i></a>
                        <a onclick="updatePage( <?php echo $page["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                        <a onclick="deletePage( <?php echo $page["id"];?>)"><i class="fa fa-trash"></i></a>
                        
                    </span>
                <?php } ?>

            </ol>
            <?php 
            if($page!=null){ 
                ?>
                <div class="col-sm-12 relative">
                    <div class="page-info-image" style="background-image: url('<?php echo  $page["image"]; ?>')"></div>
                    <div class="page-info-container row">
                        <div class="page-descritpion col-sm-12 text-center"><h4><?php echo $page["description"]?></h4></div>
                        <div class="col-sm-6 text-muted">Last modification: <?php echo $page["edited"]?></div>
                        <div class="col-sm-6 pull-right text-muted text-right">Author: <?php echo $page["author"]?></div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
        <?php
    }
    public static function pageListEditable($pageData){?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-5">
                    Page Info
                </div>
                <div class="col-xs-2 text-center">
                    Home
                </div>
                <div class="col-xs-2 text-center">
                    Navbar
                </div>
                <div class="col-xs-3 pull-right">
                    Operations
                </div>                
            </div>
            <?php
            foreach ($pageData as $key => $page) {
                ?>
            <div class="row">
                <div class="col-xs-5">
                    <?php 
                    echo $page["id"]. " - " . $page["title"];
                    ?>
                </div>
                <div class="col-xs-2 text-center">
                    <?php 
                    if($page["is_home"]==0)
                        echo '<a class="btn col-xs-12 btn-success" title="Set page as HomePage" onclick="setHomePage('.$page["id"].')"><i class=" fa fa-check-square-o"></i></a>';
                    else 
                        echo '<a class="btn col-xs-12 btn-danger disabled" title="This page is currently HomePage"><i class="fa fa-check-square-o"></i></a>';
                    ?>
                </div>
                <div class="col-xs-2 text-center">
                    <?php 
                    if($page["in_navbar"]==0)
                        echo '<a class=" col-xs-12 btn btn-success" title="Add page to navigation" onclick="setNavbarPage('.$page["id"].')"><i class=" fa fa-check-square-o"></i></a>';
                    else 
                        echo '<a class=" col-xs-12 btn btn-danger" title="Remove page from navigation" onclick="unsetNavbarPage('.$page["id"].')"><i class="fa  fa-times"></i></a>';
                    ?>
                </div>
                <div class="col-xs-3 pull-right">
                    <a href="?page=<?php echo $page["id"];?>" class="col-xs-offset-1 col-xs-3  btn btn-success" title="Open this page." ><i class=" fa  fa-arrow-circle-right"></i></a>
                    <a class="col-xs-offset-1 col-xs-3 btn btn-warning" title="Edit this page." onclick="updatePage( <?php echo $page["id"];?>)"><i class=" fa fa-pencil-square-o"></i></a>
                    <a class="col-xs-offset-1 col-xs-3  btn btn-danger" title="Delete this page." onclick="deletePage( <?php echo $page["id"];?>)"><i class=" fa fa-trash"></i></a>
                </div>                
            </div>

                <?php
            }
            ?>
        </div>


    <?php }

    public static function preview($editable=false, $page, $category, $file, $cols){ ?>
        <div class="module-container col-sm-<?php echo $cols * 3 ;?>">
            <?php if($editable){ Page_v::pageAdministrationPanel($page); } ?>

            <div class="module page-preview row-1" >  
               <div class="page-preview-image" style="background-image: url('<?php echo  $file["thumb-medium"]; ?>')"> </div>
               <div class="page-title ">
                     <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($page['title']) ; ?>" data-content="<?php echo $page['description'] ;?>"><?php echo $page['title'] ; ?></a>
               </div>
               <div class="page-preview-text">
                   <?php echo $page['description'] ; ?>
               </div>
                <div class="page-preview-category">
                   <a href"<?php echo '?category='.$category['id']?>"><?php echo $category["title"]?></a>
               </div>
               <a href="<?php echo '?page='.$page['id']?>" class="btn-primary page-preview-href">
                   Open
               </a>
            </div>
        </div>
    <?php
    }

    public static function pageAdministrationPanel($pageData){?>
        <div class="module-buttons">
            <div class="row">
                <div class="col-xs-6">
                    <?php echo($pageData["status"]==1?"<i class=\"fa fa-eye\"></i>":"<i class=\"fa fa-eye-slash\"></i>").' #'.$pageData["id"];?>
                </div>
                <div class="col-xs-6">
                    <span class="pull-right">
                        <a onclick="updatePage( <?php echo $pageData["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                        <a onclick="deletePage( <?php echo $pageData["id"];?>)"><i class="fa fa-trash"></i></a>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <strong>Created:</strong>
                </div>
                <div class="col-xs-8"><?php echo $pageData["created"];?></div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <strong>Created By:</strong>
                </div>
                <div class="col-xs-8"><?php echo $pageData["created_by"];?></div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <strong>Edited:</strong>
                </div>
                <div class="col-xs-8"><?php echo $pageData["edited"];?></div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <strong>Edited By:</strong>
                </div>
                <div class="col-xs-8"><?php echo $pageData["edited_by"];?></div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <strong>Status:</strong>
                </div>
                <div class="col-xs-8"><?php echo $pageData["status"];?></div>
            </div>
        </div>
        <?php
    }


    public static function editor($url, $content, $category, $file){ ?>
        <form class="form-horizontal page_form" role="form" enctype="multipart/form-data" method="post" action="<?php echo $url;?>">
            <div class="form-group">
                <label class="control-label col-sm-2" for="me-title">Title:</label>
                <div class="col-sm-10">
                    <input id="pe-title" type="text" class="form-control" name="title" value="<?php echo((isset($content["title"]))?$content["title"]:"");  ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                    <textarea id="pe-description" class="form-control" rows="5" name="description"><?php echo ((isset($content["description"]))?$content["description"]:"");  ?></textarea>
                </div>
            </div>



            <div class="form-group">
                <label class="control-label col-sm-2" for="me-page_id">Select Category:</label>
                <div class="col-sm-10">
                    <select id="pe-category" class="combobox form-control" name="category_id">
                      <option></option>
                      <?php
                        foreach ($category as $key => $c) {
                            echo '<option ' .(($c["id"] == $content["category_id"]) ? "selected" : "" ). ' value="'.$c["id"].'">'.$c["title"]. '</option>';
                        }
                      ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Actual files:</label>
                <div class="col-sm-10 ">
                    <div class="files-actual bordered">
                        <!-- files from file manager container -->
                    </div>
                </div>
            </div>
            <div class="file-actual-buttons form-group">
                <input id="newFilePath" class="hiddenSection" type="text" value="">
                <div class="col-sm-5 col-xs-6  col-sm-offset-2">
                    <a href="javascript:open_popup('./filemanager/dialog.php?popup=1&type=1&amp;field_id=newFilePath&amp;relative_url=1')" class="btn btn-warning col-md-5 btn-block  btn-xs" type="button"><i class="fa fa-pencil-square"> </i> Change Image</a>
                </div>
                <div class="col-sm-5 col-xs-6 ">
                    <button title="Remove selected items" type="button"  onclick="removeSelectedItemsFrom('.files-actual')" class="actual-remove btn btn-danger col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-minus-square"> </i> Remove</button>
                </div>
            </div>
        <hr>
        <div class="form_result"></div>
        <button type="submit" onclick="selectAllCheckboxesFrom('.files-actual') ; return submitForm(this, '.page_form')" class="form_submit btn btn-success btn-block" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</button>
        <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
        <a onclick="location.reload()" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>
    </form>

    <script type="text/javascript">
            //--------- funkcie na pracu s filemanagerom --------- START
            //callback funkcia filemanagera
            function responsive_filemanager_callback(field_id) {
                handleFile(field_id,false, false, [])
            }

            <?php
            //naplnenie existujucim pri otvoreni editora
                if(isset($file["path"])&&isset($file["thumb"]))
                    echo "$('.files-actual').html(preview('".basename($file["path"])."', '".$file["path"]."', '".$file["thumb"]."', '".$file["thumb-medium"]."'));";
            ?>
    </script>


            <?php
    }

}

