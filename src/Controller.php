<?php


declare(strict_types=1);

namespace App;

require_once("src/view.php");

class Controller
{
  private const DEFAULT_ACTION = 'list';

  private array $request;

  

  public function __construct(array $request)
  {
    $this->request = $request;
  }


  public function action(): string
  {
    $data = $this->getRequestGet();
    return $this->getData['get']['action'] ?? self::DEFAULT_ACTION;
  }


  public function run(): void
  {

    $action = $this->action();

    $view = new View();
    $viewParams = [];



    switch($action){
      case 'create':
        $page = 'create';
        $created = false;
    
        $data = $this->getRequestPost();
        // Checking that our global variable takes any values if they have any values save then to variable
        if (!empty($data)){
          $created = true;
          $viewParams = [
            'title'=> $data['title'],
            'description' => $data['description']
          ];
        }
    
        $viewParams['created'] = $created;
        break;
    
      case 'show':
        $viewParams = [
          'title' => 'Moja notatka',
          'descruption' => 'Opis'
        ];
        break;
      default:
        $page = 'list';
        $viewParams['resultList'] = "Wyświetlamy notatki";
        break;
    }


    $view->render($page, $viewParams);
  }

  private function getRequestGet(): array
  {
    return $this->request['get'] ?? [];
  }

  private function getRequestPost(): array
  {
    return $this->request['post'] ?? [];
  }

  

}