<?php
/**
 * Abstraktná trieda pre moduly,
 * ktorá definuje základnú povinnú funkčnosť pre všetky typy modulov.
 * @abstract
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
  public $file          = array();
  /**
   * pole child modulov modulu( gallery > image )
   * @var array
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
  abstract static public function getModuleTypeName();
  /**
   * Funkcia vráti view pre modul na stránke
   * @return string html kód pre modul
   * @abstract
   */
  abstract public function module();
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
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You must be loged in.</div>';
            return false;
        }
        // Overenie ci ma uzivatel pravo editovat alebo vkladat nove moduly
        if(!$this->loggedUser->isAdmin()){
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error:</strong> You don\'t have prermission to insert or edit this module.</div>';
            return false;
        }

        // ----------- Overenie uzivatelskych práv ----------------END
        
        // ----------- Pridanie noveho modulu na stranku -------- START

        if(isset($_GET['insert'])){
        
            //  Overenie ci je nastavene v url page_id na 
            //TODO: Vyrobit funkciu na overenie ci page_id patri do zoznamu nasich existujucich stranok
            if(!(isset($_GET['page_id']) && $_GET['page_id'] > 0)){
                echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Page_ID is wrog.</div>';
                return false;
            }

       // nastavenie container dat
        $this->containerData["page_id"] = $_GET['page_id'];                     // Priradi modulu page_id stranky na ktorej sa bude zobrazovat 
        $this->containerData["created_by"] = $this->loggedUser->getUserID();    // Nastavi modulu created_by id uzivatela ktorý ho vytvoril
        $this->containerData["edited_by"] = $this->loggedUser->getUserID();     // nastavi modulu edited_by id uzivatela ktory ho upravil

        }
        // ----------- Pridanie noveho modulu na stranku --------------- END

        // ----------- Editacia existujuceho modulu na stranke -------- START
        if(isset($_GET['edit'])){

            // overenie ci je zadane id modulu ktory sa ma editovat 
            //TODO: Vytvorit funkciu na overenie ci dane id modulu evidujeme v nasej databaze
            if(!(isset($_GET['id']) && $_GET['id'] > 0) ){
                echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> You cannot update this module (wrong module_id inserted).</div>';
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
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Number of module rows must be greater than 0.</div>';
            $success = false;
        }
        
        // Spravne zadanie poctu stlpcov
        if(!(isset($_POST['cols']) && $_POST['cols']>=1 && $_POST['cols']<=4)){
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Number of module columns must be greater than 0.</div>';
            $success = false;   
        }
      
        // Spravneho zadanie statusu
        if(!(isset($_POST['status']) && $_POST['status']>=0 && $_POST['status']<=1)) {
            //  Ak je chybne uvedena hodnota statusu vyhodi chybu
            echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Error:</strong> Module status is not correct.</div>';
            $success = false;

        }else if($_POST['status']==0){
            // Ak je status nastaveny ako skryty tak vyhodi warning
            echo '<div class="alert alert-warning" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Insertion Warning:</strong> Module is hidden.</div>';
        }

        $this->containerData["rows"] = $_POST['rows'];      // Nastavi modulu velkost - vysku
        $this->containerData["cols"] = $_POST['cols'];      // Nastavi modulu velkost - sirka
        $this->containerData["status"] = $_POST['status'];  // Nastavi modulu status - visibility

       // ----------- Overenie spravneho zadania rozmerov a statusu-------- END
    
     return $success;
    }
}
?>