<?php

use yii\db\Migration;

/**
 * Class m190816_203716_alter_title_column_to_activity_table
 */
class m190816_203716_alter_title_column_to_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('activity', 'title', $this->string(55)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('activity', 'title', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190816_203716_alter_title_column_to_activity_table cannot be reverted.\n";

        return false;
    }
    */
}
