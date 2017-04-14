<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_095317_create_tables extends Migration
{
    public $tableName;


    public function up(){}
    public function down(){}
    public function safeUp()
    {
        $this->tableName = '{{%test}}';
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . ' NOT NULL',
            'token' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);
        $this->createIndex('username', $this->tableName, 'username', true);
//        $this->execute($this->addUserSql());
    }

//    private function addUserSql()
//    {
//        $password = Yii::$app->security->generatePasswordHash('admin');
//        $auth_key = Yii::$app->security->generateRandomString();
//        $token = Yii::$app->security->generateRandomString() . '_' . time();
//        return "INSERT INTO {{%user}} (`username`, `email`, `password`, `auth_key`, `token`) VALUES ('admin', 'xo6a@myblog.loc', '$password', '$auth_key', '$token')";
//    }

    public function safeDown()
    {
        $this->dropTable('test');
    }
}
