<?php

use yii\db\Schema;
use yii\db\Migration;

class m150321_153857_create_page_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%page}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'parent_id' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'content'=>Schema::TYPE_TEXT.' DEFAULT NULL',

            'layout' => Schema::TYPE_STRING . '(50) DEFAULT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' DEFAULT NULL',

            'seo_title' => Schema::TYPE_STRING . ' NOT NULL',
            'seo_h1' => Schema::TYPE_STRING . ' NOT NULL',
            'seo_keywords' => Schema::TYPE_STRING . ' NOT NULL',
            'seo_description' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
