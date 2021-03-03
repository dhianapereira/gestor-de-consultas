<?php
session_start();
require_once "app/utils/autoload.php";

if (isset($_GET["page"])) {
  require_once "app/pages/" . $_GET["page"] . "/index.php";
} else if (isset($_GET["action"]) && isset($_GET["class"])) {
  $controller = $_GET["class"] . "Controller";
  $action = $_GET["action"];

  require_once "app/controllers/" . $controller . ".php";

  $controller = new $controller();

  $controller->$action();
} else if (isset($_SESSION["loggedUser"])) {
  require_once "app/pages/home/index.php";
} else {
  require_once "app/pages/index.php";
}
