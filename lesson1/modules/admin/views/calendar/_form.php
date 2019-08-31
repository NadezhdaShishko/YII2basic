<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Calendar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calendar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->field($model, 'author.email')
        ->textInput(['value' => Yii::$app->user->identity->email])
        ->label('Email пользователя') ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?php $activities = \app\models\Activity::find()->all();
    $items = ArrayHelper::map($activities,'id','title');
    $params = [ 'prompt' => 'Выберите активность для записи в календарь' ]; ?>

    <?= $form->field($model, 'activity_id')->dropDownList($items, $params) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>