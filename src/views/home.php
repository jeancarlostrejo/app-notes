<?php

use Ferre\AppNotes\Models\Note;

$notes = Note::getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Notes</title>
</head>
<body>
    <h1>Home</h1>
    <?php foreach ($notes as $note): ?>
       <a href="?view=view&id=<?=$note->getUUID();?>">
        <divc class="note-preview">
            <div class="title"><?=$note->getTitle();?></div>
        </div>
       </a>
    <?php endforeach;?>
</body>
</html>
