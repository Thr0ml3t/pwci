<?php

class Database{
    public $connection;

    public function __construct($config){
        $dsn = 'mysql:' . http_build_query($config,"",";");

        $this->connection = new PDO($dsn,'root','12345');
    }

    public function query($query,$params = []){
        $stmt = $this->connection->prepare($query);

        $stmt->execute($params);

        return $stmt;
    }
}
