<?php


namespace app\controllers;

use app\models\Activity;
use yii\web\Controller;

class ActivityController extends Controller
{
    public function actionProfile()
    {
        echo 'Мы шли-шли и пришли';
    }

    public function actionView() {

        $model = new Activity();
        $model->id = 5;
        $model->title = 'Пятая активность';
        $model->body = 'Тело пятой активности';
        $model->start_date = time();
        $model->end_date = time()+24*60*60;
        $model->author_id = 4;
        $model->cycle = true;
        $model->main = true;

        $model->attributes = [
            'id' => 6,
            'title' => 6,
            'body' => 6,
            'end_date' => 6,
            ];

        return $this->render('view', [
            'model' => $model,
        ]);

    }
}