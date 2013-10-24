<?php
/**
 * Helpfull functions to work with XDebug (http://xdebug.org/)
 * by V.Pshentsov <pshentsoff@yandex.ru> 
 **/ 

define('XDEBUG_CALLFULL_PRINTMASK', 'Called at %s:%d from %s()');  

function xdebug_call_full($cfile=null, $cline=null, $cfunc=null, $cclass=null) {

  $cfile = !empty($cfile) ? $cfile : xdebug_call_file();
  $cline = !empty($cline) ? $cline : xdebug_call_line(); 
  $cclass = !empty($cclass) ? $cclass : xdebug_call_class();
  $cfunc = !empty($cfunc) ? $cfunc : xdebug_call_function();
  
  $result = sprintf(XDEBUG_CALLFULL_PRINTMASK, $cfile, $cline, $cclass ? $cclass.'::'.$cfunc : $cfunc);
  
  return $result;
}

function xdebug_stack_full($cfile=null, $cline=null, $cfunc=null, $cclass=null, $cstack=null) {

  $cfile = !empty($cfile) ? $cfile : xdebug_call_file();
  $cline = !empty($cline) ? $cline : xdebug_call_line(); 
  $cclass = !empty($cclass) ? $cclass : xdebug_call_class();
  $cfunc = !empty($cfunc) ? $cfunc : xdebug_call_function();
  
  $result = array();
  $result[] = sprintf(XDEBUG_CALLFULL_PRINTMASK, $cfile, $cline, $cclass ? $cclass.'::'.$cfunc : $cfunc);
  $cstack_all = xdebug_get_function_stack();
  $result[] = $cstack ? $cstack : array_slice($cstack_all, 0, count($cstack_all)-1);
  return $result;
}

?>
