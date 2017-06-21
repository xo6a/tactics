<?php

namespace app\controllers;
//namespace app\commands;
//namespace console\controllers;


use yii\console\Controller;
use Yii;

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

}
