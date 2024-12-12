<?php

//declare(strict_types=1);

namespace App;
//import debug function dump()
require_once("src/Utils/debug.php");
require_once("src/view.php");


$action = $_GET['action'] ?? null;

// one line if
// if (!empty($_GET['action'])){
//     $action = $_GET['action'];
// } else{
//     $action == null;
// }


$view = new View();
$view->render($action);











