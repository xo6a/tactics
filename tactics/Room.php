<?php

namespace tactics;

use tactics\Team;

class Room extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'room';
    }

    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['room' => 'id']);
    }
}