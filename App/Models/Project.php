<?php
namespace  App\Models;
use App\Config\Configuration;

class Project extends \App\Core\Model
{
    public function __construct(
        public int     $id = 0,
        public int     $user_id = 0,
        public ?string $image = null,
        public ?string  $name = null,
        public ?string $text = null
    )
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'image','name', 'text','user_id'];
    }

    static public function setTableName()
    {
        return "projects";
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
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @param int $post_id
     */
    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUser(): ?string
    {
        $found= Registration::getAll('id like "'.$this->user_id.'"');
        $name = "";
        if($found != null){
            foreach ($found as $user) {
                $name = $user->getFirstname() . " " . $user->getLastname();
               
            }

        }
        return $name;
    }



}