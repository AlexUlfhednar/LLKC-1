<?php

namespace App\Libs;

use App\Models\AdditionalModel;
use App\Models\BasicModel;
use App\Models\LoginModel;
use App\Models\SpecialModel;

class Controller
{
    protected Model $model;
    protected BasicModel $basicModel;
    protected AdditionalModel $additionalModel;
    protected SpecialModel $specialModel;
    protected LoginModel $loginModel;

    public function __construct()
    {
        $this->model = new Model();
        $this->basicModel = new BasicModel();
        $this->additionalModel = new AdditionalModel();
        $this->specialModel = new SpecialModel();
        $this->loginModel = new LoginModel();
    }
}