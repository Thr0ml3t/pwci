<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

header('Content-type: application/json');

$json = file_get_contents('php://input');
$body = json_decode($json, true);

$noteTitle = $body['title'];
$noteBody = $body['note'];

$errors = array();

//$validator = new Validator();

if (!Validator::string($noteTitle, 1, 100)) {
    $errors['title'] = "A title of no more than 100 characters is required.";
}

if (empty($noteBody)) {
    $errors['body'] = "Body is required";
}

if (empty($errors)) {
    $query = "INSERT INTO notas (title, note,user_id)
                VALUES (:title, :body,:user_id)";
    $insert = $db->query($query, [
        'title' => $noteTitle,
        'body' => $noteBody,
        'user_id' => 1,
    ]);

    unset($noteTitle);
    unset($noteBody);

    $response = [];
    $response["success"] = true;
    $response["errors"] = [];
    $response["msg"] = 'Note created!';

    echo json_encode($response);
    return;
} else {
    header('HTTP/1.1 400');

    $response["success"] = false;
    $response["errors"] = $errors;
    $response["msg"] = 'Some errors occured!';
    echo json_encode($response);
    return;
}

