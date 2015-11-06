<?php
abstract class Module{
  

  protected $containerData = null;
  protected $contentData = null;
  protected $file = null;
  protected $childsData = null;
  
  abstract function __construct($id);
  abstract public function printModule();
  abstract public function printEditor();
  abstract public function insert();
  abstract public function update();
  abstract public function delete();
}


class ModuleImage extends Module{
 public function __construct($id){
  require_once('_models/Module_m.php');
  require_once('_views/Module_v.php');
    //  require_once('File.php');
    $this->containerData = Module_m::getModuleContainer($id);
    $this->contentData   = Module_m::getModuleContent($id, "module_image");
    /*$this->fileData      = Module_m::getModuleFile($this->contentData['file_id']);*/
    $this->file          = new File($this->contentData['file_id']);
  }
  public function printModule(){
    Module_v::ModuleImage($this->containerData, $this->contentData, $this->file->get());
  }
  public function printEditor(){}
  public function insert(){}
  public function update(){}
  public function delete(){}

}
?>