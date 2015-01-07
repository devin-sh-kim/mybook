<pre>
<?
print_r($_SERVER);
// /sitename/index.php
$path = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
print_r($path);
// /sitename/portfolio/design
$uri  = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
print_r($uri);
foreach ($path as $key => $val) {
    if ($val == $uri[$key]) {
        unset($uri[$key]);
    } else {
        break;
    }
}

// portfolio/design
$uri = implode('/', $uri);
?>
</pre>