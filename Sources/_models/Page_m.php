<?php
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');

Class Page_m{

  /**
   * Vloží údaje z asociativneho poľa do tabuľky
   * @param  string $table tabuľka
   * @param  array  $data  asociatívne pole, ktorého indexy sú zhodné so stĺpcami v databáze
   * @return boolean       true ak vloží úspešne / false ak nastane chyba
   */
  public static function insertInto($table, $data){
    $fields=array_keys($data);
    $values=array_values($data);
    $fieldlist=implode("`, `",$fields);
    $qs=str_repeat("?,",count($fields)-1);
    $sql="INSERT INTO `$table`(`$fieldlist`) VALUES (${qs}?)";
    $result = Db::insert($sql, $values);
    return $result;
  }
  /**
   * Funkcia vymaže položku z tabuľky
   * @param  String  $table  tabuľka z ktorej sa majú údaje vumazať
   * @param  Integer $id     id vymazávaného riadka
   * @return Boolean         true ak vymaže úspešne / false ak nastane chyba
   */
  public static function deleteFromWhere($table, $column,$value){
      $result = Db::query(
        "DELETE
      FROM `$table`
      WHERE `$table`.`$column` = ?", array($value));
      return $result;
  }
  /**
   * Funkcia vymaže položku z tabuľky
   * @param  String  $table  tabuľka z ktorej sa majú údaje vumazať
   * @param  Integer $id     id vymazávaného riadka
   * @return Boolean         true ak vymaže úspešne / false ak nastane chyba
   */
  public static function deleteFrom($table, $id){
    $result = Db::query(
      "DELETE
      FROM `$table`
      WHERE `$table`.`id` = ?", array($id));
    return $result;
  }
  /**
   * Funkcia upraví záznam v databáze podľa vstupných údajov
   * @param  String $table tabuľka v ktorej sa majú vykonať zmeny
   * @param  Array  $data  asociatívne pole, ktorého indexy sú zhodné so stĺpcami v databáze
   * @param  String $where podmienka podľa ktorej sa má vybrať záznam
   * @return Boolean       True ak zmení úspešne / False ak nastane chyba
   */
  public static function update($table, $data, $whereCol, $whereVal){
    $fields=array_keys($data);
    $values=array_values($data);
    array_push($values, $whereVal);
    $fieldlist=implode("`=?, `",$fields);
    $query =
    "UPDATE `$table`
        SET `$fieldlist`=?
      WHERE `$whereCol`=?
    ";
    $result = Db::query($query, $values);
    return $result;
  }


  public static function getPageData($id){ // vrati informacie o 
    $result = Db::query("
      SELECT *
      FROM page p
      WHERE p.id = ?", 
      array($id))->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  /**
   * [getModuleFiles description]
   * @param  [type] $parent_id  [description]
   * @param  [type] $childTable [description]
   * @return [type]             [description]
   */
  public static function getPageImage($page_id){
      $result = Db::query("
      SELECT *
      FROM `file`
      WHERE page_id = ?",
            array($page_id))->fetch(PDO::FETCH_ASSOC);
      return $result;
  }

  public static function getModules($page_id){ // vrati ID a TYPE pre vsetky moduly pre page so zadanym id
    $result = Db::query("
      SELECT m.id, m.type
      FROM module m
      WHERE m.page_id = ?
      ORDER BY m.order", 
      array($page_id))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function getPagesWhere($col, $value, $orderBy){
      $result = Db::query(
      " SELECT *
        FROM `page`
        WHERE ? = ?
        ORDER BY ?
      ",
      array($col, $value, $orderBy))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public static function getCategoryPages($category_id){
    $result = Db::query(
      " SELECT id
        FROM `page`
        WHERE category_id = ?
        ORDER BY created
      ",
      array($category_id))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public static function getModuleFiles($page_id){
    $result = Db::query("
      SELECT *
      FROM `file`
      WHERE page_id = ?",
            array($page_id))->fetch(PDO::FETCH_ASSOC);
      return $result;
  }
  public static function getCategory($category_id){
    $result = Db::query(
      " SELECT *
        FROM `page_category`
        WHERE id = ?",
            array($category_id))->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function getCategories(){
    $result = Db::query(
      " SELECT *
        FROM `page_category`
      ",
            array())->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function getHomePage(){
    $result = Db::query(
      " SELECT *
        FROM `page`
        WHERE is_home = 1
      ",
            array())->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function getNavbarPages(){
    $result = Db::query(
      " SELECT *
        FROM `page`
        WHERE in_navbar = 1
      ",
            array())->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function setHomePage($page_id){
    Page_m::update("page", array("is_home"=>0), "is_home", 1);
    return Page_m::update("page", array("is_home"=>1), "id", $page_id);
  }
  public static function setNavbarPage($page_id, $value){
    return Page_m::update("page", array("in_navbar"=>$value), "id", $page_id);
  }
  public static function setStatusPage($page_id, $value){
    return Page_m::update("page", array("status"=>$value), "id", $page_id);
  }
}
?>