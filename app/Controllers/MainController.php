<?php

namespace App\Controllers;

use App\Libs\Controller;
use App\Libs\Db;
use App\Libs\View;
use App\Libs\Redirect;

class MainController extends Controller
{
    public function index(): View
    {
        return new View('index/index.html.twig');
    }

    public function home(): View
    {
        $results = $this->basicModel->selectAll();

        return new View('home/home.html.twig', [
            'results' => $results,
            'user' => $_SESSION['email']
        ]);
    }

    public function update(array $id): View|Redirect
    {
        $this->basicModel->setProperties($_POST);
        $this->additionalModel->setPropertiesId($id['id']);
        $this->additionalModel->setProperties($_POST);
        $this->specialModel->setProperties($_POST);
        $this->specialModel->setPropertiesId($id['id']);

        if ((0 === count($this->basicModel->errors)) &&
            (0 === count($this->additionalModel->errors)) &&
            (0 == count($this->specialModel->errors))) {

            $basic = $this->basicModel->getProperties();
            $additional = $this->additionalModel->getProperties();
            $special = $this->specialModel->getProperties();

            $this->basicModel->update($this->basicModel->tableName, $id, $this->basicModel->tableId, $basic);
            $this->additionalModel->update($this->additionalModel->tableName, $id, $this->additionalModel->tableId, $additional);
            $this->specialModel->update($this->specialModel->tableName, $id, $this->specialModel->tableId, $special);

            return new Redirect('/home');
        }

        $errors = array_merge($this->basicModel->errors, $this->additionalModel->errors, $this->specialModel->errors);

        return new View('forms/update.html.twig', [
            'errors' => $errors,
            'properties' => $this->basicModel->selectById($id),
        ]);
    }

    public function updateForm(array $id): View
    {
        return new View('forms/update.html.twig', [
            'properties' => $this->basicModel->selectById($id),
            'user' => $_SESSION['email'],
        ]);
    }

    public function create(): View|Redirect
    {
        $token = urlencode(base64_encode((random_bytes(32))));
        $_SESSION['token'] = $token;

        if ($_POST) {
            $sessToken = $_SESSION['token'];
            $postToken = $_POST['token'] ?? 2;
            unset($_SESSION['token']);
            if ($sessToken != $postToken) {

                $this->basicModel->setProperties($_POST);
                $this->additionalModel->setProperties($_POST);
                $this->specialModel->setProperties($_POST);

                if ((0 === count($this->basicModel->errors)) &&
                    (0 === count($this->additionalModel->errors)) &&
                    (0 == count($this->specialModel->errors))) {


                    $basic = $this->basicModel->getProperties();
                    $existing = $this->basicModel->selectByLogin($basic['email'], $basic['password']);

                    if (!$existing) {
                        $_SESSION['email'] = $basic['email'];
                        $this->basicModel->insert($this->basicModel->tableName, $basic);
                        $id = Db::getConnection()->lastInsertId();

                        $this->additionalModel->setPropertiesId((int) $id);
                        $additional = $this->additionalModel->getProperties();
                        $this->additionalModel->insert($this->additionalModel->tableName, $additional);

                        $this->specialModel->setPropertiesId((int) $id);
                        $special = $this->specialModel->getProperties();
                        $this->specialModel->insert($this->specialModel->tableName, $special);

                        return new Redirect('/home');

                    } else {

                        return new View('forms/login.html.twig', [
                            'errors' => ['User already exists'],
                            'properties' => $this->basicModel->getProperties()
                        ]);
                    }

                }

            }
        }

        $errors = array_merge($this->basicModel->errors, $this->additionalModel->errors, $this->specialModel->errors);
        $properties = array_merge($this->basicModel->getProperties(), $this->additionalModel->getProperties(), $this->specialModel->getProperties());

        return new View('forms/signup.html.twig', [
            'errors' => $errors,
            'properties' => $properties,
            'token' => $_SESSION['token']
        ]);

    }

    public function delete(array $id): Redirect
    {
        $this->basicModel->deleteById($id);
        return new Redirect('/home');
    }

    public function logout(): Redirect
    {
        session_destroy();
        return new Redirect('/');
    }

}