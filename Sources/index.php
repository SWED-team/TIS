<?php
  mb_internal_encoding("UTF-8");
  require('_models/Db.php');
  require('_controllers/Module.php');
  require('_controllers/Page.php');
  require('_controllers/User.php');
  require('_controllers/File.php');

  Db::connect("127.0.0.1", "root", "", "tis");


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>ROBOT</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/fileinput.css" media="all" type="text/css" />
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">

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

$module = new ModuleImage(1);
$module->printModule();












/*

    <!-- modul s nahladom a textom -->
    <div class="module-container col-sm-6 ">
      <div class="module module-image-text row-2" style="background-image: url('img/i2.jpg')">
        <div class="module-title">Short text</div>
        <div class="module-text">
One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me?" he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops
        </div>
      </div>
    </div>


    <!-- modul s obrazkom titulkou a odkazom na stranku -->
    <div class="module-container col-sm-3">
      <div class="module module-image-title" style="background-image: url('img/i3.jpg')">
        <div class="module-category">category</div>
        <div class="module-title">Page link with image</div>
      </div>
    </div>

    <!-- modul s obrazkom a titulkou -->
    <div class="module-container col-sm-3">
      <div class="module module-image" style="background-image: url('img/i4.jpg')">
        <div class="module-title">Image with title on hover</div>
      </div>
    </div>



<!--
    <div class="module-container col-sm-3">
      <div class="module-video">
        <video width="100%" controls>
          <source src="as" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>
      </div>
    </div>
-->

    <div class="module-container col-sm-3 ">
      <div class="module module-formated-text ">
        <div class="module-text">
One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me?" he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops
        </div>
      </div>
    </div>

    <div class="module-container col-sm-3 ">
      <div id="myCarousel" class="row-1 module carousel slide article-slide vertical-center" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner cont-slider">
          <div class="item active">
            <img class="img-responsive center-block" alt="" title="" src="img/i5.jpg">
          </div>
          <div class="item ">
            <img class="img-responsive center-block" alt="" title="" src="img/i1.jpg">
          </div>
          <div class="item">
            <img class="img-responsive center-block" alt="" title="" src="img/i2.jpg">
          </div>

        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li class="active" data-slide-to="0" data-target="#myCarousel">

            <img alt="img-responsive center-block" src="./img/i5.jpg">
          </li>
          <li class="" data-slide-to="1" data-target="#myCarousel">
            <img alt="img-responsive center-block" src="./img/i1.jpg">
          </li>
          <li class="" data-slide-to="2" data-target="#myCarousel">
            <img alt="img-responsive center-block" src="./img/i2.jpg">

            <img alt="img-responsive center-block" src="img/i5.jpg">
          </li>
          <li class="" data-slide-to="1" data-target="#myCarousel">
            <img alt="img-responsive center-block" src="img/i1.jpg">
          </li>
          <li class="" data-slide-to="2" data-target="#myCarousel">
            <img alt="img-responsive center-block" src="img/i2.jpg">
          </li>
        </ol>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      </div>

    </div>





    <div class="module-container col-sm-3 ">
      <div class="module module-add text-center" data-toggle="modal" data-target="#module-editor" onclick="hideModuleForms($('#module-forms'))">
        +
      </div>
      
    </div>
  </div>


</section>

<!-------------------------- Pridavanie modulov -------------------------->
<section class="modal fade" id="module-editor" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button " class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Insert new module</h4>
        </div>
        <div class="modal-body row">

<!-------------------------- ponuka modulov -------------------------->
        <div class="col-md-3">
          <div class="row">
            <button type="button" class="btn btn-info" onclick="showModuleForm($('#module-video-form'))">
              <i class="fa fa-play-circle"></i>video
            </button>
          </div>
          <div class="row">
            <button type="button" class="btn btn-info" onclick="showModuleForm($('#module-embeded-form'))">
              <i class="fa fa-youtube-play"></i>embeded video
            </button>
          </div>
          <div class="row">
            <button type="button" class="btn btn-info" onclick="showModuleForm($('#module-image-form'))">
              <i class="fa fa-image"></i>image
            </button>
          </div>
          <div class="row">
            <button type="button" class="btn btn-info">
              <i class="fa fa-image"></i>image gallery
            </button>
          </div>
          <div class="row">
            <button type="button" class="btn btn-info">
              <i class="fa fa-font"></i>text
            </button>
          </div>
          <div class="row">
            <button type="button" class="btn btn-info">
              <i class="fa fa-file-text-o"></i>formated text
            </button>
          </div>
          <div class="row">
            <button type="button" class="btn btn-info">
              <i class="fa fa-link"></i>link
            </button>
          </div>
        </div>
<!-------------------------- Module properties -------------------------->

        <div id="module-forms" class="col-md-9">
<!-------------------------- Properties of video module -------------------------->
          <form id="module-video-form"  class="form-horizontal" role="form" enctype="multipart/form-data">
            <h2>Insert Video</h2>


            <!---- Video Title ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="title">Title:</label>
              <div class="col-sm-10"> 
                <input id="edit-module-title" type="text" class="form-control" name="title">
              </div>
            </div>


            <!---- Video size ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="width">Width:</label>
              <div class="col-sm-2">          
                <select class="form-control col-sm-2" id="edit-module-width" name="width">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
              <label class="control-label col-sm-2" for="height">Height:</label>
              <div class="col-sm-2">          
                <select class="form-control col-sm-2" id="edit-module-height" name="height">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div> 

            <!---- Video insert method ---->
            <div class="file-insert-method form-group">
              <label class="control-label col-sm-2">Method:</label>
              <label class="radio-inline col-sm-3"><input type="radio" name="upload-select" value='0'>Upload new video</label>
              <label class="radio-inline"><input type="radio" name="upload-select" value="1">Select from uploaded</label>
            </div>


            <!---- Video upload method ---->
            <div id="file-uploader" class="form-group">
              <label class="control-label col-sm-2" for="upload-file">Upload:</label>
              <div class="form-group col-sm-10">
                <input id="upload-video-file" class="file" type="file" data-upload-url="#">
              </div>
            </div>

            <!---- Video select method ---->
            <div id="file-selector">
              <!---- Video select filter ---->
              <div class="form-group">
                <label class="control-label col-sm-2">Filter:</label>
                
                <div class="col-sm-4"> 
                  <label class="control-label" for="filter-name">Name:</label>
                  <input id="filter-name" name="filter-name" type="text" class="form-control col-sm-2" >
                </div>
                
                <div class="col-sm-3"> 
                  <label class="control-label" for="filter-date-from">Upload by date:</label>
                  <input id="filter-date-from" name="filter-date-from" type="date" class="form-control " >
                </div>
                             
                <div class="col-sm-3"> 
                  <label class="control-label" for="filter-date-to">Upload to date:</label>
                  <input id="filter-date-to" name="filter-date-to" type="date" class="form-control " >
                </div>
              </div>

              <!---- Video result ---->
              <div class="form-group">
                <label class="control-label col-sm-2">Result:</label>

                <div class="col-sm-4"> 
                  <label class="control-label" for="search-file-result">Filter result:</label>
                  <select class="form-control" name="search-file-result">
                    <option value="id?????">results row 1</option>
                  </select>
                </div>
                <!---- Video result sort ---->
                <div class="col-sm-3"> 
                  <label class="control-label" for="filter-sort">Sort result by:</label>
                  <select class="form-control col-sm-2" id="filter-sort" name="filter-sort">
                    <option value="1">Upload date</option>
                    <option value="2">Title</option>
                    <option value="3">Size</option>
                  </select>
                </div>
              </div>
            </div>

            <!---- Video module submit ---->
          <button type="submit" class="btn btn-success col-sm-12">Submit</button>
          </form>

<!-------------------------- Properties of embeded video module -------------------------->
          <form id="module-embeded-form" class="form-horizontal" role="form" enctype="multipart/form-data">
            <h2>Insert Embeded Video</h2>

            <!---- Video Title ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="title">Title:</label>
              <div class="col-sm-10"> 
                <input type="text" class="form-control" name="title" >
              </div>
            </div>

            <!---- Video size ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="width">Width:</label>
              <div class="col-sm-2">          
                <select class="form-control col-sm-2" id="edit-module-width" name="width">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
              <label class="control-label col-sm-2" for="height">Height:</label>
              <div class="col-sm-2">          
                <select class="form-control col-sm-2" id="edit-module-height" name="height">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div> 

            <div class="form-group">
              <label class="control-label col-sm-2" for="comment">Embeded link:</label>
              <div class="col-sm-10">  
                <textarea class="form-control" rows="5" id="module-embeded-link" name="module-embeded-link"></textarea>
              </div>
            </div>

            <!---- Video module submit ---->
          <button type="submit" class="btn btn-success col-sm-12" name="submit">Submit</button>
          </form>


<!-------------------------- Properties of image module -------------------------->
         <form id="module-image-form" class="form-horizontal" role="form" enctype="multipart/form-data">
            <h2>Insert Image</h2>

            <!---- Image Title ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="title">Title:</label>
              <div class="col-sm-10"> 
                <input type="text" class="form-control" name="title" >
              </div>
            </div>

            <!---- Image size ---->
            <div class="form-group">
              <label class="control-label col-sm-2" for="width">Width:</label>
              <div class="col-sm-2">          
                <select class="form-control col-sm-2" id="edit-module-width" name="width">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
              <label class="control-label col-sm-2" for="height">Height:</label>
              <div class="col-sm-2">          
                <select class="form-control col-sm-2" id="edit-module-height" name="height">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div> 


            <!---- Image insert method ---->
            <div class="file-insert-method form-group">
              <label class="control-label col-sm-2">Method:</label>
              <label class="radio-inline col-sm-3"><input type="radio" name="upload-select" value='0'>Upload new image</label>
              <label class="radio-inline"><input type="radio" name="upload-select" value="1">Select from uploaded</label>
            </div>


            <!---- Image upload method ---->
            <div id="file-uploader" class="form-group">
              <label class="control-label col-sm-2" for="upload-file">Upload:</label>
              <div class="form-group col-sm-10">
                <input id="upload-image-file" class="file" type="file" data-upload-url="#">
              </div>
            </div>

            <!---- Image select method ---->
            <div id="file-selector">
              <!---- Image select filter ---->
              <div class="form-group">
                <label class="control-label col-sm-2">Filter:</label>
                
                <div class="col-sm-4"> 
                  <label class="control-label" for="filter-name">Name:</label>
                  <input id="filter-name" name="filter-name" type="text" class="form-control col-sm-2" >
                </div>
                
                <div class="col-sm-3"> 
                  <label class="control-label" for="filter-date-from">Upload by date:</label>
                  <input id="filter-date-from" name="filter-date-from" type="date" class="form-control " >
                </div>
                             
                <div class="col-sm-3"> 
                  <label class="control-label" for="filter-date-to">Upload to date:</label>
                  <input id="filter-date-to" name="filter-date-to" type="date" class="form-control " >
                </div>
              </div>

              <!---- Image result ---->
              <div class="form-group">
                <label class="control-label col-sm-2">Result:</label>

                <div class="col-sm-4"> 
                  <label class="control-label" for="search-file-result">Filter result:</label>
                  <select class="form-control" name="search-file-result">
                    <option value="id?????">results row 1</option>
                  </select>
                </div>
                <!---- Image result sort ---->
                <div class="col-sm-3"> 
                  <label class="control-label" for="filter-sort">Sort result by:</label>
                  <select class="form-control col-sm-2" id="filter-sort" name="filter-sort">
                    <option value="1">Upload date</option>
                    <option value="2">Title</option>
                    <option value="3">Size</option>
                  </select>
                </div>
              </div>
            </div>

            <!---- Image module submit ---->
          <button type="submit" class="btn btn-success col-sm-12">Submit</button>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      */?>
    </div>
</section>
<!-------------------------- End of module add -------------------------->

</div>
<div class="push"></div>
<footer class="container-fluid">
  <div class="row">
    <div class="col-md-12 text-center">
      <p>Copyright (c) 2015 SWED Team</p>
    </div>
  </div>
</footer>










<script src="./js/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="./js/bootstrap.min.js" type="text/javascript"></script>
<script src="./js/fileinput.js" type="text/javascript"></script>
<script type="text/javascript">

function checkInsertFileMethod(methodParent){
  var methodVal = methodParent.find('input[type="radio"]:checked').val();
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


$(document).on('ready', function(){
  $(".file-insert-method").each(function(){
    $(this).on('change', function(){
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
<script>
    $('#upload-video-file').fileinput({
        allowedFileExtensions : ['3gp', 'avi','mov','mp4'],
        'showUpload':false
    });
    $('#upload-image-file').fileinput({
        allowedFileExtensions : ['jpg', 'jpeg','gif','png','bmp'],
        'showUpload':false
    });
</script>




<!--
<script src="./js/fileinput_locale_cz.js" type="text/javascript"></script>
<script src="./js/fileinput_locale_sk.js" type="text/javascript"></script>
-->

</body>
</html>