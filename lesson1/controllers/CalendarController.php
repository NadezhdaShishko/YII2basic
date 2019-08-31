<?php

namespace app\controllers;

use edofre\fullcalendar\models\Event;
use Yii;
use app\models\Calendar;
use app\models\CalendarSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use app\models\Activity;

/**
 * CalendarController implements the CRUD actions for Calendar model.
 */
class CalendarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Calendar models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single Calendar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Calendar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->user->identity->id;
        $model = new Calendar();

        $user = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Calendar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Calendar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Calendar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Calendar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = Calendar::find()->where(['id' => $id, 'user_id' => Yii::$app->user->identity->id])->one();
        if (isset($model)) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }

    /**
     * @param $id
     * @param $start
     * @param $end
     * @return array
     */
    public function actionGetRecords($id, $start, $end)
    {
        $start = Yii::$app->formatter->asTimestamp($start);
        $end = Yii::$app->formatter->asTimestamp($end);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $calendarRecordsQuery = Calendar::find()
            ->joinWith('activity')
            ->where(['user_id'=>Yii::$app->user->identity->id])
            ->andWhere('activity.start_date >= :start_date', [':start_date' => $start])
            ->andWhere('activity.end_date <= :end_date', [':end_date' => $end]);
        $records = [];
        foreach ($calendarRecordsQuery->each(100) as $calendarRecord) {
            /** @var Calendar $calendarRecord */
            $activity = $calendarRecord->activity;
            $records[] = new Event([
                'id' => $activity->id,
                'title' => $activity->title,
                'start' => Yii::$app->formatter->asDatetime($activity->start_date, 'php:c'),
                'end' => Yii::$app->formatter->asDatetime($activity->end_date, 'php:c'),
                'color' => 'coral',
                'borderColor' => 'olive',
                'textColor' => null,
                'url' => \yii\helpers\Url::to(['activity/view', 'id' => $activity->id]),
            ]);
        }
        return $records;
    }
}
