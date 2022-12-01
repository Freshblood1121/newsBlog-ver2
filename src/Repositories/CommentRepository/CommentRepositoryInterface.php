<?php

namespace App\Repositories\CommentRepository;

use App\Modules\Comment\Comment;
use App\UUID;

interface CommentRepositoryInterface
{
    public function save(Comment $comment): void;
    public function get(UUID $uuid): Comment;
}