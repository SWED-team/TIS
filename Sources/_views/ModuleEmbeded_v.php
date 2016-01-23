<?php
class ModuleEmbeded_v{
	public static function editor($container, $content, $url, $order_options){
        echo "<h2>Module Embeded</h2>";
        Module_v::moduleEditorHeader($container, $order_options, $url);
        ?>

        <div class="form-group">
            <label class="control-label col-sm-2" for="me-title">Title:</label>
            <div class="col-sm-10">
                <input id="me-title" type="text" class="form-control" name="title" value="<?php echo((isset($content["title"]))?$content["title"]:"");  ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="link">Embeded link:</label>
            <div class="col-sm-10">
                <textarea id="link" class="form-control" rows="5" name="link"><?php echo((isset($content["link"]))?$content["link"]:"");  ?></textarea>
                <small class="text-muted">Embeded link must contains valid	&lt;iframe&gt; tag.</small>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea id="description" class="form-control" rows="5" name="description"><?php echo((isset($content["description"]))?$content["description"]:"");?></textarea>
            </div>
        </div>

        <?php Module_v::moduleEditorFooter($container); ?>
        

        <?php
    }
    public static function module($container, $content, $editable, $file){ ?>
        <div class="module-container col-sm-<?php echo $container['cols'] * 3 ;?>">
            <?php
            if($editable){
                Module_v::moduleAdministrationPanel('ModuleEmbeded',$container, $content);
            }
            ?>
            <script>
      
            </script>
            <div class="module-embeded module row-<?php echo $container['rows'] ?>">
                <div class="module-title ">
                    <a role="button" class="help" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<?php echo strtoupper($content['title']) ; ?>" data-content="<?php echo $content['description'] ;?>"><?php echo $content['title'] ; ?></a>
                </div>
                <?php echo  $content['link']?>
            </div>
        </div>
        <?php
  }
}
?>