<?php

namespace App\Exceptions;

use Exception;

class WeatherDataSourceConnectionException extends Exception
{
    public function __construct()
    {
        parent::__construct('Não foi possível conectar com a base de dados.');
    }
}
