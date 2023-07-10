<?php

namespace App\Controllers;

use App\Libs\Controller;
use App\Libs\View;

class SignupController extends Controller
{
    public function index(): View
    {
        return new View('forms/signup.html.twig');
    }
}