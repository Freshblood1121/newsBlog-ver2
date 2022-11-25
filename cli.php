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

//$usersRepository->save(
//    new User(
//        UUID::random(),
//    new Name(
//            $faker->firstName("female"),
//            $faker->lastName("female")
//        ), $faker->freeEmail)
//);
//
//$usersRepository->save(
//    new User(
//        UUID::random(),
//    new Name(
//        $faker->firstName("female"),
//        $faker->lastName("female")),
//        $faker->freeEmail)
//);

try {
//    $usersRepository->save(
//    new User(
//        UUID::random(),
//        $faker->FreeEmail(),
//        new Name(
//            $faker->firstName("female"),
//            $faker->lastName("female")
//        )
//    ));
  echo $usersRepository->getByEmail("elvira.morozov@mail.rp");
} catch (Exception $e){
    echo $e->getMessage();
}
