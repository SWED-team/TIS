<?php
class Module_v{
  public static function moduleImage($container, $content, $file){
    //modul s obrazkom a titulkou//
    echo '<div class="module-container col-sm-'. $container['cols'] * 3 .'">';
    echo '  <div class="module module-image $container["rows"]" style="background-image: url('.$file['thumb_medium'].')">';
    echo '    <div class="module-title">'.$content['title'].'</div></div></div>';
  }
  public static function moduleFormated($container, $content){

  }



  public static function moduleGallery($container, $content, $images){

  }
}

?>