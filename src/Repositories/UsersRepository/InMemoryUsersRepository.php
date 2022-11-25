<?php

namespace App\Repositories\UsersRepository;

use App\Contracts\AddInterface;
use App\Excepetions\UserNotFoundException;
use App\Modules\User\User;
use App\UUID;

class InMemoryUsersRepository implements InterfaceUserInMemory
{
    private array $users = [];
    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * @throws UserNotFoundException
     */
    public function get(UUID $uuid): User
    {
        foreach ($this->users as $user) {

            if ((string)$user->uuid() === (string)$uuid) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $uuid");
    }

    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User
    {
        foreach ($this->users as $user) {
            if ($user->username() === $email) {
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $email");
    }
}