<?php
if(file_exists('../_views/Module_v.php'))
    require_once('../_views/Module_v.php');
if(file_exists('_views/Module_v.php'))
    require_once('_views/Module_v.php');

/**
 * Abstraktná trieda pre moduly,
 * ktorá definuje základnú povinnú funkčnosť pre všetky typy modulov.
 *
 * 
 * @version 1.0
 * @author KRASNAN
 * @package ModuleController
 */
abstract class Module{
  /**
   * pole informácií o zakládných vlastnostiach modulu
   *  @var  array
   */
  public $containerData = array();
  /**
   * pole informácií o obsahu modulu
   * @var array
   */
  public $contentData   = array();
  /**
   * pole informácií o priložených súboroch modulu 
   * @var array
   */
  public $file;
  /**
   * pole child modulov modulu( gallery > image )
   * @var File
   */
  public $childsData    = array();
  /**
   * používateľ ktorý vytvoril modul
   * @var User
   */
  public $created_by;
  /**
   * používateľ ktorý editoval modul
   * @var User
   */
  public $edited_by;
  /**
   * aktuálne prihlásený používateľ
   * @var User
   */
  public $loggedUser;
  /**
   * typ modulu
   * @var string
   */
  public $module_type;



  /**
   * Konštruktor abstraktnej triedy Module
   * @param [type] $id [description]
   * @abstract
   */
  abstract function __construct($id);
  /**
   * Nastavenie Modulu podľa zadaného ID
   * @param integer $id ID modulu
   */
  abstract public function setById($id);
    /**
   * Funkcia vráti názov typu modulu
   * @return string 
   * @abstract
   */
  abstract public function getModuleTypeName();
  /**
   * Funkcia vráti view pre modul na stránke
   * @return string html kód pre modul
   * @abstract
   */
  abstract public function module($editable);
  /**
   * Funkcia vráti view pre editor modulu
   * @param  String $operation Operácia ktorá sa má vykonať po odoslaní formulára (Editovanie/Vloženie)
   * @return string html kód editora modulu
   * @abstract
   */
  abstract public function editor($operation);

/**
 * Funkcia nacita data z post premennych ktore sa odoslu po submitnuti fomulara
 * @return [type] [description]
 */
  abstract public function getFormData();
  
  /**
   * Funkcia vloží modul do DB
   * @return boolean true ak vloží úspešne / false ak nastane chyba
   * @abstract
   */
  abstract public function insert();
  /**
   * Funkcia zmení informácie o module v DB
   * @return boolean true ak zmení úspešne / false ak nastane chyba
   * @abstract
   */
  abstract public function update();
  /**
   * Funkcia zmaže modul z DB
   * @return boolean true ak zmaže úspešne / false ak nastane chyba
   * @abstract
   */
  abstract public function delete();


