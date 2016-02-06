<?php

if(file_exists('user.php'))
    require_once('user.php');


if(!isset($_SESSION))
    session_start();
/**
 * Page Kontroler
 *
 * Trieda na pracu s viewom a modelom modulu : Page
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
*/
Class Page{

    /**
     * pole informacii o stranke
     * @var array
     */
    private $pageData;
    /**
     * pole modulov pre stranku
     * @var array
     */
    private $modules;
    /**
     * pouzivatel ktory vytvoril stranku
     * @var User
     */
    private $created_by;
    /**
     * informacie o kategorii pod ktoru patri page
     * @var [type]
     */
    private $category;
    /**
     * pouzivatel ktory posledny editoval stranku
     * @var User
     */
    private $edited_by;
    /**
     * Nainicializovane moduly s ktorymi vie page pracovat
     * @var array
     */
    private $newModules;
    /**
     * pole informácií o reprezentativnom obrazku 
     * @var array
     */
    public $file;
    
/**
 * Konštruktor triedy Page ktorý vytvorí objekt tejto triedy. 
 * 
 * Metóda dostáva ako parameter id ktoré určuje o ktorú stránku sa jedná.
 * Tento parameter je prednastavený na 0 a nieje povinný
 * @param integer $id id stránky
 */
    public function __construct($id=0){

        if(file_exists('_models/Page_m.php')&&file_exists('_views/Page_v.php')) {
            require_once('_models/Page_m.php');
            require_once('_views/Page_v.php');
        }
        if(file_exists('../_models/Page_m.php')&&file_exists('../_views/Page_v.php')) {
            require_once('../_models/Page_m.php');
            require_once('../_views/Page_v.php');
        }
       
        if(file_exists('_controllers/Category.php'))
            require_once('_controllers/Category.php');
        if(file_exists('Category.php'))
            require_once('Category.php');

        $this->loggedUser = new User();
        $this->loggedUser->fillUserDatabySession();

        $this->editors=array();
        $this->editorsInfo=array();
        $this->category = new Category();
        $this->pageData = array();

        $this->isOwner=true;
        $this->file = array();
        $this->setById($id);
        $this->modules=array();


    }

    /**
     * Metóda nastaví objekt podľa informácií získaných z databázy
     *
     * Parameter metódy je id stránky ktorá sa má nastaviť. Predvolená hodnota parametra je 0.
     * Funkcia vracia informácie o stránke
     *
     * @param integer $id Id stránky ktorá sa má získať z databázy.
     */
    public function setById($id=0){
        if($id != 0){     
            $this->pageData = Page_m::getPageData($id);
            if(sizeof($this->pageData) > 0) {
                $this->file = Page_m::getPageImage($id);

                $this->created_by = new User();
                $this->created_by->fillUserDataById($this->pageData['created_by']);

                $this->edited_by = new User();
                $this->edited_by->fillUserDataById($this->pageData['edited_by']);
                
                if($this->loggedUser->isLoggedIn())
                    $this->isOwner = $this->pageData["created_by"]==$this->loggedUser->userData["id"] || $this->loggedUser->isAdmin();
                
                $this->editors = Page_m::getEditors($this->pageData["id"]);
                $this->editorsInfo = Page_m::getEditorsInfo($this->pageData["id"]);

                $this->category->setById($this->pageData["category_id"]);
            }
            
        }
        return $this->pageData;
    }
    /**
     * Metóda nastavujúca všetky moduly ktoré je možné zobraziť na stránke.
     * 
     * Každý nový modul sa musí implementovať v tejto metóde.
     * Pri inicializácii modulov sa načítajú potrebné súbory na prácu s modulmi a vytvoria sa ich nové objekty.
     * 
     * @return Page Self objekt
     */
    public function initModules(){
        require_once('_controllers/ModuleImage.php');
        require_once('_controllers/ModuleVideo.php');
        require_once('_controllers/ModuleGallery.php');
        require_once('_controllers/ModuleEmbeded.php');
        require_once('_controllers/ModuleLink.php');
        require_once('_controllers/ModuleAttachement.php');
        require_once('_controllers/ModuleEmbeded.php');
        require_once('_controllers/ModuleFormated.php');
        $this->newModules = array(
            "module_image" => new ModuleImage(),
            "module_video" => new ModuleVideo(),
            "module_embeded" => new ModuleEmbeded(),
            "module_gallery" => new ModuleGallery(),
            "module_formated" => new ModuleFormated(),
            "module_attachements" => new ModuleAttachement(),
            "module_link" => new ModuleLink()
            );
        return $this;
    }

    /**
     * Metóda vytiahne všetky informácie o moduloch z databázy a zobrazí ich na stránke.
     * 
     * @param  boolean $editable príznak či majú byť moduly editovateľné
     * @return Integer            počet načítaných modulov
     */
    public function modules($editable=false){
        $count=0;
        $status = ($editable)?">= 0":"= 1";
        foreach (Page_m::getModules($this->pageData['id'], $status) as $key => $module) {
            $new = clone  $this->newModules[$module['type']];
            $new->setById( $module['id']);
            array_push($this->modules, $new);
        }
        foreach ($this->modules as $key => $module) {
            $module->module($editable);
            $count++;
        }
        return $count;
    }

   /**
    * Metóda zobrazí tlačidlo na pridávanie modulov
    */
    public function addModuleButton(){
        echo Page_v::addModuleButton();
    }

   /**
    * Metóda vypíše formuláre na úpravu modulov
    */
    public function modulesEditor(){
        Page_v::moduleEditor($this->newModules, $this->pageData["id"]);
    }

   /**
    * Funkcia zobrazí view pre header stránky
    * @param  string $title Titulka stránky
    * @param  array  $user  Informácie o používateľovi
    */
    public function header($title="", $user=array()){
        $actCategory = null;
        if(isset($_GET["category"])){
            $actCategory = new Category($_GET["category"]);
            $actCategory = $actCategory->categoryData;
        }
        if(isset($_GET["page"])){
            if($this->setById($_GET["page"])!=null)
                $actCategory = $this->category->categoryData;
        }
        Page_v::pageHead($title);
        Page_v::pageHeader(Page_m::getCategories(), Page_m::getHomePage(), Page_m::getNavbarPages(), $user, $actCategory);
    }

   /**
    * Metóda zobrazí view pre footer stránky
    */
    public function footer(){
        return Page_v::footer();
    }
    public function breadcrumbs($subsections=array(), $editable=false){
        $page=null;
        if(sizeof($this->pageData)>0){
            $page=array(
                    "id"=>$this->pageData["id"], 
                    "title"       =>$this->pageData["title"], 
                    "description" =>$this->pageData["description"], 
                );
        }
        if(sizeof($subsections)>0){
            Page_v::breadcrumbs($subsections, $page, $editable);
        }
    }
    public function pageInfo($editable=false){
        Page_v::pageInfo($this->pageData,$editable);
    }

    public function pageFooter(){
        $page=null;
        if(sizeof($this->pageData)>0){
            $page=array(
                    "image"       =>$this->file["thumb-medium"],
                    "author_id"   =>$this->created_by->userData["id"],
                    "editor_id"   =>$this->created_by->userData["id"],
                    "author"      =>$this->created_by->userData["first_name"]." ".$this->created_by->userData["last_name"],
                    "editor"      =>$this->edited_by->userData["first_name"]." ".$this->edited_by->userData["last_name"],
                    "edited"      =>$this->pageData["edited"],
                    "created"     =>$this->pageData["created"]
                    );
        }
        Page_v::pageFooter($page);

    }
    /**
    * Metóda zobrazí obsah stránky na základe parametrov nachádzajúcich sa v adrese prehliadača
    */
    public function pageContent($logedUser=null){


        if(sizeof($_GET)==0){
            
            
            if($this->setById(Page_m::getHomePage()["id"])!=null){
                $editable = $logedUser->isAdmin() || $logedUser->hasEditRights($this->pageData["id"]);
                if($editable) 
                    $this->addModuleButton();

                $count = $this->initModules()->modules($editable);
                if($count > 0 && $editable) 
                    $this->addModuleButton();
                    
                $this->modulesEditor();
            }
            else {
                return false;
            }
            return true;

  
        }



        if( isset($_GET["page"])){
            if($_GET["page"] > 0 && $this->setById($_GET["page"])!= null){
                $editable = $logedUser->isAdmin() || $logedUser->hasEditRights($this->pageData);
                if($this->pageData["status"]!=0 || $editable){
                   // print_r($logedUser->hasEditRights($this->pageData["id"]));
                    //print_r($this->edited_by->userData);
                   /* $breadcrumbs = array(
                        $this->category->categoryData["title"]=>"?category=".$this->category->categoryData["id"],
                        $this->pageData["title"]=>"?page=".$this->pageData["id"]
                        );
                    $this->breadcrumbs($breadcrumbs, $editable);*/
                    $this->pageInfo($editable);
                    if($editable){
                        $this->addModuleButton();
                    }
                    $count = $this->initModules()->modules($editable);
                    if($count > 0 && $editable){
                        $this->addModuleButton();
                    }
                    $this->pageFooter();
                    $this->modulesEditor();
                }

            }
            else{
                return false;
            }
            return true;
        }



        else if( isset($_GET["category"]) && $_GET["category"] > 0 ){
            $editable = $logedUser->isAdmin();
            $category = new Category($_GET["category"]);
            if($category != null){//status nastavit a upravit get category pagews
                /*$breadcrumbs = array(
                    $category->categoryData["title"]=>"?category=".$category->categoryData["id"],
                    );

                $this->breadcrumbs($breadcrumbs);*/
                $status = ($editable)?">= 0":"= 1";

                $pages = Page_m::getCategoryPages($_GET["category"], $status);
                foreach ($pages as $key => $p) {
                    $pge = new Page($p["id"]);
                    $pge->preview($editable,2);
                }
            }
            else{
                return false;
            }
            return true;
        }

        else if(isset($_GET["q"])){
            if(strlen($_GET["q"]) > 0){
                $editable = $logedUser->isAdmin();
                $term = "%".$_GET["q"]."%";
                $status = ($editable)?">= 0":"= 1";
                $pages = Page_m::getSearchPages($term, $status);

                $this->printAlert("success", "Search Result: ", sizeof($pages). " pages was found.");
                foreach ($pages as $key => $p) {
                    $pge = new Page($p["id"]);
                    $pge->preview($editable,2);
                }
            }
            else{
                $this->printAlert("warning", "Search Result: ", "Searched term must contains atleast 1 character");
            }
            return true;
        }
        return false;
    }

    /**
     * Metóda zobrazí pohľad pre zoznam stránok pre administrátora
     *
     * Metóda sa nastavuje vstupnými parametrami na základe ktorých sa vypíše obsah pohľadu
     * 
     * @param  integer $col     obmedzenie stlĺpca
     * @param  integer $value   hodnota stĺpca
     * @param  string  $orderBy stĺpec podľa ktorého majú byž údaje zoradené
     */
    public function pageListAdminWhere($col = 1, $value = 1, $orderBy = "id"){
        $pages = Page_m::getPagesWhere($col, $value, $orderBy);
        Page_v::pageListAdmin($pages);
    }

    /**
     * Metóda zobrazí pohľad pre zoznam stránok pre používateľa
     *
     * Metóda sa nastavuje vstupnými parametrami na základe ktorých sa vypíše obsah pohľadu
     * 
     * @param  integer $col     obmedzenie stlĺpca
     * @param  integer $value   hodnota stĺpca
     * @param  string  $orderBy stĺpec podľa ktorého majú byž údaje zoradené
     */
    public function pageListUserWhere($col = 1, $value = 1, $orderBy = "id"){
        $pages = Page_m::getPagesWhere($col, $value, $orderBy);
        Page_v::pageListUser($pages);

    }
    /**
     * Metóda nastavuje stránku ako homepage
     */
    public function setHomePage(){
        Page_m::setHomePage($this->pageData["id"]);

    }

    /**
     * Metóda nastavuje stránku aby bola zobrazená v navigačnej lište
     * @param integer $value id stránky
     */
    public function setNavbarPage( $value = 0 ){
        Page_m::setNavbarPage($this->pageData["id"], $value);
    }

    /**
     * Metóda nastavuje stránku ako homepage
     * @param integer $value id stránky
     */
    public function setPageStatus($value = 0){
        Page_m::setStatusPage($this->pageData["id"], $value);
    }


   /**
     * Metóda zobrazí pohľad pre náhľady stránok
     *
     * Metóda sa nastavuje vstupnými parametrami na základe ktorých sa vypíše obsah pohľadu
     * 
     * @param  integer $col     obmedzenie stlĺpca
     * @param  integer $value   hodnota stĺpca
     * @param  string  $orderBy stĺpec podľa ktorého majú byž údaje zoradené
     * @param  integer $cols    šírka náhľadu
     * @param  boolean $editable príznak či má byť náhľad editovateľný
     */
    public function previewAllWhere($column=1,$value=1,$order_by="id",$cols=1,$editable=false){
        $pages = Page_m::getPagesJoinedWhere($column,$value, $order_by);
        foreach ($pages as $key => $page) {
            $category = array(
                "title"=>$page["category_title"],
                "id"=>$page["category_id"]
                );

            $file = array(
                "thumb-medium" => $page["file_thumb-medium"]
                );

            Page_v::preview($editable, $page, $category, $file, $cols);
        }
    }
    /**
     * Metóda zobrazí pohľad pre náhľad stránky
     * @param  boolean $editable príznak určujúci či je v náhľade možnosť editácie stránky
     * @param  integer $cols     šírka náhľadu na stránke
     */
    public function preview($editable=false,$cols=1){
        Page_v::preview($editable, $this->pageData, $this->category->categoryData, $this->file,$cols);
        return $this;
    }

    /**
     * Funkcia zobrazí pohľad pre editor stránky
     *
     * Nastavuje sa tu adresa na ktorej sa majú spracovať informácie z editora
     * 
     * @param  string $operation operácia ktorá sa má vykonať po odoslaní formulára v editore
     */
    public function editor($operation=""){
        $url = '_controllers/page.php?'.$operation.'=true';
        if(isset($this->pageData["id"]) && $this->pageData["id"]!=0) {
            $url = $url.'&id='.$this->pageData["id"];
        }


        $users = Page_m::getUsersExcept($this->loggedUser->userData["id"]);
        $categories = Page_m::getCategories();
        if($operation=="insert"){
            Page_v::editor($url, $this->pageData, $categories, $users,true);
        }
        else{
            Page_v::editor($url, $this->pageData, $categories, $users, $this->isOwner, $this->file,  $this->editorsInfo,  $this->created_by->userData);
        }

    }
    public function printAlert($type="primary", $title, $message){
        echo '<div class="alert alert-'.$type.'" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$title.' </strong> '.$message.'</div>';
    }


    /**
     * Metóda overuje dáta odosielané z formulára a vypisuje chybové hlášky pri nesprávnych vstupných dátach
     * @return boolean hodnota či sú vstupné parametre v poriadku
     */
    public function getFormData(){
        $success = true;

        // ----------- Overenie uzivatelskych práv ----------------START
        // Overenie ci je uzivatel prihlaseny
        if(!$this->loggedUser->getUserID()!=0){
            $this->printAlert("danger", "Permission Error:", "You must be logged in");
            return false;
        }

        // ----------- Pridanie novej stranky --------------- START

        if(isset($_GET['insert'])){
            $this->pageData["created_by"] = $this->loggedUser->getUserID();    // Nastavi modulu created_by id uzivatela ktorý ho vytvoril
            $this->pageData["edited_by"] = $this->loggedUser->getUserID();     // nastavi modulu edited_by id uzivatela ktory ho upravil
            if(isset($_POST['editor-id'])){
                for ($i=0; $i < count($_POST['editor-id']); $i++) { 
                    $this->editors[] = array("user_id" => $_POST['editor-id'][$i]);            
                }
            }
            
            $this->pageData["created"] = date("Y-m-d H:i:s", time());  
            $this->pageData["edited"] =  date("Y-m-d H:i:s", time()); 

        }
        // ----------- Pridanie novej stranky --------------- END

        if(!($this->loggedUser->isAdmin() || $this->loggedUser->hasEditRights($this->pageData))){
            $this->printAlert("danger", "Permission Error: ", "You don\'t have prermission to insert or edit this module.");
            return false;
        }

        // ----------- Editacia existujucej stranky ----------------- START
        if(isset($_GET['edit'])){

            // overenie ci je zadane id stranky ktory sa ma editovat 
            if(!(isset($_GET['id']) && $_GET['id'] > 0) ){
                $this->printAlert("danger", "Page Error:", "You cannot update this page (wrong page_id)");
                return false;
            }
            $this->pageData["edited"] =  date("Y-m-d H:i:s", time());          // Nastavenie casu kedy bol modul upravovany 
            $this->pageData["edited_by"] = $this->loggedUser->getUserID(); // Nastavi modulu edited_by id uzivatela ktory upravoval modul
            $this->pageData["id"] = $_GET['id'];                           // Nastavi modulu jeho id z url
            
            // ak je vlastnik stranky tak moze menit editorov
            $this->editors=null;
            if($this->loggedUser->userData["id"]==$this->pageData["created_by"] || $this->loggedUser->isAdmin()){
                $this->editors = array();
                if(isset($_POST['editor-id'])){
                    for ($i=0; $i < count($_POST['editor-id']); $i++) { 
                        $this->editors[] = array("user_id" => $_POST['editor-id'][$i],"page_id" => $this->pageData["id"]);            
                    }
                }
            }
        }
        // ----------- Editacia existujucej stranky -------- END
        // 
        // overenie a ulozenie titulky 
        if(!(isset($_POST['title']) && strlen($_POST['title']) >= 3)){
            $this->printAlert("danger", "Title Error:", "Title must contains more than 2 characters.");
            $success = false;
        }
        // overenie a ulozenie popisu 
        if(!(isset($_POST['description']))){
            $this->printAlert("danger", "Description Error:", "Description is incorrect.");
            $success = false;
        }
        if(!(isset($_POST['category_id']) && $_POST['category_id']>0)){
            $this->printAlert("danger", "Category Error:", "Category must be selected.");
            $success = false;
        }

        $this->pageData["title"] = $_POST['title'];       
        $this->pageData["description"] = $_POST['description'];
        $this->pageData["category_id"] = $_POST['category_id'];       

       // ------- reprezentativny obrazok ------------------------------------START
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
         // ------- reprezentativny obrazok ------------------------------------END

        // --------- Ak nacitanie udajov zlyha --------------------------------
        if ($success != true){
            $this->printAlert("danger", "Save Error:", "Module data corrupted.");
        }
        // --------------------------------------------------------------------

        return $success;
    }


    /**
     * Metóda vloží hodnoty objektu stránky do databázy
     * 
     * @return boolean príznak či sa funkcia vykonala úspešne
     */
    public function insert(){
        $this->pageData['id'] = Page_m::insertInto("page", $this->pageData);
        if ($this->pageData['id'] > 0){
            $this->file["page_id"] = $this->pageData['id'];
            $resultFile = Page_m::insertInto('file', $this->file);
            $resultEditors = 1;
            for($i=0;$i<count($this->editors);$i++){
                $this->editors[$i]["page_id"] = $this->pageData['id'];
                $resultEditors *= Page_m::insertInto('edit_rights', $this->editors[$i]);
            }
            
            if($resultFile>0 && $resultEditors>0){
                $this->printAlert("success", "Page was saved successfully.", "");
                return true;
            }
            else{
                $this->delete();
                $this->printAlert("danger", "Insertion Error:", "Problem with saving file/editors to database.");
            }
        }
        $this->printAlert("danger", "Insertion Error:", "Problem with saving page to database.");
        return false;
    }


    /**
     * Metóda upraví hodnoty objektu stránky v databáze
     * 
     * @return boolean príznak či sa funkcia vykonala úspešne
     */
    public function update(){
        if(isset($this->pageData['id']) && $this->pageData['id'] > 0 ){
            Page_m::update("page", $this->pageData, "id",$this->pageData['id']);
            Page_m::update("file", $this->file, "page_id",$this->pageData['id']);

            $resultEditors = 1;
            if($this->editors != null && $this->loggedUser->userData["id"] = $this->pageData["created_by"]){
                Page_m::deleteFromWhere("edit_rights", "page_id", $this->pageData['id']);
                for($i=0;$i<count($this->editors);$i++){
                    $resultEditors *= Page_m::insertInto('edit_rights', $this->editors[$i]);
                }
            }

            if($resultEditors>0){
                $this->printAlert("success", "Page was updated successfully.", "");
                return true;
            }
            else{
                $this->printAlert("danger", "Update Error:", "Problem with saving editors page to database.");
                
            }
        }
        $this->printAlert("danger", "Update Error:", "Problem with saving page to database.");
        return false;
    }
    public function delete(){
        if(isset($this->pageData['id']) && $this->pageData['id'] > 0 ){
            Page_m::deleteFrom("page", $this->pageData['id']);
            return true;
        }
        return false;
    }
}

