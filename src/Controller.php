<?php

declare(strict_types=1);

namespace App;

require_once("src/Exceptions/ConfigurationException.php");

use APP\Request;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;
use PgSql\Result;

require_once("src/Database.php");
require_once("src/View.php");


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

  public function run(): void
  {
    switch ($this->action()) {
      case 'create':
        $page = 'create';


        $data = $this->getRequestPost();
        if (!empty($data)) {
          $noteData =[
            'title' => $data['title'],
            'description' => $data['description']
          ];
          $this->database->createNote($noteData);
          header('Location: /?before=created');
          exit;
        }

        break;
      case 'show':
        $page = 'show';

        // $data = $this->getRequestGet();
        // $noteId = (int) ($data['id'] ?? null);

        $noteId= $this->request->getParam('id');
        dump($noteId);

        if (!$noteId){
          header('Location: /?error=missingNoteId');
          exit;
        }

        try{
          $note = $this->database->getNote($noteId);
        } catch (NotFoundException $e){
          header('Location: /?error=noteNotFound');
          exit;
        }

        $viewParams = [
          'note' => $note,
          'title' => 'Moja notatka',
          'description' => 'Opis'
        ];
        break;
      default:
        $page = 'list';

        $viewParams = [
          'notes' => $this->database->getNotes(),
          'before' => $data['before'] ?? null,
          'error' => $data['error'] ?? null
        ];
        break;
    }

    $this->view->render($page, $viewParams ?? []);
  }

  private function action(): string
  {
    $action = $this->request->getParam('action');

    return $action ?? self::DEFAULT_ACTION;
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
