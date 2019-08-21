<?php

namespace app\modules\admin\models;

use yii\base\Model;

class LoginForm extends Model {

    public $email;
    public $password;

    public function rules() {
        return [
            // удалим случайные пробелы для двух полей
            [['email', 'password'], 'trim'],
            // email и пароль обязательны для заполнения
            [
                ['email', 'password'],
                'required',
                'message' => 'Это поле обязательно для заполнения'
            ],
            // поле email должно быть адресом почты
            ['email', 'email'],
            // пароль не может быть короче 12 символов
            [['password'], 'string', 'min' => 12],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'E-mail',
            'password' => 'Пароль',
        ];
    }

    public static function login() {
        $_SESSION['auth_site_admin'] = true;
    }

    public static function logout() {
        if (isset($_SESSION['auth_site_admin'])) {
            unset($_SESSION['auth_site_admin']);
        }
    }
}