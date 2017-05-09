<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="btn-group">

    <?php
    foreach ($menuItems as $menuItem => $url) {?>
        <a href="<?=$url?>"><button type="button" class="btn btn-info"><?=$menuItem?></button></a>
        <?php
    }
    ?>

</div>