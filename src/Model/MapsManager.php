<?php


namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;


class MapsManager
{
    public function selectAll()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://world.openfoodfacts.org/api/v0/product/737628064502.json');

        $statusCode = $response->getStatusCode(); // get Response status code 200

        if ($statusCode === 200) {
            $content = $response->getContent();
            // get the response in JSON format

            $content = $response->toArray();
            // convert the response (here in JSON) to an PHP array
        }

    }
}
