<?php

if(!isset($_SESSION))
    session_start();
if(file_exists('Module.php'))
    require_once('Module.php');
if(file_exists('_controllers/Module.php'))
    require_once('_controllers/Module.php');

/*******************************  Module Formated *******************************/

class ModuleFormated extends Module{

    /**
     * Konštruktor triedy kontrolera modulu ModuleEmbeded
     * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
     */
    public function __construct($id=0){
        if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleFormated_v.php')) {
            require_once('_models/Module_m.php');
            require_once('_views/ModuleFormated_v.php');
        }
        if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleFormated_v.php')) {
            require_once('../_models/Module_m.php');
            require_once('../_views/ModuleFormated_v.php');
        }
        if(file_exists('_controllers/user.php'))
            require_once('_controllers/user.php');
        if(file_exists('user.php'))
            require_once('user.php');
        
        $this->created_by = new User();
        $this->edited_by = new User();

        $this->loggedUser = new User();
        $this->loggedUser->fillUserDatabySession();

        $this->module_type = "module_formated";

        $this->setById($id);
        $this->containerData["type"] = $this->module_type;  
        
        $this->
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
     * Funkcia vráti poh¾ad na modul
     * @return string html kód poh¾adu na modul 
     */
    public function module(){
        return ModuleFormated_v::module($this->containerData, $this->contentData, $this->loggedUser->isAdmin());
    }
    /**
     * Funkcia vráti poh¾ad na editoru modulu
     * @param  string $operation operácia ktorá sa má vykona po odoslaní formulára (insert/edit)
     * @return string html kód editora modulu 
     */
    public function editor($operation){
        return ModuleFormated_v::editor( $this->containerData, $this->contentData, $operation);
    }

    /**
     * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
     * @return boolean true ak sú dáta posielané z formulára validné / inak false
     */
  public function getFormData(){

      // Overenie zakladnych informaci o Userovi,Page a Module  
      $success = $this->verify();


      // --------- Nacitanie udajov o contente modulu ---------------- START


      // --------- Ak nacitanie udajov zlyha --------------------------------
      if ($success != true){
          echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module data corrupted.</div>';
      }
      // --------------------------------------------------------------------

      return $success;
  }
  public function insert(){}
  public function update(){}
  public function delete(){}
  public static function getModuleTypeName(){
    return '<i class="fa fa-font"></i> Formated Text';
  }
}

?>