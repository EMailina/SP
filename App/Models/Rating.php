<?php

namespace App\Models;


class Rating extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public int $id_project = 0,
        public int $id_user = 0,
        public int $rating = 0
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'id_project', 'id_user', 'rating'];
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
        return $this->id_project;
    }

    /**
     * @param int $id_project
     */
    public function setIdProject(int $id_project): void
    {
        $this->id_project = $id_project;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
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