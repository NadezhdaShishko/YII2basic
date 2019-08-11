<?php

namespace app\controllers;

use app\models\Activity;
use Yii;

class ActivityController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new Activity();
        return $this->render('create', [
        'model' => $model,
    ]);
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSubmit()
    {
        $model = new Activity();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return $this->refresh();
            }
        }
        return $this->render('submit', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new Activity();
        $model->id = $id;
        return $this->render('update');
    }

    public function actionView()
    {
        $model = new Activity();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

}
