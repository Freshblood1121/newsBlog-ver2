<?php

namespace App\Repositories\CommentRepository;

use App\Excepetions\CommentNotFoundException;
use App\Excepetions\InvalidArgumentException;
use App\Excepetions\PostNotFoundException;
use App\Excepetions\UserNotFoundException;
use App\Modules\Post\Post;
use App\Repositories\PostRepository\PostRepository;
use App\Repositories\UsersRepository\SqliteUsersRepository;
use App\UUID;
use PDO;
use PDOStatement;
use App\Modules\Comment\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private PDO $connection){}

    public function save(Comment $comment): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO comments (uuid,post_uuid,author_uuid,text)
        VALUES (:uuid, :post_uuid,:author_uuid,:text)');

        $statement->execute([
            'uuid' => $comment->uuid(),
            'post_uuid' => $comment->getPost()->uuid(),
            'author_uuid' => $comment->getUser()->uuid(),
            'text' => $comment->getText()
        ]);
    }

    /**
     * @throws InvalidArgumentException
     * @throws CommentNotFoundException
     * @throws UserNotFoundException
     * @throws PostNotFoundException
     */
    public function get(UUID $uuid): Comment
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM comments WHERE uuid = :uuid'
        );
        $statement->execute(['uuid' => (string)$uuid]);
        return $this->getComment($statement, $uuid);
    }

    /**
     * @throws CommentNotFoundException
     * @throws InvalidArgumentException|UserNotFoundException|PostNotFoundException
     */
    public function getComment(PDOStatement $statement, $uuidComment): Comment
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false){
            throw new CommentNotFoundException(
                "Cannot find comment: $uuidComment");
        }

        $postRepository = new PostRepository($this->connection);//Посты
        $post = $postRepository->get(new UUID($result['post_uuid']));
        $usersRepository = new SqliteUsersRepository($this->connection);// Пользователи
        $user = $usersRepository->get(new UUID($result['author_uuid']));

        return new Comment(
            UUID::random(),
            $post,
            $user,
            $result['text']
        );
    }
}