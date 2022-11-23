<?php

//Файл подключения(контроллер)
use App\Modules\User\User;
use App\Repositories\UsersRepository\InMemoryUsersRepository;
use App\Repositories\UsersRepository\SqliteUsersRepository;
use App\UUID;
use Faker\Guesser\Name;

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite'); //DataBase
include __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Structure/fakeStructure.php';
$faker = Faker\Factory::create('ru_RU');

$usersRepository = new InMemoryUsersRepository();
$usersRepository = new SqliteUsersRepository($connection);

$usersRepository->save(
    new User(
        UUID::random(),
    new Name(
            $faker->firstName("female"),
            $faker->lastName("female")
        ), "petrovich@asf.wef")
);

$usersRepository->save(
    new User(
        UUID::random(),
    new Name(
        $faker->firstName("female"),
        $faker->lastName("female")),
        "petrovna@sdasf.wef")
);
