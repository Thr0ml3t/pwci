<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$games = [
    [
        "title" => "COD: Blackops 2",
        "releaseYear" => 2012,
        "genere" => "FPS",
    ],
    [
        "title" => "RISK",
        "releaseYear" => 2015,
        "genere" => "Strategy",
    ],
    [
        "title" => "Tears of the kingdom",
        "releaseYear" => 2023,
        "genere" => "RPG",
    ]
];

function filter($games,$fn)
{
    $filteredGames = [];
    foreach ($games as $game) {
        if ($fn($game)) {
            $filteredGames[] = $game;
        }
    }
    return $filteredGames;
}

$result = filter($games,function ($game){
    return $game['releaseYear'] > 2014;
});



?>
<h1>Juegos recomendados</h1>
<ul>
    <?php foreach ($result as $game) : ?>
        <li><?= $game['title'] ?> (<?= $game['releaseYear'] ?>, <?= $game['genere'] ?>)</li>
    <?php endforeach; ?>
</ul>
</body>
</html>