<?php

namespace App\Repositories\PostRepository;

use App\Excepetions\InvalidArgumentException;
use App\Excepetions\PostNotFoundException;
use App\Excepetions\UserNotFoundException;
use App\Modules\Post\Post;
use App\Repositories\UsersRepository\SqliteUsersRepository;
use App\UUID;
use PDO;
use PDOStatement;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(private PDO $connection){}

    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO posts (uuid,author_uuid,title,text)
                   VALUES (:uuid,:author_uuid,:title,:text)'
        );
        $statement->execute([
            ':uuid' => $post->uuid(),
            ':author_uuid' => $post->getUser()->uuid(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText(),
        ]);
    }
    /**
     * @throws InvalidArgumentException
     * @throws PostNotFoundException
     * @throws UserNotFoundException
     */
    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid' => $uuid,
        ]);
        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws PostNotFoundException
     * @throws InvalidArgumentException|UserNotFoundException
     */
    private function getPost(PDOStatement $statement, string $postUuid): Post
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
//        print_r($result);
//        die();
        if ($result === false)
        {
            throw new PostNotFoundException("Cannot find post: $postUuid");
        }
        $userRepository = new SqliteUsersRepository($this->connection);
        $user = $userRepository->get(new UUID($result['author_uuid']));
        return new Post(
            new UUID($result['uuid']),
            $user,
            $result['title'],
            $result['text']
        );
    }
}