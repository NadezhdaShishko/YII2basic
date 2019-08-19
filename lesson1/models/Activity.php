<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property int $title
 * @property string $body
 * @property int $start_date
 * @property int $end_date
 * @property int $author_id
 * @property int $cycle
 * @property int $main
 * @property int $created_at
 * @property int $updated_at
 * @property User $author
 * @property User[] $users
 * @property Calendar[] $calendarRecords
 */
class Activity extends \yii\db\ActiveRecord
{
    const TIME_BEHAVIOR_NAME = 'timeBehavior';

    public function behaviors()
    {
        return [
            'timeStamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'start_date', 'end_date'], 'required'],
            [['cycle', 'main'], 'boolean'],
            [['author_id',], 'integer'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:d.m.Y'],
            [['title', 'body'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'author_id' => 'Author ID',
            'cycle' => 'Cycle',
            'main' => 'Main',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        $this->start_date = Yii::$app->formatter->asTimestamp($this->start_date);
        if (!isset($this->end_date)) {
            $this->end_date = $this->start_date;
        } else {
            $this->end_date = Yii::$app->formatter->asTimestamp($this->end_date);
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function validateEndDate($attribute, $params)
    {
        $startDateTimestamp = Yii::$app->formatter->asTimestamp($this->start_date);
        $endDateTimestamp = Yii::$app->formatter->asTimestamp($this->end_date);

        if (empty($endDateTimestamp)) {
            if ($startDateTimestamp > $endDateTimestamp) {
                $this->addError($attribute, 'Incorrect add_date.');
            }
        }
    }

    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->via('calendarRecords');
    }

    public function getAuthor()
    {
        $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarRecords()
    {
        return $this->hasMany(Calendar::class, ['activity_id' => 'id']);
    }




}
