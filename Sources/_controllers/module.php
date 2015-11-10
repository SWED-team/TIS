<?php
abstract class Module{
  
  public $containerData = array();     // pole informacii o zakladnych vlastnostiach modulu
  public $contentData = array();       // pole informacii o obsahu modulu
  public $file = array();              // pole informacii o obrazku modulu
  public $childsData = array();        // pole child modulov modulu( gallery > image )
  public $created_by;                  // pouzivatel ktory vytvoril modul
  public $edited_by;                   // pouzivatel ktory posledny editoval modul

  abstract function __construct($id);     // konstruktor
  abstract public function setById($id);  // funkcia 
  abstract static public function getModuleTypeName(); // funkcia vrati nazov typu modulu
  abstract public function module();      // funkcia zobrazi view pre modul na stranke
  abstract public function editor();      // funkcia zobrazi view pre editor modulu 
  abstract public function insert();      // funkcia ulozi novy modul do databazy
  abstract public function update();      // funkcia aktualizuje informacie o module v databaze
  abstract public function delete();      // funkcia zmaze modul z databazy a stranky

}


/*******************************  Image  *******************************/


class ModuleImage extends Module{
  public function __construct($id=0){
    //$this->created_by = new User($this->containerData['created_by']) 
    //$this->edited_by = new User($this->containerData['edited_by'])  

    // nacitanie potrebnych tried
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    require_once('_controllers/File.php');
    $this->setById($id);
  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id); 
      $this->contentData   = Module_m::getModuleContent($id, "module_image"); 
      $this->file          = new File($this->contentData['file_id']); 
    }
  }

  public function module(){
    return Module_v::moduleImage($this->containerData, $this->contentData, $this->file->get());
  }
  public function editor(){
    return Module_v::moduleImageEditor('module_image');
  }
  public function insert(){
    Module_v::insertInto('module',$this->contentContainer);
    Module_v::insertInto('module_image',$this->contentData);
    $this->file->insert();

  }
  public function update(){

  }
  public function delete(){

  }
  public static function getModuleTypeName(){
    return "<i class='fa fa-image'></i> Image";
  }
}


/*******************************  Formated  *******************************/


class ModuleFormated extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);

  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_formated");
    }
  }

  public function module(){
    return Module_v::moduleFormated($this->containerData, $this->contentData);
  }
  public function editor(){

  }
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-font"></i> Formated Text';
  }
}

/*******************************  Video  *******************************/


class ModuleVideo extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);

  }
  public function module(){
    return Module_v::module($this->containerData, $this->contentData);
  }
  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_video");
    }
  }
  public function editor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-play-circle"></i> Video';
  }
}


/*******************************  Embeded  *******************************/


class ModuleEmbeded extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);

  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_embeded");
    }
  }


  public function module(){
    return Module_v::moduleEmbeded($this->containerData, $this->contentData);
  }
  public function editor(){
        return Module_v::moduleEmbededEditor();
  }
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-youtube-play"></i> Embeded';
  }
}

/*******************************  Gallery  *******************************/

class ModuleGallery extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);

  }


  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_gallery");
    }
  }

  public function module(){
    return Module_v::module($this->containerData, $this->contentData);
  }
  public function editor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-th"></i> Gallery';
  }
}

/*******************************  Attachements  *******************************/


class ModuleAttachement extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);

  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_attachement");
    }
  }

  public function module(){
    return Module_v::module($this->containerData, $this->contentData);
  }
  public function editor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa  fa-paperclip"></i> Attachements';
  }
}


/*******************************  Link  *******************************/


class ModuleLink extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);

  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_link");
    }
  }

  public function module(){
    return Module_v::module($this->containerData, $this->contentData);
  }
  public function editor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-link"></i> Link';
  }
}


?>