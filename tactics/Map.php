<?php

namespace tactics;

use tactics\Team;

class Map extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'map';
    }
}