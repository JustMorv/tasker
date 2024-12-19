<?php

class PredictiveModel 
{
    /**
     * Метод для получения предсказательных данных.
     *
     * @return array
     */
    public function getPredictions()
    {
        return [
            'months' => ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль'],
            'values' => [10, 20, 15, 25, 30, 35, 40]
        ];
    }
}
