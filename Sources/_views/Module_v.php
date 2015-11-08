<?php
class Module_v{
  public static function moduleImage($container, $content, $file){
    ?>
    <div class="module-container col-sm-<?php echo $container['cols'] * 3 ?>">
      <div class="module module-image <?php echo $container['rows'] * 3 ?>" onclick="" style="background-image: url('<?php echo $file['thumb_medium'] ?>')">
        <div class="module-title">
          <?php echo $content['title']?>
        </div>
      </div>
    </div>
    <?php
  }
  public static function moduleFormated($container, $content){
    ?>
    <div class="module-container col-sm-<?php echo $container['cols'] * 3 ?> ">
      <div class="module module-formated-text <?php echo $container['rows'] * 3 ?>">
        <div class="module-text">
          <?php echo $content['content']?>
        </div>
      </div>
    </div>
    <?php
  }
  public static function module(){
    echo '';
  }



  public static function moduleGallery($container, $content, $images){

  }
}

?>