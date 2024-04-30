<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config/config.php";
$ruta = !empty($_GET['url']) ? $_GET['url'] : "home/index";
$array = explode("/", $ruta);
$controllers = $array[0];
$metodo = "index";
$parametro = "";
if (!empty($array[1])) {
    if (!empty($array[1]) != "") {
        $metodo = $array[1];
    }
}

if (!empty($array[2])) {
    if (!empty($array[2]) != "") {
        for ($i = 2; $i < count($array); $i++) {
            $parametro .= $array[$i] . ",";
        }
        $parametro = trim($parametro, ",");
    }
}
require_once "config/app/autoload.php";
$dirControllers = "controllers/" . $controllers . ".php";
if (file_exists($dirControllers)) {
    require_once $dirControllers;
    $controller = new $controllers();
    if (method_exists($controller, $metodo)) {
        $controller->$metodo($parametro);
    } else {
        echo "No existe el metodo";
    }
} else {
    echo "No existe el controlador";
}
