<?php
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');
/**
 * Page_m je model triedy Page
 * ktorá obsahuje funkcie na získavanie, ukladanie a mazanie dát triedy Page_m
 *
 * 
 * @version 1.0
 * @author KRASNAN
 * @package Models
 */

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
  public static function getPagesJoinedWhere($col=1,$value=1, $order_by="id"){
    $result = Db::query(
      "SELECT p.*, c.id AS category_id, c.title AS category_title, f.`thumb-medium` AS `file_thumb-medium`
      FROM page p
      INNER JOIN file f
      ON f.page_id = p.id
      INNER JOIN page_category c
      ON c.id = p.category_id
      WHERE p.$col = ?
      ORDER BY p.$order_by", 
      array($value))->fetchAll(PDO::FETCH_ASSOC);
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
  public static function getUsersExcept($user_id){
    $result = Db::query("
      SELECT id, first_name, last_name, email
      FROM `user`
      WHERE id<>?
      ", array($user_id))->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }
  public static function getEditors($page_id){
    $result = Db::query(
      "SELECT *
      FROM `edit_rights`
      WHERE page_id=?
      ", array($page_id))->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }
  public static function getUser($user_id){
    $result = Db::query("
      SELECT id, first_name, last_name, email
      FROM `user`
      WHERE id=?
      ", array($user_id))->fetch(PDO::FETCH_ASSOC);
      return $result;
  }
  public static function getEditorsInfo($page_id){
    $result = Db::query(
      "SELECT u.id, first_name, last_name, email
      FROM `edit_rights` er
      INNER JOIN `user` u
      ON er.user_id=u.id 
      WHERE er.page_id=?
      ", array($page_id))->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }


  public static function getModules($page_id, $status){ // vrati ID a TYPE pre vsetky moduly pre page so zadanym id
    $result = Db::query("
      SELECT m.id, m.type
      FROM module m
      WHERE m.page_id = ? AND status $status
      ORDER BY m.order", 
      array($page_id))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  //---------- dat mozno prec ----------------------------
  public static function getPagesWhere($col, $value, $orderBy){
      $result = Db::query(
      " SELECT *
        FROM `page`
        WHERE $col = ?
        ORDER BY ?
      ",
      array($value, $orderBy))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public static function getCategoryPages($category_id, $status=" = 1"){
    $result = Db::query(
      " SELECT id
        FROM `page`
        WHERE category_id = ? AND status $status
        ORDER BY created
      ",
      array($category_id))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function getSearchPages($term, $status=" = 1"){
    $result = Db::query(
      " SELECT DISTINCT p.id
        FROM `page` p

        INNER JOIN `module` m
        ON m.page_id = p.id

        INNER JOIN `module_formated` mf
        ON mf.module_id = m.id

        WHERE 
          ( 
            p.title LIKE ? 
            OR p.description LIKE ? 
            OR 
            ( 
              
                mf.content LIKE ? 
                OR mf.content LIKE ?
                
            ) AND m.status $status
          )
          AND p.status $status
        ORDER BY p.created
      ",
      array($term,$term,$term,$term))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  /*SELECT id
        FROM `page`
        WHERE ( title LIKE ? OR description LIKE ? )AND status $status
        ORDER BY created*/


/*SELECT p.id
        FROM `page` p
        INNER JOIN `module_formated` mf 
        ON p.id = mf.page_id
        WHERE ( 
            p.title LIKE ? 
            OR p.description LIKE ? 
            OR ( mf.content LIKE ? AND mf.status = $status )
          )
          AND p.status $status
        ORDER BY p.created*/
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