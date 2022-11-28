<?php

namespace App\Commands;

use App\Excepetions\ArgumentsException;
use App\Excepetions\InvalidArgumentException;
use App\Excepetions\UserNotFoundException;
use App\Modules\User\User;
use App\Repositories\UsersRepository\InterfaceUserInMemory;
use App\UUID;
use Faker\Guesser\Name;
use App\Excepetions\CommandException;

class CreateUserCommand
{
    public function __construct(
        private InterfaceUserInMemory $usersRepository
    ) {
    }
// php cli.php email=ivan first_name=Ivan last_name=Nikitin

    // Вместо массива принимаем объект типа Arguments
    /**
     * @throws InvalidArgumentException
     * @throws CommandException
     * @throws ArgumentsException
     */
    public function handle(Arguments $arguments): void
    {
        $email = $arguments->get('email');
        if ($this->userExists($email)) {
            throw new CommandException("User already exists: $email");
        }
        $this->usersRepository->save(new User(
            UUID::random(),
            $email,
            new Name($arguments->get('first_name'), $arguments->get('last_name'))
        ));
    }
    private function userExists(string $email): bool
    {
        try {
            $this->usersRepository->getByemail($email);
        } catch (UserNotFoundException) {
            return false;
        }
        return true;
    }
}