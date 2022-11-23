<?php

namespace App\Repositories\UsersRepository;

use App\Modules\User\User;
use PDO;

class SqliteUsersRepository
{
    public function __construct(
        private PDO $connection
    ) {
    }

    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users (name_surname, email, uuid)
                   VALUES (:first_name, :last_name, :uuid)'
        );

        $statement->execute([
            ':first_name' => $user->getUsername(),
            ':last_name' => $user->getEmail(),
            ':uuid' => $user->uuid()
        ]);
    }


}