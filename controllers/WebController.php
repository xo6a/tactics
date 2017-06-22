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

class WebController extends Controller
{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'site';
    }

    public function actionRoomlist()
    {
        $rooms = Room::find()->all();
        
        return $this->render('room-list', [
            'rooms' => $rooms,
        ]);
    }

    public function actionCreateroom()
    {
        $uTypes = UnitClass::find()->all();

        return $this->render('create-room', [
            'uTypes' => $uTypes,
        ]);
    }

    public function actionEnterroom()
    {
        //todo перенести в сервис

        $post = Yii::$app->request->post();

        $team = Team::find()->where(['id' => $post['team'], 'room' => $post['room']])->one();
        if (is_null($team)) {
            throw new HttpException(404, 'can\'t found team with id ' . $post['team']);
        }
        if ($team->pass != $post['pass']) {
            throw new HttpException(403, 'password incorrect');
        }

        $session = Yii::$app->session;
        if (!$session->isActive)
            $session->open();
        $auth = [
            'room' => $post['room'],
            'team' => $post['team'],
            'time' => time(),
        ];
        $session->set('auth', $auth);

        $this->redirect(Url::to(['tactics/battlefield']),302);
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

    public function actionSaveroom()
    {
        //todo перенести в сервис

        $post = Yii::$app->request->post();

        $room = new Room();
        $room->name = $post['name'];
        $room->map = $post['map'];//todo $post['map'] распарсить и преобразовать в json. сохранить как карту. сюда записать id
        $room->turn = 0;
        $room->state = 'start';
        $room->save();

        $team_a = new Team();
        $team_a->name = 'Команда А';
        $team_a->room = $room->id;
        $team_a->pass = $post['team_a_pass'];
        $team_a->color = $post['team_a_color'];
        $team_a->save();

        $team_b = new Team();
        $team_b->name = 'Команда Б';
        $team_b->room = $room->id;
        $team_b->pass = $post['team_b_pass'];
        $team_b->color = $post['team_b_color'];
        $team_b->save();

        $units = json_decode($post['units'],true);
        foreach ($units as $unit) {
            $u = new Unit();
            $u->nickname = $unit['nickname'];
            switch ($unit['team']){
                case 'team-a':
                    $u->team = $team_a->id;
                    break;
                case 'team-b':
                    $u->team = $team_b->id;
                    break;
                default:
                    throw new HttpException(400, 'wrong team param (' . $unit['team'] . ')');
            }
            $uclass = UnitClass::find()->where(['id' => $unit['class']])->one();
            $u->class = $unit['class'];
            $u->weapon = $uclass->weapon;
            $u->state = 'alive';
            $u->x = 0;
            $u->y = 0;
            $u->save();
        }

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
