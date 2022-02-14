<?php 
namespace App\core;

use PDO;

class db
{
    public  \PDO $pdo;
    public function __construct($config) {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $pass = $config['pass'];

        $this->pdo = new PDO($dsn,$user,$pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
    public function appliyM()
    {
        $this->createtable();
        $tomig=[];
        $file =scandir(App::$dir.'/mvcphp/migrations');
        $appliedM=$this->appliedM();
        $migs=array_diff($file,$appliedM);
        foreach ($migs as $key) {
            if ($key === '.' || $key === '..') {
                continue;
            }
            require_once App::$dir."/mvcphp/migrations/$key";
            $classname = pathinfo($key,PATHINFO_FILENAME);
            $class = new $classname();
            $class->up();
            $tomig[]=$key;

        }
      if (!empty($tomig)) {
          return $this->saveMig($tomig);
      }else{
          echo "all migrations are Applied".PHP_EOL;
      }
        
    }

    public function saveMig($tomig)
    {
        $tomigs=implode(',',array_map(fn($n)=> "('$n')",$tomig));
        $sql = "INSERT INTO migrations(migrations) VALUES $tomigs";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute();
    }
    public function createtable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            migrations VARCHAR(255))
            ENGINE=INNODB;");

    }public function appliedM()
    {
        $sql ="SELECT migrations FROM migrations";
        $stmt =$this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}

?>