<?
//error handler function
function customError($errno, $errstr, $errfile, $errline) {
  echo "<b>Error:</b> [$errno] $errfile:$errline $errstr <br/>";
}

//set error handler
set_error_handler("customError");
?>