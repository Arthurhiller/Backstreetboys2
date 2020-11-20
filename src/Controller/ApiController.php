<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ApiManager;

class ApiController extends AbstractController
{
    public function index()
    {
        if ($_SESSION['role'] === 'user') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $apiManager = new ApiManager();
                $currencies = $apiManager->convert();
                $price = $_POST['poids'] * intval($currencies['rates']['XAU']);
                $wallet = [
                    'client_id' => $_SESSION['user_id'],
                    'poids' => $_POST['poids'],
                    'price' => $price,
                ];
                $apiManager->insert($wallet);
                header('Location:/login/connection/');
            }
            return $this->twig->render('Api/add.html.twig');
        }
    }

    public function show()
    {
        $apiManager = new ApiManager();
        $currencies = $apiManager->convert();

        return $this->twig->render('Api/show.html.twig', ['currencies'=> $currencies]);
    }

}
