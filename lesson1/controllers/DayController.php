<?php


namespace app\controllers;


use app\models\Day;
use yii\web\Controller;

class DayController extends Controller
{
    public function actionView()
    {

        $model = new Day();
        $model->id = 60;
        $model->title = date("m.d.Y");
        $model->weekday = date("w");
        $model->working = false;
        $model->working = true;
        /* $model->activity_id = 5; */

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}