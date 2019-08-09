<?php


namespace app\controllers;

use Yii;
use app\models\Activity;
use yii\web\Controller;

class ActivityController extends Controller
{

    public function actionIndex()
    {
        $model = new Activity();

//        if ($model->load(Yii::$app->request->post())) {
//            if ($model->validate()) {
//                // form inputs are valid, do something here
//                var_dump($model);
//            }
//        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionSubmit()
    {
        $model = new Activity();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return $this->refresh();
//                var_dump($model);
            }
        }
        return $this->render('submit');
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

        return $this->render('view', [
            'model' => $model,
        ]);

    }
}