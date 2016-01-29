<?php
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');
/**
 * Category_m je model triedy Category
 * ktorá obsahuje funkcie na získavanie, ukladanie a mazanie dát triedy Category
 *
 * 
 * @version 1.0
 * @author KRASNAN
 * @package Models
 */
class Category_m{
	public static function getCategoriesWhereOrder($col=1,$value=1, $order_by="title"){
      $result = Db::query(
      " SELECT *
        FROM `page_category`
        WHERE $col = ?
        ORDER BY $order_by
      ",
      array($value))->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public static function get($id){
      $result = Db::query(
      " SELECT *
        FROM `page_category`
        WHERE id = ?
      ",
      array($id))->fetch(PDO::FETCH_ASSOC);
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
    $result = Db::query($query, $values);
    return $result;
  }

}