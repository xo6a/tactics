<?php

namespace tactics;

use tactics\Room;

class Team extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'team';
    }

    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room']);
    }
}