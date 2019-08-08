<?php

namespace app\components;

use yii\base\Component;

class MessengerComponent extends Component
{
    public $message;

    public function init()
    {
        parent::init();
        $this->message = "Текст сообщения";
    }

    public function display($userMessage)
    {
        $this->message = $userMessage;
        return $this->message;
    }
}