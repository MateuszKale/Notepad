<?php

declare(strict_types=1);

namespace App;
//import debug function dump()
require_once("src/Utils/debug.php");
require_once("src/view.php");

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

// one line if
// if (!empty($_GET['action'])){
//     $action = $_GET['action'];
// } else{
//     $action == null;
// }

$view = new View();

$viewParams = [];
if ($action === 'create') {
  $page = 'create';

  // Checking that our global variable takes any values if they have any values save then to variable
  if (!empty($_POST)){
    
    $viewParams = [
      'title'=> $_POST['title'],
      'description' => $_POST['description']
    ];

    dump($data);

  }
} else {
  $page = 'list';
  $viewParams['resultList'] = "wyświetlamy notatki";
}


$view->render($page, $viewParams);











