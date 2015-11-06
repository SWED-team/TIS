<?php

class Module_m{

  public static function getModuleContainer($id){
    $result = Db::query("
      SELECT *
      FROM module m
      WHERE m.id = ?", 
      array($id))->fetch();
    return $result;
  }
  public static function getModuleContent($id, $table){
    $result = Db::query("
      SELECT *
      FROM $table m
      WHERE m.module_id = ?", 
      array($id))->fetch();
    return $result;
  }
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
}


?>