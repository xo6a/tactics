<?php

namespace app\controllers;

use yii\console\Controller;
use Yii;
use tactics\Map;
use yii\console\Exception;

class TestController extends Controller
{

//    public function __construct($id, $module, $config = [])
//    {
//        parent::__construct($id, $module, $config);
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
//    }

    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionTest()
    {
        echo 'test';
    }

    public function actionMapParseJson()
    {
        $map = new Map();
        //{"name":"Map name","tiles":"1222211111121112221111111221111111112222112222111121111122211111211122111112111112222111111211122211111112211111111122221122221111211111222111112111221111121111","size_x":"10","size_y":"10","respawn":[{"x":"1","y":"1"},{"x":"9","y":"9"}]}
        $json = '{
            "name":"Map name",
            "tiles":"1222211111121112221111111221111111112222112222111121111122211111211122111112111112222111111211122211111112211111111122221122221111211111222111112111221111121111",
            "size_x":"10",
            "size_y":"10",
            "respawn":[{"x":"1","y":"1"},{"x":"9","y":"9"}]
        }';
        $map->parseJson($json);
        var_dump($map->respawnArray);
        var_dump($map->respawn);
    }

}
