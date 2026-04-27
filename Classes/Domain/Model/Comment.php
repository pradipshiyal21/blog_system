<?php

declare(strict_types=1);

namespace MyVendor\Blog\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Comment extends AbstractEntity
{
    protected string $firstName = '';
    protected string $lastName = '';
    protected string $email = '';
    protected string $comment = '';

    protected int $isApproved = 0;

    protected ?Post $post = null;

    // Getters & Setters

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getIsApproved(): int
    {
        return $this->isApproved;
    }

    public function setIsApproved(int $isApproved): void
    {
        $this->isApproved = $isApproved;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}