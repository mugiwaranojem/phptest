<?php

declare(strict_types=1);

namespace App\Entity;

class Comment implements EntityInterface
{
    /**
     * @Documentation
     * Properties are not being used by outside classes
     * should be define as private by default
     */
    private $id;
    private $body;
    private $createdAt;
    private $newsId;

    public function getTableName(): string
    {
        return 'comment';
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

    public function getNewsId(): int
    {
        return $this->newsId;
    }

    public function setNewsId(int $newsId): self
    {
        $this->newsId = $newsId;

        return $this;
    }
}
