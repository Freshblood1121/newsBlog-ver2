<?php
//Создаём объект подключения к SQLite
//Вставляем строку в таблицу пользователей
$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite'); //DataBase
$connection->exec(
    "INSERT INTO users (name_surname, email) VALUES ('Ivan', 'Nikitin')"
);