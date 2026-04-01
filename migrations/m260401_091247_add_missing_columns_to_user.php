<?php

use yii\db\Migration;

class m260401_091247_add_missing_columns_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
       public function up()
    {
        // Ajouter les colonnes manquantes
        $this->addColumn('{{%user}}', 'email', $this->string(255));
        $this->addColumn('{{%user}}', 'first_name', $this->string(255));
        $this->addColumn('{{%user}}', 'last_name', $this->string(255));
        $this->addColumn('{{%user}}', 'phone', $this->string(50));
        $this->addColumn('{{%user}}', 'avatar', $this->string(255));
        $this->addColumn('{{%user}}', 'role_id', $this->integer());
        $this->addColumn('{{%user}}', 'sector_id', $this->integer());
        $this->addColumn('{{%user}}', 'region_id', $this->integer());
        $this->addColumn('{{%user}}', 'last_login', $this->datetime());
        
        // Ajouter les clés étrangères si les tables existent
        $this->addForeignKey(
            'fk_user_role',
            '{{%user}}',
            'role_id',
            '{{%role}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk_user_sector',
            '{{%user}}',
            'sector_id',
            '{{%sector}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk_user_region',
            '{{%user}}',
            'region_id',
            '{{%region}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_role', '{{%user}}');
        $this->dropForeignKey('fk_user_sector', '{{%user}}');
        $this->dropForeignKey('fk_user_region', '{{%user}}');
        
        $this->dropColumn('{{%user}}', 'status');
        $this->dropColumn('{{%user}}', 'email');
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'avatar');
        $this->dropColumn('{{%user}}', 'role_id');
        $this->dropColumn('{{%user}}', 'sector_id');
        $this->dropColumn('{{%user}}', 'region_id');
        $this->dropColumn('{{%user}}', 'last_login');
    }

}
