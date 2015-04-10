<?php
function Truncate($text, $characters, $end = '...'){
  $text=strip_tags($text);
  if(mb_strlen($text) > $characters) {
    $text = mb_substr($text, 0, $characters);
    $text = rtrim($text, ":!,.-");
    $text = mb_substr($text, 0, mb_strrpos($text, ' '));
    return $text.$end;
  }
  else {
    return $text;
  }
}
?>