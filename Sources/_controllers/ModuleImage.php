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


        $this->created_by = new User();
        $this->edited_by = new User();
        $this->file = array();

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
            $this->file          = Module_m::getModuleFiles($id)[0];
            $this->created_by->fillUserDataById($this->containerData['created_by']);
            $this->edited_by->fillUserDataById($this->containerData['edited_by']);
        }
    }


    /**
     * Funkcia vypíše poh¾ad na modul
     */
    public function module(){
        ModuleImage_v::module($this->containerData, $this->contentData, $this->loggedUser->isAdmin(),$this->file);
    }
    /**
     * Funkcia vypíše poh¾ad na editoru modulu
     * @param  string $operation operácia ktorá sa má vykona po odoslaní formulára (insert/edit)
     */
    public function editor($operation){
        
        //natavenie url na odoslanie formulara
        if(isset($_GET["page_id"]) && $_GET["page_id"]!=0){
            $this->containerData['page_id'] = $_GET["page_id"];
        }

        $url = '_controllers/ModuleImage.php?'.$operation.'=true&page_id='.$this->containerData['page_id'].'&';
        
        if(isset($this->containerData["id"]) && $this->containerData["id"]!=0){
            $url = $url.'id='.$this->containerData["id"];
            $m_id=$this->containerData["id"];
        }
        else{
            $m_id=0;
        }

        ModuleImage_v::editor( $this->containerData, $this->contentData, $url,$this->file, $this->getOrderOptions($m_id));
    }
    /**
     * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
     * @return boolean true ak sú dáta posielané z formulára validné / inak false
     */
    public function getFormData(){
        // Overenie zakladnych informaci o Userovi,Page a Module
        $success = $this->verify();


        // --------- nacitanie udajov o contente daneho modulu ----------------

        // overenie a ulozenie titulky modulu
        if(isset($_POST['title']) && strlen($_POST['title']) >= 3){
            $this->contentData["title"] = $_POST['title'];
        }
        else{
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Title Insert Error:</strong> Module title error. Title must contains more than 2 characters.</div>';
            $success = false;
        }
        // overenie a ulozenie popisu modulu
        if(isset($_POST['description'])){
            $this->contentData["description"] = $_POST['description'];
        }
        else{
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Description Insert Error:</strong> Module description error.</div>';
            $success = false;
        }

        // --------------------------------------------------------------------
        if(isset($_POST['file-path']) && file_exists('../'.$_POST['file-path'][0])){

            $this->file["path"] = $_POST['file-path'][0];
        }
        else{
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>File Insert Error:</strong> Path to file is incorrect.</div>';
            $success = false;
        }
        if(isset($_POST['file-thumb'][0]) && file_exists('../'.$_POST['file-thumb'][0]) && isset($_POST['file-thumb-medium'][0]) && file_exists('../'.$_POST['file-thumb-medium'][0])){
            $this->file["thumb"] = $_POST['file-thumb'][0];
            $this->file["thumb-medium"] = $_POST['file-thumb-medium'][0];
        }
        else{
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>File Insert Error:</strong> Path to file thumbnail is incorrect.</div>';
            $success = false;
        }

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

        $resultContainer = Module_m::insertInto("module", $this->containerData);
        if ($resultContainer > 0){
            $this->contentData["module_id"] = $resultContainer;
            $this->file["module_id"] = $resultContainer;
            $resultContent = Module_m::insertInto($this->module_type, $this->contentData);
            $resultFile = Module_m::insertInto('file', $this->file);
            if($resultContent > 0 && $resultFile>0){
                echo '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Module was saved successfully.</strong></div>';
                return true;
            }
            else{
                Module_m::deleteFrom("module", $resultContainer);
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
            Module_m::update("file", $this->file, "module_id",$this->containerData['id']);

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
        $m->editor("edit");
    }
    else{
        $m = new ModuleImage();
        $m->editor("insert");
    }
}

// ak spracuvame formular ktory ma vlozit modul
if( isset($_GET["insert"]) && $_GET["insert"]){
    $m = new ModuleImage();
    if($m->getFormData()){
        $m->insert();
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