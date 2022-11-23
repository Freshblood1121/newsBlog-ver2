<?php

namespace App\Modules\Comment;

use App\Modules\Post\Post;
use App\Modules\User\User;
use App\UUID;

class Comment implements InterfaceComment
{
    public function __construct(
        private UUID $uuid,
        private User $user,
        private Post $post,
        private string $text
    ) {
    }

    public function __toString(): string
    {
        return $this->user . 'Пишет комментарий: ' . $this->text;
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
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post): void
    {
        $this->post = $post;
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