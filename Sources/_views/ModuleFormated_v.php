<?php
/**
 * ModuleFormated_v Trieda View-u pre kontroler ModuleFormated.
 *
 * ModuleFormated_v Trieda obsahuje view-y pre zobrazenie:
 * editora s možnosou predvyplnenia polí existujúcimi dátami,
 * samotného modulu s možnosou zobrazenia administratorských funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 * 
 */
class ModuleFormated_v{
    /**
     * View pre editor modulu
     * @param  array  $container     Pole informácií o zakládných vlastnostiach modulu
     * @param  array  $content       Pole informácií o obsahu modulu
     * @param  string $url           Adresa na ktoru poslat ajax na spracovanie formuláru
     * @param  array  $order_options Pole zoznamu pozici na page
     */
    public static function editor($container=array(), $content=array(), $url="", $order_options=array()){
        echo "<h2>Module Formated</h2>";
        Module_v::moduleEditorHeader($container, $order_options, $url);
        ?>
            <!--<label class="control-label col-sm-2" for="content">Content:</label>-->
            
            <div class="modal-body">
               <!-- <textarea id="tinare"  ows="10" name="content"><?php echo((isset($content["content"]))?$content["content"]:"");?></textarea>-->
               <textarea name="content" id="editor1" rows="10" cols="80"><?php echo((isset($content["content"]))?$content["content"]:"");?></textarea>
            </div>

        <?php Module_v::moduleEditorFooter($container); ?>

        <script>

            CKEDITOR.replace( 'editor1' ,
            {
                toolbar: 'MyToolbar',
                filebrowserBrowseUrl : './filemanager/dialog.php?type=1&editor=ckeditor&relative_url=0&fldr=./files/',
                filebrowserImageBrowseUrl : './filemanager/dialog.php?type=1&editor=ckeditor&relative_url=0&fldr=/files/&akey=189dqwSdq1q32SdFeec6S4486aASdcxQ432s1S3121S1445DED8713ADWEX84321159ASsaasd'
            });

        $.fn.modal.Constructor.prototype.enforceFocus = function() {
          modal_this = this
          $(document).on('focusin.modal', function (e) {
            if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length 
            && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
            && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
              modal_this.$element.focus()
            }
          })
        };
        
        </script>
        <?php
    }
    /**
     * View pre samotné zobrazenie modulu na stránke
     * @param  array   $container Pole informácií o zakládných vlastnostiach modulu
     * @param  array   $content   Pole informácií o obsahu modulu
     * @param  boolean $editable  Ak true modul sa zobrazí v editovateľnom
     */
    public static function module($container=array(), $content=array(), $editable=false){ ?>
        <div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">
            
            <?php if($editable){ Module_v::moduleAdministrationPanel('ModuleFormated',$container, $content); } ?>
            
            <div class="module-formated module row-<?php echo $container['rows'] ?>">
                <div class="container">            
                <?php echo  $content['content']?></div>
            </div>
        </div>
    <?php
    }
}
?>