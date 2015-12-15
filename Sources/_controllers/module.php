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
   * Nastavenie poľa informácií o základných vlastnostiach modulu
   * @param int $page_id    stránka na ktorej je modul zobrazený
   * @param string $type    typ modulu
   * @param int $created_by id používateľa ktorý modul vytvoril
   * @param int $edited_by  id používateľa ktorý modul editoval
   * @param int $rows       počet riadkov modulu
   * @param int $cols       počet stĺpcov modulu
   * @param int $order      poradie modulu na stránke
   * @param int $status     status modulu(1-publikovaný, 0-skrytý)
   */
  public function setContainerData($page_id,$type,$created_by,$edited_by,$rows,$cols,$order,$status){
    $this->containerData=array(
      'page_id' => $page_id,
      'type' => $type,
      'created_by' => $created_by,
      'edited_by' =>$edited_by,
      'rows' => $rows,
      'cols' => $cols,
      'order' => $order,
      'status' => $status
    );
  }
}
?>