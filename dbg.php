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
    function prelog(&$var){
        echo '<pre>'.print_r($var, true).'</pre>';
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