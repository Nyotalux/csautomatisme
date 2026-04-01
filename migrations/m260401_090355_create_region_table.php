<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region}}`.
 */
class m260401_090355_create_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
    {
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'code' => $this->string(50),
            'description' => $this->text(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%region}}');
    }
}
