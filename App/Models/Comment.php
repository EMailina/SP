<?php

namespace App\Models;

class Comment extends \App\Core\Model
{
    public function __construct(
    public int     $id = 0,
    public int     $project_id = 0,
    public ?string $text = null,
    public int     $user_id = 0
)
    {
    }

    static public function setDbColumns()
{
    return ['id', 'project_id','text', 'user_id'];
}

    static public function setTableName()
{
    return "comments";
}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->project_id;
    }

    /**
     * @param int $project_id
     */
    public function setProjectId(int $project_id): void
    {
        $this->project_id = $project_id;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getAuthor(): ?string
    {
        return Registration::getOne($this->user_id)->getFirstname() .' '. Registration::getOne($this->user_id)->getLastname();
    }

}