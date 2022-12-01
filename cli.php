<?php

//Файл подключения(контроллер)
use App\Commands\Arguments;
use App\Commands\CreateUserCommand;
use App\Modules\Comment\Comment;
use App\Modules\Post\Post;
use App\Modules\User\User;
use App\Repositories\CommentRepository\CommentRepository;
use App\Repositories\PostRepository\PostRepository;
use App\Repositories\UsersRepository\InMemoryUsersRepository;
use App\Repositories\UsersRepository\SqliteUsersRepository;
use App\UUID;
use Faker\Guesser\Name;

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite'); //PDO
include __DIR__ . '/vendor/autoload.php'; //Composer
require __DIR__ . '/src/Structure/fakeStructure.php'; //Точка записи локальных данных
$faker = Faker\Factory::create('ru_RU'); //Faker

$usersRepository = new InMemoryUsersRepository(); //Локальный репозиторий
$usersRepository = new SqliteUsersRepository($connection);// Пользователи
$postRepository = new PostRepository($connection); //Посты
$commentRepository = new CommentRepository($connection); //Комментарии
$command = new CreateUserCommand($usersRepository); // Консоль

try {

} catch (Exception $e){
    echo $e->getMessage();
}

//Записать в таблицу новые данные через консоль
//$command->handle(Arguments::fromArgv($argv));
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
//$user = $usersRepository->getByEmail("elvira.morozov@mail.rp");
//$post = $postRepository->get(new UUID('c1a8beb5-eee6-4288-95d6-9d427eeadfac'));
//$comment = $commentRepository->get(new UUID('d3192232-d5bc-42a6-8027-1eadf79cedc5'));