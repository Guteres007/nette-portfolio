<?php


namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
{

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected string $title;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected string $description;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}
