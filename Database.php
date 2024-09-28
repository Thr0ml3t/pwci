<?php

class Database{
    public $connection;

    public function __construct($config){
        $dsn = 'mysql:' . http_build_query($config,"",";");

        $this->connection = new PDO($dsn,'root','12345');
    }

    public function query($query){
        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
