<?php

class PredictiveController 
{
    public function index()
    {
        // Подключаем модель
        require_once 'models/PredictiveModel.php';
        
        // Получаем предсказательные данные из модели
        $model = new PredictiveModel();
        $predictions = $model->getPredictions();
        
        // Подключаем представление и передаем туда данные
        require_once 'views/PredictiveView.php';
        $view = new PredictiveView();
        $view->render($predictions);
    }
}
