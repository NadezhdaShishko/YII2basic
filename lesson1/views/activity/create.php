<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form ActiveForm */
$this->title = 'ActivityCreate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        You may change the content of this page by modifying
        the file <code><?= __FILE__; ?></code>.
    </p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>

            <?php $form->action = Url::to(['activity/index']); ?>
            <div class="form-group">
                <?= Html::submitButton('Календарь', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php $form = ActiveForm::begin(); ?>
            <?php $form->action = Url::to(['activity/submit']); ?>

            <?php if (!empty($id) || (isset($id))) : ?>
                <?= "ID: " . $id ?>
            <?php endif; ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true])->hint('Введите название события') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'start_date') ?>
                <?= $form->field($model, 'end_date') ?>
                <?= $form->field($model, 'author_id') ?>
                <?= $form->field($model, 'cycle')->checkbox() ?>
                <?= $form->field($model, 'main')->checkbox() ?>

            <?php if (!empty($id) || (isset($id))) : ?>
                <?= Html::hiddenInput('id', $id)?>
            <?php else : ?>
                <?= Html::hiddenInput('dayId', $dayId) ?>
            <?php endif; ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                <?= Html::resetButton('Сбросить', ['class' => 'btn reset']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- activity-create -->
