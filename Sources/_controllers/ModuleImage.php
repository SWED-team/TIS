<?php
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
    $this->module_type = "module_image";
  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id); 
      $this->contentData   = Module_m::getModuleContent($id, $this->module_type); 
      $this->file          = new File($this->contentData['file_id']); 
    }
  }

  public function module(){
    return Module_v::moduleImage($this->containerData, $this->contentData, $this->file->get());
  }
  public function editor($operation){
    return Module_v::moduleImageEditor($this->module_type);
  }
  public function getFormData(){}
  public function insert(){
    Module_m::insertInto('module',$this->contentContainer);
    Module_m::insertInto($this->module_type, $this->contentData);
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

?>