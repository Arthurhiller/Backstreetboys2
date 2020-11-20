<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;
/**
 *
 */
class ApiManager extends AbstractManager
{
    public const TABLE = 'wallet';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function convert()
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://metals-api.com/api/latest?access_key=dzelq5c65pzrysvzhykl9tqpevf038hei2zv40r3l28an79i8j7ndvtbs88d&base=EUR&symbols=XAU');

        $statusCode = $response->getStatusCode(); // get Response status code 200

        if ($statusCode === 200) {

            $content = $response->toArray();
            // convert the response (here in JSON) to an PHP array
            return $content;
        }
    }

    public function insert(array $gold): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO wallet (`client_id`,`poids`, `price`) VALUES (:client_id, :poids, :price)"
        );
        $statement->bindValue('client_id', $gold['client_id'], \PDO::PARAM_INT);
        $statement->bindValue('poids', $gold['poids'], \PDO::PARAM_INT);
        $statement->bindValue('price', $gold['price'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