    /**
     * Funkcia uloží validné premenné odoslané z formulára a uloží ich do vnútornej štruktúry objektu
     * Overuje prihlasenie pouzivatela, administratorske prava pouzivatela, spravnost id pre modul a page,
     * rozmery sirku a vysku modulu, status
     * @return boolean true ak sú dáta posielané z formulára validné / inak false
     */
    public function verify(){

        $success = true;

        // ----------- Overenie uzivatelskych práv ----------------START
        // Overenie ci je uzivatel prihlaseny
        if(!$this->loggedUser->getUserID()!=0){
            $this->printAlert("danger", "Permission Error:", "You must be logged in");
            return false;
        }


        // ----------- Overenie uzivatelskych práv ----------------END
        
        // ----------- Pridanie noveho modulu na stranku -------- START

        if(isset($_GET['insert'])){
        
            //  Overenie ci je nastavene v url page_id na 
            //TODO: Vyrobit funkciu na overenie ci page_id patri do zoznamu nasich existujucich stranok
            if(!(isset($_GET['page_id']) && $_GET['page_id'] > 0)){
                $this->printAlert("danger", "Page Error:", "Wrong page.");
                return false;
            }

           // nastavenie container dat
            $this->containerData["page_id"] = $_GET['page_id'];                     // Priradi modulu page_id stranky na ktorej sa bude zobrazovat 
            $this->containerData["created_by"] = $this->loggedUser->getUserID();    // Nastavi modulu created_by id uzivatela ktorý ho vytvoril
            $this->containerData["edited_by"] = $this->loggedUser->getUserID();     // nastavi modulu edited_by id uzivatela ktory ho upravil
            $this->containerData["edited"] = date("Y-m-d H:i:s", time());  
            $this->containerData["created"] = date("Y-m-d H:i:s", time());  
        }
        // ----------- Pridanie noveho modulu na stranku --------------- END
        // Overenie ci ma uzivatel pravo editovat alebo vkladat nove moduly
        // 
        $pageRights = array("id"=>$this->containerData["page_id"], "created_by" => $this->containerData["edited_by"]);
        if(!($this->loggedUser->isAdmin() || $this->loggedUser->hasEditRights($pageRights))){
            $this->printAlert("danger", "Permission Error:", "You don\'t have prermission to insert or edit this module.");
            return false;
        }
        // ----------- Editacia existujuceho modulu na stranke -------- START
        if(isset($_GET['edit'] )){

            // overenie ci je zadane id modulu ktory sa ma editovat 
            //TODO: Vytvorit funkciu na overenie ci dane id modulu evidujeme v nasej databaze
            if(!(isset($_GET['id']) && $_GET['id'] > 0) ){
                $this->printAlert("danger", "Module Error:", "You cannot update this module (wrong module_id)");
                return false;
            }
            
            $this->containerData["edited"] = date("Y-m-d H:i:s", time());       // Nastavenie casu kedy bol modul upravovany 
            $this->containerData["edited_by"] = $this->loggedUser->getUserID(); // Nastavi modulu edited_by id uzivatela ktory upravoval modul
            $this->containerData["id"] = $_GET['id'];                           // Nastavi modulu jeho id z url

        }
        // ----------- Editacia existujuceho modulu na stranke -------- END
        
        // ----------- Overenie spravneho zadania rozmerov a statusu-------- START

        // Spravne zadanie poctu riadkov
        if(!(isset($_POST['rows']) && $_POST['rows']>=0 && $_POST['rows']<=4)){
            $this->printAlert("danger", "Rows Error:", "Number of module rows must be greater than 0 - 4");
            $success = false;
        }
        
        // Spravne zadanie poctu stlpcov
        if(!(isset($_POST['cols']) && $_POST['cols']>=1 && $_POST['cols']<=4)){
            $this->printAlert("danger", "Columns Error:", "Number of module columns must be between 1 - 4");
            $success = false;   
        }
        // Spravne zadanie orderu
        if(!(isset($_POST['order']) && $_POST['order']>=0)){
            $this->printAlert("danger", "Order Error:", "Wrong order value selected.");
            $success = false;   
        }
      
        // Spravneho zadanie statusu
        if(!(isset($_POST['status']) && $_POST['status']>=0 && $_POST['status']<=1)) {
            //  Ak je chybne uvedena hodnota statusu vyhodi chybu
            $this->printAlert("danger", "Status Error:", "Module status is not correct.");
            $success = false;

        }else if($_POST['status']==0){
            // Ak je status nastaveny ako skryty tak vyhodi warning
            $this->printAlert("warning", "Status Warning:", "Module is hidden.");
        }

        $this->containerData["rows"] = $_POST['rows'];      // Nastavi modulu velkost - vysku
        $this->containerData["cols"] = $_POST['cols'];      // Nastavi modulu velkost - sirka
        $this->containerData["status"] = $_POST['status'];  // Nastavi modulu status - visibility
        $module_id = (isset($this->containerData["id"]))? $this->containerData["id"] : 0; 
        $this->containerData["order"] = $this->getNewOrderValue($this->containerData["page_id"], $_POST['order'],$module_id);


       // ----------- Overenie spravneho zadania rozmerov a statusu-------- END
    
     return $success;
    }
  /**
   * Funkcia vygeneruje zoznam moznosti pre select  
   * @param  [type] $m_id [description]
   * @return [type]       [description]
   */
  
/**
* Funkcia vygeneruje zoznam moznosti pre select  
 * @param  string $m_id           id modulu ktorý budem presúvať 
 * @return string $order_options  vráti string moznosti ako preusporiadať modul na stránke
 */
  public function getOrderOptions($m_id=""){
        //nacitanie order moznosti
        $order_options="";
        $modules = Module_m::getPageModules($this->containerData['page_id']);
        for ($i=0; $i < sizeof($modules)-1 ; $i++) { 
            if($m_id == $modules[$i]["id"])
                $order_options = $order_options. '<option selected value="'.($i+1).'">'.($i+1).' (actual)</option>';
            
            else
                $order_options = $order_options. '<option value="'.($i+1).'">'.($i+1).'</option>';
            
        }
        if(sizeof($modules) == 0 || $m_id==$modules[sizeof($modules)-1]["id"]) $order_options = $order_options. '<option selected value="0">Last(actual)</option>';
        else if($m_id > 0) $order_options = $order_options. '<option value="0">Last</option>';
        else $order_options = $order_options. '<option value="0" selected>Last</option>';
        return $order_options;
  }  
  /**
   * [getNewOrderValue description]
   * @param  integer $page_id   Id page na ktorej je daný modul
   * @param  integer $order     Poradie modulu na stránke
   * @param  integer $module_id id modulu
   * @return integer $actual    Vráti novú hodnotu poradia
   */
  public function getNewOrderValue($page_id=0, $order=0, $module_id=0){
    //$order = $this->containerData["order"];
    //$page_id = $this->containerData["page_id"];
    
    //ak je prvy
    $actual = Module_m::getOrderValue($page_id, $order, $module_id);
    if($order==1){ 
      return $actual - 1; 
    }
    // ak je posledny
    if($order == 0) { 
      $cnt = Module_m::count("page_id", $page_id);
      if($module_id > 0) $cnt--;
      return Module_m::getOrderValue($page_id, $cnt, $module_id)+1;
    }
    
    //ak neexistuje
    if($actual == null){ 
      return null; 
    }

    $prev = Module_m::getOrderValue($page_id, $order-1, $module_id);
    $new = ($actual + $prev) / 2;
    return $new;
  }
  public function printAlert($type="primary", $title, $message){
    echo '<div class="alert alert-'.$type.'" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'.$title.' </strong> '.$message.'</div>';
  }
}




?>