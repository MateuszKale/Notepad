<?php

declare(strict_types=1);

namespace App;

require_once("src/Utils/Debug.php");
require_once("src/NoteController.php");
require_once("src/Request.php");
require_once("src/Exceptions/AppException.php");

use App\Request;
use App\Exception\StorageException;
use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;



$configuration = require_once("config/config.php");



$request = new Request($_GET,$_POST);


try {
  // $controller = new Controller($request);
  // $controller->run();

  AbstractController::initConfiguration($configuration);
  (new NoteController($request))->run();
} catch (ConfigurationException $e){
  //mail('xxx@xxx.com,'Error',$e->getmessage());
  echo "<h1>Wystąpił błąd w aplikacji</h1> ";
  echo $e->getMessage();
  echo "Problem z konfiguracją. Proszę skontaktować sie z administratorem x@x.com";
} catch(AppException $e) {
  echo "<h1>Wystąpił błąd w aplikacji</h1>";
  echo "<h3> " . $e->getMessage() . '</h3>';
} catch (Throwable $e){
  echo "<h1>Wystąpił błąd w aplikacji</h1>";
  dump($e);
}





