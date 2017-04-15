<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_095317_create_tables extends Migration
{
    public $tableRoom = '{{%room}}';
    public $tableTeam = '{{%team}}';
    public $tableUnit = '{{%unit}}';
    public $tableUnitType = '{{%unittype}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableRoom, [
            'id' => Schema::TYPE_PK,
            'map' => Schema::TYPE_STRING . ' NOT NULL',
            'turn' => Schema::TYPE_STRING . ' NOT NULL',
            'state' => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);

        $this->createTable($this->tableTeam, [
            'id' => Schema::TYPE_PK,
            'room_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'color' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableUnit, [
            'id' => Schema::TYPE_PK,
            'team_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'nickname' => Schema::TYPE_STRING . ' NOT NULL',
            'unittype_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'state' => Schema::TYPE_STRING . ' NOT NULL',
            'xpos' => Schema::TYPE_INTEGER . ' NOT NULL',
            'ypos' => Schema::TYPE_INTEGER . ' NOT NULL',
            'look' => Schema::TYPE_INTEGER . ' NOT NULL',
            'orderx' => Schema::TYPE_INTEGER . ' NOT NULL',
            'ordery' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableUnitType, [
            'id' => Schema::TYPE_STRING,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'move' => Schema::TYPE_INTEGER . ' NOT NULL',
            'weapon' => Schema::TYPE_STRING . ' NOT NULL',
            'viewangle' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

//        $this->createIndex('username', $this->tableRoom, 'username', true);
        $this->insertUnitTypes();
    }

    private function insertUnitTypes(){
        $this->execute($this->buildInsertUnitTypeSql('shooter', 'Стрелок', '4', 'rifle', '90'));
        $this->execute($this->buildInsertUnitTypeSql('sniper', 'Снайпер', '4', 'sniperrifle', '90'));
        $this->execute($this->buildInsertUnitTypeSql('scout', 'Разведчик', '5', 'rifle', '90'));
        $this->execute($this->buildInsertUnitTypeSql('support', 'Пулеметчик', '4', 'machinegun', '90'));
    }

    private function buildInsertUnitTypeSql($id, $name, $move, $weapon, $viewtype)
    {
        return "INSERT INTO $this->tableUnitType (`id`, `name`, `move`, `weapon`, `viewangle`) VALUES ('$id', '$name', '$move', '$weapon', '$viewtype')";
    }

    public function down()
    {
        $this->dropTable($this->tableRoom);
        $this->dropTable($this->tableTeam);
        $this->dropTable($this->tableUnit);
        $this->dropTable($this->tableUnitType);
    }
}
