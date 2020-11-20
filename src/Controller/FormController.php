<?php

namespace App\Controller;

use App\Model\FormManager;

class FormController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Form/index.html.twig');
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formManager = new FormManager();
            $users = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'job' => $_POST['job'],
                'email' => $_POST['email'],
                'town' => $_POST['town'],
            ];
            $formManager->insert($users);
            header('Location:/login/connection/');
        }

        return $this->twig->render('Form/_formRegistration.html.twig');
    }

    public function show(int $id)
    {
        $formManager = new FormManager();
        $users = $formManager->selectOneById($id);

        return $this->twig->render('Form/show.html.twig', ['users' => $users]);
    }
}
