<?php 

Class Page{
  private $pageData;        // pole informacii o stranke
  private $modules;         // pole modulov pre stranku
  private $created_by;      // pouzivatel ktory vytvoril stranku
  private $edited_by;       // pouzivatel ktory posledny editoval stranku

  public function __construct($page_id){
    require_once('_models/Page_m.php');
    require_once('_views/Page_v.php');
    $this->pageData = Page_m::getPageData($page_id);
    $this->modules = array();
    
    foreach (Page_m::getModules($page_id) as $key => $module) {
      //echo "$key -> " . $module['id'] ." : ". $module['type'] ;
      if( $module['type'] == "module_image"){
        array_push($this->modules, new ModuleImage( $module['id'] ));
      }
      else if( $module['type'] == "module_video"){
        array_push($this->modules, new ModuleVideo( $module['id'] ));
      }
      else if( $module['type'] == "module_embeded"){
        array_push($this->modules, new ModuleEmbeded( $module['id'] ));
      }
      else if( $module['type'] == "module_gallery"){
        array_push($this->modules, new ModuleGallery( $module['id'] ));
      }
      else if( $module['type'] == "module_formated"){
        array_push($this->modules, new ModuleFormated( $module['id'] ));
      }
      else if( $module['type'] == "module_attachement"){
        array_push($this->modules, new ModuleAttachement( $module['id'] ));
      }
      else if( $module['type'] == "module_link"){
        array_push($this->modules, new ModuleLink( $module['id'] ));
      }
    }




    //$this->created_by = new User($this->pageData['created_by']) 
    //$this->edited_by = new User($this->pageData['edited_by'])   
  }

  public function printPage(){
    Page_v::printPageHead($this->pageData['title']);
    Page_v::printPageHeader();

    foreach ($this->modules as $key => $module) {
      $module->printModule();
    }

  }
}


?>