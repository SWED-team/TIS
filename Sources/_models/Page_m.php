<?php

Class Page_m{
  public static function getPageData($id){ // vrati informacie o 
    $result = Db::query("
      SELECT *
      FROM page p
      WHERE p.id = ?", 
      array($id))->fetch();
    return $result;
  }

  public static function getModules($page_id){ // vrati ID a TYPE pre vsetky moduly pre page so zadanym id
    $result = Db::query("
      SELECT m.id, m.type
      FROM module m
      WHERE m.page_id = ?", 
      array($page_id))->fetchAll();
    return $result;
  }
}


?>