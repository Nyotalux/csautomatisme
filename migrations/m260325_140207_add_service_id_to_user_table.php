<?php

use yii\db\Migration;

class m260325_140207_add_service_id_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'service_id', $this->integer());
        $this->addForeignKey(
            'fk_user_service',
            '{{%user}}',
            'service_id',
            '{{%service}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_service', '{{%user}}');
        $this->dropColumn('{{%user}}', 'service_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260325_140207_add_service_id_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
