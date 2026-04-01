<?php

use yii\db\Migration;

class m260401_084021_add_test_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260401_084021_add_test_posts cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260401_084021_add_test_posts cannot be reverted.\n";

        return false;
    }
    */
}
