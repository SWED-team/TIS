<?php 

Class Page{
  private $pageData;        // pole informacii o stranke
  private $modules;         // pole modulov pre stranku
  private $created_by;      // pouzivatel ktory vytvoril stranku
  private $edited_by;       // pouzivatel ktory posledny editoval stranku
  private $newModules;
  public function __construct($page_id = 0){
    require_once('_models/Page_m.php');
    require_once('_views/Page_v.php');
    
    $this->pageData = Page_m::getPageData($page_id);
    $this->modules = array();
    // inicializacia modulov >> "nazov_typu_modulu_v_db" => new ModuleTyp()
    require_once('_controllers/ModuleImage.php'); 
    require_once('_controllers/ModuleVideo.php'); 
    require_once('_controllers/ModuleGallery.php'); 
    require_once('_controllers/ModuleEmbeded.php'); 
    require_once('_controllers/ModuleLink.php'); 
    require_once('_controllers/ModuleAttachement.php'); 
    require_once('_controllers/ModuleEmbeded.php'); 
    require_once('_controllers/ModuleFormated.php'); 
    $this->newModules = array(
      "module_image" => new ModuleImage(),
      "module_video" => new ModuleVideo(),
      "module_embeded" => new ModuleEmbeded(),
      "module_gallery" => new ModuleGallery(),
      "module_formated" => new ModuleFormated(),
      "module_attachement" => new ModuleAttachement(),
      "module_link" => new ModuleLink()
      );
    
    foreach (Page_m::getModules($page_id) as $key => $module) {
      $new = clone  $this->newModules[$module['type']];
      $new->setById( $module['id']);
      array_push($this->modules, $new);
    }
  }

  /*
    Funkcia vytiahne všetky informácie o moduloch z databázy a zobrazí ich na stránke s možnosťou editovať/zmazať každý zobrazený modul 
  */
  private function modulesEditable(){
    foreach ($this->modules as $key => $module) {
      $module->module(); // todo: zmenit na zobrazenie viewu na editovatelny modul 
    }
  }
  /*
    Funkcia vytiahne všetky informácie o moduloch z databázy a zobrazí ich na stránke
  */
  private function modules(){
    foreach ($this->modules as $key => $module) {
      $module->module();
    }
  }
  /*
  * Funkcia zobrazí tlačidlo na pridávanie modulov
  */
  private function addModuleButton(){
    echo Page_v::addModuleButton();
  }  
  /*
    Funkcia vypíše formuláre na úpravu modulov
  */
  public function modulesEditor(){
    return Page_v::moduleEditor($this->newModules);
  } 
  /*
  Funkcia zobrazí view pre header stránky
  */
  public function header(){
    return 
    Page_v::pageHead($this->pageData['title']).
    Page_v::pageHeader();
  }
  /*
  funkcia zobrazí view pre footer stránky
  */
  public function footer(){
    return Page_v::footer();
  }
  /*
    Funkcia zobrazí obsah s modulmy
  */
  public function pageContent($admin){
    echo '<section class="container-fluid"><div class="row">';
    $this->modules();
    
    
    if($admin){
      $this->addModuleButton();
    }
    
    echo '</div></section>';
    

    if($admin){
      $this->modulesEditor();
    }    
  }
}


?>