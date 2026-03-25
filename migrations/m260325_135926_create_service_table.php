<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m260325_135926_create_service_table extends Migration
{
        public function up()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'content' => $this->text(),
            'image_main' => $this->string(255),
            'icon' => $this->string(100),
            'animation' => $this->string(50),
            'meta_keywords' => $this->string(255),
            'meta_description' => $this->text(),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk_service_department',
            '{{%service}}',
            'department_id',
            '{{%department}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_service_department', '{{%service}}');
        $this->dropTable('{{%service}}');
    }

}
