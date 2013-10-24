<?php

/**
 * Класс CJSConsoleDebug для вывода отладочной информации в консоль отладки JavaScript браузера
 * Идея: http://ruseller.com/lessons.php?rub=37&id=1008 
 * 
 * При включении через общий PSDebugTools.php автоматически создается класс $jsconsole  
 * Пример использования:
 *   include('Class.JSConsoleDebug.php'); 
 *   $debug = new CJSConsoleDebug();
 *    
 *   // Простое сообщение на консоль
 *   $debug->debug("Очень простое сообщение на консоль");
 *    
 *   // Вывод перменной на консоль
 *   $x = 3;
 *   $y = 5;
 *   $z = $x/$y;
 *   $debug->debug($z, "Переменная Z: ");
 *   // или так
 *   $debug->log($z, "Переменная Z: ");      
 *
 *   // Предупреждение
 *   $debug->debug("Простое предупреждение", null, JSCD_WARN);
 *   // или так 
 *   $debug->warn("Простое предупреждение");
 *
 *   // Информация
 *   $debug->debug("Простое информационное сообщение", null, JSCD_INFO);
 *   // или так 
 *   $debug->info("Простое информационное сообщение");
 *
 *   // Ошибка
 *   $debug->debug("Простое сообщение об ошибке", null, JSCD_ERROR);
 *   // или так
 *   $debug->error("Простое сообщение об ошибке");
 *
 *   // Выводим массив в консоль
 *   $fruits = array("банан", "яблоко", "клубника", "ананас");
 *   $fruits = array_reverse($fruits);
 *   $debug->log($fruits, "Массив фруктов:");
 *
 *   // Выводим объект на консоль
 *   $book               = new stdClass;
 *   $book->title        = "Гарри Потный и кто-то из Ашхабада";
 *   $book->author       = "Д. K. Роулинг";
 *   $book->publisher    = "Arthur A. Levine Books";
 *   $book->amazon_link  = "http://www.amazon.com/dp/0439136369/";
 *   $debug->debug($book, "Объект: ");
 **/
  
class CJSConsoleDebug {

  private $m_console = false;

  function __construct() {
  
      if (!defined("JSCD_LOG"))    define("JSCD_LOG",1);
      if (!defined("JSCD_INFO"))   define("JSCD_INFO",2);
      if (!defined("JSCD_WARN"))   define("JSCD_WARN",3);
      if (!defined("JSCD_ERROR"))  define("JSCD_ERROR",4);
      
    }
  
  private function console_init() {
      $this->m_console = true;
      echo '<script type="text/javascript">'.NL;
      echo 'if (!window.console) {'.NL;
      echo 'window.console = {};'.NL;
      echo 'function fn() { opera.postError(arguments); };'.NL;
      echo "['log', 'debug', 'info', 'warn', 'error', 'assert', 'dir', 'dirxml', 'group', 'groupEnd',".NL;
      echo "'time', 'timeEnd', 'count', 'trace', 'profile', 'profileEnd'].forEach(function(name) {".NL;
      echo 'window.console[name] = fn;'.NL;
      echo '});}'.NL;
      echo 'console.log = console.log || function(){};'.NL;
      echo 'console.warn = console.warn || function(){};'.NL;
      echo 'console.error = console.error || function(){};'.NL;
      echo 'console.info = console.info || function(){};'.NL;
      echo 'console.debug = console.debug || function(){};'.NL;
      echo '</script>'.NL;
  }
  
  function debug($var, $name = null, $type = JSCD_LOG) {
  
      if(!$this->m_console) $this->console_init();
      echo '<script type="text/javascript">'.NL;
      if(!empty($name)) {
        $varname = preg_replace("~[^A-Z|0-9]~i","_",$name);
        //$name = str_replace("\\", "\\\\", $name);
        } else {
        $varname = PSDebugNameGen();
        }
      
      if(empty($var)) $var = 'CJSConsoleDebug: empty variable';
  
      if(!empty($name)) {
        $var_full = array($name, $var);
        } else {
        $var_full = $var;
        }
      $object = json_encode($var_full);
      $object = str_replace("\\", "\\\\", $object);
      echo 'var object'.$varname.' = \''.str_replace("'","\'",$object).'\';'.NL;
      echo 'var val'.$varname.' = eval("(" + object'.$varname.' + ")" );'.NL;
      switch($type) {
          case JSCD_LOG:
              echo 'console.debug(val'.$varname.');'.NL;
          break;
          case JSCD_INFO:
              echo 'console.info(val'.$varname.');'.NL;
          break;
          case JSCD_WARN:
              echo 'console.warn(val'.$varname.');'.NL;
          break;
          case JSCD_ERROR:
              echo 'console.error(val'.$varname.');'.NL;
          break;
        }
      echo '</script>'.NL;
  }

  function log($var, $name=null) {
    $this->debug($var, $name, JSCD_LOG);
  }
  
  function info($var, $name=null) {
    $this->debug($var, $name, JSCD_INFO);
  }
  
  function warn($var, $name=null) {
    $this->debug($var, $name, JSCD_WARN);
  }
  
  function error($var, $name=null) {
    $this->debug($var, $name, JSCD_ERROR);
  }
  
}

?>