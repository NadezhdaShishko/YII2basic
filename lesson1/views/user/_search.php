<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <? echo $form->field($model, 'id') ?>

    <? echo $form->field($model, 'username') ?>

    <? $form->field($model, 'auth_key') ?>

    <? $form->field($model, 'password_hash') ?>

    <? $form->field($model, 'password_reset_token') ?>

    <? echo  $form->field($model, 'email') ?>

    <? $form->field($model, 'status') ?>

    <? $form->field($model, 'created_at') ?>

    <? $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
