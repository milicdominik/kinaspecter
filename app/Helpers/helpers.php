<?php


if (!function_exists('__t')) {
  function __t($str, $replace = [], $locale = null)
  {
    $strkey = str_replace('.','_',$str);
    $result = __('kina.'.$strkey,$replace,$locale);

    if(Str::startsWith($result,'kina.'))
      return substr($result,7);

    return $result;
  }
}


if (!function_exists('__carbon')) {
  /**
  * Pull all translation definitions from carbon package.
  **/
  function __carbon()
  {
    $file = base_path().'/vendor/nesbot/carbon/src/Carbon/Lang/'.config('app.locale').'.php';
    if(!is_file($file))
      $file = base_path().'/vendor/nesbot/carbon/src/Carbon/Lang/en.php';
    return include($file);
  }
}


if (!function_exists('stringToColorCode')) {
  function stringToColorCode($str) {
    $code = dechex(crc32($str));
    $code = substr($code, 0, 6);
    return $code;
  }
}

/**
* Diff functions for html display
**/
if (!function_exists('computeDiff')) {
  function computeDiff($old, $new)
  {
    $matrix = array();
   $maxlen = 0;
   foreach($old as $oindex => $ovalue){
       $nkeys = array_keys($new, $ovalue);
       foreach($nkeys as $nindex){
           $matrix[$oindex][$nindex] = isset($matrix[$oindex - 1][$nindex - 1]) ?
               $matrix[$oindex - 1][$nindex - 1] + 1 : 1;
           if($matrix[$oindex][$nindex] > $maxlen){
               $maxlen = $matrix[$oindex][$nindex];
               $omax = $oindex + 1 - $maxlen;
               $nmax = $nindex + 1 - $maxlen;
           }
       }
   }
   if($maxlen == 0) return array(array('d'=>$old, 'i'=>$new));
   return array_merge(
       computeDiff(array_slice($old, 0, $omax), array_slice($new, 0, $nmax)),
       array_slice($new, $nmax, $maxlen),
       computeDiff(array_slice($old, $omax + $maxlen), array_slice($new, $nmax + $maxlen)));
  }
}
if (!function_exists('diffline')) {
  function diffline($old, $new)
  {
    //strip html tags first, so we do not break in the middle of html tag.
    $old = strip_tags($old);
    $new = strip_tags($new);

    $ret = '';
    $diff = computeDiff(preg_split("/[\s]+/", $old), preg_split("/[\s]+/", $new));
    foreach($diff as $k){
       if(is_array($k))
           $ret .= (!empty($k['d'])?"<span class=\"diff bg-lightred\">".implode(' ',$k['d'])."</span> ":'').
               (!empty($k['i'])?"<span class=\"diff bg-lightgreen\">".implode(' ',$k['i'])."</span> ":'');
       else $ret .= $k . ' ';
    }
    return $ret;
  }
}
