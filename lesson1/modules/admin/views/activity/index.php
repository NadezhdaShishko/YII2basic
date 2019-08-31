<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Активности';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить активность', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'authorEmail',
                'label'=>'Email',
                'value' => function (\app\modules\admin\models\Activity $model) {
                    return $model->author->email.' '.$model->author->id;
                }
            ],
            [
                'attribute' => 'username',
                'value' => function (\app\modules\admin\models\Activity $model) {
                    return $model->author->username;
                }
            ],
            'title',
            'body',
            [
                'attribute' => 'start_date',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'start_date',
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd.mm.yyyy',
                    ]
                ]),
                'value' => function (\app\modules\admin\models\Activity $model) {
                    return Yii::$app->formatter->asDate($model->start_date, 'php:d.m.Y');
                }
            ],
            [
                'attribute' => 'end_date',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'end_date',
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd.mm.yyyy',
                    ]
                ]),
                'value' => function (\app\modules\admin\models\Activity $model) {
                    return Yii::$app->formatter->asDate($model->end_date, 'php:d.m.Y');
                }
            ],
            'cycle:boolean',
            'main:boolean',
            [
                'attribute' => 'created_at',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd.mm.yyyy',
                    ]
                ]),
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y');
                }
            ],
            [
                'attribute' => 'updated_at',
                'filter' => \kartik\date\DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'updated_at',
                    'language' => 'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd.mm.yyyy',
                    ]
                ]),
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at, 'php:d.m.Y');
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
