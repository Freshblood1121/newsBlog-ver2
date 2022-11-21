<?php

//Файл подключения(контроллер)
use App\Modules\User\User;
use App\Repositories\UsersRepository\InMemoryUsersRepository;
use App\Repositories\UsersRepository\SqliteUsersRepository;
use Faker\Guesser\Name;

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite'); //DataBase
include __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Structure/fakeStructure.php';

$usersRepository = new InMemoryUsersRepository();
$usersRepository = new SqliteUsersRepository($connection);

$usersRepository->save(new User(1, new Name('Ivan', 'Nikitin'), "petrovich@asf.wef"));
$usersRepository->save(new User(2, new Name('Anna', 'Petrova'), "petrovna@sdasf.wef"));
