<?php

/**
* Trieda na prácu so súbormi
*
* overovanie existujúcich súborov, ziskanie suborov z priecinka, etc.....
*/
class File
{
  /**
   * Funkcia overuje či existuje súbor alebo priečinok a vypíše či sa jedná o priečinok, súbor alebo neexistujúcu cestu
   * @param  Strint $path cesta na serveri
   * @return String       typ cesty (dir/file/unknown)
   */
  public static function getPathType($path){
    if(is_dir($path) || is_dir("../".$path)){
      return "dir";
    }
    else if(file_exists($path) || file_exists("../".$path)){
      return "file";
    }
    else
      return "unknown";
  }

  /**
   * Funkcia vráti pole ciest k súborom v danom priečinku
   * @param  string $dir            cesta k priečinku
   * @param  array  $supported_file pole hľadaných typov (prípon) súborov 
   * @return array                  pole ciest k súborom
   */
  public static function getFilesFromDir($dir="", $supported_file=array()){
    if(substr($dir, -1)!="/") $dir = $dir."/";
    $allFiles = glob($dir."*.*");
    $result = array();
    foreach ($allFiles as $key => $file) {
      $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
      if (in_array($ext, $supported_file) || (sizeof($supported_file) > 0 && $supported_file[0]=="all")) {
        array_push($result, $file);
      }
    }
    return $result;
  }
}




if(isset($_POST["get_path_type"])){
  echo json_encode(array(
    'success' => true, 
    'data' => File::getPathType($_POST["get_path_type"])
    ));
}


else if(isset($_POST["get_files_from_dir"]) && isset($_POST["supported_file"])){
  $extensions = json_decode(stripslashes($_POST["supported_file"]));
  $dir = $_POST["get_files_from_dir"];

  echo json_encode(array(
    'success' => true, 
    'data' => File::getFilesFromDir($dir, $extensions)
    ));
}


else{
  echo json_encode(array('success'=>false));
}







?>