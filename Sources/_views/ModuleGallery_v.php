<?php
/**
 * ModuleImage_v Trieda View-u pre kontroler ModuleImage.
 *
 * ModuleImage_v Trieda obsahuje view-y pre zobrazenie:
 *  -editora s možnosťou predvyplnenia polí existujúcimi dátami
 *  -samotného modulu s možnosťou zobrazenia administračných funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 * @version 1.0
 * @author KRASNAN
 */
class ModuleGallery_v
{
    public static function editor($container, $content, $operation, $file){
        $url = '_controllers/ModuleGallery.php?';
		if(isset($operation))
			$url = $url.$operation.'=true&';
		if(isset($_GET["page_id"]) && $_GET["page_id"]!=0)
			$url = $url.'page_id='.$_GET["page_id"].'&';
		if(isset($container["id"]) && $container["id"]!=0)
			$url = $url.'id='.$container["id"].'&';
?>

<form class="<?php echo $container["type"];  ?>_form form-horizontal" role="form" enctype="multipart/form-data" method="post"
      action="<?php echo $url;?>">
    <h1>Gallery</h1>
    <h4 class="text-muted "> Module Container Data</h4>
    <hr>

    <div class="form-group">
        <label class="control-label col-sm-2" for="cols">Width:</label>
        <div class="col-sm-4">
            <select id="cols" class="form-control" name="cols">
                <option value="1" <?php echo  ((isset($container["cols"]) && $container["cols"]==1)?"selected":"");  ?>>1 column</option>
                <option value="2" <?php echo  ((isset($container["cols"]) && $container["cols"]==2)?"selected":"");  ?>>2 columns</option>
                <option value="3" <?php echo  ((isset($container["cols"]) && $container["cols"]==3)?"selected":"");  ?>>3 columns</option>
                <option value="4" <?php echo  ((isset($container["cols"]) && $container["cols"]==4)?"selected":"");  ?>>4 columns</option>
            </select>
        </div>
        <label class="control-label col-sm-2" for="rows">Height:</label>
        <div class="col-sm-4">
            <select id="rows" class="form-control col-sm-2" name="rows">
                <option value="1" <?php echo  ((isset($container["rows"]) && $container["rows"]==1)?"selected":"");  ?>>1 row</option>
                <option value="2" <?php echo  ((isset($container["rows"]) && $container["rows"]==2)?"selected":"");  ?>>2 rows</option>
                <option value="3" <?php echo  ((isset($container["rows"]) && $container["rows"]==3)?"selected":"");  ?>>3 rows</option>
                <option value="4" <?php echo  ((isset($container["rows"]) && $container["rows"]==4)?"selected":"");  ?>>4 rows</option>
                <option value="0" <?php echo  ((isset($container["rows"]) && $container["rows"]==0)?"selected":"");  ?>>auto</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="status">Status:</label>
        <div class="col-sm-4">
            <select id="status" class="form-control" name="status">
                <option value="0" <?php echo ((isset($container["status"]) && $container["status"]==0)?"selected":"");  ?>>Hidden</option>
                <option value="1" <?php echo ((isset($container["status"]) && $container["status"]==1)?"selected":"");  ?>>Published</option>
            </select>
        </div>
        <label class="control-label col-sm-2" for="me-order">Order:</label>
        <div class="col-sm-4">
            <input id="me-order" type="number" class="form-control" name="order" min="0" value="<?php echo ((isset($content["order"]))?$content["order"]:"");  ?>">
        </div>
    </div>

    <h4 class="text-muted "> Module Content Data</h4>
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="me-title">Title:</label>
        <div class="col-sm-10">
            <input id="me-title" type="text" class="form-control" name="title" value="<?php echo((isset($content["title"]))?$content["title"]:"");  ?>">
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-sm-2">Actual files:</label>
        <div class="col-sm-10 ">
            <div class="files-actual bordered">


            </div>
        </div>
    </div>

    <div class="file-actual-buttons form-group">
        <input id="newFilePath" class="hiddenSection" type="text" value="">
        <div class="col-sm-5 col-xs-6  col-sm-offset-2">
            <a href="javascript:open_popup('./filemanager/dialog.php?popup=1&type=1&amp;field_id=newFilePath&amp;relative_url=1')" class="btn btn-success col-md-5 btn-block  btn-xs" type="button"><i class="fa fa-plus-square"> </i> Add Image</a>
        </div>
        <div class="col-sm-5 col-xs-6 ">
            <button type="button" class="actual-remove btn btn-danger col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-minus-square"> </i> Remove Selected Files</button>
        </div>
    </div>






    <div class="form-group">
        <label class="control-label col-sm-2" for="description">Description:</label>
        <div class="col-sm-10">
            <textarea id="description" class="form-control" rows="5" name="description"><?php echo ((isset($content["description"]))?$content["description"]:"");  ?></textarea>
        </div>
    </div>

    <div class="form_result"></div>
    <button type="submit" class="form_submit btn btn-success btn-block" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</button>
    <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
    <a onclick="location.reload()" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>

</form>
<script>
    //--------- funkcie na pracu s filemanagerom --------- START
    function UrlExists(url) {
        var http = new XMLHttpRequest();
        http.open('HEAD', url, false);
        http.send();
        return http.status != 404;
    }

    function responsive_filemanager_callback(field_id) {
        var url = jQuery("#" + field_id).val();
        var filename = url.replace(/^.*[\\\/]/, "");
        var ext = filename.split(".").pop();
        var path = "files/" + url;
        if (UrlExists("filesthumb/" + url)) {
            var thumb = "filesthumb/" + url;
            var thumb_medium = "filesthumb_medium/" + url;
        }
        else if (UrlExists("img/ico/" + ext + ".jpg")) {
            var thumb = "img/ico/" + ext + ".jpg";
            var thumb_medium = thumb;
        }
        else {
            var thumb = "img/ico/default.jpg";
            var thumb_medium = thumb;
        }
        $(".files-actual").append(previewEdit(filename, "", path, thumb, thumb_medium));

    }

    function previewEdit(title, description, path, thumb, thumb_medium) {
        return '\
                        <label class="col-xs-12">\
                            <input class="hiddenSection" name="file-path[]" type="checkbox" value="' + path + '">\
                            <div class="row">\
                                <input class="hiddenSection" name="file-thumb[]" type="text" value="' + thumb + '">\
                                <input class="hiddenSection" name="file-thumb-medium[]" type="text" value="' + thumb_medium + '">\
                                <div class="col-xs-3 result-file-preview" style="background-image:url(\''+ thumb + '\')"></div>\
                                <div class="col-xs-9 "><input name="file-title[]" placeholder="title"  class="form-control" type="text" value="'+ title + '"></div>\
                                <div class="col-xs-9 "><input name="file-description[]" placeholder="description" class="form-control" type="text" value="' + description + '"></div>\
                            </div>\
                        </label>\
                                        ';
    }


    function preview(filename, path, thumb, thumb_medium) {
        return '\
                        <label class="col-xs-12">\
                            <input class="hiddenSection" name="file-path[]" type="checkbox" value="' + path + '">\
                            <div class="row">\
                                <input class="hiddenSection" name="file-thumb[]" type="text" value="' + thumb + '">\
                                <input class="hiddenSection" name="file-thumb-medium[]" type="text" value="' + thumb_medium + '">\
                                <div class="col-xs-3 result-file-preview" style="background-image:url(\'' + thumb_medium + '\')"></div>\
                                <div class="col-xs-9 "><a href="'+ path + '" target="_blank" title="' + filename + '">' + filename + '</a></div>\
                                <div class="col-xs-9 "></div>\
                            </div>\
                        </label>';
    }

<?php
        if( isset($file) && count($file)>0 ){
            for($i=0;$i<count($file);$i++){
                echo "$('.files-actual').append(previewEdit('".$file[$i]["title"]."','".$file[$i]["description"]."', '".$file[$i]["path"]."', '".$file[$i]["thumb"]."', '".$file[$i]["thumb-medium"]."'));";
            }
        }
            //echo "$('.files-actual').html(preview('".basename($file["path"])."', '".$file["path"]."', '".$file["thumb"]."', '".$file["thumb-medium"]."'));";
    ?>


    function open_popup(url) {
        var w = window.innerWidth - window.innerWidth / 15;
        var h = window.innerHeight - window.innerHeight / 8;
        var l = Math.floor((screen.width - w) / 2);
        var t = Math.floor((screen.height - h) / 2);
        var win = window.open(url, "ResponsiveFilemanager", "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
    }
    //--------- funkcie na pracu s filemanagerom --------- END

    //--------- funkcie formulara --------- START
    $(".<?php echo $container['type'];?>_form").find("[type=\'submit\']").each(function () {
        $(this).on("click", function (event) {
            event.preventDefault();

            var $btn = $(this).button("loading");
            var form = $(this).closest(".<?php echo $container['type'];?>_form");
            form.find(".files-actual input[type='checkbox']").each(function () {
                $(this).attr('checked', true);
            });
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    form.find(".form_result").hide().html(returndata).fadeIn(200);
                },
                error: function (returndata) {
                    form.find(".form_result").hide().html(returndata).fadeIn(200);
                }
            });
            $btn.button("reset");
        });
    });
    //--------- funkcie formulara --------- END
    //remove actual
    $(".<?php echo $container['type'];?>_form").find(".actual-remove").each(function () {
        $(this).on("click", function (event) {
            event.preventDefault();
            var $btn = $(this).button("loading");
            var form = $(this).closest(".<?php echo $container['type'];?>_form");
            var selected = form.find("input[name^=\'file-path\']:checked");
            selected.each(function () {
                $(this).parent().remove();
            });
            $btn.button("reset");
        });
    });

