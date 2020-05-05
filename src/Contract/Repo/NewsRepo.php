<?php


namespace Recruitment\Contract\Repo;


use Recruitment\Contract\News;
use Recruitment\Dbal\Connection;

class NewsRepo
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $sql = 'SELECT * FROM `news`';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, News::class);
        while (($news = $statement->fetch()) !== false) {
            yield $news;
        }
        $statement->closeCursor();
        unset($statement);
    }

    public function addNew(News $news): News
    {
        $sql = "INSERT INTO `news` (name, description, is_active, author_id) VALUES (:name, :description, :is_active, :author_id)";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':name', $news->getName());
        $statement->bindValue(':description', $news->getDescription());
        $statement->bindValue(':is_active', (int)$news->isIsActive());
        $statement->bindValue(':author_id', $news->getAuthorId());
        $statement->execute();
        $propId = new \ReflectionProperty($news, 'id');
        $propId->setAccessible(true);
        $propId->setValue($news, $this->connection->lastInsertId());
        return $news;
    }

    public function find($id): ?News
    {
        $sql = "SELECT * FROM `news` WHERE id = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, News::class);
        $news = $statement->fetch();
        if ($news == false) {
            $news = null;
        }
        return $news;
    }

    public function save(News $news): void
    {
        $sql = 'UPDATE `news` SET `name` = :name, `description` = :description, is_active = :is_active, updated_at = :update_at WHERE id = :id';
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $news->getId());
        $statement->bindValue(':name', $news->getName());
        $statement->bindValue(':description', $news->getDescription());
        $statement->bindValue(':is_active', (int)$news->isIsActive());
        $statement->bindValue(':update_at', $news->getUpdatedAt()->format('Y-m-d H:i:s'));
        $statement->execute();

    }

    public function remove(News $news): bool
    {
        $sql = 'DELETE from `news` where id = :id';
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $news->getId());
        return $statement->execute();
    }

}