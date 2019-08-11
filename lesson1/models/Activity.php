<?php


namespace app\models;


use yii\base\Model;

class Activity extends Model
{
    public $id;
    public $title;
    public $body;
    public $start_date;
    public $end_date;
    public $author_id;
    public $cycle;
    public $main;

    public function attributeLabels()
    {
        return [
            'id'=> 'id',
            'title' => 'Название',
            'body' => 'Описание события',
            'start_date' => 'Дата начала',
            'end_date'=>'Дата окончания',
            'author_id'=>'Автор',
            'cycle'=>'повторяется',
            'main'=>'главное'
        ];

    }

    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
//            [['start_date', 'end_date'], 'default', 'value' => null],
//            [['start_date', 'end_date'], 'date'],
            [['title', 'body', 'start_date', 'end_date', 'author_id', 'cycle', 'main'], 'safe']
        ];
    }

}