</script>

<?php
    }
    public static function module($container, $content, $editable, $file){
?>
<div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">
    <?php
        if($editable){
    ?>
    <div class="module-buttons">
        <div class="row">
            <div class="col-xs-6">
                <?php echo($container["status"]==1?"<i class=\"fa fa-eye\"></i>":"<i class=\"fa fa-eye-slash\"></i>").' #'.$container["id"];?>
            </div>
            <div class="col-xs-6">
                <span class="pull-right">
                    <a onclick="updateModuleGallery(<?php echo $container["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                    <a onclick="deleteModuleGallery(<?php echo $container["id"];?>)"><i class="fa fa-trash"></i></a>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Child ID:</strong>
            </div>
            <div class="col-xs-8"><?php echo $content["id"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Page:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["page_id"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Type:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["type"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Created:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["created"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Created By:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["created_by"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Edited:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["edited"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Edited By:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["edited_by"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Order:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["order"];?></div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <strong>Status:</strong>
            </div>
            <div class="col-xs-8"><?php echo $container["status"];?></div>
        </div>
    </div>
    <script>
        function updateModuleGallery(id) {
            $.ajax({
                url: "_controllers/ModuleGallery.php?show_editor=true",
                data: { "id": id },
                type: "post",
                success: function (result) {
                    $("#modal-box-content").html(result);
                    $("#modal-box").modal();
                }
            });
        }
        function deleteModuleGallery(id) {
            if (confirm("Do you really want to remove this module?")) {
                $.ajax({
                    url: "_controllers/ModuleGallery.php?delete=true",
                    data: { "id": id },
                    type: "post",
                    success: function (result) {
                        $.fancybox({
                            'modal': true,
                            'content': result + '<a href="javascript:;" onclick="$.fancybox.close();">CLOSE</a>'
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function (result) {
                        $.fancybox({
                            'modal': true,
                            'content': result + '<a href="javascript:;" onclick="$.fancybox.close();">CLOSE</a>'
                        });
                    }
                });
            }
        }

        $(document).ready(function () {
            $(".fancybox-gallery").fancybox({
                afterLoad: function () {
                    this.title = "<i class='fa fa-tag'></i> <strong>" + $(this.element).attr('fancybox-title') + "</strong><br>";
                    this.title += "<i class='fa fa-info-circle'></i> " + $(this.element).attr('fancybox-description') + "<br>";
                    this.title += "<a download='' href=" + this.href + "><i class='fa fa-download'></i></a><br>";
                },

                padding: 5,
                prevEffect: 'elastic',
                nextEffect: 'elastic',
                helpers: {
                    title: {
                        type: 'over'
                    }
                }

            });
        });
    </script>
    <?php
        }
    ?>
    <div id="module-gallery-<?php echo $container['id'] ;?>" class="row-<?php echo $container['rows'] ;?> module carousel module-gallery slide article-slide vertical-center" data-ride="carousel">
        <div class="module-title ">
            <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><i class="fa fa-hashtag"></i><?php echo $content['title'] ; ?></a>
        </div>
        <!-- Wrapper for slides -->
        <div class="carousel-inner cont-slider">
            <?php for($i=0;$i<count($file);$i++){ ?>
            <a rel="module-gallery-<?php echo $container['id'] ;?>" class="fancybox-gallery item <?php if($i==0) echo "active" ?>" href="<?php echo  $file[$i]["path"]; ?>" fancybox-title="<?php echo  $file[$i]["title"];?>" fancybox-description="<?php echo $file[$i]["description"]; ?>">
                <img class="img-responsive center-block" alt="" title="<?php echo $file[$i]["title"];?>" src="<?php echo $file[$i]["thumb-medium"];?>">
            </a>
            <?php } ?>

        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">

            <?php for($i=0;$i<count($file);$i++){ ?>
            <li class="<?php if($i==0) echo "active" ?>" data-slide-to="<?php echo $i; ?>" data-target="#module-gallery-<?php echo $container['id'] ;?>">
                <img class="img-responsive center-block" title="<?php echo $file[$i]["title"];?>" src="<?php echo $file[$i]["thumb"];?>">
            </li>
            <?php } ?>
        </ol>

        <a class="left carousel-control" href="#module-gallery-<?php echo $container['id'] ;?>" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#module-gallery-<?php echo $container['id'] ;?>" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<?php
    }
}
