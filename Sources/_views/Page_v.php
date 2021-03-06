<?php
/**
 * Page_v Trieda View-u pre kontroler User.
 *
 * Page_v trieda obsahuje view-y pre zobrazenie:
 * stránky
 *
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 */
class Page_v{
    public static function pageHead( $title ){
?>
<!DOCTYPE html>
<!--<html lang="en">-->
<html>
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
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">


    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="js/bootstrap-combobox.js"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/Module.js"></script>
    <script type="text/javascript" src="js/Page.js"></script>

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <?php
    }
    public static function pageHeader( $category, $home, $navbarPages, $user, $actCategory=null){
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
                <?php 
                if(isset($home) && sizeof($home) > 0)
                    echo '<a class="navbar-brand text-primary" href="./">'.$home["title"].'</a>';
                ?>
            </div>
            <div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <?php echo (($actCategory!=null)? $actCategory["title"] : "Category" );?> 
                              <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                          <?php
                            foreach ($category as $key => $c) {
                                echo '<li><a href="?category='.$c["id"].'" title="'.$c["description"].'">'.$c["title"].'</a></li>';
                            }
                          ?>
                          </ul>
                        </li>
                        <?php
                            foreach ($navbarPages as $key => $n) {
                                echo '<li><a href="?page='.$n["id"].'" title="'.$n["description"].'">'.$n["title"].'</a></li>';
                            }
                        ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <?php if($user->isLoggedIn()){ ?>
                            <a class="btn btn-primary navbar-btn"  href="?profile&amp;user=<?php echo $user->getUserID(); ?>">Administration</a>
                            <a class="btn btn-danger navbar-btn" id="logofButton">Log Off</a>
                        <?php } else { ?>
                            <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#LoginPop" >Log in</button>                    
                        <?php }?>
                    </ul>
                <div class="navbar-right">
                    <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="q" <?php if(isset($_GET["q"])) echo 'value="'.$_GET["q"].'"';?>>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">&nbsp;<i class="fa fa-search"></i>&nbsp;</button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>

            </div>
        </div>
    </nav>
    <div class="wrapper">
    <section class="container-fluid page-content">
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

        <footer class="container-fluid shadow">
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

    /**
     * Funkcia vypíše 
     * @param  [type] $modules [description]
     * @return [type]          [description]
     */
    public static function moduleEditor($modules, $page=0)
    {
        $buttons = "";
        foreach ($modules as $type => $m) {
            $editorUrl = "_controllers/".get_class($m).".php?show_editor=true".(($page>0)?"&page_id=".$page:"");
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
    public static function breadcrumbs($subsection=array(), $page=null, $editable=false){?>
        <div class="page-info">
        <?php
            if($editable && $page != null){ ?>
                    <span class="pull-right">
                        <a onclick="addPage()"><i class="fa fa-plus-square"></i></a>
                        <a onclick="updatePage( <?php echo $page["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                        <a onclick="deletePage( <?php echo $page["id"];?>)"><i class="fa fa-trash"></i></a>
                        
                    </span>
                <?php } ?>
            <ol class="breadcrumb">
                <li><a href="./"><i class="fa fa-home"></i></a></li>
                <?php
                foreach ($subsection as $title => $href) {
                   echo '<li class="breadcrumb-item"><a href="'.$href.'">'. $title.'</a></li>';
                }
                ?>

            </ol>
        </div>
        <?php
    }
    public static function pageInfo($page,$editable=false){ ?>
        <div class="page-info shadow">
            <?php
            if($editable && $page != null){ ?>
                    <span class="col-xs-12 text-right">
                        <a onclick="addPage()"><i class="fa fa-plus-square"></i></a>
                        <a onclick="updatePage( <?php echo $page["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                        <a onclick="deletePage( <?php echo $page["id"];?>)"><i class="fa fa-trash"></i></a>
                        
                    </span>
                <?php 
            } 
            echo "<h4>".$page["title"] . "</h4><p>".$page["description"]."</p>";
            ?>

        </div>
        <?php
    }

    public static function pageFooter($page){ ?>
        <div class="col-xs-12">
        <hr>
            <div class="row text-muted">Author: <a href="?profile&user=<?php echo $page["author_id"]?>"><?php echo $page["author"]?></a></div>
            <div class="row text-muted">Last modification: <?php echo $page["edited"]?> by <a href="?profile&user=<?php echo $page["editor_id"]?>"><?php echo $page["editor"]?></a></div>
        </div>  <?php
    }

    public static function pageListAdmin($pageData){?>
        <div class="data-list col-xs-12 adminContent">
                        <div id="pagelist_result"></div>

            <div class="row">
                <a class=" col-xs-12 btn btn-primary" title="Create new page" onclick="addPage()"><i class=" fa fa-plus"></i> Create new page</a>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <h4>Page Info</h4>
                </div>
                <div class="col-sm-2 text-center">
                    <h4>Visible</h4>
                </div>
                <div class="col-sm-2 text-center">
                    <h4>Home</h4>
                </div>
                <div class="col-sm-2 text-center">
                    <h4>Navbar</h4>
                </div>
                <div class="col-sm-3 text-center">
                    <h4>Open / Edit / Delete</h4>
                </div>                
            </div>
            <?php
            $cnt=0;
            foreach ($pageData as $key => $page) {
                $cnt++;
                ?>
            <div class="row bordered">
                <div class="col-sm-3 page-list-info">
                        <?php 
                        echo "<small class='text-muted'>#".$cnt ." </small> ". $page["title"];
                        ?>
                </div>
                <div class="col-sm-2 text-center">
                    <?php 
                    if($page["status"]==0)
                        echo '<div class="col-sm-2  "><input  onchange="setStatusPage(this,'.$page["id"].')" data-on="Visible" data-off="Hidden"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
                    else 
                        echo '<div class="col-sm-2 "><input checked onchange="setStatusPage(this, '.$page["id"].')" data-on="Visible" data-off="Hidden"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
                    ?>
                </div>
                <div class="col-sm-2 text-center">
                    <?php 
                    if($page["is_home"]==0)
                        echo '<div class="col-sm-2 "><input  onchange="setHomePage(this,'.$page["id"].')" data-on="Home On" data-off="Home Off"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
                    else 
                        echo '<div class="col-sm-2  disabled"><input class="homeDisabled"  checked data-on="Home On" data-off="Home Off"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
                    ?>
                </div>
                <div class="col-sm-2 text-center">
                    <?php 
                    if($page["in_navbar"]==0)
                        echo '<div class="col-sm-2  "><input  onchange="setNavbarPage(this,'.$page["id"].')" data-on="Nav On" data-off="Nav Off"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
                    else 
                        echo '<div class="col-sm-2  "><input checked onchange="setNavbarPage(this,'.$page["id"].')" data-on="Nav On" data-off="Nav Off"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="mini" type="checkbox"></div>';
                    ?>
                </div>
                <div class="col-sm-3 text-center">
                    <a href="?profile&amp;user=<?php echo $page["created_by"];?>" class="col-sm-offset-1 col-sm-2 btn-xs btn btn-default" title="Open Creator Profile" ><i class=" fa  fa-user"></i></a>
                    <a href="?page=<?php echo $page["id"];?>" class="col-sm-offset-1 col-sm-2 btn-xs btn btn-primary" title="Open this page." ><i class=" fa  fa-arrow-circle-right"></i></a>
                    <a class="col-sm-offset-1 col-sm-2 btn-xs btn btn-warning" title="Edit this page." onclick="updatePage( <?php echo $page["id"];?>)"><i class=" fa fa-pencil-square-o"></i></a>
                    <a class="col-sm-offset-1 col-sm-2 btn-xs btn btn-danger" title="Delete this page." onclick="deletePage( <?php echo $page["id"];?>)"><i class=" fa fa-trash"></i></a>
                </div>
            </div>

                <?php
            }
            ?>
        </div>



    <?php }
    public static function pageListUser($pageData){?>
        <div class="page-list col-xs-12 adminContent">
            <div class="row">
                <a class=" col-xs-12 btn btn-primary" title="Create new page" onclick="addPage()"><i class=" fa fa-plus"></i> Create new page</a>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Page Info</h4>
                </div>
                <div class="col-sm-6 text-center">
                    <h4>Open / Edit / Delete</h4>
                </div>                
            </div>
            <?php
            $cnt=0;
            foreach ($pageData as $key => $page) {
                $cnt++;
                ?>
            <div class="row bordered">
                <div class="col-sm-6 page-list-info">
                        <?php 
                        echo "<small class='text-muted'>#".$cnt ." </small> ". $page["title"];
                        ?>
                </div>
                <div class="col-sm-6 text-center">
                    <a href="?page=<?php echo $page["id"];?>" class="col-sm-offset-1 col-sm-3 btn-xs btn btn-primary" title="Open this page." ><i class=" fa  fa-arrow-circle-right"></i></a>
                    <a class="col-sm-offset-1 col-sm-3 btn-xs btn btn-warning" title="Edit this page." onclick="updatePage( <?php echo $page["id"];?>)"><i class=" fa fa-pencil-square-o"></i></a>
                    <a class="col-sm-offset-1 col-sm-3 btn-xs  btn btn-danger" title="Delete this page." onclick="deletePage( <?php echo $page["id"];?>)"><i class=" fa fa-trash"></i></a>
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
               <div class="page-title">
                     <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($page['title']) ; ?>" data-content="<?php echo $page['description'] ;?>"><?php echo $page['title'] ; ?></a>
               </div>
               
                <a href="<?php echo '?page='.$page['id']?>" class="page-preview-href">
                    <div class="page-preview-text shadow">
                   <?php echo $page['description'] ; ?>
                   <br><br><small class="text-muted">...continue to page</small>
                    </div>
               </a>
                <!--<div class="page-preview-category">
                   <a href"<?php echo '?category='.$category['id']?>"><?php echo $category["title"]?></a>
               </div>
               -->
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
<?php /*
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
            </div>*/ ?>
        </div>
        <?php
    }



    public static function editor($url, $content, $category, $users=array(), $isOwner=true, $file=array(), $editors=array(), $owner=null){ ?>
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
                            echo '<option ' .((isset($content["category_id"]) && $c["id"] == $content["category_id"]) ? "selected" : "" ). ' value="'.$c["id"].'">'.$c["title"]. '</option>';
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
            <?php
                if($owner!=null){ ?>
                <div class="form-group">
                    <label class="control-label col-sm-2">Page Owner:</label>
                    <div class="col-sm-10 ">
                        <div class="bordered">
                            <?php echo$owner['first_name']." ".$owner['last_name']." (".$owner['email'].")"; ?>
                        </div>
                    </div>
                </div>
                <?php
                } 
            ?>
            <div class="form-group">
                <label class="control-label col-sm-2">Actual Editors:</label>
                <div class="col-sm-10 ">
                    <div class="editors-actual bordered">
                        <!-- actual users container -->
                    </div>
                </div>
            </div>

            <?php
                if($isOwner){
            ?>  

                <div class="form-group">               
                    <label class="control-label col-sm-2" for="new-editor">Add Editor:</label>
                    <div class="col-sm-6">
                        <select id="new-editor" class="combobox form-control btn-block  " name="page_id">
                          <option></option>
                          <?php
                            foreach ($users as $key => $u) {
                                $info = $u['first_name']." ".$u['last_name']." (".$u['email'].")";
                                echo '<option value="'.$u["id"].':|:'.$info.'">'.$u["first_name"].' '.$u["last_name"].' ('.$u["email"]. ')</option>';
                            }
                          ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn-block  btn btn-success" onclick="addUserToEditors()" tabindex="0" data-content="Select user, which is not actual editor of page." data-toggle="popover" data-trigger="focus" data-placement="top" >Add</a>
                    </div>
                    <div class="col-sm-2">
                        <button title="Remove selected items" type="button"  onclick="removeSelectedItemsFrom('.editors-actual')" class="btn btn-danger btn-block " data-loading-text="working..." autocomplete="off"><i class="fa fa-minus-square"> </i> Remove</button>
                    </div> 
                </div>
            <?php
                }
            ?>

        <hr>
        <div class="form_result"></div>
        <a  onclick="selectAllCheckboxesFrom('.files-actual') ; selectAllCheckboxesFrom('.editors-actual') ; return submitForm(this, '.page_form')" class="form_submit btn btn-success btn-block" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</a>
        <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
        <a onclick="location.reload()" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>
    </form>

    <script type="text/javascript">
            //--------- funkcie na pracu s filemanagerom --------- START
            //
            //callback funkcia filemanagera
            function responsive_filemanager_callback(field_id) {
                handleFile(field_id,false, false, [])
            }

            <?php
            //naplnenie existujucim pri otvoreni editora
                if(isset($file["path"])&&isset($file["thumb"]))
                    echo "$('.files-actual').html(preview('".basename($file["path"])."', '".$file["path"]."', '".$file["thumb"]."', '".$file["thumb-medium"]."'));";
            ?>
            function editorPreview(user_id, info){
                return '\
                    <label class="col-xs-12">\
                        <input class="hiddenSection page-editor-id" name="editor-id[]" type="checkbox" value="' + user_id + '">\
                        <div class="row">\
                            <div class="col-xs-12">'+info+'</div>\
                        </div>\
                    </label>';
            }
            $(document).ready(function(){
                $('.combobox').combobox({bsVersion: '3'});
            });

            function addUserToEditors(){
                var val = $("#new-editor").val().split(":|:");
                var selector = '.page-editor-id[value="'+val[0]+'"]'
                if(val.length > 1 && $(selector).length==0)
                    $('.editors-actual').append(editorPreview(val[0], val[1]));
                else{
                    $('[data-toggle="popover"]').popover("show");
                }
                    
            }   
            <?php 
            if($editors != null){
                foreach ($editors as $key => $e) {
                    $info = $e['first_name']." ".$e['last_name']." (".$e['email'].")";
                    echo "$('.editors-actual').append(editorPreview('".$e["id"]."', '".$info."'));";
                }
            }


            ?>

    </script>


            <?php 
    }

}

