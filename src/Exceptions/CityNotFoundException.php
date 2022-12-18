<?php

namespace App\Exceptions;

use Exception;

class CityNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Cidade não encontrada.');
    }
}
