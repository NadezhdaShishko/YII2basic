<?php


namespace app\controllers;


use yii\web\Controller;

class HelloController extends Controller
{
    public function actionWorld()
    {
        return $this->render('world');
    }

    public function actionIndex()
    {
        return $this->render('../site/about');
    }
}