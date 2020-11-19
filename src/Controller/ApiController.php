<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ApiManager;

class ApiController extends AbstractAPIController
{
    public function index()
    {
        $apiManager = new ApiManager();
        $currencies = $apiManager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['currencies' => $currencies]);
    }
}
