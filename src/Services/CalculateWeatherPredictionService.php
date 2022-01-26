<?php

namespace App\Services;

use App\Models\Prediction;
use App\Models\Predictions;

class CalculateWeatherPredictionService
{
    private $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function calculatePrediction(): Prediction
    {
        $predictionMedia = 0;
        foreach ($this->predictions->jsonSerialize() as $prediction) {
            $predictionMedia += $prediction->getTemp();
        }

        $predictionMedia /= $this->predictions->count();

        return new Prediction(round($predictionMedia, 2), $this->predictions->current()->getCity(), $this->predictions->current()->getScale());
    }
}