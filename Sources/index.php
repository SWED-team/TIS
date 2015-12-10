<?php
  mb_internal_encoding("UTF-8");
  require('_models/Db.php');
  require('_controllers/Module.php');
  require('_controllers/Page.php');
  include('_controllers/User.php');
  session_start();
  Db::connect("127.0.0.1", "root", "", "tis");
  $page = new Page(4);
    $_user=new User();
     $_user->checkIfLogin();
  $_user->checkIfLogoff();
  echo $page->header();
 
 if(isset($_POST["submitProf"]))
  {
   
    $_user->fillUserDataBySession();

    echo $_user->printUserSection();
  }
  else if(isset($_POST["submitReg"])){
    echo $_user->printUserSectionReg();
  }
  else if(isset($_POST["submitRegUser"])){
    // $_user->Reg();
  }
  else {

    error_reporting(1);

  echo $page->pageContent(true); // argument nastavuje ci sa stranka zobrazi v rezime administracie alebo zobrazenia
  }
  echo $page->footer();
  $_user->printLogPop();
  ?>
        <script src="./js/scripts.js" type="text/javascript"></script>
       





 /*  

?>

    <!-- modul s nahladom a textom -->
    <div class="module-container col-sm-6 ">
      <div class="module module-image-text row-1" style="background-image: url('img/i2.jpg')">
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







<!-------------------------- pop up pre login -------------------------->
<div id="LoginPop" class="modal fade col-md-9 col-centered" role="dialog">
  <div class="modal-dialog">

   
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login/Registration</h4>
      </div>
      <div class="modal-body">
         <input id="loginEmail " type="text" class="form-control col-md-5" name="title">
          <input id="loginPass" type="text" class="form-control" name="title">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal" id="loginBtn">log</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">reg</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

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








<script type="text/javascript">

$("#loginBtn").on("click",function()
  {
   // alert("Fsdfsdf");
   var email= $("#loginEmail").val();
   var pass=$("#loginPass").val()
  var sendInfo = {'function':"logUser",

  "arg":{
           "login": "martin.krasna@gmail.com",
           "pass":"123456"}

       };

    jQuery.ajax({
        type: "POST",
        url: '_controllers/ajax_handler.php',
        
        data: {'json':sendInfo},
       
       

       success: function(data){
  //  alert('success');
    alert(data);
  },
  error: function(data){
    alert(data);
    alert('failure');
  }
    });
 
  
  
       
  });

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
</html>*/?>
