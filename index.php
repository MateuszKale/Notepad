<?php

//declare(strict_types=1);

namespace App;
//import debug function dump()
require_once("src/Utils/debug.php");


$action = $_GET['action'] ?? null;

// one line if
// if (!empty($_GET['action'])){
//     $action = $_GET['action'];
// } else{
//     $action == null;
// }


//View logic

if ($action === 'create'){
    include_once("templates/pages/create.php");
}else{
    include_once("templates/pages/list.php");
}







