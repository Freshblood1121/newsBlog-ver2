<?php

namespace App\Modules\Post;

use App\Modules\User\User;
use App\UUID;

class Post implements InterfacePost
{
    public function __construct(
        private UUID $uuid,
        private User $user,
        private string $text
    ) {
    }
    public function __toString(): string
    {
        return $this->user . 'Пишет пост: ' . $this->text;
    }



    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return UUID
     */
    public function uuid(): UUID
    {
        return $this->uuid;
    }

    /**
     * @param UUID $uuid
     */
    public function setUuid(UUID $uuid): void
    {
        $this->uuid = $uuid;
    }
}