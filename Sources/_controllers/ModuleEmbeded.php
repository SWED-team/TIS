<?php

if(isset($_POST['type']) && $_POST['type'] == "module_embeded"){
  $m = new ModuleEmbeded();
}



/*******************************  Embeded  *******************************/
class ModuleEmbeded extends Module{
  /**
   * Konštruktor triedy kontrolera modulu ModuleEmbeded
   * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
   */
  public function __construct($id=0){
    require_once('_models/Module_m.php');
    require_once('_views/Module_v.php');
    $this->setById($id);
    $this->module_type = "module_embeded";
  }
 /**
  * Funkcia načíta informácie z DB pre model so zadaným ID
  * @param integer $id ID modulu
  */
  public function setById($id=0){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id,  $this->module_type);
    }
  }
  /**
   * Funkcia nastaví obsah modulu podľa vstupných parametrov
   * @param integer $module_id   id modulu
   * @param string  $link        Odkaz na embedované video
   * @param string  $title       Názov modulu
   * @param string  $description Popis modulu
   */
  public function setContentData($module_id=0,$link="",$title="",$description=""){
    $this->containerData=array(
      'module_id' => $module_id,
      'link' => $link,
      'title' => $title,
      'description' =>$description
    );
  }

/**
 * Funkcia vráti pohľad na modul
 * @return string html kód pohľadu na modul 
 */
  public function module(){
    return Module_v::moduleEmbeded($this->containerData, $this->contentData);
  }
  /**
   * Funkcia vráti pohľad na editoru modulu
   * @return string html kód editora modulu 
   */
  public function editor(){
        return Module_v::moduleEmbededEditor( $this->module_type );
  }
  /**
   * Funkcia uloží post premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
   * @return [type] [description]
   */
  public function getPostData(){
    $success = true;
    if(!isset($_GET['page_id']) || $_GET['page_id']<=0){
      echo '<div class="alert alert-danger" role="alert"><strong>Insertion Error:</strong> Page_ID is wrog.</div>';
      $success = false;
    }
    if(!isset($_POST['type']) || $_POST['type'] != $this->module_type){
      echo '<div class="alert alert-danger" role="alert"><strong>Insertion Error:</strong> Module Type is wrong.</div>';
      $success = false;
    }
    if(!isset($_POST['rows']) || $_POST['rows']<0){
      echo '<div class="alert alert-danger" role="alert"><strong>Insertion Error:</strong> Number of module rows must be greater than 0.</div>';
      $success = false;
    }
    if(!isset($_POST['cols']) || $_POST['cols']<0){
      echo '<div class="alert alert-danger" role="alert"><strong>Insertion Error:</strong> Number of module columns must be greater than 0.</div>';
      $success = false;
    }
    if(!isset($_SESSION["user_id"])){

    }

    if ($success == true){
      $this->setContainerData($_GET['page_id'],$_POST['type'],1,1,$_POST['rows'],$_POST['cols'],1,1);
      $this->setContentData(0,$_POST['link'],$_POST['title'],$_POST['description']);
    }


  }

  /**
   * funkcia vloží modul do DB
   * @return boolean true ak vloží úspešne false ak nastane chyba
   */
  public function insert(){


  }
  /**
   * funkcia aktualizuje údaje o module v DB
   * @return boolean true ak edituje úspešne inak false
   */
  public function update(){}
  /**
   * Funkcia vymaže modul z DB
   * @return boolean true ak vymaže false ak nastane chyba
   */
  public function delete(){}
  /**
   * Funkcia vráti typ modulu s ikonou pre editor modulov
   * @return string ikona + typ modulu
   */
  public static function getModuleTypeName(){
    return '<i class="fa fa-youtube-play"></i> Embeded';
  }
}


?>