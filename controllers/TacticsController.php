<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use tactics\Unit;
use tactics\UnitClass;
use yii\helpers\Url;

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

    public function beforeAction($action) {
        if (in_array($action->actionMethod,[
            'actionSaveroom'
        ])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionSaveroom()
    {
        $this->redirect(Url::to(['tactics/roomlist']),302);
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
