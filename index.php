<?php

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use Throwable;

require_once("src/Utils/debug.php");
require_once("src/Controller.php");

$configuration = require_once("config/config.php");

$request = [
  'get' => $_GET,
  'post' => $_POST
];


try {
  // $controller = new Controller($request);
  // $controller->run();

  Controller::initConfiguration($configuration);
  (new Controller($request))->run();
} catch(AppException $e) {
} catch (Throwable $e){
  echo "<h1>Wystąpił błąd w aplikacji</h1>";
}





