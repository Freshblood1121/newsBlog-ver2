<?php

use App\Modules\Comment\Comment;
use App\Modules\Post\Post;
use App\Modules\User\User;
use App\UUID;

$faker = Faker\Factory::create('ru_RU');

//Заготовки
$name = $faker->firstName("female") . " " . $faker->lastName("female");

$user = new User(
    UUID::random(),
    $faker->freeEmail,
    $name
);

$post = new Post(
    UUID::random(),
    $user,
    $faker->realText(rand(50,100))
);

$comment = new Comment(
    UUID::random(),
    $user,
    $post,
    $faker->realText(rand(10,40))
);

$route = $argv[1]?? 'Please, try to request...';

//Структура запросов(switch поменял на match)
$result = match (strtolower($route))
{
    "name" => $name,
    "user" => $user,
    "post" => $post,
    "comment" => $comment,
    default => 'Error try User, Post, Comment parametr'
};
echo $result;