<?php
class ModuleFormated_v{
	public static function editor($container, $content, $url, $order_options){
        echo "<h2>Module Formated</h2>";
        Module_v::moduleEditorHeader($container, $order_options, $url);
        ?>
        <div class="form-group">
            <!--<label class="control-label col-sm-2" for="content">Content:</label>-->
            <div class="col-sm-10">
                <textarea id="content" class="form-control formated" rows="10" name="content"><?php echo((isset($content["content"]))?$content["content"]:"");?></textarea>
            </div>
        </div>

        <?php Module_v::moduleEditorFooter($container); ?>

        <script>/*
            tinymce.init({
                height:500,
                selector: ".formated",
                //theme: "modern",
                //skin: 'light',
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                     "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                     "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
                ],
                toolbar1: "undo redo | styleselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
                toolbar2: "| filemanager | link unlink | image media | forecolor backcolor  | print preview code ",
                image_advtab: true,

                external_filemanager_path: "/TIS/Sources/filemanager/",
                filemanager_title: "Filemanager",
                external_plugins: { "filemanager": "/TIS/Sources/filemanager/plugin.min.js" },

                content_css: ["./css/format.css"]
            });*/
        </script>
        <?php
    }
    public static function module($container, $content, $editable, $file){ ?>
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