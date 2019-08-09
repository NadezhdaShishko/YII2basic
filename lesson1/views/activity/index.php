<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */
/* @var $form ActiveForm */
$this->title = 'DayActivity';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>
<!--            --><?//= $form->action = Url::to(['activity/submit']); ?>

                <?= $form->field($model, 'title')->textInput(['autofocus' => true])->hint('Введите название события') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'start_date') ?>
                <?= $form->field($model, 'end_date') ?>
                <?= $form->field($model, 'author_id') ?>
                <?= $form->field($model, 'cycle')->checkbox() ?>
                <?= $form->field($model, 'main')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                </div>
            <?= Html::a('Календарь', ['site/index', 'userId' => $user->id], ['class' => 'calendar-link']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- activity-index -->
