<?php

namespace App\Modules\User;

use App\UUID;
use Faker\Guesser\Name;

class User implements InterfaceUser
{
    public function __construct(
        private UUID $uuid,
        private string $email,
        private Name $username
    ) {
    }

    public function __toString(): string
    {
        return "Пользователь $this->uuid" . PHP_EOL . "Почта: " . $this->email . PHP_EOL . "Логин: " . $this->username . PHP_EOL;
    }

    /**
     * @return Name
     */
    public function getUsername(): Name
    {
        return $this->username;
    }

    /**
     * @param Name $username
     */
    public function setUsername(Name $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return UUID
     */
    public function uuid(): UUID
    {
        return $this->uuid;
    }
}