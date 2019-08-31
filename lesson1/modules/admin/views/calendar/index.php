<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Календарь';
$this->params['breadcrumbs'][] = $this->title;
echo date(DATE_RSS);
?>
<div class="calendar-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= edofre\fullcalendar\Fullcalendar::widget([
        'events' => \yii\helpers\Url::to(['calendar/get-records', 'id' => uniqid()]),
    ]);
    ?>

</div>