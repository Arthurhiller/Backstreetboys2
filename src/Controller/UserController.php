<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function index()
    {
        if ($_SESSION['role'] === 'user') {
            $userManager = new UserManager();
            $users = $userManager->selectAll();

            return $this->twig->render(
                'User/index.html.twig',
                [
                    'users' => $users,
                    'title' => 'Page index'
                ]
            );
        } elseif ($_SESSION['role'] === 'admin') {
        } else {
            header('location:login/forbidden');
        }
    }

    public function account()
    {
        $userManager = new UserManager();
        $id = $_SESSION['user_id'];
        $user = $userManager->selectOneById($id);

        return $this->twig->render('User/show.html.twig', ['user' => $user]);
    }

    public function edit($id)
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user['title'] = $_POST['title'];
            $userManager->update($user);
        }

        return $this->twig->render('User/show.html.twig', ['user' => $user]);
    }

    public function delete(int $id)
    {
        $userManager = new UserManager();
        $userManager->delete($id);
        header('Location:/user/index');
    }
}
