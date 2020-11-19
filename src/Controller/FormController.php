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
        return $this->twig->render('User/index.html.twig');
    }

    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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
            $id = $formManager->insert($users);
            header('Location:/form/show/' . $id);
        }

        return $this->twig->render('Form/_formRegistration.html.twig');
    }
}
