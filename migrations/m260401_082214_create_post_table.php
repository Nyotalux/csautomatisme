<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m260401_082214_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'excerpt' => $this->text(),
            'content' => $this->text(),
            'image' => $this->string(255),
            'status' => $this->smallInteger()->defaultValue(1), // 0=draft, 1=published
            'views' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}
