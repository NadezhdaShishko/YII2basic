<?php

use yii\db\Migration;

/**
 * Class m190814_102133_create_app_crated_at_and_updated_at_columns_to_activity_column
 */
class m190814_102133_create_app_crated_at_and_updated_at_columns_to_activity_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'created_at', $this->integer()->notNull());
        $this->addColumn('activity', 'updated_at', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity', 'created_at');
        $this->dropColumn('activity', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190814_102133_create_app_crated_at_and_updated_at_columns_to_activity_column cannot be reverted.\n";

        return false;
    }
    */
}
