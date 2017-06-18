<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\HttpException;

class ApiController extends Controller
{
    private $auth;

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
        $this->auth = $session->get('auth');

        if (is_null($this->auth)) {
            throw new HttpException(403, 'Unregistered user');
        }
    }

    public function actionTest()
    {
        $post = Yii::$app->request->post();
        var_dump($post);
        $items = $post;
        return $items;
    }

    public function actionEndturn()
    {
        $post = Yii::$app->request->post();
//        var_dump($post);
        $items = $post;
//        return $items;
        return ['status'=>'200 OK', 'action' => 'Endturn'];
    }

    public function actionUpdate()
    {
        $post = Yii::$app->request->post();
//        var_dump($post);
        $items = $post;
//        return $items;
        return ['status'=>'200 OK', 'action' => 'Update'];
    }

    public function actionInit()
    {
        //auth
        $this->auth();

        //take state
        /** @var $game \tactics\Game */
        $game = Yii::$app->game;
        $test = $game->test();

        //send data

        return ['status'=>'200 OK', 'test' => $test];
    }

    public function actionGethistory()
    {
        //auth

        //take history

        //take state

        //send data
    }

}
