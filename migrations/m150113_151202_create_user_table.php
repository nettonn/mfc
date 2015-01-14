<?php

use yii\db\Schema;
use yii\db\Migration;

class m150113_151202_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
                'id' => Schema::TYPE_PK,
                'username' => Schema::TYPE_STRING . ' NOT NULL',
                'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
                'password_reset_token' => Schema::TYPE_STRING.' DEFAULT NULL',
                'email_confirm_token' => Schema::TYPE_STRING . ' DEFAULT NULL',
                'auth_key' => Schema::TYPE_STRING . '(32) DEFAULT NULL',
                'email' => Schema::TYPE_STRING . ' NOT NULL',
                'role' => Schema::TYPE_STRING . ' NOT NULL',
                'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
                'created_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
