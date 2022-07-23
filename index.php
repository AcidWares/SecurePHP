<?php
 include_once("./SYSTEM/session.php");
 include_once("./SYSTEM/crypto.php");
 include_once("./SYSTEM/display.php");

 $session_handle = session::start();
 (!empty($_SESSION['user']) && !empty($_SESSION['key'])) ?: die("18 US Code § 1030");
 $_user = crypto::_xor($_SESSION['key'], $_SESSION['user']);
 $user = htmlspecialchars($_user);
 echo "Greetings {$user}!";
?>
