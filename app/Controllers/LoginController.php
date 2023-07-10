<?php

namespace App\Controllers;

use App\Libs\Controller;
use App\Libs\Redirect;
use App\Libs\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return new View('forms/login.html.twig');
    }

    public function login(): View|Redirect
    {
        $this->loginModel->setProperties($_POST);
        $extracted = $this->loginModel->getProperties();
        extract($extracted);
        $email = $email ?? '';
        $password = $password ?? '';

        $properties = [];
        $errors = [];

        if (empty($this->loginModel->errors)) {
            $_SESSION['email'] = $_POST['remember'] ? $email : '';
            $properties = $this->model->selectByLogin($email, $password);
        }

        if (!empty($properties)) {
//            $_SESSION['email'] = $properties['email'];
            return new Redirect('/home');
        } else {
            $errors[] = 'Invalid user.';
        }

        return new View('forms/login.html.twig', [
            'errors' => array_merge($errors, $this->loginModel->errors),
            'results' => $properties
        ]);
    }
}