<?php

namespace App\Models;

use App\Libs\Model;
use App\Traits\Helper;
use DateTime;

class SpecialModel extends Model
{
    use Helper;

    public string $tableName = "special";
    public string $tableId = "add_id";
    public array $errors = [];
    public array $fields = [
        'dateFrom' => 'dateFromValidate',
        'dateTo' => 'dateToValidate',
        'radio' => 'radioValidate',
        'hobbies' => 'hobbiesValidate',
    ];
    public array $hobbies = [
        'cycling' => 0,
        'swimming' => 0,
        'rowing' => 0,
        'basketball' => 0,
        'football' => 0,
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
                    if ($key == 'hobbies') {
                        foreach ($postFields['hobbies'] as $val) {
//                            $this->properties[$val] = $val;
                            $this->properties[$val] = 1;
                        }
                    } else {
                        foreach ($this->hobbies as $k => $val) {
                            $this->properties[$k] = $val;
                        }
                        $this->properties[$key] = $this->checkInput($value);
                    }
                }
            }
        }

        if (empty($postFields['hobbies'])) {
            $this->errors[] = 'Hobbies is not selected!';
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

    public function dateFromValidate(string $date, string $format = 'm/d/Y'): bool
    {
        if (empty($date)) {
            $this->errors[] = 'Date from is not selected';
        }
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function dateToValidate(string $date, string $format = 'm/d/Y'): bool
    {
        if (empty($date)) {
            $this->errors[] = 'Date to is not selected';
        }
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public function radioValidate(string $val): bool
    {
        /** @phpstan-ignore-next-line */
        return !empty($val) ?? false;
    }

    public function hobbiesValidate(array $val): bool
    {
        return $val != '';
    }

}