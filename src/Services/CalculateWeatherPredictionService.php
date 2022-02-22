<?php

namespace App\Services;

use App\Models\Prediction;
use App\Collections\Predictions;

class CalculateWeatherPredictionService
{
    private Predictions $predictions;

    public function __construct(Predictions $predictions)
    {
        $this->predictions = $predictions;
    }

    public function calculatePrediction(): Prediction
    {
        $this->predictions->rewind();
        $city = $this->predictions->current()->getCity();
        $scale = $this->predictions->current()->getScale();

        $predictionMedia = 0;
        foreach ($this->predictions as $prediction) {
            $predictionMedia += $prediction->getTemp();
        }

        $predictionMedia /= $this->predictions->count();

        return new Prediction(round($predictionMedia, 2), $city, $scale);
    }
}