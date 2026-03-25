<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%department}}`.
 */
class m260325_135850_create_department_table extends Migration
{ public function up()
    {
        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%department}}');
    }
}
