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
            'parent_id' => Schema::TYPE_INTEGER,
            'content'=>Schema::TYPE_TEXT,

            'layout' => Schema::TYPE_STRING . '(50)',
            'status' => Schema::TYPE_BOOLEAN.' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,

            'seo_title' => Schema::TYPE_STRING,
            'seo_h1' => Schema::TYPE_STRING,
            'seo_keywords' => Schema::TYPE_STRING,
            'seo_description' => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
