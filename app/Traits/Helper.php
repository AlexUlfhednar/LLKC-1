<?php

namespace App\Traits;

trait Helper
{
    public function checkInput(string $input): string
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

}