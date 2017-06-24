<?php

namespace tactics;

use tactics\Team;

class Map extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'map';
    }

    public function getRespawnArray()
    {
        return json_decode($this->respawn, true);
    }
    
    public function parseJson($json)
    {
        $arr = json_decode($json, true);
        foreach ($arr as $paramName => $paramValue) {
            if ('respawn' == $paramName) {
                $this->respawn = json_encode($paramValue);
            } else {
                $this->{$paramName} = $paramValue;
            }
        }
    }
}