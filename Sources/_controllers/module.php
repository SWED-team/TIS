<?php
echo "1";
//require_once('../models/module.php');

//////////////////  Module Controller Class



class Module{
  private $id = 0;      // module id
  private $type = "";    // module type
  private $newModule = true; // true if module is new, false if exists
  private $moduleData = array();
  private $model;
  

  public function __construct($id, $type){
    echo $id, $type;
    //$model = new Module_m();

echo 3;
    if($id!=0){
      $this->id         = $id;
      $this->type       = $type;
      $this->newModule  = false;
      $this->moduleData = Module_m::getModuleData($id,$type);
    }
  }
  public function show(){

  }
}



//////////////////  Module Model Class


class Module_m{





  public static function getModuleData($id,$table){
    $result = Db::query("SELECT * FROM modules m1 WHERE m1.id = ? INNER JOIN ? m2 ON m1.id = m2.module_id", array($id, $table));
    //
    //todo: spravit dopyt na vyber informacii z tabulky module a module_......

    //"SELECT * FROM modules m1 WHERE m1.id = '$id' INNER JOIN '$table' m2 ON m1.id = m2.module_id"
    
    return $result;
  }
}


echo "2";
$module = new Module(1);






?>