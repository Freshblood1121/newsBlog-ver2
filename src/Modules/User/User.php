<?php

namespace App\Modules\User;

use App\UUID;

class User implements InterfaceUser
{
    public function __construct(
        private UUID $uuid,
        private string $username,
        private string $email
    ) {
    }

    public function __toString(): string
    {
        return "Пользователь $this->uuid" . PHP_EOL . "Почта: " . $this->username . PHP_EOL . "Логин: " . $this->email . PHP_EOL;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function name(string $username): void
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

    /**
     * @param UUID $uuid
     */
    public function setUuid(UUID $uuid): void
    {
        $this->uuid = $uuid;
    }
}