<?php

namespace App\Repositories\PostRepository;

use App\Modules\Post\Post;
use App\UUID;

interface PostRepositoryInterface
{
    public function save(Post $post): void;
    public function get(UUID $uuidString): Post;
}