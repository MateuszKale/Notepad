<?php


declare(strict_types=1);

namespace App;

require_once("src/view.php");

class Controller
{
  private const DEFAULT_ACTION = 'list';

  private array $getData;
  private array $postData;
  

  public function __construct(array $postData, array $getData)
  {
    
    $this->getData = $getData;
    $this->postData = $postData;
  }



  public function run(): void
  {

    $action = $this->getData['action'] ?? self::DEFAULT_ACTION;

    $view = new View();
    $viewParams = [];



    switch($action){
    case 'create':
      $page = 'create';
      $created = false;
  
  
      // Checking that our global variable takes any values if they have any values save then to variable
      if (!empty($this->postData)){
        $created = true;
        $viewParams = [
          'title'=> $this->postData['title'],
          'description' => $this->postData['description']
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
}