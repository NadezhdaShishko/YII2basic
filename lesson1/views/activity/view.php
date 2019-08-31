<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Активности', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту активность?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'author.email',
                'label'=>'Email пользователя',
            ],
            'title',
            'body',
            [
                'attribute'=>'start_date',
                'label'=>'Дата начала активности',
                'value'=>function($model) {
                    return Yii::$app->formatter->asDatetime($model->start_date);
                }
            ],
            [
                'attribute'=>'end_date',
                'label'=>'Дата окончания активности',
                'value'=>function($model) {
                    return Yii::$app->formatter->asDatetime($model->end_date);
                }
            ],
            [
                'attribute'=>'cycle',
                'label'=>'Повторяется',
                'value'=>function($model){
                    return Yii::$app->formatter->asBoolean($model->cycle);
                }
            ],
            'main:boolean',
        ],
    ]) ?>

</div>
