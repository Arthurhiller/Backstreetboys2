<?php

namespace App\Controller;

use App\Model\UserManager;

class LoginController extends AbstractController
{
    public function connection()
    {
        $error = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $user =
                [
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ];
            $login = $userManager->login($user);
            if (is_array($login)) {
                $_SESSION['role'] = $login['role'];
                $_SESSION['user_id'] = $login['id'];
                header('location:/');
                return;
            }
            $error['message'] = 'Erreur de connexion, tes identifiants sont inconnus';
            $error['class'] = 'danger';
        }
        return $this->twig->render('Login/login.html.twig', ['error' => $error]);
    }

    public function logout()
    {
        if ($_SESSION) {
            $_SESSION['username'] = '';
            $_SESSION['password'] = '';
            $_SESSION['id'] = '';
            $_SESSION['role'] = '';
            $_SESSION['user_id'] = '';
        }
        header('location:/');
    }
}