// ---------- Spracovanie ajax requestov admin a pouzivatel s pravami  ------------ START

// overenie ci sa vola ajax funkcia
if (isset($_GET["show_editor"]) 
    || isset($_GET["insert"]) 
    || isset($_GET["edit"]) 
    || isset($_GET["delete"])
    || isset($_POST["set_navbar"]) 
    || isset($_POST["set_home"]) 
    || isset($_POST["set_status"]) ) {
    
    $loggedUser = new User();
    $loggedUser->fillUserDatabySession();

    if ($loggedUser->isLoggedIn()) {
        // ak posielame poziadavku na vypisanie editora pre dany modul
        if(isset($_GET["show_editor"]) && $_GET["show_editor"] ){
            if(isset($_POST["id"]) && $_POST["id"]>0){
                $p = new Page($_POST["id"]);
                echo $p->editor("edit");
            }
            else{
                $p = new Page();
                $p->editor("insert");
            }
        }

        // ak spracuvame formular ktory ma vlozit modul
        if( isset($_GET["insert"]) && $_GET["insert"]){
            $p = new Page();
            if($p->getFormData()){
                $p->insert();
            }
        }


        // ak spracuvame formular ktory ma editovat modul
        if( isset($_GET["edit"]) && $_GET["edit"] ){
            if(isset($_GET["id"]) && $_GET["id"]>0){
                $p = new Page($_GET["id"]);
                if ($p->getFormData()){
                    $p->update();
                }
            }
        }

        // ak posielame poziadavku na vymazanie modulu s danum id
        if ( isset($_GET["delete"]) && $_GET["delete"]){
            if( isset($_POST["id"]) && $_POST["id"] > 0 ){
                $p = new Page($_POST["id"]);
                if($p->delete()){
                    echo '<strong>Page was deleted.</strong>';
                }
                else{
                    echo '<strong>Delete Error:</strong> Delete was unsuccessfull.';
                }
            }
            else{
                echo '<strong>Delete Error:</strong> Unknown page.';
            }
        }    
        if(isset($_POST["set_navbar"]) 
            || isset($_POST["set_home"]) 
            || isset($_POST["set_status"]) ){
            
            if ($loggedUser->isAdmin()) {
                if ( isset($_POST["set_navbar"])){
                    if(isset($_POST["id"]) && $_POST["id"]>0){
                        $p = new Page($_POST["id"]);
                        $val = ($_POST["set_navbar"] == 1)?1:0;
                        $p->setNavbarPage($val);
                    }
                }

                //nastavenie stranky aby sa zobrazovala ako home.. hodnota $_POST["set_home"] je id stranky
                if ( isset($_POST["set_home"])){
                    if(isset($_POST["id"]) && $_POST["id"]>0){
                        $p = new Page($_POST["id"]);
                        $p->setHomePage();
                    }
                }
                //nastavenie stranky aby sa zobrazovala.. hodnota $_POST["set"] je id stranky
                if ( isset($_POST["set_status"])){
                    if(isset($_POST["id"]) && $_POST["id"]>0){
                        $p = new Page($_POST["id"]);
                        $val = ($_POST["set_status"] == 1)?1:0;
                        $p->setPageStatus($val);
                    }
                }
            }
            else {
             echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Permission denied:</strong> You dont have permissions to add/edit/del this page.</div>';
            }  
        }
    }else{
     echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Permission denied:</strong> You dont have permissions to add/edit/del this page.</div>';
    }    
}

?>
