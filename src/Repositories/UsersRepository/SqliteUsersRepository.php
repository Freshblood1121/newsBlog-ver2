<?php

namespace App\Repositories\UsersRepository;

use App\Excepetions\InvalidArgumentException;
use App\Excepetions\UserNotFoundException;
use App\Modules\User\User;
use App\UUID;
use Faker\Guesser\Name;
use PDO;
use PDOStatement;
class SqliteUsersRepository implements InterfaceUserInMemory
{
    public function __construct(private PDO $connection){}
    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO users (uuid,email,first_name,last_name)
                   VALUES (:uuid,:email,:first_name,:last_name)'
        );
        $statement->execute([
            ':uuid' => $user->uuid(),
            ':email' => $user->getEmail(),
            ':first_name' => $user->getUsername()->getFirstName(),
            ':last_name' => $user->getUsername()->getLastName(),
        ]);
    }
    /**
     * @throws InvalidArgumentException
     * @throws UserNotFoundException
     */
    public function get(UUID $uuid): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE uuid = :uuid'
        );
        $statement->execute([':uuid' => (string)$uuid]);
        return $this->getEmail($statement, $uuid);
    }
    /**
     * @throws InvalidArgumentException
     * @throws UserNotFoundException
     */
    public function getByEmail(string $email): User
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM users WHERE email = :email'
        );
        $statement->execute([':email' => $email]);
        return $this->getEmail($statement, $email);
    }
    /**
     * @throws InvalidArgumentException
     * @throws UserNotFoundException
     */
    private function getEmail(PDOStatement $statement, string $username): User
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (false === $result) {
            throw new UserNotFoundException(
                "Cannot find user: $username"
            );
        }
        return new User(
            new UUID($result['uuid']),
            $result['email'],
            new Name($result['first_name'], $result['last_name'])
        );
    }
}