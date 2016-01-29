<?php

/**
 *  Module_v Trieda View-u pre kontroler Module.
 *
 *  Module_v Trieda obsahuje view-y pre zobrazenie:
 *  editora s možnosou predvyplnenia polí existujúcimi dátami,
 *  samotného modulu s možnosou zobrazenia administratorských funkcii.
 *  Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 * 
 * 
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 */


class Module_v{
  /**
   *  *Funkcia vypisujúca view pre hlavičku formulára na pridávanie/editovanie modulov
   *
   *  View poskytuje možnosti na editovanie informácií obálky modulu ako 
   *
   * 
   *  * rows   - výška (počet riadkov modulu zobrazených na mriežke stránky) 
   *
   * 
   *  * cols   - šírka (počet stĺpcov modulu zobrazených na mriežke stránky) 
   *
   * 
   *  * status - publikovaný/nepublikovaný modul
   *  * order  - poradie modulu na stránke
   *
   * 
   * @param  array  $container     Pole informácií o zakládných vlastnostiach modulu
   * @param  array  $order_options [description]
   * @param  string $url           [description]
   */
  public static function moduleEditorHeader($container=array(), $order_options=array(), $url=''){ ?>
    <form class="<?php echo $container["type"];  ?>_form form-horizontal" role="form" enctype="multipart/form-data" method="post"
          action="<?php echo $url;?>">
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
                <select id="me-order" class="form-control" name="order">
                    <?php
                    echo $order_options;
                    ?>
                </select>
            </div>
        </div>
        <h4 class="text-muted "> Module Content Data</h4>
        <hr>
  <?php
  }

  /**
   * Funkcia vypisujúca view pre pätu formulára na pridávanie/editovanie modulov
   *
   * View obsahuje tlačidlá na uloženie, resetovanie formulára a refresh aktuálnej stránky
   *
   * 
   * @param  array $container informácie o obálke modulu
   */
  public static function moduleEditorFooter($container=array()){ ?>
        <hr>
        <div class="form_result"></div>
        <a role="button" onclick="selectAllCheckboxesFrom('.files-actual') ; return submitForm(this, '.<?php echo $container['type'];?>_form')" class="form_submit btn btn-success btn-block" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</a>
        <button type="reset" class="btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
        <a onclick="location.reload()" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>

    </form>
  <?php
  }

  /**
   * Funkcia vypisujúca view pre administráciu modulu v jeho náhľade
   *
   * View obsahuje tlačidlo na otvorenie editora, tlačidlo na vymazanie modulu a súhrnné informácie o module
   * 
   * @param   array $container informácie o obálke modulu
   * @param   array $content   informácie o obsahu modulu
   * @param   string $class    trieda modulu do ktorej sa ma volat ajax funkcia na zobrazenie administratorskych informacii o module
   */
  public static function moduleAdministrationPanel($class='', $container=array(), $content=array()){ ?>
    <div class="module-buttons">
        <div class="row">
            <div class="col-xs-6">
                <?php echo($container["status"]==1?"<i class=\"fa fa-eye\"></i>":"<i class=\"fa fa-eye-slash\"></i>").' #'.$container["id"];?>
            </div>
            <div class="col-xs-6">
                <span class="pull-right">
                    <a onclick="updateModule('<?php echo $class;?>', <?php echo $container["id"];?>)"><i class="fa fa-pencil-square-o"></i></a>
                    <a onclick="deleteModule('<?php echo $class;?>', <?php echo $container["id"];?>)"><i class="fa fa-trash"></i></a>
                </span>
            </div>
        </div><?php /*
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
        </div> */ ?>
    </div>

    <?php
  }

}

?>