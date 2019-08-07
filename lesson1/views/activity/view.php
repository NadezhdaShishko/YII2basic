<?php
/** @var \app\models\Activity $model */

var_dump($model->attributes);
foreach ($model as $attribute => $value){
    echo $model->getAttributeLabel($attribute). ": " .$value. "</br>";
};

