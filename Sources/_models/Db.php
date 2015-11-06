<?php
class Db {
    private static $connect;

    private static $settings = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false,
  );

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
  public static function query($query, $parameters = array()) {
    $result = self::$connect->prepare($query);
    $result->execute($parameters);
    return $result;
  }
}
?>