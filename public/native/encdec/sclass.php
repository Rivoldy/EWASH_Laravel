<?php
  function dec($sentence)
  {
    $text = urldecode($sentence);
    $dec = "";
    $offset = 8;
    for ($i = 0; $i < strlen($text); $i++) {
      $c = $text[$i];
      $z = chr(ord($c) - 32 + $offset % 95 + 32);
      $dec = $dec . $z;
    }
    return $dec;
  }

  function enc($sentence)
  {
    $e = "";
    $offset = 8;
    for ($i = 0; $i < strlen($sentence); $i++) {
      $c = $sentence[$i];
      $z = urlencode(chr(ord($c) - 32 - $offset % 95 + 32));
      $e = $e . $z;
    }
    return $e;
  }