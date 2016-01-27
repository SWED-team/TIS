<?php
/**
 * @deprecated ModuleImage_v Trieda View-u pre kontroler ModuleImage.
 *
 * ModuleImage_v Trieda obsahuje view-y pre zobrazenie:
 *  -editora s možnosou predvyplnenia polí existujúcimi dátami
 *  -samotného modulu s možnosou zobrazenia administraèných funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 * @version 1.0
 * @author KRASNAN
 *@package package-name
 */
class ModuleImage_v
{
    public static function editor($container, $content, $url, $file, $order_options){
        echo "<h2>Module Image</h2>";
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

        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea id="description" class="form-control" rows="5" name="description"><?php echo ((isset($content["description"]))?$content["description"]:"");  ?></textarea>
            </div>
        </div>

        <?php Module_v::moduleEditorFooter($container); ?>

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



    public static function module($container, $content, $editable, $file){ ?>
        <div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">
            
            <?php if($editable){ Module_v::moduleAdministrationPanel('ModuleImage', $container, $content); } ?>
    
            <script>
                $(document).ready(function () {
                    $(".fancybox-image").fancybox({
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

            <div class="module module-image row-<?php echo $container['rows'] ;?>" style="background-image: url('<?php echo  $file["thumb-medium"]; ?>')">    
                 <div class="module-title ">
                     <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><?php echo $content['title'] ; ?></a>
                 </div>
                 <a rel="module-image" class="fancybox-image" href="<?php echo  $file["path"]; ?>" title="Open Fullscreen" fancybox-title="<?php echo  $content["title"];?>" fancybox-description="<?php echo $content["description"]; ?>" ></a>
            </div>
        </div>
    <?php
    }
}
