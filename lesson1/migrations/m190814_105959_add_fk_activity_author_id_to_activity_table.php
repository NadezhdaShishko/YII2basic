<?php

use yii\db\Migration;

/**
 * Class m190814_105959_add_fk_activity_author_id_to_activity_table
 */
class m190814_105959_add_fk_activity_author_id_to_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_activity_author_id',
            'activity',
            'author_id',
            'user',
            'id',
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_activity_author_id', 'activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190814_105959_add_fk_activity_author_id_to_activity_table cannot be reverted.\n";

        return false;
    }
    */
}
