<?php

use yii\db\Migration;

/**
 * Class m190816_060812_alter_auth_key_column_to_user_table
 */
class m190816_060812_alter_auth_key_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'authKey', $this->string(32)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'authKey', $this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190816_060812_alter_auth_key_column_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
