<?php

namespace App\Models;

use App\Libs\Model;
use App\Traits\Helper;

class LoginModel extends Model
{
    use Helper;

    public array $fields = [
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