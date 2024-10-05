<?php

$heading = 'New Note';

$config = require 'config.php';
$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-type: application/json');

    $json = file_get_contents('php://input');
    $body = json_decode($json, true);

    $noteTitle = $body['title'];
    $noteBody = $body['note'];

    $errors = array();

    if (strlen($noteTitle) == 0 || strlen($noteTitle) >= 10) {
        $errors['title'] = "Title must be less than 10 characters";
    }

    if(empty($noteBody)) {
        $errors['body'] = "Body is required";
    }

    if(empty($errors)) {
        $query = "INSERT INTO notas (title, note,user_id)
                VALUES (:title, :body,:user_id)";
        $insert = $db->query($query,[
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
    }else{
        header('HTTP/1.1 400');

        $response["success"] = false;
        $response["errors"] = $errors;
        $response["msg"] = 'Some errors occured!';
        echo json_encode($response);
        return;
    }
}


require 'views/note-create.view.php';