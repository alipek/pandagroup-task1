<?php


namespace Recruitment\Contract\Repo;


use Recruitment\Contract\User;
use Recruitment\Dbal\Connection;

class UserRepo
{
    /**
     * @var Connection
     */
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findUserByEmail($username): ?User
    {
        $sql = "SELECT * FROM `user` where is_active = 1 AND email = :email LIMIT 1";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':email', $username);
        $statement->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $statement->execute();
        $user = $statement->fetch();
        if (false === $user) {
            $user = null;
        }
        return $user;
    }

    public function addNew(User $user)
    {
        $sql = "INSERT INTO `user` (first_name, last_name, email, gender, is_active, password) VALUES (:firstname,:lastname,:email,:gender,:is_active,:password)";
        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':firstname', $user->getFirstName());
        $statement->bindValue(':lastname', $user->getLastName());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':gender', $user->getGender());
        $statement->bindValue(':is_active', (int)$user->getIsActive());
        $statement->bindValue(':password', $user->getPassword());
        $statement->execute();
    }


}