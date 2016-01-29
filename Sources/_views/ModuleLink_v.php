<?php
/**
 * ModuleLink_v Trieda View-u pre kontroler ModuleLink.
 *
 * ModuleLink_v Trieda obsahuje view-y pre zobrazenie:
 *  -editora s možnosou predvyplnenia polí existujúcimi dátami
 *  -samotného modulu s možnosou zobrazenia administratorských funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 */
class ModuleLink_v{
    /**
     * View pre editor modulu
     * @param  array  $container     Pole informácií o zakládných vlastnostiach modulu
     * @param  array  $content       Pole informácií o obsahu modulu
     * @param  string $url           Adresa na ktoru poslat ajax na spracovanie formuláru
     * @param  array  $file          Pole informáci o obrázku modulu
     * @param  array  $order_options Pole zoznamu pozici na page
     * @param  array  $pages         Pole zoznamu interných stránok
     */
    public static function editor($container=array(), $content=array(), $url="", $file=array(), $order_options=array(), $pages=array()){
        echo "<h2>Module Link</h2>";
        Module_v::moduleEditorHeader($container, $order_options, $url);
        ?>
        <div class="form-group">
            <label class="control-label col-sm-2" for="me-title">Title:</label>
            <div class="col-sm-10">
                <input id="me-title" type="text" class="form-control" name="title" value="<?php echo((isset($content["title"]))?$content["title"]:"");  ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea id="description" class="form-control" rows="5" name="description"><?php echo ((isset($content["description"]))?$content["description"]:"");  ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Link Type:</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                  <input id="me-internal" type="radio" name="type" value="internal" <?php echo((isset($content["page_id"]) && $content["page_id"]>0)?"checked":"");  ?>>Internal
                </label>
                <label class="radio-inline">
                  <input id="me-external" type="radio" name="type" value="external" <?php echo((isset($content["link"]) && $content["link"]!="")?"checked":"");  ?>>External
                </label>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-sm-2" for="me-link">External link:</label>
            <div class="col-sm-10">
                <input id="me-link" type="text" class="form-control" name="link" value="<?php echo((isset($content["title"]))?$content["link"]:"");  ?>" placeholder="http://">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="me-page_id">Select Page:</label>
            <div class="col-sm-10">
                <select id="me-page_id" class="combobox form-control" name="page_id">
                  <option></option>
                  <?php
                    foreach ($pages as $key => $p) {
                        echo '<option ' .(($p["id"] == $content["page_id"]) ? "selected" : "" ). ' value="'.$p["id"].'">id: '.$p["id"].' | title: '.$p["title"]. " | author: " .$p["author"].'</option>';
                    }
                  ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Repr. image:</label>
            <div class="col-sm-10 ">
                <div class="files-actual bordered">
                    <!-- files from file manager container -->
                </div>
            </div>
        </div>

        <div class="file-actual-buttons form-group">
            <input id="newFilePath" class="hiddenSection" type="text" value="">
            <div class="col-sm-5 col-xs-6  col-sm-offset-2">
                <a href="javascript:open_popup('1')" class="btn btn-warning col-md-5 btn-block  btn-xs" type="button"><i class="fa fa-pencil-square"> </i> Change Image</a>
            </div>
            <div class="col-sm-5 col-xs-6 ">
                <button title="Remove selected items" type="button"  onclick="removeSelectedItemsFrom('.files-actual')" class="actual-remove btn btn-danger col-md-5 btn-block  btn-xs" data-loading-text="working..." autocomplete="off"><i class="fa fa-minus-square"> </i> Remove</button>
            </div>
        </div>



        <?php Module_v::moduleEditorFooter($container); ?>

        <script type="text/javascript">
            //javascript funkcie na pracu s formularom modulu
            $(document).ready(function(){
                $('.combobox').combobox({bsVersion: '3'});
            });
            //callback funkcia filemanagera
            function responsive_filemanager_callback(field_id) {
                handleFile(field_id,false, false, [])
            }

            <?php
            //naplnenie existujucim pri otvoreni editora
                if(isset($file["path"])&&isset($file["thumb"]))
                    echo "$('.files-actual').html(preview('".basename($file["path"])."', '".$file["path"]."', '".$file["thumb"]."', '".$file["thumb-medium"]."'));";
            ?>

            //skryvanie sekcii externy link / interna page
            function checkLinkType(){
                if($("#me-internal").is(":checked")){
                    $("#me-link").parent().parent().addClass("hiddenSection");
                    $("#me-page_id").parent().parent().removeClass("hiddenSection");
                }
                else if($("#me-external").is(":checked")){
                    $("#me-page_id").parent().parent().addClass("hiddenSection");
                    $("#me-link").parent().parent().removeClass("hiddenSection");
                }
                else{
                    $("#me-link").parent().parent().addClass("hiddenSection");
                    $("#me-page_id").parent().parent().addClass("hiddenSection");
                }
            }

            checkLinkType();

            $("input[name='type']").on("change", function(){
                checkLinkType();
            });

        </script>

    <?php
    }
    /**
     * View pre samotné zobrazenie modulu na stránke
     * @param  array   $container Pole informácií o zakládných vlastnostiach modulu
     * @param  array   $content   Pole informácií o obsahu modulu
     * @param  boolean $editable  Ak true modul sa zobrazí v editovateľnom
     * @param  array   $file      Pole informáci o obrázku modulu
     */
    public static function module($container=array(), $content=array(), $editable=false, $file=array()){ ?>
        <div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">
            <?php if($editable){ Module_v::moduleAdministrationPanel('ModuleLink', $container, $content); } ?>
            <script type="text/javascript">
                //javascript funkcie na pracu s modulom
            </script>


            <div class="module module-link  row-<?php echo $container['rows'] ;?>" >  
               <div class="module-link-image" style="background-image: url('<?php echo  $file["thumb-medium"]; ?>')"> </div>
               <div class="module-title ">
                     <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><?php echo $content['title'] ; ?></a>
               </div>
               <div class="module-link-text">
                   <?php echo $content['description'] ; ?>
               </div>
                <div class="module-link-category">
                   category
               </div>
               <a href="<?php echo ($content['page_id']!='')? './?page='.$content['page_id']:$content['link'].'" target="_blank' ; ?>" class="btn-primary module-link-href">
                   Open
               </a>
            </div>
        </div>
    <?php
    }
}

?>