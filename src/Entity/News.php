<?php

declare(strict_types=1);

namespace App\Entity;

class News implements EntityInterface
{
    /**
     * @Documentation
     * Properties are not being used by outside classes
     * should be define as private by default
     */
    private $id;
    private $title;
    private $body;
    private $createdAt;

    public function getTableName(): string
    {
        return 'news';
    }

    /**
     * @Documentation
     * Setter method should define a type of its property
     * to control the type of parameter being pass
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @Documentation
     * its always good to define return type to getters
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
