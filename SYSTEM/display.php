<?php
 class page {
  private static function _css_front() {
   return <<<EOD
  <style>
   /* page defaults */
   * {
    /* default */
    box-sizing: border-box;
    /* page font */
    font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
    /* font size */
    font-size: 16px;
    /* font smoothing */
    -moz-osx-font-smoothing: grayscale;
    /* font smoothing */
    -webkit-font-smoothing: antialiased;
   }
   /* center display */
   .l {
    /* background color */
    background-color: #d8faff;
    /* background shadow */
    box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
    /* header spacing */
    margin: 10px auto;
   }
   /* header text */
   .l h1 {
    /* spacer line */
    border-bottom: 1px solid #dee0ee;
    /* line color */
    color: #555;
    /* font size */
    font-size: 24px;
    /* header and footer spacing */
    padding: 5% 0 5% 0;
    /* center text */
    text-align: center;
   }
   /* input forms */
   .l form input[type='password'], .l form input[type='text'] {
    /* field background white */
    background-color: #f8faff;
    /* spacing */
    border-radius: 5px;
    /* field text color and style */
    border: solid #d8faff;
    /* text field shadow */
    box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.2);
    /* text field height */
    height: 50px;
    /* text field footer space */
    margin-bottom: 1%;
    /* field text indentation */
    padding: 0 15px;
    /* text field width */
    width: 70%;
   }
   /* submit button */
   .l form input[type='submit'] {
    /* button color blue */
    background-color: #4a8ddd;
    /* button curving effect */
    border-radius: 50px;
    /* button border */
    border: 2px solid #d8faff;
    /* button text color */
    color: #f8faff;
    /* change cursor when mouse over */
    cursor: pointer;
    /* bold font */
    font-weight: bold;
    /* space button */
    margin-top: 5%;
    /* button expand height */
    padding: 20px;
    /* mouse over darken button */
    transition: background-color 0.2s;
    /* button width */
    width: 100%;
   }
   /* mouse over effect */
   .l form input[type='submit']:hover {
    /* color */
    background-color: #4a8ccc;
    /* speed of change */
    transition: background-color 0.2s;
   }
   /* html body */
   body {
    /* white background color */
    background-color: #f8faff;
    /* body height */
    height: 95%;
   }
   /* parent table */
   #round1 {
    /* form curving effect */
    border-radius: 20%;
    /* background shadowing effect */
    border: 2px solid #d8faff;
    /* body padding */
    padding: 20px;
   }
   /* field description */
   #round2 {
    /* form curving effect */
    border-radius: 15%;
    /* background shadowing effect */
    border: 1px solid #d8faff;
    /* fix rounding effect */
    height: 1%;
    /* form size padding */
    padding: 15px;
    /* form size padding */
    width: 100px;
   }
   /* description field */
   .l form label {
    /* background color light-blue */
    background-color: #a8aaff;
    /* text color white */
    color: #f8faff;
    /* border shadow */
    box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.3);
    /* expand fill */
    display: inline-flex;
    /* textbox height */
    height: 50px;
    /* text centred */
    justify-content: center;
    /* textbox width */
    width: 80px;
   }
  </style>

EOD;
   ?><?php
  }

  private static function _header_login_front() {
   return <<<EOD
<html>
 <head>
  <!-- expand character set -->
  <meta http-equiv='Content-Type' content='text/html; charset=Windows-1251'>
  <title>Login</title>

EOD;
   ?><?php
  }

  private static function _header_register_front() {
   return <<<EOD
<html>
 <head>
  <!-- expand character set -->
  <meta http-equiv='Content-Type' content='text/html; charset=Windows-1251'>
  <title>Register</title>

EOD;
   ?><?php
  }

  private static function _header_changepw_front() {
   return <<<EOD
<html>
 <head>
  <!-- expand character set -->
  <meta http-equiv='Content-Type' content='text/html; charset=Windows-1251'>
  <title>Change Password</title>

EOD;
   ?><?php
  }

  private static function _headered_front() {
   return <<<EOD
 </head>
 <body bgcolor='#f8faff'>

  <div>
   <table cellpadding='0' cellspacing='0' width='100%' height='100%'>
    <tr>

     <!-- table spacer -->
     <td>
     </td>

     <!-- login table -->
     <td width='60%'>
      <table id='round1' class='l' cellpadding='0' cellspacing='0' width='100%' height='90%' bgcolor='#eee'>
       <tr>
        <td>
         <center>

EOD;
   ?><?php
  }

  private static function _login_front() {
   return <<<EOD
          <form action='login.php' method='post'>
           <b><h1>Login To Account</h1><b><br><label id='round2'>Username:</label><input type='text' name='username' placeholder='Username'><br><label id='round2'>Password:</label><input type='password' maxlength='32' name='password' placeholder='Password'><br><input type='submit' value='Login'/>
          </form>

EOD;
   ?><?php
  }

  private static function _register_front() {
   return <<<EOD
          <form action='register.php' method='post'>
           <b><h1>Register New Account</h1><b><br><label id='round2'>Username:</label><input type='text' name='username' placeholder='Username'><br><label id='round2'>Password:</label><input type='password' maxlength='32' name='password' placeholder='Password'><br><input type='submit' value='Register'/>
          </form>

EOD;
   ?><?php
  }

  private static function _changepw_front() {
   return <<<EOD
          <form action='account.php' method='post'>
           <b><h1>Change Password</h1><b><br><label id='round2'>Password:</label><input type='password' name='opassword' placeholder='Old Password'><br><label id='round2'>Password:</label><input type='password' maxlength='32' name='npassword' placeholder='New Password'><br><input type='submit' value='Change Password'/>
          </form>

EOD;
   ?><?php
  }

  private static function _footing_front() {
   return <<<EOD
         </center>
        </td>
       </tr>
      </table>
     </td>

     <!-- table spacer -->
     <td>
     </td>

    </tr>
   </table>
  </div>

 </body>
</html>

EOD;
   ?><?php
  }

  public static function login() {
   echo self::_header_login_front();
   echo self::_css_front();
   echo self::_headered_front();
   echo self::_login_front();
   echo self::_footing_front();
  }

  public static function register() {
   echo self::_header_register_front();
   echo self::_css_front();
   echo self::_headered_front();
   echo self::_register_front();
   echo self::_footing_front();
  }

  public static function changepw() {
   echo self::_header_changepw_front();
   echo self::_css_front();
   echo self::_headered_front();
   echo self::_changepw_front();
   echo self::_footing_front();
  }
 }
?>
