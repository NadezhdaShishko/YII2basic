<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%calendar}}`.
 */
class m190814_102745_create_calendar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('calendar', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'activity_id' => $this->integer()->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk_calendar_user_id',
            'calendar',
            'user_id',
            'user',
            'id',
            'CASCADE', 'CASCADE');

        $this->addForeignKey(
            'fk_calendar_activity_id',
            'calendar',
            'activity_id',
            'activity',
            'id',
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_calendar_activity_id', 'calendar');
        $this->dropForeignKey('fk_calendar_user_id', 'calendar');
        $this->dropTable('calendar');
    }
}
