<?php

/*******************************  Formated  *******************************/


class ModuleFormated extends Module{
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);
    $this->module_type = "module_formated";

  }

  public function setById($id){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id, $this->module_type);
    }
  }

  public function module(){
    return Module_v::moduleFormated($this->containerData, $this->contentData);
  }
  public function editor($operation){

  }
  public function getFormData(){}
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-font"></i> Formated Text';
  }
}

?>