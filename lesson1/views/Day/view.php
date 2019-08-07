<?php
/** @var \app\models\Day $model */

var_dump($model->attributes);
foreach ($model as $attribute => $value){
    echo $model->getAttributeLabel($attribute). ": " .$value. "</br>";
};