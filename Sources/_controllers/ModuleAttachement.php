<?php
if(!isset($_SESSION))
    session_start();
if(file_exists('Module.php'))
    require_once('Module.php');
if(file_exists('_controllers/Module.php'))
    require_once('_controllers/Module.php');
if(file_exists('_controllers/user.php'))
    require_once('_controllers/user.php');
if(file_exists('user.php'))
    require_once('user.php');

/*******************************  ModuleAttachement  *******************************/

/**
 * ModuleAttachement Kontroler
 *
 * Trieda na pracu s viewom a modelom modulu : ModuleAttachement
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
*/

class ModuleAttachement extends Module{
    /**
     * Konštruktor triedy kontrolera modulu ModuleAttachement
     * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
     */
    public function __construct($id=0){
        $this->module_type = "module_attachements";

        if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleImage_v.php')) {
            require_once('_models/Module_m.php');
            require_once('_views/ModuleAttachement_v.php');
        }
        if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleImage_v.php')) {
            require_once('../_models/Module_m.php');
            require_once('../_views/ModuleAttachement_v.php');
        }



        $this->created_by = new User();
        $this->edited_by = new User();
        $this->file = array();

        $this->loggedUser = new User();
        $this->loggedUser->fillUserDatabySession();


        $this->containerData["type"]=$this->module_type;



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
            $this->file          = Module_m::getModuleFiles($id);
            $this->created_by->fillUserDataById($this->containerData['created_by']);
            $this->edited_by->fillUserDataById($this->containerData['edited_by']);
        }
    }


    /**
     * Funkcia vypíše poh¾ad na modul
     */
    public function module($editable){
        ModuleAttachement_v::module($this->containerData, $this->contentData, $editable,$this->file);
    }
    /**
     * Funkcia vypíše pohľad na editoru modulu
     * @param  string $operation operácia ktorá sa má vykona po odoslaní formulára (insert/edit)
     */

    public function editor($operation){
        
        //natavenie url na odoslanie formulara
        if(isset($_GET["page_id"]) && $_GET["page_id"]!=0){
            $this->containerData['page_id'] = $_GET["page_id"];
        }

        $url = '_controllers/ModuleAttachement.php?'.$operation.'=true&page_id='.$this->containerData['page_id'].'&';
        
        if(isset($this->containerData["id"]) && $this->containerData["id"]!=0){
            $url = $url.'id='.$this->containerData["id"];
            $m_id=$this->containerData["id"];
        }
        else{
            $m_id=0;
        }


        ModuleAttachement_v::editor( $this->containerData, $this->contentData, $url,$this->file, $this->getOrderOptions($m_id));
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
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Description Error:</strong> Module description error.</div>';
            $success = false;
        }
        if(isset($_POST['file-path']) && isset($_POST['file-thumb']) && isset($_POST['file-thumb-medium']) && isset($_POST['file-title']) && isset($_POST['file-description'])){
            $count = count($_POST['file-path']);
            if(count($_POST['file-thumb']) == $count && count($_POST['file-thumb-medium']) == $count && count($_POST['file-title']) == $count && count($_POST['file-description']) == $count){
                $this->file=array();
                for($i=0;$i<$count;$i++){
                    if(file_exists('../'.$_POST['file-path'][$i]) &&file_exists('../'.$_POST['file-thumb'][$i]) &&file_exists('../'.$_POST['file-thumb-medium'][$i])){
                        $newFile=array(
                            'title'=>$_POST['file-title'][$i],
                            'description'=>$_POST['file-description'][$i],
                            'path'=>$_POST['file-path'][$i],
                            'thumb'=>$_POST['file-thumb'][$i],
                            'thumb-medium'=>$_POST['file-thumb-medium'][$i]
                            );
                        $this->file[] = $newFile;
                    }
                    else{
                        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>File Error:</strong> File "'.$_POST['file-title'][$i].'" currently unavailable. Try to add file again.</div>';
                        $success = false;
                    }
                }
                //echo count($this->file);
                /*
                foreach($this->file as $f){
                print_r($f);
                }*/
            }
            else{
                echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>File Error:</strong> Files info incorrect.</div>';
                $success = false;
            }
        }
        else{
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>File Error:</strong> Files are inserted incorrect.</div>';
            $success = false;
        }
        // --------------------------------------------------------------------
        /*if(isset($_POST['file-path']) && file_exists('../'.$_POST['file-path'][0])){
        $this->file["path"] = $_POST['file-path'][0];
        //echo "<pre>".$_POST['file-path'][0]."</pre>";
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
        }*/

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
            $resultContent = Module_m::insertInto($this->module_type, $this->contentData);
            $resultFile = 1;
            for($i=0;$i<count($this->file);$i++){
                $this->file[$i]["module_id"] = $resultContainer;
                $resultFile *= Module_m::insertInto('file', $this->file[$i]);
            }

            // $this->file["module_id"] = $resultContainer;
            // $resultFile = Module_m::insertInto('file', $this->file);
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
            Module_m::deleteFromWhere("file", "module_id", $this->containerData['id']);
            $resultFile = 1;
            for($i=0;$i<count($this->file);$i++){
                $this->file[$i]["module_id"] = $this->containerData['id'];
                $resultFile *= Module_m::insertInto('file', $this->file[$i]);
            }
            if($resultFile > 0){
                echo '<div class="alert alert-success" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Module was inserted successfully.</strong></div>';
                return true;
            }
            else{
                echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Problem with saving module to database.</div>';
                return false;
            }
        }
        else{
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Problem with saving module to database.</div>';
            return false;
        }
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
    public function getModuleTypeName(){
        return '<i class="fa fa-file-o"></i> Attachement';
    }
}



// --------- spracovanie poziadavky posielanej ajaxom ---------

// overenie ci sa vola ajax funkcia
if (isset($_GET["show_editor"]) || isset($_GET["insert"]) || isset($_GET["edit"]) || isset($_GET["delete"])) {
    
    $loggedUser = new User();
    $loggedUser->fillUserDatabySession();

    if ($loggedUser->isLoggedIn()) {

        // ak posielame poziadavku na vypisanie editora pre dany modul
        if( isset($_GET["show_editor"]) && $_GET["show_editor"] ){
            if(isset($_POST["id"]) && $_POST["id"]>0){
                $m = new ModuleAttachement($_POST["id"]);
                $m->editor("edit");
            }
            else{
                $m = new ModuleAttachement();
                $m->editor("insert");
            }
        }

        // ak spracuvame formular ktory ma vlozit modul
        if(isset($_GET["insert"]) && $_GET["insert"]){
            $m = new ModuleAttachement();
            if($m->getFormData()){
                $m->insert();
            }
        }


        // ak spracuvame formular ktory ma editovat modul
        if( isset($_GET["edit"]) && $_GET["edit"] ){
            if(isset($_GET["id"]) && $_GET["id"]>0){
                $m = new ModuleAttachement($_GET["id"]);
                if ($m->getFormData()){
                    $m->update();
                }
            }
        }

        // ak posielame poziadavku na vymazanie modulu s danum id
        if ( isset($_GET["delete"]) && $_GET["delete"]){
            if( isset($_POST["id"]) && $_POST["id"] > 0 ){
                $m = new ModuleAttachement($_POST["id"]);
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


// ------------------------------------------------------------

?>