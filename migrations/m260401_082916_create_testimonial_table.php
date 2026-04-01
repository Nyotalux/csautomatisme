<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%testimonial}}`.
 */
class m260401_082916_create_testimonial_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%testimonial}}', [
            'id' => $this->primaryKey(),
            'client_name' => $this->string(255)->notNull(),
            'client_company' => $this->string(255),
            'client_image' => $this->string(255),
            'content' => $this->text()->notNull(),
            'rating' => $this->smallInteger()->defaultValue(5),
            'status' => $this->smallInteger()->defaultValue(1),
            'sort_order' => $this->integer()->defaultValue(0),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%testimonial}}');
    }
}
