<?php

use app\models\Activity;
use app\models\Calendar;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calendar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calendar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author.email')
        ->textInput(['value' => Yii::$app->user->identity->email, 'readonly' => true])
        ->label('Email пользователя') ?>

    <?= $form->field($model, 'user_id')
        ->textInput(['value' => Yii::$app->user->identity->id, 'readonly' => true]) ?>

    <? $activities = \app\models\Activity::find()->where(['author_id'=>Yii::$app->user->id])->all();
        $items = ArrayHelper::map($activities,'id','title');
        $params = [ 'prompt' => 'Выберите активность для записи в календарь' ]; ?>

    <?= $form->field($model, 'activity_id')->dropDownList($items, $params) ?>

    <? $form->field($model, 'created_at')->textInput() ?>

    <? $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
