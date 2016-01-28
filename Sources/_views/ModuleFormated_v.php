<?php
class ModuleFormated_v{
	   public static function editor($container, $content, $url, $order_options){
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

            CKEDITOR.replace( 'editor1' ,{
                filebrowserBrowseUrl : './filemanager/dialog.php?type=2&editor=ckeditor&akey=189dqwSdq1q32SdFeec6S4486aASdcxQ432s1S3121S1445DED8713ADWEX84321159ASsaasd',
                filebrowserImageBrowseUrl : './filemanager/dialog.php?type=1&editor=ckeditor&akey=189dqwSdq1q32SdFeec6S4486aASdcxQ432s1S3121S1445DED8713ADWEX84321159ASsaasd'
            });


    
        </script>
        <?php
    }
    public static function module($container, $content, $editable){ ?>
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