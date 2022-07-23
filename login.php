<?php
 include_once("./SYSTEM/mysqli.php");
 include_once("./SYSTEM/session.php");
 include_once("./SYSTEM/crypto.php");
 include_once("./SYSTEM/display.php");

 (isset($_POST['username']) && isset($_POST['password'])) ?: die(page::login());
 $user = $_POST['username'];
 $pass = $_POST['password'];
 (!empty($user) && !empty($pass)) ?: die(page::login());

 $server_key = "eJwBAAP//DZmm7sMp2xXYzQPEACxfj5K4rZAdRV23+KDLHXhdZzbEbPx+yQx1xpsoj3hew+LCGXp5KwnOjj1AQveSw/CTa3aKmwZhMOlDy4VfxPCqXp1qf72glwhRQBsWYwoTPNQIT+tY2b3aGvomFLnBvPBegXjAs6ILHHD3qnQUDoDg34NLLArHDw45TMbqYpF7LdA/qJF73oJtvY61ybLYL1hdSmfcJf9WxdnZ+oMWJJ/+mbBpuw60+tLDpFEk67PTrFtQUi8fuI9DaetxBoU4puZN5mAyf3qxQJcxdR4HYAzBPgp8hVz7I/AMJb7fXr3+mXWKV77sGUarx/8BhlC8WSsCGOYCb/xQng8+jUrHxur9wNIXCHWVn7Df9TKIIJUZIO2N8gf+4FHzLCVACqKTey5HgG8kUSxrtJdMCnSib1k7mAp1yX43gALywkt4a/2lS+sYajD2ojBggZOkuf+TcStkEYneD1FLQmEt0ANaP08baYzH8HVkesc7aqhmg43dgZdg9hUckNx10WFuH0euAHtvVX8Qh9bzCpUx0WgjviHa6skiZWGLwIfpJIvGMG3FV3a+NKZ1lK/2Nia+vcoshzpQV15RLOcyPi0OdUoh31uvT5RLkFv1LlGNE+Ewka++d9PdxXdL6EHRriSXCXuCgLluaNhXEQvSCtgg48DO+BZ+0svV5r5/OpcQiTughozoCBDlSKrIbEjgVj/E6qP9qgSICSjiU1/NVVN+WCr9AHHzNglF7pxuZhz16hVK1/07JOu293qkMNT9UAnJ/IgykoycXvdLPJer4r/7OwmB9cYrg1Qtbh5EnppO3xBkHyWtyBfIjB/98pqqJAvlgc/ZSN4Cqtm8E80Bq+REfWjIihiPLP7Hxg39QwRHWI/JbeVQYuUgJu3vp2LyqKc+Vh8Mt+WLUeRVR3Yc/VPmsTADWhJap4aTLyaTUJ1z/nlHqeQkFL06jEZiYce58WACMa/eeAYBZSfAhOAVhWgAF3KRSZfaOAUPX3CvK+HZFRHISQNNeSANxwoccQ=";

 $uhash = sha1("{$server_key}+{$user}");

 $mysqli_handle = mysqli_handle::start();
 $stmt_handle = $mysqli_handle->stmt_init();

 $query = "SELECT password,salt FROM accounts WHERE username = ?";

 $stmt_handle->prepare($query) ?: die(page::login());
 $stmt_handle->bind_param("s", $uhash) ?: die(page::login());

 $stmt_handle->execute() ?: die(page::login());
 $stmt_handle->bind_result($r1, $r2) ?: die(page::login());
 $stmt_handle->fetch() ?: die(page::login());
 $stmt_handle->free_result();
 $stmt_handle->reset();
 $stmt_handle->close();

 $salt = crypto::_ksalt(gzuncompress(base64_decode($server_key)), $r2);
 $hash = crypto::_argon2id($pass, $salt);
 ($r1 == $hash) ?: die(page::login());

 $session_handle = session::start();
 $_key = random_bytes(128);
 $_user = crypto::_xor($_key, $user);
 $_SESSION['user'] = $_user;
 $_SESSION['key'] = $_key;
 header("Location: index.php");
?>
