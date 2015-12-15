<?php

// --------- ak posielame poziadavku pomocou ajaxu tak treba naimportovat potrebne kniznice ---------
if(isset($_GET["insert"]) || isset($_GET["edit"]) || isset($_GET["delete"])|| isset($_GET["show_editor"])){
  session_start();
  require_once('../_models/Db.php');
  require_once('Module.php');
  require_once('../_controllers/User.php');
}
// --------------------------------------------------------------------------------------------------




/*******************************  ModuleEmbeded  *******************************/
class ModuleEmbeded extends Module{
  /**
   * Konštruktor triedy kontrolera modulu ModuleEmbeded
   * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
   */
  public function __construct($id=0){
    if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleEmbeded_v.php')) {
      require_once('_models/Module_m.php');
      require_once('_views/ModuleEmbeded_v.php');
    }
    else if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleEmbeded_v.php')) {
      require_once('../_models/Module_m.php');
      require_once('../_views/ModuleEmbeded_v.php');
    }
    else {
      echo 'Cannot open model or view for controller.';
      return;
    }
    $this->module_type = "module_embeded";
    $this->setById($id);
    
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
    $this->contentData=array(
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
    return ModuleEmbeded_v::module($this->containerData, $this->contentData, true);
  }
/**
 * Funkcia vráti pohľad na editoru modulu
 * @param  string $operation operácia ktorá sa má vykonať po odoslaní formulára (insert/edit)
 * @return string html kód editora modulu 
 */
  public function editor($operation){
    return ModuleEmbeded_v::editor( $this->containerData, $this->contentData, $operation);
  }
  /**
   * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
   * @return boolean true ak sú dáta posielané z formulára validné / inak false
   */
  public function getFormData(){
    $success = true;



    // --------- nacitanie udajov o containeri daneho modulu ----------------

     ///////////////////// dorobit treba ///////////////////
    //overenie prav na pridanie / editaciu modulu 
    if(false){
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You don\'t have prermission to insert this module.</div>';
      $success = false;
      return $success;
    }   
    if(isset($_GET['insert'])){
      ///////////////////// dorobit treba //////////////////
      //overenie prihlaseneho pouzivatela 
      if(true){
        $this->containerData["edited_by"] = 1;
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You must be loged in.</div>';
        $success = false;
      }
      //////////////////////////////////////////////////////
      if(isset($_GET['page_id']) && $_GET['page_id'] > 0){
        $this->containerData["page_id"] = $_GET['page_id'];
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Page_ID is wrog.</div>';
        $success = false;
      }
    }
    if(isset($_GET['edit'])){
      $this->containerData["edited"] = date("Y-m-d H:i:s", time());

      ///////////////////// dorobit treba ///////////////////
      //overenie prihlaseneho pouzivatela 
      if(true){
        $this->containerData["created_by"] = 1;
        $this->containerData["edited_by"] = 1;
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You must be loged in.</div>';
        $success = false;
      }
      //////////////////////////////////////////////////////

      if( isset($_GET['id']) && $_GET['id'] > 0 ){
        $this->containerData["id"] = $_GET['id'];
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You cannot update this module (wrong module_id inserted).</div>';
        $success = false;
      }
    }
    
    if(isset($_GET['type']) && $_GET['type'] == $this->module_type){
      $this->containerData["type"] = $_GET['type'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module Type is wrong.</div>';
      $success = false;
    }

    if(isset($_POST['rows']) && $_POST['rows']>=0){
      $this->containerData["rows"] = $_POST['rows'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Number of module rows must be greater than 0.</div>';
      $success = false;
    }

    if(isset($_POST['cols']) && $_POST['cols']>=0){
      $this->containerData["cols"] = $_POST['cols'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Number of module columns must be greater than 0.</div>';
      $success = false;      
    }

    if(isset($_POST['status']) && $_POST['status']>=0 && $_POST['status']<=1) {
      if($_POST['status']==0){
        echo '<div class="alert alert-warning" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Warning:</strong> Module is hidden.</div>';
      }
      $this->containerData["status"] = $_POST['status'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module status is not correct.</div>';
    }
    // --------------------------------------------------------------------




    // --------- nacitanie udajov o contente daneho modulu ----------------
    if(isset($_POST['me-title'])){
      $this->contentData["title"] = $_POST['me-title'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module title error.</div>';
      $success = false;
    }
    if(isset($_POST['description'])){
      $this->contentData["description"] = $_POST['description'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module description error.</div>';
      $success = false;
    }
    if(isset($_POST['link']) && $_POST['link'] != ""){
      $this->contentData["link"] = $_POST['link'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module link must be inserted.</div>';
      $success = false;
    }
    // --------------------------------------------------------------------



    // --------- ak nacitanie udajov zlyha --------------------------------
    if ($success != true){
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module data corrupted.</div>';
    }
    // --------------------------------------------------------------------

    return $success;
  }

  /**
   * funkcia vloží modul do DB
   * @return boolean true ak vloží úspešne false ak nastane chyba
   */
  public function insert(){
    
    $result1 = Module_m::insertInto("module", $this->containerData);
    if ($result1 > 0){
      $this->contentData["module_id"] = $result1;
      $result2 = Module_m::insertInto($this->module_type, $this->contentData);
      if($result2 > 0){
        echo '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Module was inserted successfully.</strong></div>';
        return true;
      }
      else{
        Module_m::deleteFrom("module", $result1);
      }
    }
    echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Problem with saving module to database.</div>';
    return false;
  }

  /**
   * funkcia aktualizuje údaje o module v DB
   * @return boolean true ak edituje úspešne inak false
   */
  public function update(){
    //echo $this->contentData["title"]."<br>";
    //print_r($this->containerData["id"]);
    //print_r($this->contentData);
    if(isset($this->containerData['id'])&& isset($this->contentData['module_id']) && $this->containerData['id'] > 0 && $this->contentData['module_id'] > 0){
      Module_m::update("module", $this->containerData, "id",$this->containerData['id']);
      Module_m::update($this->module_type, $this->contentData, "module_id",$this->containerData['id']);
      echo '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Module was inserted successfully.</strong></div>';
      return true;
    }
    echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Problem with saving module to database.</div>';
    return false;
  }

  /**
   * Funkcia vymaže modul z DB
   * @return boolean true ak vymaže false ak nastane chyba
   */
  public function delete(){
    if(isset($this->containerData['id'])&& isset($this->contentData['module_id']) && $this->containerData['id'] > 0 && $this->contentData['module_id'] > 0){
      Module_m::deleteFrom("module", $this->containerData['id']);
      return true;
    }
    return false;
  }

  /**
   * Funkcia vráti typ modulu s ikonou pre editor modulov
   * @return string ikona + typ modulu
   */
  public static function getModuleTypeName(){
    return '<i class="fa fa-youtube-play"></i> Embeded';
  }
}



// --------- spracovanie poziadavky posielanej ajaxom ---------

// ak posielame poziadavku na vypisanie editora pre dany modul
if(isset($_GET["show_editor"]) && $_GET["show_editor"] ){
  if(isset($_POST["id"]) && $_POST["id"]>0){
    $m = new ModuleEmbeded($_POST["id"]);
    echo $m->editor("edit");
  }
}

// ak spracuvame formular ktory ma vlozit modul
if( isset($_GET["insert"]) && $_GET["insert"] && isset($_GET["page_id"])){
  $m = new ModuleEmbeded();
  if($m->getFormData()){
    $m->insert();
  }
}


// ak spracuvame formular ktory ma editovat modul
if( isset($_GET["edit"]) && $_GET["edit"] ){
  if(isset($_GET["id"]) && $_GET["id"]>0){
    $m = new ModuleEmbeded($_GET["id"]);
    if ($m->getFormData()){
      $m->update();
    }
  }
}

// ak posielame poziadavku na vymazanie modulu s danum id
if ( isset($_GET["delete"]) && $_GET["delete"]){
  echo "delete";
  if( isset($_POST["id"]) && $_POST["id"] > 0 ){
    $m = new ModuleEmbeded($_POST["id"]);
    if($m->delete()){
      echo '<strong>Module was deleted.</strong>';
    }
    else{
      echo '<strong>Delete Error:</strong> Delete was unsuccessfull.';
    }
  }
  else{
    echo '<strong>Delete Error:</strong> Unknown module.';

  }
}
// ------------------------------------------------------------

?>