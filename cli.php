<?php

//Файл подключения(контроллер)
use App\Commands\Arguments;
use App\Commands\CreateUserCommand;
use App\Modules\User\User;
use App\Repositories\UsersRepository\InMemoryUsersRepository;
use App\Repositories\UsersRepository\SqliteUsersRepository;
use App\UUID;
use Faker\Guesser\Name;

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite'); //PDO
include __DIR__ . '/vendor/autoload.php'; //Composer
require __DIR__ . '/src/Structure/fakeStructure.php'; //Точка записи локальных данных
$faker = Faker\Factory::create('ru_RU'); //Faker

$usersRepository = new InMemoryUsersRepository(); //Локальный репозиторий
$usersRepository = new SqliteUsersRepository($connection);// База данных SQLite
$command = new CreateUserCommand($usersRepository); // Консоль

try {
    //Записать в таблицу новые данные через консоль
    $command->handle(Arguments::fromArgv($argv));
// Точка входа
// Записать в таблицу новые данные
//    $usersRepository->save(
//    new User(
//        UUID::random(),
//        $faker->FreeEmail(),
//        new Name(
//            $faker->firstName("female"),
//            $faker->lastName("female")
//        )
//    ));
// Получить значение одного значения из базы данных
// echo $usersRepository->getByEmail("elvira.morozov@mail.rp");
} catch (Exception $e){
    echo $e->getMessage();
}