<?php
if(file_exists('user.php'))
    require_once('user.php');

if(!isset($_SESSION))
    session_start();
/**
 * Category Kontroler
 *
 * Trieda na pracu s viewom a modelom modulu : Category
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
*/
Class Category{
    /**
     * informacie o kategorii
     * @var [type]
     */
    public $categoryData;

    private $logedUser;
    /**
     * Konštruktor metódy Category
     * @param integer $id [description]
     */
    public function __construct($id=0){
        if(file_exists('_models/Category_m.php')&&file_exists('_views/Category_v.php')) {
            require_once('_models/Category_m.php');
            require_once('_views/Category_v.php');
        }
        if(file_exists('../_models/Category_m.php')&&file_exists('../_views/Category_v.php')) {
            require_once('../_models/Category_m.php');
            require_once('../_views/Category_v.php');
        }


        $this->categoryData = array();
        $this->loggedUser = new User();
        $this->loggedUser->fillUserDatabySession();
        $this->setById($id);
    }
    public function setById($id=0){
        if($id != 0){     
            $this->categoryData = Category_m::get($id);
        }
        return $this->categoryData;
    }

    public function previewEditable($data=null){
        if($data==null)
            $data =$this->categoryData;
        
        Category_v::previewEditable($data);
    }
    public function previewList(){
        $cat = Category_m::getCategoriesWhereOrder();
        Category_v::previewEditable($cat);

    }


    public function editor($operation){
        $url = '_controllers/Category.php?'.$operation.'=true';
        if(isset($this->categoryData["id"]) && $this->categoryData["id"]!=0) {
            $url = $url.'&id='.$this->categoryData["id"];
        }

        if($operation=="insert_category"){
            Category_v::editor($url);
        }
        else{
            Category_v::editor($url, $this->categoryData);
        }

    }

    public function insert(){
        $this->categoryData['id'] = Category_m::insertInto("page_category", $this->categoryData);
        if ($this->categoryData['id'] > 0){
                $this->printAlert("success", "Category was saved successfully.", "");
            return true;
        }
        $this->printAlert("danger", "Update Error:", "Problem with saving category to database.");
        return false;
    }


    public function update(){
        if(isset($this->categoryData['id']) && $this->categoryData['id'] > 0 ){
            Category_m::update("page_category", $this->categoryData, "id",$this->categoryData['id']);
            $this->printAlert("success", "Category was saved successfully.", "");
            return true;
        }
        $this->printAlert("danger", "Update Error:", "Problem with saving category to database.");
        return false;
    }
    public function delete(){
        if(isset($this->categoryData['id']) && $this->categoryData['id'] > 0 ){
            Category_m::deleteFrom("page_category", $this->categoryData['id']);
            return true;
        }
        return false;
    }


    public function getFormData(){
        $success = true;

        // ----------- Overenie uzivatelskych práv ----------------START
        // Overenie ci je uzivatel prihlaseny
        if(!$this->loggedUser->getUserID()!=0){
            $this->printAlert("danger", "Permission Error:", "You must be logged in");
            return false;
        }
        if(!($this->loggedUser->isAdmin())){
            $this->printAlert("danger", "Permission Error:", "You don\'t have prermission to insert or edit this module.");
            return false;
        }
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
        $this->categoryData["title"] = $_POST['title'];       
        $this->categoryData["description"] = $_POST['description'];

        // --------- Ak nacitanie udajov zlyha --------------------------------
        if ($success != true){
            $this->printAlert("danger", "Save Error:", "Module data corrupted.");
        }
        // --------------------------------------------------------------------

        return $success;
    }
        public function printAlert($type="primary", $title, $message){
        echo '<div class="alert alert-'.$type.'" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$title.' </strong> '.$message.'</div>';
    }




}

// overenie ci sa vola ajax funkcia
if (isset($_GET["show_editor_category"]) 
    || isset($_GET["insert_category"]) 
    || isset($_GET["edit_category"]) 
    || isset($_GET["delete_category"])) {
    
    $loggedUser = new User();
    $loggedUser->fillUserDatabySession();

    if ($loggedUser->isLoggedIn() && $loggedUser->isAdmin()) {

            // ak posielame poziadavku na vypisanie editora pre dany modul
                if(isset($_GET["show_editor_category"]) && $_GET["show_editor_category"] ){
                    if(isset($_POST["id"]) && $_POST["id"]>0){
                        $p = new Category($_POST["id"]);
                        echo $p->editor("edit_category");
                    }
                    else{
                        $p = new Category();
                        $p->editor("insert_category");
                    }
                }

                // ak spracuvame formular ktory ma vlozit modul
                if( isset($_GET["insert_category"]) && $_GET["insert_category"]){
                    $p = new Category();
                    if($p->getFormData()){
                        $p->insert();
                    }
                }


                // ak spracuvame formular ktory ma editovat modul
                if( isset($_GET["edit_category"]) && $_GET["edit_category"] ){
                    if(isset($_GET["id"]) && $_GET["id"]>0){
                        $p = new Category($_GET["id"]);
                        if ($p->getFormData()){
                            $p->update();
                        }
                    }
                }

                // ak posielame poziadavku na vymazanie modulu s danum id
                if ( isset($_GET["delete_category"]) && $_GET["delete_category"]){
                    if( isset($_POST["id"]) && $_POST["id"] > 0 ){
                        $p = new Category($_POST["id"]);
                        if($p->delete()){
                            echo '<strong>Category was deleted.</strong>';
                        }
                        else{
                            echo '<strong>Delete Error:</strong> Delete was unsuccessfull.';
                        }
                    }
                    else{
                        echo '<strong>Delete Error:</strong> Unknown category.';
                    }
                }
    }
    else {
        echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Permission denied:</strong> You dont have permissions to add/edit/del this category.</div>';
    }  
}

