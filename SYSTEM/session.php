<?php
 class session {
  protected static $instance = null;

  private function __construct() {
   session_cache_limiter('private, must-revalidate');
   session_cache_expire(30);
   session_start();
  }

  public static function start() {
   isset(self::$instance) ?: self::$instance = new self();
   return self::$instance;
  }

  public function destroy() {
   session_unset();
   session_destroy();
   session_write_close();
   setcookie(session_name(),'',0,'/');
  }

  public function __destruct() {
   session_write_close();
  }
 }
?>
