<?php
if(!isset($_SESSION))
 session_start();
if(file_exists('Module.php'))
  require_once('Module.php');
if(file_exists('_controllers/Module.php'))
  require_once('_controllers/Module.php');


/*******************************  ModuleEmbeded  *******************************/
class ModuleImage extends Module{
  /**
   * Konštruktor triedy kontrolera modulu ModuleImage
   * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
   */
  public function __construct($id=0){
      $this->module_type = "module_image";

      if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleImage_v.php')) {
      require_once('_models/Module_m.php');
      require_once('_views/ModuleImage_v.php');
    }
    if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleImage_v.php')) {
      require_once('../_models/Module_m.php');
      require_once('../_views/ModuleImage_v.php');
    }
    if(file_exists('_controllers/user.php'))
      require_once('_controllers/user.php');
    if(file_exists('user.php'))
      require_once('user.php');

    if(file_exists('_controllers/File.php'))
        require_once('_controllers/File.php');
    if(file_exists('File.php'))
        require_once('File.php');

    $this->created_by = new User();
    $this->edited_by = new User();
    $this->file = new File();

    $this->loggedUser = new User();
    $this->loggedUser->fillUserDatabySession();


    $this->containerData["type"]=$this->module_type;



    $this->setById($id);
  }
 /**
  * Funkcia naèíta informácie z DB pre model so zadaným ID
  * @param integer $id ID modulu
  */
  public function setById($id=0){
    if($id != 0){               // nastavenie vlastnosti modulu z databazy ak je to existujuci modul
      $this->containerData = Module_m::getModuleContainer($id);
      $this->contentData   = Module_m::getModuleContent($id,  $this->module_type);
      $this->created_by->fillUserDataById($this->containerData['created_by']);
      $this->edited_by->fillUserDataById($this->containerData['edited_by']);
    }
  }
  /**
   * Funkcia nastaví obsah modulu pod¾a vstupných parametrov
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
 * Funkcia vráti poh¾ad na modul
 * @return string html kód poh¾adu na modul
 */
  public function module(){
      return ModuleImage_v::module($this->containerData, $this->contentData, $this->loggedUser->isAdmin(),$this->file);
  }
/**
 * Funkcia vráti poh¾ad na editoru modulu
 * @param  string $operation operácia ktorá sa má vykona po odoslaní formulára (insert/edit)
 * @return string html kód editora modulu
 */
  public function editor($operation){
      return ModuleImage_v::editor( $this->containerData, $this->contentData, $operation,$this->file);
  }
  /**
   * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
   * @return boolean true ak sú dáta posielané z formulára validné / inak false
   */
  public function getFormData(){
    $success = true;
    $this->containerData["type"] = $this->module_type;


    // --------- nacitanie udajov o containeri daneho modulu ----------------
    //overenie prav na pridanie / editaciu modulu
    if(!$this->loggedUser->isAdmin()){
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You don\'t have prermission to insert this module.</div>';
      $success = false;
      return $success;
    }

    // ak vkladam novy modul ///////////////////////////////////////
    if(isset($_GET['insert'])){

      //overenie prihlaseneho pouzivatela a nastavenie id usera ktory editoval modul posledny
      if($this->loggedUser->getUserID()!=0){
        $this->containerData["created_by"] = $this->loggedUser->getUserID();
        $this->containerData["edited_by"] = $this->loggedUser->getUserID();

      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You must be loged in.</div>';
        $success = false;
      }

      //overenie ci je zadane page_id
      if(isset($_GET['page_id']) && $_GET['page_id'] > 0){
        $this->containerData["page_id"] = $_GET['page_id'];
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Page_ID is wrog.</div>';
        $success = false;
      }
    }
    ///////////////////////////////////////////////////////////////
    // ak editujem modul //////////////////////////////////////////
    if(isset($_GET['edit'])){
      $this->containerData["edited"] = date("Y-m-d H:i:s", time());

      // overenie prihlaseneho pouzivatela
      if($this->loggedUser->getUserID()!=0){
          $this->containerData["edited_by"] = $this->loggedUser->getUserID();
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You must be loged in.</div>';
        $success = false;
      }
      // overenie ci je zadane id modulu ktory sa ma editovat
      if( isset($_GET['id']) && $_GET['id'] > 0 ){
        $this->containerData["id"] = $_GET['id'];
      }
      else{
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You cannot update this module (wrong module_id inserted).</div>';
        $success = false;
      }
    }//////////////////////////////////////////////////////////////


    // overenie spravneho zadania poctu riadkov
    if(isset($_POST['rows']) && $_POST['rows']>=0 && $_POST['rows']<=4){
      $this->containerData["rows"] = $_POST['rows'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Number of module rows must be greater than 0.</div>';
      $success = false;
    }

    // overenie spravneho zadania poctu stlpcov
    if(isset($_POST['cols']) && $_POST['cols']>=1 && $_POST['cols']<=4){
      $this->containerData["cols"] = $_POST['cols'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Number of module columns must be greater than 0.</div>';
      $success = false;
    }

    // overenie spravneho zadania statusu
    if(isset($_POST['status']) && $_POST['status']>=0 && $_POST['status']<=1) {
      // ak je status modulu nastaveny na skryty tak vypis warning
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

    // overenie a ulozenie titulky modulu
    if(isset($_POST['title'])){
      $this->contentData["title"] = $_POST['title'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module title error.</div>';
      $success = false;
    }
    // overenie a ulozenie popisu modulu
    if(isset($_POST['description'])){
      $this->contentData["description"] = $_POST['description'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module description error.</div>';
      $success = false;
    }
    // overenie a ulozenie linku embedovaneho odkazu
    if(isset($_FILES['file']) && isset($_FILES['file']["name"])){
        //$this->contentData["file"] = $_FILES['file'];
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> File is not inserted.</div>';
      $success = false;
    }
    // --------------------------------------------------------------------



    // --------- ak nacitanie udajov zlyha --------------------------------
    if ($success != true){
      echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module data corrupted.</div>';
    }
    // --------------------------------------------------------------------


    print_r($_FILES['file']); echo '</pre>';


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
      $result2 = Module_m::insertInto($this->module_type, $this->contentData, $this->file);
      if($result2 > 0){
        echo '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Module was saved successfully.</strong></div>';
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
    return '<i class="fa fa-image"></i> Image';
  }
}



// --------- spracovanie poziadavky posielanej ajaxom ---------

// ak posielame poziadavku na vypisanie editora pre dany modul
if(isset($_GET["show_editor"]) && $_GET["show_editor"] ){
  if(isset($_POST["id"]) && $_POST["id"]>0){
      $m = new ModuleImage($_POST["id"]);
    echo $m->editor("edit");
  }
}

// ak spracuvame formular ktory ma vlozit modul
if( isset($_GET["insert"]) && $_GET["insert"]){
    $m = new ModuleImage();
  if($m->getFormData()){
    //$m->insert();
  }
}


// ak spracuvame formular ktory ma editovat modul
if( isset($_GET["edit"]) && $_GET["edit"] ){
  if(isset($_GET["id"]) && $_GET["id"]>0){
    $m = new ModuleImage($_GET["id"]);
    if ($m->getFormData()){
      $m->update();
    }
  }
}

// ak posielame poziadavku na vymazanie modulu s danum id
if ( isset($_GET["delete"]) && $_GET["delete"]){
  echo "delete";
  if( isset($_POST["id"]) && $_POST["id"] > 0 ){
      $m = new ModuleImage($_POST["id"]);
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