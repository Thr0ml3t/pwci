<?php

$heading = 'Note';

$config = require 'config.php';

$id = $_GET['id'];

$db = new Database($config['database']);
$note = $db->query('SELECT * FROM notas where id = :id', [
    'id' => $id,
])->fetch(PDO::FETCH_ASSOC);

if(!$note){
    abort();
}

if($note['user_id'] != 1){
    abort(403);
}

$heading = 'Note: ' . htmlspecialchars($note['title']);


require 'views/note.view.php';