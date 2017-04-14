<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class ApiController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        \Yii::$app->response->format = 'json';
    }

    public function actionTest()
    {
        $items = ['some', 'array', 'of', 'values' => ['associative', 'array']];
        return $items;
    }

}
