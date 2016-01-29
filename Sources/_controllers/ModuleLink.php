<?php

if(!isset($_SESSION))
    session_start();
if(file_exists('Module.php'))
    require_once('Module.php');
if(file_exists('_controllers/Module.php'))
    require_once('_controllers/Module.php');
if(file_exists('../_controllers/user.php'))
    require_once('../_controllers/user.php');


/******************************* ModuleLink *******************************/
/**
 * ModuleLink Kontroler
 *
 * Trieda na pracu s viewom a modelom modulu : ModuleLink
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
 */
class ModuleLink extends Module{

    /**
     * Konštruktor triedy kontrolera modulu ModuleLink
     * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
     */
    public function __construct($id=0){
        if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleLink_v.php')) {
            require_once('_models/Module_m.php');
            require_once('_views/ModuleLink_v.php');
        }
        if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleLink_v.php')) {
            require_once('../_models/Module_m.php');
            require_once('../_views/ModuleLink_v.php');
        }

        $this->created_by = new User();
        $this->edited_by = new User();
        $this->file = array();

        $this->module_type = "module_link";
        
        $this->loggedUser = new User();
        $this->loggedUser->fillUserDatabySession();

        $this->containerData["type"] = $this->module_type;
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
     * Funkcia vráti pohľad na modul
     * @return string html kód poh¾adu na modul
     */
    public function module($editable){
        ModuleLink_v::module($this->containerData, $this->contentData, $editable, $this->file);
    }
    /**
     * Funkcia vráti poh¾ad na editoru modulu
     * @param  string $operation operácia ktorá sa má vykona po odoslaní formulára (insert/edit)
     * @return string html kód editora modulu
     */
    public function editor($operation){
        //natavenie url na odoslanie formulara
        if(isset($_GET["page_id"]) && $_GET["page_id"]!=0){
            $this->containerData['page_id'] = $_GET["page_id"];
        }

        $url = '_controllers/ModuleLink.php?'.$operation.'=true&page_id='.$this->containerData['page_id'].'&';
        
        if(isset($this->containerData["id"]) && $this->containerData["id"]!=0){
            $url = $url.'id='.$this->containerData["id"];
            $m_id=$this->containerData["id"];
        }
        else{
            $m_id=0;
        }


        ModuleLink_v::editor( $this->containerData, $this->contentData, $url,$this->file, $this->getOrderOptions($m_id), $this->getPages());
       }

    /**
     * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
     * @return boolean true ak sú dáta posielané z formulára validné / inak false
     */
    public function getFormData(){

        // Overenie zakladnych informaci o Userovi,Page a Module
        $success = $this->verify();


        // --------- Nacitanie udajov o contente modulu ---------------- START
        // overenie a ulozenie titulky modulu
        if(isset($_POST['title']) && strlen($_POST['title']) >= 3){
            $this->contentData["title"] = $_POST['title'];
        }
        else{
            $this->printAlert("danger", "Title Error:", "Title must contains more than 2 characters.");
            $success = false;
        }
        // overenie a ulozenie popisu modulu
        if(isset($_POST['description'])){
            $this->contentData["description"] = $_POST['description'];
        }
        else{
            $this->printAlert("danger", "Description Error:", "Description is incorrect.");
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Description Insert Error:</strong> Module description error.</div>';
            $success = false;
        }

       // ------- link type ---------------------------------------------------
        if(isset($_POST['type']) && ($_POST['type'] == "internal" || $_POST['type'] == "external")){
            if($_POST['type'] == "internal"){
                // ------- internal page_id ---------------------------------------------------
                if(isset($_POST['page_id']) && $_POST['page_id'] != ""){
                    $this->contentData["page_id"] = $_POST['page_id'];
                }
                else{
                    $this->printAlert("danger", "Internal Link Error:", "Page must be selected.");
                    $success = false;
                }
            }
            else if($_POST['type'] == "external"){
               // ------- link ---------------------------------------------------
                if(isset($_POST['link']) && strlen($_POST['link']) >= 2){
                    $link = $_POST['link'];
                    if(strpos(strtolower($link) ,'http://') === false && strpos(strtolower($link) ,'https://') === false && strpos(strtolower($link) ,'ftp://') === false){
                        $link = "http://".$link;
                    }
                    $this->contentData["link"] = $link;
                }
                else{
                    $this->printAlert("danger", "External Link Error:", "External link must contains more than 1 characters");
                    $success = false;
                }
            }
        }
        else{
            $this->printAlert("danger", "Link Type Error:", "Link Type must be selected.");
            $success = false;
        }




       // ------- reprezentativny obrazok ---------------------------------------------------
        if(isset($_POST['file-path']) && file_exists('../'.$_POST['file-path'][0])){
            $this->file["path"] = $_POST['file-path'][0];
        }
        else{
            $this->printAlert("danger", "File Error:", "Path to file is incorrect.");
            $success = false;
        }
        if(isset($_POST['file-thumb'][0]) && file_exists('../'.$_POST['file-thumb'][0]) && isset($_POST['file-thumb-medium'][0]) && file_exists('../'.$_POST['file-thumb-medium'][0])){
            $this->file["thumb"] = $_POST['file-thumb'][0];
            $this->file["thumb-medium"] = $_POST['file-thumb-medium'][0];
        }
        else{
            $this->printAlert("danger", "File Error:", "Path to file thumbnail is incorrect.");
            $success = false;
        }




        // --------- Ak nacitanie udajov zlyha --------------------------------
        if ($success != true){
            $this->printAlert("danger", "Save Error:", "Module data corrupted.");
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
                $this->printAlert("success", "Module was saved successfully.", "");
                return true;
            }
            else{
                Module_m::deleteFrom("module", $resultContainer);
            }
        }
        $this->printAlert("danger", "Insertion Error:", "Problem with saving module to database.");
        return false;
    }

    /**
     * Funkcia aktualizuje údaje o module v DB
     * @return boolean true ak edituje úspešne inak false
     */
    public function update(){
        if(isset($this->containerData['id'])&& isset($this->contentData['module_id']) && $this->containerData['id'] > 0 && $this->contentData['module_id'] > 0){
            Module_m::update("module", $this->containerData, "id",$this->containerData['id']);
            Module_m::update($this->module_type, $this->contentData, "module_id",$this->containerData['id']);
            Module_m::update("file", $this->file, "module_id",$this->containerData['id']);

            $this->printAlert("success", "Module was updated successfully.", "");
            return true;
        }
        $this->printAlert("danger", "Update Error:", "Problem with saving module to database.");
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
    public function getModuleTypeName(){
        return '<i class="fa fa-link"></i>Link';
    }
    public function getPages(){
        return Module_m::getPages();
    }
}
// --------- spracovanie poziadavky posielanej ajaxom ---------


