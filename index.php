<?php

//class User {
//  public
//}

class Data
{
  private $dsn;
  private $username;
  private $password;
  public function __construct()
  {
    $this->dsn = "mysql:host=localhost;dbname=test_conn;charset=utf8";
    $this->username = "root";
    $this->password = "caongan@123";
  }

  public function connect(): PDO
  {
    try {
      return new PDO($this->dsn, $this->username, $this->password);
    } catch (\PDOException $exception) {
      echo "Error: " . $exception->getMessage();
      die();
    }
  }

  public function getUsers()
  {
    $query = $this->connect()->query("SELECT * FROM test_conn.users");
    $query->execute();
    $query->setFetchMode(PDO::FETCH_OBJ);
    return $query->fetchAll();
  }

  public function loopData()
  {
    foreach ($this->getUsers() as $val) {
      return $val->name;
    }
  }

}

header('Access-Control-Allow-Origin: *');
$data = new Data();
//var_dump(gettype($data->getUsers()));
die(json_encode($data->loopData()));
