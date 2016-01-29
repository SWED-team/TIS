<?php
/**
 * Category_v Trieda View-u pre kontroler Category.
 *
 * Category_v Trieda obsahuje view-y pre zobrazenie:
 *  editora s možnosou predvyplnenia polí existujúcimi dátami,
 *  samotného modulu s možnosou zobrazenia administratorských funkcii.
 * Trieda taktiež obsahuje javascript pravidlá pre prácu s modulom
 *
 *
 * @version 1.0
 * @author KRASNAN
 * @package ModuleViews
 **/
class Category_v{
/**
 * View pre editáciu kategorii
 * @param  array  $content       Pole informácií o obsahu modulu
 * @param  string $url           Adresa na ktoru poslat ajax na spracovanie formuláru
 */
    public static function editor($url="", $content=null){ ?>
       <form class="form-horizontal category_form" role="form" enctype="multipart/form-data" method="post" action="<?php echo $url;?>">
            <div class="form-group">
                <label class="control-label col-sm-2" for="me-title">Title:</label>
                <div class="col-sm-10">
                    <input id="pe-title" type="text" class="form-control" name="title" value="<?php echo((isset($content["title"]))?$content["title"]:"");  ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                    <textarea id="pe-description" class="form-control" rows="5" name="description"><?php echo ((isset($content["description"]))?$content["description"]:"");  ?></textarea>
                </div>
            </div>
        
        <hr>
        <div class="form_result"></div>
        <a role="button" onclick=" return submitForm(this, '.category_form')" class="col-sm-4 form_submit btn btn-success btn-block" data-loading-text=" Saving..." autocomplete="off"><i class="fa fa-check"></i> Save</a>
        <button type="reset" class="col-sm-4 btn btn-warning btn-block"><i class="fa fa-undo"></i> Reset</button>
        <a onclick="location.reload()" class="col-sm-4 btn btn-primary btn-block"><i class="fa fa-refresh"></i></a>
    </form> 
        <?php
    }
    /**
     * Zobrazenie editacie kategórií stránok
     * @param  array  $category Pole kategórií
     */
    public static function previewEditable($category=array()){ ?>
        <div class="data-list col-xs-12 adminContent">
            <div class="row">
                <a class=" col-xs-12 btn btn-primary" title="Create new page" onclick="addCategory()"><i class=" fa fa-plus"></i> Create new category </a>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <h4>Title</h4>
                </div>
                <div class="col-xs-5 text-center">
                    <h4>Desription</h4>
                </div>
                <div class="col-xs-3 text-center">
                    <h4>Open / Edit / Delete</h4>
                </div>                
            </div>
            <?php
            $cnt=0;
            foreach ($category as $key => $c) {
                $cnt++;
                ?>
            <div class="row bordered">
                <div class="col-xs-4 page-list-info">
                        <?php 
                        echo "<small class='text-muted'>#".$cnt ." </small> ". $c["title"];
                        ?>
                </div>
                <div class="col-xs-5">
                        <?php 
                        echo  $c["description"];
                        ?>
                </div>

                <div class="col-xs-3 pull-right">
                    <a href="?category=<?php echo $c["id"];?>" class="col-sm-offset-1 col-sm-3 col-xs-12 btn-xs btn btn-primary" title="Open Category." ><i class=" fa  fa-arrow-circle-right"></i></a>
                    <a class="col-sm-offset-1 col-sm-3 col-xs-12 btn-xs btn btn-warning" title="Edit this category." onclick="updateCategory( <?php echo $c["id"];?>)"><i class=" fa fa-pencil-square-o"></i></a>
                    <a class="col-sm-offset-1 col-sm-3 col-xs-12 btn-xs btn btn-danger" title="Delete this category." onclick="deleteCategory( <?php echo $c["id"];?>)"><i class=" fa fa-trash"></i></a>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    <?php 
    }
}

