<?php

namespace App\Model;

class FormManager extends AbstractManager
{
    public const TABLE = 'users';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $users
     * @return int
     */
    public function insert(array $users): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        "VALUES (null, :username, :password, :firstname, :lastname, :job, :email, :town)");
        $statement->bindValue(':username', $users['username'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $users['password'], \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $users['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $users['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':job', $users['job'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $users['email'], \PDO::PARAM_STR);
        $statement->bindValue(':town', $users['town'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
