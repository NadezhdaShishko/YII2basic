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
            [
                'class' => \app\behaviors\ActiveRecordCache::class,
                'cacheKeyName' => self::tableName(),
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        return parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
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
            [['title', 'body', 'start_date', 'end_date', 'author_id'], 'required'],
            [['cycle', 'main'], 'boolean'],
            [['author_id', 'created_at', 'updated_at',], 'integer'],
            [['end_date'], 'validateEndDate'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:d.m.Y'],
            [['title', 'body'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public static function findOne($condition)
    {
        if (Yii::$app->cache->exists(self::tableName().'_'.$condition) === false) {
            Yii::info('В кеше по этому ключу ничего нет');
            $result = parent::findOne($condition);
            Yii::$app->cache->set(self::tableName().'_'.$condition, $result);
        } else {
            Yii::info('Кеш найден');
            $result = Yii::$app->cache->get(self::tableName().'_'.$condition);
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID активности',
            'title' => 'Название',
            'body' => 'Описание',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'author_id' => 'ID пользователя',
            'cycle' => 'Повторяется',
            'main' => 'Main',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
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

    public function afterFind()
    {
        $this->start_date = Yii::$app->formatter->asDate($this->start_date, 'php:d.m.Y');
        $this->end_date = Yii::$app->formatter->asDate($this->end_date, 'php:d.m.Y');
        parent::afterFind();
    }

    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->via('calendarRecords');
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' =>'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarRecords()
    {
        return $this->hasMany(Calendar::class, ['activity_id' => 'id']);
    }

}