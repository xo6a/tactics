<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\Request;
use tactics\Room;
use tactics\Team;
use tactics\Unit;
use tactics\UnitClass;

class TacticsController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'game';
    }

    public function beforeAction($action) {
        if (in_array($action->actionMethod,[
            'actionSaveroom',
            'actionEnterroom'
        ])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionBattlefield()
    {
        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        $auth = $session->get('auth');

        $this->layout = 'game';
        return $this->render('battlefield', [
            'auth' => $auth,
        ]);
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

}
