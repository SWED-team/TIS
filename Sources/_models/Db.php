<?php
class Db {
    private static $connect;
    private static $settings = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false,
  );
    /**
     * Funkcia na pripojenie do databázy
     * @param  [type] $host     adresa servera
     * @param  [type] $user     Prihlasovacie meno v DB
     * @param  [type] $password Prihlasovacie heslo v DB
     * @param  [type] $db       Databáza
     */
    public static function connect($host, $user, $password, $db) {
    if (!isset(self::$connect)) {
      self::$connect = @new PDO(
        "mysql:host=$host;dbname=$db",
        $user,
        $password,
        self::$settings
      );
    }
  }
  /**
   * Funkcia na vykonanie dopytu z DB
   * @param  string $query      PDO dopyt      
   * @param  array  $parameters Parametre dopytu
   * @return [type]             [description]
   */
  public static function query($query, $parameters = array()) {
    $stmt = self::$connect->prepare($query);
    $stmt->execute($parameters);
    return $stmt;
  }
  public static function lastInsertId(){
    return self::$connect->lastInsertId();
  }
  public static function insert($query, $parameters = array()) {
    $stmt = self::$connect->prepare($query);
    $res = $stmt->execute($parameters);
    if($res){
        return self::lastInsertId();
      }
    return 0;
  }
}

Db::connect("127.0.0.1", "root", "", "tis");
?>