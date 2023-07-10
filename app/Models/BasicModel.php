<?php

namespace App\Models;

use App\Libs\Model;
use App\Traits\Helper;

class BasicModel extends Model
{
    use Helper;

    public string $tableName = "basic";
    public string $tableId = "id";
    public array $fields = [
        'name',
        'surname',
        'email',
        'password',
    ];
    public array $errors = [];

    private array $properties = [];

    public function __construct() {
        parent::__construct();
    }

    public function setProperties(array $postFields): void
    {
        foreach ($postFields as $key => $value) {
            if (in_array($key, $this->fields)) {

                $fnValidate = $key . 'Validate';
                if ($this->$fnValidate($value)) {
                    $this->properties[$key] = $this->checkInput($value);
                }
            }
        }

    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function nameValidate(string $val): bool
    {
        if (strlen(trim($val)) < 2) {
            $this->errors[] = 'Your name mus t Ье at least 2 letters long .';
        } elseif (!ctype_alnum(str_replace(' ', '', $val))) {
            $this->errors[] = 'Your name is not a valid';
        }
        return true;
    }

    public function surnameValidate(string $val): bool
    {
        if (strlen(trim($val)) < 3) {
            $this->errors[] = 'Your Surname mus t Ье at least 3 letters long .';
        } elseif (!ctype_alnum(str_replace(' ', '', $val))) {
            $this->errors[] = 'Your Surname is not a valid';
        }
        return true;
    }

    public function emailValidate(string $val): bool
    {
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Invalid email address';
        }
        return true;
    }

    public function passwordValidate(string $val): bool
    {
        if (!preg_match('/^\d{3,}$/', $val)) {
            $this->errors[] = 'Password must be 3 digits.';
        }
        return true;
    }

}