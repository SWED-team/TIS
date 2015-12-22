<?php
class File{
  private $thumbPath = "";
  private $data = array();
  private $user = null;

  public function __construct($type=array(), $multi=0){
      $this->data = null;
  }
  public function setById($id=0){
      if($file_id =! 0){
          $this->data;
          $tmp= File_m::getFileById($file_id);
      }

  }
  public function getData(){
    return $this->data;
  }

  public function insert(){

  }
  public function getFormData(){
      $success=true;



  }
  public function uploadInput($single){

  }


}

class File_m{
  /*
    function returns array of informations about file from database
  */
  public static function getFileById($id){
    $result = Db::query("
      SELECT *
      FROM file f
      WHERE f.id = ?",
      array($id))->fetch();
    return $result;
  }
  /*
    funntion returns true if insert was success / false if failded
  */
  public static function insert($file){
    $result = Db::query("
      INSERT INTO `file`
        (`id`, `title`, `extension`, `path`, `thumb_small`, `thumb_medium`, `size`, `upload_date`, `upload_by`)
      VALUES
        (NULL, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?)",
      $file['title'],$file['extension'],$file['path'],$file['thumb_small'],$file['thumb_medium'],$file['size'],$file['upload_date'],$file['upload_by']
      );
    return $result;
  }
  public static function update(){

  }

}


?>