<?php

declare(strict_types=1);

namespace App;

require_once("src/Exceptions/ConfigurationException.php");
require_once("src/Database.php");
require_once("src/View.php");

use APP\Request;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;
use PgSql\Result;


class Controller
{
  private const DEFAULT_ACTION = 'list';

  private static array $configuration = [];

  private Request $request;
  private Database $database;
  private View $view;


  public static function initConfiguration(array $configuration): void
  {
    self::$configuration= $configuration;
  }

  public function __construct(Request $request)
  {

    if (empty((self::$configuration['db']))){
      throw new ConfigurationException('Configuration error');
    }
    $this->database = new Database(self::$configuration['db']);

    $this->request = $request;
    $this->view = new View();

  }

  public function createAction()
  {

    if ($this->request->hasPost()) {
      $noteData =[
        'title' => $this->request->postParam('title'),
        'description' => $this->request->postParam('description')
      ];
      $this->database->createNote($noteData);
      header('Location: /?before=created');
      exit;
    }   

    $this->view->render('create');
  }

  public function showAction()
  {
    $noteId = (int) $this->request->getParam('id');

    if (!$noteId){
      header('Location: /?error=missingNoteId');
      exit;
    }

    try{
      $note = $this->database->getNote($noteId);
    } catch (NotFoundException $e){
      header('Location: /?error=noteNotFound');
      exit;

      $this->view->render($page, $viewParams ?? []);
    }

    $viewParams = [
      'note' => $note,
    ];

    $this->view->render(
      'show',
      ['note' => $note]
    );
  }

  public function listAction()
  {
    $this->view->render(
      'list', 
      [
      'notes' => $this->database->getNotes(),
      'before' => $this->request->getParam('before'),
      'error' => $this->request->getParam('error')
      ]
    );
  }

  

  public function run(): void
  {
    $action = $this->action() . 'Action';

    if (!method_exists($this, $action)){
      $action = self::DEFAULT_ACTION. 'Action';
    }

    $this->$action();
  }

  private function action(): string
  {
    return $this->request->getParam('action', self::DEFAULT_ACTION);
  }



  // private function getRequestGet(): array
  // {
  //   return $this->request['get'] ?? [];
  // }


  // private function getRequestPost(): array
  // {
  //   return $this->request['post'] ?? [];
  // }
}
