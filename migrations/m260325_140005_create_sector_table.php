<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sector}}`.
 */
class m260325_140005_create_sector_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%sector}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'image' => $this->string(255),
            'icon' => $this->string(100),
            'animation' => $this->string(50),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);

        $this->addForeignKey(
            'fk_sector_service',
            '{{%sector}}',
            'service_id',
            '{{%service}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_sector_service', '{{%sector}}');
        $this->dropTable('{{%sector}}');
    }
}
