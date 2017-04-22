<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class MenuWidget extends Widget
{
    public $menu;

    public function init()
    {
        parent::init();
        $this->menu = [
            'Create room' => '/createroom',
            'Room list' => '/roomlist',
        ];
    }

    public function run()
    {
        return \Yii::$app->view->renderFile('@app/views/tactics/menu.php', [
            'menuItems' => $this->menu,
        ]);
    }
}