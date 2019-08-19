<?php


namespace app\components;


use yii\base\Component;

class SessionComponent extends Component
{

    public function getPreviousPage()
    {

        $previousPage = \Yii::$app->session->get('currentPage', null);

        \Yii::$app->session->set('currentPage', $_SERVER['REQUEST_URI']);
        return $previousPage;
    }

    public function getCurrentPage()
    {
        return $_SERVER['REQUEST_URI'];
    }
}