<?php
if(!isset($_SESSION))
    session_start();
if(file_exists('module.php'))
    require_once('module.php');
if(file_exists('_controllers/module.php'))
    require_once('_controllers/module.php');
if(file_exists('_controllers/user.php'))
    require_once('_controllers/user.php');
if(file_exists('user.php'))
    require_once('user.php');

/*******************************  ModuleEmbeded  *******************************/
/**
 * ModuleEmbeded Kontroler
 *
 * Trieda na pracu s viewom a modelom modulu : ModuleEmbeded
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
*/
class ModuleEmbeded extends Module{
    /**
     * Konštruktor triedy kontrolera modulu ModuleEmbeded
     * @param integer $id ID modulu(ak je ID = 0 tak sa vytvorí prázdny objekt)
     */
    public function __construct($id=0){
        $this->module_type = "module_embeded";

        if(file_exists('_models/Module_m.php')&&file_exists('_views/ModuleEmbeded_v.php')) {
            require_once('_models/Module_m.php');
            require_once('_views/ModuleEmbeded_v.php');
        }
        if(file_exists('../_models/Module_m.php')&&file_exists('../_views/ModuleEmbeded_v.php')) {
            require_once('../_models/Module_m.php');
            require_once('../_views/ModuleEmbeded_v.php');
        }

        $this->created_by = new User();
        $this->edited_by = new User();

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
            $this->created_by->fillUserDataById($this->containerData['created_by']);
            $this->edited_by->fillUserDataById($this->containerData['edited_by']);
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
    public function module($editable){
        return ModuleEmbeded_v::module($this->containerData, $this->contentData, $editable);
    }
    /**
     * Funkcia vráti pohľad na editoru modulu
     * @param  string $operation operácia ktorá sa má vykonať po odoslaní formulára (insert/edit)
     * @return string html kód editora modulu
     */
    public function editor($operation){
        
        //natavenie url na odoslanie formulara
        if(isset($_GET["page_id"]) && $_GET["page_id"]!=0){
            $this->containerData['page_id'] = $_GET["page_id"];
        }

        $url = '_controllers/ModuleEmbeded.php?'.$operation.'=true&page_id='.$this->containerData['page_id'].'&';
        
        if(isset($this->containerData["id"]) && $this->containerData["id"]!=0){
            $url = $url.'id='.$this->containerData["id"];
            $m_id=$this->containerData["id"];
        }
        else{
            $m_id=0;
        }


        ModuleEmbeded_v::editor( $this->containerData, $this->contentData, $url, $this->getOrderOptions($m_id));
    }
    /**
     * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
     * @return boolean true ak sú dáta posielané z formulára validné / inak false
     */
    public function getFormData(){
        // Overenie zakladnych informaci o Userovi,Page a Module
        $success = $this->verify();

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
        if(isset($_POST['link']) && $_POST['link'] != "" ){
            if(strpos(strtolower($_POST['link']) ,'<iframe') !== false && strpos(strtolower($_POST['link']) ,'</iframe>') !== false){
                $this->contentData["link"] = $_POST['link'];
            }
            else{
                echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module link must contains &lt;iframe&gt;&lt;/iframe&gt; tag.</div>';
                $success = false;
            }
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
    public function getModuleTypeName(){
        return '<i class="fa fa-youtube-play"></i> Embeded';
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
                $m = new ModuleEmbeded($_POST["id"]);
                echo $m->editor("edit");
            }
            else{
                $m = new ModuleEmbeded();
                $m->editor("insert");
            }
        }

        // ak spracuvame formular ktory ma vlozit modul
        if( isset($_GET["insert"]) && $_GET["insert"]){
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
    }else {
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Permission denied:</strong> You dont have permissions to add/edit/del modules on this page.</div>';
   
    }    
}
// ------------------------------------------------------------

?>
