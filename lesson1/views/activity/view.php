<?php
/** @var \app\models\Activity $model */
/* @var $this yii\web\View */

$this->title = 'ActivityView';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
?>

<div class="activity-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        You may change the content of this page by modifying
        the file <code><?= __FILE__; ?></code>.
    </p>

    <div>

        <?php var_dump($model->attributes); ?>

        <?php foreach ($model as $attribute => $value){
            echo $model->getAttributeLabel($attribute). ": " .$value. "</br>";
        }; ?>
    </div>
</div>


