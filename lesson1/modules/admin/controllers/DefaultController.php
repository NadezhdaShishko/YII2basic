<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use app\modules\admin\models\Activity;
use app\modules\admin\models\Calendar;
use app\modules\admin\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use app\modules\admin\models\SignupForm;
use app\modules\admin\controllers\AuthController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['logout', 'contact', 'index', 'about'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['test', 'error', 'add-admin'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

//    /**
//     * Login action.
//     *
//     * @return Response|string
//     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//
//            return $this->redirect('/admin/default/index');
////            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        /*
//         * Если пришли post-данные, загружаем их в модель...
//         */
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->redirect('/admin/default/index');
////            return $this->goBack();
//        }
//
//        $model->password = '';
//        return $this->render('login', [
//            'model' => $model,
//        ]);
//    }
//
//    public function actionSignup()
//    {
//        $model = new SignupForm();
//
//        if ($model->load(Yii::$app->request->post())) {
//            if ($user = $model->signup()) {
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->redirect('/admin/default/index');
////                    return $this->goHome();
//                }
//            }
//        }
//
//        return $this->render('signup', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * Logout action.
//     *
//     * @return Response
//     */
//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//
//        return $this->redirect('/admin/auth/login');
////        return $this->goHome();
//    }
//    public function actionLogout() {
//        LoginForm::logout();
//        return $this->redirect('/admin/auth/login');
//    }

