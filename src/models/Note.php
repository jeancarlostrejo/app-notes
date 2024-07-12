<?php

namespace Ferre\AppNotes\Models;

use Ferre\AppNotes\libs\Database;
use PDO;

class Note extends Database
{
    private string $uuid;
    public function __construct(private string $title, private string $content)
    {
        parent::__construct();
        $this->uuid = uniqid();
    }

    public function save(): void
    {
        try {
            $stm = $this->connect()->prepare("INSERT INTO notes (uuid, title, content, updated) VALUES (?,?,?,NOW())");
            $stm->bindParam(1, $this->uuid);
            $stm->bindParam(2, $this->title);
            $stm->bindParam(3, $this->content);

            $stm->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(): void
    {
        try {
            $stm = $this->connect()->prepare("UPDATE note SET title = ?, content = ?, updated = NOW() WHERE uuid = ?");
            $stm->bindParam(1, $this->getTitle());
            $stm->bindParam(2, $this->getContent());
            $stm->bindParam(3, $this->getUUID());

            $stm->execute();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function get(string $uuid): Note
    {
        $db = new Database();

        $stm = $db->connect()->prepare("SELECT * FROM notes WHERE uuid = ?");
        $stm->bindParam(1, $uuid);

        $note = Note::createFromArray($stm->fetch(PDO::FETCH_ASSOC));

        return $note;
    }

    public static function createFromArray($array): Note
    {
        $note = new Note($array["title"], $array["content"]);
        $note->setUUID($array["uuid"]);

        return $note;
    }

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function setUUID(string $value): void
    {
        $this->uuid = $value;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $value): void
    {
        $this->title = $value;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $value): void
    {
        $this->content = $value;
    }

}