// TODO: dorobit overenie ci je prihlaseny && (ci je admin || ci ma pravo editovat page)

// overenie ci sa vola ajax funkcia
if (isset($_GET["show_editor"]) || isset($_GET["insert"]) || isset($_GET["edit"]) || isset($_GET["delete"])) {
    
    $loggedUser = new User();
    $loggedUser->fillUserDatabySession();
    // Overenie prihlasenia pouzivatela
    if ($loggedUser->isLoggedIn()) {
        // ak posielame poziadavku na vypisanie editora pre dany modul
        if( isset($_GET["show_editor"]) && $_GET["show_editor"] ){
            if(isset($_POST["id"]) && $_POST["id"]>0){
                $m = new ModuleLink($_POST["id"]);
                echo $m->editor("edit");
            }
            else{
                $m = new ModuleLink();
                $m->editor("insert");
            }
        }
        // ak spracuvame formular ktory ma vlozit modul
        if( isset($_GET["insert"]) && $_GET["insert"]){
            $m = new ModuleLink();
            if($m->getFormData()){
                $m->insert();
            }
        }
        // ak spracuvame formular ktory ma editovat modul
        if(isset($_GET["edit"]) && $_GET["edit"] ){
            if(isset($_GET["id"]) && $_GET["id"]>0){
                $m = new ModuleLink($_GET["id"]);
                if ($m->getFormData()){
                    $m->update();
                }
            }
        }
        // ak posielame poziadavku na vymazanie modulu s danum id
        if ( isset($_GET["delete"]) && $_GET["delete"]){
            if( isset($_POST["id"]) && $_POST["id"] > 0 ){
                $m = new ModuleLink($_POST["id"]);
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
    }else {
         echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Permission denied:</strong> You dont have permissions to add/edit/del modules on this page.</div>';
       
    }    
}

?>