<?php

namespace App\Controller;

use App\Model\DepotManager;

class DepotController extends AbstractController
{

    public function index()
    {
        $depotManager = new DepotManager();
        $depots = $depotManager->selectAll();

        return $this->twig->render('Depot/index.html.twig', ['depots' => $depots]);
    }

    public function show(int $id)
    {
        $depotManager = new DepotManager();
        $depot = $depotManager->selectOneById($id);

        return $this->twig->render('Depot/show.html.twig', ['depot' => $depot]);
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $depotManager = new DepotManager();
            $depot = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'amount' => $_POST['amount'],
            ];
            $id = $depotManager->insert($depot);
            header('Location:/depot/show/' . $id);
        }

        return $this->twig->render('Depot/add.html.twig');
    }

    public function delete(int $id)
    {
        $depotManager = new DepotManager();
        $depotManager->delete($id);
        header('Location:/depot/index');
    }
}
