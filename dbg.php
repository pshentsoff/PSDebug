<?php
/**
 * @file        dbg.php
 * @description
 *
 * PHP Version  5.3.13
 *
 * @package 
 * @category
 * @plugin URI
 * @copyright   2013, Vadim Pshentsov. All Rights Reserved.
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author      Vadim Pshentsov <pshentsoff@gmail.com> 
 * @link        http://pshentsoff.ru Author's homepage
 * @link        http://blog.pshentsoff.ru Author's blog
 *
 * @created     30.11.13
 */

global $dbg;

if(!function_exists('prelog')) {
    function prelog($var, $label = ''){ ?>
<p><fieldset><legend><?php echo $label; ?></legend><p><pre>
<?php echo print_r($var, true); ?>
</pre></p></fieldset></p>
<?php
    }
}

if(!function_exists('conlog')) {
    function conlog ($data, $varname = '') {
        echo "<script>\r\n//<![CDATA[\r\nif(!console){var console={log:function(){}}}";
        $output    =    explode("\n", print_r($data, true));
        if(isset($varname) && !empty($varname)) $output[0] = "{$varname} = ".(isset($output[0]) ? $output[0] : '');
        foreach ($output as $line) {
            if (trim($line)) {
                $line    =    addslashes($line);
                echo "console.log(\"{$line}\");";
            }
        }
        echo "\r\n//]]>\r\n</script>";
    }
}

if(!function_exists('dbg_add')) {
    function dbg_add($data, $varname) {
        global $dbg;
        $dbg[$varname] = $data;
    }
}

if(!function_exists('dbg_conlog')) {
    function dbg_conlog() {
        global $dbg;

        foreach($dbg as $varname => $data) {
            conlog($data, $varname);
        }
    }
}

defined('DBG_LOGFILE_FILEPATH') or define('DBG_LOGFILE_FILEPATH', dirname(__FILE__) .'/dbg.log' );
defined('DBG_LOGFILE_TIME_FORMAT') or define('DBG_LOGFILE_TIME_FORMAT', '[ d-m-Y H:i:s ] - ' );

if(!function_exists('filelog')) {
    /**
     *  ф. записывает сообщение в лог-файл
     *
     * @param $log_msg - записываемое сообщение
     * @param string $log_file_path - логфайл
     * @param bool $append_new_line - завершить запись новой строкой
     * @param bool $append_time - добавить дату - врмя в начало строки
     * @return bool
     * @throws Exception если файл не удается открыть/создать
     */
    function filelog($log_msg, $log_file_path = DBG_LOGFILE_FILEPATH, $append_new_line = true, $append_time = true) {

        if(!($f = fopen($log_file_path, "a"))) {
            throw new Exception('Error open or create file '.$log_file_path);
            return false;
        }

        if($append_time) {
            $now = date(DBG_LOGFILE_TIME_FORMAT);
            fwrite($f, $now);
        }

        fwrite($f, $log_msg);

        if($append_new_line)
            fwrite($f, "\n");

        fclose($f);

        return true;
    }
}

if(!function_exists('get_caller_info')) {
    /**
     * Функция возвращает информацию о вызвавшем объекте/функции в виде строки
     * Строка имеет формат:
     *      "файл[номер строки]: (объект->)функция"
     *
     * @return string - информация о вызвавшем объекте
     */
    function get_caller_info() {
        $file = '';
        $class = '';
        $function = '';
        $line = '';
        $trace = debug_backtrace();
        if (isset($trace[2])) {
            $file = $trace[1]['file'];
            $line = $trace[1]['line'];
            $function = $trace[2]['function'];
            if ((substr($function, 0, 7) == 'include') || (substr($function, 0, 7) == 'require')) {
                $function = '';
            }
        } else if (isset($trace[1])) {
            $file = $trace[1]['file'];
            $line = $trace[1]['line'];
            $function = '';
        }
        if (isset($trace[3]['class'])) {
            $class = $trace[3]['class'];
            $function = $trace[3]['function'];
            $file = $trace[2]['file'];
            $line = $trace[2]['line'];
        } else if (isset($trace[2]['class'])) {
            $class = $trace[2]['class'];
            $function = $trace[2]['function'];
            $file = $trace[1]['file'];
            $line = $trace[1]['line'];
        }
        //if (isset($file)) $file = basename($file);
        $result = $file . '['. $line .']: ';
        $result .= ($class != '') ? ":" . $class . "->" : "";
        $result .= ($function != '') ? $function . "(): " : "";
        return $result;
    }
}