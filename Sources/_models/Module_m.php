<?php
if(file_exists('../_models/Db.php'))
  require_once('../_models/Db.php');
if(file_exists('_models/Db.php'))
  require_once('_models/Db.php');

class Module_m{
/**
 * Získanie základných informácií o module z DB
 * @param  int $id    Id modulu
 * @return array      pole informácii o module
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
   * @param  [type] $parent_id  [description]
   * @param  [type] $childTable [description]
   * @return [type]             [description]
   */
  public static function getModuleFiles($parent_id, $childTable){
      $result = Db::query(
        "SELECT m.*, f.title AS filetitle, f.extension, f.path, f.thumb_small, f.thumb_medium, f.size, f.upload_date, f.upload_by
        FROM  $childTable m
        INNER JOIN file f ON m.file_id = f.id
        WHERE m.module_parent_id = ?
        ",array($parent_id))->fetch(PDO::FETCH_ASSOC);
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
}


?>