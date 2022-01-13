<?php

namespace App\Models;


class Rating extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public int $project_id = 0,
        public int $user_id = 0,
        public int $rating = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'project_id', 'user_id', 'rating'];
    }

    static public function setTableName()
    {
        return "ratings";
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
    public function getIdProject(): int
    {
        return $this->project_id;
    }

    /**
     * @param int $project_id
     */
    public function setIdProject(int $project_id): void
    {
        $this->project_id = $project_id;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setIdUser(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

}