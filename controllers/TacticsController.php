<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

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
        $unit = Yii::$app->unit;
        $uTypes = $unit->getUnitTypes();
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
