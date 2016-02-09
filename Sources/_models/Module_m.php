<?php
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');

/**
 * Module_m je model triedy Module
 * ktorá obsahuje funkcie na získavanie, ukladanie a mazanie dát triedy Module_m
 *
 * 
 * @version 1.0
 * @author KRASNAN
 * @package Models
 */
class Module_m{
/**
 * Získanie základných informácií o module z DB
 * @param  int    $id          Id modulu
 * @return array  $result      pole informácii o module
 */
  public static function getModuleContainer($id){
    $result = Db::query("
      SELECT *
      FROM module m
      WHERE m.id = ?",
      array($id))->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
    /**
   * Získa podrobné informácie o module z DB
   * @param  int    $id         ID kontajnera modulu
   * @param  string $table      Tabulka z ktorej získavame modul
   * @return array              Podrobné informácie o module
   */
  public static function getModuleContent($id, $table){
    $result = Db::query("
      SELECT *
      FROM $table m
      WHERE m.module_id = ?",
      array($id))->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
/**
 * [getModuleFiles description]
 * @param  int $module_id     Parametrom je id modulu ktorého
 * @return array $result      Pole informáci o súboroch zvoleného modulu
 */
  public static function getModuleFiles($module_id){
      $result = Db::query("
      SELECT *
      FROM `file`
      WHERE module_id = ?",
            array($module_id))->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  }
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
    //echo $query;
    $result = Db::query($query, $values);
    //echo $result;
    return $result;
  }
  /**
   * Funkcia vráti počet prvkov podľa zadaných kritérií
   * @param  Integer $whereCol Názov stĺpca pre where podmienku
   * @param  Integer $whereVal Hodnota stĺpca pre where podmienku
   * @return Integer           Počet vyhovujúcich riadkov
   */
  public static function count($whereCol, $whereVal){
    $result = Db::query(
      " SELECT count(*) 
        FROM `module` 
        WHERE `$whereCol`=?"
      , array($whereVal));
    $tmp = $result->fetch();
    return $tmp[0];
  }
  /**
   * Funkcia vráti "order" hodnotu riadku zadaného v parametri pre zadanú page
   * 
   * @param  Integer $page_id  ID stránky
   * @param  Integer $position Poradové číslo riadka indexované od 1
   * @return Integer/null      Hodnota order stĺpca / null ak riadok neexistuje     
   */
  public static function getOrderValue($page_id, $position, $module_id){
    if($position > 0){
      $result = Db::query(
        " SELECT `order` 
          FROM `module`
          WHERE `page_id` = ? AND `id` <> $module_id
          ORDER BY `order`
          LIMIT 1
          OFFSET ?
          "
        ,array($page_id, $position-1));
        $tmp = $result->fetch();
        return $tmp[0];
    }
    else return null;
  }

  /**
   * vrati ID a TYPE pre vsetky moduly pre page so zadanym id
   * @param  int    $page_id   id stránky ktorej moduly chceme
   * @return array  $result    pole modulov danej stránky
   */
  public static function getPageModules($page_id){
    $result = Db::query(
      "SELECT m.id, m.type
      FROM module m
      WHERE m.page_id = ?
      ORDER BY m.order", 
      array($page_id))->fetchAll();
    return $result;
  }
  public static function getPages(){
    $result = Db::query(
      "SELECT p.*, concat(u.first_name, ' ',u.last_name) AS author 
      FROM `page` p
      INNER JOIN `user` u
      ON u.id = p.created_by
      ORDER BY p.id", 
      array())->fetchAll();
    return $result;
  }
}



?>