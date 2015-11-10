<?php
class Module_v{
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

  public static function moduleImageEditor(){
    return '
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
            </div>';
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


  public static function moduleEmbeded($container, $content){
    return '
    <div class="module-container col-sm-'.$container['cols'] * 3 .'">
      <div class="module-embeded row-'.$container['rows'] .'">
        '. $content['link'].'
      </div>
    </div>
    ';
  }
  public static function moduleEmbededEditor(){
    return '
            <div class="form-group">
              <label class="control-label col-sm-2" for="comment">Embeded link:</label>
              <div class="col-sm-10">  
                <textarea class="form-control" rows="5" id="module-embeded-link" name="module-embeded-link"></textarea>
              </div>
            </div>
    ';
  }


  public static function module(){
    echo '';
  }



  public static function moduleGallery($container, $content, $images){

  }
}

?>