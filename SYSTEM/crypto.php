<?php
 class crypto {
  public static function _ksalt($k, $s) {
   return self::_xor($k, self::_dtea($k, gzuncompress(base64_decode($s))));
  }

  public static function _csalt($k, $s) {
   return base64_encode(gzcompress(self::_etea($k, self::_xor($k, $s)), 9));
  }

  public static function _argon2id($k, $s) {
   $o = [
    'memory_cost' => 4<<12,
    'time_cost' => 64,
    'threads' => 2,
    'salt' => $s
   ];
   return password_hash($k, PASSWORD_ARGON2ID, $o);
  }

  public static function _xor($k, $s) {
   for($i = 0; $i < strlen($s); $i++)
    $s[$i] = ($s[$i] ^ $k[$i % strlen($k)]);
   return ~$s;
  }

  public static function _etea($k, $s) {
   $k = self::_str2long($k);
   $v = self::_str2long($s);
   if (count($v) <= 1) $v[1] = 0;
   $n = count($v); $z = $v[$n - 1]; $y = $v[0]; $d = 0x9E3779B9;
   $m = 0; $e = 0; $s = 0; $q = floor(6 + 52 / $n);
   while ($q-- > 0) {
    $s = self::_int32($s + $d);
    $e = self::_rshift($s, 2) & 3;
    for ($i = 0; $i < $n; $i++) {
     $y = $v[($i + 1) % $n];
     $m = self::_int32((self::_rshift($z, 5) ^ $y << 2) + (self::_rshift($y, 3) ^ $z << 4)) ^ self::_int32(($s ^ $y) + ($k[$i & 3 ^ $e] ^ $z));
     $z = $v[$i] = self::_int32($v[$i] + $m);
    }
   }
   return self::_long2str($v);
  }

  public static function _dtea($k, $s) {
   $k = self::_str2long($k);
   $v = self::_str2long($s);
   $n = count($v); $z = $v[$n - 1]; $y = $v[0]; $d = 0x9E3779B9;
   $m = 0; $e = 0; $q = floor(6 + 52 / $n); $s = $q * $d;
   while ($s != 0) {
    $e = self::_rshift($s, 2) & 3;
    for ($i = $n - 1; $i >= 0; $i--) {
     $z = $v[$i > 0 ? $i - 1 : $n - 1];
     $m = self::_int32((self::_rshift($z, 5) ^ $y << 2) + (self::_rshift($y, 3) ^ $z << 4)) ^ self::_int32(($s ^ $y) + ($k[$i & 3 ^ $e] ^ $z));
     $y = $v[$i] = self::_int32($v[$i] - $m);
    }
    $s = self::_int32($s - $d);
   }
   return self::_long2str($v);
  }

  private static function _str2long($s) {
   $i = strlen($s);
   $r = $i % 4;
   if($r != 0) $s = str_pad($s, $i + 4 - $r, "\0");
   return array_values(unpack('V*', $s));
  }

  private static function _long2str($v) {
   $s = '';
   for ($i = 0; $i < count($v); $i++) {
    $s .= pack('V', $v[$i]);
   }
   return rtrim($s, "\0");
  }

  private static function _rshift($i, $n) {
   if (0xffffffff < $i || -0xffffffff > $i) {
    $i = fmod($i, 0xffffffff + 1);
   }
   if (0x7fffffff < $i) $i -= 0xffffffff + 1.0;
   else if (-0x80000000 > $i) $i += 0xffffffff + 1.0;
   if (0 > $i) {
    $i &= 0x7fffffff;
    $i >>= $n;
    $i |= 1 << (31 - $n);
   }
   else $i >>= $n;
   return $i;
  }

  private static function _int32($n) {
   while ($n >= 2147483648) $n -= 4294967296;
   while ($n <= -2147483649) $n += 4294967296;
   return (int)$n;
  }
 }
?>
