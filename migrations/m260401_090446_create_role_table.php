<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m260401_090446_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'permissions' => $this->text(), // JSON des permissions
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%role}}');
    }
}
