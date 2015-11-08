<?php
abstract class Module{
  

  protected $containerData = array();     // pole informacii o zakladnych vlastnostiach modulu
  protected $contentData = array();       // pole informacii o obsahu modulu
  protected $file = array();              // pole informacii o obrazku modulu
  protected $childsData = array();        // pole child modulov modulu( gallery > image )
  protected $created_by;                  // pouzivatel ktory vytvoril modul
  protected $edited_by;                   // pouzivatel ktory posledny editoval modul


  abstract function __construct($id);     // konstruktor
  abstract public function printModule();       // funkcia zobrazi view pre modul na stranke
  abstract public function printEditor(); // funkcia zobrazi view pre editor modulu 
  abstract public function insert();      // funkcia ulozi novy modul do databazy
  abstract public function update();      // funkcia aktualizuje informacie o module v databaze
  abstract public function delete();      // funkcia zmaze modul z databazy a stranky
}





class ModuleImage extends Module{


  public function __construct($id){
    //$this->created_by = new User($this->containerData['created_by']) 
    //$this->edited_by = new User($this->containerData['edited_by'])  

    // nacitanie potrebnych tried
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    require_once('_controllers/File.php');
    
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id); 
      $this->contentData   = Module_m::getModuleContent($id, "module_image"); 
      $this->file          = new File($this->contentData['file_id']); 
    }
  }
  public function printModule(){
    Module_v::moduleImage($this->containerData, $this->contentData, $this->file->get());
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}



class ModuleFormated extends Module{
  public function __construct($id){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');

    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_formated");
    }
  }
  public function printModule(){
    Module_v::moduleFormated($this->containerData, $this->contentData);
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}



class ModuleVideo extends Module{
  public function __construct($id){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');

    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_video");
    }
  }
  public function printModule(){
    Module_v::module($this->containerData, $this->contentData);
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}




class ModuleEmbeded extends Module{
  public function __construct($id){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');

    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_embeded");
    }
  }
  public function printModule(){
    Module_v::module($this->containerData, $this->contentData);
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}



class ModuleGallery extends Module{
  public function __construct($id){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');

    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_gallery");
    }
  }
  public function printModule(){
    Module_v::module($this->containerData, $this->contentData);
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}



class ModuleAttachement extends Module{
  public function __construct($id){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');

    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_attachement");
    }
  }
  public function printModule(){
    Module_v::module($this->containerData, $this->contentData);
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}




class ModuleLink extends Module{
  public function __construct($id){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');

    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, "module_link");
    }
  }
  public function printModule(){
    Module_v::module($this->containerData, $this->contentData);
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
}


?>