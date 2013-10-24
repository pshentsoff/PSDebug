<?php

/**
 * Settings
 **/
  
if(!defined('PSDEBUG_PATHTO_TOOLS')) define('PSDEBUG_PATHTO_TOOLS', 't:/home/libs/debug');

if(!defined('PSDEBUG_USE_PSDEBUG')) define('PSDEBUG_USE_PSDEBUG', true);
if(!defined('PSDEBUG_USE_FIREPHP')) define('PSDEBUG_USE_FIREPHP', false);
if(!defined('PSDEBUG_USE_JSCD')) define('PSDEBUG_USE_JSCD', false);
if(!defined('PSDEBUG_USE_XDEBUG_LIB')) define('PSDEBUG_USE_XDEBUG_LIB', false);

if(!defined('PSDEBUG_CHECKMESSAGES')) define('PSDEBUG_CHECKMESSAGES', false);

if(!defined('PSDEBUG_NAMEGEN_DEFAULTLENGTH')) define('PSDEBUG_NAMEGEN_DEFAULTLENGTH', 32);
if(!defined('PSDEBUG_LOGFILE_PATHTO')) define('PSDEBUG_LOGFILE_PATHTO', '/cache');
if(!defined('PSDEBUG_LOGFILE_FILENAME')) define('PSDEBUG_LOGFILE_FILENAME', 'PSDebug.log');
/**
 *
 **/
  
if(!defined("NL")) define("NL","\r\n");

/**
 *
 **/

if (PSDEBUG_USE_PSDEBUG) {
  require_once(PSDEBUG_PATHTO_TOOLS.'/PSDebug.Class.php');
  global $psdebug;
  $psdebug = new CPSDebug();
} 

if(PSDEBUG_USE_FIREPHP) {

  require_once(PSDEBUG_PATHTO_TOOLS.'/FirePHPCore/FirePHP.Class.php');
  global $firephp;
  $firephp = FirePHP::getInstance(true);
  
  if(PSDEBUG_CHECKMESSAGES) {
    $firephp->log('PSDEBUG: FirePHP - ok.');
    }

  }
  
if(PSDEBUG_USE_JSCD) {

  require_once(PSDEBUG_PATHTO_TOOLS.'/JSConsoleDebug.Class.php');
  global $jsconsole;
  $jsconsole = new CJSConsoleDebug();
  
  if(PSDEBUG_CHECKMESSAGES) {
    $jsconsole->log('PSDEBUG: JSConsoleDebug - ok.');
    }
    
  }

if(PSDEBUG_USE_XDEBUG_LIB) {
  require_once(PSDEBUG_PATHTO_TOOLS.'/XDebug.php');
  }
  
function PSDebugNameGen($len = PSDEBUG_NAMEGEN_DEFAULTLENGTH) {
  $result = '';
  for($i=0; $i < $len; $i++) {
    $result .= chr(rand(97,122));
    }
  return $result;
}


?>