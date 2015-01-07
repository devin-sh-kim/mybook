<?
$path = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
$uri  = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

foreach ($path as $key => $val) {
    if (isset($uri[$key]) && $val == $uri[$key]) {
        unset($uri[$key]);
    } else {
        break;
    }
}

$uri = implode('/', $uri);
$ctx = str_replace( $uri, '', $_SERVER['SCRIPT_URI'] );
//echo $ctx
?>