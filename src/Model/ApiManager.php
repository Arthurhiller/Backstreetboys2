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
class ApiManager
{
    public function selectAll()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://metals-api.com/api/latest?access_key=y14gqy2xk57w6k2pg8m0d8m46lc5zi7j57o6w3zl6odz6pym5pucqfjs18z7&base=USD&symbols=XAU,XAG');

        $statusCode = $response->getStatusCode(); // get Response status code 200

        if ($statusCode === 200) {

            $content = $response->toArray();
            // convert the response (here in JSON) to an PHP array
            return $content;
        }
    }
}
