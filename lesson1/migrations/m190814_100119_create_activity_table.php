<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m190814_100119_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'title' => $this->integer()->notNull(),
            'body' => $this->text()->notNull(),
            'start_date' => $this->integer(),
            'end_date' => $this->integer(),
            'author_id' => $this->integer(),
            'cycle' => $this->boolean()->defaultValue(false),
            'main' => $this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activity');
    }
}
