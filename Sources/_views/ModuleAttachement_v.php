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
class ModuleAttachement_v
{
    public static function editor($container, $content, $url, $file,$order_options){
        echo "<h2>Module Attachement</h2>";
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
                <button title="Select/Unselect All Items" type="button"  onclick="selectUnselectAllCheckboxesFrom('.files-actual')" class="actual-remove btn btn-primary col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-check-square"> </i></button>
            </div>
            <div class="col-sm-5 col-xs-6 ">
                <a title="Open filemanager and select files to insert" href="javascript:open_popup('filemanager/dialog.php?popup=1&type=2&amp;field_id=newFilePath&amp;relative_url=1')" class="btn btn-success col-md-5 btn-block  btn-xs" type="button"><i class="fa fa-plus-square"> </i> Add Files</a>
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
            // callback funkcia filemanagera
            function responsive_filemanager_callback(field_id) {
                handleFile(field_id,true, true, ["all"])
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
            
            <?php if($editable){ Module_v::moduleAdministrationPanel('ModuleAttachement', $container, $content); } ?>

            <script>
                $(function () {
                  $('[data-toggle="popover"]').popover()
                })
            </script>

            <div class="module-attachement  row-<?php echo $container['rows'] ;?> module">
                <div class="module-title ">
                    <a class="help" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><?php echo $content['title'] ; ?></a>
                </div>
                <div class="col-xs-12 attachements">
                
                <?php for($i=0;$i<count($file);$i++){ ?>
                    <div class="bordered">
                        <div class="row">
                            <div class="col-xs-3 result-file-preview" style="background-image:url('<?php echo $file[$i]['thumb'] ;?>')"></div>
                            <a class="col-xs-9 attachement-text" download="" href="<?php echo $file[$i]['path'] ;?>" title="' + filename + '"><i class="fa fa-2x fa-download"></i> <?php echo $file[$i]['title'] ;?></a>
                            <a class="col-xs-9 attachement-text" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<?php echo $file[$i]['description'] ;?>"><i class="fa fa-2x fa-question-circle"></i> <?php echo $file[$i]['description'] ;?></a>

                        </div>
                    </div>
                <?php } ?>

                </div>
            </div>
        </div>
<?php
    }
}
