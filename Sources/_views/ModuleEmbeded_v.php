<?php
/**
 * ModuleEmbeded_v Trieda View-u pre kontroler ModuleEmbeded.
 *
 * ModuleEmbeded_v Trieda obsahuje view-y pre zobrazenie:
 * editora s možnosou predvyplnenia polí existujúcimi dátami,
 * samotného modulu s možnosou zobrazenia administratorských funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 */
class ModuleEmbeded_v{
    /**
     * View pre editor modulu
     * @param  array  $container     Pole informácií o zakládných vlastnostiach modulu
     * @param  array  $content       Pole informácií o obsahu modulu
     * @param  string $url           Adresa na ktoru poslat ajax na spracovanie formuláru
     * @param  array  $order_options Pole zoznamu pozici na page
     */
	public static function editor($container=array(), $content=array(), $url="", $order_options=array()){
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
    /**
     * View pre samotné zobrazenie modulu na stránke
     * @param  array   $container Pole informácií o zakládných vlastnostiach modulu
     * @param  array   $content   Pole informácií o obsahu modulu
     * @param  boolean $editable  Ak true modul sa zobrazí v editovateľnom
     * @param  array   $file      Pole informáci o obrázku modulu
     */
    public static function module($container=array(), $content=array(), $editable=false, $file=array()){ ?>
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