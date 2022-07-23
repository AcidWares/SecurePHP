<?php
 class mysqli_handle extends mysqli {
  protected static $instance = null;
  private static $host = "localhost";
  private static $user = "noobie";
  private static $pass = "coldfusion11";
  private static $db = "myDB";

  private function __construct() {
   parent::init();
   parent::options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0') ?: die('Setting MYSQLI_INIT_COMMAND failed');
   parent::options(MYSQLI_OPT_CONNECT_TIMEOUT, 5) ?: die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
   parent::real_connect(self::$host, self::$user, self::$pass, self::$db) ?: die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
   parent::set_charset("utf8mb4") ?: die('Error: Failed to change mysqli character set. ');
  }

  public static function start() {
   isset(self::$instance) ?: self::$instance = new self();
   return self::$instance;
  }

  public function __destruct() {
   parent::close();
  }
 }
?>
