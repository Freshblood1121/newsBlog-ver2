<?php

namespace App\Modules\Post;

use App\Contracts\AddInterface;
use App\UUID;

interface InterfacePost extends AddInterface
{
    public function get(UUID $uuid): Post;
    public function save(Post $post);
}