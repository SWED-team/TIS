<?php
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
      array($id))->fetch();
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
      array($id))->fetch();
    return $result;
  }
  /**
   * [getModuleFiles description]
   * @param  [type] $parent_id  [description]
   * @param  [type] $childTable [description]
   * @return [type]             [description]
   */
  public static function getModuleFiles($parent_id, $childTable){
      $result = Db::query("
      SELECT m.*, f.title AS filetitle, f.extension, f.path, f.thumb_small, f.thumb_medium, f.size, f.upload_date, f.upload_by
      FROM  $childTable m
      INNER JOIN file f ON m.file_id = f.id
      WHERE m.module_parent_id = ?
      ",
      array($parent_id))->fetch();
    return $result;
  }
  /**
   * Vloží údaje z asociativneho poľa do tabuľky
   * @param  string $table tabuľka
   * @param  array  $data  asociatívne pole, ktorého indexy sú zhodné s 
   * @return boolean       true ak vloží úspešne / false ak nastane chyba
   */
  public static function insertInto($table, $data){
    $fields=array_keys($data);
    $values=array_values($data);
    $fieldlist=implode(',',$fields); 
    $qs=str_repeat("?,",count($fields)-1);
    $sql="INSERT INTO $table($fieldlist) VALUES(${qs}?)";
    $result = Db::query($sql, $values);
    return $result;
  }
}


?>