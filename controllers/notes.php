<?php

$heading = 'Notes';

$config = require 'config.php';

$db = new Database($config['database']);
$notes = $db->query('SELECT * FROM notas where user_id = 1')
    ->fetchAll(PDO::FETCH_ASSOC);


require 'views/notes.view.php';