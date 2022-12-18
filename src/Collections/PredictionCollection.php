<?php

namespace App\Collections;

use App\Entity\Prediction;

class PredictionCollection extends Collection
{
    protected string $allowedType = Prediction::class;
}
