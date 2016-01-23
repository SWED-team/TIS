<?php
/**
 * ModuleImage_v Trieda View-u pre kontroler ModuleImage.
 *
 * ModuleImage_v Trieda obsahuje view-y pre zobrazenie:
 *  -editora s možnosou predvyplnenia polí existujúcimi dátami
 *  -samotného modulu s možnosou zobrazenia administraèných funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 * @version 1.0
 * @author KRASNAN
 */
class ModuleGallery_v
{
    public static function editor($container, $content, $url, $file,$order_options){
        echo "<h2>Module Gallery</h2>";
        Module_v::moduleEditorHeader($container, $order_options, $url);
        ?>
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
            <div class="col-sm-1 col-xs-1  col-sm-offset-2">
                <button title="Select/Unselect All Items" type="button"  onclick="selectUnselectAllCheckboxesFrom('.files-actual')" class="actual-remove btn btn-primary col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-check-square"></i></button>
            </div>
            <div class="col-sm-5 col-xs-6 ">
                <a title="Open filemanager and select files to insert" href="javascript:open_popup('filemanager/dialog.php?popup=1&type=1&amp;field_id=newFilePath&amp;relative_url=1')" class="btn btn-success col-md-5 btn-block  btn-xs" type="button"><i class="fa fa-plus-square"> </i> Add Files</a>
            </div>
            <div class="col-sm-4 col-xs-4 ">
                <button title="Remove selected items" type="button"  onclick="removeSelectedItemsFrom('.files-actual')" class="actual-remove btn btn-danger col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-minus-square"> </i> Remove</button>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea id="description" class="form-control" rows="5" name="description"><?php echo ((isset($content["description"]))?$content["description"]:"");  ?></textarea>
            </div>
        </div>

        <?php Module_v::moduleEditorFooter($container); ?>

        <script type="text/javascript">
            //callback funkcia filemanagera
            function responsive_filemanager_callback(field_id) {
                handleFile(field_id,true, true, ["jpg", "jpeg", "gif", "png"])
            }
            <?php
            //naplnenie existujucimi po otvoreni editora
                if( isset($file) && count($file)>0 ){
                    for($i=0;$i<count($file);$i++){
                        echo "$('.files-actual').append(previewEditable('".$file[$i]["title"]."','".$file[$i]["description"]."', '".$file[$i]["path"]."', '".$file[$i]["thumb"]."', '".$file[$i]["thumb-medium"]."'));";
                    }
                }
            ?>
        </script>
        
        <?php
    }

    
    public static function module($container, $content, $editable, $file){ ?>
        <div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">
            
            <?php if($editable){ Module_v::moduleAdministrationPanel('ModuleGallery', $container, $content); } ?>

            <script>
                $(document).ready(function () {
                    $(".fancybox-gallery").fancybox({
                        afterLoad: function () {
                            this.title = "<i class='fa fa-tag'></i> <strong>" + $(this.element).attr('fancybox-title') + "</strong><br>";
                            this.title += "<i class='fa fa-info-circle'></i> " + $(this.element).attr('fancybox-description') + "<br>";
                            this.title += "<a download='' href=" + this.href + "><i class='fa fa-download'></i>Download</a><br>";
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
            <div id="module-gallery-<?php echo $container['id'] ;?>" class="row-<?php echo $container['rows'] ;?> module carousel module-gallery slide article-slide vertical-center" data-ride="carousel">
                <div class="module-title ">
                    <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><?php echo $content['title'] ; ?></a>
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
