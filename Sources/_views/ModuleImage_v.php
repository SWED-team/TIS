<?php

/**
 * Class1 short summary.
 *
 * Class1 description.
 *
 * @version 1.0
 * @author KRASNAN
 */
class ModuleImage_v
{
    public static function editor($container, $content, $operation, $file){
        // value="'.(isset($content["title"]))?$content["title"]:"".'"
		$url = '_controllers/ModuleImage.php?';
		if(isset($operation))
			$url = $url.$operation.'=true&';
		if(isset($_GET["page_id"]) && $_GET["page_id"]!=0)
			$url = $url.'page_id='.$_GET["page_id"].'&';
		if(isset($container["id"]) && $container["id"]!=0)
			$url = $url.'id='.$container["id"].'&';
		return '

          <form id="'.$container["type"].'_form"  class="form-horizontal" role="form" enctype="multipart/form-data" method="post"
          action="'.$url.'">
            <h1> Module Image</h1>


            <h4 class="text-muted "> Module Container Data</h4><hr>

            <div class="form-group">
              <label class="control-label col-sm-2" for="cols">Width:</label>
              <div class="col-sm-4">
                <select id="cols" class="form-control" name="cols" >
                  <option value="1" '. ((isset($container["cols"]) && $container["cols"]==1)?"selected":"").'>1 column</option>
                  <option value="2" '. ((isset($container["cols"]) && $container["cols"]==2)?"selected":"").'>2 columns</option>
                  <option value="3" '. ((isset($container["cols"]) && $container["cols"]==3)?"selected":"").'>3 columns</option>
                  <option value="4" '. ((isset($container["cols"]) && $container["cols"]==4)?"selected":"").'>4 columns</option>
                </select>
              </div>
              <label class="control-label col-sm-2" for="rows">Height:</label>
              <div class="col-sm-4">
                <select id="rows" class="form-control col-sm-2" name="rows">
                  <option value="1" '. ((isset($container["rows"]) && $container["rows"]==1)?"selected":"").'>1 row</option>
                  <option value="2" '. ((isset($container["rows"]) && $container["rows"]==2)?"selected":"").'>2 rows</option>
                  <option value="3" '. ((isset($container["rows"]) && $container["rows"]==3)?"selected":"").'>3 rows</option>
                  <option value="4" '. ((isset($container["rows"]) && $container["rows"]==4)?"selected":"").'>4 rows</option>
                  <option value="0" '. ((isset($container["rows"]) && $container["rows"]==0)?"selected":"").'>auto</option>
                </select>
              </div>
            </div>

            <div class="form-group">
	            <label class="control-label col-sm-2" for="status">Status:</label>
	            <div class="col-sm-4">
	              <select id="status" class="form-control" name="status" >
	                <option value="0" '. ((isset($container["status"]) && $container["status"]==0)?"selected":"").'>Hidden</option>
	                <option value="1" '. ((isset($container["status"]) && $container["status"]==1)?"selected":"").'>Published</option>
	              </select>
	            </div>
              <label class="control-label col-sm-2" for="me-order">Order:</label>
              <div class="col-sm-4">
                <input id="me-order" type="number" class="form-control" name="order" min="0" value="'.((isset($content["order"]))?$content["order"]:"").'">
              </div>
	          </div>

           	<h4 class="text-muted "> Module Content Data</h4><hr>
		    <div class="form-group">
              <label class="control-label col-sm-2" for="me-title">Title:</label>
              <div class="col-sm-10">
                <input id="me-title" type="text" class="form-control" name="title" value="'.((isset($content["title"]))?$content["title"]:"").'">
              </div>
            </div>



            <div class="form-group">
                <label class="control-label col-sm-2">Actual files:</label>
                <div class="col-sm-10 ">
                    <div class="files-actual bordered">
                        <!--<label class="checkbox-inline"><input name="selected-file" type="checkbox" value="file_id"><div class="result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div></label>-->

                        <label class="">
                            <input name="actual-file-id[]" type="checkbox" value="1">
                            <div class="row">
                                <div class="col-xs-3 result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div>
                                <div class="col-xs-9 "><input disabled name="actual-file-title[]" placeholder="title"  class="form-control" type="text" value="nazov"></div>
                                <div class="col-xs-9 "><input disabled name="actual-file-description[]" placeholder="description" class="form-control" type="text" value="popis lhk hjgkljh ljh jghj hgjhg jgjgj  lkjh lhj lkjh "></div>
                            </div>
                        </label>
                        <label class="">
                            <input name="actual-file-id[]" type="checkbox" value="2">
                            <div class="row">
                                <div class="col-xs-3 result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div>
                                <div class="col-xs-9 "><input disabled name="actual-file-title[]" placeholder="title"  class="form-control" type="text" value="nazov"></div>
                                <div class="col-xs-9 "><input disabled name="actual-file-description[]" placeholder="description" class="form-control" type="text" value="popis lhk hjgkljh ljh jghj hgjhg jgjgj  lkjh lhj lkjh "></div>
                            </div>
                        </label>
                        <label class="">
                            <input name="actual-file-id[]" type="checkbox" value="3">
                            <div class="row">
                                <div class="col-xs-3 result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div>
                                <div class="col-xs-9 "><input disabled name="actual-file-title[]" placeholder="title"  class="form-control" type="text" value="nazov"></div>
                                <div class="col-xs-9 "><input disabled name="actual-file-description[]" placeholder="description" class="form-control" type="text" value="popis lhk hjgkljh ljh jghj hgjhg jgjgj  lkjh lhj lkjh "></div>
                            </div>
                        </label>

                    </div>
                </div>
            </div>

            <div class="file-actual-buttons form-group">

                <div class="col-md-5 col-md-offset-2"><button type="button" class="actual-add btn btn-success  btn-block  btn-xs" data-loading-text="working..." data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fa fa-plus-square"></i>Add Files</button></div>
                <div class="col-md-5 "><button type="button" class="actual-remove btn btn-danger col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-minus-square"></i>Remove Selected Files</button></div>
            </div>

            <div class="file-insert-section hiddenSection">
                <div class="file-insert-method form-group">
                  <label class="control-label col-sm-2">Set New:</label>
                  <label class="radio-inline col-sm-4"><input type="radio" name="method" value="upload">Upload new file</label>
                  <label class="radio-inline col-sm-4"><input type="radio" name="method" value="select">Select from files</label>
                </div>

                <div class="form-group file-uploader hiddenSection">
                  <label class="control-label col-sm-2" for="file">Image:</label>
                  <div class="col-sm-10">
                    <input id="file" class="file" type="file" data-upload-url="#" name="file">
                  </div>
                </div>

                <div class="file-selector hiddenSection">
                  <!---- Image select filter ---->
                  <div class="form-group">
                    <label class="control-label col-sm-2">Filter:</label>

                    <div class="col-sm-6">
                      <label class="control-label" for="filter-name">Name:</label>
                      <input id="filter-name" name="filter-name" type="text" class="form-control" >
                    </div>

                    <div class="col-sm-2">
                      <label class="control-label" for="filter-extension">Extension:</label>
                      <input id="filter-extension" name="filter-extension" type="text" class="form-control" >
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Refresh</label>
                        <button type="button" class="filter-submit btn btn-primary btn-block" data-loading-text="..." autocomplete=""off><i class="fa fa-refresh"></i></button>
                    </div>
                  </div>




                  <!---- Image result ---->
                  <div class="form-group file-selector-result">
                    <label class="control-label col-sm-2">Result:</label>
                    <div class="col-sm-10 ">
                        <div class="bordered file-select-result-single">
                            <!--<label class="checkbox-inline"><input name="selected-file" type="checkbox" value="file_id"><div class="result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div></label>-->
                            <label class="checkbox-inline"><input name="selected-file" type="checkbox" value="1"><div class="result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div></label>
                        </div>
                    </div>
                    <div class="col-sm-10 col-sm-offset-2 ">
                        <div class="bordered file-select-result-multiple">
                            <!--<label class="radio-inline"><input name="selected-file" type="radio" value="file_id"><div class="result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div></label>-->
                            <label class="radio-inline"><input name="selected-file" type="radio" value="1"><div class="result-file-preview" style="background-image:url(\'./img/i1.jpg\')"></div></label>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="description">Description:</label>
              <div class="col-sm-10">
                <textarea id="description" class="form-control" rows="5" name="description" >'.((isset($content["description"]))?$content["description"]:"").'</textarea>
              </div>
            </div>

            <div class="'.$container["type"].'_form_result"></div>
            <button type="submit" class="form_submit btn btn-success btn-block  btn-lg" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</button>
            <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
            <a onclick="location.reload()" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>

          </form>

          <script>
////////////////// file scripts
            $("#'.$container["type"].'_form").find("[type=\'submit\']").each(function(){
                $(this).on("click",function(event){
                    event.preventDefault();
                    alert("1");
                });
            });


            // change file-insert method
            $("#'.$container["type"].'_form").find(".file-insert-method").each(function(){
                $(this).on("change",function(event){
                    var method = $(this).find("input[type=\"radio\"]:checked").val();
                    if(method=="upload"){
                        $(this).parent().find(".file-uploader").removeClass("hiddenSection");
                        $(this).parent().find(".file-selector").addClass("hiddenSection");
                    }
                    else if(method=="select"){
                        $(this).parent().find(".file-selector").removeClass("hiddenSection");
                        $(this).parent().find(".file-uploader").addClass("hiddenSection");
                    }
                    else{
                        $(this).parent().find(".file-selector").addClass("hiddenSection");
                        $(this).parent().find(".file-uploader").addClass("hiddenSection");
                    }
                });
            });


            // show add section on actual-add
            $("#'.$container["type"].'_form").find(".actual-add").each(function(){
                $(this).on("click",function(event){
                    event.preventDefault();
                    var $btn = $(this).button("loading");

                    var form = $(this).closest("#'.$container["type"].'_form");
                    var finsert = form.find(".file-insert-section");
                    var isHidden = finsert.hasClass("hiddenSection");
                    if(isHidden){
                        finsert.removeClass("hiddenSection");
                    }
                    else{
                        finsert.addClass("hiddenSection");
                    }
                    $btn.button("reset");
                });
            });
            //remove actual
            $("#'.$container["type"].'_form").find(".actual-remove").each(function(){
                $(this).on("click",function(event){
                    event.preventDefault();
                    var $btn = $(this).button("loading");

                    var form = $(this).closest("#'.$container["type"].'_form");
                    var selected = form.find("input[name^=\'actual-file-id\']:checked");

                    selected.each(function(){
                        $(this).parent().addClass("hiddenSection");
                    });

                    $btn.button("reset");
                });
            });
            //filter sumbit
            $("#'.$container["type"].'_form").find(".filter-submit").each(function(){
                $(this).on("click",function(event){
                    event.preventDefault();
                    var $btn = $(this).button("loading");
                    var fselect = $(this).closest(".file-selector");
                    var resultSingle = fselect.find(".file-select-result-single");
                    var resultMultiple = fselect.find(".file-select-result-multiple");

                    //alert(resultSingle.attr("class"));

                    var criteria = [];
                    criteria["filter"]    = true;
                    criteria["title"]     = fselect.find("#filter-name").val();
                    criteria["extension"] = fselect.find("#filter-extension").val();
                    criteria["date_from"] = fselect.find("#filter-date-from").val();
                    criteria["date_to"]   = fselect.find("#filter-date-to").val();


                    $.ajax({
                        url: "_controllers/File.php",
                        type: "post",
                        data: criteria,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (returndata) {
                            resultMultiple.hide().html(returndata).fadeIn(200);
                            resultSingle.hide().html(returndata).fadeIn(200);
                        },
                        error: function(returndata){
                            resultMultiple.hide().html(returndata).fadeIn(200);
                            resultSingle.hide().html(returndata).fadeIn(200);
                        }
                    });
                    $btn.button("reset");
                });
            });


////////////////// end file scripts

/*
            $("#'.$container["type"].'_form").find(".form_submit").each(function(){
                $(this).on("click",function(event){
                    event.preventDefault();
                    //alert("2");
                    var $btn = $(this).button("loading");
                    var form = $(this).closest("#module_embeded_form");
                    var formData = new FormData(form[0]);

                    $.ajax({
                        url: form.attr("action"),
                        type: form.attr("method"),
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (returndata) {
                            form.find(".'.$container["type"].'_form_result").hide().html(returndata).fadeIn(200);
                        },
                        error: function(returndata){
                            form.find(".'.$container["type"].'_form_result").hide().html(returndata).fadeIn(200);
                        }
                    });
                    $btn.button("reset");
                });
            });

*/





</script>';}}