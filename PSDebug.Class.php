<?php
/**
 * Set of coomon functions for debugging
 * Author: V.Pshentsov <pshentsoff@yandex.ru>
 * Last edited: 27.06.2011 12:11:48
 **/ 

if(!defined('PSDEBUG_LOGFILE_FILEPATH')) 
  define('PSDEBUG_LOGFILE_FILEPATH', PSDEBUG_LOGFILE_PATHTO . '/' . PSDEBUG_LOGFILE_FILENAME);     

class CPSDebug {

  // Function simply print html-comment
  function comment($text) {
    echo '<!-- '.htmlspecialchars($text).' -->'.NL;
  }
  
  // Function print javascript alert calls
  function alert($message) {
    ?>
    <script type="text/javascript" language="javascript">
    alert("<?= $message ?>");
    </script>
    <?php
  }
  
  // Function print call of external script 
  function script($url, $as_function = false) {
    ?>
    <script type="text/javascript" language="javascript">
    <?php if($as_function) { ?>
    function addExternalScript(url) {
    var script = document.createElement("script");
    script.src = url;
    <?php } else { ?>
    var script = document.createElement("script");
    script.src = '<?= $url ?>;'
    <?php } ?>
    document.getElementsByTagName("head")[0].appendChild(script);
    <?php if($as_function) { ?>
    }
    <?php } ?>
    </script>
    <?php
  }
  
  // 
  function sleep($ms, $as_function = false) {
    ?> 
    <script type="text/javascript" language="javascript">
    <?php if($as_function) { ?>
    function sleep(ms) {
    var now = (new Date()).getTime();
    while ((now + ms) > ((new Date()).getTime())){}
    }
    <?php } else { ?>
    while ((now + <?= $ms ?>) > ((new Date()).getTime())){}
    <?php } ?>
    </script>
    <?php
  }
  
  function log2file($msg, $filepath = PSDEBUG_LOGFILE_FILEPATH, $endline = TRUE) {
    $result = '';
    if(!($f = fopen($filepath, "a+"))) {
      $result = "Can't open $filepath.";
      return $result;
      }
    fwrite($f,$msg);
    if($endline) fwrite($f, "\n");
    fclose($f);
    $result = "ok";
    return $result;
  }

  function dump2file($var, $filepath = PSDEBUG_LOGFILE_FILEPATH) {
    $result = '';
    if(!($f = fopen($filepath, "a+"))) {
      $result = "Can't open $filepath.";
      return $result;
      }
    fwrite($f,print_r($var, TRUE));
    fwrite($f,"\n");
    fclose($f);
    $result = "ok";
    return $result;
  }
}

?>
