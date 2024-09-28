<?php

require 'functions.php';
//require 'router.php';
require 'Database.php';

$config = require 'config.php';

$db = new Database($config['database']);
$result = $db->query('SELECT * FROM notas where id = 2');

dd('Hola');