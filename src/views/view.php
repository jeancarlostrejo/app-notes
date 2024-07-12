<?php
use Ferre\AppNotes\Models\Note;

$title = $_POST["title"] ?? "";
$content = $_POST["content"] ?? "";
$uuid = $_POST["id"] ?? "";

if (isset($_POST["send"])) {
    if (empty($title) || empty($content)) {
        echo "Todos los campos son obligatorios";
    } else {
        $note = Note::get($uuid);

        $note->setTitle($title);
        $note->setContent($content);

        $note->update();
    }
} elseif (isset($_GET["id"]) && !empty($_GET["id"])) {
    $note = Note::get($_GET["id"]);
} else {
    header("Location: http://localhost/app-notes/?view=home");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
    <h1>View note</h1>

    <?php if ($note): ?>
    <form action="?view=view&id= <?=$note->getUUID();?>" method="POST">
        <input type="text" name="title" value=" <?=$note->getTitle();?> ">
        <input type="hidden" name="id" value="<?=$note->getUUID() ?>">
        <textarea name="content" cols="30" rows="10"><?=$note->getContent();?>
        </textarea>
        <input type="submit" name="send" value="Actualizar nota">
    </form>
    <?php else: ?>
        <div>Nota no encontrada</div>
    <?php endif;?>
</body>
</html>