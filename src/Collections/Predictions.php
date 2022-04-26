<?php

namespace App\Collections;

use App\Models\Prediction;

class Predictions extends Collection
{
    protected string $allowedType = Prediction::class;
}