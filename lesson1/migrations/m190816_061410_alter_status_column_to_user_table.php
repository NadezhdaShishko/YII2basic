<?php

use yii\db\Migration;

/**
 * Class m190816_061410_alter_status_column_to_user_table
 */
class m190816_061410_alter_status_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'status', $this->smallInteger()->notNull()->defaultValue(10));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'status', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190816_061410_alter_status_column_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
