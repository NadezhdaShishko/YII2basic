<?php

use yii\db\Migration;

/**
 * Class m190816_141334_rename_auth_key_column_to_user_table
 */
class m190816_141334_rename_auth_key_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('User', 'authKey', 'auth_key');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('User', 'auth_key', 'authKey');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190816_141334_rename_auth_key_column_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
