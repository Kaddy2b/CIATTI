<?php
require_once File::build_path(array("Controller", "controllerFleche.php"));
require_once File::build_path(array("Controller", "controllerEtape.php"));

//controller
if (isset($_GET["controller"])) {
	$controller = "Controller" . ucfirst($_GET["controller"]);
} else if (isset($_POST["controller"])) {
	$controller = "Controller" . ucfirst($_POST["controller"]);
} else {
	$controller = "ControllerFleche";
}

//action
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = "readAllPanel";
}

$controller::$action();
?>