<?php

namespace App\Models;

use App\Libs\Model;
use App\Traits\Helper;

class AdditionalModel extends Model
{
    use Helper;

    public string $tableName = "additional";
    public string $tableId = "basic_id";
    public array $errors = [];
    public array $fields = [
        'address' => 'addressValidate',
        'city' => 'cityValidate',
        'country' => 'countryValidate',
        'postal' => 'postalValidate',
        'phone' => 'phoneValidate',
        'comments' => 'commentsValidate',
    ];

    private array $properties = [];

    public function __construct() {
        parent::__construct();
    }

    public function setProperties(array $postFields): void
    {
        foreach ($postFields as $key => $value) {
            if (array_key_exists($key, $this->fields)) {
                $fnValidate = $this->fields[$key];
                if ($this->$fnValidate($value)) {
//                    $this->properties[$key] = htmlspecialchars(strip_tags($value));
                    $this->properties[$key] = $this->checkInput($value);
                }
            }
        }
    }

    public function setPropertiesId(int $id): void
    {
        $this->properties[$this->tableId] = $id;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function addressValidate(string $val): bool
    {
        if (!preg_match('/[a-zA-Z][a-zA-Z\s\x27,.-]+/', $val)) {
            $this->errors[] = 'Invalid address.';
        }
        return true;
    }

    public function cityValidate(string $val): bool
    {
        if (!preg_match('/[A-Za-z0-9]{2,}/', $val)) {
            $this->errors[] = 'City must be at least 2 characters.';
        }
        return true;
    }

    public function countryValidate(string $val): bool
    {
        if (!preg_match('/[A-Za-z]/', $val)) {
            $this->errors[] = 'Invalid country.';
        }
        return true;
    }

    public function postalValidate(string $val): bool
    {
        if (!preg_match('/\d{4}/', $val)) {
            $this->errors[] = 'Postal code must be 4 digits.';
        }
        return true;
    }

    public function phoneValidate(string $val): bool
    {
        if (!preg_match('/\d{9}/', $val)) {
            $this->errors[] = 'Phone number must be 9 digits.';
        }
        return true;
    }

    public function commentsValidate(string $val): bool
    {
        if (!preg_match('/[A-Za-z0-9.,+]/', $val)) {
            $this->errors[] = 'Please enter a comment.';
        }
        return true;
    }

}