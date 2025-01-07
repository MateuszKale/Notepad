<?php

declare(strict_types=1);

namespace App;

require_once('Exceptions/AppException.php');

use App\Exception\StorageException;
use PDO;
use Throwable;

class Database
{
  public function __construct(array $config)
  {
    try{
      $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
    
      $connection = new PDO(
        $dsn,
        $config['user'],
        $config['password'],
    );
    } catch(Throwable $e){
      throw new StorageException('Connection error');
      exit('e');
    }
  }
}