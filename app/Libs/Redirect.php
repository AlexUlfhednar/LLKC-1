<?php

namespace App\Libs;

class Redirect
{
    private string $location;

    public function __construct(string $location)
    {
        $this->location = $location;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}