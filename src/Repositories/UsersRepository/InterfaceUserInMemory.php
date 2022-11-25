<?php

namespace App\Repositories\UsersRepository;

use App\Modules\User\User;
use App\UUID;

interface InterfaceUserInMemory
{
    public function get(UUID $uuid): User;
    public function getByEmail(string $email): User;
}