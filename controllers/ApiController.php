<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ApiController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
//        \Yii::$app->response->format = 'json';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function auth()
    {
        if (!Yii::$app->request->isAjax) {
            return false;
        }
        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        $auth = $session->get('auth');
        
        //проверка
    }

    public function actionTest()
    {
        $post = Yii::$app->request->post();
        var_dump($post);
        $items = $post;
        return $items;
    }

}
