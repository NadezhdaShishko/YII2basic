<?php


namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'trim'],
            [
                ['username', 'email', 'password'],
                'required',
                'message' => 'Это поле обязательно для заполнения'
            ],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Это имя пользователя уже было использовано.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Этот адрес электронной почты уже был использован.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Email пользователя',
            'password' => 'Пароль пользователя',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\Exception
     */
    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            $user->trigger(User::EVENT_USER_HAS_BEEN_CREATED);

            return $user;
        }
        return null;
    }
}