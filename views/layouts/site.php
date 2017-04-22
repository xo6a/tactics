<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\SiteAsset;
use app\components\MenuWidget;

SiteAsset::register($this);
$title = Html::encode($this->title);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?//= Html::csrfMetaTags() ?>
    <title><?= $title ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="page_wrap">
<?php $this->beginBody() ?>

<?= MenuWidget::widget() ?>

<h1><?= $title ?></h1>

<?= $content ?>


<?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>