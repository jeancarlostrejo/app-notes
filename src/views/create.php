<?php

use Ferre\AppNotes\models\Note;

$title = $_POST["title"] ?? "";
$content = $_POST["content"] ?? "";
if (isset($_POST["send"])) {
    if (empty($title) || empty($content)) {
        echo "Todos los campos son obligatorios";
    } else {
        $note = new Note($title, $content);

        $note->save();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new note</title>
</head>
<body>
    <h1>Create note</h1>
    <form action="?view=create" method="POST">
        <input type="text" name="title" placeholder="Título...">
        <textarea name="content" cols="30" rows="10"></textarea>
        <input type="submit" name="send" value="Crear nota">
    </form>
</body>
</html>
