<?php

use yii\db\Migration;
use yii\db\Schema;

class m170413_095317_create_tables extends Migration
{
    public $tableRoom = '{{%room}}';
    public $tableTeam = '{{%team}}';
    public $tableUnit = '{{%unit}}';
    public $tableUnitClass = '{{%unitclass}}';
    public $tableWeapon = '{{%weapon}}';
    public $tableOrders = '{{%orders}}';
    public $tableMap = '{{%map}}';

    public function up()
    {
        $this->repair();
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableRoom, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'map' => Schema::TYPE_STRING . ' NOT NULL',
            'turn' => Schema::TYPE_INTEGER . ' NOT NULL',
            'state' => Schema::TYPE_STRING . ' NOT NULL',
            'last_update' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ], $tableOptions);

        $this->createTable($this->tableTeam, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'room' => Schema::TYPE_INTEGER . ' NOT NULL',
            'pass' => Schema::TYPE_STRING . ' NOT NULL',
            'color' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableUnit, [
            'id' => Schema::TYPE_PK,
            'nickname' => Schema::TYPE_STRING . ' NOT NULL',
            'team' => Schema::TYPE_INTEGER . ' NOT NULL',
            'class' => Schema::TYPE_INTEGER . ' NOT NULL',
            'weapon' => Schema::TYPE_INTEGER . ' NOT NULL',
            'state' => Schema::TYPE_STRING . ' NOT NULL',
            'x' => Schema::TYPE_INTEGER . ' NOT NULL',
            'y' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableUnitClass, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'move' => Schema::TYPE_INTEGER . ' NOT NULL',
            'weapon' => Schema::TYPE_STRING . ' NOT NULL',
            'view' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableWeapon, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'chances' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableOrders, [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . ' NOT NULL',
            'room' => Schema::TYPE_INTEGER . ' NOT NULL',
            'turn' => Schema::TYPE_INTEGER . ' NOT NULL',
            'unit' => Schema::TYPE_INTEGER . ' NOT NULL',
            'x' => Schema::TYPE_INTEGER . ' NOT NULL',
            'y' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable($this->tableMap, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'tiles' => Schema::TYPE_STRING . ' NOT NULL',
            'size_x' => Schema::TYPE_INTEGER . ' NOT NULL',
            'size_y' => Schema::TYPE_INTEGER . ' NOT NULL',
            'respawn' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

        //todo tiles table
        
//        $this->createIndex('username', $this->tableRoom, 'username', true);
        $this->insertWeapons();
        $this->insertUnitClasses();
        $this->insertMap();
    }

    private function insertWeapons()
    {
        $this->execute($this->buildInsertQuery($this->tableWeapon, ['name' => 'Автомат', 'chances' => '{"1":"95","2":"80","3":"60","4":"30"}']));
        $this->execute($this->buildInsertQuery($this->tableWeapon, ['name' => 'Снайперская винтовка', 'chances' => '{"1":"95","2":"80","3":"60","4":"30"}']));
        $this->execute($this->buildInsertQuery($this->tableWeapon, ['name' => 'Пулемет', 'chances' => '{"1":"95","2":"80","3":"60","4":"30"}']));
    }

    private function insertUnitClasses()
    {
        $this->execute($this->buildInsertQuery($this->tableUnitClass, ['name' => 'Стрелок', 'move' => '4', 'weapon' => '1', 'view' => '4']));
        $this->execute($this->buildInsertQuery($this->tableUnitClass, ['name' => 'Снайпер', 'move' => '4', 'weapon' => '2', 'view' => '5']));
        $this->execute($this->buildInsertQuery($this->tableUnitClass, ['name' => 'Разведчик', 'move' => '4', 'weapon' => '1', 'view' => '5']));
        $this->execute($this->buildInsertQuery($this->tableUnitClass, ['name' => 'Пулеметчик', 'move' => '4', 'weapon' => '3', 'view' => '4']));
    }

    private function insertMap()
    {
$tiles = <<<EOT
4111111111
1111111111
1111111111
1111111111
1111111111
1111111111
1111111111
1111111111
1111111111
1111111111
EOT;
        $tiles = preg_replace( "/\r|\n|\r\n/", "", $tiles );
        $this->execute($this->buildInsertQuery($this->tableMap, ['name' => 'Дом', 'tiles' => $tiles, 'size_x' => '10', 'size_y' => '10', 'respawn' => '[{x:1,y:1},{x:9,y:9}]']));
    }

    private function buildInsertQuery($tableName, $data)
    {
        $colNames = [];
        $colValues = [];
        foreach ($data as $key => $value) {
            $colNames[] = "`$key`";
            $colValues[] = "'$value'";
        }
        $colNames = implode(', ', $colNames);
        $colValues = implode(', ', $colValues);
        return "INSERT INTO $tableName ($colNames) VALUES ($colValues)";
    }

    public function down()
    {
        $this->dropTable($this->tableRoom);
        $this->dropTable($this->tableTeam);
        $this->dropTable($this->tableUnit);
        $this->dropTable($this->tableUnitClass);
        $this->dropTable($this->tableWeapon);
        $this->dropTable($this->tableOrders);
        $this->dropTable($this->tableMap);
    }

    public function repair()
    {
        if ($this->tableExist($this->tableRoom))
            $this->dropTable($this->tableRoom);
        if ($this->tableExist($this->tableTeam))
            $this->dropTable($this->tableTeam);
        if ($this->tableExist($this->tableUnit))
            $this->dropTable($this->tableUnit);
        if ($this->tableExist($this->tableUnitClass))
            $this->dropTable($this->tableUnitClass);
        if ($this->tableExist($this->tableWeapon))
            $this->dropTable($this->tableWeapon);
        if ($this->tableExist($this->tableOrders))
            $this->dropTable($this->tableOrders);
        if ($this->tableExist($this->tableMap))
            $this->dropTable($this->tableMap);
    }

    public function tableExist($tableName)
    {
        return (Yii::$app->db->schema->getTableSchema($tableName) !== null);
    }
}
