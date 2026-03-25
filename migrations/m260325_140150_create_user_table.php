<?php

use yii\db\Migration;

class m260325_140150_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'authKey' => $this->string(32),
            'accessToken' => $this->string(255),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
