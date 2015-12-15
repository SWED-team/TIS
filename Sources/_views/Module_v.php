<?php
class Module_v{
  private static function moduleEditorHead($type){
    return'       
          <form id="'.$type.'_form"  class="form-horizontal hiddenSection" role="form" enctype="multipart/form-data" method="post" 
          action="insertModule.php?'. (isset($_GET["page_id"])?"page_id=".$_GET["page_id"]:"").'">
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
            ';
  }
  private static function moduleEditorFoot(){
    return '
            <button type="submit" class="btn btn-success col-sm-12">Submit</button>
          </form>
        ';
  }
  public static function moduleImage($container, $content, $file){
    return '
    <div class="module-container col-sm-'.$container['cols'] * 3 .'">
      <div class="module module-image row-'.$container['rows'] .'" onclick="" style="background-image: url(\''. $file['thumb_medium'] .'\')">
        <div class="module-title">
          '. $content['title'].'
        </div>
      </div>
    </div>';
  }

  public static function moduleImageEditor($type){
    return Module_v::moduleEditorHead($type).'
            <!---- Image insert method ---->
            <div class="file-insert-method form-group">
              <label class="control-label col-sm-2">Method:</label>
              <label class="radio-inline col-sm-3"><input type="radio" name="upload-select" value="0">Upload new image</label>
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
            </div>' . Module_v::moduleEditorFoot();
  }







  public static function moduleFormated($container, $content){
    
    return '
   <div class="module-container col-sm-'.$container['cols'] * 3 .'">
      <div class="module module-formated-text row-'.$container['rows'] .'">
        <div class="module-text">
          '. $content['content'].'
        </div>
      </div>
    </div>';
    
  }


  public static function module(){
    echo '';
  }



  public static function moduleGallery($container, $content, $images){

  }
}

?>