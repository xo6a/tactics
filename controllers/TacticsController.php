<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use tactics\Unit;
use tactics\UnitClass;

class TacticsController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'site';
    }

    public function actionRoomlist()
    {
        return $this->render('room-list');
    }

    public function actionCreateroom()
    {
        $uTypes = UnitClass::find()->all();

        return $this->render('create-room', [
            'uTypes' => $uTypes,
        ]);
    }

    public function actionBattlefield()
    {
        $this->layout = 'game';
        return $this->render('battlefield');
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
