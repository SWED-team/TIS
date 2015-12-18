<?php

if(!isset($_SESSION))
    session_start();
if(file_exists('Module.php'))
    require_once('Module.php');
if(file_exists('_controllers/Module.php'))
    require_once('_controllers/Module.php');

/*******************************  Gallery *******************************/

class ModuleGallery extends Module{

    /**
     * Konštruktor triedy kontrolera modulu ModuleEmbeded
     * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
     */
    public function __construct($id=0){
        if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleGallery_v.php')) {
            require_once('_models/Module_m.php');
            require_once('_views/ModuleGallery_v.php');
        }
        if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleGallery_v.php')) {
            require_once('../_models/Module_m.php');
            require_once('../_views/ModuleGallery_v.php');
        }
        if(file_exists('_controllers/user.php'))
            require_once('_controllers/user.php');
        if(file_exists('user.php'))
            require_once('user.php');
        
        $this->created_by = new User();
        $this->edited_by = new User();

        $this->loggedUser = new User();
        $this->loggedUser->fillUserDatabySession();

        $this->module_type = "module_gallery";

        $this->setById($id);
        $this->containerData["type"] = $this->module_type;  

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
        return ModuleGallery_v::module($this->containerData, $this->contentData, $this->loggedUser->isAdmin());
    }
    /**
     * Funkcia vráti poh¾ad na editoru modulu
     * @param  string $operation operácia ktorá sa má vykona po odoslaní formulára (insert/edit)
     * @return string html kód editora modulu 
     */
    public function editor($operation){
        return ModuleGallery_v::editor( $this->containerData, $this->contentData, $operation);
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
        return '<i class="fa fa-th"></i>Gallery';
    }
}
// --------- spracovanie poziadavky posielanej ajaxom ---------

// ak posielame poziadavku na vypisanie editora pre dany modul
if(isset($_GET["show_editor"]) && $_GET["show_editor"] ){
    if(isset($_POST["id"]) && $_POST["id"]>0){
        $m = new ModuleGallery($_POST["id"]);
        echo $m->editor("edit");
    }
}

// ak spracuvame formular ktory ma vlozit modul
if( isset($_GET["insert"]) && $_GET["insert"]){
    $m = new ModuleGallery();
    if($m->getFormData()){
        $m->insert();
    }
}


// ak spracuvame formular ktory ma editovat modul
if( isset($_GET["edit"]) && $_GET["edit"] ){
    if(isset($_GET["id"]) && $_GET["id"]>0){
        $m = new ModuleGallery($_GET["id"]);
        if ($m->getFormData()){
            $m->update();
        }
    }
}

// ak posielame poziadavku na vymazanie modulu s danum id
if ( isset($_GET["delete"]) && $_GET["delete"]){
    echo "delete";
    if( isset($_POST["id"]) && $_POST["id"] > 0 ){
        $m = new ModuleGallery($_POST["id"]);
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


?>