<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 */
class m260325_140107_create_gallery_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'entity_type' => $this->string(50)->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'image' => $this->string(255)->notNull(),
            'caption' => $this->string(255),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%gallery}}');
}
}