<?php

use Ferre\AppNotes\models\Note;

$notes = Note::getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Notes</title>
    <link rel="stylesheet" href="src/views/resources/main.css">
</head>
<body>
    <?php require "resources/navbar.php" ?>
    <h1>Home</h1>
    <div class="notes-container">
        <?php foreach ($notes as $note): ?>
           <a href="?view=view&id=<?=$note->getUUID();?>">
            <div class="note-preview">
                <div class="title"><?=$note->getTitle();?></div>
            </div>
           </a>
        <?php endforeach;?>
    </div>
</body>
</html>
