<?php

namespace App\Models;

class ProjectImage extends \App\Core\Model
{
    public function __construct(
        public int     $id = 0,
        public int     $project_id = 0,
        public ?string $image = null,
 public ?string  $name = null
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'project_id', 'image', 'name'];
    }

    static public function setTableName()
    {
        return "projectImages";
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
     * @param int 4project_id
     */
    public function setIdProject(int $project_id): void
    {
        $this->project_id = $project_id;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImagePath(): ?string
    {
        $found= Project::getAll('id like "'.$this->id_project.'"');
        $path = "";
        if($found != null){
            foreach ($found as $project) {
                $name = $project->getName() . "/";

            }

        }
        return $path;

    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}