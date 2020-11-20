<?php

namespace App\Model;

/**
 *
 */
class DepotManager extends AbstractManager
{
    public const TABLE = 'depot';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $depot): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`username`, `password`, `amount`) 
        VALUES (:username, :password, :amount)");
        $statement->bindValue('username', $depot['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $depot['password'], \PDO::PARAM_STR);
        $statement->bindValue('amount', $depot['amount'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
