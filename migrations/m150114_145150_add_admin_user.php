<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_145150_add_admin_user extends Migration
{
    public function up()
    {
        $this->insert('{{%user}}', [
                'username'=>'admin',
                'email'=>'dev.nettonn@gmail.com',
                'password_hash'=>Yii::$app->security->generatePasswordHash(97500009750000),
                'role'=>'admin',
                'status'=>1,
                'created_at'=>time(),
                'updated_at'=>time(),
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%user}}', 'username=:username', [':username'=>'admin']);
    }
}
