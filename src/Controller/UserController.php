<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
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
            $userManager = new UserManager();
            $users = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'job' => $_POST['job'],
                'email' => $_POST['email'],
                'town' => $_POST['town'],
            ];
            $id = $userManager->insert($users);
            header('Location:/user/show/' . $id);
        }

        return $this->twig->render('user/_formRegistration.html.twig');
    }
}
